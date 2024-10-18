<?php
    require "db_connection.php";
    require "check_logged_in.php";

    $sql = "SELECT state_of_game, turn, player1, player2 FROM games WHERE player1 = '".$token."' OR player2 = '".$token."'";
    $result = $conn->query($sql);

    //Check, if player is in only one game instance
    if($result->num_rows != 1)
    {
        header("Location: lobby.php");
        die();
    }
?>

<html>
    <head>
        <title>Vier-Gewinnt</title>
        <link rel="stylesheet" href="../CSS/game.css">
        <script src="../JS/game.js"></script>
    </head>
    <body style="background-image: url(../IMG/logscreen.jpeg); background-repeat: norepeat">

        <!--Navigation Bar-->
        <ul class="dashboard">
			<li class="logo" style="display: inline">
				<a href="lobby.php">
					<img src="../IMG/4gewinnt_logo.png" style="max-height: 100%; width: auto">
				</a>
			</li>
			<li style="display: inline">
				<div class="dropdown" style="height: 100%; width: auto; float: right">
					<?php
						$sql = "SELECT picture_filepath FROM user_table WHERE securitytoken = '".$token."'";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						echo "<img src='".$row["picture_filepath"]."' class='dropbtn' style='max-height: 100%; width: auto;'>";
					?>
					<div class="dropdown-content" style="right: 0">
						<a href="settings.php">Settings</a>
						<a href="login.php" onclick="logout()">Logout</a>						
					</div>
				</div>
			</li>
		</ul>

        <!--Page-->
        <div id="web-page" style="display: inline-grid; grid-template-columns: 1fr 1fr">      

            <!--Game Area-->  
            <div id='game_area' style='display: inline-grid; grid-template-columns: auto auto auto auto auto auto auto'>
            </div>

            <!--User Interface-->
            <div id="game_ui" style="display: grid">

                <!--Current Turn Display-->
                <div id="current_turn">
                </div>

                <!--Color Picker-->
                <div id="color_picker" style="display: block; padding: 50px">
                    <div>
                        <p id="text">Your Color</p>
                        <?php
			                $sql = "SELECT player1, player2 FROM games WHERE player1 = '".$token."' OR player2 = '".$token."'";
    			            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            if($row["player1"] == $token)
                            {
                                echo "
                                    <img src='../IMG/panel_black.png' class='color_p1' id='black_p1' onclick='color_select(\"black\", \"_p1\")'>
                                    <img src='../IMG/panel_blue.png' class='color_p1' id='blue_p1' onclick='color_select(\"blue\", \"_p1\")'>
                                    <img src='../IMG/panel_brown.png' class='color_p1' id='brown_p1' onclick='color_select(\"brown\", \"_p1\")'>
                                    <img src='../IMG/panel_orange.png' class='color_p1' id='orange_p1' onclick='color_select(\"orange\", \"_p1\")'>
                                    <img src='../IMG/panel_pink.png' class='color_p1' id='pink_p1' onclick='color_select(\"pink\", \"_p1\")'>
                                    <img src='../IMG/panel_purple.png' class='color_p1' id='purple_p1' onclick='color_select(\"purple\", \"_p1\")'>
                                    <img src='../IMG/panel_red.png' class='color_p1' id='red_p1' onclick='color_select(\"red\", \"_p1\")'>
                                    <img src='../IMG/panel_yellow.png' class='color_p1' id='yellow_p1' onclick='color_select(\"yellow\", \"_p1\")'>
                                    ";
                            }

                            else
                            {
                                echo "
                                    <img src='../IMG/panel_black.png' class='color_p2' id='black_p2' onclick='color_select(\"black\", \"_p2\")'>
                                    <img src='../IMG/panel_blue.png' class='color_p2' id='blue_p2' onclick='color_select(\"blue\", \"_p2\")'>
                                    <img src='../IMG/panel_brown.png' class='color_p2' id='brown_p2' onclick='color_select(\"brown\", \"_p2\")'>
                                    <img src='../IMG/panel_orange.png' class='color_p2' id='orange_p2' onclick='color_select(\"orange\", \"_p2\")'>
                                    <img src='../IMG/panel_pink.png' class='color_p2' id='pink_p2' onclick='color_select(\"pink\", \"_p2\")'>
                                    <img src='../IMG/panel_purple.png' class='color_p2' id='purple_p2' onclick='color_select(\"purple\", \"_p2\")'>
                                    <img src='../IMG/panel_red.png' class='color_p2' id='red_p2' onclick='color_select(\"red\", \"_p2\")'>
                                    <img src='../IMG/panel_yellow.png' class='color_p2' id='yellow_p2' onclick='color_select(\"yellow\", \"_p2\")'>   
                                    ";
                            }
                        ?>
                    </div>
                    <div>
                        <p>Opponent Color</p>
                        <?php
                            if($row["player2"] == $token)
                            {
                                echo "
                                    <img src='../IMG/panel_black.png' class='color_p1' id='black_p1' onclick='color_select(\"black\", \"_p1\")'>
                                    <img src='../IMG/panel_blue.png' class='color_p1' id='blue_p1' onclick='color_select(\"blue\", \"_p1\")'>
                                    <img src='../IMG/panel_brown.png' class='color_p1' id='brown_p1' onclick='color_select(\"brown\", \"_p1\")'>
                                    <img src='../IMG/panel_orange.png' class='color_p1' id='orange_p1' onclick='color_select(\"orange\", \"_p1\")'>
                                    <img src='../IMG/panel_pink.png' class='color_p1' id='pink_p1' onclick='color_select(\"pink\", \"_p1\")'>
                                    <img src='../IMG/panel_purple.png' class='color_p1' id='purple_p1' onclick='color_select(\"purple\", \"_p1\")'>
                                    <img src='../IMG/panel_red.png' class='color_p1' id='red_p1' onclick='color_select(\"red\", \"_p1\")'>
                                    <img src='../IMG/panel_yellow.png' class='color_p1' id='yellow_p1' onclick='color_select(\"yellow\", \"_p1\")'>
                                    ";
                            }

                            else
                            {
                                echo "
                                    <img src='../IMG/panel_black.png' class='color_p2' id='black_p2' onclick='color_select(\"black\", \"_p2\")'>
                                    <img src='../IMG/panel_blue.png' class='color_p2' id='blue_p2' onclick='color_select(\"blue\", \"_p2\")'>
                                    <img src='../IMG/panel_brown.png' class='color_p2' id='brown_p2' onclick='color_select(\"brown\", \"_p2\")'>
                                    <img src='../IMG/panel_orange.png' class='color_p2' id='orange_p2' onclick='color_select(\"orange\", \"_p2\")'>
                                    <img src='../IMG/panel_pink.png' class='color_p2' id='pink_p2' onclick='color_select(\"pink\", \"_p2\")'>
                                    <img src='../IMG/panel_purple.png' class='color_p2' id='purple_p2' onclick='color_select(\"purple\", \"_p2\")'>
                                    <img src='../IMG/panel_red.png' class='color_p2' id='red_p2' onclick='color_select(\"red\", \"_p2\")'>
                                    <img src='../IMG/panel_yellow.png' class='color_p2' id='yellow_p2' onclick='color_select(\"yellow\", \"_p2\")'>   
                                    ";
                            }
                        ?>
                    </div>
                </div>
                <p id="error_message" style="color: red"></p>
            </div>
        </div>

        <script type="text/javascript">
            load_game_area();
            highlight_selected();
            check_for_winner();
            setInterval(interval, 1000);
        </script> 
    </body>
</html>
