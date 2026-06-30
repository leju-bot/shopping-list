# Shopping Liste

# Day One
Hier habe ich alles selber geschrieben und dann nochmal von Chat GPT Strukturieren lassen, damit alles übersichtlich und verständlich ist.

## Projektbeschreibung (Phase 01)
Dieses Projekt ist eine webbasierte Einkaufsliste, die mit PHP und MySQL entwickelt wird. Nutzer können Artikel anlegen, anzeigen, bearbeiten und löschen.

### Projektstruktur
Für das Projekt wurde eine übersichtliche Ordnerstruktur angelegt:
* `css/` – Stylesheets
* `database/` – SQL-Skripte für die Datenbank
* `inc/` – Hilfsfunktionen und Datenbankanbindung
* PHP-Dateien für die einzelnen Funktionen der Anwendung

### Datenbank
Für das Projekt wurde die MySQL-Datenbank `shopping_list` erstellt.
Die Tabelle `shopping_items` enthält unter anderem folgende Informationen:
* Titel des Artikels
* Menge
* Einheit
* Zusatzinformationen
* Kategorie
* Status (offen oder gekauft)
* Erstellungs- und Änderungsdatum
Das SQL-Skript zur Erstellung der Datenbank befindet sich im Ordner `database/`.

### Verwendete Technologien
* PHP
* MySQL
* HTML
* CSS
* Git
* GitHub

### Versionsverwaltung
Das Projekt wird mit Git versioniert und zusätzlich auf GitHub gespeichert. Dadurch können Änderungen nachvollzogen und verschiedene Entwicklungsstände gesichert werden.

### Versionsverwaltung
Für die Versionsverwaltung wird Git verwendet. Das Projekt wird zusätzlich in einem GitHub-Repository gespeichert.
Verwendete Git-Befehle:
```bash
git init
git add .
git commit -m "Erste Version"
git push
```
Dadurch können Änderungen am Projekt nachvollzogen und verschiedene Entwicklungsstände gesichert werden.

## Datenbank & Backend (Phase 02)

In dieser Phase wurde die Datenbankanbindung über PDO eingerichtet und die grundlegende Backend-Logik umgesetzt.

Die Verbindung zur MySQL-Datenbank `shopping_list` nutzt UTF-8 (`utf8mb4`) und ist so konfiguriert, dass Fehler als Exceptions ausgegeben werden.

Es wurden zentrale CRUD-Funktionen erstellt:
- `getAllItems()` – alle Einträge laden  
- `getItemById()` – einzelnes Item laden  
- `createItem()` – neuen Eintrag erstellen  
- `updateItem()` – Eintrag bearbeiten  
- `deleteItem()` – Eintrag löschen  
- `toggleItemStatus()` – Status ändern  
- `deleteAllItems()` – alle Einträge löschen  

Alle SQL-Abfragen wurden mit Prepared Statements umgesetzt, um die Anwendung vor SQL-Injection zu schützen.

## Listenansicht (Phase 3)
In dieser Phase wurde die Darstellung der Einkaufsliste (`list.php`) umgesetzt.

### Aufbau der Seite
- Überschrift „Meine Einkaufsliste“
- Anzeige des aktuellen Datums (d.m.Y)
- Buttons für „Neuer Eintrag“ und „Neue Liste“

### Artikeldarstellung
- Alle Datensätze werden aus der Datenbank geladen
- Leere Listen werden entsprechend behandelt
- Anzeige von Status, Menge, Einheit und Titel
- Funktionen zum Bearbeiten und Löschen von Einträgen

### Status-Darstellung
- Erledigte Einträge werden ausgegraut
- Zusätzlich werden sie durchgestrichen dargestellt

### Sicherheit
Zur Vermeidung von XSS werden Ausgaben mit `htmlspecialchars()` abgesichert.

### Git-Stand
Diese Phase wurde versioniert und ins Repository hochgeladen.