# AI Video Studio

A browser-based video editing platform planned around a professional multitrack timeline, non-destructive project editing, asynchronous media rendering, and AI-assisted editing workflows.

> **Development status:** The current repository is an early Laravel 13 application with authentication and video-post CRUD. The full editor, timeline engine, AI automation, media workers, and export pipeline are not implemented yet. See [Current Repository State](docs/CURRENT_STATE.md).

## Product direction

- Professional browser editor with media library, preview, inspector, and multitrack timeline.
- Video, audio, image, text, caption, and overlay clips.
- Non-destructive edits, versioned projects, undo/redo, and autosave.
- FFmpeg-based background processing and validated MP4 exports.
- AI-assisted transcription, silence removal, captions, scene analysis, and edit-plan proposals.
- Explicit approval and undo for AI-applied changes.
- Private media storage and workspace-level access control.

## Technology baseline

| Layer | Current / proposed |
|---|---|
| Backend | Laravel 13 |
| PHP | composer.json currently requires PHP `^8.3` |
| Frontend build | Vite 8, Tailwind CSS 4 |
| Editor application | React + TypeScript proposed; not installed/implemented |
| Database | Laravel-configured database; PostgreSQL recommended for target deployment |
| Queue/cache | Laravel queue/cache; Redis proposed for production workloads |
| Media engine | FFmpeg/FFprobe workers proposed; not integrated |
| AI | Provider adapters and constrained edit-plan workflow proposed |

The `AGENTS.md` file currently mentions PHP 8.5, which conflicts with composer.json. Treat Composer's declared requirement as the dependency contract until the mismatch is intentionally resolved.

## Current application behavior

- Public home page lists video posts.
- Guest registration and login.
- Authenticated users can create, update, and delete their video posts.
- Post media is currently stored on Laravel's public filesystem disk.

This post-sharing workflow is distinct from the planned private editor project/asset domain. Do not treat the existing posts table as the future project schema.

## Getting started

Prerequisites: PHP version/extensions compatible with composer.lock, Composer, Node.js/npm, and a configured database.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
```

Run automated tests:

```bash
php artisan test
```

Build frontend assets:

```bash
npm run build
```

These commands describe the standard Laravel workflow; successful setup has not been verified by this documentation update. Configure database, queue, cache, and filesystem in `.env` before running the application. Use a disposable/local database for migrations.

## Documentation

Start with [docs/README.md](docs/README.md).

Key documents:
- [PRD](docs/PRD.md)
- [TRD](docs/TRD.md)
- [TDD](docs/TDD.md)
- [Architecture](docs/ARCHITECTURE.md)
- [Current state audit](docs/CURRENT_STATE.md)
- [Roadmap](docs/ROADMAP.md)
- [Master implementation prompt](docs/IMPLEMENTATION_PROMPT.md)

## Engineering principles

- Preserve existing behavior; avoid destructive schema changes.
- Keep media processing outside HTTP request handlers.
- Keep original media immutable and store edits as versioned project data.
- AI output is untrusted until validated against a strict operation schema.
- Require user approval before applying AI timeline edits.
- Never claim features, tests, or deployment steps are complete without evidence.

## License

See the repository license file when one is added. No product license is declared by this README update.
