<?php
require('/laragon/www/dulich/connection.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Kiểm tra tour tồn tại
    $sql = "SELECT image FROM tours WHERE id = $id";
    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        $tour = $result->fetch_assoc();

        // Xóa hình ảnh liên quan đến tour, nếu cần thiết
        if (!empty($tour['image'])) {
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/admin/anh/" . $tour['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa hình ảnh từ server
            }
        }

        // Xóa các bản ghi liên quan trong các bảng mà tour là khóa ngoại
        $relatedTables = [
            'reviews' => 'tour_id',
            'bookings' => 'tour_id',
            'tour_voucher' => 'tour_id',
            'wishlist' => 'tour_id',
            'tour_variants' => 'tour_id',
            'tour_attribute_values' => 'tour_id',



            // Thay thế bằng tên bảng thực tế nếu cần
            // Thêm các bảng liên quan khác ở đây
            // em, em liệt kê cho anh những bảng mà tour nó có thể nằm: voucher, variant, bookings, reviews, attribute, wishlist em ghi hết ra cho anh 
        ];

        foreach ($relatedTables as $table => $foreignKey) {
            $sql = "DELETE FROM $table WHERE $foreignKey = $id";
            $con->query($sql);
        }

        // Xóa tour khỏi cơ sở dữ liệu
        $sql = "DELETE FROM tours WHERE id = $id";
        if ($con->query($sql) === TRUE) {
            header("Location: tour.php?msg=Tour has been successfully deleted!");
            exit();
        } else {
            echo "Error deleting record: " . $con->error;
        }
    } else {
        echo "Tour not found.";
    }
} else {
    echo "Invalid tour ID.";
}

$con->close();
