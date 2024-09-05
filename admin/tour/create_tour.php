<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
require("/laragon/www/dulich/admin/include/Hcreate_tour.php");
include('/laragon/www/dulich/connection.php'); // Kết nối đến cơ sở dữ liệu

// Truy vấn bảng location để lấy danh sách các địa điểm
$sql = "SELECT id, name FROM location";
$result = mysqli_query($con, $sql);

// Tạo một mảng để lưu các địa điểm
$locations = [];
while ($row = mysqli_fetch_assoc($result)) {
    $locations[] = $row;
}
?>

<body>
    <div class="posts-list" style="margin-left: 330px; width: 80%;">
        <h2>Add New Tour</h2>
        <form action="process.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tour_name">Tour Name</label>
                <input type="text" id="tour_name" name="tour_name" placeholder="Tour Name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Description" required></textarea>
            </div>
            <div class="form-group">
                <label for="time_tour">Time of tour</label>
                <textarea id="time_tour" name="time_tour" placeholder="Time_tour" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control-file" required>
            </div>
            <div class="form-group">
                <label for="adult_price">Adult Price</label>
                <input type="number" id="adult_price" name="adult_price" placeholder="Adult Price" required>
            </div>
            <div class="form-group">
                <label for="child_price">Child Price</label>
                <input type="number" id="child_price" name="child_price" placeholder="Child Price" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" placeholder="Price" required>
            </div>

            <div class="form-group">
                <label for="create_day">Create day</label>
                <input type="date" id="create_day" name="create_day" required>
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
                        echo '<option value="' . htmlspecialchars($location['id']) . '">' . htmlspecialchars($location['name']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="itinerary">Itinerary</label>
                <div id="itinerary_container">
                    <div class="itinerary-item">
                        <h4>Itinerary Item</h4>
                        <label for="day">Day</label>
                        <input type="text" name="itinerary_days[]" placeholder="Day">

                        <label for="title">Title</label>
                        <input type="text" name="itinerary_titles[]" placeholder="Title">

                        <label for="morning">Morning Activities</label>
                        <div id="morning_container_0">
                            <textarea name="itinerary_morning[0][]" placeholder="Morning activities"></textarea>
                        </div>
                        <button type="button" class="btn-secondary" onclick="addActivity(this, 'morning', 0)">Add Another Morning Activity</button>

                        <label for="noon">Noon Activities</label>
                        <div id="noon_container_0">
                            <textarea name="itinerary_noon[0][]" placeholder="Noon activities"></textarea>
                        </div>
                        <button type="button" class="btn-secondary" onclick="addActivity(this, 'noon', 0)">Add Another Noon Activity</button>

                        <label for="afternoon">Afternoon Activities</label>
                        <div id="afternoon_container_0">
                            <textarea name="itinerary_afternoon[0][]" placeholder="Afternoon activities"></textarea>
                        </div>
                        <button type="button" class="btn-secondary" onclick="addActivity(this, 'afternoon', 0)">Add Another Afternoon Activity</button>

                        <label for="evening">Evening Activities</label>
                        <div id="evening_container_0">
                            <textarea name="itinerary_evening[0][]" placeholder="Evening activities"></textarea>
                        </div>
                        <button type="button" class="btn-secondary" onclick="addActivity(this, 'evening', 0)">Add Another Evening Activity</button>

                        <button type="button" class="remove-item" onclick="removeItineraryItem(this)">Remove</button>
                    </div>
                </div>
                <button type="button" class="btn" onclick="addItineraryItem()">Add Item</button>
            </div>

            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>

    <script>
        let itineraryIndex = 1;

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
                <div id="morning_container_${itineraryIndex}">
                    <textarea name="itinerary_morning[${itineraryIndex}][]" placeholder="Morning activities"></textarea>
                </div>
                <button type="button" class="btn-secondary" onclick="addActivity(this, 'morning', ${itineraryIndex})">Add Another Morning Activity</button>

                <label for="noon">Noon Activities</label>
                <div id="noon_container_${itineraryIndex}">
                    <textarea name="itinerary_noon[${itineraryIndex}][]" placeholder="Noon activities"></textarea>
                </div>
                <button type="button" class="btn-secondary" onclick="addActivity(this, 'noon', ${itineraryIndex})">Add Another Noon Activity</button>

                <label for="afternoon">Afternoon Activities</label>
                <div id="afternoon_container_${itineraryIndex}">
                    <textarea name="itinerary_afternoon[${itineraryIndex}][]" placeholder="Afternoon activities"></textarea>
                </div>
                <button type="button" class="btn-secondary" onclick="addActivity(this, 'afternoon', ${itineraryIndex})">Add Another Afternoon Activity</button>

                <label for="evening">Evening Activities</label>
                <div id="evening_container_${itineraryIndex}">
                    <textarea name="itinerary_evening[${itineraryIndex}][]" placeholder="Evening activities"></textarea>
                </div>
                <button type="button" class="btn-secondary" onclick="addActivity(this, 'evening', ${itineraryIndex})">Add Another Evening Activity</button>

                <button type="button" class="remove-item" onclick="removeItineraryItem(this)">Remove</button>
            `;
            container.appendChild(item);
            itineraryIndex++;
        }

        function addActivity(button, period, index) {
            var container = document.getElementById(period + '_container_' + index);
            var newActivity = document.createElement('textarea');
            newActivity.name = `itinerary_${period}[${index}][]`;
            newActivity.placeholder = period.charAt(0).toUpperCase() + period.slice(1) + " activities";
            container.appendChild(newActivity);
        }

        function removeItineraryItem(button) {
            button.parentElement.remove();
        }
    </script>

    <?php require("../footer.php") ?>
</body>
