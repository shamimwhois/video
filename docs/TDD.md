# Technical Design Document

## 1. Objectives

- One canonical, serializable sequence model.
- Deterministic, non-destructive editing.
- Independent UI, persistence, preview, AI planning, and rendering.
- Safe AI operations through a typed command vocabulary.
- Observable and recoverable media jobs.

## 2. Components

**Web editor:** workspace shell, asset bin, timeline viewport/ruler/tracks/clips/playhead, preview, inspector, contextual editing tools, AI Studio.

**Timeline domain package:** project/sequence schemas, timebase, constraints, commands, history, keyframes, transitions, serialization/migrations.

**Laravel application:** workspace/project authorization, asset metadata, sequence revisions, job dispatch/status, AI plan approval/audit, export delivery.

**Workers:** media probing, thumbnails, proxies, waveform, transcription/analysis, render graph compilation, render, output validation.

## 3. Time model

Do not use floating-point seconds as authoritative edit coordinates. Use integer ticks in a project timebase or rational frame positions. Sequences declare frame rate as numerator/denominator. Store clip source in/out and timeline start/duration explicitly. Audio may need sample-level precision. Convert to seconds only at media API boundaries.

## 4. Preview

Resolve active clips at playhead; compose video/image/text/shape layers by track order; apply supported transforms/effects; mix active audio. Mark unsupported effects clearly. Preview is best-effort, while export is authoritative. Maintain a preview/export parity matrix.

## 5. Commands

Typed commands include AddClip, MoveClip, TrimClip, SplitClip, DeleteClip, SetClipTransform, SetClipVolume, AddKeyframe, AddTransition, AddEffect, AddCaptionTrack, ApplyEditPlan.

Each command includes ID, project/sequence revision, actor, targets, parameters, and preconditions. Validate and apply atomically. Undo restores prior state or issues compensating commands without modifying source files.

## 6. Save/concurrency

Project snapshots include schema version and monotonic revision. Save uses optimistic concurrency/ETag. Conflicts return current revision and require resolution. Autosave batches committed changes; transient drag state is not persisted. Recovery log supports restoration since last snapshot.

## 7. Render graph

Compile normalized sequence into renderer-neutral graph: inputs, time mappings, layer order, compositing, transform/effect nodes, audio mix, overlays, output profile. Translate through a typed FFmpeg adapter. Never concatenate untrusted strings into shell commands or filtergraphs.

## 8. Failure handling

Classify unsupported/corrupt media, missing asset, permission, quota, timeout, worker loss, encoder/storage failure, cancellation, and internal error. Preserve project on render failure. Redact secrets from diagnostic logs.
