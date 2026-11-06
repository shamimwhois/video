# Release, Versioning, and Migration Strategy

## Versioned contracts
Version project schema, AI plan schema, API, worker job manifest, render graph, and derivative processor outputs independently. Add explicit compatibility windows and migration tooling.

## Database migrations
Prefer additive expand/contract migrations. Backfill in bounded batches. Add indexes safely for table size/engine. Avoid destructive column/table changes until all application and worker versions stop reading them. Test rollback where feasible; document irreversible operations.

## Project migrations
Every project document has schemaVersion. Migration functions are deterministic, tested with historical fixtures, and preserve unknown safe metadata where possible. Keep original snapshot or backup before bulk conversion.

## Worker compatibility
Queue payloads identify schema and renderer versions. Deploy workers that can read both old/new supported versions before changing producers. Do not strand queued jobs during rollout.

## Release gates
Tests, frontend build, dependency/security review, migration rehearsal, backup verification, worker compatibility, smoke test, observability dashboards, rollback owner, and release notes.

## Rollback
Rollback application code only when schema and queued jobs remain compatible. Do not automatically roll back completed project edits or delete media. Use forward fixes for irreversible data transformations.
