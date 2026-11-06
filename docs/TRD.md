# Technical Requirements Document

**Status:** Proposed. Validate against code as implementation proceeds.

## 1. System topology

Browser editor owns high-frequency interactions and preview. Laravel owns identity, authorization, projects, asset metadata, API, job orchestration, and audit records. Isolated workers perform media processing, transcription, analysis, and rendering.

```
Browser: React + TypeScript editor, timeline package, preview adapter, upload client
                         │ HTTPS / signed upload
                         ▼
Laravel 13 API: auth, policies, project/asset APIs, revisions, AI approval, queues
                         │ Redis jobs/events
             ┌───────────┴──────────┐
             ▼                      ▼
      Media workers             AI workers
      FFmpeg/FFprobe             Providers/transcription
             └───────────┬──────────┘
                         ▼
       PostgreSQL + private S3-compatible object storage
```

## 2. Runtime boundaries

- Browser: editor UI, timeline model, local playback where supported, uploads, plan review.
- Laravel: auth, authorization, persistence, validation, signed URLs, quotas, job lifecycle.
- Media worker: pinned FFmpeg/FFprobe, controlled graph building, resource limits, artifact upload.
- AI worker: provider adapters, transcription, scene analysis, constrained plan generation, validation.
- PostgreSQL: durable metadata, versioned project snapshots.
- Redis: queues, short-lived coordination, locks, progress events.
- Object storage: originals, proxies, thumbnails, waveforms, exports.

## 3. Technology direction

Preserve current repository baseline: Laravel 13.17+, PHP 8.3+, Vite 8, Tailwind CSS 4 unless a tested change is approved.

Recommended editor frontend: dedicated React + TypeScript app. Use normalized domain state and a framework-independent timeline package. Use Canvas/WebGL for timeline/preview only where profiling supports it. Feature-detect WebCodecs, MediaSource, WebAudio, OffscreenCanvas, Web Workers, IndexedDB, and File System Access API.

Use FFmpeg/FFprobe in isolated workers. Python may host AI/media libraries where justified. Keep Laravel as control plane; avoid a second backend framework without clear need.

## 4. Media/data rules

- Private object storage; metadata only in relational rows.
- Assets belong to authorized workspace/project scope.
- Originals are immutable; edits are project data.
- Resumable/multipart uploads with checksum verification.
- Explicit allowlist based on actual deployed codec support.
- Browser preview fallback when codec support is absent.

## 5. Asynchronous jobs

ProbeAsset, GenerateThumbnail, GenerateProxy, GenerateWaveform, TranscribeAsset, AnalyzeScenes, BuildAiEditPlan, RenderSequence, ValidateRender.

Every job needs idempotency, retries/backoff, terminal failure states, structured logs, progress, and defined cancellation semantics. Restarted workers must not mark incomplete jobs successful.

## 6. API and events

JSON REST under `/api/v1`, stable UUID/ULID public IDs, consistent errors, authorization for every resource, and private event channels. Events contain safe status/progress metadata only. See API.md.

## 7. Performance and operations

Separate media, AI, and notification queues. Bound worker concurrency by CPU, memory, GPU, and disk. Track queue age, processing time, retries, render throughput, storage, and failure category. See PERFORMANCE.md and DEPLOYMENT.md.
