<?php

require_once 'inc/database_functions.inc.php';

/**
 * Wechselt den Status eines Datensatzes (Toggle-Funktion)
 *
 * Liest die ID aus dem POST-Request, prüft die Gültigkeit,
 * lädt den Datensatz, kehrt den Status um (0/1)
 * und speichert die Änderung in der Datenbank.
 */

// ID aus POST holen und validieren (muss Integer sein)
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

// Prüfen, ob die ID gültig ist
if (!$id || $id < 1) {
    header('Location: list.php');
    exit;
}

// Datensatz anhand der ID laden
$item = getItemById($id);

// Prüfen, ob der Datensatz existiert
if (!$item) {
    header('Location: list.php');
    exit;
}

// Aktuellen Status umkehren (0 -> 1, 1 -> 0)
$newStatus = $item['status'] ? 0 : 1;

// Neuen Status speichern
toggleItemStatus($id, $newStatus);

// Zurück zur Übersicht
header('Location: list.php');
exit;