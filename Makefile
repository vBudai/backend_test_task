USER_ID=$(shell id -u)

# Default environment
ENV ?= dev

# Load chosen env file
ifeq ($(ENV),prod)
	ENV_FILE=.env.prod
else
	ENV_FILE=.env.dev
endif

include $(ENV_FILE)
export $(shell sed 's/=.*//' $(ENV_FILE))

DC = @USER_ID=$(USER_ID) docker compose
DC_RUN = ${DC} run --rm sio_test
DC_EXEC = ${DC} exec sio_test

PHONY: help
.DEFAULT_GOAL := help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

init: down build install up wait-for-db db-migrate db-fixtures success-message console ## Initialize environment

init-prod: ## Initialize production environment
	@$(MAKE) init ENV=prod

init-dev: ## Initialize development environment
	@$(MAKE) init ENV=dev

build: ## Build services.
	${DC} build $(c)

up: ## Create and start services.
	${DC} up -d $(c)

stop: ## Stop services.
	${DC} stop $(c)

start: ## Start services.
	${DC} start $(c)

down: ## Stop and remove containers and volumes.
	${DC} down -v $(c)

restart: stop start ## Restart services.

console: ## Login in console.
	${DC_EXEC} /bin/bash

install: ## Install dependencies without running the whole application.
	${DC_RUN} composer install

success-message:
	@echo "You can now access the application at http://localhost:8337"
	@echo "Good luck! 🚀"

wait-for-db: ## Wait for database to be ready
	@echo "Waiting for database to be ready..."
	@${DC_EXEC} bash -c 'timeout 60s bash -c '\''until php -r "new PDO(\"${DATABASE_URL}\", \"${DATABASE_USER}\", \"${DATABASE_PASSWORD}\");" 2>/dev/null; do sleep 1; done'\'''
	@echo "Database is ready"

db-migrate: ## Run database migrations
	@echo "Applying database migrations..."
	${DC_EXEC} php bin/console doctrine:migrations:migrate --no-interaction
	@echo "Migrations completed successfully"

db-fixtures: ## Load fixtures into database
	@echo "Loading fixtures..."
	${DC_EXEC} php bin/console doctrine:fixtures:load --no-interaction
	@echo "Fixtures loaded successfully"