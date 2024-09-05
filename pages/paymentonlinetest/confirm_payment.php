<?php
require('/laragon/www/dulich/connection.php');

// Hàm gọi API của Casso để lấy danh sách giao dịch
function getCassoTransactions()
{
    $url = 'https://oauth.casso.vn/v2/transactions?page=&pageSize=100&sort=DESC';
    $headers = [
        'Authorization: Apikey AK_CS.ed8736004cf311ef9068f9e08e26656f.BfpS8ICmwXe4d4spx4uOeSerD1Xci1uqy8a31eNQfFPKADhcqlUoinkWWWs6EoKut9bP2UEq',
        'Content-Type: application/json',
    ];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) {
        die("Failed to fetch transactions from Casso API.");
    }

    $data = json_decode($response, true);

    if (!isset($data['data']['records'])) {
        die("Invalid response from Casso API.");
    }
    return $data;
}

// Hàm để trích xuất mã đơn hàng từ mô tả
function extractOrderIdFromDescription($description)
{
    preg_match('/MDH(\d+)/', $description, $matches);
    if (!isset($matches[1])) {
        return false;
    }
    return $matches[1];
}

// Hàm để cập nhật trạng thái thanh toán trong cơ sở dữ liệu
function updatePaymentStatus($booking_id, $con)
{
    $payment_status = '';
    $sql_check_payment_status = "SELECT payment_status FROM payments WHERE booking_id = ?";
    $stmt_check_payment_status = $con->prepare($sql_check_payment_status);
    $stmt_check_payment_status->bind_param("i", $booking_id);
    $stmt_check_payment_status->execute();
    $stmt_check_payment_status->bind_result($payment_status);
    $stmt_check_payment_status->fetch();
    $stmt_check_payment_status->close();

    if ($payment_status === 'pending') {
        $sql_update_payment = "UPDATE payments SET payment_status = 'completed' WHERE booking_id = ?";
        $stmt_update_payment = $con->prepare($sql_update_payment);
        $stmt_update_payment->bind_param("i", $booking_id);
        $stmt_update_payment->execute();
        $stmt_update_payment->close();
    }
}

// Hàm để kiểm tra và xử lý các thanh toán
function checkAndProcessPayments($con, $booking_id)
{
    $transactions = getCassoTransactions();
    foreach ($transactions['data']['records'] as $record) {
        $orderId = extractOrderIdFromDescription($record['description']);
        if ($orderId == $booking_id) {
            updatePaymentStatus($orderId, $con);
            return true;
        }
    }
    return false;
}

$booking_id = $_POST['booking_id'] ?? null;

if (!$booking_id) {
    die("Booking ID là bắt buộc.");
}

if (checkAndProcessPayments($con, $booking_id)) {
    header('Location: success_payment.php');
    exit;
} else {
    die("Payment status is still pending. Please complete the payment.");
}
