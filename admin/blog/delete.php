<?php
$id = $_GET["id"];
if ($id) {
    include("/laragon/www/dulich/connection.php");

    $id = mysqli_real_escape_string($con, $id);
    mysqli_begin_transaction($con);

    try {
        // Xóa tất cả các liên kết của bài viết với các địa điểm (location) từ bảng location_blog
        $sqlDeleteLocationBlog = "DELETE FROM `location_blog` WHERE `blog_id` = ?";
        $stmtLocationBlog = mysqli_prepare($con, $sqlDeleteLocationBlog);

        if ($stmtLocationBlog) {
            mysqli_stmt_bind_param($stmtLocationBlog, 'i', $id);
            $resultLocationBlog = mysqli_stmt_execute($stmtLocationBlog);
            mysqli_stmt_close($stmtLocationBlog);

            if (!$resultLocationBlog) {
                mysqli_rollback($con);
                die("Error: Could not delete from `location_blog`. " . mysqli_error($con));
            }
        } else {
            mysqli_rollback($con);
            die("Error: Could not prepare SQL statement for `location_blog`. " . mysqli_error($con));
        }

        // Xóa tất cả các liên kết của bài viết với các danh mục (category) từ bảng blog_cate
        $sqlDeleteBlogCategory = "DELETE FROM `blog_cate` WHERE `blog_id` = ?";
        $stmtBlogCategory = mysqli_prepare($con, $sqlDeleteBlogCategory);

        if ($stmtBlogCategory) {
            mysqli_stmt_bind_param($stmtBlogCategory, 'i', $id);
            $resultBlogCategory = mysqli_stmt_execute($stmtBlogCategory);
            mysqli_stmt_close($stmtBlogCategory);

            if (!$resultBlogCategory) {
                mysqli_rollback($con);
                die("Error: Could not delete from `blog_cate`. " . mysqli_error($con));
            }
        } else {
            mysqli_rollback($con);
            die("Error: Could not prepare SQL statement for `blog_cate`. " . mysqli_error($con));
        }

        // Xóa bài viết chính từ bảng blog
        $sqlDeleteBlog = "DELETE FROM `blog` WHERE `id` = ?";
        $stmtBlog = mysqli_prepare($con, $sqlDeleteBlog);

        if ($stmtBlog) {
            mysqli_stmt_bind_param($stmtBlog, 'i', $id);
            $resultBlog = mysqli_stmt_execute($stmtBlog);
            mysqli_stmt_close($stmtBlog);

            if ($resultBlog) {
                // Nếu xóa thành công từ cả ba bảng, commit giao dịch
                mysqli_commit($con);
                header("Location: blog.php?msg=deleted");
                exit;
            } else {
                mysqli_rollback($con);
                die("Error: Could not delete from `blog`. " . mysqli_error($con));
            }
        } else {
            mysqli_rollback($con);
            die("Error: Could not prepare SQL statement for `blog`. " . mysqli_error($con));
        }
    } catch (Exception $e) {
        // Rollback giao dịch nếu có bất kỳ ngoại lệ nào xảy ra
        mysqli_rollback($con);
        die("Exception: " . $e->getMessage());
    }

    // Đóng kết nối cơ sở dữ liệu
    mysqli_close($con);
} else {
    echo "Post not found";
}
?>
