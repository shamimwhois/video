# Proposed Data Model

This is a logical target schema, not a migration already present in the repository.

## Tables

- workspaces: owner, name, plan/status.
- workspace_members: workspace, user, role.
- projects: workspace, owner, name, status, current revision.
- project_revisions: project, revision number, schema version, JSON snapshot, checksum, author.
- sequences: project, stable sequence ID, name, settings snapshot.
- media_assets: workspace/project, storage key, original filename, detected MIME, size, checksum, lifecycle, probe metadata.
- media_derivatives: asset, kind, processor version, storage key, metadata.
- render_jobs: project, pinned sequence revision, profile, state, progress, idempotency key, failure category.
- render_outputs: render job, storage key, size, duration, checksum, QA report.
- ai_tasks: project/revision, request, provider/model, state, cost metadata, result reference.
- ai_edit_plans: task, schema version, plan JSON, validation status, expiry.
- ai_approvals: plan, user, decision, selected operation IDs, timestamp.
- edit_operations: project/revision, actor, operation type, payload, transaction ID.
- activity_events: actor, workspace/project, event type, safe metadata.

## Constraints and indexes

Unique project/revision number; unique scoped idempotency keys; indexes for asset lifecycle/project, render state/created time, and common authorization queries. Foreign keys use deliberate deletion rules. UTC timestamps; UUID/ULID public IDs; never expose storage keys.

## Deletion

Database deletion is not sufficient. Cleanup jobs must remove originals, derivatives, transcripts, and exports according to retention rules. Jobs must be retryable and auditable.
