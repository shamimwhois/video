# AI Quality, Evaluation, and Governance

## Evaluation layers
Provider contract tests; schema/constraint tests; offline quality benchmark; human review; online product metrics. A model passing JSON parsing is not evidence of editing quality.

## Metrics
Transcription word error rate and timestamp deviation; scene boundary precision/recall; edit-plan schema validity; operation acceptance; partial acceptance; undo/reversal rate; user correction rate; latency; cost per processed minute; harmful/unwanted edit reports.

## Dataset governance
Use synthetic, licensed, or explicitly consented media. Track dataset provenance, allowed use, retention, and deletion. Avoid retaining raw media in benchmark logs. Separate evaluation datasets from production customer content.

## Release gates
Run regression suite on provider/model/prompt/schema changes. Set thresholds per task before rollout. Use staged rollout and ability to disable provider/feature. Keep human approval for project mutations.

## Governance
Disclose AI-generated content, provider processing, and limitations. Provide user control over external processing and retention where possible. Document known failure modes and escalation path.
