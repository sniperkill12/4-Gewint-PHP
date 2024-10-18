<?php
    require "db_connection.php";
    $token = $_COOKIE["token"];

    $sql = "SELECT player1 FROM games WHERE player1 = '".$token."' OR player2 = '".$token."'";
    $result = $conn->query($sql);
    
    if($result->num_rows == 0)
    {
        $sql = "SELECT player2 FROM games WHERE id = '".$_GET['id']."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if($row["player2"] == "")
        {
            $sql = "UPDATE games SET player2 = '".$token."' WHERE id = '".$_GET['id']."'";
            $result = $conn->query($sql);
            echo "game joined";
        }

        else
        {
            echo "Sadly the game is already taken";
        }
    }

    else
    {
        echo "You are already part of a game";
    }
?>