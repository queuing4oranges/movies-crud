<?php
//specify a header (best practice)
header("Content-Type: application/json");
//import the connection
require_once "connection.php";

$response = array(); //in case of success, the user will get this array - see below what it contains

//select data we want from DB
$stmt = $connection->prepare("SELECT * FROM movies");


//execute and check query - success / error ?
if ($stmt->execute()) {

    //array stores all of the results
    $movies = array();
    $result = $stmt->get_result();

    //looping and getting single row - will be stored in movies array
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $movies[] = $row;
    }

    //in case of success:
    $response['error'] = false;
    $response['movies'] = $movies;
    $response['message'] = "movies returned successfully";
    $stmt->close(); //not mandatory - best practice to close query

} else {
    $response['error'] = true; //there is an error
    $response['message'] = "oops, could not execute query";
    $response['response_code'] = 400;
}

//display results

echo json_encode($response);
