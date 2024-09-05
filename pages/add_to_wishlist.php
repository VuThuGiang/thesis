<?php
require("/laragon/www/dulich/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tour_id = $_POST['tour_id'];
    $user_id = $_POST['user_id'];

    // Check if already in wishlist
    $query = "SELECT * FROM wishlist WHERE user_id = ? AND tour_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ii', $user_id, $tour_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Add to wishlist
        $insert_query = "INSERT INTO wishlist (user_id, tour_id) VALUES (?, ?)";
        $stmt = $con->prepare($insert_query);
        $stmt->bind_param('ii', $user_id, $tour_id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to execute insert query.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Tour is already in wishlist.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>
