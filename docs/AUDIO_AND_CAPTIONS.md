# Audio, Narration, and Captions

## Audio scope

P0: audio placement, trim, mute, gain, fades, basic waveform. P1: multitrack mixing, mute/solo, gain keyframes, ducking, and noise-cleanup adapter.

Preserve sample rate/channel metadata. Keep source audio immutable. Warn on clipping where measurable. Use sample-accurate timing when supported and align preview/export semantics.

## Narration

Browser recording is a later feature requiring explicit microphone permission and a visible recording indicator. Save as a new source asset; never overwrite existing files.

## Transcription/captions

Transcript segment: asset ID, start/end, text, optional speaker ID, confidence, language, provider metadata. Validate timestamps against duration.

Caption editor supports text/timing edits, split/merge, styles/safe areas, and SRT/VTT import/export where supported. Burn in via renderer or export sidecar subtitles. Mark generated transcripts machine-generated and editable; uncertain identity must not be stated as fact.
