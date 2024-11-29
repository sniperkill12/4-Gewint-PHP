<?php
// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "benutzername";
$password = "passwort";
$dbname = "meineDatenbank";

$conn = new mysqli($servername, $username, $password, $dbname);

// Benutzereingaben überprüfen und weiterleiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Überprüfen, ob Benutzer in der Datenbank existiert
    $sql = "SELECT * FROM benutzer WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Weiterleitung zur Spielseite
            header("Location: spielseite.php");
            exit();
        } else {
            echo "Falsches Passwort";
        }
    } else {
        echo "Benutzer nicht gefunden";
    }

    // Überprüfen der Anzahl aktiver Spieler
    $sql = "SELECT COUNT(*) as total FROM aktive_spieler";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row["total"] > 2) {
        // Weiterleitung zur Warteseite
        header("Location: warteseite.php");
        exit();
    }
}

// Schließen der Datenbankverbindung
$conn->close();
?>
