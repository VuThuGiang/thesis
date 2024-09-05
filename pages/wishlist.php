<?php
require('/laragon/www/dulich/connection.php');
require("/laragon/www/dulich/include/nav.php");

$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    header("Location: /pages/login.php");
    exit();
}

// Truy vấn thông tin người dùng từ bảng users
$query = "SELECT * FROM user_form WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("Không tìm thấy thông tin người dùng.");
}
$user = $result->fetch_assoc();

// Truy vấn danh sách tour trong wishlist của người dùng cùng với số lượng đánh giá và điểm trung bình
$query = "
    SELECT 
        tours.id, 
        tours.tour_name, 
        tours.price, 
        tours.image, 
        tours.time_tour, 
        COUNT(reviews.id) AS review_count, 
        AVG(reviews.rating) AS average_rating
    FROM tours 
    JOIN wishlist ON tours.id = wishlist.tour_id
    LEFT JOIN reviews ON tours.id = reviews.tour_id 
    WHERE wishlist.user_id = ?
    GROUP BY tours.id";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $tours = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $tours = [];
}
?>

<?php require("/laragon/www/dulich/include/Hwishlist.php") ?>

<body>

    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/assets/img/profile/anhSAPA.jpg'); width: 100%; height: 500px; background-position: center bottom; background-size: cover;" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb1-3 bread">Wishlist</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container1">
        <?php if (count($tours) > 0) : ?>
            <div class="row">
                <?php foreach ($tours as $tour) : ?>
                    <div class="col-md-3">
                        <div class="tour-card" data-url="/pages/tour_detail.php?id=<?php echo $tour['id']; ?>">
                            <div class="card-header1">
                                <!-- Thay đổi biểu tượng thùng rác thành trái tim -->
                                <span class="remove-icon heart-icon" data-tour-id="<?php echo $tour['id']; ?>"><i class="fas fa-heart"></i></span>
                            </div>
                            <img src="/admin/anh/<?php echo $tour['image']; ?>" class="card-img-top" alt="Tour Image">
                            <div class="card-body">
                                <p class="card-title"><?php echo $tour['tour_name']; ?></p>
                                <p class="card-text">
                                    <strong style="color: red;">From: <?php echo number_format((float)str_replace(',', '', $tour['price'])); ?> ₫</strong><br>
                                    <span class="time-touring"><i class="fas fa-clock"></i> <?php echo $tour['time_tour']; ?></span>
                                </p>
                                <p class="star-rating">
                                    <?php
                                    $average_rating = $tour['average_rating'] ? number_format($tour['average_rating'], 1) : 0;
                                    $full_stars = floor($average_rating);
                                    $half_star = $average_rating - $full_stars >= 0.5 ? 1 : 0;
                                    $empty_stars = 5 - $full_stars - $half_star;

                                    for ($i = 0; $i < $full_stars; $i++) {
                                        echo '<i class="fas fa-star"></i>';
                                    }
                                    if ($half_star) {
                                        echo '<i class="fas fa-star-half-alt"></i>';
                                    }
                                    for ($i = 0; $i < $empty_stars; $i++) {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                    ?>
                                    <?php echo $average_rating; ?> (<?php echo $tour['review_count']; ?> Reviews)
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>You have no tours in your wishlist.</p>
        <?php endif; ?>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Xử lý sự kiện click vào tour-card
            $('.tour-card').click(function() {
                const url = $(this).data('url');
                window.location.href = url;
            });

            // Xử lý sự kiện xóa tour khỏi wishlist
            $('.remove-icon').click(function(event) {
                event.stopPropagation(); // Ngăn chặn sự kiện click vào card
                var tourId = $(this).data('tour-id');
                var tourCard = $(this).closest('.tour-card');

                $.ajax({
                    url: '/pages/remove_from_wishlist.php',
                    type: 'POST',
                    data: { tour_id: tourId },
                    success: function(response) {
                        try {
                            response = JSON.parse(response);
                            if (response.success) {
                                tourCard.remove(); // Xóa tour khỏi DOM
                            } else {
                                alert('Có lỗi xảy ra. Vui lòng thử lại.');
                            }
                        } catch (e) {
                            alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>

<!-------------feedback footer------------>
<?php require("/laragon/www/dulich/include/function/fback.php"); ?>
<?php require("/laragon/www/dulich/include/footer.php"); ?>
