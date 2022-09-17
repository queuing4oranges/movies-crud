<?php
header("Content-Type: application/json");
require_once "connection.php";

$response = array();

//give DB title of movie
if (isset($_GET['title'])) {
    $title = $_GET['title'];   //get request parameter, which has the title

    //we need to use the connection
    $stmt = $connection->prepare("SELECT id, title, storyline, lang, genre, release_date, box_office, run_time, stars 
                        FROM movies WHERE title = ?"); //the ? is replaced with the parameter that is defined with bind_param()
    $stmt->bind_param("s", $title); //fct appends/substitutes title to the query and takes two parameters: 1.type of data / 2.variable itself


    if ($stmt->execute()) {

        $stmt->bind_result($id, $title, $storyline, $lang, $genre, $release_date, $box_office, $run_time, $stars);
        $stmt->fetch(); //this fct is getting the result
        //store results that we fetched:
        $movie = array(
            'id' => $id,
            'title' => $title,
            'storyline' => $storyline,
            'lang' => $lang,
            'genre' => $genre,
            'release_date' => $release_date,
            'box_office' => $box_office,
            'run_time' => $run_time,
            'stars' => $stars
        );

        $response['error']  = false;
        $response['movie']  = $movie;
        $response['message'] = "movie has been returned successfully";
    } else {
        $response['error']  = true;
        $response['message'] = "we could not get the movie";
    }

    //here movie hasnt been provided
} else {
    $response['error'] = true;
    $response['message'] = "please provide a movie title";
}

echo json_encode($response);
