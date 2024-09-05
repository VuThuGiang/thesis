<?php
require("/laragon/www/dulich/include/nav.php");
include '/laragon/www/dulich/connection.php';
include '/laragon/www/dulich/admin/setting/function.php';

$address = get_setting($con, 'address');
$phone = get_setting($con, 'phone');
$email = get_setting($con, 'email');
$website = get_setting($con, 'website');
?>
<!----Intro------>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/assets/img/profile/anhSAPA.jpg'); width: 100%; height: 500px; background-position: center bottom; background-size: cover;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb1-3 bread">Contact with us</h1>
            </div>
        </div>
    </div>
</section>

<!-----------Info Us------------->
<section class="ftco-section ftco-no-pb contact-section" style="margin-block-start: -100px;">
    <div class="container">
        <div class="row d-flex contact-info">
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <i class="bi bi-geo-alt" style="color: aliceblue; font-size:30px"></i>
                    </div>
                    <h3 class="mb-2">Address</h3>
                    <p><?php echo htmlspecialchars($address); ?></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <i class="bi bi-headset" style="color: aliceblue; font-size:30px"></i>
                    </div>
                    <h3 class="mb-2">Contact Number</h3>
                    <p><a href="tel://<?php echo htmlspecialchars($phone); ?>"><?php echo htmlspecialchars($phone); ?></a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <i class="bi bi-envelope" style="color: aliceblue; font-size:30px"></i>
                    </div>
                    <h3 class="mb-2">Email Address</h3>
                    <p><a href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <i class="bi bi-link-45deg" style="color: aliceblue; font-size:30px"></i>
                    </div>
                    <h3 class="mb-2">Website</h3>
                    <p><a href="<?php echo htmlspecialchars($website); ?>"><?php echo htmlspecialchars($website); ?></a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-----------Contact Form Section------------->
<section class="ftco-section contact-section" style="background-color: #33313b; height: 700px; margin-left: 115px; width: 85%">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Contact Form -->
                <div class="contact-form p-4">
                    <h3 style="color: white;">Contact Us</h3>
                    <?php
                    $message = "";
                    if (isset($_GET['error'])) {
                        $message = "Please fill in the blanks";
                        echo '<div class="alert alert-danger">' . $message . '</div>';
                    }
                    if (isset($_GET['success'])) {
                        $message = "Your message has been sent";
                        echo '<div class="alert alert-success">' . $message . '</div>';
                    }
                    ?>
                    <form action="/pages/cprocess_contact.php" method="post">
                        <div class="form-group">
                            <label for="name" style="color: white;">FULL NAME</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required style="background-color: #444; color: white;">
                        </div>
                        <div class="form-group">
                            <label for="email" style="color: white;">EMAIL ADDRESS</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required style="background-color: #444; color: white;">
                        </div>
                        <div class="form-group">
                            <label for="subject" style="color: white;">SUBJECT</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required style="background-color: #444; color: white;">
                        </div>
                        <div class="form-group">
                            <label for="message" style="color: white;">MESSAGE</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message" required style="background-color: #444; color: white;"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="btn-send" class="btn py-3 px-5" style="background-color: orange;">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div id="map" style="width: 100%; height: 400px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.4885474085286!2d105.78239287343185!3d20.97304478969334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acd4800e95b7%3A0xbe9bc2bf5cb7abca!2zMTM3IMSQxrDhu51uZyAxOS81LCBQLiBQaMO6YyBMYSwgSMOgIMSQw7RuZywgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1723536149410!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require('/laragon/www/dulich/include/footer.php'); ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(function() {
                alert.style.display = 'none';
            }, 3000); // Tắt thông báo sau 3 giây
        }
    });
</script>
