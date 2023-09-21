#! /bin/bash
php bin/console cache:clear
mkdir ./docker/app/
cp -dpR bin/ config/ migrations/ public/ src/ templates/ tests/ translations/ var/ vendor/ .env .env.test composer.json phpunit.xml.dist symfony.lock ./docker/app/

