# Preview and Rendering Specification

## Separation

Preview optimizes interaction using browser decoders, WebAudio, Canvas/WebGL, and proxies where supported. Export runs in a deterministic worker pipeline and is authoritative. Maintain a feature parity matrix.

## Render request

Pin project ID, immutable sequence revision, output profile, codec settings, renderer version, asset IDs/checksums, requester, quota reservation, and idempotency key. Never render uncommitted mutable browser state.

## Initial output profiles

MP4 H.264/AAC 1080p landscape at 30fps baseline; 720p/1080p variants; portrait 9:16 and square 1:1. GIF is later due to palette/size constraints. Validate every profile against actual worker capabilities.

## Lifecycle

`queued → preparing → rendering → validating → completed`; alternate states: failed, cancel_requested, cancelled, expired. Progress includes stage and measurable frames/time where available. Do not fabricate percentages.

## Compiler and safety

Compile normalized sequence to a render graph. Build FFmpeg filters from typed nodes and validated values. Use fixed executable path, argument arrays, timeouts, and resource limits. Never shell-interpolate untrusted content.

## QA

Probe output; verify stream presence, expected dimensions/duration within tolerance, sample decoded frames, detect zero-byte output, checksum, and storage completion. Record renderer version and QA report.

## Operations

Constrain CPU/memory/disk/process/time. Reserve temp space and clean safely. Cancellation distinguishes queued jobs from active encoders. Store outputs privately and serve short-lived authorized downloads.
