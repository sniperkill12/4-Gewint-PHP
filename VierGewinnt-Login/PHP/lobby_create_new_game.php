<?php
    require "db_connection.php";
    $token = $_COOKIE["token"];

    //Check if user doesn't already have an open game
    $sql = "SELECT player1 FROM games WHERE player1 = '".$token."' OR player2 = '".$token."'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) 
    {
        echo "You are already part of a game_session. Press 'Continue Game' to continue the game";
    } 

    else if($result->num_rows == 0)
    {
        $sql = "INSERT INTO games (player1, turn, state_of_game) VALUES ('".$token."', '".$token."', '000000000000000000000000000000000000000000')";
        $conn->query($sql); 

        echo "successfully created";
    }
?>