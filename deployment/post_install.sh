#!/usr/bin/env sh

docker-compose exec -u root ga_application composer install \
    && docker-compose exec -u root ga_application mv .env.example .env \
    && docker-compose exec -u root ga_application npm install \
    && docker-compose exec -u root ga_application npm run build \
    && docker-compose exec -u root ga_application php artisan migrate