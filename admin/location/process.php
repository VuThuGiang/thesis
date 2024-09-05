<?php include("/laragon/www/dulich/connection.php"); ?>

<?php
if (isset($_POST["create"])) {
    $name = mysqli_real_escape_string($con, $_POST["name"]);

    // Xử lý tệp hình ảnh
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']);
        $targetDir = '../admin/anh';
        $targetFile = $imageName;


        // Di chuyển tệp đã tải lên thư mục đích
        if (move_uploaded_file($image['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $targetFile)) {
            $imageURL = $targetFile;
        } else {
            die("Error uploading file");
        }
    } else {
        $imageURL = '';
    }

    $sqlInsert = "INSERT INTO `location`(`name`, `image_url`) VALUES ('$name','$imageURL')";
    if (mysqli_query($con, $sqlInsert)) {
        header("Location: location.php");
    } else {
        die("Error: " . mysqli_error($con));
    }
}
?>
<?php
if (isset($_POST["update"])) {
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $id =  mysqli_real_escape_string($con, $_POST["id"]);
    $imageURL = '';

    // Xử lý tệp hình ảnh nếu có
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']);
        $targetDir = '/admin/anh/';
        $targetFile = $imageName;


        // Di chuyển tệp đã tải lên thư mục đích
        if (move_uploaded_file($image['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $targetFile)) {
            $imageURL = $imageName; 
        } else {
            die("Error uploading file");
        }
    }

    // Cập nhật bài viết trong cơ sở dữ liệu, bao gồm cả URL hình ảnh nếu có
    if ($imageURL !== '') {
        $sqlUpdate = "UPDATE `location` SET `name` = '$name', `image_url` = '$imageURL' WHERE `id`= $id";
    } else {
        $sqlUpdate = "UPDATE `location` SET  `name` = '$name' WHERE `id`= $id";
    }

    if (mysqli_query($con, $sqlUpdate)) {
        header("Location: location.php");
        exit;
    } else {
        die("Error: " . mysqli_error($con));
    }
}
?>


