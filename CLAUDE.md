# Claude Code Instructions

## Test Rules

When working with unit or functional tests, follow these rules strictly:

- **Only modify test files.** Never touch production code (`src/`) to make tests pass, unless there is a bug.
- **All dependencies from tested class must be class properties in the test, and configured in `setUp()` method**
- **Do not add any PHPUnit ignore annotations or attributes** (e.g. `@doesNotPerformAssertions`, `@group skip`, suppression comments).
- **Every mock must have explicit `expects()` calls.** Use `expects($this->once())`, `expects($this->never())`, `expects($this->exactly(N))`, etc. for all mock method calls. Do not use `method()` alone without `expects()`.
- **If a test cannot be fixed while respecting all the above rules, stop and report the blocker instead of bending the rules.**