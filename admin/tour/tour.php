<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
include('/laragon/www/dulich/connection.php');

// Lấy dữ liệu từ bảng tours và location với LEFT JOIN để lấy tên địa điểm
$sql = "SELECT tours.*, location.name AS location_name FROM tours 
        LEFT JOIN location ON tours.location_id = location.id";
$result = mysqli_query($con, $sql);

// Khởi tạo biến đếm số thứ tự
$counter = 1;
?>

<body>
    <div class="posts-list" style="margin-left: 330px; width: 95%;">
        <h2>List Of Tours</h2>
        <a href="/admin/tour/create_tour.php" style="margin-left: 35px; margin-top: 25px;" class="btn btn-add">Add new tour</a>
        <?php
        if (isset($_GET['msg'])) {
            echo '<div id="alert-box" class="alert alert-success">' . htmlspecialchars($_GET['msg']) . '</div>';
        }
        ?>

        <table class="table table-borderd" style="margin-top: 20px; width: 80%;">
            <thead>
                <tr>
                    <th>STT</th> <!-- Đổi tên cột Id thành STT (số thứ tự) -->
                    <th style="width: 13%;">Tour Name</th>
                    <th style="width: 25%;">Description</th>
                    <th>Image</th>
                    <th>Location</th> <!-- Thêm cột Location vào đây -->
                    <th>Adult Price</th>
                    <th>Child Price</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_assoc($result)) {
                    // Truncate the description to 150 characters
                    $description = $data["description"];
                    $short_description = strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;
                ?>
                    <tr>
                        <td><?php echo $counter++; ?></td> <!-- Hiển thị số thứ tự và tăng giá trị lên 1 -->
                        <td><?php echo htmlspecialchars($data["tour_name"]); ?></td>
                        <td><?php echo htmlspecialchars($short_description); ?></td>
                        <td>
                            <img src="/admin/anh/<?php echo htmlspecialchars($data['image']); ?>" style="width: 80px; height: 60px;">
                        </td>
                        <td><?php echo htmlspecialchars($data["location_name"]); ?></td> <!-- Hiển thị cột Location -->
                        <td><?php echo $data["adult_price"]; ?></td>
                        <td><?php echo $data["child_price"]; ?></td>
                        <td><?php echo $data["price"]; ?></td>
                        <td>
                            <a href="view.php?id=<?php echo $data["id"]; ?>" class="btn btn-view">View</a>
                            <a href="edit.php?id=<?php echo $data["id"]; ?>" class="btn btn-edit">Edit</a>
                            <a href="delete.php?id=<?php echo $data["id"]; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this tour?');">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Tự động ẩn thông báo sau 2 giây
        setTimeout(function() {
            var alertBox = document.getElementById('alert-box');
            if (alertBox) {
                alertBox.style.opacity = '0';
                setTimeout(function() {
                    alertBox.style.display = 'none';
                }, 500); // Chờ thêm 0.5s sau khi ẩn trước khi xóa hoàn toàn
            }
        }, 2000);
    </script>

    <script src="../assets/js/tour.js"></script>
</body>

<?php require("../footer.php") ?>
