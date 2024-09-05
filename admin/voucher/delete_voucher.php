<?php
include('/laragon/www/dulich/connection.php'); // Kết nối đến cơ sở dữ liệu

if (isset($_GET['id'])) {
    $voucher_id = $_GET['id'];

    // Bắt đầu một giao dịch để đảm bảo tất cả các câu lệnh đều thực thi thành công hoặc không có câu lệnh nào được thực thi
    $con->begin_transaction();

    try {
        // Xóa tất cả các bản ghi trong bảng 'tour_voucher' hoặc bảng liên kết liên quan đến voucher này
        $sql = "DELETE FROM tour_voucher WHERE voucher_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $voucher_id);
        $stmt->execute();
        $stmt->close();

        // Xóa voucher trong bảng 'vouchers'
        $sql = "DELETE FROM vouchers WHERE voucher_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $voucher_id);
        $stmt->execute();
        $stmt->close();

        // Nếu mọi thứ đều ổn, commit giao dịch
        $con->commit();

        header('Location: vouchers.php?msg=Voucher and related tours deleted successfully');
        exit();
    } catch (Exception $e) {
        // Nếu có lỗi, rollback (khôi phục) giao dịch
        $con->rollback();
        echo "Error deleting voucher and related tours: " . $e->getMessage();
    }

    // Đóng kết nối
    $con->close();
}
