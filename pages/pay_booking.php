<?php
require('/laragon/www/dulich/connection.php');
require('/laragon/www/dulich/include/nav.php');

$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    die("Bạn cần đăng nhập để thanh toán tour.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'] ?? null;

    if ($booking_id) {
        // Chuyển hướng đến trang thanh toán với booking_id
        header("Location: payment_page.php?booking_id=$booking_id");
        exit();
    } else {
        echo "<script>alert('Không tìm thấy booking ID.');</script>";
    }
}
?>
