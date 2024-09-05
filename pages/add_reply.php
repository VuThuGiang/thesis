<?php
require('/laragon/www/dulich/connection.php');
session_start();

if (!isset($_SESSION['uid'])) {
    header("Location: /pages/login.php");
    exit();
}

$user_id = $_SESSION['uid'];
$parent_id = $_POST['parent_id'];
$reply = $_POST['reply'];

// Bước 1: Lấy blog_id từ comments
$query = "SELECT blog_id FROM comments WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $parent_id);
$stmt->execute();
$result = $stmt->get_result();
$comment = $result->fetch_assoc();
$blog_id = $comment['blog_id'];
$stmt->close();

// Bước 2: Chèn phản hồi vào comments
$query = "INSERT INTO comments (blog_id, user_id, parent_id, comment) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param('iiis', $blog_id, $user_id, $parent_id, $reply);

if ($stmt->execute()) {
    header("Location: blog_detail.php?id=$blog_id");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
