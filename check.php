<?php

require_once "inc/database_functions.inc.php";

$id = (int)($_GET['id'] ?? 0);

$item = getItemById($id);

if ($item) {

    $newStatus = $item['status'] ? 0 : 1;

    toggleItemStatus($id, $newStatus);
}

header("Location: list.php");
exit;