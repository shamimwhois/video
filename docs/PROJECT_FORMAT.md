# Project Format and Persistence

## Goals

Portable, versioned, deterministic project documents that store references and edit instructions, never media bytes.

## Example envelope

```json
{
  "schemaVersion": 1,
  "projectId": "project_ulid",
  "name": "Tutorial project",
  "revision": 1,
  "assets": [],
  "sequences": [],
  "createdAt": "2026-11-06T00:00:00Z",
  "updatedAt": "2026-11-06T00:00:00Z"
}
```

## Sequence

Stores dimensions, rational frame rate, audio settings, background, tracks, markers, duration. Clip stores stable ID, asset reference, type, timeline start/duration, source in/out, speed, transform, opacity, audio settings, effects, transitions, and keyframes.

## Persistence

PostgreSQL stores metadata and JSONB revision snapshots. Object storage stores assets. A revision is immutable after commit. Autosave uses optimistic concurrency. Periodic snapshots and operation logs support recovery. Schema migrations are explicit and tested.

## Portable import/export

An optional project package contains project JSON and asset manifest; media inclusion is optional and permission/quota controlled. Validate package size, schema version, IDs, and manifest before import.
