# AI Provider Strategy

**Status:** Proposed architecture; no production AI provider integration verified.

## Provider capabilities
Define independent interfaces for text planning, speech-to-text, scene/image analysis, audio enhancement, and optional speech generation. Providers may support only a subset. Capability discovery must be explicit; do not assume every model supports video, JSON schema, timestamps, or streaming.

## Adapter contract
Each adapter declares provider/model identifier, supported capabilities, input/output limits, timeout, retryability, data residency/retention notes, and estimated cost metadata. Normalize outputs into internal versioned schemas. Keep provider SDK types out of the editing domain.

## Routing and fallback
Select provider by capability, user/workspace policy, region, budget, latency, and availability. Fallback is allowed only when the alternate provider supports the same required capability and privacy policy. Never silently move private media to a new provider/region.

## Secrets and observability
Store credentials server-side. Rotate keys; redact prompts, media URLs, tokens, and sensitive transcript data from logs. Record model/version, request ID, latency, token/media duration usage, cost estimate, retries, and outcome.

## Evaluation
Maintain a versioned test corpus with consented/synthetic media and expected outputs. Evaluate transcript word error rate, timestamp error, scene boundary quality, plan validity, user acceptance, undo rate, latency, and cost. Run regression evaluations before changing model/provider defaults.

## Failure behavior
Provider timeout/outage must not block manual editing or corrupt projects. Use bounded retries, circuit breakers, idempotency keys, explicit task states, and user-visible retry controls.
