
<?php 
$id = $_GET["id"];
if($id){
    include("/laragon/www/dulich/connection.php");
    $sqlDelete = "DELETE FROM `location` WHERE `id` = $id";
    if(mysqli_query($con, $sqlDelete)){
        header("Location: location.php");
    }
    else{
        die("Infor is not Delete");
    }
}
    else{
        echo "Post not found";
    }

?>