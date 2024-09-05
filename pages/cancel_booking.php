<?php
require("/laragon/www/dulich/include/nav.php");
require('/laragon/www/dulich/connection.php');

$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    die("Bạn cần đăng nhập để hủy tour.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'] ?? null;

    if ($booking_id) {
        $query = "UPDATE bookings SET status = 'cancelled' WHERE booking_id = ? AND user_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ii", $booking_id, $user_id);
        if ($stmt->execute()) {
            echo "<script>alert('Hủy tour thành công!'); window.location.href = '/pages/user_orders.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi hủy tour: " . $stmt->error . "');</script>";
        }
    } else {
        echo "<script>alert('Không tìm thấy booking ID.');</script>";
    }
}
