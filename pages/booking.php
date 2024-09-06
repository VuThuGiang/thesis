<?php
require('/laragon/www/dulich/connection.php');
require('/laragon/www/dulich/include/nav.php');


$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    die("Bạn cần đăng nhập để đặt tour.");
}


// Thêm đoạn mã sau để xử lý AJAX kiểm tra trạng thái thanh toán
if (isset($_GET['check_payment_status']) && $_GET['check_payment_status'] == 'true') {
    $tour_id = $_GET['tour_id'] ?? null;
    $user_id = $_SESSION['uid'] ?? null;

    if (!$tour_id || !$user_id) {
        echo 'invalid';
        exit;
    }

    // Lấy dữ liệu giao dịch từ Casso API
    $cassoData = getCassoTransactions();

    if ($cassoData) {
        foreach ($cassoData['data']['records'] as $transaction) {
            if (strpos($transaction['description'], "Booking ID: $tour_id") !== false && $transaction['amount'] > 0) {
                // Nếu tìm thấy giao dịch, cập nhật trạng thái thanh toán thành 'paid'
                $query = "UPDATE bookings SET payment_status = 'paid' WHERE user_id = ? AND tour_id = ? AND payment_status = 'pending'";
                $stmt = $con->prepare($query);
                $stmt->bind_param("ii", $user_id, $tour_id);
                $stmt->execute();
                echo 'paid';
                exit;
            }
        }
    }

    echo 'unpaid';
    exit;
}

function getCassoTransactions()
{
    $url = 'https://oauth.casso.vn/v2/transactions?page=&pageSize=100&sort=DESC';
    $headers = [
        'Authorization: Apikey AK_CS.7b41a810669711efa2b3314e6482969b.NkATBEQ0SxCSk6rsKifeU6tn6GZBesoo2YBlpqlQmXeAxAm62jFQegQWZ3KuL4ECgVjSYZcJ',
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
          WHERE tour_voucher.tour_id = ? AND vouchers.validity_end >= CURDATE()";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $tour_id);
$stmt->execute();
$vouchers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$bookingSuccess = false;

// Kiểm tra trạng thái thanh toán nếu phương thức là online và trạng thái là pending
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['check_payment'])) {
    $query = "SELECT booking_date FROM bookings WHERE user_id = ? AND tour_id = ? AND payment_status = 'pending'";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $user_id, $tour_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    if ($booking) {
        $booking_date = strtotime($booking['booking_date']);
        $current_time = time();
        $diff = $current_time - $booking_date;

        if ($diff > 15 * 60) { // Hơn 15 phút
            // Cập nhật trạng thái thanh toán thành 'failed'
            $query = "UPDATE bookings SET payment_status = 'failed' WHERE user_id = ? AND tour_id = ? AND payment_status = 'pending'";
            $stmt = $con->prepare($query);
            $stmt->bind_param("ii", $user_id, $tour_id);
            $stmt->execute();
            echo "<script>alert('Thời gian thanh toán đã hết! Trạng thái thanh toán đã chuyển thành failed.');</script>";
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = uniqid();
    $payment_method = $_POST['payment_method'] ?? 'offline';
    $first_name = $_POST['first_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['Nophone'] ?? '';
    $address_line_1 = $_POST['address_line_1'] ?? '';
    $customer_notes = $_POST['customer_notes'] ?? '';
    $payment_method = $_POST['payment_method'] ?? 'offline';
    $coupon_code = $_POST['coupon_code'] ?? '';
    $departure_date = $_POST['departure_date'] ?? '';
    $adults = $_POST['adults'] ?? 0;
    $children = $_POST['children'] ?? 0;
    $infants = $_POST['infants'] ?? 0;
    $quantity = $adults + $children + $infants;

    if (empty($first_name) || empty($email) || empty($phone)) {
        die("Vui lòng điền đầy đủ thông tin cá nhân.");
    }


    // Tính tổng giá ban đầu dựa trên số người lớn và trẻ em
    $total_price = $tour['adult_price'] * $adults + $tour['child_price'] * $children;

    // Xử lý voucher và tính toán lại total_price nếu voucher hợp lệ
    $voucher_id = null;
    if (!empty($coupon_code)) {
        foreach ($vouchers as $voucher) {
            if ($voucher['voucher_code'] === $coupon_code && $voucher['validity_start'] <= date('Y-m-d') && $voucher['validity_end'] >= date('Y-m-d') && $voucher['quantity'] > 0) {
                $discount = $voucher['discount']; // Giả sử discount là phần trăm
                $total_price *= (1 - $discount / 100); // Tính lại total_price sau khi áp dụng giảm giá
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

    // Tạo bản ghi booking với total_price đã tính toán lại
    if ($payment_method === 'online') {
        // Tạo booking với trạng thái pending cho thanh toán online
        $query = "INSERT INTO bookings (tour_id, user_id, voucher_id, no_adult, no_child, total_price, quantity, `payment methods`, status, payment_status, booking_date, created_at, transaction_code) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'complete', 'pending', ?, NOW(), ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("iiiidissss", $tour_id, $user_id, $voucher_id, $adults, $children, $total_price, $quantity, $payment_method, $departure_date, $transaction_id);
        $stmt->execute();

        // Lấy booking_id vừa tạo để lấy transaction_code
        $booking_id = $stmt->insert_id;
        $query = "SELECT transaction_code FROM bookings WHERE booking_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking = $result->fetch_assoc();
        $transaction_code = $booking['transaction_code'];

        // Trả về transaction_code và tổng giá trị cho client để hiển thị QR code
        // Bọc phần JSON trong các thẻ đặc biệt
        echo "<!-- JSON_START -->";
        echo json_encode([
            'success' => true,
            'transaction_code' => $transaction_code,
            'total_price' => $total_price
        ]);
        echo "<!-- JSON_END -->";
        exit();
    } else {
        // Thanh toán offline
        $query = "INSERT INTO bookings (tour_id, user_id, voucher_id, no_adult, no_child, total_price, quantity, `payment methods`, status, payment_status, booking_date, created_at, transaction_code) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'complete', 'unpaid', ?, NOW(), ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("iiiidissss", $tour_id, $user_id, $voucher_id, $adults, $children, $total_price, $quantity, $payment_method, $departure_date, $transaction_id);
        $stmt->execute();

        // Trả về phản hồi cho trường hợp offline
        $bookingSuccess = true;
        echo "<script>alert('Đặt tour thành công! Bạn đã chọn phương thức thanh toán offline.');</script>";
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
                        <input type="number" id="adults" name="adults" value="2" min="0" required readonly>
                        <button type="button" class="increment">+</button>
                    </div>
                    <span>Giá tour: <?php echo number_format($tour['adult_price']); ?> VNĐ</span>
                </div>
                <div class="form-group">
                    <label for="children">Trẻ em (Từ 1,1m-1,3m)</label>
                    <div class="quantity-controls">
                        <button type="button" class="decrement">-</button>
                        <input type="number" id="children" name="children" value="0" min="0" readonly>
                        <button type="button" class="increment">+</button>
                    </div>
                    <span>Giá tour: <?php echo number_format($tour['child_price']); ?> VNĐ</span>
                </div>
                <div class="form-group">
                    <label for="infants">Em bé (Dưới 1,1m)</label>
                    <div class="quantity-controls">
                        <button type="button" class="decrement">-</button>
                        <input type="number" id="infants" name="infants" value="0" min="0" readonly>
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
                    <select id="payment-method" name="payment_method" required onchange="toggleOnlinePaymentOptions()">
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


                <!-- Thêm Bộ đếm thời gian -->
                <!-- <div id="countdown-timer" style="font-size: 20px; color: red; margin-top: 10px;">
                    Thời gian còn lại để hoàn tất thanh toán: <span id="timer">15:00</span>
                </div> -->

                <button type="button" class="prev-step">Quay Lại</button>
                <button type="submit">Xác Nhận</button>
            </div>

            <!-- Bước 5 ảo: Hiển thị QR Code -->
            <div class="form-step" data-step="5" style="display: none;">
                <h2>Thanh toán qua VietQR</h2>
                <p>Vui lòng quét mã QR để thanh toán</p>
                <img id="qr_code" alt="QR Code Thanh Toán" class="qr-code-image" style="width: fit-content; height:fit-content">
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

            if (paymentMethod === 'online') {
                document.querySelector('.form-step[data-step="4"]').style.display = 'block';
            } else {
                document.querySelector('.form-step[data-step="4"]').style.display = 'block'; // Vẫn hiển thị bước 4 cho cả hai
            }

            selectedPaymentMethodInput.value = paymentMethod; // Cập nhật giá trị cho input ẩn
        }

        document.getElementById('payment-method').addEventListener('change', toggleOnlinePaymentOptions);

        let totalAmountText = '';

        const targetNode = document.getElementById('confirm-total');
        const observerConfig = {
            childList: true
        };

        const callback = function(mutationsList, observer) {
            for (let mutation of mutationsList) {
                if (mutation.type === 'childList') {
                    totalAmountText = mutation.target.innerText;
                    console.log("Updated totalAmountText:", totalAmountText);
                    updateQRCode();
                }
            }
        };

        const observer = new MutationObserver(callback);
        observer.observe(targetNode, observerConfig);

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
                total = total * (1 - discount / 100);
            }

            document.getElementById('total-amount').innerText = total.toLocaleString('vi-VN') + ' VNĐ';
            document.getElementById('total-amount-input').value = total;
            document.getElementById('total-amount-summary').innerText = total.toLocaleString('vi-VN') + ' VNĐ';
            document.getElementById('confirm-total').innerText = total.toLocaleString('vi-VN') + ' VNĐ';
        }

        // Hàm gọi khi nhận được phản hồi từ bước 4 (POST form)
        function handleBookingResponse(response) {
            if (response.success) {
                // Ẩn bước 4 và hiển thị bước 5
                document.querySelector('.form-step[data-step="4"]').style.display = 'none';
                document.querySelector('.form-step[data-step="5"]').style.display = 'block';

                // Tạo QR code với transaction_code từ phản hồi
                var totalPrice = response.total_price;
                var transactionCode = response.transaction_code;

                // URL của VietQR với các thông tin cần thiết
                var qrUrl = "https://img.vietqr.io/image/MB-5696911052002-qr_only.png?amount=" + totalPrice +
                    "&addInfo=" + encodeURIComponent("TransID: " + transactionCode) +
                    "&accountName=" + encodeURIComponent("VU THU GIANG");

                // Đặt URL của ảnh QR code vào trong phần tử img
                document.getElementById('qr_code').src = qrUrl;

            } else {
                alert("Đã xảy ra lỗi khi đặt tour.");
            }
        }

        function extractJSON(response) {
            try {
                // Tìm vị trí bắt đầu và kết thúc của JSON
                var jsonStart = response.indexOf("<!-- JSON_START -->");
                var jsonEnd = response.indexOf("<!-- JSON_END -->");

                if (jsonStart !== -1 && jsonEnd !== -1) {
                    // Chỉ lấy phần JSON, loại bỏ các khoảng trắng và ký tự không mong muốn
                    var jsonString = response.substring(jsonStart + 17, jsonEnd).trim();

                    // Loại bỏ bất kỳ ký tự không mong muốn nào trước JSON bằng cách tìm dấu { đầu tiên
                    jsonString = jsonString.replace(/^[^\{]*/, '');

                    console.log("Chuỗi JSON đã tách:", jsonString);
                    return JSON.parse(jsonString); // Phân tích JSON sạch
                } else {
                    console.error("Không tìm thấy JSON trong phản hồi.");
                    return null;
                }
            } catch (error) {
                console.error("Lỗi khi phân tích JSON:", error);
                return null;
            }
        }




        document.getElementById('booking-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: this.action, // URL xử lý form
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log("Phản hồi từ server:", response); // Thêm dòng này để in ra phản hồi
                    try {
                        var jsonResponse = extractJSON(response);
                        if (jsonResponse && jsonResponse.success) {
                            handleBookingResponse(jsonResponse);
                        } else {
                            alert("Đã xảy ra lỗi khi đặt tour.");
                        }
                    } catch (error) {
                        console.error("Lỗi khi phân tích JSON:", error);
                    }
                },
                error: function() {
                    alert("Đã xảy ra lỗi khi gửi yêu cầu.");
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var departureDateInput = document.getElementById('departure-date');
            var today = new Date().toISOString().split('T')[0];
            departureDateInput.setAttribute('min', today);

            calculateTotal();
            startCountdown(); // Bắt đầu đếm ngược khi trang tải hoặc khi người dùng đến bước 4

            // Thêm hàm để kiểm tra trạng thái thanh toán định kỳ qua AJAX
            function checkPaymentStatus() {
                $.ajax({
                    url: '', // Trang hiện tại đang xử lý
                    type: 'GET',
                    data: {
                        check_payment_status: true,
                        tour_id: '<?php echo $tour_id; ?>'
                    },
                    success: function(response) {
                        if (response === 'paid') {
                            clearInterval(paymentCheckInterval); // Dừng kiểm tra nếu đã thanh toán
                            countdownActive = false; // Dừng bộ đếm thời gian
                            $('#qr-code-section').html("<p style='color: green;'>Bạn đã thanh toán tour thành công! Xin cảm ơn.</p>");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to check payment status:', error);
                    }
                });
            }

            // Kiểm tra trạng thái thanh toán mỗi 5 giây
            paymentCheckInterval = setInterval(checkPaymentStatus, 5000);
        });

        document.getElementById('voucher').addEventListener('change', calculateTotal);
        document.getElementById('adults').addEventListener('change', calculateTotal);
        document.getElementById('children').addEventListener('change', calculateTotal);
        document.getElementById('infants').addEventListener('change', calculateTotal);

        document.getElementById('tour-detail').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            adultPrice = parseFloat(selectedOption.getAttribute('data-adult-price'));
            childPrice = parseFloat(selectedOption.getAttribute('data-child-price'));

            console.log("Updated adultPrice:", adultPrice);
            console.log("Updated childPrice:", childPrice);

            calculateTotal();
        });

        function startCountdown() {
            var timerElement = document.getElementById('timer');
            var timeLeft = 15 * 60; // 15 phút tính bằng giây

            var countdown = setInterval(function() {
                var minutes = Math.floor(timeLeft / 60);
                var seconds = timeLeft % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                timerElement.textContent = minutes + ":" + seconds;

                timeLeft--;

                if (timeLeft < 0) {
                    clearInterval(countdown);
                    alert("Thời gian thanh toán đã hết! Vui lòng đặt tour lại.");
                    window.location.href = "/booking.php"; // Chuyển hướng hoặc đặt lại form đặt chỗ
                }
            }, 1000);
        }
    </script>
</body>

</html>

<?php
require("/laragon/www/dulich/include/footer.php");
?>
