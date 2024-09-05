<?php
include("/laragon/www/dulich/connection.php");

// Hàm tạo mới blog post
function createBlog($con) {
    // Lấy dữ liệu từ form
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $summary = mysqli_real_escape_string($con, $_POST["summary"]);
    $content = mysqli_real_escape_string($con, $_POST["content"]);
    $date = mysqli_real_escape_string($con, $_POST["date"]);
    $imageURL = '';

    // Xử lý tệp hình ảnh nếu có
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']);
        $targetDir = '/admin/anh/';
        $targetFile =  $imageName;

        // Di chuyển tệp đã tải lên thư mục đích
        if (move_uploaded_file($image['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $targetFile)) {
            $imageURL = $targetFile;
        } else {
            die("Error uploading file");
        }
    }

    // Chèn dữ liệu bài viết vào cơ sở dữ liệu
    $sqlInsert = "INSERT INTO blog (title, summary, content, date, image_url) VALUES ('$title', '$summary', '$content', '$date', '$imageURL')";

    if (mysqli_query($con, $sqlInsert)) {
        $blog_id = mysqli_insert_id($con); // Lấy ID của bài viết vừa chèn

        // Xử lý địa điểm
        if (isset($_POST['location']) && is_array($_POST['location'])) {
            foreach ($_POST['location'] as $location_id) {
                $location_id = mysqli_real_escape_string($con, $location_id);
                $sqlInsertLocation = "INSERT INTO location_blog (blog_id, location_id) VALUES ($blog_id, $location_id)";
                if (!mysqli_query($con, $sqlInsertLocation)) {
                    die("Error: " . mysqli_error($con));
                }
            }
        }

        // Xử lý danh mục
        if (isset($_POST['category']) && is_array($_POST['category'])) {
            foreach ($_POST['category'] as $category_id) {
                $category_id = mysqli_real_escape_string($con, $category_id);
                $sqlInsertCate = "INSERT INTO blog_cate (blog_id, cate_id) VALUES ($blog_id, $category_id)";
                if (!mysqli_query($con, $sqlInsertCate)) {
                    die("Error: " . mysqli_error($con));
                }
            }
        }

        // Chuyển hướng đến trang blog với thông báo thành công
        header("Location: blog.php?msg=created");
        exit;
    } else {
        die("Error: " . mysqli_error($con));
    }

    // Đóng kết nối
    mysqli_close($con);
}

// Hàm cập nhật blog post hiện có
function updateBlog($con) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $summary = mysqli_real_escape_string($con, $_POST["summary"]);
    $content = mysqli_real_escape_string($con, $_POST["content"]);
    $date = mysqli_real_escape_string($con, $_POST["date"]);
    $imageURL = '';

    // Xử lý tệp hình ảnh nếu có
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']);
        $targetDir = '/admin/anh/';
        $targetFile =  $imageName;

        // Di chuyển tệp đã tải lên thư mục đích
        if (move_uploaded_file($image['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $targetFile)) {
            $imageURL = $targetFile;
        } else {
            die("Error uploading file");
        }
    }

    if ($imageURL !== '') {
        $sqlUpdate = "UPDATE blog SET title = '$title', summary = '$summary', content = '$content', date = '$date', image_url = '$imageURL' WHERE id = $id";
    } else {
        $sqlUpdate = "UPDATE blog SET title = '$title', summary = '$summary', content = '$content', date = '$date' WHERE id = $id";
    }

    if (mysqli_query($con, $sqlUpdate)) {
        // Xóa các bản ghi hiện tại trong location_blog
        $sqlDeleteLocations = "DELETE FROM location_blog WHERE blog_id = $id";
        mysqli_query($con, $sqlDeleteLocations);

        // Thêm location mới vào bảng location_blog
        if (isset($_POST['location']) && is_array($_POST['location'])) {
            foreach ($_POST['location'] as $location_id) {
                $location_id = mysqli_real_escape_string($con, $location_id);
                $sqlInsertLocation = "INSERT INTO location_blog (blog_id, location_id) VALUES ($id, $location_id)";
                if (!mysqli_query($con, $sqlInsertLocation)) {
                    die("Error: " . mysqli_error($con));
                }
            }
        }

        // Xóa các bản ghi hiện tại trong blog_cate
        $sqlDeleteCate = "DELETE FROM blog_cate WHERE blog_id = $id";
        mysqli_query($con, $sqlDeleteCate);

        // Thêm các cate mới vào bảng blog_cate
        if (isset($_POST['category']) && is_array($_POST['category'])) {
            foreach ($_POST['category'] as $category_id) {
                $category_id = mysqli_real_escape_string($con, $category_id);
                $sqlInsertCate = "INSERT INTO blog_cate (blog_id, cate_id) VALUES ($id, $category_id)";
                if (!mysqli_query($con, $sqlInsertCate)) {
                    die("Error: " . mysqli_error($con));
                }
            }
        }

        // Chuyển hướng đến trang blog
        header("Location: blog.php?msg=updated");
        exit;
    } else {
        die("Error: " . mysqli_error($con));
    }

    // Đóng kết nối
    mysqli_close($con);
}

// Kiểm tra xem form đã được submit chưa và gọi hàm tương ứng
if (isset($_POST["create"])) {
    createBlog($con);
} elseif (isset($_POST["update"])) {
    updateBlog($con);
}
?>
