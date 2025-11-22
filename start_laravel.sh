#!/bin/bash

# Aller dans le dossier du projet
cd /Users/yassineakazi/Desktop/auto_manager

# Nettoyer le cache Laravel (optionnel mais recommandé)
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Lancer le serveur Laravel intégré
php artisan serve --host=127.0.0.1 --port=8000