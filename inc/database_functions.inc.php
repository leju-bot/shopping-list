<?php
/**
 * enthält alle funktionen für die shopping items
 * (holen, erstellen, bearbeiten, löschen und status ändern)
 */

require_once "database.inc.php";

// Alle Items holen 
function getAllItems() {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM shopping_items ORDER BY created_at DESC");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Einzelnes Item holen
function getItemById($id) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM shopping_items WHERE id = ?");
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Item erstellen
function createItem($title, $quantity, $unit, $information, $category) {
    global $pdo;

    $stmt = $pdo->prepare("
        INSERT INTO shopping_items (title, quantity, unit, information, category)
        VALUES (?, ?, ?, ?, ?)
    ");

    return $stmt->execute([$title, $quantity, $unit, $information, $category]);
}

// Item aktualisieren
function updateItem($id, $title, $quantity, $unit, $information, $category) {
    global $pdo;

    $stmt = $pdo->prepare("
        UPDATE shopping_items
        SET title = ?, quantity = ?, unit = ?, information = ?, category = ?
        WHERE id = ?
    ");

    return $stmt->execute([$title, $quantity, $unit, $information, $category, $id]);
}

// Status umschalten (gekauft / nicht gekauft)
function toggleItemStatus($id, $status) {
    global $pdo;

    $stmt = $pdo->prepare("
        UPDATE shopping_items
        SET status = ?
        WHERE id = ?
    ");

    return $stmt->execute([$status, $id]);
}

// Item löschen
function deleteItem($id) {
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM shopping_items WHERE id = ?");
    return $stmt->execute([$id]);
}

// Alle Items löschen
function deleteAllItems() {
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM shopping_items");
    return $stmt->execute();
}