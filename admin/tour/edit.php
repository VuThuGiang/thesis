<?php
require("/laragon/www/dulich/admin/header.php");
require('/laragon/www/dulich/admin/sider.php');
require('/laragon/www/dulich/connection.php');

// Lấy thông tin từ database dựa vào ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ép kiểu để chống SQL Injection

    $sql = "SELECT * FROM tours WHERE id=$id";
    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        $tour = $result->fetch_assoc();
    } else {
        die("Tour not found or query failed.");
    }
} else {
    die("Invalid tour ID.");
}
// Lấy danh sách địa điểm
$sql_locations = "SELECT id, name FROM location";
$result_locations = $con->query($sql_locations);
$locations = [];
while ($row = $result_locations->fetch_assoc()) {
    $locations[] = $row;
}

?>

<?php require('/laragon/www/dulich/admin/include/Hedit_tour.php') ?>

<body>

    <div class="posts-list">
        <h2>Edit Tour</h2>
        <form action="process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($tour['id']); ?>">

            <div class="form-group">
                <label for="tour_name">Tour Name</label>
                <input type="text" id="tour_name" name="tour_name" value="<?php echo htmlspecialchars($tour['tour_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($tour['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="time_tour">Time of tour</label>
                <textarea id="time_tour" name="time_tour" required><?php echo htmlspecialchars($tour['time_tour']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control-file">
                <img src="/admin/anh/<?php echo htmlspecialchars($tour['image']); ?>" alt="Current Image" style="width: 150px; margin-top: 10px;">
            </div>
            <div class="form-group">
                <label for="adult_price">Adult Price</label>
                <input type="number" id="adult_price" name="adult_price" value="<?php echo htmlspecialchars($tour['adult_price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="child_price">Child Price</label>
                <input type="number" id="child_price" name="child_price" value="<?php echo htmlspecialchars($tour['child_price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($tour['price']); ?>" required>
            </div>

            <div class="form-group">
                <label for="create_day">Create day</label>
                <input type="date" id="create_day" name="create_day" value="<?php echo htmlspecialchars($tour['created_at']); ?>" required>
            </div>

            <div class="form-group">
                <label for="category">Travel Style</label>
                <select id="category" name="category">
                    <option value="">-- Please Select --</option>
                    <!-- Add category options here -->
                </select>
            </div>

            <!-- Thêm dropdown cho Location -->
            <div class="form-group">
                <label for="location_id">Location</label>
                <select id="location_id" name="location_id" required>
                    <option value="">-- Please Select Location --</option>
                    <?php
                    foreach ($locations as $location) {
                        $selected = $location['id'] == $tour['location_id'] ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($location['id']) . '" ' . $selected . '>' . htmlspecialchars($location['name']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="itinerary">Itinerary</label>
                <div id="itinerary_container">
                    <?php
                    $itineraryArray = json_decode($tour['Itinerary'], true);
                    if (!empty($itineraryArray)) {
                        foreach ($itineraryArray as $index => $itinerary) {
                    ?>
                            <div class="itinerary-item">
                                <h4>Itinerary Item</h4>
                                <label for="day">Day</label>
                                <input type="text" name="itinerary_days[]" value="<?php echo htmlspecialchars($itinerary['day'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Day">

                                <label for="title">Title</label>
                                <input type="text" name="itinerary_titles[]" value="<?php echo htmlspecialchars($itinerary['title'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Title">

                                <label for="morning">Morning Activities</label>
                                <?php
                                if (is_array($itinerary['activities']['morning'])) {
                                    foreach ($itinerary['activities']['morning'] as $morningActivity) {
                                ?>
                                        <textarea name="itinerary_morning[<?php echo $index; ?>][]" placeholder="Morning activities"><?php echo htmlspecialchars($morningActivity, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <textarea name="itinerary_morning[<?php echo $index; ?>][]" placeholder="Morning activities"><?php echo htmlspecialchars($itinerary['activities']['morning'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                <?php
                                }
                                ?>
                                <button type="button" class="add-activity" data-target="morning" onclick="addActivity(this)">Add Another Morning Activity</button>

                                <label for="noon">Noon Activities</label>
                                <?php
                                if (is_array($itinerary['activities']['noon'])) {
                                    foreach ($itinerary['activities']['noon'] as $noonActivity) {
                                ?>
                                        <textarea name="itinerary_noon[<?php echo $index; ?>][]" placeholder="Noon activities"><?php echo htmlspecialchars($noonActivity, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <textarea name="itinerary_noon[<?php echo $index; ?>][]" placeholder="Noon activities"><?php echo htmlspecialchars($itinerary['activities']['noon'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                <?php
                                }
                                ?>
                                <button type="button" class="add-activity" data-target="noon" onclick="addActivity(this)">Add Another Noon Activity</button>

                                <label for="afternoon">Afternoon Activities</label>
                                <?php
                                if (is_array($itinerary['activities']['afternoon'])) {
                                    foreach ($itinerary['activities']['afternoon'] as $afternoonActivity) {
                                ?>
                                        <textarea name="itinerary_afternoon[<?php echo $index; ?>][]" placeholder="Afternoon activities"><?php echo htmlspecialchars($afternoonActivity, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <textarea name="itinerary_afternoon[<?php echo $index; ?>][]" placeholder="Afternoon activities"><?php echo htmlspecialchars($itinerary['activities']['afternoon'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                <?php
                                }
                                ?>
                                <button type="button" class="add-activity" data-target="afternoon" onclick="addActivity(this)">Add Another Afternoon Activity</button>

                                <label for="evening">Evening Activities</label>
                                <?php
                                if (is_array($itinerary['activities']['evening'])) {
                                    foreach ($itinerary['activities']['evening'] as $eveningActivity) {
                                ?>
                                        <textarea name="itinerary_evening[<?php echo $index; ?>][]" placeholder="Evening activities"><?php echo htmlspecialchars($eveningActivity, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <textarea name="itinerary_evening[<?php echo $index; ?>][]" placeholder="Evening activities"><?php echo htmlspecialchars($itinerary['activities']['evening'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                <?php
                                }
                                ?>
                                <button type="button" class="add-activity" data-target="evening" onclick="addActivity(this)">Add Another Evening Activity</button>

                                <button type="button" class="remove-item" onclick="removeItineraryItem(this)">Remove</button>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <button type="button" class="btn" onclick="addItineraryItem()">Add Item</button>
            </div>

            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>

    <script>
        function addItineraryItem() {
            var container = document.getElementById('itinerary_container');
            var item = document.createElement('div');
            item.className = 'itinerary-item';
            item.innerHTML = `
                <h4>Itinerary Item</h4>
                <label for="day">Day</label>
                <input type="text" name="itinerary_days[]" placeholder="Day">

                <label for="title">Title</label>
                <input type="text" name="itinerary_titles[]" placeholder="Title">

                <label for="morning">Morning Activities</label>
                <textarea name="itinerary_morning[]" placeholder="Morning activities"></textarea>

                <label for="noon">Noon Activities</label>
                <textarea name="itinerary_noon[]" placeholder="Noon activities"></textarea>

                <label for="afternoon">Afternoon Activities</label>
                <textarea name="itinerary_afternoon[]" placeholder="Afternoon activities"></textarea>

                <label for="evening">Evening Activities</label>
                <textarea name="itinerary_evening[]" placeholder="Evening activities"></textarea>

                <button type="button" class="remove-item" onclick="removeItineraryItem(this)">Remove</button>
            `;
            container.appendChild(item);
        }

        function addActivity(button) {
            var container = button.previousElementSibling;
            var newActivity = document.createElement('textarea');
            var target = button.getAttribute('data-target');
            newActivity.name = container.name;
            newActivity.placeholder = target.charAt(0).toUpperCase() + target.slice(1) + " activities";
            container.parentNode.insertBefore(newActivity, button);
        }

        function removeItineraryItem(button) {
            button.parentElement.remove();
        }
    </script>

    <?php require("../footer.php") ?>
</body>

</html>
