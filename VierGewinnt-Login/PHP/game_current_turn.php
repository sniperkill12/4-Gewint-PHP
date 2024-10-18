<?php
    require "db_connection.php";
    $token = $_COOKIE["token"];

    $sql = "SELECT state_of_game, turn, player1, player2 FROM games WHERE player1 = '".$token."' OR player2 = '".$token."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($row["player2"] == "")
    {
        echo "<h1>Waiting for opponent to join</h1>";
    }

    else if($token == $row["turn"])
    {
        echo "<h1>It's your turn</h1>";
    }

    else
    {
        echo "<h1>Waiting for opponent's turn</h1>";
    }
?>