# Accessibility, Responsive Behavior, and Browser Compatibility

## Accessibility
Target WCAG 2.2 AA for dashboard and editor chrome. Provide semantic landmarks, labeled controls, visible focus, keyboard operation, contrast, error announcements, accessible dialogs, and reduced-motion support.

Timeline requires keyboard alternatives for selection, move, trim, split, zoom, and playhead navigation. Do not rely only on color or drag-and-drop. Provide accessible numeric controls and screen-reader descriptions for clip/track state.

## Responsive behavior
Dashboard and project management support mobile/tablet. Precision timeline editing is desktop-first. On narrow screens show a clear read-only/limited-edit experience rather than compressing every panel into an unusable layout.

## Browser capability matrix
Feature-detect codecs, WebCodecs, MediaSource, WebAudio, OffscreenCanvas, IndexedDB, and File System Access API. Do not infer support from user-agent strings. Maintain fallbacks and explain unsupported formats/features.

## Test matrix
Maintain supported browser/version and OS matrix, real-device smoke tests, keyboard-only checks, automated accessibility scans, and manual assistive-technology review. Browser support is a release policy and must be published, not assumed.
