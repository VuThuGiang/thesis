<?php

function get_setting($con, $key)
{
    $sql = "SELECT setting_value FROM settings WHERE setting_key = ?";
    $stmt = $con->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param("s", $key);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result === false) {
        die('Get result failed: ' . htmlspecialchars($stmt->error));
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close(); // Đóng statement
        return $row['setting_value'];
    } else {
        $stmt->close(); // Đóng statement
        return "";
    }
}

function update_setting($con, $key, $value)
{
    $sql = "INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)";
    $stmt = $con->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param("ss", $key, $value);
    $executionResult = $stmt->execute();

    if ($executionResult === false) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close(); // Đóng statement
    return $executionResult;
}
