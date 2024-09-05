<?php
require("/laragon/www/dulich/connection.php");
require("/laragon/www/dulich/include/nav.php");

$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    die("Bạn cần đăng nhập để đặt tour.");
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

// Kiểm tra từ khóa tìm kiếm từ người dùng
$search_keyword = $_GET['location'] ?? '';  // Lấy từ khóa tìm kiếm từ URL
$search_keyword = mysqli_real_escape_string($con, $search_keyword);

// Định nghĩa biến $search_term cho câu truy vấn SQL
$search_term = "%" . $search_keyword . "%";

// Lấy giá trị minPrice và maxPrice từ URL nếu có
$minPrice = isset($_GET['minPrice']) ? intval($_GET['minPrice']) : 1000;
$maxPrice = isset($_GET['maxPrice']) ? intval($_GET['maxPrice']) : 10000000;

// Thiết lập số lượng tour mỗi trang
$per_page = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

// Tính toán tổng số tour để phân trang
$total_query = "
    SELECT COUNT(*) AS total_tours 
    FROM tours 
    LEFT JOIN location ON tours.location_id = location.id 
    WHERE (location.name LIKE ? OR tours.tour_name LIKE ?) AND tours.price BETWEEN ? AND ?";
$total_stmt = $con->prepare($total_query);
$total_stmt->bind_param("ssii", $search_term, $search_term, $minPrice, $maxPrice);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_tours = $total_result->fetch_assoc()['total_tours'];
$total_pages = ceil($total_tours / $per_page);

// Truy vấn danh sách tour cùng với số lượng đánh giá và điểm trung bình dựa trên từ khóa tìm kiếm, khoảng giá và phân trang
$total_query = "
    SELECT COUNT(*) AS total_tours 
    FROM tours 
    LEFT JOIN location ON tours.location_id = location.id 
    WHERE (location.name LIKE ? OR tours.tour_name LIKE ?) AND tours.price BETWEEN ? AND ?";
$total_stmt = $con->prepare($total_query);
$total_stmt->bind_param("ssii", $search_term, $search_term, $minPrice, $maxPrice);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_tours = $total_result->fetch_assoc()['total_tours'];
$total_pages = ceil($total_tours / $per_page);

// Cập nhật câu truy vấn lấy danh sách tour
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
    LEFT JOIN reviews ON tours.id = reviews.tour_id 
    LEFT JOIN location ON tours.location_id = location.id 
    WHERE (location.name LIKE ? OR tours.tour_name LIKE ?) AND tours.price BETWEEN ? AND ?
    GROUP BY tours.id 
    LIMIT ? OFFSET ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ssiiii", $search_term, $search_term, $minPrice, $maxPrice, $per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $tours = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $tours = [];
}

// Truy vấn wishlist của người dùng
$wishlist_query = "SELECT tour_id FROM wishlist WHERE user_id = ?";
$stmt = $con->prepare($wishlist_query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$wishlist_result = $stmt->get_result();

if ($wishlist_result->num_rows > 0) {
    $wishlist = array_column($wishlist_result->fetch_all(MYSQLI_ASSOC), 'tour_id');
} else {
    $wishlist = [];
}
?>

<?php require("/laragon/www/dulich/include/Htourpackage.php") ?>

<body>

    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/assets/img/profile/anhSAPA.jpg'); width: 100%; height: 500px; background-position: center bottom; background-size: cover;" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb1-3 bread">TOUR PACKAGE</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Nội dung chính -->
    <div class="container-fluid" style="width: 90%; margin-block-start: 30px">
        <div class="row justify-content-center">
            <!-- Filter Section -->
            <div class="col-md-3 filter-section-container">
                <!-- Bộ lọc địa điểm và ngày -->
                <div class="filter-section">
                    <h5>Location</h5>
                    <form method="GET" action="tourpackage.php">
                        <!-- Form tìm kiếm bằng GET -->
                        <div class="input-group mb-3">
                            <input type="text" name="location" id="location" class="form-control" placeholder="Where are you going?" value="<?php echo htmlspecialchars($search_keyword); ?>">
                            <!-- Sử dụng giá trị từ khóa tìm kiếm -->
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            </div>
                        </div>
                        <!-- Bổ sung các trường ẩn để giữ lại giá trị minPrice và maxPrice khi submit form -->
                        <input type="hidden" name="minPrice" id="hidden-min-price" value="<?php echo $minPrice; ?>">
                        <input type="hidden" name="maxPrice" id="hidden-max-price" value="<?php echo $maxPrice; ?>">
                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                        <!-- Nút submit để gửi form -->
                    </form>
                </div>

                <!-- Bộ lọc giá -->
                <div class="filter-section price-range-container">
                    <h5>Price Range (₫)</h5>
                    <input type="range" class="custom-range" id="price-min-range" min="1000" max="10000000" step="1000" value="<?php echo $minPrice; ?>" oninput="updatePriceRange()">
                    <input type="range" class="custom-range" id="price-max-range" min="1000" max="10000000" step="1000" value="<?php echo $maxPrice; ?>" oninput="updatePriceRange()">
                    <div class="price-range-values">
                        <span>From: <span id="price-min"><?php echo number_format($minPrice); ?></span> ₫</span>
                        <span>To: <span id="price-max"><?php echo number_format($maxPrice); ?></span> ₫</span>
                    </div>
                </div>

              

                <!-- Bộ lọc tiện nghi -->
                <div class="filter-section">
                    <h5>Facilities</h5>
                    <!-- <div id="facilities-list">
                        <div class="form-group">
                            <input type="checkbox" id="wifi" class="mr-1">
                            <label for="wifi">Wifi</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="gym" class="mr-1">
                            <label for="gym">Gymnasium</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="bike" class="mr-1">
                            <label for="bike">Mountain Bike</label>
                        </div>
                        <div class="form-group hidden" id="additional-facilities">
                            <div class="form-group">
                                <input type="checkbox" id="pool" class="mr-1">
                                <label for="pool">Swimming Pool</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="spa" class="mr-1">
                                <label for="spa">Spa</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="restaurant" class="mr-1">
                                <label for="restaurant">Restaurant</label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-link" id="show-more-btn" onclick="toggleFacilities()">Show more</button> -->
                </div>
            </div>

            <!-- Tour Cards Section -->
            <div class="col-md-9">
                <div class="row">
                    <?php if (!empty($tours)) : ?>
                        <?php foreach ($tours as $tour) : ?>
                            <?php
                            $is_in_wishlist = in_array($tour['id'], $wishlist);
                            $review_count = $tour['review_count'] ? $tour['review_count'] : 0;
                            $average_rating = $tour['average_rating'] ? number_format($tour['average_rating'], 1) : 0;
                            ?>
                            <div class="col-md-4 mb-4">
                                <div class="tour-card" data-url="/pages/tour_detail.php?id=<?php echo $tour['id']; ?>">
                                    <div class="card-header1">
                                        <span class="heart-icon <?php echo $is_in_wishlist ? 'heart-red' : ''; ?>" data-tour-id="<?php echo $tour['id']; ?>">♥</span>
                                    </div>
                                    <img src="/admin/anh/<?php echo $tour['image']; ?>" class="card-img-top" alt="Tour Image">
                                    <div class="card-body">
                                        <p class="card-title"><?php echo $tour['tour_name']; ?></p>
                                        <p class="card-text">
                                            <strong style="color: red;">From: <?php echo number_format((float)str_replace(',', '', $tour['price'])); ?> ₫</strong><br>
                                            <span class="time-touring"><i class="fas fa-clock"></i> <?php echo $tour['time_tour']; ?></span>
                                        </p>
                                        <p>
                                            <?php
                                            // Hiển thị các ngôi sao tương ứng với điểm trung bình
                                            $full_stars = floor($average_rating);
                                            $half_star = $average_rating - $full_stars >= 0.5 ? 1 : 0;
                                            $empty_stars = 5 - $full_stars - $half_star;

                                            for ($i = 0; $i < $full_stars; $i++) {
                                                echo '<i class="fas fa-star" style="color:#f8d64e"></i>';
                                            }
                                            if ($half_star) {
                                                echo '<i class="fas fa-star-half-alt" style="color:#f8d64e"></i>';
                                            }
                                            for ($i = 0; $i < $empty_stars; $i++) {
                                                echo '<i class="far fa-star" style="color:#f8d64e"></i>';
                                            }
                                            ?>
                                            <?php echo $average_rating; ?> (<?php echo $review_count; ?> Reviews)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No tours found for the specified criteria.</p>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        var user_id = <?php echo $user_id; ?>;

        $(document).ready(function() {
            // Xử lý sự kiện click vào biểu tượng trái tim
            $('.heart-icon').click(function(event) {
                var heartIcon = $(this);
                var tourId = heartIcon.data('tour-id');
                var isInWishlist = heartIcon.hasClass('heart-red');

                // Toggle class 'heart-red' để thay đổi màu sắc
                heartIcon.toggleClass('heart-red');

                $.ajax({
                    url: isInWishlist ? '/pages/remove_from_wishlist.php' : '/pages/add_to_wishlist.php',
                    type: 'POST',
                    data: {
                        tour_id: tourId,
                        user_id: user_id
                    },
                    success: function(response) {
                        try {
                            response = JSON.parse(response);
                            if (!response.success) {
                                // Nếu có lỗi, toggle lại class để trả về trạng thái ban đầu
                                heartIcon.toggleClass('heart-red');
                                alert('Có lỗi xảy ra. Vui lòng thử lại.');
                            }
                        } catch (e) {
                            heartIcon.toggleClass('heart-red');
                            alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    }
                });

                // Ngăn chặn sự kiện click trên tour-card khi click vào biểu tượng trái tim
                event.stopPropagation();
            });

            // Xử lý sự kiện click vào tour-card
            $('.tour-card').click(function() {
                // Lấy URL từ thuộc tính data-url
                const url = $(this).data('url');
                // Điều hướng đến URL đó
                window.location.href = url;
            });

            // Cập nhật giá trị hiển thị khi thay đổi thanh trượt giá
            $('#price-min-range, #price-max-range').on('input', function() {
                updatePriceRange();
            });

            // Gọi hàm này để cập nhật giá trị hiển thị ban đầu
            updatePriceRange();
        });

        function updatePriceRange() {
            var minRange = document.getElementById('price-min-range');
            var maxRange = document.getElementById('price-max-range');
            var minPrice = document.getElementById('price-min');
            var maxPrice = document.getElementById('price-max');
            var hiddenMinPrice = document.getElementById('hidden-min-price');
            var hiddenMaxPrice = document.getElementById('hidden-max-price');

            // Kiểm tra và điều chỉnh để giá trị min không lớn hơn giá trị max
            if (parseInt(minRange.value) > parseInt(maxRange.value)) {
                minRange.value = maxRange.value;
            }

            // Cập nhật giá trị hiển thị
            minPrice.textContent = parseInt(minRange.value).toLocaleString('en-US');
            maxPrice.textContent = parseInt(maxRange.value).toLocaleString('en-US');

            // Cập nhật giá trị ẩn trong form
            hiddenMinPrice.value = minRange.value;
            hiddenMaxPrice.value = maxRange.value;
        }
    </script>

</body>

</html>

<!-------------feedback footer------------>
<?php require("/laragon/www/dulich/include/function/fback.php"); ?>
<?php require("/laragon/www/dulich/include/footer.php"); ?>