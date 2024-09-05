<?php
require('/laragon/www/dulich/connection.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $v_code)
{
    require("/laragon/www/dulich/include/function/PHPMailer/PHPMailer.php");
    require("/laragon/www/dulich/include/function/PHPMailer/SMTP.php");
    require("/laragon/www/dulich/include/function/PHPMailer/Exception.php");

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'giangvt.ba11-036@st.usth.edu.vn';
        $mail->Password   = 'vfsiezsplvyibhmp';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('giangvt.ba11-036@st.usth.edu.vn', 'TripBoss');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Email Verification from TripBoss';
        $mail->Body    = "Thank for Registration! 
        Click the link below to verify the email address
        <a href='http://dulich.test/verify.php?email=$email&v_code=$v_code'>Verify</a>";
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['register'])) {
    $user_exist_query = "SELECT * FROM `user_form` WHERE `username` = '$_POST[username]' OR `email` = '$_POST[email]' ";
    $result = mysqli_query($con, $user_exist_query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['username'] == $_POST['username']) {
                echo "
                <script>
                    alert('$result_fetch[username] - Username already taken');
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('$result_fetch[email] - Email already registered');
                </script>
                ";
            }
        } else {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $v_code = bin2hex(random_bytes(16));
            $default_image = 'default_image.jpg';
            $query = "INSERT INTO `user_form`(`full_name`, `username`, `email`, `password`, `img`, `verification_code`, `is_verified`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password','','$v_code','0')";
            if (mysqli_query($con, $query) && sendMail($_POST['email'], $v_code)) {
                echo "
                <script>
                    alert('Registration successful');
                    window.location.href='/pages/login.php'
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Server Down');
                    window.location.href='/pages/login.php'
                </script>
                ";
            }
        }
    } else {
        echo "
        <script>
            alert('Cannot run query');
        </script>
        ";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER NOW</title>
    <link rel="stylesheet" href="/assets/css/register.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="wrapper">
        <form action="register.php" id="form-register" method="POST">
            <h1 class="form-heading">Create An Account</h1>

            <div class="form-group">
                <i class="bi bi-person"></i>
                <input type="text" class="form-input" placeholder="Full Name" name="fullname">
            </div>

            <div class="form-group">
                <i class="bi bi-person"></i>
                <input type="text" class="form-input" placeholder="Username " name="username">
            </div>
            <div class="form-group">
                <i class="bi bi-envelope"></i>
                <input type="email" class="form-input" placeholder="Your Email" name="email">
            </div>
            <div class="form-group">
                <i class="bi bi-bag-dash"></i>
                <input type="password" class="form-input" placeholder="Password" name="password">
            </div>

            <input type="submit" value="Signup" class="form-submit" name="register">
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="/assets/js/register.js"></script>

</html>