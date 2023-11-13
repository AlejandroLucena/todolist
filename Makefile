PHP_CONTAINER_NAME=php

.PHONY: up
up:
	docker compose up -d --force-recreate

.PHONY: down
down:
	docker system prune --force && \
	docker rmi $$(docker images -q)

.PHONY: start
start:
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php artisan migrate && php artisan cache:clear'

.PHONY: stop
stop:
	docker compose down

.PHONY: restart
restart:
	docker compose build && docker compose up -d

.PHONY: restart_php
restart_php: config_cache
	docker compose build $(PHP_CONTAINER_NAME) && docker compose up -d
	make config_cache

.PHONY: test
test: restart_php
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php ./vendor/bin/phpunit --no-coverage --stop-on-error --stop-on-failure --testsuite Unit'

.PHONY: pint
pint:
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php ./vendor/bin/pint'

.PHONY: phpstan
phpstan:
	php apps/laravel/vendor/bin/phpstan analyse --memory-limit=2G apps/laravel/src apps/laravel/app

.PHONY: key-genrate
key-generate:
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php artisan key:generate'

.PHONY: config_cache
config_cache:
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php artisan view:clear'
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php artisan config:clear'
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php artisan config:cache'
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php artisan config:cache'
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php artisan route:cache'
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php artisan route:list'

.PHONY: reset_db
reset_db: config_cache
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php artisan migrate:refresh'

.PHONY: routes
routes:
	php ./apps/laravel/artisan route:cache
	php ./apps/laravel/artisan route:list

.PHONY: dumpautoload
dumpautoload:
	docker exec -it $(PHP_CONTAINER_NAME) composer dumpautoload
	make restart_php

.PHONY: openapi
openapi: restart_php config_cache
	docker exec -it $(PHP_CONTAINER_NAME) bash -c 'php artisan scribe:generate --env docs --verbose'



