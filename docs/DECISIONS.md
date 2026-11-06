# Architecture Decision Records

This file records decisions that constrain implementation. Add dated ADRs when a decision changes.

## ADR-001 — Laravel as control plane
**Decision:** Keep Laravel responsible for identity, authorization, project persistence, APIs, job dispatch, quotas, and audit.  
**Reason:** Reuse existing application and Laravel ecosystem.  
**Trade-off:** Media processing scales independently.

## ADR-002 — Dedicated browser editor
**Decision:** Use a TypeScript editor application and framework-independent timeline domain package.  
**Reason:** Pointer/playhead interactions require low-latency client state; they should not round-trip through PHP/Livewire.  
**Trade-off:** Two frontend concerns need clear build and API contracts.

## ADR-003 — Non-destructive project model
**Decision:** Original media is immutable; edit decisions are versioned project data.  
**Reason:** Reversibility, reproducibility, and safe AI changes.

## ADR-004 — Typed AI plans with approval
**Decision:** AI may propose allowlisted typed operations only. User approval precedes mutation.  
**Reason:** Prevent arbitrary execution and preserve user agency.

## ADR-005 — Asynchronous isolated media workers
**Decision:** Probe, transcode, and render outside HTTP workers in constrained processes/containers.  
**Reason:** Resource isolation and recoverability.

## ADR-006 — Immutable render inputs
**Decision:** Every render pins a project revision, profile, asset checksums, and renderer version.  
**Reason:** Reproducibility and traceability.

## ADR-007 — Private media by default
**Decision:** Originals, derivatives, and exports are private; access uses scoped authorization and expiring URLs.  
**Reason:** Customer media is sensitive content.

## ADR-008 — Service-Oriented Modular Monolith with Hexagonal Boundaries
**Status:** Accepted  
**Decision:** Keep one Laravel control-plane application and organize business capabilities into domain-oriented modules. Use Hexagonal Architecture inside modules where infrastructure adapters are required. Use explicit module contracts and inward dependency direction.  
**Reason:** VideoStudio AI has distinct domains (Projects, Media, Recorder, Editor, Timeline, Rendering, AI, Collaboration and Billing) but does not currently need independently deployed domain microservices. This preserves modularity while avoiding premature distributed-system complexity.  
**Consequences:** Module ownership, public contracts, dependency rules and architecture tests are required. Do not allow cross-module writes to internal tables or circular dependencies.

## ADR-009 — Event-Driven Asynchronous Workloads
**Status:** Accepted  
**Decision:** Use persisted domain/job state and queued event listeners for long-running media, recording conversion, rendering, transcription, AI and notification workflows. Use idempotent jobs, bounded retries and reliable event dispatch (transactional outbox where required).  
**Reason:** Encoding and AI workloads are long-running, resource-intensive and need independent worker scaling and recovery.  
**Consequences:** HTTP requests only dispatch work; users can query durable job status. Realtime updates are supplementary, not authoritative.

## ADR-010 — Selective CQRS; no default Event Sourcing
**Status:** Accepted  
**Decision:** Apply command/query separation to complex timeline operations and read-heavy projections only where justified. Keep normal writes transactional. Use versioned project revisions and audit records; do not adopt full event sourcing by default.  
**Reason:** Editor read models may need optimized hydration/search, while full event sourcing would add complexity without a proven requirement.  
**Consequences:** Commands validate project revision and typed operation payloads. Read projections can be rebuilt from authoritative persisted state.

## ADR-011 — One Primary Database and Private Object Storage
**Status:** Accepted  
**Decision:** Begin with one relational database and private object storage. Modules own their tables and migration boundaries. Redis is used for cache, queue, locks and transient coordination, not as durable source of truth.  
**Reason:** Strong transactional consistency and simpler operations during initial product development.  
**Consequences:** Media bytes never live in database blobs. Storage lifecycle, ownership and cross-module references must be explicit.

## Pending decisions
Frontend monorepo layout; exact timeline timebase; PostgreSQL deployment baseline; storage vendor; worker language/runtime; AI provider shortlist; billing provider; browser support policy; retention periods; export profile limits. Record evidence before selecting defaults.
