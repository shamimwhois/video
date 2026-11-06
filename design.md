# VideoStudio AI — Product UI Design Specification

> **Status:** Visual concept / implementation specification  
> **Product:** VideoStudio AI — browser-based, AI-assisted, non-linear video editor  
> **Design direction:** Professional creative software, dark glass surfaces, electric violet and blue accents  
> **Reference:** Generated VideoStudio AI editor concept from the design conversation  
> **Scope:** UI/UX direction and interaction contract. This document does not claim that editor functionality is implemented.

---

## 1. Design goals

1. Make the editing workspace feel like a professional desktop NLE while remaining approachable in a browser.
2. Keep the preview and timeline visually dominant.
3. Make media, effects, titles, audio, captions, and AI tools discoverable without hiding the editing canvas.
4. Provide predictable selection, editing, playback, undo/redo, and inspector behavior.
5. Use visual effects as hierarchy and feedback—not decoration that reduces readability.
6. Scale from a full desktop workstation to a compact laptop; mobile is primarily a review and lightweight-edit experience.

### Design principles

- **Canvas first:** preview and timeline receive the greatest workspace area.
- **One selection model:** selecting a clip, title, track, or asset drives the contextual inspector.
- **Non-destructive editing:** edits update project state and preserve source media.
- **Progressive disclosure:** advanced controls remain grouped in collapsible inspector sections.
- **Clear system status:** upload, autosave, proxy generation, AI jobs, and render progress always expose their state.
- **Keyboard-ready:** core editing actions have discoverable shortcuts and accessible alternatives.

## 2. Workspace information architecture

### Global navigation

| Area | Purpose |
|---|---|
| Editor | Open the active editing workspace |
| Projects | Browse, create, duplicate, rename, archive, and recover projects |
| Assets | Browse reusable uploaded and generated assets |
| AI Studio | Access AI-assisted editing and media generation workflows |
| Templates | Start from branded and reusable project templates |
| Cloud | Show storage, sync, render, and job status |
| Search | Search media, tools, effects, templates, and commands |
| Notifications | Surface job completion, collaboration activity, and warnings |
| Profile | Account, preferences, billing, and sign out |

The global header should remain compact and stable. The active destination must be visually distinct and keyboard accessible.

### Editor workspace panels

1. **Tool rail:** Media, Library, Templates, Text & Titles, Transitions, Effects, Animations, Behaviors, Cursor Effects, Audio, Captions, AI Tools, and More.
2. **Media browser:** import drop zone, search/filter, media-type tabs, asset cards, metadata, and context actions.
3. **Preview stage:** video output, safe-area guides, selected-object handles, playback controls, timecode, aspect ratio, and fullscreen.
4. **Timeline:** track headers, ruler, clips, transitions, keyframes, playhead, zoom, snapping, and horizontal navigation.
5. **Inspector:** contextual Properties, Effects, and AI Edit tabs.

## 3. Desktop layout

Target reference viewport: **1440 × 900 px and above**. The concept uses a dense, docked editor layout.

| Region | Suggested width / height | Behavior |
|---|---:|---|
| Global header | 56–64 px high | Fixed within the application shell |
| Left tool rail | 64–176 px | Collapsible; icon + label when expanded |
| Media browser | 300–380 px | Resizable; scrollable asset grid |
| Preview + timeline | Flexible center | Primary workspace |
| Inspector | 300–360 px | Resizable; contextual controls |
| Preview stage | Flexible, 16:9 default | Preserve media aspect ratio |
| Timeline | 280–360 px minimum | Docked below preview; resizable vertically |

Use a minimum supported desktop workspace width that prevents the timeline and inspector from collapsing into unusable controls. When space is constrained, collapse the media browser or inspector into a drawer rather than compressing every panel.

### Panel behavior

- Support resize handles with visible hover/focus states.
- Support collapse/expand and persist panel preferences per user.
- Avoid panel overlap; use a clear z-index and focus-management model for drawers and dialogs.
- Preserve the active selection and playhead when panels resize.
- Provide a reset-workspace action.

## 4. Visual system

### Color tokens

| Token | Suggested value | Usage |
|---|---|---|
| app-bg | #080B16 | Application background |
| surface-1 | #111629 | Main panel surface |
| surface-2 | #1A2036 | Raised cards and controls |
| surface-3 | #252D48 | Hover/selected supporting surface |
| border-subtle | rgba(155,170,220,.16) | Panel and control borders |
| text-primary | #F5F6FF | Primary text |
| text-secondary | #AAB3CF | Secondary labels |
| text-muted | #77819F | Metadata and helper text |
| accent-violet | #9B5CFF | Primary accent and selection |
| accent-blue | #4F8CFF | Secondary accent |
| accent-cyan | #35D6D0 | Audio and positive status |
| danger | #FF647C | Destructive/error state |
| warning | #FFC66D | Warning and attention state |

Color values are starting tokens, not a requirement to reproduce every glow in every component. Maintain WCAG AA contrast for text and essential controls.

### Typography

- Primary UI family: Inter or a metrically similar sans-serif.
- Use a restrained type scale: 12 px metadata, 13–14 px controls, 15–16 px body, 18–22 px panel headings.
- Use tabular numerals for timecodes, frame counts, dimensions, and numeric inspector values.
- Reserve bold/italic display typography for canvas content, not dense application chrome.

### Shape, depth, and effects

- Panel radius: 12–18 px.
- Control radius: 8–10 px.
- Use subtle translucent surfaces and restrained backdrop blur.
- Use violet/blue glow only for active navigation, selected timeline objects, focus, and primary actions.
- Prefer thin borders and layered shadows over heavy neon outlines.
- Motion should be short and purposeful; respect reduced-motion preferences.

## 5. Media browser

### Import zone

- Dashed drop target with upload icon and concise supported-media hint.
- Support click-to-select and drag-and-drop.
- Show upload queue, progress, cancellation, retry, and failed-file details.
- Validate type, size, duration, and processing constraints before ingestion.
- Never imply an upload is complete until the server confirms it.

### Asset cards

Each card should show:

- Thumbnail or waveform preview.
- Filename with truncation and full-name tooltip.
- Duration and resolution where relevant.
- Media-type icon and processing status.
- Selection checkbox and overflow menu.
- Context actions: add to timeline, preview, rename, replace, download (when allowed), and delete (with confirmation).

Tabs/filters: All, Videos, Audio, Images, and additional supported types. Search should support filename and metadata queries.

## 6. Preview stage

### Main canvas

- Render the active sequence frame using the sequence aspect ratio.
- Show selection bounds and handles only for the selected editable object.
- Support direct manipulation for position, scale, rotation, and crop.
- Offer safe-area guides, grid, snapping guides, and preview quality controls.
- Distinguish proxy/low-resolution preview from final render quality.

### Playback controls

- Play/pause, previous/next frame, jump to previous/next edit, and loop.
- Current timecode and total duration.
- Volume/mute for preview monitoring.
- Aspect-ratio selector and fullscreen.
- Keyboard shortcuts must not steal focus from text inputs or editable controls.

### Empty and error states

Provide designed states for no sequence, missing media, unsupported codec, offline source, proxy generation, and preview-render failure. Always offer a clear next action.

## 7. Timeline design

### Track types

- Video
- Overlay / graphics
- Titles
- Audio
- Captions
- Effects / adjustment layers (where supported)

Track types are semantic; do not rely on color alone to distinguish them.

### Timeline controls

- Ruler with timecode/frame ticks.
- Playhead with visible timecode label.
- Zoom in/out and fit-to-sequence.
- Horizontal scroll and vertical track navigation.
- Snapping toggle and snapping guides.
- Track visibility, lock, mute/solo (as applicable), and reorder controls.
- Undo/redo and common clip operations in a stable toolbar.

### Clip interaction contract

- Click selects; double-click opens the appropriate edit mode.
- Drag moves clips; edge drag trims; modifier-assisted drag duplicates.
- Dragging a clip to a compatible track changes its track assignment.
- Show snapping feedback and valid/invalid drop targets.
- Ripple/roll/slip operations must be explicit modes or clearly discoverable modifier actions.
- Prevent accidental destructive edits; support undo for every timeline mutation.
- Support multi-select, group/ungroup, copy/paste, split at playhead, duplicate, and delete.
- Keep timeline time units consistent with sequence frame rate.

### Timeline visual language

- Video clips: thumbnail strips where performance permits.
- Audio clips: waveform with readable baseline.
- Title clips: title icon and editable title label.
- Transitions: visible region between adjacent clips.
- Keyframes: distinct markers with selected/focused states.
- Selected clip: accent border/fill plus non-color selection indicator.

## 8. Inspector

The inspector is contextual: it changes based on the selected object and exposes only applicable controls.

### Tabs

- **Properties:** transform, crop, opacity, blend/compositing, text, audio, and clip-specific controls.
- **Effects:** applied effect stack, effect parameters, enable/disable, reorder, reset, and remove.
- **AI Edit:** contextual AI actions for the selected clip, sequence, transcript, or asset.

### Transform controls

- Position X/Y
- Scale (uniform lock where appropriate)
- Rotation
- Opacity
- Anchor point and crop controls where supported
- Reset-to-default per property

Numeric fields should support direct entry, keyboard stepping, validation, and clear units. Sliders must have an accessible numeric alternative.

### Text controls

- Text content
- Font family, weight, size, and line height
- Alignment and color
- Fill, stroke, shadow, and background
- Character/paragraph spacing where supported
- Presets and animation controls

## 9. AI Studio and AI Edit

AI must behave as an explicit assistant, not silently mutate a project.

### Example capabilities

- Generate an edit from a natural-language brief.
- Find highlights and candidate moments.
- Create rough cuts from transcript or scene structure.
- Remove silence and detect pauses.
- Suggest titles, captions, transitions, and music placement.
- Summarize footage and search by visual content.
- Generate or enhance media when the connected model/provider supports it.
- Produce alternate aspect ratios and platform-specific versions.

### Interaction requirements

1. Explain the proposed change and its scope.
2. Show a preview, diff, or proposed timeline changes when practical.
3. Ask for confirmation before applying destructive or broad changes.
4. Apply changes as undoable project operations.
5. Expose job state: queued, running, completed, failed, cancelled.
6. Show model/provider, estimated usage where available, and relevant limitations.
7. Never claim a generated asset or edit exists before the job completes and the asset is persisted.

## 10. Responsive behavior

| Viewport | Layout |
|---|---|
| Large desktop | Full docked workspace with all panels |
| Laptop | Collapsible media browser and inspector; compact tool labels |
| Tablet | Preview-first layout; media and inspector in drawers; simplified timeline |
| Mobile | Project review, playback, comments, and lightweight edits; full multi-track editing is not the primary target |

Do not scale the desktop interface down proportionally to mobile. Recompose it around the active task.

## 11. Accessibility and input

- Full keyboard navigation and visible focus indicators.
- Semantic buttons, labels, headings, tabs, and dialogs.
- Accessible names for icon-only controls.
- Tooltips supplement labels; they do not replace accessible names.
- Do not communicate status by color alone.
- Respect reduced motion and system contrast preferences.
- Provide keyboard alternatives for drag-only interactions.
- Ensure dialogs trap focus and return focus to the invoking control.
- Support screen-reader announcements for upload, render, and AI job status changes.

## 12. Core states to design

- First-run / no projects
- Empty project
- Empty media library
- Uploading, processing, failed, and completed assets
- No selection / selected clip / selected title / selected audio
- Preview loading / proxy / offline / error
- Timeline with one track / many tracks / long sequence
- AI idle / confirmation / queued / running / completed / failed
- Rendering / export complete / export failed
- Autosaving / saved / sync conflict / offline
- Permission denied / storage limit / plan limit
- Collaboration presence and review comments (when collaboration is enabled)

## 13. Motion and feedback

- Panel transitions: 140–200 ms.
- Hover/focus feedback: 100–160 ms.
- Use subtle scale/opacity changes, not large spatial movement.
- Timeline playhead movement should remain frame-accurate and not use decorative easing.
- Upload and render progress must reflect real job state.
- Disable or reduce non-essential animation under prefers-reduced-motion.

## 14. Implementation mapping

Suggested component boundaries (adapt to the existing application architecture):

~~~text
EditorShell
├── GlobalHeader
├── ToolRail
├── MediaBrowser
│   ├── MediaImportDropzone
│   ├── MediaFilters
│   └── AssetGrid / AssetCard
├── EditorStage
│   ├── PreviewCanvas
│   └── PlaybackControls
├── TimelineWorkspace
│   ├── TimelineToolbar
│   ├── TimelineRuler
│   ├── TrackHeader
│   ├── TimelineClip
│   ├── Playhead
│   └── TimelineOverview
└── InspectorPanel
    ├── PropertiesInspector
    ├── EffectsInspector
    └── AIEditInspector
~~~

Keep presentation components separate from the project/sequence/track/clip domain model and media-processing services. The existing post/content workflow must not be treated as the editor timeline data model.

### Engineering constraints

- The UI must consume persisted project state and real service responses; avoid fake-success interactions.
- Timeline operations should be represented as deterministic commands that can be undone/redone.
- Preview rendering and final export are separate quality/performance paths.
- Media processing and AI jobs should be asynchronous and observable.
- Large media files must not be loaded entirely into browser memory without a deliberate streaming/proxy strategy.
- Enforce authorization and ownership on every project, asset, and render operation.

## 15. Acceptance checklist

- [ ] Workspace panels can resize, collapse, and restore their state.
- [ ] Media import exposes real progress, errors, and retry behavior.
- [ ] Asset cards display correct metadata and processing state.
- [ ] Preview controls reflect actual sequence playback state.
- [ ] Timeline selection and inspector state remain synchronized.
- [ ] Clip move, trim, split, duplicate, and delete operations are undoable.
- [ ] Numeric inspector fields and sliders stay synchronized.
- [ ] AI actions show scope, confirmation, and asynchronous job state.
- [ ] Autosave and sync status are visible and truthful.
- [ ] Keyboard and assistive-technology paths exist for essential actions.
- [ ] Responsive layouts preserve task usability at supported breakpoints.
- [ ] No decorative control is presented as functional before its behavior is implemented.


## 17. Screen recorder and output format support

The product should provide an in-browser screen/camera recorder and make **MP4, AVI, and WebM** available as user-facing output formats. Recording capture and final container encoding are separate pipeline stages.

### Recorder controls

- Capture source: browser tab, application/window, full screen, camera, microphone, and system audio where the browser and operating system permit.
- Show a source-selection dialog before capture begins.
- Show recording indicator, elapsed time, pause/resume, stop, and discard controls.
- Request screen, camera, and microphone permissions explicitly; explain denied or unavailable sources.
- Provide audio input selection, level meter, mute, and optional system-audio capture.
- Warn before stopping or discarding an unsaved recording.
- On stop, persist the original capture safely before starting optional conversion.

### Supported output formats

| Format | User-facing option | Encoding strategy | Notes |
|---|---|---|---|
| MP4 | Yes | Prefer browser-native MP4 only when the browser reports a supported MIME/codec; otherwise transcode with server-side FFmpeg | Recommended compatibility/export choice; H.264 video + AAC audio where licensing and deployment permit |
| WebM | Yes | Native MediaRecorder when a supported WebM MIME type is available; otherwise FFmpeg transcode | Efficient browser capture path; VP9/Opus or VP8/Opus depending on capability |
| AVI | Yes | FFmpeg transcode after capture | Legacy/interchange option; expose codec and file-size trade-offs because AVI is not a practical native browser recording target |

Do not hard-code browser support assumptions. At runtime, detect supported recorder MIME types using the browser capability APIs and choose a supported capture format. The user-facing export format remains independent of the temporary capture container.

### Recording and conversion workflow

1. User selects capture sources and recording options.
2. Application requests permissions and verifies selected devices/sources.
3. Recorder selects a supported MIME type and starts capture.
4. Chunks are buffered and uploaded/persisted incrementally; avoid relying on one large in-memory Blob for long recordings.
5. User stops recording; the original capture is finalized and stored.
6. User chooses MP4, AVI, or WebM output.
7. A background FFmpeg job remuxes or transcodes only when required.
8. UI reports queued, processing, completed, failed, cancelled, and retry states.
9. On success, provide preview, file size, duration, codec/container metadata, and download/save-to-library action.
10. Retain the original recording until the user explicitly deletes it or the configured retention policy expires.

### Format and codec behavior

- Validate the actual container and codec; do not trust the filename extension.
- Distinguish remuxing (container change without re-encoding) from transcoding (codec re-encode).
- Use FFprobe or equivalent metadata inspection after processing.
- Preserve aspect ratio, frame rate, orientation, and audio/video synchronization.
- Make resolution, frame rate, video codec, audio codec, and quality/bitrate controls explicit where supported.
- Surface estimated output size when it can be calculated reliably.
- Handle unsupported codecs, corrupt chunks, interrupted uploads, disk exhaustion, and conversion timeouts with actionable errors.
- Enforce file-size, duration, storage, and job concurrency limits from server configuration and user entitlements.

### Recorder UI states

- Source selection and permission request
- Ready / device unavailable
- Recording / paused
- Finalizing upload
- Original saved
- Converting / transcoding
- Completed with preview and download
- Failed with retry or alternate-format option
- Cancelled / discarded

### Security and privacy

- Capture only after a clear user action and browser permission.
- Show a persistent recording indicator while capture is active.
- Stop media tracks when recording ends or the recorder is disposed.
- Do not upload or retain camera, microphone, or screen data before the user starts capture.
- Protect recording and export endpoints with ownership checks, authorization, signed download URLs, and rate limits.
- Define retention and deletion behavior for original and converted files.

### Recorder acceptance checklist

- [ ] Recorder detects supported browser capture MIME types at runtime.
- [ ] Screen, tab, camera, microphone, and system-audio options are shown only when supported.
- [ ] Pause, resume, stop, and discard work and expose clear states.
- [ ] Long recordings upload/persist incrementally rather than depending on unbounded browser memory.
- [ ] MP4, AVI, and WebM are available as output choices.
- [ ] MP4/AVI conversion uses a background FFmpeg pipeline when native capture cannot produce the requested format.
- [ ] WebM capture uses a supported native MIME type when available.
- [ ] Output container and codec are probed and verified before marking a job complete.
- [ ] Conversion failure preserves the original recording and supports retry.
- [ ] Download and library actions are authorized and use the actual completed output.
- [ ] Permission denial, device loss, network interruption, and storage limits have usable recovery paths.


## 18. Relationship to product requirements

This design specification complements, but does not replace:

- [Master PRD](docs/PRD.md)
- [Feature specifications](docs/features/)
- [Implementation roadmap](docs/ROADMAP.md)
- [Engineering implementation prompt](docs/IMPLEMENTATION_PROMPT.md)

Feature behavior and acceptance criteria in the PRD remain authoritative. If a visual detail conflicts with a product requirement, preserve the product requirement and update this design document.

---

**Document owner:** Product / Design  
**Review status:** Initial visual direction; validate with engineering and usability testing before treating dimensions or interactions as final.
