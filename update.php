<?php
/*
 * Dieses Skript dient zum Bearbeiten eines vorhandenen Eintrags.
 * Die Daten werden anhand der übergebenen ID geladen und im
 * Formular angezeigt. Nach dem Absenden werden die Eingaben
 * validiert und bei erfolgreicher Prüfung in der Datenbank
 * aktualisiert. Anschließend erfolgt die Weiterleitung zur
 * Übersichtsseite.
 */

require_once "inc/database_functions.inc.php";

// ID aus der URL auslesen und in Integer umwandeln
$id = (int)($_GET['id'] ?? 0);

// Datensatz anhand der ID laden
$item = getItemById($id);

// Falls kein Datensatz gefunden wurde, zurück zur Liste
if (!$item) {
    header('Location: list.php');
    exit;
}

// Array für Validierungsfehler
$errors = [];

// Vorhandene Daten für die Formularvorbelegung übernehmen
$title = $item['title'];
$quantity = $item['quantity'];
$unit = $item['unit'];
$information = $item['information'];
$category = $item['category'];

// Erlaubte Werte für Auswahlfelder
$allowedUnits = ['l', 'g', 'kg', 'St.', 'Pk.'];
$allowedCategories = ['food', 'convenience', 'non-food'];

// Formular wurde abgesendet
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Formulardaten einlesen und bereinigen
    $title = trim($_POST['title'] ?? '');
    $quantity = trim($_POST['quantity'] ?? '');
    $unit = $_POST['unit'] ?? '';
    $information = trim($_POST['information'] ?? '');
    $category = $_POST['category'] ?? '';

    // Titel prüfen
    if ($title === '') {
        $errors['title'] = 'Bitte einen Titel eingeben.';
    }

    // Menge prüfen
    if ($quantity === '') {
        $errors['quantity'] = 'Bitte eine Menge eingeben.';
    } elseif (!is_numeric($quantity) || $quantity <= 0) {
        $errors['quantity'] = 'Bitte eine gültige Menge eingeben.';
    }

    // Einheit prüfen
    if (!in_array($unit, $allowedUnits, true)) {
        $errors['unit'] = 'Bitte eine gültige Einheit auswählen.';
    }

    // Maximale Länge der Zusatzinformation prüfen
    if (strlen($information) > 120) {
        $errors['information'] = 'Maximal 120 Zeichen erlaubt.';
    }

    // Kategorie prüfen
    if (!in_array($category, $allowedCategories, true)) {
        $errors['category'] = 'Bitte eine gültige Kategorie auswählen.';
    }

    // Datensatz speichern, wenn keine Fehler vorhanden sind
    if (empty($errors)) {

        updateItem(
            $id,
            $title,
            $quantity,
            $unit,
            $information,
            $category
        );

        // Nach erfolgreicher Bearbeitung zurück zur Liste
        header('Location: list.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Eintrag bearbeiten</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>Eintrag bearbeiten</h1>

    <!-- Formular zur Bearbeitung eines vorhandenen Eintrags -->
    <form method="post">

        <label>Titel</label>
        <input type="text" name="title"
               value="<?= htmlspecialchars($title) ?>">

        <?php if (isset($errors['title'])): ?>
            <p class="error"><?= $errors['title'] ?></p>
        <?php endif; ?>

        <label>Menge</label>
        <input type="number" step="0.01" name="quantity"
               value="<?= htmlspecialchars($quantity) ?>">

        <?php if (isset($errors['quantity'])): ?>
            <p class="error"><?= $errors['quantity'] ?></p>
        <?php endif; ?>

        <label>Einheit</label>
        <select name="unit">

            <!-- Verfügbare Einheiten dynamisch erzeugen -->
            <?php foreach ($allowedUnits as $value): ?>
                <option value="<?= $value ?>"
                    <?= $unit === $value ? 'selected' : '' ?>>
                    <?= $value ?>
                </option>
            <?php endforeach; ?>

        </select>

        <label>Zusatzinformation</label>
        <textarea name="information"><?= htmlspecialchars($information) ?></textarea>

        <?php if (isset($errors['information'])): ?>
            <p class="error"><?= $errors['information'] ?></p>
        <?php endif; ?>

        <label>Kategorie</label>
        <select name="category">

            <option value="food"
                <?= $category === 'food' ? 'selected' : '' ?>>
                Food
            </option>

            <option value="convenience"
                <?= $category === 'convenience' ? 'selected' : '' ?>>
                Convenience
            </option>

            <option value="non-food"
                <?= $category === 'non-food' ? 'selected' : '' ?>>
                Non-Food
            </option>

        </select>

        <?php if (isset($errors['category'])): ?>
            <p class="error"><?= $errors['category'] ?></p>
        <?php endif; ?>

        <div class="actions">
            <button type="submit" class="btn">
                Speichern
            </button>

            <a href="list.php" class="btn danger">
                Abbrechen
            </a>
        </div>

    </form>

</div>

</body>
</html>