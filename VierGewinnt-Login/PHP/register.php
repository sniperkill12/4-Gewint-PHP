<?php
require "db_connection.php";

$email = filter_input(INPUT_POST, 'email');
$pw = filter_input(INPUT_POST, 'pw');
$nickname = filter_input(INPUT_POST, 'nickname');
$fname = filter_input(INPUT_POST, 'fname');
$name = filter_input(INPUT_POST, 'name');
$age = filter_input(INPUT_POST, 'age');
$gender = filter_input(INPUT_POST, 'radio');
$pwhash = password_hash($pw, PASSWORD_DEFAULT);

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
    if (mysqli_connect_error()) {
        die('Connection Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From user_table Where email = ? Limit 1";
        $INSERT = "INSERT INTO user_table (name, first_name, nickname, email, password, age, sex, identifier, securitytoken) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $securitytoken = random_string();
        $identifier = random_string();

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0) {
            $stmt->close();

            if ($stmt = $conn->prepare($INSERT)){
            $stmt->bind_param('sssssisss', $name, $fname, $nickname, $email, $pwhash, $age, $gender, $identifier, $securitytoken);
            $stmt->execute();
            echo "New record inserted successfully";
            echo $pwhash;

            setcookie("token", $securitytoken, time() + (86400 * 30), "/");
            setcookie("color_p1", "red", time() + (86400 * 30), "/");
            setcookie("color_p2", "yellow", time() + (86400 * 30), "/");

            $stmt->close();
            } else {
                echo "FAIL";
            }
            
            header("Location: ../PHP/lobby.php");
        }
        else{
            $message = "Someone already registered with this Email";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }


