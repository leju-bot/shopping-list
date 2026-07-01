<?php

require_once "inc/database_functions.inc.php";

deleteAllItems();

header("Location: list.php");
exit;