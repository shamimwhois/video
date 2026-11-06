# Current Repository State

**Audit baseline:** `main`, inspected 2026-11-06.  
**Repository:** `shamimwhois/video`

## Verified repository facts

| Area | Observed state |
|---|---|
| Backend | Laravel `^13.17` declared in composer.json |
| PHP requirement | `^8.3` declared in composer.json |
| Agent instruction conflict | `AGENTS.md` says PHP 8.5; it conflicts with composer.json and must be reconciled |
| PHP test framework | Pest `^5.3`, Laravel Pest plugin `^5.0` |
| Frontend build | Vite `^8`, Laravel Vite plugin `^3.1`, Tailwind CSS `^4` |
| JavaScript app entry | `resources/js/app.js` is currently empty |
| Authentication | Login, registration, logout routes/controllers and Blade views exist |
| Existing product domain | User and Post models |
| Database | Users, cache, jobs, posts migrations |
| Factories/seeders | UserFactory, PostFactory, PostSeeder; DatabaseSeeder currently has an empty run method |
| Public routes | Home page, login/register, logout, public post show |
| Authenticated routes | Post resource routes except show |
| Media storage | PostController stores uploaded videos on Laravel's `public` disk |
| Editor workspace | Not found in inspected source tree |
| Project/sequence/timeline model | Not found |
| FFmpeg/FFprobe integration | Not found in composer/package manifests or inspected application source |
| AI provider/orchestration | Not found in inspected application source |
| Render/export jobs | Not found |
| Workspace/billing/collaboration | Not found |
| Automated tests | Example and post-management feature tests plus example unit test exist |

## Existing behavior
- `GET /` renders a public video-post listing.
- Guests can register and log in.
- Authenticated users manage posts through resource routes.
- A post references a video path stored on the public filesystem disk.
- Post authorization is implemented through a policy/Gate.

## Documentation audit findings
- Root `README.md` was still the default Laravel skeleton guide; replace it with product-specific setup and architecture guidance.
- `AGENTS.md` has a PHP 8.5 requirement inconsistent with composer.json's PHP `^8.3`.
- The current Blade layout uses Tailwind CDN and Alpine CDN while Vite/Tailwind dependencies are declared. Establish one deliberate frontend asset strategy before editor implementation.
- Current public video-post storage is not an acceptable default for private customer editing projects. Preserve existing behavior until a migration and access-control plan is reviewed; new editor assets must be private.
- DatabaseSeeder's run method is empty; do not assume demo data is seeded.
- Existing route/model names describe a video-post application, not the target editing project domain.

## Important implementation guardrails
- Preserve working authentication and post routes unless a reviewed migration plan replaces them.
- Do not reinterpret the posts table as projects or assets.
- Do not expose new source media or exports publicly by default.
- Never run FFmpeg/transcoding in HTTP request workers.
- Never execute model-generated shell commands, SQL, paths, scripts, or raw FFmpeg filters.
- Use isolated media workers and typed, validated editing operations.
- Keep existing public-post behavior separate from private editor assets until product requirements explicitly unify them.

## Status evidence rule
Mark a capability **Implemented** only after code exists, relevant tests pass, and its user-visible workflow is verified. Record commit/PR references, commands, and test results. Documentation, mockups, and unrelated passing tests are not implementation evidence.
