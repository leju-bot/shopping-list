<?php

require_once "inc/database_functions.inc.php";

$id = (int)($_GET['id'] ?? 0);

$item = getItemById($id);

if (!$item) {
    header('Location: list.php');
    exit;
}

$errors = [];

$title = $item['title'];
$quantity = $item['quantity'];
$unit = $item['unit'];
$information = $item['information'];
$category = $item['category'];

$allowedUnits = ['l', 'g', 'kg', 'St.', 'Pk.'];
$allowedCategories = ['food', 'convenience', 'non-food'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $quantity = trim($_POST['quantity'] ?? '');
    $unit = $_POST['unit'] ?? '';
    $information = trim($_POST['information'] ?? '');
    $category = $_POST['category'] ?? '';

    if ($title === '') {
        $errors['title'] = 'Bitte einen Titel eingeben.';
    }

    if ($quantity === '') {
        $errors['quantity'] = 'Bitte eine Menge eingeben.';
    } elseif (!is_numeric($quantity) || $quantity <= 0) {
        $errors['quantity'] = 'Bitte eine gültige Menge eingeben.';
    }

    if (!in_array($unit, $allowedUnits, true)) {
        $errors['unit'] = 'Bitte eine gültige Einheit auswählen.';
    }

    if (strlen($information) > 120) {
        $errors['information'] = 'Maximal 120 Zeichen erlaubt.';
    }

    if (!in_array($category, $allowedCategories, true)) {
        $errors['category'] = 'Bitte eine gültige Kategorie auswählen.';
    }

    if (empty($errors)) {

        updateItem(
            $id,
            $title,
            $quantity,
            $unit,
            $information,
            $category
        );

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