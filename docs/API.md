# API Contract — v1

Authenticated unless explicitly public. Every nested resource must be authorized against workspace/project membership.

## Error envelope

```json
{
  "error": {
    "code": "validation_failed",
    "message": "The request could not be processed.",
    "details": {},
    "requestId": "req_ulid"
  }
}
```

## Projects

- GET/POST `/api/v1/projects`
- GET/PATCH/DELETE `/api/v1/projects/{project}`
- GET `/api/v1/projects/{project}/revisions/{revision}`
- GET/PUT `/api/v1/projects/{project}/sequence` (PUT requires expected revision)

## Assets

- POST `/api/v1/projects/{project}/uploads`
- POST `/api/v1/uploads/{upload}/complete`
- GET `/api/v1/projects/{project}/assets`
- GET/DELETE `/api/v1/assets/{asset}`
- POST `/api/v1/assets/{asset}/retry-processing`

Upload response returns scoped private storage instructions, never a permanent public object URL.

## Editing

- GET `/api/v1/projects/{project}/sequence`
- PUT `/api/v1/projects/{project}/sequence`
- POST `/api/v1/projects/{project}/operations`
- GET `/api/v1/projects/{project}/operations`

Stale writes return HTTP 409 with current revision metadata.

## AI

- POST `/api/v1/projects/{project}/ai-tasks`
- GET `/api/v1/ai-tasks/{task}`
- GET `/api/v1/ai-tasks/{task}/plan`
- POST `/api/v1/ai-plans/{plan}/validate`
- POST `/api/v1/ai-plans/{plan}/approve`
- POST `/api/v1/ai-plans/{plan}/reject`

Approval names selected operation IDs and expected revision; it is explicit and idempotent.

## Render

- POST `/api/v1/projects/{project}/renders`
- GET `/api/v1/renders/{render}`
- POST `/api/v1/renders/{render}/cancel`
- GET `/api/v1/renders/{render}/download`

Render pins immutable revision and allowed profile.

## Events and idempotency

Private events: asset.processing.updated, ai.task.updated, render.progress, render.completed. No credentials or permanent URLs. Use cursor pagination and idempotency keys for upload completion, plan approval, and render creation. Rate-limit expensive operations.
