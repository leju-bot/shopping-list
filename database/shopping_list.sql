/* 
Hier habe ich die Ki befragt:
Erstelle mir ein SQL-Skript für eine MySQL-Datenbank namens `shopping_list`.
Anforderungen:
- Ich benötige eine Datenbank mit dem Zeichensatz `utf8mb4` und Kollation `utf8mb4_unicode_ci` 
- Tabelle `shopping_items` erstellen.
- Primärschlüssel `id` als `INT UNSIGNED AUTO_INCREMENT`.
- `title` als `VARCHAR(40)`.
- `quantity` als `DECIMAL(8,2)`.
- `unit` als ENUM mit den Werten `l`, `g`, `kg`, `St.`, `Pk.`.
- `information` als `VARCHAR(120)` mit leerem String als Standardwert.
- `category` als ENUM mit den Werten `food`, `convenience`, `non-food`.
- `status` als `TINYINT(1)` mit Standardwert `0` (offen/nicht gekauft).
- Felder `created_at` und `updated_at` als Timestamps, wobei `updated_at` 
  automatisch bei Änderungen aktualisiert wird.

Kommentare wurden selbst hinzugefügt, um die Struktur 
und Funktionalität der Datenbank und Tabelle zu erklären.
*/


-- Datenbank anlegen
CREATE DATABASE IF NOT EXISTS shopping_list
-- Zeichensatz für Unicode
CHARACTER SET utf8mb4
-- legt fest, wie Text verglichen und sortiert werden
COLLATE utf8mb4_unicode_ci;

-- Datenbank auswählen
USE shopping_list;

-- Tabelle für Einkaufseinträge erstellen
CREATE TABLE shopping_items (

    -- ID, wird automatisch hochgezählt
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,

    -- Name des Artikels (max. 40 Zeichen)
    title VARCHAR(40) NOT NULL,

    -- Menge des Artikels 
    quantity DECIMAL(8,2) NOT NULL,

    -- Einheit der Menge, nur vorgegebene Werte erlaubt, sowie in der Aufgabe vorgegeben 
    unit ENUM('l', 'g', 'kg', 'St.', 'Pk.') NOT NULL,

    -- Zusätzliche Informationen zum Artikel
    information VARCHAR(120) NOT NULL DEFAULT '',

    -- Kategorie des Artikels
    category ENUM('food', 'convenience', 'non-food') NOT NULL,

    -- Status: 0 = offen, 1 = gekauft
    status TINYINT(1) NOT NULL DEFAULT 0,

    -- Zeitpunkt der Erstellung des Datensatzes
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    -- Zeitpunkt der letzten Änderung (automatisch aktualisiert)
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    -- Primärschlüssel der Tabelle
    PRIMARY KEY (id)
);