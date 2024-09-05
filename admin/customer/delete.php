<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];
    require('/laragon/www/dulich/connection.php');
    $sql= "DELETE FROM `user_form` WHERE `id`= $id";
    $con ->query($sql);

}
header("location: usermanager.php");
exit;
?>