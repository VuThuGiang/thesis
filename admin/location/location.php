<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
?>

<body>

    <div class="posts-list" style="margin-left: 320px;">
        <h2>List Of Foods</h2>
        <a href="/admin/location/create.php" style=" margin-left: 35px; margin-top: 25px;" class="btn-add">Add new location</a>

        <table class="table table-borderd" style="margin-top: 20px; width: 95%;">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
                include('/laragon/www/dulich/connection.php');
                $sqlInsert = "SELECT * FROM `location`";
                $result = mysqli_query($con, $sqlInsert);
                $i = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data["name"] ?></td>

                        <td>
                            <img src="/admin/anh/<?php echo $data['image_url']; ?> " style="width: 80px; height: 60px;">
                        </td>

                        <td>
                            <a href="view.php?id=<?php echo $data["id"] ?>" class="btn btn-view">View</a>
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