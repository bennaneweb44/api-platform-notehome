## NOTEHOME - Api Platform project
## ————————————————————————————————————————————————————————————————————————
##
MS_NAME	          = php-fpm
ENV				  = dev
ENVIRONNEMENT	  = $(ENV)
.DEFAULT_GOAL     = help

.PHONY: help
help: ## Display help
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

##
## Composer
## ————————————————————————————————————————————————————————————————————————
.PHONY: composer-install
composer-install: ## Installation des dépendances
	composer install --prefer-dist --no-progress --no-interaction

.PHONY: composer-update
composer-update: ## Mise à jour des dépendances
	composer update

##
## Symfony
## ————————————————————————————————————————————————————————————————————————
.PHONY: clear-cache
clear-cache: ## Vider le cache
	php bin/console cache:clear

##
## Tests - Bientôt disponible
## ————————————————————————————————————————————————————————————————————————
.PHONY: database-test
database-test: ## Intialiser la BD de test
	php bin/console cache:clear --env=test
	php bin/console doctrine:database:drop --force --if-exists --env=test
	php bin/console doctrine:database:create --if-not-exists --env=test
	php bin/console doctrine:schema:create --env=test

.PHONY: migrations-test
migrations-test: ## Données de test 
	php bin/console doctrine:fixtures:load --no-interaction --env=test

.PHONY: run-test
run-test: database-test migrations-test  ## Exécuter les tests
	php bin/phpunit -c . --colors=always

##
## Database
## ————————————————————————————————————————————————————————————————————————

.PHONY: init-db
init-db: ## Initialiser la BD
	php bin/console doctrine:migrations:rollup --no-interaction --env=$(ENVIRONNEMENT)
	php bin/console doctrine:database:drop --force --if-exists --env=$(ENVIRONNEMENT)
	php bin/console doctrine:database:create --if-not-exists --env=$(ENVIRONNEMENT)

.PHONY: update-migration
update-migration: ## Créer la structure
	@rm -rf migrations/V*
	php bin/console make:migration
	php bin/console d:m:m -n

.PHONY: exec-migration
exec-migration: ## Créer la structure
	php bin/console d:m:m -n

.PHONY: fixtures
fixtures: ## Ajout de données par défaut
	php bin/console doctrine:fixtures:load --no-interaction

##
## Project : Local
## ————————————————————————————————————————————————————————————————————————

.PHONY: start ## Initialiser le projet en local
start: composer-install clear-cache init-db exec-migration fixtures

.PHONY: update ## Start avec M.A.J de structure de BD
update: composer-install clear-cache init-db update-migration fixtures

##
## Project : Server
## ————————————————————————————————————————————————————————————————————————

.PHONY: deploy ## Initialiser le projet sur serveur (supprimer toutes les tables en BD avant)
deploy: composer-install clear-cache init-db exec-migration