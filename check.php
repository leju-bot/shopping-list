<?php

require_once "inc/database_functions.inc.php";

// ID aus Formular lesen
$id = (int) ($_POST['id'] ?? 0);

// ID prüfen
if ($id > 0) {

    // Datensatz laden
    $item = getItemById($id);

    // Status umschalten
    if ($item) {

        $newStatus = $item['status'] ? 0 : 1;

        toggleItemStatus($id, $newStatus);
    }
}

// Zurück zur Liste
header('Location: list.php');
exit;