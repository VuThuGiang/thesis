<?php
require('/laragon/www/dulich/connection.php');
session_start();

if (!isset($_SESSION['uid'])) {
    // Nếu người dùng chưa đăng nhập, hiển thị thông báo alert và ngừng thực hiện mã tiếp theo
    echo '<script type="text/javascript">
            alert("Vui lòng đăng nhập để bình luận.");
            window.location.href = "/pages/login.php";
          </script>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blog_id = isset($_POST['blog_id']) ? intval($_POST['blog_id']) : 0;
    $user_id = $_SESSION['uid'];
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : null;

    if ($blog_id > 0 && !empty($comment)) {
        // Chèn bình luận mới
        $query = "INSERT INTO comments (blog_id, user_id, comment, parent_id, likes, created_at) VALUES (?, ?, ?, ?, 0, NOW())";
        $stmt = $con->prepare($query);
        if ($stmt) {
            $stmt->bind_param('iisi', $blog_id, $user_id, $comment, $parent_id);
            $stmt->execute();
            $stmt->close();
        } else {
            // Xử lý lỗi nếu prepare statement thất bại
            echo "Error preparing statement: " . $con->error;
            exit();
        }
    } else {
        // Xử lý lỗi nếu blog_id hoặc comment không hợp lệ
        echo "Invalid blog ID or empty comment.";
        exit();
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
