<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    include("/laragon/www/dulich/connection.php");

    // Lấy thông tin bài viết
    $sqlEdit = "SELECT * FROM `blog` WHERE `id` = $id";
    $resultBlog = mysqli_query($con, $sqlEdit);

    // Lấy danh sách cate
    $sqlCate = "SELECT id, name FROM category";
    $resultCate = mysqli_query($con, $sqlCate);

    // Lấy danh sách location
    $sqlLocations = "SELECT id, name FROM location";
    $resultLocations = mysqli_query($con, $sqlLocations);

    // Lấy các location đã chọn của bài viết
    $sqlBlogLocations = "SELECT location_id FROM location_blog WHERE blog_id = $id";
    $resultBlogLocations = mysqli_query($con, $sqlBlogLocations);
    $selectedLocationArray = [];
    while ($row = mysqli_fetch_assoc($resultBlogLocations)) {
        $selectedLocationArray[] = $row['location_id'];
    }

    // Lấy các cate đã chọn của bài viết
    $sqlBlogCate = "SELECT cate_id FROM blog_cate WHERE blog_id = $id";
    $resultBlogCate = mysqli_query($con, $sqlBlogCate);
    $selectedCate = [];
    while ($row = mysqli_fetch_assoc($resultBlogCate)) {
        $selectedCate[] = $row['cate_id'];
    }
} else {
    echo "No post found";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    
    <!-- Thêm CSS của Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Thêm jQuery (nếu chưa có) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Thêm JavaScript của Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* CSS để đảm bảo dropdown không quá dài và có thanh cuộn nếu cần */
        #locations {
            max-height: 200px; /* Đảm bảo danh sách không quá dài */
            overflow-y: auto;  /* Thêm cuộn dọc nếu danh sách quá dài */
            width: 100%;       /* Đảm bảo danh sách hiển thị đầy đủ chiều rộng */
        }
    </style>
</head>
<body>
<div class="create-form" style="margin-left: 400px;">
    <form action="/admin/blog/process.php" method="post" enctype="multipart/form-data">
        <?php if ($resultBlog && mysqli_num_rows($resultBlog) > 0) : ?>
            <?php while ($data = mysqli_fetch_assoc($resultBlog)) : ?>
                <div class="form-field">
                    <input type="text" name="title" class="form-control" placeholder="Enter Title:" value="<?php echo htmlspecialchars($data['title']); ?>" id="">
                </div>
                <div class="form-field">
                    <textarea name="summary" class="form-control" cols="30" rows="10" placeholder="Enter Summary:"><?php echo htmlspecialchars($data['summary']); ?></textarea>
                </div>
                <div class="form-field">
                    <textarea name="content" class="form-control" cols="30" rows="10" placeholder="Enter Post:"><?php echo htmlspecialchars($data['content']); ?></textarea>
                </div>
                <div class="form-field">
                    <label>Current Image:</label><br>
                    <?php if (!empty($data['image_url'])) : ?>
                        <img src="/admin/anh/<?php echo htmlspecialchars($data['image_url']); ?>" alt="Current Image" style="max-width: 100px; max-height: 100px;"><br>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control">
                </div>
                <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <!-- Phần select cho các location -->
                <div class="form-field">
                    <label for="location">Select Location:</label><br>
                    <select name="location[]" id="locations" class="form-control" multiple="multiple">
                        <?php
                        if ($resultLocations && mysqli_num_rows($resultLocations) > 0) {
                            while ($row = mysqli_fetch_assoc($resultLocations)) {
                                $selected = in_array($row['id'], $selectedLocationArray) ? 'selected' : '';
                                echo "<option value=\"{$row['id']}\" $selected>{$row['name']}</option>";
                            }
                        } else {
                            echo "<option value=\"\">No locations found</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Phần checkbox cho các cate -->
                <div class="form-field">
                    <label for="category">Select Category:</label><br>
                    <?php if ($resultCate && mysqli_num_rows($resultCate) > 0) : ?>
                        <?php while ($row = mysqli_fetch_assoc($resultCate)) : ?>
                            <?php
                            $checked = in_array($row['id'], $selectedCate) ? 'checked' : '';
                            ?>
                            <input type="checkbox" name="category[]" value="<?php echo $row['id']; ?>" <?php echo $checked; ?>> <?php echo htmlspecialchars($row['name']); ?><br>
                        <?php endwhile; ?>
                    <?php else : ?>
                        No categories found.
                    <?php endif; ?>
                </div>

                <div class="form-field">
                    <input type="submit" value="Submit" class="btn btn-primary" name="update">
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Blog post not found.</p>
        <?php endif; ?>
    </form>
</div>

    <!-- Khởi tạo Select2 -->
    <script>
        $(document).ready(function() {
            $('#locations').select2({
                placeholder: "Select Location", // Văn bản hiển thị mặc định
                allowClear: true                // Cho phép xóa các lựa chọn
            });
        });
    </script>
</body>

<?php require("../footer.php") ?>
