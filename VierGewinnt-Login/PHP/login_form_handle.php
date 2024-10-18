<?php
require "db_connection.php";

if ((isset($_GET['email'])) && (isset($_GET['pw']))) 
{

  $safe_email = mysqli_real_escape_string($conn, $_GET['email']);
  $sql = "SELECT * FROM user_table WHERE email = '" . $safe_email . "';";
  $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  
  if ($dbdata = mysqli_fetch_assoc($res)) 
  {
  
    if (password_verify($_GET['pw'], $dbdata['password'])) 
    {
      $READ = "SELECT securitytoken FROM user_table WHERE email='".$safe_email."'";
      $result = mysqli_query($conn, $READ);
      
      $row = $result->fetch_assoc();
      $token = $row['securitytoken'];
    
      setcookie("token", $token, time() + (86400 * 30), "/");
      setcookie("color_p1", "red", time() + (86400 * 30), "/");
      setcookie("color_p2", "yellow", time() + (86400 * 30), "/");

      header("Location: lobby.php");

    } 
    
    else 
    {
      header("Location: login.php?error=1");
    }
  } 
  else
  {
    header("Location: login.php?error=1");
  }
}
?>
