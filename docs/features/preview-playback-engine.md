# Preview and playback engine — Detailed Feature Specification

**Product:** AI Video Studio | **Domain:** Preview and playback engine | **Priority:** P0 foundational release
**Requirement range:** VS-0673 through VS-0714

## Domain purpose
Preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.

## Domain-wide engineering constraints
- The domain must use canonical project identifiers and enforce workspace/resource authorization on the server.
- Mutations must be validated, transactional where applicable, and represented in versioned project state.
- Source media remains immutable; derived media and outputs must retain provenance and lifecycle metadata.
- Asynchronous work must be idempotent, observable, bounded, and recoverable; progress must reflect measured work.
- UI controls must expose loading, empty, disabled, success, and error states as applicable.
- All user-visible behavior must be keyboard accessible and documented; unsupported paths must fail clearly.

## Detailed requirements

### VS-0673 — Preview and playback engine: create
**Requirement.** Create with validated defaults and a stable identifier. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0673.

### VS-0674 — Preview and playback engine: import
**Requirement.** Import source material while preserving originals and provenance. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0674.

### VS-0675 — Preview and playback engine: bulk import
**Requirement.** Process batches with per-item validation and partial-failure reporting. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0675.

### VS-0676 — Preview and playback engine: configure
**Requirement.** Expose settings with documented defaults, bounds, and reset behavior. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0676.

### VS-0677 — Preview and playback engine: preview
**Requirement.** Preview the proposed result before committing. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0677.

### VS-0678 — Preview and playback engine: inspect
**Requirement.** Expose metadata, technical properties, and current state. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0678.

### VS-0679 — Preview and playback engine: search
**Requirement.** Find items with text search and useful empty/no-result states. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0679.

### VS-0680 — Preview and playback engine: filter
**Requirement.** Narrow items by supported metadata, status, and type. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0680.

### VS-0681 — Preview and playback engine: sort
**Requirement.** Sort deterministically and persist the chosen sort preference. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0681.

### VS-0682 — Preview and playback engine: group
**Requirement.** Organize related items without changing their identity. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0682.

### VS-0683 — Preview and playback engine: rename
**Requirement.** Rename with validation and immediate feedback. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0683.

### VS-0684 — Preview and playback engine: duplicate
**Requirement.** Create an independent copy with safe references. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0684.

### VS-0685 — Preview and playback engine: move
**Requirement.** Move between valid locations while preserving relationships. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0685.

### VS-0686 — Preview and playback engine: reorder
**Requirement.** Persist a deterministic display or processing order. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0686.

### VS-0687 — Preview and playback engine: multi-select
**Requirement.** Select eligible items and expose only valid bulk actions. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0687.

### VS-0688 — Preview and playback engine: delete
**Requirement.** Delete with confirmation, dependency checks, and recovery policy. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0688.

### VS-0689 — Preview and playback engine: restore
**Requirement.** Restore eligible items after ownership and dependency validation. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0689.

### VS-0690 — Preview and playback engine: lock/unlock
**Requirement.** Prevent or allow mutation with role-aware controls. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0690.

### VS-0691 — Preview and playback engine: visibility
**Requirement.** Toggle visibility without destroying underlying data. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0691.

### VS-0692 — Preview and playback engine: status
**Requirement.** Expose queued, processing, ready, failed, cancelled, and unavailable states. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0692.

### VS-0693 — Preview and playback engine: progress
**Requirement.** Report measured progress or an honest indeterminate state. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0693.

### VS-0694 — Preview and playback engine: validation
**Requirement.** Validate input, permissions, constraints, and dependencies before commit. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0694.

### VS-0695 — Preview and playback engine: error recovery
**Requirement.** Provide actionable errors and safe retry without losing successful work. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0695.

### VS-0696 — Preview and playback engine: undo/redo
**Requirement.** Record reversible mutations and restore the prior state. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0696.

### VS-0697 — Preview and playback engine: autosave
**Requirement.** Persist committed changes and show saved/saving/offline/failed states. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0697.

### VS-0698 — Preview and playback engine: version history
**Requirement.** Retain revisions with timestamp, author, and restore safeguards. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0698.

### VS-0699 — Preview and playback engine: keyboard controls
**Requirement.** Provide documented keyboard alternatives and focus-safe shortcuts. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0699.

### VS-0700 — Preview and playback engine: accessibility
**Requirement.** Support semantic labels, keyboard use, contrast, and reduced motion. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0700.

### VS-0701 — Preview and playback engine: responsive layout
**Requirement.** Adapt non-precision workflows to supported viewport sizes. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0701.

### VS-0702 — Preview and playback engine: permissions
**Requirement.** Enforce ownership, workspace membership, role, and resource authorization. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0702.

### VS-0703 — Preview and playback engine: audit events
**Requirement.** Record security-relevant changes without exposing secrets. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0703.

### VS-0704 — Preview and playback engine: notifications
**Requirement.** Notify on meaningful completion, failure, invitation, and approval. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0704.

### VS-0705 — Preview and playback engine: API access
**Requirement.** Expose a versioned, authenticated, validated API contract. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0705.

### VS-0706 — Preview and playback engine: webhooks
**Requirement.** Emit signed retryable events with delivery history and replay protection. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0706.

### VS-0707 — Preview and playback engine: integrations
**Requirement.** Connect providers through scoped credentials and explicit consent. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0707.

### VS-0708 — Preview and playback engine: performance
**Requirement.** Bound resources and keep blocking work off the UI thread. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0708.

### VS-0709 — Preview and playback engine: privacy
**Requirement.** Enforce explicit sharing, retention, consent, and deletion behavior. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0709.

### VS-0710 — Preview and playback engine: export
**Requirement.** Produce a portable output with validated settings and completion state. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0710.

### VS-0711 — Preview and playback engine: compatibility
**Requirement.** Detect unsupported/older formats and provide safe compatibility behavior. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0711.

### VS-0712 — Preview and playback engine: analytics
**Requirement.** Measure adoption and reliability with privacy-conscious events. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0712.

### VS-0713 — Preview and playback engine: administration
**Requirement.** Provide authorized operational controls with audit trails. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0713.

### VS-0714 — Preview and playback engine: documentation/testing
**Requirement.** Document constraints and test success, invalid input, authorization, and recovery. Apply this capability to preview decoding, transport, frame stepping, caching, proxy playback, quality modes, and synchronization.
**User workflow.** The user enters the relevant workspace and domain view, selects the target resource, invokes the action, reviews the result, and receives a clear persisted outcome. Bulk or asynchronous variants must identify the affected resources.
**Interface behavior.** Provide a discoverable control, contextual help, field-level validation, disabled/loading states, confirmation for destructive actions, and a clear success or failure message. Preserve keyboard focus and selection after completion.
**Domain state.** Persist stable resource IDs, ownership, workspace scope, schema version, actor, timestamps, and relevant state transitions. Avoid storing transient UI state as canonical domain data.
**Service/API behavior.** Validate the request server-side, authorize the actor against the target resource, execute through a domain service, return a versioned response, and emit domain events only after successful commit.
**Validation/security.** Reject malformed, stale, unsupported, over-quota, cross-tenant, or unauthorized requests. Sanitize user-controlled text, protect secrets, and apply idempotency keys to retryable operations.
**Failure/recovery.** On failure, preserve the last valid state, return an actionable error code, record a correlation ID, and offer retry only when the operation is safe to repeat. Partial batch outcomes must be explicit.
**Observability.** Record success/failure counts, latency, actor/workspace identifiers, operation type, and correlation IDs. Never log raw credentials, private media URLs, or sensitive user content.
**Acceptance tests.** Cover the valid workflow, invalid payload, unauthorized actor, cross-workspace access, duplicate/retry request, persistence after reload, and recoverable service failure.
**Dependencies and priority.** P0 foundational release. Depends on the preview and playback engine domain model, shared authorization, validation, audit, and persistence services. Map tests and pull requests to VS-0714.

## Domain acceptance gate

- All requirement IDs in this domain have explicit implementation status in CURRENT_STATE.md.
- Authorization, validation, data integrity, and recovery tests pass.
- UI behavior is verified at supported viewport sizes and keyboard-only operation.
- Operational metrics and runbook references exist for asynchronous or critical workflows.
- No requirement is marked Implemented or Verified solely because it is documented.

