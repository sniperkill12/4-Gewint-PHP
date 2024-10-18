<?php
    require "db_connection.php";
    $token = $_COOKIE["token"];

    $sql = "SELECT player1, player2, id FROM games";
    $result = $conn->query($sql);

    $j = 1;

    if ($result->num_rows > 0) 
    {
        for($i = 1; $i <= $result->num_rows; $i++)
        {
            $row = $result->fetch_assoc();
            if($row["player2"] == "" && $row["player1"] != $token)
            {
                $sql = "SELECT nickname FROM user_table WHERE securitytoken = '".$row['player1']."'";
                $result2 = $conn->query($sql);
                $row2 = $result2->fetch_assoc();

                echo "<div class='game1'><div class='gameid'>Game ".$j."</div><button type='button' class='joinbtn' onclick='javascript:join_game(".$row['id'].")'>JOIN</button><div class='creator'>Erstellt von ".$row2['nickname']."</div></div>";
                $j++;
            }
        }
    }
?>	