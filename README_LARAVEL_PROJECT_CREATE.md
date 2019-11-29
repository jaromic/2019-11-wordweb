# Projekt-Setup

Ausführung einmal pro Repository pro Projekt (nur der erste Entwickler muss diese Zeilen ausführen).

## Install Laravel

    composer create-project --prefer-dist laravel/laravel temp
    mv -vi temp/* ./
    mv -vi temp/.??* ./
    rmdir temp
