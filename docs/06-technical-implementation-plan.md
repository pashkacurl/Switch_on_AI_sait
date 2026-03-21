# Technical Implementation Plan

- Purpose: Общий техплан реализации сайта и связанной системы.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/wordpress/WORDPRESS-ARCHITECTURE.md`, `docs/07-seo-analytics-cro-plan.md`

## Current Stack

- WordPress
- custom classic theme in `wordpress-theme/`
- vanilla CSS + vanilla JS
- no build tooling
- no Composer
- no evidence of active structured plugin architecture in repo

## Recommended V1 Architecture

### Keep

- WordPress as main platform
- custom theme as primary presentation layer
- blog and marketing site inside one WP ecosystem

### Add / Improve

- complete template coverage for posts, pages, archives and blog index
- structured content model
- reusable section patterns
- lightweight analytics/event layer
- legal/contact templates

## Content / Data Model Strategy

- `Pages` for core marketing pages
- `Posts` for blog
- optional CPT later for `Cases`, if proof library grows
- taxonomies:
  - blog categories;
  - blog tags;
  - optional use-case taxonomy later
- options / settings for global brand and contact data
- structured fields for page modules where editing must be predictable

## Forms And Lead Capture

- Main route: Excursion request
- Required fields: name, contact, business context, current content challenge
- Required events: form_start, form_submit, click_excursion, click_secondary_cta
- Post-submit: thank-you state + routing into manual or bot-assisted follow-up

## Integrations

- analytics: GA4 and/or Я.Метрика
- optional GTM for event governance
- email or CRM handoff
- Telegram notification or lightweight ops inbox

## Performance Baseline

- light visual system
- no heavy 3D dependency for v1
- optimized images
- minimized script footprint
- avoid plugin bloat

## Accessibility Baseline

- semantic heading order
- focus states
- contrast-safe CTA
- keyboard-safe forms and accordions
- no motion-only comprehension

## Risk Areas

- current theme does not cover blog templates properly
- content is still mostly hardcoded in theme sections
- legacy docs can pull implementation in wrong direction
- current live setup unknowns can break rollout assumptions

## Quick Wins

1. Fix template coverage in theme.
2. Remove unverified proof claims from theme copy.
3. Move marketing copy into editable WP model.
4. Add explicit CTA tracking.
