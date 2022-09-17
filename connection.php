<?php
/* see in browser:
1. either phpmyAdmin -> admin and then file or
2. php -S localhost:8080 (then in browser: localhost:8080/connection.php)
*/

//stop error reporting and use the custom ones
error_reporting(0);

//setting up DB credentials
$server_name    = "127.0.0.1";
$mysql_username = "root";
$mysql_password = "";
$db_name        = "movies_api";

//connecting to DB
$connection = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);

//checking connection + displaying msg
if (!$connection) {
    echo '{"message":"Ooops, unable to connect to database"}';

    //stop when not able to connect:
    die();
} else {
    echo "successfully connected to database";
}
