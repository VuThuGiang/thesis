<?php
require("/laragon/www/dulich/connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token)
{
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/SMTP.php");
    require("PHPMailer/Exception.php");

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'giangvt.ba11-036@st.usth.edu.vn';        //SMTP username
        $mail->Password   = 'vfsiezsplvyibhmp';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

        $mail->setFrom('giangvt.ba11-036@st.usth.edu.vn', 'TripBoss');
        $mail->addAddress($email);

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset Link from TripBoss';
        $mail->Body    = "Request from you to reset your password!! <br>
                Click the link : <br>
                <a href='http:/dulich.test/include/function/updatepassword.php?email=$email&reset_token=$reset_token'>http:/dulich.test/include/function/updatepassword.php?email=$email&reset_token=$reset_token
                </a> 
                ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['send-reset-link'])) {
    $query = "SELECT * FROM `user_form` WHERE `email` = '$_POST[email]'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/kolkata');
            $date = date("Y-m-d");
            $query = "UPDATE `user_form` SET `resettoken`='$reset_token',`resettokenexpired`='$date' WHERE `email`='$_POST[email]'";
            if (mysqli_query($con, $query) && sendMail($_POST['email'], $reset_token)) {
                echo "
                <script>
                    alert('Password reset link sent to mail');
                    window.location.href='/index.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Server down! Try again later!!!!');
                    window.location.href='/index.php';
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Email not found');
                window.location.href='/index.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('cannot run query');
            window.location.href='/index.php';
        </script>
        ";
    }
}
