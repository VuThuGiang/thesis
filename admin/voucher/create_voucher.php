<?php
ob_start(); // Bật output buffering

require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
include('/laragon/www/dulich/connection.php'); // Kết nối đến cơ sở dữ liệu

// Kiểm tra nếu có yêu cầu POST (người dùng đã gửi form)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $voucher_code = $_POST['voucher_code'];
    $discount = $_POST['discount'];
    $validity_start = $_POST['validity_start'];
    $validity_end = $_POST['validity_end'];
    $quantity = $_POST['quantity'];
    $created_at = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại

    // Truy vấn để thêm voucher vào cơ sở dữ liệu
    $sql = "INSERT INTO vouchers (voucher_code, discount, validity_start, validity_end, quantity, created_at) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sissis", $voucher_code, $discount, $validity_start, $validity_end, $quantity, $created_at);

    if ($stmt->execute()) {
        // Chuyển hướng với thông báo thành công
        header("Location: vouchers.php?msg=Voucher created successfully");
        exit(); // Ngăn mã PHP tiếp tục chạy
    } else {
        echo "Error: " . $stmt->error;
    }
}

ob_end_flush(); // Kết thúc output buffering và gửi output đến trình duyệt
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Voucher</title>
    <style>
        .form-container {
            margin: 0 auto;
            padding: 30px;
            width: 50%;
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

        .form-group input {
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
        <h2>Create New Voucher</h2>
        <form action="create_voucher.php" method="post">
            <div class="form-group">
                <label for="voucher_code">Voucher Code</label>
                <input type="text" id="voucher_code" name="voucher_code" placeholder="Enter Voucher Code" required>
            </div>
            <div class="form-group">
                <label for="discount">Discount (%)</label>
                <input type="number" id="discount" name="discount" placeholder="Enter Discount Percentage" required>
            </div>
            <div class="form-group">
                <label for="validity_start">Validity Start Date</label>
                <input type="date" id="validity_start" name="validity_start" required>
            </div>
            <div class="form-group">
                <label for="validity_end">Validity End Date</label>
                <input type="date" id="validity_end" name="validity_end" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" placeholder="Enter Quantity" required>
            </div>
            <button type="submit" class="btn-primary">Create Voucher</button>
        </form>
    </div>
</body>
</html>

<?php require("../footer.php"); ?>
