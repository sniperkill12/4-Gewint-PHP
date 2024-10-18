<?php  
  require "db_connection.php";
  require "check_logged_in.php";

  $READ = "SELECT * FROM user_table WHERE securitytoken='".$token."'";
  $result = mysqli_query($conn, $READ);
  
  $row = $result->fetch_assoc();
?>


<html>

<head>
  <title>Settings</title>
  <link rel="stylesheet" href="../CSS/settings.css">
  <script src="../JS/settings.js"></script>
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
		      echo "<img src='".$row["picture_filepath"]."' class='dropbtn' style='max-height: 100%; width: auto;'>";
	      ?>
        <div class="dropdown-content" style="right: 0">
          <a href="login.php" onclick="logout()">Logout</a>
        </div>
      </div>
    </li>
  </ul>

  <form action="../PHP/updatesettings.php" method="post" enctype="multipart/form-data">
    <div class="register-box">
      <h1>Settings</h1>
      <p id="error"></p>
      <?php echo "<div class='image_upload' style='position: relative; text-align: center;'>
      <img src='".$row["picture_filepath"]."' id='image_preview' style='max-height: 7vw; width: auto; display: block; margin-left: auto; margin-right: auto;'>
      <label for='image' style='position: absolute; bottom: 4px; left: 50%; transform: translate(-50%, 0%); color: black'>Change image</label>
      <input type='file' name='image' id='image' hidden onchange='javascript:refresh_image()' accept=image/*'>
      </div>";
      ?>

      <?php echo "<div class='textbox'>
        <input type='email' placeholder='Email' name='email' value='".$row['email']."' required readonly>
        </div>"
      ?>
      
      <?php echo  "<div class='textbox'>
        <input type='text' placeholder='Nickname' name='nickname' value=".$row['nickname']." required readonly>
      </div>"
      ?>

      <?php echo  "<div class='textbox'>
        <input type='text' placeholder='Firstname' name='fname' value='".$row['first_name']."'>
      </div>
      <div class='textbox'>
        <input type='text' placeholder='Name' name='name' value=".$row['name'].">
      </div>"
      ?>
      
      <?php echo  "<div class='textbox'>
      	<input type='number' placeholder='Age' name='age' ";
        if($row['age'] != 0)
        {
          echo "value=".$row['age'];
        }
        echo " min='18' max='100'>
                  </div>";
      ?>

      <div>
        <label class="container">No information
          <input type="radio" 
          <?php
            if($row['sex'] == "def")
            {
              echo "checked=\"checked\" ";
            }
          ?>
          name="radio" value="def">
          <span class="checkmark"></span>
        </label>
        <label class="container">Male
          <input type="radio" 
          <?php
            if($row['sex'] == "male")
            {
              echo "checked=\"checked\" ";
            }
          ?>
          name="radio" value="male">
          <span class="checkmark"></span>
        </label>
        <label class="container">Female
          <input type="radio" 
          <?php
            if($row['sex'] == "female")
            {
              echo "checked=\"checked\" ";
            }
          ?>
          name="radio" value="female">
          <span class="checkmark"></span>
        </label>
      </div>
      <input class="btn" type="submit" name="submit" value="Update">
  </form>
  <a href="../PHP/lobby.php">
    <input class="btn" type="button" name="" value="Back">
  </a>
  </div>
</body>

</html>
