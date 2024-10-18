function create_new_game () 
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            if(this.responseText.trim() == "successfully created")
            {
                window.location.href = "game.php";
            }

            else
            {
                //Echo error message
                document.getElementById("error_messages").innerHTML = this.responseText;
            }
        }
    };
    xhttp.open("GET", "../PHP/lobby_create_new_game.php", true);
    xhttp.send();
}
  
function join_game(id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            if(this.responseText.trim() == "game joined")
            {
                window.location.href = "game.php";
            }

            else
            {
                //Echo error message
                document.getElementById("error_messages").innerHTML = this.responseText;
            }
        }
    };
    xhttp.open("GET", "../PHP/lobby_join_game.php?id=" + id, true);
    xhttp.send();
}

function display_open_games()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            document.getElementById("open_games").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "../PHP/lobby_display_open_games.php", true);
    xhttp.send();
}

function logout() 
{
    document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    alert("Logout successfully!");
}