<?php
require('/laragon/www/dulich/connection.php');
session_start();

$response = ['status' => 'error', 'message' => 'Something went wrong'];

if (isset($_POST['tour_id'], $_POST['rating'], $_POST['review'])) {
    $tour_id = $_POST['tour_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $user_id = $_SESSION['uid'];

    $query = "INSERT INTO reviews (tour_id, user_id, rating, review) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param('iiis', $tour_id, $user_id, $rating, $review);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Review submitted successfully';
    } else {
        $response['message'] = 'Failed to submit review';
    }

    $stmt->close();
}

echo json_encode($response);
?>
