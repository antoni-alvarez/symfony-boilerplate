start: prepare up install clear welcome

stop:
	docker compose -f devops/docker-compose.yaml stop

clear:
	docker compose -f devops/docker-compose.yaml exec playground bin/console c:c

prepare:
	mkdir -p var/log

up:
	docker compose -f devops/docker-compose.yaml build --pull && \
	docker compose -f devops/docker-compose.yaml up -d --force-recreate

install:
	docker compose -f devops/docker-compose.yaml exec playground sh -c 'if [ ! -d vendor ] || [ ! -f bin/console ]; then composer install -n; fi'

down:
	docker compose -f devops/docker-compose.yaml down

ssh:
	docker compose -f devops/docker-compose.yaml exec playground sh

welcome:
	@echo ""
	@echo "🎉 Project is up and running!"
	@echo "🔗 Open your browser and visit: http://playground.localhost"
	@echo "🚀 Happy coding!"
	@echo ""
