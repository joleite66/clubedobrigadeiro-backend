# Define the PHP binary inside the container
PHP = docker exec -it clubedobrigadeiro php

# Define Composer inside the container
COMPOSER = docker exec -it clubedobrigadeiro composer

# Define Symfony Console inside the container
CONSOLE = $(PHP) bin/console

# Define PHPStan inside the container
PHPSTAN = $(PHP) vendor/bin/phpstan

# Define PHP-CS-Fixer inside the container
CSFIXER = $(PHP) vendor/bin/php-cs-fixer

# Default help command
help:
	@echo "Available commands:"
	@echo "  make up         - Start Docker containers"
	@echo "  make down       - Stop Docker containers"
	@echo "  make restart    - Restart Docker containers"
	@echo "  make install    - Install PHP dependencies"
	@echo "  make migrate    - Run Doctrine migrations"
	@echo "  make stan       - Run PHPStan static analysis"
	@echo "  make fix        - Run PHP-CS-Fixer"
	@echo "  make clean      - Remove cache and logs"
	@echo "  make shell      - Open a shell in the PHP container"

# Docker commands
up:
	docker-compose up -d

down:
	docker-compose down

restart:
	docker-compose down && docker-compose up -d

# Install dependencies
install:
	$(COMPOSER) install

# Database migrations
migrate:
	$(CONSOLE) doctrine:migrations:migrate --no-interaction

# PHPStan - Static Analysis
stan:
	$(PHPSTAN) analyse src --level=max

# PHP-CS-Fixer - Code Formatting
fix:
	$(CSFIXER) fix --config=.php-cs-fixer.dist.php

# Clear cache & logs
clean:
	$(CONSOLE) cache:clear
	rm -rf var/cache var/log

# Open a shell inside the PHP container
shell:
	docker exec -it clubedobrigadeiro bash
