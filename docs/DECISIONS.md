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

## Pending decisions
Frontend monorepo layout; exact timeline timebase; PostgreSQL deployment baseline; storage vendor; worker language/runtime; AI provider shortlist; billing provider; browser support policy; retention periods; export profile limits. Record evidence before selecting defaults.
