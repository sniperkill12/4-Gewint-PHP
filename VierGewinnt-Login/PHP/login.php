<html>
    <head>
        <title>Viergewinnt Login</title>
        <link rel="stylesheet" href="../CSS/login.css">
        </head>
        <body>
            <form method="GET" action="login_form_handle.php">
            <div class="login-box">
                <?php
                    $error = 0;
                    if(isset($_GET["error"]))
                    {
                        $error = $_GET["error"];
                    } 

                    if($error == "1")
                    {
                        echo "<p>Wrong E-Mail or Password</p>";
                    }

                    else if($error == "3")
                    {
                        echo "<p>To use this service you must be logged in</p>";
                    }
                ?>
                <h1>Login</h1>
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="email" placeholder="Email" name="email" value="">
                </div>
                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="Password" name="pw" value="">
                </div>
                <input class="btn" type="submit" name="" value="Sign in">
            </form> 
                <a href="../HTML/register.html">
                    <input class="btn" type="button" name="" value="Register" >
                </a>
            </div>
        </body>
</html>
