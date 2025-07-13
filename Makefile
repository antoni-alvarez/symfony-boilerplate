up:
	docker compose -f devops/docker-compose.yaml build --pull && \
	docker compose -f devops/docker-compose.yaml up -d --force-recreate

down:
	docker compose -f devops/docker-compose.yaml down
