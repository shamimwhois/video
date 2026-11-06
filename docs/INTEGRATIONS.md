# Integration Contracts

## Storage
Use a Laravel filesystem adapter behind an internal storage service. Support private local development and S3-compatible production. Define multipart upload, checksum, range reads, signed URL expiry, lifecycle, and deletion semantics.

## Media workers
Version the worker API and render graph schema. Workers receive immutable job manifests and scoped object references, then return structured results. No direct database credentials are required unless specifically justified.

## AI providers
Use the provider capability interfaces in AI_PROVIDER_STRATEGY.md. Each integration must document data sent, region, retention, rate limits, pricing model, timeout, retries, and deletion support.

## Events/webhooks
Sign outbound webhooks, include event ID and timestamp, retry with bounded backoff, and document delivery semantics. Consumers deduplicate event IDs. Verify inbound billing/provider signatures and handle replay.

## Integration acceptance
Contract tests, sandbox tests, failure simulation, secret rotation, rate-limit behavior, privacy review, and version compatibility are required before enabling an integration in production.
