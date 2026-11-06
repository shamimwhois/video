# Testing and Quality Strategy

## Domain unit tests

Timebase/frame conversion; command reducers/invariants; trim/split/move/ripple; keyframe interpolation; transition constraints; serialization migration; AI schema and stale revision rejection.

## Laravel feature tests

Workspace/project authorization; upload validation/completion; asset lifecycle; revision concurrency; AI approval/rejection idempotency; render creation/poll/cancel/download authorization; deletion cleanup retry.

## Worker integration tests

FFprobe valid/corrupt fixtures; thumbnails/waveforms/proxies; render graph compilation; FFmpeg success/timeout/malformed input/disk full; output metadata/duration/checksum QA.

## Browser E2E

Create project/import; place/move/trim/split/delete clips; save/refresh/recover; preview; export/download real output; submit AI prompt/review/approve/undo.

## Fixtures

Short synthetic/licensed/generated media covering variable frame rate, rotation, multistream audio, silence, unsupported codec, corrupt files, long filenames, and large dimensions.

## Release gate

New tests pass, existing tests remain green, static/build checks pass, authorization/security tests exist, manual workflow verified, docs/current-state updated. Component rendering or mocked APIs alone do not count as completion.
