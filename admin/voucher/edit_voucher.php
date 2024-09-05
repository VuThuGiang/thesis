<?php
include('/laragon/www/dulich/connection.php'); // Kết nối đến cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voucher_id = $_POST['voucher_id'];
    $voucher_code = $_POST['voucher_code'];
    $discount = $_POST['discount'];
    $validity_start = $_POST['validity_start'];
    $validity_end = $_POST['validity_end'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE vouchers SET voucher_code=?, discount=?, validity_start=?, validity_end=?, quantity=? WHERE voucher_id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sissii", $voucher_code, $discount, $validity_start, $validity_end, $quantity, $voucher_id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
    $stmt->close();
    $con->close();
}
