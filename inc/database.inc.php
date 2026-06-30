/**
 * stellt die datenbank verbindung her
 * (über PDO mit mysql)
 */

<?php

// Datenbankverbindungsdaten
$host = "localhost";
$dbname = "shopping_list";
$user = "root";
$pass = "";

// PDO Verbindung aufbauen
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    // Fehlermodus aktivieren (wichtig für Debugging)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}
?>