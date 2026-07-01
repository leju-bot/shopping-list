<?php

require_once 'inc/database_functions.inc.php';

/**
 * Löscht einen Datensatz anhand der übergebenen ID
 * und leitet anschließend zurück zur Übersicht.
 */

// ID aus dem POST-Request lesen und als Integer validieren
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

// Prüfen, ob eine gültige ID übergeben wurde
if ($id && $id > 0) {

    // Datensatz anhand der ID laden
    $item = getItemById($id);

    // Datensatz nur löschen, wenn er existiert
    if ($item) {
        deleteItem($id);
    }
}

// Zur Liste zurückkehren
header('Location: list.php');
exit;