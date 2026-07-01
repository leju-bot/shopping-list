<?php

/**
 * bindet die Datei mit den Datenbank-Funktionen ein
 * (damit ich die Funktionen hier benutzen kann)
 */
require_once "inc/database_functions.inc.php";

/**
 * lädt alle Einkaufsartikel aus der Datenbank
 */
$items = getAllItems();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Meine Einkaufsliste</title>

    <!-- CSS-Datei einbinden -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <!-- Überschrift -->
    <h1>🛒 Meine Einkaufsliste</h1>

    <!-- aktuelles Datum -->
    <p class="date">
        <?= date("d.m.Y"); ?>
    </p>

    <div class="actions">

        <!-- Button für neuen Eintrag -->
        <a class="btn" href="create.php">
            + Neuer Eintrag
        </a>

        <!-- Formular zum Löschen aller Einträge -->
        <form action="clear.php" method="post" class="clear-form">

            <button
                type="submit"
                class="btn danger"
                onclick="return confirm('Wirklich alle Einträge löschen?')"
            >
                Neue Liste
            </button>

        </form>

    </div>

    <?php if (empty($items)): ?>

        <!-- Meldung wenn keine Einträge vorhanden sind -->
        <p class="empty">
            Keine Einträge vorhanden.
        </p>

    <?php else: ?>

        <!-- alle Einträge durchlaufen -->
        <?php foreach ($items as $item): ?>

            <?php

            // Ausgaben absichern (Schutz vor HTML-/Script-Eingaben)
            
            $title = htmlspecialchars($item["title"]);
            $info = htmlspecialchars($item["information"]);
            $quantity = htmlspecialchars($item["quantity"]);
            $unit = htmlspecialchars($item["unit"]);

            // prüft ob der Eintrag erledigt ist
            $done = (int) $item["status"] === 1;

            ?>

            <div class="item <?= $done ? 'done' : '' ?>">

                <div class="main">

                    <!-- Menge und Einheit -->
                    <span class="qty">
                        <?= $quantity ?> <?= $unit ?>
                    </span>

                    <!-- Titel -->
                    <strong class="title">
                        <?= $title ?>
                    </strong>

                    <!-- Zusatzinformation nur anzeigen wenn vorhanden -->
                    <?php if (!empty($item["information"])): ?>

                        <small class="info">
                            <?= $info ?>
                        </small>

                    <?php endif; ?>

                </div>

                <div class="status">

                    <!-- Formular zum Ändern des Status -->
                    <form action="check.php" method="post" class="status-form">

                        <!-- ID des Datensatzes übergeben -->
                        <input
                            type="hidden"
                            name="id"
                            value="<?= (int) $item['id'] ?>"
                        >

                        <!-- Status umschalten -->
                        <button type="submit" class="status-button">

                            <?= $done ? "✔ erledigt" : "⏳ offen" ?>

                        </button>

                    </form>

                </div>

                <div class="buttons">

                    <!-- Eintrag bearbeiten -->
                    <a href="update.php?id=<?= (int) $item["id"] ?>">
                        ✏️ Bearbeiten
                    </a>

                    <!-- Eintrag löschen -->
                    <form action="delete.php" method="post" class="delete-form">

                        <!-- ID des Datensatzes übergeben -->
                        <input
                            type="hidden"
                            name="id"
                            value="<?= (int) $item['id'] ?>"
                        >

                        <button
                            type="submit"
                            onclick="return confirm('Eintrag wirklich löschen?')"
                        >
                            Löschen
                        </button>

                    </form>

                </div>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

</body>
</html>