# AI Video Studio — Documentation Hub

> Professional web-based AI-assisted video editor. The supplied screenshots are UX references for the multitrack editor, preview, tool panels, inspector, transitions, effects, animations, and cursor effects. Build original branding, code, and assets.

## Current status

The repository currently contains a Laravel 13 application with authentication and a basic video-post feature. A timeline engine, editing workspace, media-processing pipeline, AI orchestration, and export service have not been verified in the current source tree. These documents specify the target; they do not claim those features are implemented.

## Read first

1. [PRD](PRD.md)
2. [TRD](TRD.md)
3. [TDD](TDD.md)
4. [Architecture](ARCHITECTURE.md)
5. [Current repository audit](CURRENT_STATE.md)
6. [Roadmap and acceptance gates](ROADMAP.md)
7. [Master implementation prompt](IMPLEMENTATION_PROMPT.md)

## Domain specifications

- [Editor UX](EDITOR_UX.md)
- [Timeline engine](TIMELINE_ENGINE.md)
- [Media pipeline](MEDIA_PIPELINE.md)
- [Rendering](RENDERING.md)
- [AI automation](AI_AUTOMATION.md)
- [Effects and animation](EFFECTS_AND_ANIMATION.md)
- [Audio and captions](AUDIO_AND_CAPTIONS.md)
- [Project format](PROJECT_FORMAT.md)
- [Data model](DATA_MODEL.md)
- [API](API.md)
- [Security](SECURITY.md)
- [Performance](PERFORMANCE.md)
- [Testing](TESTING.md)
- [Deployment](DEPLOYMENT.md)

## Product principles

- Browser-first editing; no desktop installation required for the core workflow.
- Local-first media handling where browser capabilities permit; cloud processing is explicit and consent-based.
- Deterministic serializable project model; UI state is not the source of truth.
- Non-destructive editing; original source media remains immutable.
- AI proposes typed operations; users preview and approve changes.
- Rendering is asynchronous, observable, resumable, and validated.
- No fake controls, progress, or completion claims.

## Status vocabulary

**Implemented** means code exists and its workflow is verified. **In progress** means partial code exists. **Specified** means documented but not implemented. **Blocked** identifies unresolved dependencies. **Deferred** is intentionally excluded. Update CURRENT_STATE.md with evidence at every milestone.
