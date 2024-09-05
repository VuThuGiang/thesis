<?php
require("../header.php");
require('/laragon/www/dulich/connection.php');
?>

<body>
    <!-- -----------------------------------------Navigation------------------------------------------------ -->
    <?php
    require('/laragon/www/dulich/admin/sider.php');
    ?>
    <!-- --------------------------------------------------------------------------------------------------- -->
    <div class="container my-5" style="margin-left: 355px; width: 70%">
        <h2>List of Users</h2>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `user_form` WHERE `role` = 1";
                $result = $con->query($sql);

                if (!$result) {
                    die("Invalid query: " . $con->error);
                }

                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$i</td>
                        <td>$row[full_name]</td>
                        <td>$row[username]</td>
                        <td>$row[email]</td>
                        <td>
                            <a href='/admin/customer/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>
                    ";
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php require("../footer.php") ?>
</body>