<?php
require('/laragon/www/dulich/include/nav.php');
require('/laragon/www/dulich/connection.php');

// Khởi tạo session
session_start();

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['uid'])) {
    header("Location: /pages/login.php");
    exit();
}

// Lấy thông tin người dùng từ session
$user_id = $_SESSION['uid'];

// Truy vấn để lấy danh sách đơn hàng của người dùng cùng với thông tin tour và số sao đánh giá trung bình
$query = "
    SELECT 
        bookings.booking_id,
        bookings.*, 
        tours.tour_name, 
        tours.image, 
        tours.description,
        IFNULL(AVG(reviews.rating), 0) AS average_rating 
    FROM bookings 
    JOIN tours ON bookings.tour_id = tours.id 
    LEFT JOIN reviews ON bookings.tour_id = reviews.tour_id 
    WHERE bookings.user_id = '$user_id'
    GROUP BY bookings.booking_id, tours.tour_name, tours.image, tours.description
    ORDER BY bookings.booking_date DESC
";
$result = $con->query($query);

$paid_orders = [];
$unpaid_orders = [];

if ($result->num_rows > 0) {
    while ($order = $result->fetch_assoc()) {
        switch ($order['payment_status']) {
            case 'paid':
                $paid_orders[] = $order;
                break;
            case 'unpaid':
                $unpaid_orders[] = $order;
                break;
        }
    }
}
?>

<?php require('/laragon/www/dulich/include/Huser_order.php') ?>

<body>

    <!-- Phần thân trang -->
    <div class="container" style="margin-top: 100px;">
        <h1>YOUR ORDERS</h1>
        <ul class="nav nav-tabs" id="orderTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="paid-tab" data-toggle="tab" href="#paid" role="tab" aria-controls="paid" aria-selected="true">PAID</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="unpaid-tab" data-toggle="tab" href="#unpaid" role="tab" aria-controls="unpaid" aria-selected="false">UNPAID</a>
            </li>
        </ul>
        <div class="tab-content" id="orderTabsContent">
            <!-- Tab PAID Orders -->
            <div class="tab-pane fade show active" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                <?php if (!empty($paid_orders)) : ?>
                    <?php foreach ($paid_orders as $order) : ?>
                        <div class="order-card">
                            <div class="image-container">
                                <img src="/admin/anh/<?php echo $order['image']; ?>" alt="Tour Image">
                            </div>
                            <div class="order-details">
                                <h5><?php echo $order['tour_name']; ?></h5>
                                <p class="badge badge-info">Order now, use immediately</p>
                                <p class="description" style="text-align:left;"><?php echo $order['description']; ?></p>
                                <p class="order-status" style="text-align:left; 
                                <?php
                                    if ($order['status'] == 'Cancelled') {
                                echo 'color: red !important;';
                                } elseif ($order['status'] == 'Complete') {
                                    echo 'color: green !important;';
                                } else {
                                echo 'color: black !important;';
                                }
                                ?>">
                                    Status: <?php echo $order['status']; ?>
                                </p>

                                <div class="order-rating" style="text-align:left;">
                                    <?php
                                    // Hiển thị các ngôi sao tương ứng với điểm trung bình
                                    $average_rating = round($order['average_rating'], 1);
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $average_rating) {
                                            echo '<i class="fas fa-star"></i>';
                                        } elseif ($i - $average_rating < 1 && $i - $average_rating > 0) {
                                            echo '<i class="fas fa-star-half-alt"></i>';
                                        } else {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    ?>
                                    (<?php echo $average_rating; ?> star)
                                </div>
                                <p class="price2" style="text-align: left;"><?php echo number_format($order['total_price']); ?> ₫</p>
                            </div>
                            <div class="order-actions">
                                <button class="btn btn-primary" onclick="viewOrderDetails(<?php echo $order['booking_id']; ?>)">View Details</button>
                                <button class="btn btn-secondary" onclick="showRateModal(<?php echo $order['tour_id']; ?>)">Evaluate</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>You have no paid orders.</p>
                <?php endif; ?>
            </div>

            <!-- Tab UNPAID Orders -->
            <div class="tab-pane fade" id="unpaid" role="tabpanel" aria-labelledby="unpaid-tab">
                <?php if (!empty($unpaid_orders)) : ?>
                    <?php foreach ($unpaid_orders as $order) : ?>
                        <div class="order-card">
                            <div class="image-container">
                                <img src="/admin/anh/<?php echo $order['image']; ?>" alt="Tour Image">
                            </div>
                            <div class="order-details">
                                <h5><?php echo $order['tour_name']; ?></h5>
                                <p class="badge badge-info">Order now, use immediately</p>
                                <p class="description" style="text-align:left;"><?php echo $order['description']; ?></p>
                                <p class="order-status" style="text-align:left; 
                                <?php
                                if ($order['status'] == 'Cancelled') {
                                echo 'color: red !important;';
                                } elseif ($order['status'] == 'Complete') {
                                echo 'color: green !important;';
                                } else {
                                 echo 'color: black !important;';
                                }
                                ?>">
                                    Status: <?php echo $order['status']; ?>
                                </p>

                                <div class="order-rating" style="text-align:left;">
                                    <?php
                                    // Hiển thị các ngôi sao tương ứng với điểm trung bình
                                    $average_rating = round($order['average_rating'], 1);
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $average_rating) {
                                            echo '<i class="fas fa-star"></i>';
                                        } elseif ($i - $average_rating < 1 && $i - $average_rating > 0) {
                                            echo '<i class="fas fa-star-half-alt"></i>';
                                        } else {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    ?>
                                    (<?php echo $average_rating; ?> star)
                                </div>
                                <p class="price2" style="text-align: left;"><?php echo number_format($order['total_price']); ?> ₫</p>
                            </div>
                            <div class="order-actions">
                                <button class="btn btn-primary" onclick="viewOrderDetails(<?php echo $order['booking_id']; ?>)">View Details</button>
                                <button class="btn btn-secondary" onclick="showRateModal(<?php echo $order['tour_id']; ?>)">Evaluate</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>You have no unpaid orders.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal Đánh Giá -->
    <div class="modal fade" id="rateModal" tabindex="-1" role="dialog" aria-labelledby="rateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rateModalLabel">Tour Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="rateForm" method="post" action="/pages/rate_tour.php">
                        <input type="hidden" name="tour_id" id="tour_id" value="">
                        <div class="form-group">
                            <label for="rating">Number of stars:</label>
                            <div class="rating-stars">
                                <i class="fas fa-star" data-value="1"></i>
                                <i class="fas fa-star" data-value="2"></i>
                                <i class="fas fa-star" data-value="3"></i>
                                <i class="fas fa-star" data-value="4"></i>
                                <i class="fas fa-star" data-value="5"></i>
                            </div>
                            <input type="hidden" id="rating" name="rating" value="5" required>
                        </div>
                        <div class="form-group">
                            <label for="review">Comment:</label>
                            <textarea class="form-control" id="review" name="review" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Sent</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Phần chân trang -->
    <?php require('/laragon/www/dulich/include/footer.php'); ?>

</body>

</html>