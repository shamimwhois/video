# Current Repository State

**Audit baseline:** `main`, inspected 2026-11-06.  
**Repository:** `shamimwhois/video`

## Verified facts

| Area | Observed state |
|---|---|
| Backend | Laravel `^13.17` |
| PHP | `^8.3` in composer.json |
| Frontend build | Vite 8, Laravel Vite plugin, Tailwind CSS 4 |
| JavaScript | `resources/js/app.js` is empty |
| Home page | Lists video posts |
| Authentication | Login, registration, logout routes/controllers and Blade views exist |
| Domain | User and Post models |
| Database | Users, cache, jobs, posts migrations |
| Media editor | Not found in inspected source tree |
| Timeline engine | Not found |
| FFmpeg integration | Not found in inspected manifests/source tree |
| AI orchestration | Not found in application source |
| Export workflow | Not found |
| Tests | Example and post-management feature tests exist |

## Existing behavior

- `GET /` renders a public video-post listing.
- Guest users can register and log in.
- Authenticated users manage posts through resource routes.
- Posts can reference video files on Laravel's public storage disk.

## Gaps to address

1. Current homepage and route domain describe a video community, not an editor.
2. There is no editor-side application or timeline state model.
3. No project, sequence, track, clip, keyframe, effect, asset, or render-job model exists.
4. No media probe, thumbnail, proxy, waveform, transcription, or export orchestration was verified.
5. No AI provider abstraction, safe edit-plan schema, approval workflow, or audit trail exists.
6. Existing database schema is not designed for editor workloads.
7. The layout includes Tailwind CDN and Alpine CDN while Vite/Tailwind dependencies are present; consolidate asset ownership during editor-shell work.

## Implementation guardrails

- Preserve working authentication and post routes unless a reviewed migration plan replaces them.
- Do not reinterpret the posts table as projects or assets.
- Store media in private object storage by default; never store media bytes in relational rows.
- Model tracks flexibly but define tested resource budgets; do not promise literal unlimited resources.
- Never run FFmpeg/transcoding in an HTTP request worker.
- Never execute model-generated shell commands, SQL, paths, scripts, or raw FFmpeg filters.
- Use isolated media workers and typed, validated editing operations.

## Evidence rule

Mark a capability **Implemented** only after its code path exists, relevant tests pass, and its user-visible workflow is verified. Record commit/PR references and test results here. Mockups and unrelated passing tests are not evidence.
