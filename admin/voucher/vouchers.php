<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
include('/laragon/www/dulich/connection.php');

// Lấy dữ liệu từ bảng vouchers
$sql = "SELECT * FROM vouchers";
$result = mysqli_query($con, $sql);

// Khởi tạo biến đếm số thứ tự
$counter = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Vouchers</title>
    <style>
        /* Styles for the alert message */
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            z-index: 1000;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="posts-list" style="margin-left: 330px; width: 95%;">
        <h2>List Of Vouchers</h2>
        <a href="/admin/voucher/create_voucher.php" style="margin-left: 35px; margin-top: 25px;" class="btn btn-add">Add New Voucher</a>
        <a href="/admin/voucher/add_voucher_to_tour.php" style="margin-left: 35px; margin-top: 25px;" class="btn btn-add">Add Voucher to Tour</a>

        <!-- Hiển thị thông báo nếu có -->
        <?php
        if (isset($_GET['msg'])) {
            echo '<div id="alert-box" class="alert">' . htmlspecialchars($_GET['msg']) . '</div>';
        }
        ?>

        <table class="table table-bordered" style="margin-top: 20px; width: 80%;">
            <thead>
                <tr>
                    <th>STT</th>
                    <th style="width: 20%;">Voucher Code</th>
                    <th>Discount (%)</th>
                    <th>Validity Start</th>
                    <th>Validity End</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($data["voucher_code"]); ?></td>
                        <td><?php echo $data["discount"]; ?>%</td>
                        <td><?php echo $data["validity_start"]; ?></td>
                        <td><?php echo $data["validity_end"]; ?></td>
                        <td><?php echo $data["quantity"]; ?></td>
                        <td>
                            <button class="btn btn-edit" onclick='openEditModal(<?php echo json_encode($data); ?>)'>Edit</button>
                            <button class="btn btn-delete" onclick="confirmDelete(<?php echo $data['voucher_id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="editVoucherModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Voucher</h2>
            <form id="editVoucherForm">
                <input type="hidden" id="edit_voucher_id" name="voucher_id">
                <div class="form-group">
                    <label for="edit_voucher_code">Voucher Code</label>
                    <input type="text" id="edit_voucher_code" name="voucher_code" required>
                </div>
                <div class="form-group">
                    <label for="edit_discount">Discount (%)</label>
                    <input type="number" id="edit_discount" name="discount" required>
                </div>
                <div class="form-group">
                    <label for="edit_validity_start">Validity Start</label>
                    <input type="date" id="edit_validity_start" name="validity_start" required>
                </div>
                <div class="form-group">
                    <label for="edit_validity_end">Validity End</label>
                    <input type="date" id="edit_validity_end" name="validity_end" required>
                </div>
                <div class="form-group">
                    <label for="edit_quantity">Quantity</label>
                    <input type="number" id="edit_quantity" name="quantity" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        // Tự động ẩn thông báo sau 2 giây
        setTimeout(function() {
            var alertBox = document.getElementById('alert-box');
            if (alertBox) {
                alertBox.style.opacity = '0';
                setTimeout(function() {
                    alertBox.style.display = 'none';
                }, 500); // Chờ thêm 0.5s sau khi ẩn trước khi xóa hoàn toàn
            }
        }, 2000);

        // Hàm mở modal và điền thông tin voucher vào form
        function openEditModal(voucher) {
            document.getElementById('edit_voucher_id').value = voucher.voucher_id;
            document.getElementById('edit_voucher_code').value = voucher.voucher_code;
            document.getElementById('edit_discount').value = voucher.discount;
            document.getElementById('edit_validity_start').value = voucher.validity_start;
            document.getElementById('edit_validity_end').value = voucher.validity_end;
            document.getElementById('edit_quantity').value = voucher.quantity;
            document.getElementById('editVoucherModal').style.display = "block";
        }

        // Hàm đóng modal
        function closeModal() {
            document.getElementById('editVoucherModal').style.display = "none";
        }

        // Gửi dữ liệu form chỉnh sửa qua AJAX
        document.getElementById('editVoucherForm').onsubmit = function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            fetch('edit_voucher.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        alert('Voucher updated successfully!');
                        location.reload(); // Tải lại trang để cập nhật thay đổi
                    } else {
                        alert('Error updating voucher.');
                    }
                })
                .catch(error => console.error('Error:', error));
        };

        // Xác nhận xóa voucher
        function confirmDelete(voucherId) {
            if (confirm('Are you sure you want to delete this voucher?')) {
                window.location.href = 'delete_voucher.php?id=' + voucherId;
            }
        }
    </script>

    <script src="../assets/js/voucher.js"></script>
</body>

<?php require("../footer.php") ?>
