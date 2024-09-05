<?php
require('/laragon/www/dulich/connection.php');

$booking_id = $_POST['booking_id'];
$status = $_POST['status'];

$query = "UPDATE bookings SET payment_status = ? WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("si", $status, $booking_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Trạng thái thanh toán đã được cập nhật."]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi cập nhật trạng thái thanh toán."]);
}
?>
