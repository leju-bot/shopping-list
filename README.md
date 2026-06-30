# Shopping List

## Day One

### Projektbeschreibung
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
