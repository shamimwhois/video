# Observability and Operations Runbooks

## Correlation
Propagate request ID, workspace/project ID, asset/render/AI task ID, job attempt, and worker version across API, queue, worker, and storage events. Avoid logging user media, full transcripts, credentials, or signed URLs.

## Metrics
Track API latency/error rate, upload throughput/failures, probe duration, queue age/depth, worker saturation, render frames per second, render failure categories, AI latency/cost, storage usage, cleanup backlog, and authorization denials.

## Alerts
Alert on queue age, stuck jobs, repeated worker crashes, disk exhaustion, storage failures, elevated export failures, provider outage, unexpected cost spikes, and backup failure. Set thresholds from measured baselines.

## Runbooks
- Worker stuck/restarted: inspect attempt and lease; requeue only idempotent jobs.
- Render failure: preserve project revision; inspect sanitized diagnostics; retry only retryable classes.
- Storage outage: pause destructive cleanup; preserve metadata; restore service then reconcile.
- AI provider outage: disable route/fallback only within policy; keep manual editing available.
- Data exposure: revoke signed URLs/credentials, contain access, preserve audit evidence, notify incident owner.
- Backup restore: restore database and referenced object versions; validate project-to-asset integrity.

## Recovery objectives
Define and test RPO/RTO for metadata and media independently. A successful database restore without referenced object recovery is not a successful product restore.
