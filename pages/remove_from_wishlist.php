<?php
require('/laragon/www/dulich/connection.php');

session_start();
$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập.']);
    exit();
}

$tour_id = $_POST['tour_id'] ?? null;

if (!$tour_id) {
    echo json_encode(['success' => false, 'message' => 'Thiếu ID tour.']);
    exit();
}

// Xóa tour khỏi wishlist
$query = "DELETE FROM wishlist WHERE user_id = ? AND tour_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii", $user_id, $tour_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Không thể xóa tour.']);
}

$stmt->close();
$con->close();
?>
