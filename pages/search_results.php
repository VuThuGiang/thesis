<?php
include('/laragon/www/dulich/connection.php');
require("/laragon/www/dulich/include/nav.php");

// Lấy thông tin địa điểm từ GET request
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';

// Kiểm tra xem người dùng đã nhập địa điểm chưa
if (empty($destination)) {
    echo "Vui lòng nhập tên địa điểm để tìm kiếm.";
    exit;
}

// Tìm kiếm địa điểm trong cơ sở dữ liệu
$sql = "SELECT * FROM `location` WHERE `name` LIKE ?";
$stmt = $con->prepare($sql);
$search_term = '%' . $destination . '%';
$stmt->bind_param('s', $search_term);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra xem địa điểm có tồn tại không
if ($result && $result->num_rows > 0) {
    $location = $result->fetch_assoc();
    $locationId = $location['id'];
} else {
    $location = null; // Gán $location là null nếu không có kết quả
}
?>

<?php require("/laragon/www/dulich/include/Hdes_view.php");
require("/laragon/www/dulich/include/Hsearch_result.php") ?>

<body>
    <!-- Header -->
    <?php if ($location) : ?>
        <section style="background-image: url('/admin/anh/<?php echo htmlspecialchars($location['image_url']); ?>'); width: 100%; height: 120%; background-position: center bottom; background-size: cover;" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                    <div class="col-md-9 ftco-animate pb-5 text-center">
                        <h1 class="mb1-3 bread" style="margin-block-start: 150px; color: white; font-size: 100px;"><?php echo htmlspecialchars($location['name']); ?></h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Icon Bar -->
        <nav class="icon-bar" style="margin-block-start:-45px">
            <div class="container5">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link text-center" href="?id=<?php echo $locationId; ?>&category=destination&destination=<?php echo urlencode($destination); ?>">
                            <i class="bi bi-geo-fill"></i>
                            <div style="font-size: 16px;">Địa Điểm Vui Chơi<br>Tham Quan</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="?id=<?php echo $locationId; ?>&category=food&destination=<?php echo urlencode($destination); ?>">
                            <i class="bi bi-cup-hot-fill"></i>
                            <div style="font-size: 16px;">Ẩm Thực</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="?id=<?php echo $locationId; ?>&category=hotel&destination=<?php echo urlencode($destination); ?>">
                            <i class="bi bi-house-heart-fill"></i>
                            <div style="font-size: 16px;">Lưu Trú</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="?id=<?php echo $locationId; ?>&category=tour&destination=<?php echo urlencode($destination); ?>">
                            <i class="fas fa-bus"></i>
                            <div style="font-size: 16px;">Tour</div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="container my-5" style="margin-top: 5rem !important;">
            <?php
            // Kiểm tra xem người dùng đã chọn danh mục nào từ "Icon Bar"
            $selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

            if ($selectedCategory) {
                // Hiển thị các bài viết hoặc tour theo danh mục đã chọn
                if ($selectedCategory === 'tour') {
                    display_tours_section($con, $locationId); // Display tours if 'tour' is selected
                } else {
                    display_category_section($con, $locationId, $selectedCategory, 'Kết quả tìm kiếm');
                }
            } else {
                // Nếu không chọn danh mục nào, hiển thị tất cả các bài viết mặc định
                display_category_section($con, $locationId, 'destination', 'Trải Nghiệm Hot Nhất');
                display_category_section($con, $locationId, 'food', 'Ẩm Thực Đặc Sản');
                display_category_section($con, $locationId, 'hotel', 'Khách Sạn Nổi Bật');
                display_category_section($con, $locationId, 'advice', 'Sổ Tay Du Lịch Đà Nẵng');
                display_tours_section($con, $locationId); // Display tours by default
            }
            ?>
        </main>

    <?php else : ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                Địa điểm không tồn tại hoặc có lỗi xảy ra khi lấy thông tin địa điểm.
            </div>
        </div>
    <?php endif; ?>

    <!-- Thêm Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
function display_category_section($con, $location_id, $category_name, $section_title)
{
    if ($section_title == 'Kết quả tìm kiếm') {
        $section_title = ucfirst($category_name);
    }

    echo '<h2 class="blog-section-title">' . htmlspecialchars($section_title) . '</h2>';
    echo '<div class="row">';
    $blogs = get_blogs_by_category($con, $location_id, $category_name);
    display_blogs($blogs);
    echo '</div>';
}

function get_blogs_by_category($con, $location_id, $category_name)
{
    $blogs = [];
    $category_id = null;
    $filtered_blog_ids = [];

    $query = "SELECT id FROM category WHERE name = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $category_name);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $category_id = $row['id'];
    }
    $stmt->close();

    if ($category_id) {
        $query = "SELECT blog_id FROM blog_cate WHERE cate_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $filtered_blog_ids[] = $row['blog_id'];
        }
        $stmt->close();
    }

    if (!empty($filtered_blog_ids)) {
        $placeholders = implode(',', array_fill(0, count($filtered_blog_ids), '?'));
        $query = "SELECT blog.*, blog.date, (SELECT COUNT(*) FROM comments WHERE comments.blog_id = blog.id) AS comment_count FROM location_blog JOIN blog ON location_blog.blog_id = blog.id WHERE location_blog.location_id = ? AND blog.id IN ($placeholders)";
        $stmt = $con->prepare($query);

        $types = 'i' . str_repeat('i', count($filtered_blog_ids));
        $params = array_merge([$types, $location_id], $filtered_blog_ids);
        $stmt->bind_param(...$params);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $blogs[] = $row;
            }
        }
        $stmt->close();
    }

    return $blogs;
}

function display_blogs($blogs)
{
    foreach ($blogs as $blog_data) {
        echo '<div class="col-md-4">';
        echo '<div class="card h-100">
            <img src="/admin/anh/' . htmlspecialchars($blog_data['image_url']) . '" class="card-img-top" alt="Image" style="height: 220px">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="small text-muted"><i class="bi bi-chat"></i> ' . htmlspecialchars($blog_data['comment_count']) . ' Comments</div>
                    <div class="small text-muted"><i class="bi bi-calendar"></i> ' . htmlspecialchars(date("d M Y", strtotime($blog_data['date']))) . '</div>
                </div>
                <h5 class="card-title" style="font-weight: 50px">' . htmlspecialchars($blog_data['title']) . '</h5>
                <p class="card-text1">' . htmlspecialchars($blog_data['summary']) . '</p>
                <a href="blog_detail.php?id=' . htmlspecialchars($blog_data['id']) . '" class="btn1 btn-danger btn-sm">Learn More</a>
            </div>
        </div>';
        echo '</div>';
    }
}

function display_tours_section($con, $location_id)
{
    echo '<h2 class="blog-section-title">Các Tour Tại Địa Điểm</h2>';
    echo '<div class="row">';

    $query = "SELECT * FROM tours WHERE location_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $location_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($tour = $result->fetch_assoc()) {
        echo '<div class="col-md-4">';
        echo '<div class="tour-card">
                <img src="/admin/anh/' . htmlspecialchars($tour['image']) . '" class="card-img-top" alt="Tour Image">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($tour['tour_name']) . '</h5>
                    <p class="price">From: ' . number_format($tour['price']) . ' ₫</p>
                    <div class="time-touring"><i class="fas fa-clock"></i> ' . htmlspecialchars($tour['time_tour']) . '</div>
                    <a href="tour_detail.php?id=' . htmlspecialchars($tour['id']) . '" class="btn btn-primary">Xem Chi Tiết</a>
                </div>
            </div>';
        echo '</div>';
    }

    echo '</div>';
}
?>

<?php require("/laragon/www/dulich/include/footer.php"); ?>
