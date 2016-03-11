#!/bin/bash

composer install
echo "composer dependencies updated"
php artisan migrate
echo "migrated"
bower install --allow-root
echo "bower dependencies updated"
php artisan route:cache
php artisan config:cache
php artisan optimize
echo "routes and config cached"