#!/bin/sh
composer update
php app/console doctrine:database:create
php app/console doctrine:migrations:migrate
php app/console assets:install
php app/console faker:populate
php app/console fakermany:populate