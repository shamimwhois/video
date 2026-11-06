# Developer Guide

## Verified baseline
Repository currently declares Laravel `^13.17`, PHP `^8.3`, Pest 5, Vite 8, Tailwind CSS 4. Note: AGENTS.md currently says PHP 8.5, which conflicts with composer.json. Treat composer.json and lockfile as the install contract until the project owner intentionally changes the runtime requirement.

## Local setup
1. Install the PHP version and extensions required by composer.lock.
2. Install Composer dependencies.
3. Copy `.env.example` to `.env`, generate app key, configure database/cache/queue/filesystem.
4. Run migrations against a disposable/local database.
5. Install npm dependencies and run the Vite dev server or production build.
6. Run the Pest suite before submitting changes.

Exact commands and versions must be checked against the current lockfiles and environment; this document does not claim a verified local setup.

## Code boundaries
Laravel controllers should remain thin. Use Form Requests, policies, services/actions, queued jobs, and explicit DTO/schema validation. Keep timeline math and command reducers in a pure TypeScript package. Do not place media processing in controllers or Eloquent model hooks.

## Change workflow
Read relevant specs and AGENTS.md; inspect sibling conventions; write tests first for domain behavior; implement the smallest vertical slice; run focused tests, full tests, and frontend build; update CURRENT_STATE and roadmap evidence.

## Pull requests
Include problem, design, scope, migration/rollback notes, security/privacy impact, test evidence, screenshots for UI changes, and known limitations. Never report unrun tests as passing.
