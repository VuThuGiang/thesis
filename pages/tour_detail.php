<?php
require('/laragon/www/dulich/connection.php');
require('/laragon/www/dulich/include/nav.php');

// Lấy id từ URL
$tour_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$tour_id) {
    die("Tour ID is required.");
}

// Lấy thông tin chi tiết về tour
$query = "SELECT * FROM tours WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $tour_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $tour_data = $result->fetch_assoc();
} else {
    die("Tour not found.");
}
$stmt->close();

// Giải mã JSON của hành trình
$itinerary = json_decode($tour_data['Itinerary'], true);

// Kiểm tra xem $itinerary có phải là mảng hợp lệ không
if (!is_array($itinerary)) {
    $itinerary = []; // Khởi tạo thành mảng rỗng nếu không hợp lệ
}

// Lấy số lượng và tổng điểm trung bình đánh giá
$query = "SELECT COUNT(*) as total_reviews, AVG(rating) as average_rating FROM reviews WHERE tour_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $tour_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $review_data = $result->fetch_assoc();
    $total_reviews = $review_data['total_reviews'];
    $average_rating = $review_data['average_rating'] !== null ? round($review_data['average_rating'], 1) : 0;
} else {
    $total_reviews = 0;
    $average_rating = 0;
}
$stmt->close();

// Thiết lập các biến phân trang
$comments_per_page = 2;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $comments_per_page;

// Truy vấn tổng số bình luận để tính số trang
$query = "SELECT COUNT(*) as total_reviews FROM reviews WHERE tour_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $tour_id);
$stmt->execute();
$result = $stmt->get_result();
$total_reviews_data = $result->fetch_assoc();
$total_reviews = $total_reviews_data['total_reviews'];
$total_pages = ceil($total_reviews / $comments_per_page);
$stmt->close();

// Truy vấn bình luận với giới hạn và bù trừ
$query = "SELECT r.*, u.username, u.img FROM reviews r JOIN user_form u ON r.user_id = u.id WHERE r.tour_id = ? LIMIT ?, ?";
$stmt = $con->prepare($query);
$stmt->bind_param('iii', $tour_id, $offset, $comments_per_page);
$stmt->execute();
$reviews_result = $stmt->get_result();

$reviews = [];
if ($reviews_result->num_rows > 0) {
    while ($review = $reviews_result->fetch_assoc()) {
        $reviews[] = $review;
    }
}
$stmt->close();
?>
<?php require("/laragon/www/dulich/include/Htour_detail.php") ?>
<body>
    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/admin/anh/<?php echo htmlspecialchars($tour_data['image']); ?>');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb1-3 bread"></h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-5">
        <div class="row">
            <div>
                <div class="card mb-4" style="border: none; position: relative;">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo htmlspecialchars($tour_data['tour_name']); ?></h2>
                        <div class="d-flex justify-content-between">
                        </div>
                        <div class="d-flex justify-content-around text-center my-3">
                            <div>
                                <i class="fas fa-users"></i>
                                <p>Max People: <?php echo htmlspecialchars($tour_data['quantity']); ?></p>
                            </div>
                            <div>
                                <i class="fas fa-wifi"></i>
                                <p>Wifi Available</p>
                            </div>
                            <div>
                                <i class="fas fa-user"></i>
                                <p>Min Age: 12+</p>
                            </div>
                        </div>
                        <h5>Description</h5>
                        <p><?php echo htmlspecialchars($tour_data['description']); ?></p>

                       

                        <!-- Price ------>
                        <h5>Price</h5>
                        <table class="pricing-table mx-auto">
                            <thead>
                                <tr>
                                    <th>Người lớn</th>
                                    <th>Trẻ em</th>
                                    <th>ĐẶT TOUR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="price-value"><?php echo number_format((float)str_replace(',', '', $tour_data['adult_price'])); ?>₫</td>
                                    <td class="price-value"><?php echo number_format((float)str_replace(',', '', $tour_data['child_price'])); ?>₫</td>
                                    <td class="btn-book"><button class="btn tour-button" onclick="handleBookNow()">ĐẶT TOUR</button></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- New Section for Tour Price Information -->
                        <h5>Trong Tour bao gồm</h5>
                        <ul>
                            <li>3-star hotel, standard: 2 or 3 guests per room per night.</li>
                        </ul>
                        <h5>Tour chưa bao gồm</h5>
                        <ul>
                            <li>VAT invoices.</li>
                        </ul>
                        <h5>Biến thể ở đây</h5>
                        <ul>
                            <li>Children under 5 years old: Free.</li>
                        </ul>
                        <h5>Bạn nên mang gì ?</h5>
                        <ul>
                            <li>Comfortable walking shoes.</li>
                        </ul>
                        <h5>Ghi chú</h5>
                        <ul>
                            <li>The tour price we provide is an all-inclusive price, NO HIDDEN FEES.</li>
                        </ul>
                    </div>
                </div>

                <div id="itinerary">
                    <h5 class="mt-4 mb-3 text-center">Hành trình & Giới thiệu</h5>
                    <table class="itinerary-table">
                        <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Nội Dung</th>
                                <th>Buổi Sáng</th>
                                <th>Buổi Trưa</th>
                                <th>Buổi Chiều</th>
                                <th>Buổi Tối</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($itinerary as $dayKey => $dayData) : ?>
                                <tr>
                                    <!-- Hiển thị ngày bắt đầu từ 1 -->
                                    <td class="itinerary-day"><?php echo htmlspecialchars($dayKey + 1); ?></td>
                                    <td class="itinerary-activity"><?php echo htmlspecialchars($dayData['title']); ?></td>
                                    <td>
                                        <?php
                                        if (isset($dayData['activities']['morning'])) {
                                            if (is_array($dayData['activities']['morning'])) {
                                                echo '<ul>';
                                                foreach ($dayData['activities']['morning'] as $activity) {
                                                    echo '<li>' . htmlspecialchars($activity) . '</li>';
                                                }
                                                echo '</ul>';
                                            } else {
                                                echo htmlspecialchars($dayData['activities']['morning']);
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (isset($dayData['activities']['noon'])) {
                                            if (is_array($dayData['activities']['noon'])) {
                                                echo '<ul>';
                                                foreach ($dayData['activities']['noon'] as $activity) {
                                                    echo '<li>' . htmlspecialchars($activity) . '</li>';
                                                }
                                                echo '</ul>';
                                            } else {
                                                echo htmlspecialchars($dayData['activities']['noon']);
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (isset($dayData['activities']['afternoon'])) {
                                            if (is_array($dayData['activities']['afternoon'])) {
                                                echo '<ul>';
                                                foreach ($dayData['activities']['afternoon'] as $activity) {
                                                    echo '<li>' . htmlspecialchars($activity) . '</li>';
                                                }
                                                echo '</ul>';
                                            } else {
                                                echo htmlspecialchars($dayData['activities']['afternoon']);
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (isset($dayData['activities']['evening'])) {
                                            if (is_array($dayData['activities']['evening'])) {
                                                echo '<ul>';
                                                foreach ($dayData['activities']['evening'] as $activity) {
                                                    echo '<li>' . htmlspecialchars($activity) . '</li>';
                                                }
                                                echo '</ul>';
                                            } else {
                                                echo htmlspecialchars($dayData['activities']['evening']);
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

                <div class="review-section">
                    <h2 class="mt-4 mb-3 text-center">User reviews</h2>
                    <div class="average-rating-container">
                        <div class="average-rating">
                            <div class="rating-value"><?php echo $average_rating; ?></div>
                            <div class="stars">
                                <?php for ($i = 0; $i < floor($average_rating); $i++) : ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php if ($average_rating - floor($average_rating) >= 0.5) : ?>
                                    <i class="fas fa-star-half-alt"></i>
                                <?php endif; ?>
                                <?php for ($i = ceil($average_rating); $i < 5; $i++) : ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="total-reviews"><?php echo $total_reviews; ?> Comments</div>
                    </div>
                    <?php if (!empty($reviews)) : ?>
                        <?php foreach ($reviews as $review) : ?>
                            <div class="review-item">
                                <div class="review-header">
                                    <img src="/assets/img/profile/<?php echo htmlspecialchars($review['img']); ?>" alt="User Image" class="user-img">
                                    <div>
                                        <div class="username"><?php echo htmlspecialchars($review['username']); ?></div>
                                        <div class="rating">
                                            <?php for ($i = 0; $i < $review['rating']; $i++) : ?>
                                                <i class="fas fa-star"></i>
                                            <?php endfor; ?>
                                            <?php for ($i = $review['rating']; $i < 5; $i++) : ?>
                                                <i class="far fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="created-at"><?php echo htmlspecialchars($review['created_at']); ?></div>
                                    </div>
                                </div>
                                <div class="review-text"><?php echo htmlspecialchars($review['review']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-center">There are no reviews.</p>
                    <?php endif; ?>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php if ($current_page > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?id=<?php echo $tour_id; ?>&page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?id=<?php echo $tour_id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($current_page < $total_pages) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?id=<?php echo $tour_id; ?>&page=<?php echo $current_page + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script>
        // This function handles the "Book Now" button click
        function handleBookNow() {
            // Get the tour ID from the PHP variable
            var tourId = <?php echo json_encode($tour_id); ?>;
            // Redirect to the booking page with the tour ID
            window.location.href = '/pages/booking.php?id=' + tourId;
        }
    </script>
</body>

</html>

<!-------------feedback footer------------>
<?php require("/laragon/www/dulich/include/footer.php"); ?>