<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Booking Details</title>
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
            display: flex;
            justify-content: space-between; 
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #ddd; 
        }

        .form-group label {
            font-weight: bold;
            color: #333;
            flex-basis: 40%; /* Chiếm 40% độ rộng của hàng */
        }

        .form-group span {
            flex-basis: 60%; /* Chiếm 60% độ rộng của hàng */
            font-size: 16px;
        }

        .paid {
            color: green; /* Màu xanh cho trạng thái Paid */
            font-weight: bold;
        }

        .unpaid {
            color: red; /* Màu đỏ cho trạng thái Unpaid */
            font-weight: bold;
        }

        .highlight-red {
            color: red;
            font-weight: bold;
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
        <h2>Booking Details for <?php echo htmlspecialchars($booking['tour_name']); ?></h2>
        <div class="form-group">
            <label for="booking_id">Booking ID:</label>
            <span id="booking_id"><?php echo htmlspecialchars($booking['booking_id']); ?></span>
        </div>
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <span id="full_name"><?php echo htmlspecialchars($booking['full_name']); ?></span>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <span id="email"><?php echo htmlspecialchars($booking['email']); ?></span>
        </div>
        <div class="form-group">
            <label for="tour_name">Tour Name:</label>
            <span id="tour_name"><?php echo htmlspecialchars($booking['tour_name']); ?></span>
        </div>
        <div class="form-group">
            <label for="no_adult">Number of Adults:</label>
            <span id="no_adult"><?php echo htmlspecialchars($booking['no_adult']); ?></span>
        </div>
        <div class="form-group">
            <label for="no_child">Number of Children:</label>
            <span id="no_child"><?php echo htmlspecialchars($booking['no_child']); ?></span>
        </div>
        <div class="form-group">
            <label for="total_price">Total Price (₫):</label>
            <span id="total_price"><?php echo number_format($booking['total_price'], 0, ',', '.'); ?> ₫</span>
        </div>
        <div class="form-group">
            <label for="payment_status">Payment Status:</label>
            <span id="payment_status" class="<?php echo strtolower($booking['payment_status']); ?>">
                <?php echo htmlspecialchars($booking['payment_status']); ?>
            </span>
        </div>
        <div class="form-group">
            <label for="booking_date">Booking Date:</label>
            <span id="booking_date"><?php echo htmlspecialchars(date('d-m-Y', strtotime($booking['booking_date']))); ?></span>
        </div>
        <div class="form-group">
            <label for="payment_day">Payment Date:</label>
            <span id="payment_day"><?php echo $booking['payment_day'] ? htmlspecialchars(date('d-m-Y', strtotime($booking['payment_day']))) : 'N/A'; ?></span>
        </div>

        <!-- Voucher Details -->
        <?php if (!empty($booking['voucher_code'])): ?>
            <div class="form-group">
                <label for="voucher_code">Voucher Code - Discount:</label>
                <span id="voucher_code" class="highlight-red"><?php echo htmlspecialchars($booking['voucher_code']) . ' - Giảm giá: ' . htmlspecialchars($booking['discount']) . '%'; ?></span>
            </div>
        <?php else: ?>
            <div class="form-group">
                <label for="voucher_code">Voucher Code:</label>
                <span id="voucher_code">N/A</span>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php require("../footer.php"); ?>
