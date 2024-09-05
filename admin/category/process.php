<?php include("/laragon/www/dulich/connection.php"); ?>

<?php
if (isset($_POST["create"])) {
    $name = mysqli_real_escape_string($con, $_POST["name"]);

    $sqlInsert = "INSERT INTO `category`(`name`) VALUES ('$name')";
    if (mysqli_query($con, $sqlInsert)) {
        header("Location: category.php");
    } else {
        die("Error: " . mysqli_error($con));
    }
}
?>
<?php
if (isset($_POST["update"])) {
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $id =  mysqli_real_escape_string($con, $_POST["id"]);

    // Cập nhật bài viết trong cơ sở dữ liệu, bao gồm cả URL hình ảnh nếu có
    
        $sqlUpdate = "UPDATE `category` SET  `name` = '$name' WHERE `id`= $id";
    

    if (mysqli_query($con, $sqlUpdate)) {
        header("Location: category.php");
        exit;
    } else {
        die("Error: " . mysqli_error($con));
    }
}
?>


