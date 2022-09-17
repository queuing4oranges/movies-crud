<?php
header("Content-Type: application/json");
require_once "connection.php";

$response = array();

//provide movie id
if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $stmt = $connection->prepare("DELETE FROM movies WHERE id=? LIMIT 1"); //limit to 1 so you dont delete accidentally more
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $response['error'] = false;
        $response['message'] = "Movie successfully deleted.";
    } else {
        $response['error'] = true;
        $response['message'] = "Could not delete movie.";
    }
} else {
    $response['error'] = true;
    $response['message'] = "Please provide a movie id.";
}

echo json_encode($response);
