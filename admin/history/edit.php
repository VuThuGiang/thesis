<?php
ob_start(); // Bắt đầu output buffering
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
include('/laragon/www/dulich/connection.php');

// Lấy booking_id từ URL
$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kiểm tra nếu booking_id tồn tại
if ($booking_id > 0) {
    // Truy vấn để lấy thông tin hiện tại của booking
    $sqlSelectBooking = "SELECT 
                            bookings.booking_id, 
                            user_form.full_name, 
                            user_form.email, 
                            tours.tour_name, 
                            bookings.no_adult, 
                            bookings.no_child, 
                            bookings.total_price, 
                            bookings.payment_status, 
                            bookings.status, 
                            bookings.booking_date, 
                            bookings.payment_day,
                            vouchers.voucher_code, 
                            vouchers.discount
                        FROM bookings 
                        JOIN user_form ON bookings.user_id = user_form.id 
                        JOIN tours ON bookings.tour_id = tours.id 
                        LEFT JOIN vouchers ON bookings.voucher_id = vouchers.voucher_id
                        WHERE bookings.booking_id = ?";
    
    $stmt = $con->prepare($sqlSelectBooking);
    $stmt->bind_param('i', $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $booking = $result->fetch_assoc();
    } else {
        die("Booking not found.");
    }
} else {
    die("Invalid booking ID.");
}

// Xử lý form submission để cập nhật payment status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $payment_status = $_POST['payment_status'];

    // Truy vấn để cập nhật payment_status của booking
    $sqlUpdate = "UPDATE bookings SET payment_status = ? WHERE booking_id = ?";
    $stmtUpdate = $con->prepare($sqlUpdate);
    $stmtUpdate->bind_param('si', $payment_status, $booking_id);

    if ($stmtUpdate->execute()) {
        // Cập nhật giá trị payment_status đã thay đổi
        $booking['payment_status'] = $payment_status;

        // Chuyển hướng đến trang booking_history.php với tham số thông báo
        header("Location: booking_history.php?message=success");
        exit(); // Dừng script sau khi chuyển hướng
    } else {
        echo "<p class='error-message'>Error updating payment status: " . $con->error . "</p>";
    }

    $stmtUpdate->close();
}
ob_end_flush(); // Kết thúc output buffering và gửi output đến trình duyệt
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <style>
        .form-container {
            margin: 0 auto;
            padding: 30px;
            width: 60%;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 350px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[readonly],
        .form-group textarea[readonly] {
            background-color: #e9ecef;
        }

        .btn-submit {
            display: block;
            width: 100%;
            background-color: #41a728;
            color: #fff;
            padding: 12px 0;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
        }

        .btn-submit:hover {
            background-color: #388e3c;
        }

        .highlight-red {
            color: red;
            font-weight: bold;
        }

        .error-message {
            text-align: center;
            color: red;
            font-size: 18px;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Booking Details</h2>
        <form action="edit.php?id=<?php echo $booking_id; ?>" method="POST">
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($booking['full_name']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($booking['email']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="tour_name">Tour Name:</label>
                <input type="text" id="tour_name" name="tour_name" value="<?php echo htmlspecialchars($booking['tour_name']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="no_adult">Number of Adults:</label>
                <input type="number" id="no_adult" name="no_adult" value="<?php echo htmlspecialchars($booking['no_adult']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="no_child">Number of Children:</label>
                <input type="number" id="no_child" name="no_child" value="<?php echo htmlspecialchars($booking['no_child']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="total_price">Total Price (₫):</label>
                <input type="text" id="total_price" name="total_price" value="<?php echo number_format($booking['total_price'], 0, ',', '.'); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="payment_status">Payment Status:</label>
                <select id="payment_status" name="payment_status" required>
                    <option value="Unpaid" <?php if ($booking['payment_status'] == 'Unpaid') echo 'selected'; ?>>Unpaid</option>
                    <option value="Paid" <?php if ($booking['payment_status'] == 'Paid') echo 'selected'; ?>>Paid</option>
                </select>
            </div>
            <div class="form-group">
                <label for="voucher_details">Voucher Code - Discount:</label>
                <input type="text" id="voucher_details" name="voucher_details" value="<?php echo !empty($booking['voucher_code']) ? htmlspecialchars($booking['voucher_code']) . ' - Giảm giá: ' . htmlspecialchars($booking['discount']) . '%' : 'N/A'; ?>" readonly class="highlight-red">
            </div>
            <button type="submit" name="update" class="btn-submit">Update Payment Status</button>
        </form>
    </div>
</body>
</html>

<?php require("../footer.php"); ?>
