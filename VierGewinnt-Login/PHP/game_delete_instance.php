<?php
    require "db_connection.php";
    $token = $_COOKIE["token"];

    $sql = "DELETE FROM games WHERE player1 = '".$token."' OR player2 = '".$token."'";
    $conn->query($sql);
?>