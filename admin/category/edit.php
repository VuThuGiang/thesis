<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
?>

<?php
$id = $_GET['id'];
if ($id) {
    include("/laragon/www/dulich/connection.php");
    $sqlEdit = "SELECT * FROM `category` WHERE `id` = $id";
    $result = mysqli_query($con, $sqlEdit);
} else {
    echo " No post found";
}


?>

<div class="create-form " style="margin-left: 400px;">
    <form action="/admin/category/process.php" method="post" enctype="multipart/form-data">
    <?php
            while ($data = mysqli_fetch_array($result)) {


            ?>
        <div class="form-field">
            <input type="text" name="name" class="form-control" placeholder="Enter Name:" value="<?php echo $data['name']; ?>" id="">
        </div>

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-field">
            <input type="submit" value="Update" class="btn btn-primary" name="update">
        </div>
        <?php
            }
            ?>
    </form>
</div>




</body>
<?php require("../footer.php") ?>