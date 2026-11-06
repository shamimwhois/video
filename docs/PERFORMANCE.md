# Performance and Reliability

## Principles

- Keep pointer movement/playhead updates out of PHP request cycles.
- Avoid full timeline DOM rerender per drag frame.
- Virtualize tracks/clips outside viewport.
- Use proxies for large media; use thumbnails and waveform peak pyramids.
- Debounce persistence but expose pending/saved/error state.
- Separate upload, AI, media, and render queues.

## Proposed targets

These are targets to measure, not existing benchmark results:
- Timeline pointer interaction target <16 ms/frame on a defined reference desktop dataset.
- Avoid main-thread blocking during interaction.
- Persist committed edits promptly without snapshotting every pointer move.
- Load project metadata before optional thumbnails/AI modules.
- Report honest render stages and preserve recoverable state.

Establish reference hardware and fixtures before enforcing release thresholds.

## Reliability/observability

Autosave with optimistic concurrency and recovery; idempotent jobs; retry classification; output checksums; temporary storage cleanup; quota accounting; stuck-job detection. Track queue depth/age, durations, retries, failure category, render throughput, and storage use. Redact media content, secrets, signed URLs, and private transcripts.
