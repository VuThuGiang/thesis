<?php
require('/laragon/www/dulich/connection.php');
require('/laragon/www/dulich/include/nav.php');

$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    die("Bạn cần đăng nhập để đặt tour.");
}

// Truy vấn thông tin người dùng từ bảng users
$query = "SELECT * FROM user_form WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("Không tìm thấy thông tin người dùng.");
}
$user = $result->fetch_assoc();

$tour_id = $_GET['id'] ?? null;
if (!$tour_id) {
    die("Tour ID là bắt buộc.");
}

// Lấy thông tin chi tiết tour
$query = "SELECT * FROM tours WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $tour_id);
$stmt->execute();
$result = $stmt->get_result();
$tour = $result->fetch_assoc();

// Lấy danh sách voucher liên kết với tour
$query = "SELECT vouchers.* FROM vouchers 
          JOIN tour_voucher ON vouchers.voucher_id = tour_voucher.voucher_id 
          WHERE tour_voucher.tour_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $tour_id);
$stmt->execute();
$vouchers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$bookingSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['Nophone'] ?? '';
    $address_line_1 = $_POST['address_line_1'] ?? '';
    $customer_notes = $_POST['customer_notes'] ?? '';
    $payment_gateway = $_POST['payment_gateway'] ?? '';
    $coupon_code = $_POST['coupon_code'] ?? '';
    $departure_date = $_POST['departure_date'] ?? '';
    $adults = $_POST['adults'] ?? 0;
    $children = $_POST['children'] ?? 0;
    $infants = $_POST['infants'] ?? 0;
    $quantity = $adults + $children + $infants;

    if (empty($first_name) || empty($email) || empty($phone)) {
        die("Vui lòng điền đầy đủ thông tin cá nhân.");
    }

    $variant_id = 1; // Giả sử có biến thể cố định cho mỗi tour

    // Giả sử giá ban đầu lấy từ tour
    $total_price = $tour['adult_price'] * $adults + $tour['child_price'] * $children;

    // Xử lý voucher
    $voucher_id = null;
    if (!empty($coupon_code)) {
        foreach ($vouchers as $voucher) {
            if ($voucher['voucher_code'] === $coupon_code && $voucher['validity_start'] <= date('Y-m-d') && $voucher['validity_end'] >= date('Y-m-d') && $voucher['quantity'] > 0) {
                $discount = $voucher['discount']; // Giả sử discount là phần trăm
                $total_price *= (1 - $discount / 100);
                $voucher_id = $voucher['voucher_id'];
                $query = "UPDATE vouchers SET quantity = quantity - 1 WHERE voucher_id = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("i", $voucher['voucher_id']);
                $stmt->execute();
                break;
            }
        }
        if ($voucher_id === null) {
            echo "<script>alert('Mã giảm giá không hợp lệ hoặc đã hết hạn.');</script>";
        }
    }

    // Đặt chỗ
    $query = "INSERT INTO bookings (tour_id, variant_id, user_id, voucher_id, total_price, quantity, booking_date, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iiiiid", $tour_id, $variant_id, $user_id, $voucher_id, $total_price, $quantity);
    if ($stmt->execute()) {
        $booking_id = $stmt->insert_id; // Lấy ID của booking mới tạo
        $bookingSuccess = true;
    } else {
        echo "Lỗi khi đặt chỗ: " . $stmt->error;
    }

    // Thêm chi tiết thanh toán vào bảng payments
    $sql_payment = "INSERT INTO payments (booking_id, amount, payment_method, payment_status) VALUES (?, ?, ?, 'pending')";
    $stmt_payment = $con->prepare($sql_payment);
    $stmt_payment->bind_param("ids", $booking_id, $total_price, $payment_gateway);
    $stmt_payment->execute();
    $stmt_payment->close();

    // Xử lý thanh toán online
    if ($payment_gateway == 'online') {
        // Hiển thị thông tin mã QR để thanh toán
        $order_number = sprintf('%06d', $booking_id);
        header('Location: payment.php?booking_id=' . $booking_id);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/booking.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var adultPrice = <?php echo $tour['adult_price']; ?>;
        var childPrice = <?php echo $tour['child_price']; ?>;
        var vouchers = <?php echo json_encode($vouchers); ?>;
    </script>
    <script src="/assets/js/booking.js"></script>
    <title>Booking Form</title>
</head>

<body>
    <div class="booking-container">
        <div class="step-indicator">
            <div class="step completed" data-step="1">1. Thông tin đặt tour</div>
            <div class="step" data-step="2">2. Tóm tắt giỏ hàng</div>
            <div class="step" data-step="3">3. Thông tin khách hàng</div>
            <div class="step" data-step="4">4. Xác nhận chi tiết</div>
        </div>

        <form id="booking-form" method="post">
            <!-- Bước 1: Thông tin đặt tour -->
            <div class="form-step" data-step="1">
                <h2>Thông tin đặt tour</h2>
                <div class="form-group">
                    <label for="tour-detail">Chi tiết tour *</label>
                    <a href="#" id="tour-detail"><?php echo htmlspecialchars($tour['tour_name']); ?></a>
                </div>
                <div class="form-group">
                    <label for="departure-date">Ngày khởi hành *</label>
                    <input type="date" id="departure-date" name="departure_date" required>
                </div>
                <div class="form-group">
                    <label for="adults">Số người lớn *</label>
                    <div class="quantity-controls">
                        <button type="button" class="decrement">-</button>
                        <input type="number" id="adults" name="adults" value="2" min="0" required>
                        <button type="button" class="increment">+</button>
                    </div>
                    <span>Giá tour: <?php echo number_format($tour['adult_price']); ?> VNĐ</span>
                </div>
                <div class="form-group">
                    <label for="children">Trẻ em (Từ 1,1m-1,3m)</label>
                    <div class="quantity-controls">
                        <button type="button" class="decrement">-</button>
                        <input type="number" id="children" name="children" value="0" min="0">
                        <button type="button" class="increment">+</button>
                    </div>
                    <span>Giá tour: <?php echo number_format($tour['child_price']); ?> VNĐ</span>
                </div>
                <div class="form-group">
                    <label for="infants">Em bé (Dưới 1,1m)</label>
                    <div class="quantity-controls">
                        <button type="button" class="decrement">-</button>
                        <input type="number" id="infants" name="infants" value="0" min="0">
                        <button type="button" class="increment">+</button>
                    </div>
                    <span>Miễn phí</span>
                </div>
                <div class="form-group">
                    <label for="voucher">Mã giảm giá *</label>
                    <select id="voucher" name="coupon_code">
                        <option value="">Chọn mã giảm giá</option>
                        <?php foreach ($vouchers as $voucher) : ?>
                            <option value="<?php echo htmlspecialchars($voucher['voucher_code']); ?>" data-discount="<?php echo $voucher['discount']; ?>"><?php echo htmlspecialchars($voucher['voucher_code']) . " - Giảm giá: " . $voucher['discount'] . "%"; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="total-amount">
                    <span>Tổng thanh toán</span>
                    <span id="total-amount">0 VNĐ</span>
                    <input type="hidden" id="total-amount-input" name="total_amount" value="0">
                </div>
                <button type="button" class="next-step">Tiếp Tục</button>
            </div>

            <!-- Bước 2: Tóm tắt giỏ hàng -->
            <div class="form-step" data-step="2" style="display: none;">
                <h2>Tóm tắt giỏ hàng</h2>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 20%;">Tên tour</th>
                            <th style="width: 15%;">Ngày đi</th>
                            <th style="width: 12%;">Người lớn</th>
                            <th style="width: 10%;">Trẻ em</th>
                            <th style="width: 10%;">Em bé</th>
                            <th style="width: 15%;">Tổng giá</th>
                            <th style="width: 5%;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($tour['tour_name']); ?></td>
                            <td><span id="summary-date"></span></td>
                            <td><span id="summary-adults"></span></td>
                            <td><span id="summary-children"></span></td>
                            <td><span id="summary-infants"></span></td>
                            <td><span id="summary-total"></span> VNĐ</td>
                            <td><button type="button" class="remove-tour">Xóa</button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="total-amount">
                    <span>Tổng thanh toán</span>
                    <span id="total-amount-summary">0 VNĐ</span>
                </div>
                <button type="button" class="prev-step">Quay Lại</button>
                <button type="button" class="next-step">Tiếp Tục</button>
            </div>

            <!-- Bước 3: Thông tin khách hàng -->
            <div class="form-step" data-step="3" style="display: none;">
                <h2>Thông tin khách hàng</h2>
                <div class="form-group">
                    <label for="fullname">Họ và tên *</label>
                    <input type="text" id="fullname" name="first_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Địa chỉ Email *</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Điện thoại *</label>
                    <input type="tel" id="phone" name="Nophone" value="<?php echo htmlspecialchars($user['phoneNo']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="address_line_1">Địa chỉ *</label>
                    <input type="text" id="address_line_1" name="address_line_1" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="payment-method">Phương thức thanh toán *</label>
                    <select id="payment-method" name="payment_gateway" required onchange="toggleOnlinePaymentOptions()">
                        <option value="cash">Đặt giữ chỗ - Trả tiền mặt</option>
                        <option value="bank-transfer">Đặt chỗ trước - Trả chuyển khoản</option>
                        <option value="online">Thanh toán trực tuyến</option>
                    </select>
                    <!-- Khu vực cho người dùng chọn Momo hoặc VNPAY, ẩn mặc định -->
                    <div id="online-payment-options" class="online-payment-options" style="display:none;">
                        <label for="momo">
                            <input type="radio" name="online_option" value="momo" id="momo">
                            <img src="/assets/img/payonline/momo-logo.png" alt="Momo" class="payment-logo"> Momo
                        </label>
                        <label for="vnpay">
                            <input type="radio" name="online_option" value="vnpay" id="vnpay">
                            <img src="/assets/img/payonline/vnpay-logo.png" alt="VNPAY" class="payment-logo"> VNPAY
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="requests">Yêu cầu của bạn</label>
                    <textarea id="requests" name="customer_notes"></textarea>
                </div>
                <!-- <div class="form-group">
                    <label for="coupon_code">Mã giảm giá</label>
                    <input type="text" id="coupon_code" name="coupon_code">
                </div> -->
                <div class="form-group">
                    <label>
                        <input type="checkbox" required>
                        Tôi đã đọc và đồng ý <a href="#">Chính sách thu thập thông tin</a>
                    </label>
                </div>
                <button type="button" class="prev-step">Quay Lại</button>
                <button type="button" class="next-step">Tiếp Tục</button>
            </div>

            <!-- Bước 4: Xác nhận chi tiết -->
            <div class="form-step" data-step="4" style="display: none;">
                <h2>Xác nhận chi tiết</h2>
                <p>Chi tiết đặt tour của bạn:</p>
                <ul>
                    <li><strong>Chi tiết tour:</strong> <?php echo htmlspecialchars($tour['tour_name']); ?></li>
                    <li><strong>Ngày khởi hành:</strong> <span id="confirm-date"></span></li>
                    <li><strong>Số người lớn:</strong> <span id="confirm-adults"></span></li>
                    <li><strong>Trẻ em:</strong> <span id="confirm-children"></span></li>
                    <li><strong>Em bé:</strong> <span id="confirm-infants"></span></li>
                    <li><strong>Tổng giá:</strong> <span id="confirm-total"></span> VNĐ</li>
                </ul>
                <button type="button" class="prev-step">Quay Lại</button>
                <button type="submit">Xác Nhận</button>
            </div>
        </form>
        <?php if ($bookingSuccess) : ?>
            <script>
                alert('Đặt tour thành công! Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.');
            </script>
        <?php endif; ?>
    </div>
    <script>
        document.getElementById('booking-form').addEventListener('submit', function(event) {
            var agreeCheckbox = document.getElementById('agreeCheckbox');
            if (!agreeCheckbox.checked) {
                alert('Bạn phải đồng ý với các điều khoản để tiếp tục.');
                event.preventDefault();
            }
        });

        function toggleOnlinePaymentOptions() {
            var paymentMethod = document.getElementById('payment-method').value;
            var paymentOptionsDiv = document.getElementById('online-payment-options');

            if (paymentMethod === 'online') {
                paymentOptionsDiv.style.display = 'flex';
            } else {
                paymentOptionsDiv.style.display = 'none';
            }
        }

        function calculateTotal() {
            var adults = parseInt(document.getElementById('adults').value) || 0;
            var children = parseInt(document.getElementById('children').value) || 0;
            var infants = parseInt(document.getElementById('infants').value) || 0;
            var couponCode = document.getElementById('voucher').value;
            var discount = 0;

            var total = adults * adultPrice + children * childPrice;

            if (couponCode) {
                var selectedVoucher = document.querySelector('#voucher option[value="' + couponCode + '"]');
                discount = parseInt(selectedVoucher.getAttribute('data-discount')) || 0;
            }

            total = total * (1 - discount / 100);

            document.getElementById('total-amount').innerText = total.toLocaleString('vi-VN') + ' VNĐ';
            document.getElementById('total-amount-input').value = total;
            document.getElementById('total-amount-summary').innerText = total.toLocaleString('vi-VN') + ' VNĐ';
            document.getElementById('confirm-total').innerText = total.toLocaleString('vi-VN') + ' VNĐ';
        }

        document.getElementById('voucher').addEventListener('change', calculateTotal);
        document.getElementById('adults').addEventListener('change', calculateTotal);
        document.getElementById('children').addEventListener('change', calculateTotal);
        document.getElementById('infants').addEventListener('change', calculateTotal);

        // Đặt giá trị min cho ngày khởi hành
        document.addEventListener('DOMContentLoaded', function() {
            var departureDateInput = document.getElementById('departure-date');
            var today = new Date().toISOString().split('T')[0];
            departureDateInput.setAttribute('min', today);

            // Tính tổng giá ban đầu
            calculateTotal();
        });
    </script>
</body>

</html>