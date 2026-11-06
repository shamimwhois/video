# UX Flows, State Machines, and Error Catalog

## Primary flows
Project creation; asset upload/retry/relink; sequence creation; manual edit; autosave/conflict recovery; AI request/plan review/approval/undo; render/export/download; workspace invitation; quota exhaustion.

## Canonical states
Asset: created, uploading, uploaded, probing, processing, ready, rejected, failed, quarantined, deleting, deleted.  
AI task: queued, gathering_context, generating, validating, awaiting_approval, applying, completed, rejected, failed, cancelled.  
Render: queued, preparing, rendering, validating, completed, cancel_requested, cancelled, failed, expired.

State transitions must be validated server-side, idempotent, timestamped, and observable. Terminal states cannot silently return to active; retries create a new attempt or explicit retry transition.

## Error catalog
Use stable machine codes such as unsupported_media, corrupt_media, upload_too_large, quota_exceeded, revision_conflict, asset_unavailable, ai_provider_unavailable, invalid_edit_plan, render_failed, render_cancelled, permission_denied. Pair each with safe user guidance and a request/task ID.

## UX requirements
Show actual progress stage, retryability, and next action. Distinguish validation errors from transient errors. Preserve user edits on failed AI/render operations. Never show 100% until the output is validated and persisted.
