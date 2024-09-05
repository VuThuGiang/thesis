<?php
require('/laragon/www/dulich/connection.php');
require('/laragon/www/dulich/include/nav.php');

$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    die("Bạn cần đăng nhập để thanh toán tour.");
}

$booking_id = $_GET['booking_id'] ?? null;
if (!$booking_id) {
    die("Booking ID là bắt buộc.");
}

// Truy vấn thông tin chi tiết booking
$query = "SELECT b.*, t.tour_name, t.adult_price, t.child_price
          FROM bookings b 
          JOIN tours t ON b.tour_id = t.id 
          WHERE b.booking_id = ? AND b.user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii", $booking_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("Không tìm thấy thông tin đơn hàng.");
}
$booking = $result->fetch_assoc();

// Tạo mã QR (giả sử sử dụng Google Chart API)
$qr_data = "Mã thanh toán: " . $booking['booking_id'] . "\nTổng giá: " . number_format($booking['total_price']) . " VNĐ";
$qr_url = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" . urlencode($qr_data);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/payment_page.css">
    <title>Thanh toán đơn hàng</title>
    <style>
        .payment-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            text-align: center;
        }

        .payment-info {
            margin-bottom: 20px;
        }

        .info-item {
            margin: 10px 0;
        }

        .qr-code {
            margin-top: 20px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="payment-container">
        <h2>Thông tin thanh toán</h2>
        <div class="payment-info">
            <div class="info-item"><strong>Tên Tour:</strong> <?php echo htmlspecialchars($booking['tour_name'] ?? ''); ?></div>
            <div class="info-item"><strong>Số lượng người lớn:</strong> <?php echo htmlspecialchars($booking['no_adult'] ?? ''); ?></div>
            <div class="info-item"><strong>Số lượng trẻ em:</strong> <?php echo htmlspecialchars($booking['no_child'] ?? ''); ?></div>
            <div class="info-item"><strong>Ngày đi:</strong> <?php echo htmlspecialchars($booking['booking_date'] ?? ''); ?></div>
            <div class="info-item"><strong>Tổng giá:</strong> <?php echo number_format($booking['total_price'] ?? 0); ?> VNĐ</div>
        </div>
        <div class="qr-code">
            <img src="<?php echo $qr_url; ?>" alt="QR Code để thanh toán">
        </div>
        <a href="/pages/user_orders.php" class="back-button">Quay lại trang đơn hàng</a>
    </div>
</body>

</html>

<?php
require("/laragon/www/dulich/include/footer.php");
?>
