<?php
require('/laragon/www/dulich/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment_id = isset($_POST['comment_id']) ? intval($_POST['comment_id']) : null;
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    if ($comment_id !== null && $action !== null) {
        $likes_value = ($action === 'like') ? 1 : 0;
        $query = "UPDATE comments SET likes = ? WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ii', $likes_value, $comment_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không thể cập nhật bình luận.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ.']);
}

$con->close();
?>
