<?php

require_once "inc/database_functions.inc.php";

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    deleteItem($id);
}

header("Location: list.php");
exit;