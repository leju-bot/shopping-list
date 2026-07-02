<?php
/**
 * Erstellt einen neuen Eintrag.
 *
 * Das Formular wird angezeigt, Benutzereingaben werden validiert
 * und bei erfolgreicher Prüfung in der Datenbank gespeichert.
 */

require_once "inc/database_functions.inc.php";

// Array für Fehlermeldungen
$errors = [];

// Formularvariablen initialisieren
$title = '';
$quantity = '';
$unit = '';
$information = '';
$category = '';

// Erlaubte Werte für Auswahlfelder
$allowedUnits = ['l', 'g', 'kg', 'St.', 'Pk.'];
$allowedCategories = ['food', 'convenience', 'non-food'];

// Formular wurde abgeschickt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Benutzereingaben übernehmen
    $title = trim($_POST['title'] ?? '');
    $quantity = trim($_POST['quantity'] ?? '');
    $unit = $_POST['unit'] ?? '';
    $information = trim($_POST['information'] ?? '');
    $category = $_POST['category'] ?? '';

    // Titel prüfen
    if ($title === '') {
        $errors['title'] = 'Bitte einen Titel eingeben.';
    } else {

        if (strlen($title) < 2) {
            $errors['title'] = 'Der Titel muss mindestens 2 Zeichen lang sein.';
        }

        if (strlen($title) > 40) {
            $errors['title'] = 'Der Titel darf maximal 40 Zeichen lang sein.';
        }
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

    // Zusatzinformation prüfen
    if (strlen($information) > 120) {
        $errors['information'] = 'Maximal 120 Zeichen erlaubt.';
    }

    // Kategorie prüfen
    if (!in_array($category, $allowedCategories, true)) {
        $errors['category'] = 'Bitte eine gültige Kategorie auswählen.';
    }

    // Daten speichern, wenn keine Fehler vorhanden sind
    if (empty($errors)) {

        createItem(
            $title,
            $quantity,
            $unit,
            $information,
            $category
        );

        // Nach erfolgreichem Speichern zur Übersicht wechseln
        header('Location: list.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neuer Eintrag</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>Neuer Eintrag</h1>

    <!-- Formular zum Erstellen eines neuen Eintrags -->
    <form method="post">

        <label for="title">Titel</label>
        <input
            type="text"
            id="title"
            name="title"
            value="<?= htmlspecialchars($title) ?>"
        >
        <!-- Fehlermeldung zum Titel -->
        <?php if (isset($errors['title'])): ?>
            <p class="error"><?= $errors['title'] ?></p>
        <?php endif; ?>

        <label for="quantity">Menge</label>
        <input
            type="number"
            step="0.01"
            id="quantity"
            name="quantity"
            value="<?= htmlspecialchars($quantity) ?>"
        >
        <!-- Fehlermeldung zur Menge -->
        <?php if (isset($errors['quantity'])): ?>
            <p class="error"><?= $errors['quantity'] ?></p>
        <?php endif; ?>

        <label for="unit">Einheit</label>
        <select name="unit" id="unit">
            <option value="">Bitte wählen</option>

            <!-- Erlaubte Einheiten ausgeben -->
            <?php foreach ($allowedUnits as $value): ?>
                <option
                    value="<?= $value ?>"
                    <?= $unit === $value ? 'selected' : '' ?>
                >
                    <?= $value ?>
                </option>
            <?php endforeach; ?>
        </select>

        <?php if (isset($errors['unit'])): ?>
            <p class="error"><?= $errors['unit'] ?></p>
        <?php endif; ?>

        <label for="information">Zusatzinformation</label>
        <textarea
            id="information"
            name="information"
        ><?= htmlspecialchars($information) ?></textarea>

        <?php if (isset($errors['information'])): ?>
            <p class="error"><?= $errors['information'] ?></p>
        <?php endif; ?>

        <label for="category">Kategorie</label>
        <select name="category" id="category">
            <option value="">Bitte wählen</option>

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

        <!-- Fehlermeldung zur Kategorie -->
        <?php if (isset($errors['category'])): ?>
            <p class="error"><?= $errors['category'] ?></p>
        <?php endif; ?>

        <div class="actions">

            <!-- Formular absenden -->
            <button type="submit" class="btn">
                Speichern
            </button>

            <!-- Zur Übersicht zurückkehren -->
            <a href="list.php" class="btn danger">
                Abbrechen
            </a>

        </div>

    </form>

</div>

</body>
</html>