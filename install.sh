#!/usr/bin/env bash

cp .env.example .env
php artisan key:generate

composer install
composer dump-autoload

php artisan migrate --force
php artisan db:seed --force

php artisan view:clear && php artisan route:clear && php artisan cache:clear && php artisan config:cache
