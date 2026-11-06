# System Architecture

## Architectural decision

**Selected architecture: Service-Oriented Modular Monolith with Hexagonal Architecture, Event-Driven Processing, and Selective CQRS.**

The product remains one Laravel control-plane application and one primary relational database. Business capabilities are organized as independently maintainable modules with explicit public contracts. Media and AI workloads execute in separately scalable worker processes/containers, but they are not initially split into independently deployed domain microservices.

This combines modular-monolith maintainability with ports-and-adapters dependency inversion and asynchronous processing for a browser-based video editor.

## Style and boundaries

- Deployment: one Laravel application/control plane; independently scalable queue workers are processes, not domain microservices.
- Modules: domain-oriented capabilities with owned application logic, persistence and public interfaces.
- Internal architecture: Hexagonal (ports and adapters) where infrastructure varies.
- Communication: in-process application contracts for synchronous use cases; events for decoupled workflows.
- Data: one primary relational database initially, with module ownership boundaries.
- Read/write separation: selective CQRS for expensive projections; transactional application services for ordinary CRUD.
- Event sourcing: not a default. Use versioned project revisions and audit records unless a demonstrated requirement justifies event sourcing.

## Bounded contexts

| Context / module | Owns |
|---|---|
| Identity & Workspace | Users, authentication, teams, memberships, roles, permissions |
| Projects | Project metadata, settings, immutable revisions, ownership |
| Media | Ingestion, source metadata, probes, derivatives, media lifecycle |
| Asset Library | Collections, reusable assets, organization and search metadata |
| Recorder | Recording sessions, chunk manifests, capture metadata, recorder exports |
| Editor | Editor workspace state and editing use-case orchestration |
| Timeline | Sequences, tracks, clips, keyframes, edit commands and projections |
| Effects & Animation | Effect definitions, parameters, transitions, animation curves |
| Audio & Captions | Audio metadata, mixing decisions, transcripts and subtitle tracks |
| Rendering | Render profiles, immutable inputs, jobs, outputs, QA and logs |
| AI Studio | AI requests, plans, validation, approvals, provider usage and audit |
| Templates & Publishing | Templates, sharing and publishing workflows |
| Collaboration | Invitations, comments, review sessions and presence |
| Billing & Quotas | Plans, subscriptions, usage metering and entitlements |
| Admin & Operations | Platform configuration, support tooling and operational visibility |

Each module owns its business rules and persistence contract. Other modules must not reach into its internal repositories or mutate its tables directly.

## Topology

~~~text
Browser application
  ├── React / TypeScript editor, timeline, preview and capture UI
  └── Laravel HTTP API / web application
        ├── Identity, policies and module application services
        ├── PostgreSQL (or selected relational database)
        ├── Redis (cache, queues, locks and transient coordination)
        ├── Transactional outbox / event dispatch
        └── Private object storage
              ├── Media workers (FFmpeg / FFprobe)
              ├── Recording conversion workers
              ├── Render workers
              └── AI workers (provider adapters)

Optional realtime broadcaster delivers collaboration and job-status updates.
~~~

## Deployment units

1. Laravel application/API: authentication, authorization, domain workflows, persistence, quotas, job dispatch and audit.
2. Relational database: authoritative project, asset, recording, job and account metadata.
3. Redis: queues, cache, locks and transient coordination; not the durable source of truth.
4. Private object storage: originals, recording chunks, proxies, thumbnails and rendered artifacts.
5. Media/recording/render worker images: constrained processes with pinned FFmpeg/FFprobe builds and resource limits.
6. AI worker processes: provider adapters, timeouts, bounded retries and usage accounting.
7. Optional realtime service: presence and progress delivery; correctness must not depend on websocket delivery.

Workers may scale independently based on queue depth and workload. This does not require extracting domain modules into networked microservices.

## Hexagonal module structure

~~~text
app/Modules/Recorder/
  Domain/
    Entities/
    ValueObjects/
    Enums/
    Events/
    Contracts/
    Services/
  Application/
    Actions/
    Commands/
    Queries/
    DTOs/
    Jobs/
  Infrastructure/
    Persistence/
      Models/
      Repositories/
    Capture/
    Storage/
    Converters/
  Presentation/
    Http/
      Controllers/
      Requests/
      Resources/
    routes.php
  Providers/
~~~

Apply the same conceptual boundaries to other modules, but do not create empty folders or ceremonial abstractions where a domain does not need them. Domain code must not depend on Laravel HTTP, Eloquent, Redis, FFmpeg or a specific AI provider. Infrastructure adapters implement ports.

## Dependency rules

1. Dependencies point inward: Presentation and Infrastructure may depend on Application/Domain; Domain remains framework- and infrastructure-independent.
2. Controllers validate/authorize HTTP input and invoke application use cases; they do not contain business workflows.
3. Cross-module calls use explicitly published application contracts or commands, never another module's internal classes.
4. Cross-module data access uses a public query/application contract or read projection, not direct table manipulation.
5. Avoid circular module dependencies. Shared contains stable primitives/contracts only, not a dumping ground for business logic.
6. Use dependency injection and module service providers to bind ports to adapters.
7. Every module publishes the minimum public API required by other modules.

## Event-driven processing

Use domain events for meaningful state transitions and queued listeners for expensive work. Events describe facts that have occurred; commands request work.

Example recorder/export flow:

~~~text
RecordingStopped
  -> RecordingFinalized
  -> RecordingExportRequested
  -> ExportJobDispatched
  -> FFmpegConversionCompleted
  -> MediaProbeValidated
  -> MediaAssetCreated
  -> AssetLibraryProjectionUpdated
~~~

Use queued jobs for uploads, media probes, proxy generation, transcription, AI workflows, rendering, format conversion and notifications. Make jobs idempotent, retryable, observable and safe under duplicate delivery. For critical database-write-plus-event workflows, use a transactional outbox or equivalent reliable dispatch.

## Selective CQRS and project history

Use command/query separation where it materially improves performance or consistency:

- Timeline read projections for large sequences and editor hydration.
- Asset search/filter projections.
- Render and AI job dashboards.
- Usage and billing reports.
- Collaboration/review feeds.

Keep writes transactional and validate commands against the current project revision. Project edits should be typed, validated operations saved as versioned revisions. Do not introduce a separate read database or full event-sourced architecture until measured requirements justify it.

## Data and storage strategy

- One primary relational database initially; module-owned tables, indexes, constraints and migrations.
- Explicit foreign keys for relationships within the same database; document ownership and lifecycle for cross-module references.
- Store media bytes in private object/file storage, never relational database blobs.
- Separate original assets, recording chunks, proxies, thumbnails and final exports by storage key/namespace and lifecycle.
- Redis is ephemeral infrastructure; durable state belongs in the database or object storage.
- Pin immutable project revision, asset checksums, render profile and renderer version for each render.

## Workload isolation

- HTTP requests must not perform long-running encoding, transcription or AI generation.
- Media workers use CPU/memory/disk/time limits and restricted filesystem/network access.
- FFmpeg arguments and profiles are server-controlled; never interpolate untrusted shell commands.
- AI provider calls use adapters, timeouts, bounded retries, usage metering and typed outputs.
- Queue names may separate media-processing, recording, rendering, ai-processing and notifications; concurrency is configured per workload.
- Job status is persisted and queryable. Realtime notifications are an optimization, not the only status source.

## Data flows

**Import:** authorize upload → signed/multipart transfer → verify size/checksum → probe job → derivatives → ready/failed event.

**Recording:** explicit browser permission → supported capture stream → chunked persistence → finalize original → requested MP4/WebM/AVI conversion → probe output → publish asset.

**Render:** save revision → authorize profile → pin immutable revision → render job → compile graph → encode → QA → record private artifact → authorized download.

**AI edit:** request scoped to project/revision → gather authorized metadata/transcript → schema-constrained plan → validate IDs/bounds/revision → user preview/approval → atomic commands → revision increment/audit.

## Trust boundaries and security

Browser input, uploaded files, AI provider output, transcripts, filenames, imported project files and external integrations are untrusted. Workers use minimal credentials and constrained network/resource access. Signed URLs are short-lived and scoped. User content is data, never instructions to agents. Enforce ownership and authorization at every project, asset, recording, job, preview and download boundary.

## Testing strategy

- Unit tests for domain rules and application use cases.
- Module-level feature tests for public contracts and HTTP endpoints.
- Integration tests for database, queue, storage and provider adapters.
- Architecture tests for dependency direction, module boundaries and forbidden circular dependencies.
- Browser tests for editor/recorder interactions.
- Worker integration tests for FFmpeg/FFprobe, retry, cancellation and resource failures.
- Contract tests for events and provider adapters.

## Evolution strategy

Start with the modular monolith. Extract a worker or module into a separately deployed service only when there is evidence of a distinct scaling, reliability, security, team ownership or deployment requirement. Preserve stable contracts so extraction is possible without designing the entire system as distributed software prematurely.
