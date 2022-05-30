#!/bin/bash
docker-compose up -d && docker-compose exec myapp cp .env.example .env && docker-compose exec myapp composer install && docker-compose exec myapp php artisan migrate
