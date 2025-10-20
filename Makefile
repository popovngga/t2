DOCKER=docker-compose
PHP=docker-compose exec app php

init:
	@if [ ! -f .env ]; then cp .env.example .env; fi
	$(DOCKER) up -d --build
	$(PHP) artisan key:generate
	echo 'Waiting for DB...'
	sleep 7
	$(PHP) artisan optimize
	$(PHP) artisan migrate:fresh
