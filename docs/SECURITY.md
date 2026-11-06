# Security and Privacy

## Authorization

Reuse Laravel auth where appropriate. Add workspace membership and role-based project policies. Authorize every project, asset, upload, sequence, AI task, render, and download. Keep CSRF for cookie auth and rate-limit auth, uploads, AI, and exports.

## Upload threat model

Uploads are hostile. Enforce size, duration, codec, and type policy. Do not trust extension/client MIME. Probe in isolated workers. Reject path traversal/archive hazards. Generate opaque keys. Keep originals private.

## Worker isolation

Fixed executable path and argument arrays; never shell-interpolate user content. Per-job temp directory and cleanup. CPU/memory/disk/process/time limits. Minimal scoped storage credentials. No model-generated FFmpeg filter strings. Pin/patch processing dependencies.

## AI

Provider keys server-side. Treat transcript, captions, metadata, filenames, and media content as untrusted input. Validate strict schemas and operation allowlists. Require approval for destructive, costly, or externally visible actions. Log safe metadata, not secrets or unnecessary private content.

## Privacy

Disclose local vs cloud media processing. Obtain consent before external AI processing. Define retention/deletion for originals, derivatives, transcripts, prompts, and exports. Account deletion must trigger object cleanup. Do not train on customer media without separate explicit authorization.

## Secrets/audit

Use environment/secret manager. Never commit tokens or user media. Redact signed URLs and credentials from logs. Audit privileged operations.
