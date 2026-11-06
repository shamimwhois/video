# VideoStudio AI — Screen Recorder Feature Specification

> Status: Product and engineering specification  
> Feature: Screen Recorder  
> Supported output formats: MP4, WebM, AVI  
> Scope: Browser-based screen recording, media capture, recording management, and export. This document specifies intended behavior; it does not claim the feature is implemented.

## 1. Purpose

Provide an integrated screen recorder that captures a screen, browser tab, application window, camera, microphone, and supported system audio, then saves the recording as MP4, WebM, or AVI.

The recorder works as a standalone capture tool and as an entry point into the VideoStudio AI editing timeline. Completed recordings are available in the user's asset library and can be added to a new or existing project.

## 2. Goals

- Capture screen, browser tab, or application/window using browser-supported capture APIs.
- Capture optional camera, microphone, and system audio.
- Provide pause, resume, stop, and discard controls.
- Support long recordings through chunked persistence and resumable upload.
- Offer MP4, WebM, and AVI as final output formats.
- Convert formats in background jobs when the browser cannot record the requested format natively.
- Preserve the original capture until conversion succeeds or the user deletes it.
- Make completed recordings editable in the main video editor.

## 3. Non-goals

- Bypassing operating-system or browser capture permission prompts.
- Capturing protected/DRM content or content blocked by browser security.
- Recording without a visible, user-initiated capture session.
- Promising identical codec availability across all browsers and devices.
- Treating AVI as a native browser recording format.

## 4. User workflows

### 4.1 Start a recording

1. User opens Recorder from the editor tool rail or application navigation.
2. User chooses Entire screen, Application/window, or Browser tab.
3. User optionally enables camera overlay, microphone, and system/tab audio where supported.
4. User chooses available capture preferences such as frame rate and camera layout.
5. User selects Start recording.
6. Application requests browser permissions and displays the browser's native source picker.
7. Recorder enters the recording state only after the capture stream is successfully acquired.

### 4.2 Pause and resume

- Pause suspends capture when supported by the active recording implementation.
- Resume continues the same recording session.
- Elapsed time and recording state remain visible.
- Default output excludes paused wall-clock time unless a product setting explicitly chooses otherwise.

### 4.3 Stop and save

1. User selects Stop.
2. Recorder stops capture tracks and finalizes the recording.
3. Original capture is persisted before optional conversion begins.
4. User chooses MP4, WebM, or AVI output.
5. A conversion job is queued when needed.
6. UI reports conversion progress and exposes the completed asset when processing finishes.

### 4.4 Discard

- Discard requires confirmation if captured data exists.
- Discard removes temporary chunks and any uncommitted recording artifact.
- The application must not delete an already saved original or exported asset without a separate explicit delete action.

### 4.5 Edit a recording

- A completed recording can be previewed.
- User can add it to the current timeline, create a new project, or open it in the asset library.
- The editor references the persisted asset; it must not depend on the recorder page remaining open.

## 5. Supported output formats

The user-facing format selector must offer all three formats, subject to configured export limits.

| Format | Extension | Typical codec profile | Capture strategy |
|---|---|---|---|
| MP4 | .mp4 | H.264 video + AAC audio | Native recording only if browser reports a supported MP4 MIME type; otherwise FFmpeg transcode |
| WebM | .webm | VP9 or VP8 video + Opus audio | Prefer MediaRecorder with a runtime-supported WebM MIME type; otherwise FFmpeg transcode |
| AVI | .avi | Configured AVI-compatible video/audio codecs | FFmpeg transcode; not a standard native browser MediaRecorder target |

### 5.1 Format behavior

- Browser capture format and final export format are separate concepts.
- Detect supported MIME types at runtime with MediaRecorder.isTypeSupported() or equivalent capability checks.
- Use a supported temporary capture format, then remux or transcode to the requested output.
- Remux only when source codecs are compatible with the target container.
- Transcode when codec/container compatibility requires it.
- Never rename a WebM file to .mp4 or .avi; verify the actual container and streams.
- Inspect final output with FFprobe or an equivalent media probe before marking the job complete.
- AVI is a container, not a codec; select compatible streams and disclose file-size/playback trade-offs.

### 5.2 Recommended export profiles

| Profile | Container | Video | Audio | Intended use |
|---|---|---|---|---|
| Web optimized | WebM | VP9 or VP8 | Opus | Web sharing and smaller files |
| Compatible | MP4 | H.264 | AAC | Broad playback and sharing compatibility |
| Legacy | AVI | Configured AVI-compatible codec | Configured compatible audio codec | Legacy workflows |

Exact codec availability, licensing, and build configuration must be validated in the deployment environment.

## 6. Recorder interface

### 6.1 Recorder panel

- Capture source selector.
- Camera toggle and camera preview.
- Microphone selector and input-level meter.
- System/tab audio toggle when supported.
- Resolution and frame-rate selector.
- Camera overlay position and size controls.
- Countdown option.
- Start, Pause, Resume, and Stop controls.
- Elapsed time and recording status.
- Output format selector.
- Quality and file-size estimate where calculable.

### 6.2 Recording indicator

While recording:

- Show a persistent, high-contrast recording indicator and elapsed time.
- Keep pause and stop actions immediately accessible.
- Warn when the capture source ends or the shared tab changes, where detectable.
- Never hide the fact that capture is active.

### 6.3 Post-recording screen

Show recording thumbnail, filename, duration, resolution, frame rate, original capture format, selected output format, conversion status, final file size, and applicable preview/download/add-to-project/retry/delete actions.

## 7. Technical architecture

### 7.1 Browser capture

Use browser APIs where available:

- navigator.mediaDevices.getDisplayMedia() for screen, window, or tab capture.
- navigator.mediaDevices.getUserMedia() for camera and microphone capture.
- MediaRecorder for chunked media recording.
- MediaStream track events to detect source termination.
- MediaRecorder.isTypeSupported() to detect supported recording MIME types.

Capture support varies by browser, operating system, and permission policy. Feature-detect every source and option and explain unavailable controls.

### 7.2 Camera composition

If camera overlay is enabled, compose camera and screen streams using a canvas/WebCodecs-based pipeline or a supported media-processing service. Keep camera placement, scale, border, and shape as editable metadata when practical.

Do not assume MediaRecorder automatically combines separate screen and camera streams into a picture-in-picture composition. The implementation must explicitly mix/composite the streams.

### 7.3 Audio mixing

- Capture microphone and system/tab audio as separate inputs where supported.
- Provide mute and gain controls.
- Mix streams through an explicit audio graph or media-processing pipeline.
- Avoid duplicate audio tracks and echo loops.
- Preserve audio/video synchronization.
- Clearly label when system audio is unavailable.

### 7.4 Chunked persistence

- Record in manageable chunks using the dataavailable event.
- Upload or persist chunks incrementally for long sessions.
- Associate chunks with a recording session and monotonically increasing sequence number.
- Make chunk uploads idempotent.
- Support retry for failed chunks and resume after transient network loss.
- Verify chunk count, byte size, and integrity before finalization.
- Avoid keeping an unbounded recording entirely in browser memory.
- Apply storage quotas and retention policies.

### 7.5 Processing pipeline

~~~text
User starts capture
  -> Permission and source selection
  -> Capture stream acquisition
  -> MediaRecorder / capture pipeline
  -> Chunked persistence
  -> Recording finalization
  -> Original capture stored
  -> User selects MP4 / WebM / AVI
  -> Queue conversion job if required
  -> FFmpeg remux/transcode
  -> FFprobe validation
  -> Persist final output and metadata
  -> Preview / download / add to editor timeline
~~~

## 8. Backend services and data model

Suggested service boundaries:

- RecorderSessionService: create, start, pause, resume, stop, and discard sessions.
- RecordingChunkService: accept, validate, order, retry, and finalize chunks.
- RecordingAssetService: persist original and exported media assets.
- RecordingConversionService: schedule and track remux/transcode jobs.
- MediaProbeService: inspect container, streams, codecs, duration, dimensions, and frame rate.
- RecordingAuthorizationService: enforce ownership and access policies.

Suggested entities:

### RecordingSession

- id
- user_id
- project_id (nullable)
- status
- capture_source
- capture_mime_type
- started_at
- paused_at (nullable)
- stopped_at (nullable)
- duration_ms
- metadata (JSON)
- timestamps

### RecordingChunk

- id
- recording_session_id
- sequence
- storage_key
- size_bytes
- checksum
- status
- timestamps

Unique constraint: recording_session_id + sequence.

### RecordingExport

- id
- recording_session_id
- asset_id (nullable)
- container
- video_codec (nullable)
- audio_codec (nullable)
- status
- progress (nullable)
- output_size_bytes (nullable)
- error_code (nullable)
- error_message (nullable)
- timestamps

Store large binary media in configured object/file storage, not relational database blobs. Persist storage keys and verified media metadata in the database.

## 9. API contract (illustrative)

These endpoints are a suggested contract, not a statement that routes currently exist.

| Method | Endpoint | Purpose |
|---|---|---|
| POST | /api/recorder/sessions | Create a recording session |
| POST | /api/recorder/sessions/{id}/chunks | Upload a recording chunk |
| POST | /api/recorder/sessions/{id}/finalize | Finalize original capture |
| POST | /api/recorder/sessions/{id}/exports | Request MP4, WebM, or AVI export |
| GET | /api/recorder/sessions/{id} | Get session status and metadata |
| GET | /api/recorder/exports/{id} | Get conversion status |
| POST | /api/recorder/exports/{id}/retry | Retry a failed conversion |
| DELETE | /api/recorder/sessions/{id} | Delete an eligible session and its artifacts |

### Validation

- Accept only configured output format identifiers: mp4, webm, avi.
- Validate session ownership and project access.
- Validate chunk size, sequence, checksum, and upload authorization.
- Enforce recording duration, output size, quota, and concurrency limits.
- Never accept a client-provided filesystem path or arbitrary FFmpeg command.

## 10. Conversion worker requirements

Use a background queue. The worker must:

1. Load the recording through a trusted storage key.
2. Verify ownership/authorization through the job's session context.
3. Probe the source media.
4. Select a server-controlled conversion profile.
5. Execute FFmpeg with argument-safe process invocation; never interpolate untrusted shell strings.
6. Enforce CPU, memory, disk, duration, and wall-clock limits.
7. Write to a temporary output key.
8. Probe the result and verify expected container, streams, duration, and non-zero size.
9. Atomically publish the final asset only after validation.
10. Clean up temporary files on success, failure, or cancellation.
11. Preserve the original capture on conversion failure.
12. Record structured logs and an actionable error code.

## 11. Security and privacy

- Capture starts only after an explicit user action and browser permission.
- Display a persistent recording indicator.
- Stop all media tracks when capture ends, is cancelled, or the component is disposed.
- Use HTTPS in production; browser capture APIs require secure contexts except local development exceptions.
- Validate uploads by content and media probe, not extension alone.
- Treat uploaded media as untrusted input.
- Keep FFmpeg updated and sandbox media-processing workers.
- Restrict FFmpeg protocols and disable arbitrary network access for untrusted input.
- Use generated storage keys; never trust user filenames as paths.
- Enforce per-user/project authorization on session, chunk, export, preview, and download endpoints.
- Use short-lived signed URLs for private media delivery.
- Apply rate limits, quotas, retention rules, and explicit deletion workflows.
- Do not record or upload media before the user starts capture.

## 12. Error handling and recovery

| Failure | Expected behavior |
|---|---|
| Permission denied | Explain missing permission; allow retry |
| Source picker cancelled | Return to ready state without creating a recording |
| Capture source ends | Stop/finalize safely and notify the user |
| Microphone unavailable | Continue without microphone only if user agrees |
| System audio unavailable | Continue without it and indicate the limitation |
| Network interruption | Retry chunk upload and resume from acknowledged sequence |
| Browser closes unexpectedly | Recover persisted chunks; explain any unrecoverable tail |
| Storage quota exceeded | Stop safely where possible; preserve uploaded chunks and show guidance |
| Unsupported output codec | Offer a supported profile or another format |
| FFmpeg failure | Preserve original capture; show retry and alternate formats |
| Corrupt/incomplete output | Do not publish as completed; retain diagnostic job state |
| User cancels conversion | Keep original capture; mark export cancelled |

## 13. Performance requirements

- Use chunked upload and bounded memory for long recordings.
- Do not block the UI thread with encoding or large media processing.
- Use background workers for conversion.
- Make conversion concurrency configurable.
- Support resumable uploads and idempotent chunk processing.
- Provide a low-bandwidth mode where capture resolution/frame rate can be reduced.
- Avoid generating full-resolution thumbnails synchronously in the request path.
- Show progress only when the worker can report meaningful progress; otherwise show an honest indeterminate state.

## 14. Accessibility

- All recorder actions must be keyboard accessible.
- Buttons must have accessible names and visible focus.
- Recording state must not be conveyed by color alone.
- Announce start, pause, resume, stop, upload, and conversion state changes to assistive technology.
- Provide text alternatives for input-level meters and status indicators.
- Do not rely on audio-only warnings.

## 15. Acceptance criteria

### Capture

- [ ] User can choose supported screen, window, or tab sources.
- [ ] Camera and microphone are optional and permission-gated.
- [ ] System/tab audio is offered only when supported.
- [ ] Recording starts only after explicit user action and successful permission acquisition.
- [ ] Recording indicator and elapsed time remain visible while capturing.
- [ ] Pause, resume, stop, and discard have correct state transitions.
- [ ] Capture tracks are stopped after recording ends.

### Formats

- [ ] MP4 is available as an export option.
- [ ] WebM is available as an export option.
- [ ] AVI is available as an export option.
- [ ] Native MIME support is detected at runtime.
- [ ] Unsupported target formats are produced through the background conversion pipeline.
- [ ] Final container and codec metadata are verified before success is shown.
- [ ] File extension always matches the actual output container.

### Reliability

- [ ] Long recordings use bounded-memory chunked persistence.
- [ ] Chunk uploads are ordered, verified, idempotent, and retryable.
- [ ] Conversion failure does not destroy the original capture.
- [ ] Interrupted uploads and failed jobs expose recoverable states.
- [ ] Temporary files are cleaned up safely.
- [ ] Authorization, quotas, and storage limits are enforced.

### Editor integration

- [ ] Completed recording appears in the asset library.
- [ ] User can preview and download the completed asset.
- [ ] User can add the recording to an existing project timeline.
- [ ] Asset metadata includes duration, dimensions, frame rate, container, and codecs when available.

## 16. Testing strategy

- Unit tests for session state transitions, format validation, chunk sequencing, and export profile selection.
- Browser tests for permission denial, source cancellation, capture start/stop, and track termination.
- Integration tests for chunk retry, duplicate chunk requests, finalization, and conversion queue dispatch.
- FFmpeg integration tests for MP4, WebM, and AVI output profiles.
- Probe tests to verify actual container/codec metadata rather than filenames.
- Failure tests for malformed media, worker timeout, disk exhaustion, cancellation, and retry.
- Authorization tests proving users cannot access another user's recording or export.
- Long-recording tests for bounded memory and resumable chunk persistence.

## 17. Delivery phases

1. Phase A — Capture foundation: source selection, permission handling, screen/tab/window capture, microphone, recording controls, WebM output.
2. Phase B — Persistence: chunked upload, session recovery, original capture storage, asset-library integration.
3. Phase C — Format exports: MP4 and AVI FFmpeg profiles, WebM export profile, metadata probing, retryable jobs.
4. Phase D — Advanced capture: camera overlay, audio mixing, resolution/frame-rate controls, countdown, and quality presets.
5. Phase E — Hardening: security sandbox, quotas, observability, accessibility, cross-browser testing, and long-session reliability.

## 18. Implementation notes

- Keep this feature separate from the existing post-upload workflow and from the editor's timeline domain model.
- Reuse the application's asset storage abstraction where appropriate, but model recording sessions and conversion jobs explicitly.
- Treat browser capture as a capability-based feature, not a guaranteed identical API across browsers.
- MP4, WebM, and AVI are required user-facing export choices; native capture support is an optimization, not a product requirement.
- All UI controls must reflect real browser and backend state. Do not ship decorative controls that claim to record, convert, or save when no implementation exists.

**Review status:** Specification ready for architecture review and implementation planning.
