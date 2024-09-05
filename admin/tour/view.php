<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
?>

<?php require("/laragon/www/dulich/admin/include/Hview_tour.php") ?>

<body>
    <div class="post" style="margin-left: 400px;">
        <?php
        include("/laragon/www/dulich/connection.php");

        if (isset($_GET['id'])) {
            $tour_id = intval($_GET['id']);

            $sqlSelectTour = "SELECT tours.*, location.name AS location_id FROM tours 
                              LEFT JOIN location ON tours.location_id = location.id 
                              WHERE tours.id = $tour_id";
            $result = mysqli_query($con, $sqlSelectTour);

            if ($result && mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_array($result);
        ?>
                <div class="tour-item">
                    <h2><?php echo htmlspecialchars($data['tour_name']); ?></h2>
                    <p>Price: <?php echo number_format($data['adult_price']); ?> ₫</p>
                    <?php if (!empty($data['image'])) : ?>
                        <img src="/admin/anh/<?php echo htmlspecialchars($data['image']); ?>" alt="Tour Image">
                    <?php endif; ?>
                    <p>
                    <h3>Description:</h3> <?php echo nl2br(htmlspecialchars($data['description'])); ?></p>
                    <p>
                    <h3>Quantity:</h3> <?php echo htmlspecialchars($data['quantity']); ?></p>
                    <p>
                    <h3>Status:</h3> <?php echo htmlspecialchars($data['status']) ? 'Active' : 'Inactive'; ?></p>
                    <p>
                    <h3>Location:</h3> <?php echo ($data['location_id']); ?></p>
                    <p>
                    <h3>Adult price:</h3> <?php echo htmlspecialchars($data['adult_price']); ?> VND</p>
                    <p>
                    <h3>Child price:</h3> <?php echo htmlspecialchars($data['child_price']); ?> VND</p>
                    <p>
                    <h3>Time tour:</h3> <?php echo htmlspecialchars($data['time_tour']); ?></p>

                    <!-- Itinerary displayed as a table -->
                    <h3>Itinerary:</h3>
                    <table class="itinerary-table">
                        <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Nội Dung</th>
                                <th>Buổi Sáng</th>
                                <th>Buổi Trưa</th>
                                <th>Buổi Chiều</th>
                                <th>Buổi Tối</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $itineraryArray = json_decode($data['Itinerary'], true);

                            if ($itineraryArray === null && json_last_error() !== JSON_ERROR_NONE) {
                                echo "<p>Failed to decode JSON: " . json_last_error_msg() . "</p>";
                            } elseif (is_array($itineraryArray)) {
                                $dayIndex = 1;  // Khởi tạo chỉ số ngày từ 1
                                foreach ($itineraryArray as $dayData) {
                                    echo "<tr>";
                                    echo "<td class='itinerary-day'>Ngày " . $dayIndex . "</td>";
                                    echo "<td class='itinerary-activity'>" . htmlspecialchars($dayData['title']) . "</td>";

                                    // Buổi sáng
                                    echo "<td>";
                                    if (isset($dayData['activities']['morning'])) {
                                        if (is_array($dayData['activities']['morning'])) {
                                            echo '<ul>';
                                            foreach ($dayData['activities']['morning'] as $activity) {
                                                echo '<li>' . htmlspecialchars($activity) . '</li>';
                                            }
                                            echo '</ul>';
                                        } else {
                                            echo htmlspecialchars($dayData['activities']['morning']);
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    echo "</td>";

                                    // Buổi trưa
                                    echo "<td>";
                                    if (isset($dayData['activities']['noon'])) {
                                        if (is_array($dayData['activities']['noon'])) {
                                            echo '<ul>';
                                            foreach ($dayData['activities']['noon'] as $activity) {
                                                echo '<li>' . htmlspecialchars($activity) . '</li>';
                                            }
                                            echo '</ul>';
                                        } else {
                                            echo htmlspecialchars($dayData['activities']['noon']);
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    echo "</td>";

                                    // Buổi chiều
                                    echo "<td>";
                                    if (isset($dayData['activities']['afternoon'])) {
                                        if (is_array($dayData['activities']['afternoon'])) {
                                            echo '<ul>';
                                            foreach ($dayData['activities']['afternoon'] as $activity) {
                                                echo '<li>' . htmlspecialchars($activity) . '</li>';
                                            }
                                            echo '</ul>';
                                        } else {
                                            echo htmlspecialchars($dayData['activities']['afternoon']);
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    echo "</td>";

                                    // Buổi tối
                                    echo "<td>";
                                    if (isset($dayData['activities']['evening'])) {
                                        if (is_array($dayData['activities']['evening'])) {
                                            echo '<ul>';
                                            foreach ($dayData['activities']['evening'] as $activity) {
                                                echo '<li>' . htmlspecialchars($activity) . '</li>';
                                            }
                                            echo '</ul>';
                                        } else {
                                            echo htmlspecialchars($dayData['activities']['evening']);
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    echo "</td>";

                                    echo "</tr>";

                                    $dayIndex++;  // Tăng chỉ số ngày lên 1
                                }
                            } else {
                                echo "<p>Invalid Itinerary data or no data available.</p>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
        <?php
            } else {
                echo "<p>Tour not found.</p>";
            }
        } else {
            echo "<p>Invalid tour ID.</p>";
        }
        ?>
    </div>
</body>

<?php require("/laragon/www/dulich/admin/footer.php"); ?>
