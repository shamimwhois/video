# Collaboration and Sharing

**Status:** P2; not implemented in current repository baseline.

## Roles
Owner manages workspace lifecycle/billing; admin manages members and settings; editor edits assigned projects; viewer can preview and download only when permitted. Define resource-level permissions for export, AI usage, media deletion, and project sharing.

## Sharing
Support private-by-default projects. Optional share links require random unguessable tokens, revocation, expiry, password/identity restrictions where applicable, and explicit scopes (view, comment, download). Do not expose original storage URLs.

## Comments and review
Comments may target project revision, sequence time, track, or clip. Store stable references and handle deleted/moved targets gracefully. Review states: draft, in review, changes requested, approved. Approval must reference an immutable revision.

## Concurrent editing
Initial collaboration can use optimistic concurrency and explicit conflict resolution. Real-time co-editing is deferred until operation transformation/CRDT semantics are designed and tested. Presence indicators are not proof of lock ownership.

## Notifications
Use private channels and user preferences. Avoid broadcasting transcript text, private URLs, or sensitive project metadata. Deliver email/in-app notifications idempotently.
