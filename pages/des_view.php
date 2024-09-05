<?php
include('/laragon/www/dulich/connection.php');
require("/laragon/www/dulich/include/nav.php");

// Lấy location_id từ GET request
$locationId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$location = null;

// Nếu locationId > 0, lấy thông tin địa điểm từ cơ sở dữ liệu
if ($locationId > 0) {
    $sql = "SELECT * FROM `location` WHERE `id` = $locationId";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $location = mysqli_fetch_assoc($result);
    } else {
        $location = null;
    }
} else {
    echo "Invalid location ID.";
    exit;
}
?>


<?php require("/laragon/www/dulich/include/Hdes_view.php") ?>

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
                        <a class="nav-link text-center" href="?id=<?php echo $locationId; ?>&category=destination">
                            <i class="bi bi-geo-fill"></i>
                            <div style="font-size: 16px;">Địa Điểm Vui Chơi<br>Tham Quan</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="?id=<?php echo $locationId; ?>&category=food">
                            <i class="bi bi-cup-hot-fill"></i>
                            <div style="font-size: 16px;">Ẩm Thực</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="?id=<?php echo $locationId; ?>&category=hotel">
                            <i class="bi bi-house-heart-fill"></i>
                            <div style="font-size: 16px;">Lưu Trú</div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php else : ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                Địa điểm không tồn tại hoặc có lỗi xảy ra khi lấy thông tin địa điểm.
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="container my-5" style="margin-top: 5rem !important;">
        <?php
        // Kiểm tra xem người dùng đã chọn danh mục nào từ "Icon Bar"
        $selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

        if ($selectedCategory) {
            // Hiển thị các bài viết theo danh mục đã chọn
            display_category_section($con, $locationId, $selectedCategory, 'Kết quả tìm kiếm');
        } else {
            // Nếu không chọn danh mục nào, hiển thị tất cả các bài viết mặc định
            display_category_section($con, $locationId, 'destination', 'Trải Nghiệm Hot Nhất');
            display_category_section($con, $locationId, 'food', 'Ẩm Thực Đặc Sản');
            display_category_section($con, $locationId, 'hotel', 'Khách Sạn Nổi Bật');
            display_category_section($con, $locationId, 'advice', 'Sổ Tay Du Lịch Đà Nẵng');
        }
        ?>
    </main>

    <!-- Thêm Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
function display_category_section($con, $location_id, $category_name, $section_title)
{
    // Thêm kiểm tra để thay đổi tiêu đề theo danh mục
    if ($section_title == 'Kết quả tìm kiếm') {
        $section_title = ucfirst($category_name); // Chuyển đổi chữ cái đầu thành chữ hoa cho đẹp
    }

    echo '<h2 class="blog-section-title">' . htmlspecialchars($section_title) . '</h2>'; // Sử dụng lớp CSS mới
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

    // Lấy category_id từ category_name
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

    // Lấy danh sách blog_id thuộc category
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

    // Lấy blog theo location_id và blog_id thuộc category và đếm số lượng comments
    if (!empty($filtered_blog_ids)) {
        $placeholders = implode(',', array_fill(0, count($filtered_blog_ids), '?'));
        $query = "SELECT blog.*, blog.date, (SELECT COUNT(*) FROM comments WHERE comments.blog_id = blog.id) AS comment_count FROM location_blog JOIN blog ON location_blog.blog_id = blog.id WHERE location_blog.location_id = ? AND blog.id IN ($placeholders)";
        $stmt = $con->prepare($query);

        // Gắn các tham số cho query
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
?>

<?php require("/laragon/www/dulich/include/footer.php"); ?>