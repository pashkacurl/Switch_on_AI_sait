# VPS Deployment And Maintenance

- Purpose: Безопасный rollout, поддержка и изменения на WordPress/VPS.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/08-launch-roadmap.md`, `docs/wordpress/PLUGIN-AUDIT.md`

## What Must Be Confirmed

- current host OS / stack
- PHP version
- web server
- active caching layer
- backup policy
- restore policy
- staging availability
- monitoring / alerts

## Safe Rollout Principle

Перед любым заметным изменением:

1. backup files and database;
2. verify rollback path;
3. test on staging or isolated copy if possible;
4. only then deploy to production.

## Minimum Operational Policy

- daily database backups
- regular file backups
- tested restore procedure
- plugin/theme updates through controlled window
- changelog for releases

## Release Sequence

1. Prepare change set locally
2. Backup production
3. Deploy theme changes
4. Verify templates, forms, blog, CTA, analytics
5. Keep rollback bundle ready

## Rollback Checklist

- previous theme zip or file snapshot
- database snapshot timestamp
- list of changed files
- clear revert steps

## Security Baseline

- strong admin passwords
- 2FA for admin accounts
- limited admin roles
- least-privilege editing access
- update cadence for core/plugins/theme

## Performance Baseline

- image optimization
- page caching
- minimal JS
- avoid redundant plugins
- measure mobile first

## Current Limitation

Локальный репозиторий не дает прямого подтверждения этих настроек.  
Значит до доступа к админке/VPS все rollout assumptions — предварительные и должны быть помечены как такие.
