<?php
// Hier die Logik für die Überprüfung und Weiterleitung einfügen
// Überprüfen der Anzahl aktiver Spieler
$servername = "localhost";
$username = "benutzername";
$password = "passwort";
$dbname = "meineDatenbank";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT COUNT(*) as total FROM aktive_spieler";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row["total"] < 2) {
    header("Location: spiel.php"); // Weiterleitung zur Spiel-Seite
    exit();
}
$conn->close();
?>
