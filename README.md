# Dokumentation: Personio Bundle

## 1. Einleitung
Das Personio Bundle ermöglicht die Integration eines Bewerbungsformulars mit Personio. Über die Systemeinstellungen können die Zugangsdaten zu Personio hinterlegt werden, um Bewerbungen direkt an das System zu übermitteln.

## 2. Einrichtung
### 2.1 Zugangsdaten hinterlegen
Unter **System -> Einstellungen** können die erforderlichen Zugangsdaten für die Verbindung mit Personio eingetragen werden. Diese beinhalten:
- API-Zugangsdaten
- Authentifizierungsschlüssel
- Unternehmens-ID

## 3. Bewerbungsformular
Das Bewerbungsformular erfasst alle relevanten Informationen eines Bewerbers und übermittelt diese an Personio. Das Formular enthält folgende Felder:

### 3.1 Pflichtfelder
- **first_name** (Text): Vorname des Bewerbers
- **last_name** (Text): Nachname des Bewerbers
- **email** (Text): E-Mail-Adresse des Bewerbers
- **phone** (Text): Telefonnummer des Bewerbers
- **message** (Text): Nachricht des Bewerbers
- **salary_expectations** (Text): Gehaltsvorstellungen

### 3.2 Optionale Felder
- **birthday** (Datum): Geburtsdatum des Bewerbers
- **available_from** (Datum): Verfügbarkeit des Bewerbers
- **application_date** (Datum): Datum der Bewerbung
- **files** (Upload): Hochladen von Bewerbungsunterlagen

### 3.3 Versteckte Felder (automatisch gesetzt)
- **job_position_id**: Die ID der ausgeschriebenen Stelle
- **company_id**: Die ID des Unternehmens
- **access_token**: Authentifizierungstoken für die sichere Übertragung der Daten

## 4. Datenübertragung
Nach dem Absenden des Formulars werden die Daten an die Personio-API übermittelt. Dabei werden alle Eingaben entsprechend den definierten Feldern verarbeitet und im System hinterlegt.

## 5. Sicherheit
- Die Übertragung der Daten erfolgt verschlüsselt über HTTPS.
- Sensible Informationen wie das **access_token** werden nicht sichtbar gespeichert.
- Hochgeladene Dateien werden sicher übertragen und im Bewerberprofil gespeichert.

## 6. Fehlerbehandlung
Sollte es zu Problemen bei der Übertragung kommen, werden entsprechende Fehlermeldungen ausgegeben. Mögliche Fehlerquellen sind:
- Fehlende oder falsche Zugangsdaten
- Pflichtfelder nicht ausgefüllt
- Probleme mit der API-Verbindung

