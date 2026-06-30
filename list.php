<?php
/**
 * bindet die Datei mit den Datenbank-Funktionen ein
 * (damit ich die Funktionen hier benutzen kann)
 */

require_once "inc/database_functions.inc.php";

$items = getAllItems();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Meine Einkaufsliste</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>🛒 Meine Einkaufsliste</h1>

    <p class="date">
        <?= date("d.m.Y"); ?>
    </p>

    <div class="actions">
        <a class="btn" href="create.php">+ Neuer Eintrag</a>
        <a class="btn danger" href="clear.php">Neue Liste</a>
    </div>

    <?php if (empty($items)): ?>
        <p class="empty">Keine Einträge vorhanden.</p>
    <?php else: ?>

        <?php foreach ($items as $item): ?>

            <?php
                $title = htmlspecialchars($item["title"]);
                $info = htmlspecialchars($item["information"]);
                $done = (int)$item["status"] === 1;
            ?>

            <div class="item <?= $done ? 'done' : '' ?>">

                <div class="main">
                    <span class="qty">
                        <?= $item["quantity"] ?> <?= $item["unit"] ?>
                    </span>

                    <strong class="title"><?= $title ?></strong>

                    <?php if (!empty($info)): ?>
                        <small class="info"><?= $info ?></small>
                    <?php endif; ?>
                </div>

                <div class="status">
                    <?= $done ? "✔ erledigt" : "⏳ offen" ?>
                </div>

                <div class="buttons">
                    <a href="update.php?id=<?= $item["id"] ?>">Bearbeiten</a>
                    <a href="delete.php?id=<?= $item["id"] ?>">Löschen</a>
                </div>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

</body>
</html>