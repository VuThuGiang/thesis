<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
include('/laragon/www/dulich/connection.php');

// Kiểm tra nếu người dùng đã nhập tên tìm kiếm
$search = $_GET['search'] ?? '';

// Sửa đổi truy vấn để tìm kiếm theo tên người dùng nếu có từ khóa tìm kiếm
$sql = "SELECT 
            bookings.booking_id, 
            user_form.full_name, 
            tours.tour_name, 
            bookings.total_price, 
            bookings.payment_status, 
            bookings.booking_date 
        FROM bookings 
        JOIN user_form ON bookings.user_id = user_form.id 
        JOIN tours ON bookings.tour_id = tours.id ";

// Thêm điều kiện tìm kiếm nếu có từ khóa tìm kiếm
if ($search) {
    $sql .= "WHERE user_form.full_name LIKE ? ";
}

$sql .= "ORDER BY bookings.booking_date DESC";

// Chuẩn bị và thực thi truy vấn SQL
$stmt = $con->prepare($sql);

// Nếu có tìm kiếm, bind tham số
if ($search) {
    $search_param = "%" . $search . "%";
    $stmt->bind_param('s', $search_param);
}

$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . $con->error);
}

// Kiểm tra nếu có thông báo trong URL
$message = '';
if (isset($_GET['message']) && $_GET['message'] == 'success') {
    $message = "Edit Successful";
} elseif (isset($_GET['message']) && $_GET['message'] == 'delete_success') {
    $message = "Delete Successful";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking History</title>
    <style>
        .success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            z-index: 1000;
            display: none;
            /* Ẩn thông báo mặc định */
        }

        .paid {
            color: green;
            /* Màu xanh cho trạng thái Paid */
            font-weight: bold;
        }

        .unpaid {
            color: red;
            /* Màu đỏ cho trạng thái Unpaid */
            font-weight: bold;
        }

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var messageElement = document.getElementById('success-message');
            if (messageElement) {
                messageElement.style.display = 'block'; // Hiển thị thông báo
                setTimeout(function() {
                    messageElement.style.display = 'none'; // Ẩn thông báo sau 2 giây
                }, 2000);
            }
        });
    </script>
</head>

<body>
    <!-- Hiển thị thông báo nếu có -->
    <?php if (!empty($message)): ?>
        <div id="success-message" class="success-message"><?php echo $message; ?></div>
    <?php endif; ?>

    <div class="posts-list" style="margin-left: 330px; width: 80%;">
        <h2>User Booking History</h2>

        <!-- Form tìm kiếm -->
        <form method="GET" action="">
            <div class="form-group" style="margin-bottom: 30px; margin-top:30px">
                <input type="text" name="search" placeholder="Search by username" value="<?php echo htmlspecialchars($search); ?>" class="form-control" style="display: inline-block; width: 300px;">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <table class="table table-bordered" style="margin-top: 20px; width: 100%;">
            <thead>
                <tr>
                    <th>ID</th> <!-- Change Booking ID to serial number -->
                    <th>User Name</th>
                    <th>Tour Name</th>
                    <th>Booking Date</th>
                    <th>Total Price (₫)</th>
                    <th>Payment Status</th>
                    <th>Action</th> <!-- Thêm cột Action -->
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1; // Initialize counter variable
                while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $counter++; ?></td> <!-- Display the counter and increment it -->
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['tour_name']); ?></td>
                        <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($row['booking_date']))); ?></td>
                        <td><?php echo number_format($row['total_price'], 0, ',', '.'); ?> ₫</td>
                        <td class="<?php echo strtolower($row['payment_status']); ?>">
                            <?php echo htmlspecialchars($row['payment_status']); ?>
                        </td>
                        <td>
                            <!-- Thêm các nút Action -->
                            <a href="view.php?id=<?php echo $row['booking_id']; ?>" class="btn btn-view">View</a>
                            <a href="edit.php?id=<?php echo $row['booking_id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="delete.php?id=<?php echo $row['booking_id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

<?php require("../footer.php"); ?>