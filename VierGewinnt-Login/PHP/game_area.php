<?php
    require('db_connection.php');     
    $token = $_COOKIE["token"];     
 
    //Check, if color is valid
    $color_p1 = "red";
    $color_p2 = "yellow";

    if($_COOKIE["color_p1"] == "black" || 
       $_COOKIE["color_p1"] == "blue" || 
       $_COOKIE["color_p1"] == "brown" || 
       $_COOKIE["color_p1"] == "orange" || 
       $_COOKIE["color_p1"] == "pink" || 
       $_COOKIE["color_p1"] == "purple" || 
       $_COOKIE["color_p1"] == "red" || 
       $_COOKIE["color_p1"] == "yellow")
    {
        $color_p1 = $_COOKIE["color_p1"];
    }

    if($_COOKIE["color_p2"] == "black" || 
       $_COOKIE["color_p2"] == "blue" || 
       $_COOKIE["color_p2"] == "brown" || 
       $_COOKIE["color_p2"] == "orange" || 
       $_COOKIE["color_p2"] == "pink" || 
       $_COOKIE["color_p2"] == "purple" || 
       $_COOKIE["color_p2"] == "red" || 
       $_COOKIE["color_p2"] == "yellow")
    {
        $color_p2 = $_COOKIE["color_p2"];
    }

    $sql = "SELECT state_of_game, turn, player1, player2 FROM games WHERE player1 = '".$token."' OR player2 = '".$token."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    for($i = 0; $i < 6; $i++)
    {
        for($j = 0; $j < 7; $j++)
        {   
            echo "<div id= '$j/$i'><img src= '";
            if($row["state_of_game"][$i * 7 + $j] == 0)
            {
                echo "../IMG/panel.png'";
            }

            else if($row["state_of_game"][$i * 7 + $j] == 1)
            {
                echo "../IMG/panel_".$color_p1.".png'";
            }

            else if($row["state_of_game"][$i * 7 + $j] == 2)
            {
                echo "../IMG/panel_".$color_p2.".png'";
            }
            echo " style='max-width: 100%; max-height: 100%;' onclick='javascript:register_turn($j)'></div>";
        }
    }
?>

