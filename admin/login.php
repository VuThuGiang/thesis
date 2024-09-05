<?php
require('../connection.php');
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
        if (password_verify($password, $row['password']) && $row['role'] == 0) {
            session_start();
            $_SESSION['logged_in_admin'] = true;
            $_SESSION['username_admin'] = $row['username'];
            $_SESSION['uid_admin'] = $row['id'];
            $_SESSION['role_admin'] = $row['role'];
            header("location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Mật khẩu không đúng hoặc bạn không có quyền truy cập trang này');</script>";
        }
    } else {
        echo "<script>alert('Email hoặc tên người dùng không tồn tại');</script>";
    }
}
?>



<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>LOGIN ADMIN</title>
    <style> 
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form.login {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        form.login p {
            margin-bottom: 1rem;
        }

        form.login label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        form.login input[type="text"],
        form.login input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        form.login input[type="text"]:focus,
        form.login input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .login-submit {
            text-align: center;
        }

        .login-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <form method="post" action="login.php" class="login">
        <p>
            <label for="login">Username or Email:</label>
            <input type="text" name="email_username" id="login" placeholder="Username or Email">
        </p>

        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password">
        </p>

        <p class="login-submit">
            <button type="submit" class="login-button" name="login">Login</button>
        </p>

    </form>


</body>

</html>