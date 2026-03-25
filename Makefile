up:
	docker compose up --build --detach
	make migrate

down:
	docker compose down

logs:
	docker compose logs -f

migrate:
	docker compose exec app php bin/console doctrine:migrations:migrate --no-interaction

build-prod:
	docker build -t unilogger:1.0

test:
	docker compose exec app php bin/phpunit

test-unit:
	docker compose exec app php bin/phpunit --testsuite=Unit

test-functional:
	docker compose exec app php bin/phpunit --testsuite=Functional
