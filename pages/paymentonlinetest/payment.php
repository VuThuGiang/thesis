<?php
require('/laragon/www/dulich/connection.php');

$booking_id = $_GET['booking_id'] ?? null;

if (!$booking_id) {
    die("Booking ID là bắt buộc.");
}

// Lấy thông tin chi tiết booking
$query = "SELECT bookings.*, users.full_name FROM bookings 
          JOIN user_form AS users ON bookings.user_id = users.id 
          WHERE bookings.booking_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Không tìm thấy thông tin booking.");
}

$order_number = sprintf('%06d', $booking['booking_id']);
$total_price = $booking['total_price'];
$full_name = $booking['full_name'];

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin thanh toán</title>
    <link rel="stylesheet" href="/assets/css/payment.css">
</head>

<body>
    <div class="payment-container">
        <h2>Thông tin thanh toán</h2>
        <div class="payment-info">
            <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($order_number); ?></p>
            <p><strong>Tên khách hàng:</strong> <?php echo htmlspecialchars($full_name); ?></p>
            <p><strong>Tổng thanh toán:</strong> <?php echo number_format($total_price); ?> VND</p>
            <div class="qr-code">
                <img src="https://img.vietqr.io/image/MB-0971622398-compact.png?amount=<?php echo $total_price; ?>&addInfo=MDH<?php echo $order_number; ?>&accountName=<?php echo htmlspecialchars($full_name); ?>" alt="QR Code">
            </div>
            <p>Quét mã QR để thanh toán qua Momo hoặc VNPAY.</p>
            <form action="confirm_payment.php" method="POST">
                <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                <button type="submit">Xác nhận thanh toán</button>
            </form>
        </div>
    </div>
</body>
</html>