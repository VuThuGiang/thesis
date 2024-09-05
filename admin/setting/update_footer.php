<?php
// /laragon/www/dulich/admin/update_footer.php
session_start();
include '/laragon/www/dulich/connection.php';
include '/laragon/www/dulich/admin/setting/function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newsletter = $_POST['newsletter'];
    $facebook_link = $_POST['facebook_link'];
    $youtube_link = $_POST['youtube_link'];
    $linkedin_link = $_POST['linkedin_link'];
    $about_us_text = $_POST['about_us_text'];
    $contact_us_text = $_POST['contact_us_text'];
    $privacy_policy_text = $_POST['privacy_policy_text'];
    $help_text = $_POST['help_text'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];

  

    // Cập nhật thiết lập trong cơ sở dữ liệu
    $success = true;
    $success &= update_setting($con, 'newsletter', $newsletter);
    $success &= update_setting($con, 'facebook_link', $facebook_link);
    $success &= update_setting($con, 'youtube_link', $youtube_link);
    $success &= update_setting($con, 'linkedin_link', $linkedin_link);
    $success &= update_setting($con, 'about_us_text', $about_us_text);
    $success &= update_setting($con, 'contact_us_text', $contact_us_text);
    $success &= update_setting($con, 'privacy_policy_text', $privacy_policy_text);
    $success &= update_setting($con, 'help_text', $help_text);
    $success &= update_setting($con, 'address', $address);
    $success &= update_setting($con, 'phone', $phone);
    $success &= update_setting($con, 'email', $email);
    $success &= update_setting($con, 'website', $website);

    if ($success) {
        header('Location: admin_footer.php');
        exit;
    } else {
        echo "Error updating settings. Check error log for details.";
    }
}

$con->close();
?>
