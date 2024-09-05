<?php
require('/laragon/www/dulich/connection.php');
require("/laragon/www/dulich/include/nav.php");

// Lấy id của danh mục từ URL
$category_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($category_id <= 0) {
    die("Invalid category ID.");
}

// Lấy tên danh mục
$category_query = "SELECT name FROM category WHERE id = ?";
$stmt = $con->prepare($category_query);
$stmt->bind_param('i', $category_id);
$stmt->execute();
$category_result = $stmt->get_result();

if ($category_result->num_rows > 0) {
    $category_data = $category_result->fetch_assoc();
    $category_name = $category_data['name'];
} else {
    die("Category not found.");
}
$stmt->close();

// Lấy tất cả bài viết thuộc danh mục
$posts_query = "
    SELECT b.* FROM blog b
    JOIN blog_cate bc ON b.id = bc.blog_id
    WHERE bc.cate_id = ?
";
$stmt = $con->prepare($posts_query);
$stmt->bind_param('i', $category_id);
$stmt->execute();
$posts_result = $stmt->get_result();

$posts = [];
while ($post = $posts_result->fetch_assoc()) {
    $posts[] = $post;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category_name); ?> - Danh mục</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }

        .category-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
            color: #333;
        }

        .post-item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            border: none;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .post-item img {
            border-radius: 8px 8px 0 0;
            margin-bottom: 0;
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .post-item .post-content {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .post-item h3 {
            font-weight: bold;
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .post-item p {
            color: gray;
            font-size: 14px;
            text-align: justify;
        }

        .btn-read-more {
            margin-top: 10px;
            align-self: center;
            background-color: orange;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-transform: uppercase;
            font-size: 0.85rem;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .btn-read-more:hover {
            background-color: #e55a4f;
        }
    </style>

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <?php if (!empty($posts)) : ?>
                <?php foreach ($posts as $post) : ?>
                    <div class="col-md-4" style="margin-top: 20px;">
                        <div class="post-item card h-100">
                            <img src="/admin/anh/<?php echo htmlspecialchars($post['image_url']); ?>" class="card-img-top" alt="Post Image">
                            <div class="post-content card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="small text-muted"><i class="bi bi-chat"></i> <?php echo htmlspecialchars($post['comment_count'] ?? 0); ?> Comments</div>
                                    <div class="small text-muted"><i class="bi bi-calendar"></i> <?php echo htmlspecialchars(date("d M Y", strtotime($post['date']))); ?></div>
                                </div>
                                <h3 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                                <p class="card-text"><?php echo htmlspecialchars($post['summary']); ?></p>
                                <a href="blog_detail.php?id=<?php echo $post['id']; ?>" class="btn1 btn-read-more btn-danger btn-sm">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Không có bài viết nào trong danh mục này.</p>
            <?php endif; ?>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>