<?php 
// Bao gồm các tệp cần thiết
require("../header.php");
require('/laragon/www/dulich/admin/sider.php');
require('/laragon/www/dulich/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog Post</title>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
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
            <!-- Trường nhập tiêu đề -->
            <div class="form-field">
                <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
            </div>
            
            <!-- Textarea cho phần tóm tắt -->
            <div class="form-field">
                <textarea name="summary" class="form-control" cols="30" rows="10" placeholder="Enter Summary:" required></textarea>
            </div>

            <!-- Textarea cho nội dung -->
            <div class="form-field">
                <textarea name="content" id="content" class="form-control" cols="30" rows="10" placeholder="Enter Post:" required></textarea>
            </div>

            <!-- Trường tải ảnh -->
            <div class="form-field">
                <input type="file" name="image" class="form-control" required>
            </div>

            <!-- Dropdown cho chọn địa điểm với Select2 -->
            <div class="form-field">
                <label for="locations">Select Location:</label><br>
                <select name="location[]" id="locations" class="form-control" multiple="multiple" required>
                    <option value="" disabled>Select Location</option>
                    <?php
                    // Lấy danh sách địa điểm từ cơ sở dữ liệu
                    $sql = "SELECT id, name FROM location";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        // Duyệt qua kết quả và tạo các option trong dropdown
                        while($row = $result->fetch_assoc()) {
                            echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
                        }
                    } else {
                        echo "<option value=\"\" disabled>No locations available</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Checkbox cho danh mục -->
            <div class="form-field">
                <label for="category">Select Category:</label><br>
                <?php
                // Truy vấn để lấy danh sách các danh mục
                $sql = "SELECT id, name FROM category";
                $result = $con->query($sql);

                // Kiểm tra nếu có danh mục nào trong cơ sở dữ liệu
                if ($result->num_rows > 0) {
                    // Tạo các checkbox cho từng danh mục
                    while($row = $result->fetch_assoc()) {
                        echo '<input type="checkbox" name="category[]" value="' . $row["id"] . '"> ' . $row["name"] . '<br>';
                    }
                } else {
                    echo "No categories found.";
                }
                ?>
            </div>

            <!-- Trường ẩn cho ngày -->
            <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

            <!-- Nút submit -->
            <div class="form-field">
                <input type="submit" value="Submit" class="btn btn-primary" name="create">
            </div>
        </form>
    </div>

    <!-- Bao gồm footer -->
    <?php require("../footer.php") ?>

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
</html>
