# Product Roadmap — AI Video Studio

**Version:** 1.1 | **Status:** Proposed sequencing | **Source of truth:** PRD.md

> Roadmap phases are delivery gates, not completion claims. A phase is complete only when its acceptance evidence is linked from CURRENT_STATE.md and the relevant tests and operational checks pass.

## Delivery principles
- Preserve existing authentication and video-post CRUD behavior while introducing a separate editor domain.
- Build the canonical project/timeline model before implementing timeline UI.
- Ship a real, validated render path before adding advanced AI workflows.
- Keep media private by default and isolate untrusted media processing.
- Do not mark a requirement implemented merely because it appears in the PRD.

## Phase 0 — product and architecture decisions
**Outcome:** implementation decisions are explicit and repository constraints are consistent.
- Resolve PHP runtime policy mismatch between composer.json and AGENTS.md.
- Confirm frontend framework and TypeScript build architecture.
- Select FFmpeg/FFprobe versions and define worker isolation and resource ceilings.
- Define supported source codecs, containers, output profiles, and browser compatibility.
- Approve project/sequence/track/clip/asset/revision/job data model.
- Define storage lifecycle, private access, retention, deletion, and backup policy.
- Define initial deployment topology and queue operations.
**Exit criteria:** decision records approved; runtime/toolchain CI green; architecture and security threat model reviewed.

## Phase 1 — platform foundation (P0)
**Outcome:** authenticated users can create and persist isolated editor projects.
- Workspace and project CRUD, ownership, roles, policies, and audit events.
- Project schema versioning and transactional persistence.
- Asset records, private storage abstraction, upload sessions, resumable upload, validation.
- FFprobe metadata extraction and thumbnail/proxy job contracts.
- Queue configuration, retries, idempotency, dead-letter visibility, and job status.
- Baseline observability, structured logs, metrics, and health checks.
**Exit criteria:** authorization, upload, schema migration, retry, project reload, and recovery tests pass.

## Phase 2 — manual editor and timeline (P0)
**Outcome:** users can make deterministic non-destructive edits.
- TypeScript timeline engine with rational frame-rate/timebase handling.
- Sequence, track, clip, source-range, and asset-reference models.
- Insert, move, trim, split, duplicate, delete, ripple, reorder, and snapping commands.
- Transactional undo/redo and command history.
- Preview transport, playhead, frame stepping, selection, and inspector.
- Autosave, dirty-state indicators, conflict detection, and reload recovery.
- Keyboard shortcuts, accessibility, and empty/loading/error/offline states.
**Exit criteria:** timeline invariants and inverse-command tests pass; representative projects remain responsive; edit state survives reload.

## Phase 3 — render and export (P0)
**Outcome:** users can download a real rendered video from the editor.
- Render graph compiler from canonical project state.
- FFmpeg execution in isolated, resource-bounded workers.
- Export profiles for baseline MP4/H.264 and documented audio settings.
- Progress reporting based on measurable worker state.
- Cancellation, retry, timeout, failure diagnostics, and output cleanup.
- Post-render probing and validation against requested output settings.
- Download authorization and output retention policy.
**Exit criteria:** end-to-end tests render real fixture media; output is probed; failed jobs recover safely; no fake progress is displayed.

## Phase 4 — professional creator tools (P1)
**Outcome:** common tutorial and creator workflows become practical.
- Titles, text, shapes, arrows, callouts, and annotation layers.
- Transitions with explicit overlap and duration constraints.
- Keyframes, interpolation, easing, transform animation, and opacity.
- Audio waveforms, clip gain, fades, envelopes, and track mixing.
- Speech transcription and editable timestamped captions.
- Silence detection with review-before-apply.
- Cursor effects only when reliable pointer metadata exists or inference is explicitly reviewed.
- Multiple aspect-ratio and resolution presets.
**Exit criteria:** every supported effect has preview/export parity tests and clear unsupported states.

## Phase 5 — AI-assisted editing and generation (P2)
**Outcome:** AI can propose safe, inspectable, reversible edit plans.
- Provider abstraction, credential isolation, timeouts, budgets, and failover.
- Prompt-to-plan pipeline with typed operations and schema validation.
- Confidence, affected-range previews, diff view, partial approval, and rejection.
- Apply approved edits as one undoable transaction.
- Transcription, scene analysis, speaker labels, reframing, and audio cleanup.
- Optional generated visuals, voice, and music behind consent and licensing controls.
- Evaluation datasets, regression gates, prompt-injection defenses, and audit logs.
**Exit criteria:** AI cannot directly mutate canonical state without approval; evaluations and cost/latency budgets pass.

## Phase 6 — collaboration, publishing, and platform scale (P2)
**Outcome:** teams can review and distribute controlled deliverables.
- Invitations, roles, comments, review links, approvals, and revision history.
- Brand kits, shared templates, reusable assets, and licensing metadata.
- Publishing integrations and webhooks with scoped credentials.
- Plans, quotas, metering, invoices, and transparent usage limits.
- Admin operations, abuse controls, support diagnostics, and incident runbooks.
- Performance and capacity testing for concurrent ingest and render workloads.
**Exit criteria:** tenant isolation, billing correctness, link permissions, webhook signatures, incident drills, and load tests pass.

## Phase-to-requirement traceability
The PRD feature IDs VS-0001 through VS-1075 are the canonical feature identifiers. Implementation issues and pull requests should reference those IDs. Update CURRENT_STATE.md with completed IDs, commit/PR evidence, test names, CI evidence, manual verification, limitations, and deferred requirements.

## Explicit non-goals until separately approved
- Native desktop application.
- Simultaneous real-time collaborative timeline editing.
- Unlimited storage, upload size, render duration, AI usage, or concurrency.
- Guaranteed reconstruction of cursor movement without source metadata.
- Full parity with proprietary high-end desktop compositors and grading systems.
