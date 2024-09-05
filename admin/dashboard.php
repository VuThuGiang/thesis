<?php
ob_start();
require("../admin/header.php");
?>


<body>
    <!-- =============== Navigation ================ -->
    <?php
    require('sider.php')
    ?>

    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>

            <div class="search">
                <label>
                    <input type="text" placeholder="Search here">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <?php
// Kiểm tra nếu session chưa được bắt đầu, thì bắt đầu session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra quyền truy cập
if (!isset($_SESSION['logged_in_admin']) || $_SESSION['role_admin'] != 0) {
    header("location: login.php");
    exit();
}

// Nội dung trang admin với nút logout
echo "<a href='logout.php' style='background-color: #f78bac;color: white;padding: 10px 20px; border: none;border-radius: 5px;text-decoration: none; font-size: 16px; cursor: pointer;display: inline-block;  transition: background-color 0.3s; 
' onmouseover=\"this.style.backgroundColor='#c82333'\" onmouseout=\"this.style.backgroundColor='#dc3545'\">LOGOUT</a> " ;


?>


        </div>



        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers">1,504</div>
                    <div class="cardName">Daily Views</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">80</div>
                    <div class="cardName">Sales</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="cart-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">284</div>
                    <div class="cardName">Comments</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="chatbubbles-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">$7,842</div>
                    <div class="cardName">Earning</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="cash-outline"></ion-icon>
                </div>
            </div>
        </div>

        <!-- ================ Order Details List ================= -->
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Recent Orders</h2>
                    <a href="#" class="btn">View All</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Payment</td>
                            <td>Status</td>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>Apple Watch</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status return">Return</span></td>
                        </tr>

                        <tr>
                            <td>Addidas Shoes</td>
                            <td>$620</td>
                            <td>Due</td>
                            <td><span class="status inProgress">In Progress</span></td>
                        </tr>

                        <tr>
                            <td>Star Refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status delivered">Delivered</span></td>
                        </tr>

                        <tr>
                            <td>Dell Laptop</td>
                            <td>$110</td>
                            <td>Due</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- ================= New Customers ================ -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>Recent Customers</h2>
                </div>

                <table>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>David <br> <span>Italy</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Amit <br> <span>India</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>David <br> <span>Italy</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Amit <br> <span>India</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>David <br> <span>Italy</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Amit <br> <span>India</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>David <br> <span>Italy</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Amit <br> <span>India</span></h4>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>
<!-- =========== Scripts =========  -->
<script src="/js/main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>
<?php
ob_end_flush();
?>
