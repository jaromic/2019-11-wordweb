# Aufsetzen der Entwicklungsumgebung

Dieses Dokument enthält exakte Anweisungen, um die Entwicklungsumgebung einheitlich aufzusetzen. Diese Anweisungen sollte jeder Entwickler pro Rechner einmalig ausführen.

## Voraussetzungen

* Composer muss installiert und im Pfad sein, sodass er von der Kommandozeile als `composer` aufgerufen werden kann.
* Node.js muss installiert und im Pfad sein, sodass `npm` von der Kommandozeile aufgerufen werden kann. Falls nicht, von https://nodejs.org/dist/v12.13.0/node-v12.13.0-x64.msi  herunterladen und installieren.

## Hosts-File

Folgende Zeile zu `c:\windows\system32\drivers\etc\hosts` hinzufügen:

```
127.0.0.1 dev.wordweb
```

## IDE

Als IDE wird PHPStorm verwendet.

* PHPStorm starten
* Falls ein Projekt geöffnet ist: `File/Close Project`
* `Check out from Version Control/Git` wählen
* `https://github.com/jaromic/2019-11-all-in-one-therapy.git` in ein passendes Zielverzeichnis auschecken
* Im Project-Baum auf der linken Seite den Projektnamen `2019-11-all-in-one-therapy.git` mit Rechts anklicken und `Copy path` wählen
* Frage `Open Directory?` mit `Yes` beantworten, falls sie angezeigt wird.

## VHost-Konfiguration
Die VHost-Konfiguration unter `C:\xampp\apache\conf\extra\httpd-vhosts.conf` bearbeiten:
* den folgenden VHost hinzufügen
    * dabei `MY_GIT_WORKING_COPY` durch den Pfad aus der Zwichenablage, siehe Punkt `IDE`ersetzen
    * kontrollieren, ob der Port `8009` nicht schon anderswo in `http-vhosts.conf` konfiguriert ist (in dem Fall einen anderen wählen)
    * Anschließend den Web-Server neu starten.

```apacheconfig
Listen 8010
<VirtualHost dev.wordweb:8010>
  ServerName dev.wordweb
  DocumentRoot "MY_GIT_WORKING_COPY/public"

  SSLEngine on
  SSLCertificateFile "conf/ssl.crt/server.crt"
  SSLCertificateKeyFile "conf/ssl.key/server.key"

  <Directory "MY_GIT_WORKING_COPY/public">
      AllowOverride All
      Require all granted
      Options Indexes FollowSymLinks
  </Directory>

  ErrorLog "logs/dev.wordweb.log"
  CustomLog "logs/dev.wordweb.log" common
</VirtualHost>
```

## Datenbank

`http://localhost/phpmyadmin/` aufrufen
In oberer Leiste `SQL` wählen
Folgende Befehle ausführen

```mysql
CREATE DATABASE `dev.wordweb` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`;
CREATE USER 'wordweb'@'localhost' IDENTIFIED BY 'H%21ka/bl3-';
GRANT USAGE ON *.* TO 'wordweb'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `dev.wordweb`.* TO 'wordweb'@'localhost'; 
```

## Composer-Install

Die lokalen Abhängigkeiten auf den im Repository eingecheckten Stand bringen:

```
composer install
```

## Copy development environment file

Die Datei `.env.development` auf den Namen `.env` kopieren.

## App-Key generieren

```
php artisan key:generate
```

## NPM-Abhängigkeiten installieren

```
npm install
```
