DC=docker-compose
CONTAINER=php
EXEC=$(DC) exec --user=application $(CONTAINER)
CONSOLE=bin/console

##
## Project setup
##---------------------------------------------------------------------------

.PHONY: install api fix-cs
.PRECIOUS: .env docker-compose.yml

install: ## Process all step in order to setup the projects
install: up mysql-reset mongodb-reset

vendor: vendor/autoload.php

vendor/autoload.php: composer.lock
	$(EXEC) composer install --no-suggest --no-progress

composer.lock: composer.json
	@echo composer.lock is not up to date

uninstall: ## Stops, remove the containers and their volumes
uninstall: clear-files
	$(DC) down -v --remove-orphans

##
## Docker
##---------------------------------------------------------------------------

.PHONY: clear-files docker-files
.PRECIOUS: .env

docker-files: .env docker-compose.yml

.env: .env.dist
	@if [ -f .env ]; \
	then\
		echo '\033[1;41m/!\ The .env.dist file has changed. Please check your .env file (this message will not be displayed again).\033[0m';\
		touch .env;\
		exit 1;\
	else\
		echo cp .env.dist .env;\
		cp .env.dist .env;\
	fi

up: ## Mount the containers
up: docker-files
	$(DC) up -d --build

clear-files: ## Remove everything: the cache, the logs, the sessions
clear-files: docker-files perm
	-$(EXEC) rm -rf var/cache/*
	-$(EXEC) rm -rf var/sessions/*
	-$(EXEC) rm -rf var/logs/*

down: ## Unmount the containers
down: docker-files
	$(DC) down

perm: docker-files
	-$(EXEC) chmod -R u+rwX,go+rX,go-w var

##
## Mysql
##---------------------------------------------------------------------------

.PHONY: mysql-reset mysql-install mysql-migrate

mysql-reset: ## Reset the mysql database
mysql-reset: clear-files mysql-install mysql-migrate

mysql-install: ## Reset the mysql database
mysql-install: docker-files vendor
	@echo 'Recreating mysql database schema...'
	@$(EXEC) php -r "for(;;){if(@fsockopen('mysql',3306)){break;}};"
	@$(EXEC) $(CONSOLE) doctrine:database:drop -n --if-exists --force
	@$(EXEC) $(CONSOLE) doctrine:database:create -n

mysql-migrate: ## Migrate mysql database schema to the latest available version
mysql-migrate: docker-files vendor
	@echo 'Executing mysql migrations...'
	@$(EXEC) $(CONSOLE) doctrine:migrations:migrate -n -q -e dev

##
## MongoDB
##---------------------------------------------------------------------------

.PHONY: mongodb-reset mongodb-install

mongodb-reset: ## Reset the mongdb database
mongodb-reset: clear-files mongodb-install

mongodb-install: ## Reset the mongodb database
mongodb-install: docker-files vendor
	@echo 'Recreating mongodb database schema...'
	@$(EXEC) php -r "for(;;){if(@fsockopen('mongo',27017)){break;}};"
	## @$(EXEC) $(CONSOLE) doctrine:mongodb:schema:drop -n
	@$(EXEC) $(CONSOLE) doctrine:mongodb:schema:create -n

##
## Tests
##---------------------------------------------------------------------------

.PHONY: check-security test-unit test-functional
.PRECIOUS: phpunit.xml behat.yml

phpunit.xml: phpunit.xml.dist
	@if [ -f phpunit.xml ]; \
	then\
		echo '\033[1;41m/!\ The phpunit.xml.dist file has changed. Please check your phpunit.xml file (this message will not be displayed again).\033[0m';\
		touch phpunit.xml;\
		exit 1;\
	else\
		echo cp phpunit.xml.dist phpunit.xml;\
		cp phpunit.xml.dist phpunit.xml;\
	fi

behat.yml: behat.yml.dist
	@if [ -f behat.yml ]; \
	then\
		echo '\033[1;41m/!\ The behat.yml.dist file has changed. Please check your behat.yml file (this message will not be displayed again).\033[0m';\
		touch behat.yml;\
		exit 1;\
	else\
		echo cp behat.yml.dist behat.yml;\
		cp behat.yml.dist behat.yml;\
	fi

check-security: ## Run SensioLabs Security checker
check-security: docker-files vendor
	$(EXEC) vendor/bin/security-checker security:check

test-unit: ## Runs the unit tests of the project packages
test-unit: docker-files vendor phpunit.xml
	$(EXEC) vendor/bin/phpunit

test-functional: ## Runs the functional tests of the project packages
test-functional: docker-files vendor behat.yml mysql-reset mongodb-reset
	$(EXEC) vendor/bin/behat --format="progress"

##
## Tools.
##---------------------------------------------------------------------------

.PHONY: cc bash

cc: ## Clear and warm up the cache in dev env
cc:
	$(EXEC) $(CONSOLE) cache:clear --no-warmup
	$(EXEC) $(CONSOLE) cache:warmup

bash: ## Access the api container via shell
	$(EXEC) bash