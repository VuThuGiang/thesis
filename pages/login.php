<?php
require('/laragon/www/dulich/connection.php'); // Kết nối đến cơ sở dữ liệu
session_start();

if (isset($_POST['login'])) {
    $email_username = $_POST['email_username'];
    $password = $_POST['password'];

    // Sử dụng prepared statements để ngăn chặn SQL injection
    $stmt = $con->prepare("SELECT * FROM `user_form` WHERE `email` = ? OR `username` = ?");
    $stmt->bind_param('ss', $email_username, $email_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password']) && $row['role'] == 1) { // Vai trò user
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['pic'] = $row['image'];
            $_SESSION['uid'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            header("location: /index.php");
            exit();
        } else {
            echo "<script>alert('Mật khẩu không đúng hoặc bạn không có quyền truy cập trang này');</script>";
        }
    } else {
        echo "<script>alert('Email hoặc tên người dùng không tồn tại');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN NOW</title>
    <link rel="stylesheet" href="/assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .popup-container {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: gray;
            width: 300px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .popup-container h2 {
            margin: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        .popup-container span {
            font-size: 18px;
        }

        .popup-container form {
            background-color: gray;
            width: 350px;
            border-radius: 5px;
            padding: 20px 25px 30px 25px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .popup-container form h3 {
            margin-bottom: 15px;
            color: #30475e;
        }

        .popup-container form input {
            width: 100%;
            margin-bottom: 20px;
            background-color: #eeebeb;
            border: none;
            padding: 5px 0;
            font-weight: 550;
            font-size: 16px;
            outline: none;
        }

        .popup-container form button {
            font-weight: 550;
            font-size: 16px;
            background-color: #30475e;
            color: white;
            padding: 4px 10px;
            border: none;
            outline: none;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div id="wrapper">

        <form action="#" id="form-login" method="POST">
            <h1 class="form-heading"> User Login</h1>
            <div class="form-group">
                <i class="bi bi-person"></i>
                <input type="text" class="form-input" placeholder="Email or Username" name="email_username">
            </div>
            <div class="form-group">
                <i class="bi bi-pen"></i>
                <input type="password" class="form-input" placeholder="Password" name="password">
                <div id="eye">
                    <i class="bi bi-eye"></i>
                </div>
            </div>
            <button type="submit" class="form-submit" name="login"> LOGIN</button>

            <button type="button" class="forgot-submit" name="forgot" style="margin-left: 86px; margin-block-start: 10px; background-color: lightgray;" onclick="togglePopup()">Forgot Password ?</button>
        </form>

        <div class="popup-container" id="forgot-popup">
            <div class="forgot popup" style="margin-left: 15px;">
                <form action="../include/function/forgotpassword.php" method="POST">
                    <h2>
                        <span>RESET PASSWORD</span>

                        <button type="reset" onclick="togglePopup()" style="border: none; margin-left: 135px">X</button>
                    </h2>
                    <input type="text" name="email" placeholder="Email">
                    <button type="submit" class="reset-btn" name="send-reset-link" style="border: none; background-color: #30475e;">SEND LINK</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePopup() {
            var popup = document.getElementById("forgot-popup");
            var loginForm = document.getElementById("form-login");
            if (popup.style.display === "none") {
                popup.style.display = "block";
                loginForm.style.display = "none";
            } else {
                popup.style.display = "none";
                loginForm.style.display = "block";
            }
        }
    </script>
</body>




<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="/assets/js/login.js"></script>

</html>