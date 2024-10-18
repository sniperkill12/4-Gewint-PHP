<?php
    require "db_connection.php";
    $token = $_COOKIE["token"];

    $sql = "SELECT state_of_game, turn, player1, player2 FROM games WHERE player1 = '".$token."' OR player2 = '".$token."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(isset($_GET['turn']))
    {
        if($token == $row["turn"] && $row["player2"] != "")
        {
            $i = $_GET['turn'];

            if(intval($i) >= 0 && intval($i) <= 6)
            {           
                //Set i to lowest of row
                $i += 35;

                while($i >= 0)
                {
                    if($row["state_of_game"][$i] == 0)
                    {
                        if($token == $row["player1"])
                        {
                            $row["state_of_game"][$i] = 1;
                            $sql = "UPDATE games SET state_of_game = '".$row["state_of_game"]."', turn = '".$row["player2"]."' WHERE player1 = '".$token."' OR player2 = '".$token."'"; 
                        }

                        else
                        {
                            $row["state_of_game"][$i] = 2;
                            $sql = "UPDATE games SET state_of_game = '".$row["state_of_game"]."', turn = '".$row["player1"]."' WHERE player1 = '".$token."' OR player2 = '".$token."'"; 
                        }

                        $conn->query($sql);
                        break;
                    }

                    $i -= 7;
                }
                
                if($i < 0)
                {
                    echo "Invalid turn, please choose another turn";
                }
            }
        }
    }
?>