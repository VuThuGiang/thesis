<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
?>

<body>

    <div class="posts-list" style="margin-left: 320px;">
        <h2>List Of Category</h2>
        <a href="/admin/category/create.php" style=" margin-left: 35px; margin-top: 25px;" class="btn-add">Add new cate</a>

        <table class="table table-borderd" style="margin-top: 20px; width: 70%;">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
                include('/laragon/www/dulich/connection.php');
                $sqlInsert = "SELECT * FROM `category`";
                $result = mysqli_query($con, $sqlInsert);
                $i = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data["name"] ?></td>

                        <td>
                            <a href="edit.php?id=<?php echo $data["id"] ?>" class="btn btn-edit">Edit</a>
                            <a href="delete.php?id=<?php echo $data["id"] ?>" class="btn btn-delete">Delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php
                }
                ?>
                
            </tbody>

        </table>
</body>
<?php require("../footer.php") ?>