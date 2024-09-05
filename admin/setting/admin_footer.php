<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
include('/laragon/www/dulich/admin/setting/function.php');
include('/laragon/www/dulich/connection.php');

// Lấy giá trị từ cơ sở dữ liệu
$newsletter = get_setting($con, 'newsletter');
$facebook_link = get_setting($con, 'facebook_link');
$youtube_link = get_setting($con, 'youtube_link');
$linkedin_link = get_setting($con, 'linkedin_link');
$about_us_text = get_setting($con, 'about_us_text');
$contact_us_text = get_setting($con, 'contact_us_text');
$privacy_policy_text = get_setting($con, 'privacy_policy_text');
$help_text = get_setting($con, 'help_text');
$address = get_setting($con, 'address');
$phone = get_setting($con, 'phone');
$email = get_setting($con, 'email');
$website = get_setting($con, 'website');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Footer</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container1 {
            margin: 0 auto;
            padding: 20px;
            margin-left: 350px;
        }
        header {
            background-color: #FF1493; /* Thay đổi màu nền thành màu hồng đậm */
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        main {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 20px 0;
        }
        section {
            margin-bottom: 20px;
        }
        h2 {
            color: #FF1493; /* Thay đổi màu chữ tiêu đề thành màu hồng đậm */
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #FF1493; /* Thay đổi màu nền nút thành màu hồng đậm */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #FF69B4; /* Màu hồng nhạt hơn khi hover */
        }
    </style>
</head>
<body>
    <div class="container1">
        <header>
            <h1>Quản Lý Footer</h1>
        </header>
        <main>
            <form action="update_footer.php" method="post" enctype="multipart/form-data">
              
                <section>
                    <h2>NEWSLETTER</h2>
                    <textarea name="newsletter" rows="5"><?php echo htmlspecialchars($newsletter); ?></textarea>
                </section>
                <section>
                    <h2>SOCIAL</h2>
                    <label for="facebook_link">Facebook</label>
                    <input type="text" name="facebook_link" value="<?php echo htmlspecialchars($facebook_link); ?>">
                    <label for="youtube_link">YouTube</label>
                    <input type="text" name="youtube_link" value="<?php echo htmlspecialchars($youtube_link); ?>">
                    <label for="linkedin_link">LinkedIn</label>
                    <input type="text" name="linkedin_link" value="<?php echo htmlspecialchars($linkedin_link); ?>">
                </section>
                <section>
                    <h2>Chữ hiển thị trong footer</h2>
                    <label for="about_us_text">About Us Text</label>
                    <input type="text" name="about_us_text" value="<?php echo htmlspecialchars($about_us_text); ?>">
                    <label for="contact_us_text">Contact Us Text</label>
                    <input type="text" name="contact_us_text" value="<?php echo htmlspecialchars($contact_us_text); ?>">
                    <label for="privacy_policy_text">Privacy Policy Text</label>
                    <input type="text" name="privacy_policy_text" value="<?php echo htmlspecialchars($privacy_policy_text); ?>">
                    <label for="help_text">Help Text</label>
                    <input type="text" name="help_text" value="<?php echo htmlspecialchars($help_text); ?>">
                </section>
                <section>
                    <h2>Contact Information</h2>
                    <label for="address">Address</label>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <label for="website">Website</label>
                    <input type="text" name="website" value="<?php echo htmlspecialchars($website); ?>">
                </section>
                <input type="submit" value="Cập nhật Footer">
            </form>
        </main>
    </div>
</body>
</html>

<?php
$con->close();
?>

<?php require("../footer.php"); ?>
