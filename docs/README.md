# AI Video Studio — Documentation Hub

> Professional browser-based AI-assisted video editor. UX references include a professional multitrack editor, preview, tool panels, inspector, transitions, effects, animations, and cursor effects. Create original branding, code, and assets.

## Project status
The current repository is a Laravel 13 application with authentication and a basic video-post CRUD workflow. The editor, timeline, media-processing workers, AI orchestration, collaboration, and render/export pipeline are specifications only until implementation and tests prove otherwise. See [CURRENT_STATE.md](CURRENT_STATE.md).

## Start here
1. [PRD](PRD.md) — master product requirements with 1,050 detailed feature requirements across 25 domains
2. [TRD](TRD.md) — technical requirements
3. [TDD](TDD.md) — implementation design
4. [Architecture](ARCHITECTURE.md) and [Architecture decisions](DECISIONS.md)
5. [Current repository audit](CURRENT_STATE.md)
6. [Roadmap](ROADMAP.md) and [Master implementation prompt](IMPLEMENTATION_PROMPT.md)
7. [Developer guide](DEVELOPER_GUIDE.md)

## Feature scope
- The master PRD contains 1,050 individually identified requirements (VS-0001–VS-1050).
- Requirement entries define behavior, user outcome, acceptance criteria, priority, and dependencies.
- Requirements remain **Specified** until implementation and verification evidence is recorded in CURRENT_STATE.md.

## Editor and media domain
- [Editor UX](EDITOR_UX.md)
- [UX flows and state machines](UX_FLOWS_AND_STATES.md)
- [Timeline engine](TIMELINE_ENGINE.md)
- [Project format](PROJECT_FORMAT.md)
- [Media pipeline](MEDIA_PIPELINE.md)
- [Rendering](RENDERING.md)
- [Effects and animation](EFFECTS_AND_ANIMATION.md)
- [Audio and captions](AUDIO_AND_CAPTIONS.md)
- [Accessibility and browser compatibility](ACCESSIBILITY_AND_COMPATIBILITY.md)
- [Product glossary](PRODUCT_GLOSSARY.md)

## AI and automation
- [AI automation and agent safety](AI_AUTOMATION.md)
- [AI provider strategy](AI_PROVIDER_STRATEGY.md)
- [AI quality evaluation and governance](AI_EVALUATION.md)

## Platform and operations
- [Data model](DATA_MODEL.md)
- [API contract](API.md)
- [Integrations](INTEGRATIONS.md)
- [Workspaces, billing, and quotas](WORKSPACES_BILLING_QUOTAS.md)
- [Collaboration and sharing](COLLABORATION.md)
- [Security and privacy](SECURITY.md)
- [Performance](PERFORMANCE.md)
- [Observability and runbooks](OBSERVABILITY_RUNBOOKS.md)
- [Testing](TESTING.md)
- [Deployment](DEPLOYMENT.md)
- [Release and migration strategy](RELEASE_AND_MIGRATION.md)

## Status vocabulary
**Implemented** means code exists and the workflow is verified. **In progress** means partial code exists. **Specified** means documented but not implemented. **Blocked** identifies unresolved dependencies. **Deferred** is intentionally excluded. Update CURRENT_STATE.md with evidence at every milestone.

## Product principles
- Browser-first editing; precision editing is desktop-first.
- Private media by default; cloud processing is explicit and consent-based.
- Deterministic, versioned project model; UI state is not the source of truth.
- Non-destructive editing; originals remain immutable.
- AI proposes typed operations; users preview and approve changes.
- Rendering is asynchronous, observable, resumable, and validated.
- No fake controls, progress, or completion claims.
