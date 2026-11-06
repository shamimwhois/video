# Editor UX and Interaction Specification

## Workspace

- Top bar: project name, save state, undo/redo, workspace controls, export.
- Left tool rail: Media, Library, Annotations, Captions, Transitions, Behaviors, Animations, Cursor Effects, Audio, Visual Effects, AI Studio.
- Left contextual browser: search, categories, filters, previews, favorites.
- Center preview: canvas, playback, resolution/zoom, safe areas, selection overlay.
- Right inspector: selected asset/clip/transition/effect properties.
- Bottom timeline: ruler, markers, track headers, clips, waveforms, thumbnails, playhead, snapping, scroll/zoom.

Panels are resizable and remember widths. Keep editing workspace desktop-first; project dashboard remains responsive.

## Interaction model

- Single click selects clip; double-click enters a defined edit mode.
- Empty timeline click moves playhead.
- Drag body moves clip; edge handles trim.
- Selection, playhead, and range selection are distinct.
- Snapping targets clip edges, playhead, markers, sequence boundaries; show guides.
- Track controls include lock, mute/solo, and visibility where applicable.
- Context menus support split, duplicate, delete, detach audio where supported.
- Zoom anchors at cursor/playhead.
- Virtualize offscreen clips and tracks.

## Preview and inspector

Transport: play/pause, previous/next frame, start/end, time display. Canvas supports bounding boxes and transform handles. Ratio changes do not destructively crop sources. Preview quality can be lowered under load. Unsupported codec/effect paths display clear limitations.

Inspector sections: Transform (X/Y/width/height/scale/rotation/anchor/fit-fill), opacity/compositing, crop, timing/source range/speed, audio gain/mute/fade, effects, keyframes. Controls support precision, reset, keyboard input, and undoable mutations.

## Tool panels

Media: upload/folders/search/sort/thumbnails/metadata/relink. Library: templates with licensing metadata. Annotations: text/arrows/callouts/shapes/highlights. Captions: generated and manual segments. Transitions: categorized presets. Behaviors: editable keyframe presets. Cursor: effects only with reliable pointer metadata or reviewed inference. Audio: gain/fade/waveform. Visual effects: only where preview and export support exist. AI Studio: prompt, plan, confidence, preview, approval, history.

## Accessibility/states

Every panel has loading, empty, error, and populated states. Provide keyboard alternatives, semantic labels, visible focus, contrast, and reduced-motion support.
