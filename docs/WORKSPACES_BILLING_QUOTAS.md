# Workspaces, Plans, Billing, and Quotas

**Status:** Future product design; billing and multi-tenancy are not implemented in the inspected baseline.

## Workspace model
A user may own or join one or more workspaces. Every project, asset, AI task, render, template, and shared resource is scoped to a workspace. Membership roles are owner, admin, editor, and viewer; permissions are explicit policy checks, not UI-only hiding.

## Plan dimensions
Potential entitlements: member seats, active projects, storage bytes, upload size, source duration, render minutes/concurrency, export resolution, AI minutes/credits, retention, and shared libraries. Keep entitlements in configuration/database, not scattered conditionals.

## Metering
Record immutable usage events with workspace, actor, resource, quantity, unit, timestamp, and idempotency key. Separate reserved, consumed, released, and refunded usage. Render retries must not double-charge. Define when failed/cancelled work is billable.

## Billing lifecycle
Plan catalog → checkout/provider confirmation → subscription state → entitlement update → usage metering → invoice/renewal → cancellation/dunning. Verify provider webhooks cryptographically, handle duplicates/out-of-order events, and reconcile periodically.

## Quota enforcement
Reserve quota before expensive uploads, AI calls, and renders. Release reservations on terminal failure/cancellation. Enforce server-side on every API/job boundary. Provide clear quota errors and usage visibility.

## Data lifecycle
Downgrade and cancellation policies must define grace periods, read-only behavior, export access, deletion windows, and retention. Never delete customer media immediately on a failed payment without a published policy and recovery window.

## Release boundary
Do not add paid plans, checkout, or metering until workspace authorization, usage accounting, webhook verification, and tests are in place.
