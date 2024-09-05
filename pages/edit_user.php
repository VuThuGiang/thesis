<?php require("/laragon/www/dulich/include/nav.php"); ?>

<?php
// ktra user login ?
if (!isset($_SESSION['uid'])) {
    header("Location: /pages/login.php");
    exit();
}

// lay id tu ss
$user_id = $_SESSION['uid'];

// //ktra form gui ?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['full_name'], $_POST['dob'], $_POST['username'], $_POST['phoneNo'], $_POST['email'])) {
        $full_name = $_POST['full_name'];
        $dob = $_POST['dob'];
        $username = $_POST['username'];
        $phoneNo = $_POST['phoneNo'];
        $email = $_POST['email'];

        // var_dump($_FILES['img']['name']);

        if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
            $image_name = basename($_FILES['img']['name']);
            $image_tmp = $_FILES['img']['tmp_name'];

            $target_dir = "/assets/img/profile";
            $target_file = $target_dir . "/" . $image_name;

            if (move_uploaded_file($image_tmp, $target_file)) {
                $image_url = $target_file;
                $sql = "UPDATE `user_form` SET full_name='$full_name', dob='$dob', username='$username', phoneNo='$phoneNo', email='$email', img='$image_name' WHERE id='$user_id'";
                if ($con->query($sql) === TRUE) {
                    $_SESSION['avatar'] = $image_url;
                    echo "<script>alert('Cập nhật thông tin thành công');</script>";
                } else {
                    echo "Lỗi: " . $sql . "<br>" . $con->error;
                }
            } else {
                echo "Lỗi khi tải lên tệp hình ảnh.";
            }
        } else {
            // cap nhat ttin khac neu k co anh
            $sql = "UPDATE `user_form` SET full_name='$full_name', dob='$dob', username='$username', phoneNo='$phoneNo', email='$email' WHERE id='$user_id'";

            if ($con->query($sql) === TRUE) {
                echo "<script>alert('Cập nhật thông tin thành công');</script>";
            } else {
                echo "Lỗi: " . $sql . "<br>" . $con->error;
            }
        }
    }
}


// ycau doi mk ?
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT password FROM user_form WHERE id='$user_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db_password = $row['password'];

        // ktra pw htai
        if (password_verify($current_password, $db_password)) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // cap nhat pw ms
                $sql = "UPDATE `user_form` SET password='$hashed_password' WHERE id='$user_id'";
                if ($con->query($sql) === TRUE) {
                    echo "<script>alert('Đổi mật khẩu thành công');</script>";
                } else {
                    echo "Lỗi: " . $sql . "<br>" . $con->error;
                }
            } else {
                echo "<script>alert('Mật khẩu mới và xác nhận mật khẩu không khớp');</script>";
            }
        } else {
            echo "<script>alert('Mật khẩu hiện tại không đúng');</script>";
        }
    } else {
        echo "<script>alert('Không tìm thấy người dùng');</script>";
    }
}

// truy van user in4
$sql = "SELECT * FROM user_form WHERE id='$user_id'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // xhhien form edit
    while ($row = $result->fetch_assoc()) {
        $avatar_path = "/assets/img/profile/" . $row['img'];
?>


        <div id="main-content">
            <div id="account-settings">
                <div class="sidebar-container">
                    <div class="sidebar1">
                        <div class="profile1">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                <div class="profile1">
                                    <div class="avatar-container">
                                        <img id="profile_image_preview" name='img' alt="Avatar" src="<?php echo $avatar_path; ?>" class="profile-image">
                                        <label for="image" class="edit-avatar-label">
                                            <i class="fas fa-pencil-alt"></i>Edit Image
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar2">
                        <div class="menu-section1">
                            <h4>Cài đặt</h4>
                            <ul>
                                <li><a href="#" class="change-password-link">
                                        <div class="icon1">⚙️</div>Change Password
                                    </a></li>
                                <li><a href="#">
                                        <div class="icon1">💌</div>Phiếu Khuyến Mãi KKday
                                    </a></li>
                                <li><a href="#">
                                        <div class="icon1">🪙</div>KKday Points
                                    </a></li>
                                <li><a href="#">
                                        <div class="icon1">🏆</div>Thử Thách & Ghi Điểm
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container1">
                    <div class="form-section1">
                        <h3>Cài đặt tài khoản</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

                            <div class="form-group1">
                                <label for="full_name">Fullname</label>
                                <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>" required>
                            </div>
                            <div class="form-group1">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>
                            </div>
                            <div class="form-group1">
                                <label for="birth-date">Birth-day</label>
                                <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>" required>
                            </div>
                            <div class="form-group1">
                                <label for="phone">PhoneNumber</label>
                                <input type="number" id="phoneNo" name="phoneNo" value="<?php echo $row['phoneNo']; ?>" required>
                            </div>
                            <div class="form-group1">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                            </div>
                            <div class="save-button1">
                                <input type="file" id="image" name="img" accept="image/*" style="display: none;">
                                <button type="submit" class="submit-btn">Save Changes</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- form change pw -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" id="current_password" name="current_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="/assets/js/edit_user.js"></script>

<?php
    }
} else {
    echo "Không tìm thấy thông tin người dùng.";
}

?>
<?php require("/laragon/www/dulich/include/footer.php"); ?>