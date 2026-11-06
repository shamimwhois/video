# Timeline Engine Specification

## Responsibility

Framework-independent TypeScript package owns canonical edit state, time conversion, constraints, commands, undo/redo, and serialization. React renders the model but is not its source of truth.

## Hierarchy

Project → Sequence → Track → Clip. Assets are immutable references by stable ID. Effects, transitions, keyframes, and captions attach to clips/tracks.

## Time

Sequence frame rate is rational. Use integer frame ticks for video and sample/rational precision for audio. Store source in/out and timeline start/duration explicitly. Define rounding behavior at frame boundaries. Never depend on floating-point equality for adjacency.

## Clip types

Initial discriminated types: video, audio, image, text, shape, caption, generated overlay. Each has a versioned schema and type-specific constraints.

## Track model

Stable IDs, type/capability, order, visibility, lock, mute, solo, optional compositing. Track order determines compositing. Overlap constraints depend on track and renderer. Schema need not impose a small fixed track count, but application resource limits must be measured and enforced.

## Operations

Insert, move (ripple/overwrite/insert explicitly selected), trim, split, ripple delete/gap close, duplicate, reorder, add/remove keyframe, add transition, undo/redo, transaction grouping.

## Invariants

- Clip duration > 0.
- Source in >= 0 and source out <= source duration.
- Timeline start >= 0 unless pre-roll is supported.
- Duration is consistent with source range and speed.
- IDs are unique and stable.
- Effect parameters match registered schema.
- Transition obeys overlap constraints.
- Locked tracks reject mutation.
- Revision increments only after transaction success.
- Every operation is atomic and undoable.

## Commands/history

Typed commands contain actor, time, preconditions, affected entities, and inverse data. Batch AI edits as a named transaction so one Undo reverses the approved group.

## Performance/testing

Normalize entities, memoize selectors, virtualize viewport, keep drag state transient, throttle paint updates, persist committed state only. Test timebase, trim, split, ripple, snapping, interpolation, transitions, inverses, serialization migration, and generated valid/invalid sequences.
