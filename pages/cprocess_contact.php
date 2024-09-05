<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("/laragon/www/dulich/include/function/PHPMailer/PHPMailer.php");
require("/laragon/www/dulich/include/function/PHPMailer/SMTP.php");
require("/laragon/www/dulich/include/function/PHPMailer/Exception.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST['name'];
    $userEmail = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Kiểm tra các trường bắt buộc
    if (empty($username) || empty($userEmail) || empty($subject) || empty($message)) {
        header("Location: /pages/contact.php?error");
        exit();
    }

    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        // $mail->Username   = 'giangvt.ba11-036@st.usth.edu.vn'; // Địa chỉ email cố định của bạn
        $mail->Username   = $userEmail; // Địa chỉ email cố định của bạn
        $mail->Password   = 'vfsiezsplvyibhmp'; // Mật khẩu hoặc App Password của bạn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Thiết lập người gửi
        $mail->setFrom('dattq.ba11-021@st.usth.edu.vn', 'Mail User');

        // Người nhận là admin
        $mail->addAddress('thanhphatkl94@gmail.com'); // Địa chỉ email của admin

        // Thiết lập Reply-To để admin có thể trả lời cho người dùng
        $mail->addReplyTo($userEmail, $username);

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = $subject; // Tiêu đề email do người dùng nhập
        $mail->Body    = "<strong>Người gửi:</strong> " . htmlspecialchars($username) . "<br>"
            . "<strong>Email:</strong> " . htmlspecialchars($userEmail) . "<br><br>"
            . nl2br(htmlspecialchars($message)); // Nội dung email do người dùng nhập

        // Gửi email
        $mail->send();
        header("Location: /pages/contact.php?success");
    } catch (Exception $e) {
        header("Location: /pages/contact.php?error");
    }
} else {
    header("Location: /pages/contact.php");
}
