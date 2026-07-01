<?php

require_once "inc/database_functions.inc.php";

// ID aus dem Formular lesen
$id = (int) ($_POST['id'] ?? 0);

// ID prüfen
if ($id > 0) {

    /**
     * Datensatz löschen
     */
    deleteItem($id);
}

// Zurück zur Liste
header('Location: list.php');
exit;