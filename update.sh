#!/bin/bash

composer install
echo "composer dependencies updated"
php artisan migrate
echo "migrated"
bower install --allow-root
echo "bower dependencies installed"
php artisan optimize
php artisan cache:clear
php artisan route:clear
php artisan view:clear