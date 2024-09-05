<?php
ob_start(); // Bắt đầu output buffering

require("/laragon/www/dulich/connection.php");
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');

// Xử lý tạo mới feedback
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $position = $_POST['position'];
    $feedback_text = $_POST['feedback_text'];

    // Xử lý tải lên hình ảnh
    $target_dir = "/laragon/www/dulich/assets/img/profile/"; // Thư mục lưu trữ ảnh trên server
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $image_url = "/assets/img/profile/" . basename($_FILES["image"]["name"]); // Đường dẫn URL lưu trong cơ sở dữ liệu
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp có phải là hình ảnh không
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        // Di chuyển tệp tải lên đến thư mục đích
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Lưu thông tin vào cơ sở dữ liệu
            $query = "INSERT INTO feedbacks (user_name, position, image_url, feedback_text) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bind_param("ssss", $user_name, $position, $image_url, $feedback_text);
            $stmt->execute();
            header("Location: admin_feedbacks.php");
            exit;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}

// Xử lý xóa feedback
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM feedbacks WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin_feedbacks.php");
    exit;
}

// Lấy danh sách feedbacks
$query = "SELECT * FROM feedbacks ORDER BY created_at DESC";
$result = $con->query($query);
$feedbacks = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Feedbacks</title>
    <style>
        .form-container {
            margin: 0 auto;
            padding: 30px;
            width: 60%;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 350px;
        }

        .form-container h1 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-submit {
            display: block;
            width: 100%;
            background-color: #FF1493;
            color: #fff;
            padding: 12px 0;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
        }

        .btn-submit:hover {
            background-color: pink;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
  
        .btn-delete {
            padding: 5px 10px;
            margin: 0 5px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }

            table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1>Manage Feedbacks</h1>

    <form action="admin_feedbacks.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="user_name">Name:</label>
            <input type="text" id="user_name" name="user_name" required>
        </div>
        
        <div class="form-group">
            <label for="position">Position:</label>
            <input type="text" id="position" name="position">
        </div>
        
        <div class="form-group">
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        
        <div class="form-group">
            <label for="feedback_text">Feedback:</label>
            <textarea id="feedback_text" name="feedback_text" required></textarea>
        </div>
        
        <button type="submit" class="btn-submit">Add Feedback</button>
    </form>
</div>

<div class="posts-list" style="margin-left: 350px;">
    <h2>All Feedbacks</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Image</th>
                <th>Feedback</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feedbacks as $feedback): ?>
            <tr>
                <td><?php echo $feedback['id']; ?></td>
                <td><?php echo htmlspecialchars($feedback['user_name']); ?></td>
                <td><?php echo htmlspecialchars($feedback['position']); ?></td>
                <td>
                    <img src="<?php echo htmlspecialchars($feedback['image_url']); ?>" alt="User Image" style="width: 50px; height: auto;">
                </td>
                <td><?php echo htmlspecialchars($feedback['feedback_text']); ?></td>
                <td><?php echo $feedback['created_at']; ?></td>
                <td>
                    <a href="admin_feedbacks.php?delete=<?php echo $feedback['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this feedback?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php 
require("../footer.php"); 
ob_end_flush(); // Kết thúc output buffering và gửi output đến trình duyệt
?>
