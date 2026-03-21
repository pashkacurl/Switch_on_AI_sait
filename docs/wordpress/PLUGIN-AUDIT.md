# Plugin Audit

- Purpose: Зафиксировать, что известно и неизвестно о плагинах.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/wordpress/VPS-DEPLOYMENT-AND-MAINTENANCE.md`

## Confirmed In Code

- none

## Inferred From Legacy CSS

| Plugin / Feature | Evidence | Confidence |
|---|---|---|
| Contact Form 7 | `wpcf7-*` classes in legacy CSS | medium |
| Carousel plugin (`wpcp`) | `wpcp-carousel-*` classes in legacy CSS | low-medium |

## Mentioned In Legacy Docs, Not Confirmed

- Elementor Pro
- Astra
- Rank Math
- WP Rocket / LiteSpeed Cache
- Yoast SEO
- WP Super Cache
- Wordfence
- Redirection
- UpdraftPlus

## Working Rule

Ни один плагин из старых docs не считать установленным, пока это не подтверждено из админки или продового окружения.

## Plugin Strategy For V1

- SEO: ровно один SEO plugin.
- Forms: ровно один forms plugin.
- Cache: ровно один основной caching layer, согласованный с сервером.
- Security/backups: избегать дублирующих решений.

## Recommendation

Сначала снять фактический plugin inventory с прода или staging, затем:

1. пометить must-keep;
2. пометить redundant;
3. пометить replace-later;
4. сформировать final plugin policy.
