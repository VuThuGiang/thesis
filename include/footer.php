<?php
require_once '/laragon/www/dulich/connection.php';
require_once '/laragon/www/dulich/admin/setting/function.php';

// Fetch footer settings from the database
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

<head>
    <style>
        .footer {
            width: 100%;
            background-color: #00263A;
            /* Màu nền tối */
            color: #fff;
            padding: 40px 0;
            display: flex;
            justify-content: center;
            /* Căn giữa các cột */
            align-items: flex-start;
            /* Căn đầu trên các cột */
            gap: 40px;
            /* Khoảng cách giữa các cột */
        }

        .footer a {
            color: orange;
            /* Màu liên kết */
        }

        .footer a:hover {
            text-decoration: none;
        }

        .btn-social {
            border-radius: 50%;
            margin-right: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
        }

        .footer-column {
            flex: 1;
            min-width: 200px;
            margin-left: 115px;
        }

        .footer h4 {
            margin-bottom: 20px;
        }

        .social-icons {
            display: flex;
            gap: 15px; 
        }
    </style>
</head>

<body>
    <!-- Footer -->
    <div class="container-fluid footer">
        <div class="footer-column">
            <h4 class="text-white">Company</h4>
            <a href="" class="btn btn-link" style="color: orange;" name="about_us_link"><?php echo htmlspecialchars($about_us_text); ?></a><br>
            <a href="" class="btn btn-link" style="color: orange;" name="contact_us_link"><?php echo htmlspecialchars($contact_us_text); ?></a><br>
            <a href="" class="btn btn-link" style="color: orange;" name="privacy_policy_link"><?php echo htmlspecialchars($privacy_policy_text); ?></a><br>
            <a href="" class="btn btn-link" style="color: orange;" name="help_link"><?php echo htmlspecialchars($help_text); ?></a>
        </div>
        <div class="footer-column">
            <h4 class="text-white">Contact</h4>
            <p class="mb-2" style="margin-right: 285px; "><i class="fa fa-map-marker-alt me-3" style="color: orange;"></i><?php echo nl2br(htmlspecialchars($address)); ?></p>
            <p class="mb-2" style="margin-right: 280px; "><i class="fa fa-phone-alt me-3" style="color: orange;"></i><?php echo nl2br(htmlspecialchars($phone)); ?></p>
            <p class="mb-2" style="margin-right: 268px;" ><i class="fa fa-envelope me-3" style="color: orange;"></i><?php echo nl2br(htmlspecialchars($email)); ?></p>
            <p class="mb-2" style="margin-right: 268px;"><i class="fa fa-link me-3" style="color: orange;"></i><?php echo nl2br(htmlspecialchars($website)); ?></p>

            <!-- Social icons -->
            <div class="social-icons">
                <a href="<?php echo htmlspecialchars($facebook_link); ?>" class="btn btn-outline-light btn-social">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="<?php echo htmlspecialchars($youtube_link); ?>" class="btn btn-outline-light btn-social">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="<?php echo htmlspecialchars($linkedin_link); ?>" class="btn btn-outline-light btn-social">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
        <div class="footer-column">
            <h4 class="text-white">Description</h4>
            <p style="margin-right: 315px;"><?php echo nl2br(htmlspecialchars($newsletter)); ?></p>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/user_order.js"></script>
    

</body>

</html>
