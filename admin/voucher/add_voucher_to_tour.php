<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
include('/laragon/www/dulich/connection.php');

// Lấy danh sách tất cả các tours và vouchers
$tours = mysqli_query($con, "SELECT id, tour_name FROM tours");
$vouchers = mysqli_query($con, "SELECT voucher_id, voucher_code FROM vouchers");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tour_id = $_POST['tour_id'];
    $voucher_id = $_POST['voucher_id'];

    $sql = "INSERT INTO tour_voucher (tour_id, voucher_id) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $tour_id, $voucher_id);
    if ($stmt->execute()) {
        // Sử dụng JavaScript để hiển thị thông báo và chuyển hướng
        echo "<script>
                alert('Voucher added to tour successfully');
                window.location.href = 'vouchers.php';
              </script>";
        exit(); // Ngăn mã PHP tiếp tục chạy
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Voucher to Tour</title>
    <style>
        .form-container {
            margin: 0 auto;
            padding: 30px;
            width: 60%;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 350px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-primary {
            display: block;
            width: 100%;
            background-color: #41a728;
            color: #fff;
            padding: 12px 0;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
        }

        .btn-primary:hover {
            background-color: #388e3c;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add Voucher to Tour</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="tour_id">Select Tour:</label>
                <select class="form-control" id="tour_id" name="tour_id" required>
                    <?php while ($tour = mysqli_fetch_assoc($tours)) : ?>
                        <option value="<?php echo $tour['id']; ?>"><?php echo htmlspecialchars($tour['tour_name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="voucher_id">Select Voucher:</label>
                <select class="form-control" id="voucher_id" name="voucher_id" required>
                    <?php while ($voucher = mysqli_fetch_assoc($vouchers)) : ?>
                        <option value="<?php echo $voucher['voucher_id']; ?>"><?php echo htmlspecialchars($voucher['voucher_code']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn-primary">Add Voucher to Tour</button>
        </form>
    </div>
</body>

<?php require("../footer.php"); ?>
