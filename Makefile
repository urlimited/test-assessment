default: init

init:
	docker-compose build
	docker-compose up -d
	docker-compose exec ga_application composer install
	docker-compose exec ga_application npm install
	docker-compose exec ga_application npm run build

start:
	docker-compose start

stop:
	docker-compose stop

test:
	docker-compose exec ga_application php artisan test

destroy:
	docker-compose down

log:
	docker-compose logs ga_application