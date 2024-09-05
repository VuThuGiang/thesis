<head>
    <style>
        .navigation {
            max-height: 100vh;
            overflow-y: auto;
        }

        .navigation::-webkit-scrollbar {
            width: 8px;
        }

        .navigation::-webkit-scrollbar-track {
            background: #ffb6c1;
        }

        .navigation::-webkit-scrollbar-thumb {
            background: #ffb6c1;
            border-radius: 4px;
        }

        .navigation::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="logo-apple"></ion-icon> <!-- Brand icon -->
                    </span>
                    <span class="title">Brand Name</span>
                </a>
            </li>

            <li>
                <a href="/admin/dashboard.php">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon> <!-- Dashboard icon -->
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="/admin/customer/usermanager.php">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon> <!-- Customers icon -->
                    </span>
                    <span class="title">Customers</span>
                </a>
            </li>

            <li>
                <a href="/admin/history/booking_history.php">
                    <span class="icon">
                        <ion-icon name="calendar-outline"></ion-icon> <!-- Booking history icon -->
                    </span>
                    <span class="title">History Booking</span>
                </a>
            </li>

            <li>
                <a href="/admin/blog/blog.php">
                    <span class="icon">
                        <ion-icon name="newspaper-outline"></ion-icon> <!-- Blogs icon -->
                    </span>
                    <span class="title">Blogs</span>
                </a>
            </li>

            <li>
                <a href="/admin/location/location.php">
                    <span class="icon">
                        <ion-icon name="location-outline"></ion-icon> <!-- Location icon -->
                    </span>
                    <span class="title">Location</span>
                </a>
            </li>

            <li>
                <a href="/admin/tour/tour.php">
                    <span class="icon">
                        <ion-icon name="map-outline"></ion-icon> <!-- Tours icon -->
                    </span>
                    <span class="title">Tours</span>
                </a>
            </li>

            <li>
                <a href="/admin/voucher/vouchers.php">
                    <span class="icon">
                        <ion-icon name="pricetag-outline"></ion-icon> <!-- Vouchers icon -->
                    </span>
                    <span class="title">Vouchers</span>
                </a>
            </li>

            <li>
                <a href="/admin/category/category.php">
                    <span class="icon">
                        <ion-icon name="list-outline"></ion-icon> <!-- Category icon -->
                    </span>
                    <span class="title">Category</span>
                </a>
            </li>

            <li>
                <a href="/admin/fback/admin_feedbacks.php">
                    <span class="icon">
                        <ion-icon name="chatbubble-ellipses-outline"></ion-icon> <!-- Feedbacks icon -->
                    </span>
                    <span class="title">Feedbacks</span>
                </a>
            </li>

            <li>
                <a href="/admin/setting/admin_footer.php">
                    <span class="icon">
                        <ion-icon name="settings-outline"></ion-icon> <!-- Settings icon -->
                    </span>
                    <span class="title">Settings</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon> <!-- Sign Out icon -->
                    </span>
                    <span class="title">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Ionicons script -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
