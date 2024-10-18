<?php 
    // Connects to my Database 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "viergewinnt";

    $conn = new mysqli($servername, $username, $password, $dbname); 

    if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
?> 