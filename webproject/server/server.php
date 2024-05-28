<?php 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proj_1";

    // Create Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed" . mysqli_connect_error());
    } 

?>