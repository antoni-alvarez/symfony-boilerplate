# Containerized Symfony Boilerplate

This is a lightweight Docker-based boilerplate for quickly setting up a Symfony application in a local development environment, perfect for experimentation, proofs of concept or technical code challenges

## 🚀 How to start

Simply run:

```bash
  make start
```

Once started, the project will be accessible at:

[http://playground.localhost](http://playground.localhost)

## ✅ Core features

- 🐘 **Symfony** — A minimal Symfony skeleton
- 🔧 **Symfony Flex** — Symfony packages are pinned to the latest LTS release
- 🐞 **Xdebug** — Debugger installed and enabled
- 📦 **Composer** — Dependency manager installed and ready to use
- 🌐 **Custom local domain** — The application is exposed at `http://playground.localhost` via reverse proxy

## ✅ Additional features

- 📦 **Composer Normalizer** — Analyze and fix `composer.json` using `composer normalize`
- 🧹 **PHP CS Fixer** — Preconfigured with opinionated rules. Run with `composer fix:standards`
- 🔍 **PHPStan** — Configured with max level for source code and level 5 for tests. Run with `composer analyze:phpstan`
- 🧪 **PHPUnit** — Installed and ready to run tests using `composer test`
- 🏛️ **PHPat** — Architecture testing plugin for PHPStan. Includes a hexagonal architecture example. Executed as part of `composer analyze:phpstan`

#### 🧪 Run all analyzers

To run all code quality tools (linter, fixer, and static analysis) at once, you can use:

```bash
  docker compose -f devops/docker-compose.yaml exec playground composer a:a
```