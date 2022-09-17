<?php
header("Content-Type: application/json");
require_once "connection.php";

$response = array();


//get id and think about things that can be updated - if we all have this...
if (isset($_POST['id']) && isset($_POST['storyline']) && isset($_POST['stars']) && isset($_POST['box_office'])) {
    //move on and update movie
    $id = $_POST['id'];
    $storyline = $_POST['storyline'];
    $stars = $_POST['stars'];
    $box_office = $_POST['box_office'];

    $stmt = $connection->prepare(
        "UPDATE movies 
            SET storyline='$storyline', 
                stars='$stars', 
                box_office='$box_office' 
            WHERE id='$id' "
    );

    if ($stmt->execute()) {

        $response['error'] = false;
        $response['message'] = "Movie updated successfully.";
    } else {
        $response['error'] = true;
        $response['message'] = "Failed to update Movie.";
    }
} else {
    $response['error'] = false;
    $response['message'] = "Please provide id, storyline, box office and stars";
}

echo json_encode($response);
