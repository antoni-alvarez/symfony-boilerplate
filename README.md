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

## ✅ Code Quality & Standards

The project is built with a strong focus on maintainability, adhering to modern PHP best practices and strict architectural rules.

### 📐 Standards & Principles

-   **PSR Compliance**: The codebase follows **PSR-1, PSR-2, PSR-4, and PSR-12** standards for naming, autoloading, and coding style.
-   **Strict Typing**: All PHP files contain `declare(strict_types=1);` to ensure type safety and prevent common runtime errors.
-   **Hexagonal Architecture**: Business logic is decoupled from infrastructure using Ports & Adapters, enforced by automated tests.

### 🛠️ Tooling & Enforcement

We use a comprehensive suite of tools to ensure code quality:

-   🔍 **PHPStan (Level Max)**: Static analysis configured at the highest level for the `src/` directory to catch potential bugs and type mismatches.
-   🧹 **PHP CS Fixer**: Automatically enforces Symfony and PSR coding standards.
-   🏛️ **PHPat**: Architecture testing for PHPStan that validates hexagonal layer dependencies (e.g., Application cannot have external dependencies).
-   📦 **Composer Normalizer**: Ensures `composer.json` is always valid and consistently formatted.
-   🧪 **PHPUnit**: Full suite of functional tests ensuring business logic and API integrity.

### 🧪 Run all analyzers

To run the entire suite of analyzers (linter, standards, and static analysis) at once:

```bash
docker compose -f devops/docker-compose.yaml exec playground composer analyze:all
```

Individual commands available:
- `composer analyze:phpstan` — Static analysis & Architecture tests.
- `composer analyze:standards` — Coding style check (Dry run).
- `composer fix:standards` — Automatic coding style fix.
- `composer analyze:lint` — Composer validation and normalization check.