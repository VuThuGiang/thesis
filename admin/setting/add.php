<?php
include '/laragon/www/dulich/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $key = $_POST['key'];
    $value = $_POST['value'];
    $sql = "INSERT INTO settings (key_name, value_text) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $key, $value);
    $stmt->execute();
    echo 'Addition successful';
}
