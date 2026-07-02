# Shopping Liste
Den Inhalt habe ich zunächst selbst formuliert und anschließend mit ChatGPT strukturiert, um ihn übersichtlicher und verständlicher darzustellen.

Dieses Vorgehen habe ich im gesamten Projekt angewendet. Dabei habe ich die Inhalte eigenständig erarbeitet und ChatGPT wiederholt als Unterstützung zum Strukturieren sowie zum Diskutieren und Brainstormen von Ideen genutzt.

Da ich mich noch in der Einarbeitung in die Programmierung befinde, habe ich mir in einigen Fällen auch Codebeispiele von ChatGPT generieren lassen, wenn ich in den bereitgestellten Unterlagen keine passende Lösung oder kein geeignetes Beispiel für meine konkrete Fragestellung gefunden habe. Die generierten Vorschläge habe ich anschließend geprüft, an mein Projekt angepasst und in den jeweiligen Kontext integriert. 

# Day One

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

# Day 02

## Neuen Eintrag erstellen `create.php` (Phase 4)

In dieser Phase wurde die Seite `create.php` entwickelt, mit der neue Einträge angelegt werden können. Das Formular enthält die Felder Titel, Menge, Einheit, Zusatzinformation und Kategorie.

Die Seite wurde als Self-Submitting-Formular umgesetzt. Dadurch ist dieselbe Datei sowohl für die Anzeige des Formulars als auch für die Verarbeitung der abgesendeten Daten verantwortlich.

Vor dem Speichern werden alle Eingaben überprüft. Dabei wird sichergestellt, dass der Titel ausgefüllt wurde, die Menge einen gültigen Wert enthält und eine Einheit sowie eine Kategorie ausgewählt wurden. Auch die Zusatzinformationen werden auf gültige Eingaben geprüft.

Falls fehlerhafte oder unvollständige Daten eingegeben werden, erhält der Benutzer entsprechende Fehlermeldungen. Bereits eingegebene Werte bleiben dabei erhalten, damit das Formular nicht erneut vollständig ausgefüllt werden muss.

Über die Schaltfläche „Abbrechen“ gelangt der Benutzer zurück zur `list.php`. Nach erfolgreichem Speichern wird ebenfalls automatisch auf die Übersichtsseite weitergeleitet.

Der Abschluss dieser Phase wurde mit folgendem Git-Commit dokumentiert:

```bash id="q7m3nk"
git commit -m "Formular zum Anlegen neuer Einträge ergänzt"
```

## Bearbeiten von Einträgen (Phase 5)
Für bestehende Einträge wurde eine Bearbeitungsfunktion umgesetzt. Die vorhandenen Daten werden beim Öffnen des Formulars automatisch geladen und vorausgefüllt. Änderungen können gespeichert oder verworfen werden.

Zusätzlich werden die ID des Eintrags sowie das Erstellungs- und Änderungsdatum zur Information angezeigt. Die Eingaben werden mit denselben Validierungsregeln geprüft wie beim Anlegen neuer Einträge.

## Löschen von Einträgen (Phase 6)
Die Anwendung wurde um eine Löschfunktion erweitert. Einträge können über ein Formular gelöscht werden, wobei die ID per POST übertragen wird. Vor dem Löschen erscheint eine Sicherheitsabfrage zur Bestätigung. Nach erfolgreichem Löschen erfolgt die Weiterleitung zur Listenansicht.

## Statusänderung (Phase 7)
Einträge können nun als erledigt oder offen markiert werden. Die Statusänderung erfolgt über ein Formular mit POST-Übertragung. Beim Anklicken wird der aktuelle Status umgeschaltet und anschließend die aktualisierte Liste angezeigt.

## Neue Liste (Phase 8)
Die Anwendung wurde um die Funktion „Neue Liste“ erweitert. Über ein POST-Formular können alle Einträge der Einkaufsliste auf einmal gelöscht werden. Vor dem Löschen erscheint eine Sicherheitsabfrage. Nach erfolgreicher Ausführung wird automatisch zur Listenansicht zurückgeleitet.

## Sicherheit und Fehlerbehandlung (Phase 9)
Die Anwendung wurde um zusätzliche Sicherheits- und Validierungsprüfungen erweitert. IDs werden vor Datenbankzugriffen auf Gültigkeit geprüft und nur vorhandene Datensätze verarbeitet.

Zusätzlich wurden alle Benutzereingaben validiert und sämtliche Ausgaben mit `htmlspecialchars()` abgesichert. Dadurch werden fehlerhafte Eingaben abgefangen und potenzielle Sicherheitsrisiken wie Cross-Site-Scripting reduziert.

# Day 03 

## Erweiterungen (Phase 10)
Die Listenansicht wurde erweitert und nach Kategorien gegliedert. Die Einkaufsartikel werden nun unter den Überschriften „Lebensmittel“, „Fertigprodukte“ und „Non-Food“ angezeigt. Zusätzlich wurde ein Filter ergänzt, mit dem erledigte Einträge bei Bedarf ausgeblendet werden können.
