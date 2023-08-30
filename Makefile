default: init

init:
	docker-compose build --no-cache
	docker-compose up -d
	docker-compose exec ga_application composer install
	docker-compose exec ga_application cp .env.example .env
	docker-compose exec ga_application npm install
	docker-compose exec ga_application npm run build
	docker-compose exec ga_application php artisan db:seed
	docker-compose exec ga_application php artisan test --testsuite=Unit
	docker-compose exec ga_application php artisan test --testsuite=Feature

start:
	docker-compose start

stop:
	docker-compose stop

test:
	docker-compose exec ga_application php artisan test --testsuite=Unit
	docker-compose exec ga_application php artisan test --testsuite=Feature

destroy:
	docker-compose down

log:
	docker-compose logs ga_application