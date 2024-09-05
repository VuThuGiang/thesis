<?php
require('/laragon/www/dulich/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'] ?? null;

    if (!$booking_id) {
        echo json_encode(['status' => 'error', 'message' => 'Thiếu booking_id']);
        exit();
    }

    $query = "UPDATE bookings SET payment_status = 'failed' WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'failed']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không thể cập nhật trạng thái thanh toán']);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ']);
}
?>
