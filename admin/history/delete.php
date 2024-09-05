<?php
ob_start(); // Bắt đầu output buffering
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
include('/laragon/www/dulich/connection.php');

// Lấy booking_id từ URL
$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kiểm tra nếu booking_id tồn tại
if ($booking_id > 0) {
    // Xóa booking khỏi cơ sở dữ liệu
    $sqlDeleteBooking = "DELETE FROM bookings WHERE booking_id = ?";
    
    $stmt = $con->prepare($sqlDeleteBooking);
    $stmt->bind_param('i', $booking_id);

    if ($stmt->execute()) {
        // Xóa thành công, chuyển hướng về trang booking_history.php với thông báo thành công
        header("Location: booking_history.php?message=delete_success");
        exit();
    } else {
        // Xóa thất bại, thông báo lỗi
        echo "<p class='error-message'>Error deleting booking: " . $con->error . "</p>";
    }

    $stmt->close();
} else {
    die("Invalid booking ID.");
}

ob_end_flush(); // Kết thúc output buffering và gửi output đến trình duyệt
?>
