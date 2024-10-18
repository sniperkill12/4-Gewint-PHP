<?php
	require "db_connection.php";
	require "check_logged_in.php";
?>

<html>
	<head>
		<title>Lobby</title>
		<link rel="stylesheet" href="../CSS/lobby.css">
		<script src="../JS/lobby.js"></script>
	</head>
		
    <body>
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
						<!-- <a href="settings.php">Settings</a> -->
						<a href="login.php" onclick="logout()">Logout</a>			
					</div>
				</div>
			</li>
			<?php
				$sql = "SELECT player1 FROM games WHERE player1 = '".$token."' OR player2 = '".$token."'";
				$result = $conn->query($sql);
				if($result->num_rows != 0)
				{
					echo "<li class='continue_game_btn' style='display: inline'><a href='game.php' style='float:right'>Continue Game</a></li>";
				}
			?>
		</ul>
	
		<!--Main Area-->
		<div class="lobby-box">
			<h1 class="titel">Lobby</h1>
			<div class="welbox">
				Welcome back 

				<?php
					$READ = "SELECT nickname FROM user_table WHERE securitytoken='".$token."'";
					$result = mysqli_query($conn, $READ);
					$row = $result->fetch_assoc();
					echo $row['nickname'];
				?>
			</div>

			<div>

				<!--List of joinable Games-->
				<div id="open_games">	
					<script type="text/javascript">
						display_open_games();
						setInterval(display_open_games, 500);
					</script>
				</div>		

				<!--Open new Game Button-->
				<div class="gameadd" id="add">	
					<button type="button" class="addbtn" onclick="create_new_game()">+</button>			
				</div>
			</div>

			<div id="error_messages">
			</div>
		</div>
	</body>
</html>
