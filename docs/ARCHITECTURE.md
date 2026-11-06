# System Architecture

## Style

Modular Laravel monolith for control-plane behavior, separately scalable media/AI worker tier, and browser application for editing. Avoid premature microservices; define explicit module and queue contracts.

## Bounded contexts

| Context | Owns |
|---|---|
| Identity & Workspace | Users, teams, membership, roles |
| Projects | Project metadata and immutable revisions |
| Media Assets | Asset metadata, private storage keys, ingest lifecycle |
| Editing Domain | Sequences, tracks, clips, keyframes, effects |
| Render | Profiles, jobs, outputs, QA, logs |
| AI Studio | Requests, plans, validation, approval, audit |
| Library | Templates and reusable assets |

## Topology

```
Web browser
 ├─ React editor / timeline domain / preview / upload
 └─ Laravel API
      ├─ Auth, policies, domain modules
      ├─ PostgreSQL
      ├─ Redis queue/events
      └─ Private object storage
          ├─ Media workers (FFmpeg/FFprobe)
          └─ AI workers (provider adapters)
```

## Deployment units

Laravel API; PostgreSQL; Redis; private S3-compatible storage; media worker image with pinned FFmpeg; AI worker image; optional realtime broadcaster.

## Trust boundaries

Browser, uploaded files, AI provider output, transcripts, filenames, and imported project files are untrusted. Workers should have minimal credentials and constrained network/resource access. Short-lived signed URLs are scoped. User content is data, never instructions to agents.

## Data flows

**Import:** authorize upload → signed/multipart transfer → verify size/checksum → probe job → derivatives → ready/failed event.

**Render:** save revision → authorize profile → pin immutable revision → render job → compile graph → encode → QA → record private artifact → authorized download.

**AI edit:** request scoped to project/revision → gather authorized metadata/transcript → schema-constrained plan → validate IDs/bounds/revision → user preview/approval → atomic commands → revision increment/audit.
