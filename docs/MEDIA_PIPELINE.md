# Media Ingest and Asset Pipeline

## Initial formats

Target common MP4/MOV/WebM video, MP3/WAV/AAC audio, PNG/JPEG/WebP images. This is a proposed allowlist; actual support depends on deployed FFmpeg/browser builds and real fixtures. Probe content; do not trust extensions.

## Lifecycle

`created → uploading → uploaded → probing → processing → ready`; alternate states: rejected, failed, quarantined, deleting, deleted. Persist transitions idempotently and show actual state.

## Upload

Create project-scoped upload session; validate authorization, size, allowed type, and quota; use resumable/multipart transfer for large assets; verify size/checksum; treat filenames/MIME as untrusted; keep originals private; support cancellation and abandoned upload cleanup.

## Probe metadata

FFprobe extracts container/duration, streams/codecs/profiles, dimensions, rational frame rate, pixel format, sample aspect ratio, rotation, time bases, audio sample rate/channels/layout, stream start/duration. Persist normalized metadata plus bounded raw diagnostic output.

## Derivatives

Poster/storyboard thumbnails, editing proxy, waveform peaks, optional normalized audio, transcript, scene thumbnails. Version derivatives by source checksum and processor version. Never overwrite source.

## Storage

Opaque key scheme: `workspaces/{workspaceId}/projects/{projectId}/assets/{assetId}/original`. Derived paths use their own kind/version namespace. Support private local dev and private S3-compatible production storage.

## Security/cleanup

Isolate parsers, enforce duration/codec/size policy, clean abandoned multipart data, and make deletion retryable across source, derivatives, render outputs, and backups.
