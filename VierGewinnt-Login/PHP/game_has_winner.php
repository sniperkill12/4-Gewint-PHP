<?php
    require "db_connection.php";
    $token = $_COOKIE["token"];

    $sql = "SELECT state_of_game, turn, player1, player2 FROM games WHERE player1 = '".$token."' OR player2 = '".$token."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    //Check if Winner is recided
    //Check, if its winner or loser and handle asynchron
    for($c = 0; $c < 21; $c++)
    {
        if($row["state_of_game"][$c] == 1 && $row["state_of_game"][$c + 7] == 1 && $row["state_of_game"][$c + 14] == 1 && $row["state_of_game"][$c + 21] == 1)
        {
            echo $row["player1"]; 
            return;
        }
        
        else if($row["state_of_game"][$c] == 2 && $row["state_of_game"][$c + 7] == 2 && $row["state_of_game"][$c + 14] == 2 && $row["state_of_game"][$c + 21] == 2)
        {
            echo $row["player2"]; 
            return;
        }
    }

    for($c = 0; $c < 39; $c++)
    {
        if($row["state_of_game"][$c] == 1 && $row["state_of_game"][$c + 1] == 1 && $row["state_of_game"][$c + 2] == 1 && $row["state_of_game"][$c + 3] == 1)
        {
            echo $row["player1"]; 
            return;
        }

        else if($row["state_of_game"][$c] == 2 && $row["state_of_game"][$c + 1] == 2 && $row["state_of_game"][$c + 2] == 2 && $row["state_of_game"][$c + 3] == 2)
        {
            echo $row["player2"]; 
            return;
        }

        if($c % 7 == 3)
        {
            $c += 3;
        }
    }

    for($c = 0; $c < 18; $c++)
    {
        if($row["state_of_game"][$c] == 1 && $row["state_of_game"][$c + 8] == 1 && $row["state_of_game"][$c + 16] == 1 && $row["state_of_game"][$c + 24] == 1)
        {
            echo $row["player1"]; 
            return;
        }

        else if($row["state_of_game"][$c] == 2 && [$c + 8] == 2 && $row["state_of_game"][$c + 16] == 2 && $row["state_of_game"][$c + 24] == 2)
        {
            echo $row["player2"]; 
            return;
        }

        if($c % 7 == 3)
        {
            $c += 3;
        }
    }

    for($c = 0; $c < 18; $c++)
    {
        if($row["state_of_game"][$c + 3] == 1 && $row["state_of_game"][$c + 9] == 1 && $row["state_of_game"][$c + 15] == 1 && $row["state_of_game"][$c + 21] == 1)
        {
            echo $row["player1"]; 
            return;
        }

        else if($row["state_of_game"][$c + 3] == 2 && $row["state_of_game"][$c + 9] == 2 && $row["state_of_game"][$c + 15] == 2 && $row["state_of_game"][$c + 21] == 2)
        {
            echo $row["player2"]; 
            return;
        }

        if($c % 7 == 3)
        {
            $c += 3;
        }
    }

    echo "false";
?>
