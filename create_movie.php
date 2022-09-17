<?php
header("Content-Type: application/json");
require_once "connection.php";

$response = array();

if (
    isset($_POST['title'])
    && isset($_POST['storyline'])
    && isset($_POST['lang'])
    && isset($_POST['genre'])
    && isset($_POST['release_date'])
    && isset($_POST['box_office'])
    && isset($_POST['run_time'])
    && isset($_POST['stars'])
) {

    //store parameters in variables; we get title from user, but then we need to pass it into the insert statement, so in the first place - values will replace the question marks 
    $title = $_POST['title'];
    $storyline = $_POST['storyline'];
    $lang = $_POST['lang'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $box_office = $_POST['box_office'];
    $run_time = $_POST['run_time'];
    $stars = $_POST['stars'];


    //continue, when we have all params
    $stmt =   $connection->prepare("INSERT INTO movies (title, storyline, lang, genre, release_date, box_office, run_time, stars)
                       VALUES (?,?,?,?,?,?,?,?)");

    //if it is float = d
    $stmt->bind_param('sssssdsd', $title, $storyline, $lang, $genre, $release_date, $box_office, $run_time, $stars);

    //execute query
    if ($stmt->execute()) {
        $response['error'] = false;
        $response['message'] = "Movie inserted successfully.";

        $stmt->close();
    } else {
        $response['error'] = true;
        $response['message'] = "Failed to insert to database.";
    }
} else { //in case we dont have the parameters
    $response['error'] = true;
    $response['message'] = "Please provide the parameters to insert the movie.";
}

echo json_encode($response);
