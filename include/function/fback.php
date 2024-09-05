<?php
require("/laragon/www/dulich/connection.php");

// Lấy danh sách feedbacks từ cơ sở dữ liệu
$query = "SELECT * FROM feedbacks ORDER BY created_at DESC";
$result = $con->query($query);
$feedbacks = $result->fetch_all(MYSQLI_ASSOC);
?>

<section class="ftco-section testimony-section bg-bottom" style="background-image: url('/assets/img/profile/bg-1.jpg'); background-size: cover; background-position: center bottom; min-height: 500px;">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <h2 class="mb-4">Tourist Feedback</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12 mt-4">
                <!-- Swiper -->
                <div class="swiper mySwiper" >
                    <div class="swiper-wrapper" style="width: 290px;">
                        <?php foreach ($feedbacks as $feedback): ?>
                            <div class="swiper-slide">
                                <div class="testimony-wrap py-4 px-3" style="background-color: rgba(255, 255, 255, 0.9); border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <div class="text" style="max-width: 600px; word-wrap: break-word; margin: 0 auto; color: #333;">
                                        <p class="mb-4" style="font-style: italic; font-size: 16px; margin-left: 10px"><?php echo nl2br(htmlspecialchars($feedback['feedback_text'])); ?></p>
                                        <div class="d-flex align-items-center" style="margin-left: -50px;">
                                            <img src="<?php echo htmlspecialchars($feedback['image_url']); ?>" class="user-img" style="border-radius: 50%; width: 60px; height: 60px; object-fit: cover;">
                                            <div class="pl-4" style="margin-left: 20px;">
                                                <p class="name" style="font-weight: bold; font-size: 18px; margin-bottom: 5px;"><?php echo htmlspecialchars($feedback['user_name']); ?></p>
                                                <span class="position" style="color: #888; font-size: 14px;"><?php echo htmlspecialchars($feedback['position']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination" style="color: #92af70;"></div>
    </div>
</section>
