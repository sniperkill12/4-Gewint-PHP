<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "benutzername";
    $password = "passwort";
    $dbname = "meineDatenbank";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Passwort hashen

    $sql = "INSERT INTO benutzer (email, password) VALUES ('$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrierung erfolgreich";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
