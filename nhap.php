<?php
require('/laragon/www/dulich/connection.php');
require('/laragon/www/dulich/include/nav.php');

$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    die("Bạn cần đăng nhập để đặt tour.");
}


function getCassoTransactions()
{
    $url = 'https://oauth.casso.vn/v2/transactions?page=&pageSize=100&sort=DESC';
    $headers = [
        'Authorization: Apikey AK_CS.99c70fd05d3e11efa5dbff93fab61642.8jFlCQYdiO7W0s4hlHN1b5n0w4oCLtkiojlVq7R66hsn15h1O712N4sRTuojDlGoByO0NRPY',
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
    $payment_method = $_POST['payment_gateway'] ?? 'offline';

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

    // Thiết lập trạng thái booking và thời hạn thanh toán nếu thanh toán online
    $booking_status = 'complete';
    $payment_status = 'pending'; // Trạng thái thanh toán mặc định là pending
    $payment_day = null; // Chưa thanh toán thì để NULL

    if ($payment_method === 'online') {
        $payment_due = date('Y-m-d H:i:s', strtotime('+15 minutes')); // Thời hạn thanh toán online là 15 phút
    } else if ($payment_method === 'offline') {
        $payment_status = 'unpaid'; // Nếu là thanh toán offline
        $payment_due = date('Y-m-d H:i:s', strtotime('+5 days')); // Đặt thời hạn thanh toán offline là 5 ngày
    } else {
        $payment_due = null; // Chỉ nên sử dụng khi cột `payment_due` cho phép NULL
    }

    // Đặt chỗ
    $query = "INSERT INTO bookings (tour_id, variant_id, user_id, voucher_id, no_adult, no_child, total_price, quantity, `payment methods`, `status`, `payment_status`, payment_due, booking_date, payment_day, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iiiiidisssssss", $tour_id, $variant_id, $user_id, $voucher_id, $adults, $children, $total_price, $quantity, $payment_method, $booking_status, $payment_status, $payment_due, $departure_date, $payment_day);

    if ($stmt->execute()) {
        $bookingSuccess = true;
    } else {
        echo "Lỗi khi đặt chỗ: " . $stmt->error;
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/booking.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var adultPrice = <?php echo $tour['adult_price']; ?>;
        var childPrice = <?php echo $tour['child_price']; ?>;
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
                        <option value="offline">Offline</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="requests">Yêu cầu của bạn</label>
                    <textarea id="requests" name="customer_notes"></textarea>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" required>
                        Tôi đã đọc và đồng ý <a href="quydinh.php">Chính sách thu thập thông tin</a>
                    </label>
                </div>
                <input type="hidden" id="selected-payment-method" name="payment_method" value="offline">
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
                    <li><strong>Tổng giá:</strong> <span id="confirm-total"></span></li>

                </ul>

                <!-- Hiển thị mã QR của VietQR, chỉ hiển thị khi chọn thanh toán online -->
                <div id="qr-code-section" class="qr-code-section" style="display:none;">
                    <h3>Thanh toán qua VietQR</h3>
                    <img id="qr_code" alt="QR Code Thanh Toán" class="qr-code-image" style="width: fit-content; height:fit-content">
                    <p>Vui lòng quét mã QR để thanh toán</p>
                </div>
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
            var selectedPaymentMethodInput = document.getElementById('selected-payment-method');
            var qrCodeSection = document.getElementById('qr-code-section');

            if (paymentMethod === 'online') {
                qrCodeSection.style.display = 'block'; // Hiển thị mã QR 
            } else {
                qrCodeSection.style.display = 'none'; // Ẩn mã QR 
            }

            // Cập nhật giá trị cho input ẩn
            selectedPaymentMethodInput.value = paymentMethod;
        }

        document.getElementById('payment-method').addEventListener('change', toggleOnlinePaymentOptions);

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

        document.addEventListener('DOMContentLoaded', function() {
            var departureDateInput = document.getElementById('departure-date');
            var today = new Date().toISOString().split('T')[0];
            departureDateInput.setAttribute('min', today);

            calculateTotal();
        });


        function updateQRCode() {
            // Lấy giá trị tổng giá từ phần tử HTML
            var totalPrice = document.getElementById('confirm-total').innerText.replace(/\D/g, '');

            console.log("Total price: ", totalPrice); // Kiểm tra giá trị totalPrice

            // Thay thế các ký tự đặc biệt trong tourName bằng gạch ngang
            var tourName = "<?php echo htmlspecialchars($tour['tour_name']); ?>".replace(/[^a-zA-Z0-9 ]/g, '').replace(/\s+/g, '-');

            // Tạo URL mới cho QR code
            var qrUrl = "https://img.vietqr.io/image/MB-5696911052002-qr_only.png?amount=" + totalPrice +
                "&addInfo=" + encodeURIComponent(tourName) +
                "&accountName=" + encodeURIComponent("VU THU GIANG");

            console.log("Generated QR URL: " + qrUrl); // Kiểm tra URL đã tạo

            // Cập nhật src của hình ảnh QR code
            document.getElementById('qr_code').src = qrUrl;
        }

        // Sử dụng sự kiện DOM để cập nhật mã QR khi trang được tải
        document.addEventListener("DOMContentLoaded", function() {
            updateQRCode(); // Gọi hàm ngay khi DOM đã sẵn sàng
        });

        // Lắng nghe bất kỳ thay đổi nào trong phần tử `#confirm-total` và cập nhật URL
        document.getElementById('confirm-total').addEventListener('DOMSubtreeModified', function() {
            updateQRCode(); // Cập nhật URL mỗi khi `#confirm-total` thay đổi
        });
    </script>
</body>

</html>

<?php
require("/laragon/www/dulich/include/footer.php");
?>