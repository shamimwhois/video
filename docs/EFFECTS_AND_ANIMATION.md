# Effects, Transitions, and Animation

## Capability registry

Every effect/transition/behavior has stable ID, name, supported clip types, typed parameter schema/defaults, preview/export support, duration and value bounds, version, and migration policy.

## Transitions

Initial candidates: cut, crossfade/dissolve, fade-through-black, wipe, slide, and simple geometric reveal only where export parity is verified. Record explicit overlap ranges and validate duration against adjacent clips.

## Keyframes

Initial properties: position, scale, rotation, opacity, audio gain. Support linear and selected easing curves. Store time in sequence ticks and numeric values in typed records. Interpolate deterministically.

## Visual effects

Candidate P1: blur, brightness/contrast, saturation, tint, border, shadow, blend mode, LUT. Only expose as complete when both preview and export paths exist; otherwise label preview-only.

## Behaviors

Implement as reusable editable keyframe presets (entrance, emphasis, exit), not opaque scripts.

## Cursor effects

Pointer/click overlays are supported when reliable pointer metadata exists, or when inferred regions are reviewed. Never claim exact cursor recovery from pixels alone. Configure highlight/click ring as overlay properties.

## Tests

Deterministic reference frames and synthetic fixtures. Verify preview/export parity, parameter bounds, rejection, and schema migration.
