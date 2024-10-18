<?php
require "db_connection.php";
$token = $_COOKIE["token"];
$row = 0;

//Upload new image Image
$uploadOk = 0;
$target_dir = "../IMG/";
$target_file = $target_dir.basename($_FILES["image"]["name"]);;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

   //Make name unique
$i = 0;
$target_file = $target_dir.$i.".".$imageFileType;
while(file_exists($target_file))
{
   $i++;
   $target_file = $target_dir.$i.".".$imageFileType;
}

   //Check if image file is a actual image or fake image
if(isset($_POST["submit"])) 
{
   $check = getimagesize($_FILES["image"]["tmp_name"]);
   if($check !== false) 
   {
      $uploadOk = 1;
   } 
   else 
   {
      $uploadOk = 0;
   }
}

   //Check file size
if ($_FILES["image"]["size"] > 5000000) 
{
   $uploadOk = 0;
}
   //Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
{
   $uploadOk = 0;
}

if ($uploadOk == 1) 
{
   if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
   {
      $uploadOk = 1;
   }

   else
   {
      $uploadOk = 0;
   }
}

//Delete old image if it isn't default image
if($uploadOk == 1)
{
   $sql = "SELECT picture_filepath FROM user_table WHERE securitytoken = '".$token."'";
   $result = mysqli_query($conn, $sql);
   $row = $result->fetch_assoc();
   if($row["picture_filepath"] != "../IMG/anonymous.png")
   {
      if(unlink($row["picture_filepath"]))
      {
         $uploadOk = 1;
      }

      else
      {
         $uploadOk = 0;
      }
   }
}

//Update SQL
$email = filter_input(INPUT_POST, 'email');
$nickname = filter_input(INPUT_POST, 'nickname');
$fname = filter_input(INPUT_POST, 'fname');
$name = filter_input(INPUT_POST, 'name');
$age = filter_input(INPUT_POST, 'age');
$gender = filter_input(INPUT_POST, 'radio');
if($uploadOk == 1)
{
   $picture_filepath = $target_file;
}
else
{
   $picture_filepath = $row["picture_filepath"];
}

function random_string() {
   if(function_exists('random_bytes')) {
      $bytes = random_bytes(16);
      $str = bin2hex($bytes); 
   } else if(function_exists('openssl_random_pseudo_bytes')) {
      $bytes = openssl_random_pseudo_bytes(16);
      $str = bin2hex($bytes); 
   } else if(function_exists('mcrypt_create_iv')) {
      $bytes = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
      $str = bin2hex($bytes); 
   } else {
      $str = md5(uniqid('viergewinntgewinntwenn4', true));
   }   
   return $str;
}

if($age == "")
{
   $age = 0;
}

//nickname email image fehlen noch
if($uploadOk == 1)
{
   $UPDATE = "UPDATE user_table SET name = '".$name."', first_name = '".$fname."', age = ".$age.", sex ='".$gender."', picture_filepath = '".$picture_filepath."' WHERE securitytoken='".$token."'";
}

else
{
   $UPDATE = "UPDATE user_table SET name = '".$name."', first_name = '".$fname."', age = ".$age.", sex ='".$gender."' WHERE securitytoken='".$token."'";
}

mysqli_query($conn, $UPDATE);
header("Location: settings.php");
?>  

