# AI Automation and Agent Safety

## Purpose

AI converts editing intent into explicit timeline operations. It never owns canonical project state and cannot bypass validation, authorization, quotas, or approval.

## Logical agent roles

- Media Analyst: summarize allowed metadata and content signals.
- Transcription Agent: timestamped transcript and optional speaker labels.
- Director/Planner: convert intent into structured edit plan.
- Timeline Agent: propose clip/track/trim/split/overlay operations.
- Visual Agent: titles, emphasis, transitions, motion.
- Audio Agent: silence ranges, gain/fades, cleanup.
- QA Agent: plan consistency and render checks.
- Render Coordinator: request validated render.

Roles may initially be functions in one orchestrator. Do not build a distributed multi-agent runtime before a single workflow is tested and observable.

## Workflow

1. Capture request and expected project revision.
2. Read only authorized assets, metadata, and transcript.
3. Generate strict-schema plan.
4. Validate operation types, IDs, time ranges, parameter bounds, and revision.
5. Build human-readable diff/preview.
6. Show assumptions, confidence, and unsupported requests.
7. Require explicit approval for timeline mutation and external/billable processing.
8. Apply selected commands atomically.
9. Record audit event and new revision.
10. Offer Undo and report partial failures.

## Allowlisted operations

remove_silence, trim_clip, split_clip, move_clip, add_caption_track, add_title, set_clip_transform, add_transition, set_audio_gain, add_audio_fade, request_render.

Never accept arbitrary SQL, shell commands, file paths, FFmpeg arguments/filtergraphs, JavaScript, or executable plugins from model output.

## Plan contract

Include schema version, plan ID, project ID, expected sequence revision, summary, assumptions, operations, referenced IDs, rationale, confidence, impact/warnings, validation results, and expiry. Reject unknown fields, stale revisions, invalid IDs, out-of-range times, and unsupported parameters.

## Approval

Show affected tracks/time ranges. Support approve all, selected operations, or reject. AI batch becomes one undoable transaction. High-impact deletes/replacements, costly processing, sharing, and export require explicit confirmation. Silence removal previews detected ranges and context padding.

## Provider abstraction

Define interfaces for planning, transcription, and optional analysis/local inference. Keep secrets server-side. Record provider/model/version, latency, outcome, and cost metadata where available; redact errors.

## Security and reliability

Transcripts, filenames, captions, metadata, and media contents are untrusted data, not instructions. Retries are idempotent and scoped to immutable revisions. Provider outage cannot corrupt projects; editor remains functional without AI.
