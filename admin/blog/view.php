<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
?>

<head>
    <style>
        .post {
            margin-left: 400px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
          
        }

        .post h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 10px;
        }

        .post p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #555;
        }

        .post img {
            margin-top: 20px;
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .post h3 {
            margin-top: 30px;
            font-size: 1.5em;
            color: #333;
            border-bottom: 2px solid #41a728;
            padding-bottom: 10px;
        }

        .post ul {
            list-style-type: disc;
            margin-left: 20px;
            color: #555;
        }

        .post ul li {
            margin-bottom: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .post {
                margin-left: 20px;
                margin-right: 20px;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="post">
        <?php
        $id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;  // Kiểm tra và chuyển đổi id sang kiểu số nguyên

        if ($id) {
            include("/laragon/www/dulich/connection.php");

            // Tăng số lượt xem cho bài viết
            $sqlUpdateViews = "UPDATE `blog` SET `views` = `views` + 1 WHERE `id` = $id";
            mysqli_query($con, $sqlUpdateViews);

            // Truy vấn lấy thông tin bài viết
            $sqlSelectPost = "SELECT * FROM `blog` WHERE id = $id";
            $result = mysqli_query($con, $sqlSelectPost);
            if ($result && mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
        ?>
                <h1><?php echo htmlspecialchars($data['title']); ?></h1>
                <p><?php echo htmlspecialchars($data['date']); ?></p>
                <p style="margin-top: 50px;"><?php echo nl2br(($data['content'])); ?></p>
                <?php if (!empty($data['image_url'])) : ?>
                    <img src="/admin/anh/<?php echo htmlspecialchars($data['image_url']); ?>" alt="Post Image">
                <?php endif; ?>

                <h3>Locations:</h3>
                <ul>
                    <?php
                    // Truy vấn để lấy các location đã chọn của bài viết
                    $sqlBlogLocations = "SELECT l.name 
                                     FROM `location_blog` lb 
                                     JOIN `location` l ON lb.location_id = l.id 
                                     WHERE lb.blog_id = $id";
                    $resultBlogLocations = mysqli_query($con, $sqlBlogLocations);
                    if ($resultBlogLocations && mysqli_num_rows($resultBlogLocations) > 0) {
                        while ($location = mysqli_fetch_assoc($resultBlogLocations)) {
                            echo '<li>' . htmlspecialchars($location['name']) . '</li>';
                        }
                    } else {
                        echo '<li>No locations selected.</li>';
                    }
                    ?>
                </ul>

                <h3>Categories:</h3>
                <ul>
                    <?php
                    // Truy vấn để lấy các category đã chọn của bài viết
                    $sqlBlogCate = "SELECT c.name 
                                FROM `blog_cate` bc 
                                JOIN `category` c ON bc.cate_id = c.id 
                                WHERE bc.blog_id = $id";
                    $resultBlogCate = mysqli_query($con, $sqlBlogCate);
                    if ($resultBlogCate && mysqli_num_rows($resultBlogCate) > 0) {
                        while ($category = mysqli_fetch_assoc($resultBlogCate)) {
                            echo '<li>' . htmlspecialchars($category['name']) . '</li>';
                        }
                    } else {
                        echo '<li>No categories selected.</li>';
                    }
                    ?>
                </ul>
        <?php
            } else {
                echo "<p>Post Not Found</p>";
            }
        } else {
            echo "<p>Post Not Found</p>";
        }
        ?>
    </div>
</body>

<?php require("../footer.php") ?>
