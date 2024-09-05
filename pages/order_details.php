<?php
require('/laragon/www/dulich/include/nav.php');
require('/laragon/www/dulich/connection.php');

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['uid'])) {
    header("Location: /pages/login.php");
    exit();
}

// Lấy thông tin người dùng từ session
$user_id = $_SESSION['uid'];

// Truy vấn để lấy thông tin chi tiết đơn hàng và tour
$booking_id = $_GET['order_id'] ?? null;
if (!$booking_id) {
    die("Booking ID là bắt buộc.");
}

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
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/order_detail.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Chi tiết đơn hàng</title>
    <style>
    .order-detail-container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #fff;
    }

    .order-info {
        margin-bottom: 20px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .info-item .label {
        font-weight: bold;
        width: 30%;
    }

    .info-item .value {
        width: 70%;
        text-align: right;
    }

    .order-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .cancel-button,
    .pay-button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: #fff;
    }

    .cancel-button {
        background-color: #f44336;
    }

    .pay-button {
        background-color: #4caf50;
    }

    .review-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .text-red {
        color: red;
        font-weight: bold;
    }

    .text-green {
        color: green;
        font-weight: bold;
    }
</style>


</head>

<body>
    <div class="order-detail-container">
        <h2>Order details</h2>
        <div class="order-info">
            <div class="info-item">
                <span class="label">Tour Name:</span>
                <span class="value"><?php echo htmlspecialchars($booking['tour_name'] ?? ''); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Number of adults:</span>
                <span class="value"><?php echo htmlspecialchars($booking['no_adult'] ?? ''); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Number of children:</span>
                <span class="value"><?php echo htmlspecialchars($booking['no_child'] ?? ''); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Departure date:</span>
                <span class="value"><?php echo htmlspecialchars($booking['booking_date'] ?? ''); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Booking date:</span>
                <span class="value"><?php echo htmlspecialchars($booking['created_at'] ?? ''); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Child price:</span>
                <span class="value"><?php echo number_format($booking['child_price'] ?? 0); ?> VNĐ</span>
            </div>
            <div class="info-item">
                <span class="label">Adult price:</span>
                <span class="value"><?php echo number_format($booking['adult_price'] ?? 0); ?> VNĐ</span>
            </div>
            <div class="info-item">
                <span class="label">Total price:</span>
                <span class="value"><?php echo number_format($booking['total_price'] ?? 0); ?> VNĐ</span>
            </div>
            <div class="info-item">
                <span class="label">Payment Status:</span>
                <span class="value <?php echo ($booking['payment_status'] === 'paid' || $booking['payment_status'] === 'complete') ? 'text-green' : 'text-red'; ?>">
                    <?php echo htmlspecialchars($booking['payment_status'] ?? ''); ?>
                </span>
            </div>

            <div class="info-item">
                <span class="label">Status:</span>
                <span class="value"><?php echo htmlspecialchars($booking['status'] ?? ''); ?></span>
            </div>
        </div>

        <div class="order-actions">
            <?php if ($booking['status'] !== 'cancelled') : ?>
                <form method="post" action="cancel_booking.php">
                    <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($booking['booking_id'] ?? ''); ?>">
                    <button type="submit" class="cancel-button">Cancel</button>
                </form>
                <?php if (in_array($booking['payment_status'], ['unpaid', 'Unpaid - Online'])) : ?>
                    <form method="post" action="pay_booking.php">
                        <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($booking['booking_id'] ?? ''); ?>">
                        <button type="submit" class="pay-button">Payment</button>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php
require("/laragon/www/dulich/include/footer.php");
?>