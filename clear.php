<?php

require_once "inc/database_functions.inc.php";

// Nur POST-Anfragen erlauben
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /**
     * Alle Datensätze löschen
     */
    deleteAllItems();
}

// Zurück zur Liste

header('Location: list.php');
exit;