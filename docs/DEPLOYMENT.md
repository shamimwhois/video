# Deployment and Operations

## Environments

Local: Laravel, database, Redis, private local storage, workers.  
CI: static checks, unit/feature tests, frontend build, worker integration tests with controlled fixtures.  
Staging: production-like private object storage and isolated workers.  
Production: TLS, private storage, queue isolation, backup, monitoring, retention, incident runbooks.

## Deployment units

Laravel web/API; PostgreSQL; Redis; media worker with pinned FFmpeg/FFprobe; AI worker; object storage; optional broadcasting.

## Configuration

Secrets remain outside Git. `.env.example` contains placeholders only. Separate web/worker credentials. Align upload limits across proxy, PHP, application, and storage.

## Queues

Monitor age/depth. Isolate heavy renders from short jobs. Retry based on error class. Alert on stuck jobs, repeated failures, storage quota, worker disk pressure.

## Backup/recovery

Back up relational metadata and immutable project revisions. Define object-store durability/versioning separately. Test restoration of project metadata and referenced source assets. Database restore alone is not project recovery.

## Rollback

Use backward-compatible schema rollout. Version project documents and worker interfaces. Keep compatible worker versions while queued jobs reference older render graph schemas.
