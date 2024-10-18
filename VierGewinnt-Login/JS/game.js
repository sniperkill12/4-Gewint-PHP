
function register_turn(index)
{
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../PHP/game_register_turn.php?turn=" + index, true);
    xhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            document.getElementById("error_message").innerHTML = this.responseText;
        }
    };
    xhttp.send();
}

function load_game_area()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            document.getElementById("game_area").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "../PHP/game_area.php", true);
    xhttp.send();
}

function load_current_turn()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            document.getElementById("current_turn").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "../PHP/game_current_turn.php", true);
    xhttp.send();
}

function check_for_winner()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            if(this.responseText.trim() != "false")
            {
                if(this.responseText.trim() == getCookie("token"))
                {
                    document.getElementById("current_turn").innerHTML = "<h1>You win!</h1>";
                    var xhttp2 = new XMLHttpRequest();
                    xhttp2.open("GET", "../PHP/game_delete_instance.php", true);
                    xhttp2.onreadystatechange = function() 
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {
                            window.location.href = "lobby.php";
                        }
                    }
                    xhttp2.send();
                }

                else
                {
                    document.getElementById("current_turn").innerHTML = "<h1>You lose!</h1>";
                    window.location.href = "lobby.php";
                }
            }
            
            else
            {
                load_current_turn();
            }
            
        }
    };
    xhttp.open("GET", "../PHP/game_has_winner.php", true);
    xhttp.send();
    
}

function getCookie(cname) 
{
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

function interval()
{
    load_game_area();
    check_for_winner();
}

function color_select(color, player)
{
    var colors = document.querySelectorAll(".color" + player.trim());
    var i = colors.length;
    while (i > 0) 
    {
        i--;  
        colors[i].setAttribute("style", "max-width: 10%; max-height: 10%;"); 
    }
    
    document.getElementById(color + player.trim()).style.borderStyle = "solid";
    document.getElementById(color + player.trim()).style.borderWidth = "2px";
    document.getElementById(color + player.trim()).style.borderColor = "#FF0000";
    document.cookie = "color" + player + "=" + color + "; path=/";
}

function highlight_selected()
{
    var color_p1 = getCookie("color_p1");
    document.write(color_p1);
    // document.getElementById(color_p1 + "_p1").style.borderStyle = "solid";
    // document.getElementById(color_p1 + "_p1").style.borderWidth = "2px";
    // document.getElementById(color_p1 + "_p1").style.borderColor = "#FF0000";

    var color_p2 = getCookie("color_p2");
    // document.getElementById(color_p2 + "_p2").style.borderStyle = "solid";
    // document.getElementById(color_p2 + "_p2").style.borderWidth = "2px";
    // document.getElementById(color_p2 + "_p2").style.borderColor = "#FF0000";
}
