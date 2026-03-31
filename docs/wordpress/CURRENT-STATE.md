# WordPress: Current Production State

- Status: active
- Last updated: 2026-03-31
- Source of truth: yes

---

## Confirmed (by remote analysis)

| Parameter | Value |
|-----------|-------|
| URL | https://switchonai.ru |
| CMS | WordPress 6.9.4 |
| Active theme on prod | `webmastercpit` (custom) |
| SEO plugin | Yoast SEO v26.9 |
| Blog | 170+ posts at `/stati/` |
| Blog categories | 1 ("Рубрика") |
| PHP version | 8.3.7 (exposed in headers) |
| Protocol | HTTPS |
| Analytics | MonsterInsights installed, not configured |
| Content pipeline | n8n → Airtable → WP REST API |
| WP REST API credentials | Stored in n8n (HTTP Basic Auth, credential ID: TGgCUANEgvmWtUDK) |

## Known Issues

### Security
- [ ] Missing security headers: CSP, HSTS, X-Frame-Options
- [ ] `xmlrpc.php` open and accessible
- [ ] PHP version exposed in response headers
- [ ] WordPress version exposed

### SEO
- [ ] `robots.txt` blocks all URLs containing "page" (`Disallow: *page`)
- [ ] All 170+ posts in single category "Рубрика"
- [ ] GA4 / Яндекс.Метрика not confirmed

### Theme
- [ ] Active prod theme `webmastercpit` ≠ repo theme `wordpress-theme/`
- [ ] Repo theme is January dark design, needs full rebuild for March light direction
- [ ] Blog template coverage on prod unknown

## Not Confirmed (needs VPS/admin access)

- Exact plugin list on prod
- How `webmastercpit` theme is structured (files, templates)
- Backup / rollback / staging setup
- Cache layer (plugin or server-level)
- Editor workflow in admin
- Custom post types, ACF fields, taxonomies
- SSL certificate config
- Nginx or Apache
- Email / form handler
- CDN

## What We Need

1. **SSH access to VPS** — to inspect theme files, nginx config, plugins
2. **WP Admin access** — to see active plugins, settings, content model
3. **Or: download `webmastercpit` theme** — ZIP from `/wp-content/themes/webmastercpit/` so we can work with real prod code

## Deployment Plan (after access)

1. Backup current theme
2. Rebuild `webmastercpit` to match `frontend/index.html` (light design)
3. Keep blog templates intact
4. Test locally → deploy to prod
5. Fix security headers (nginx config)
6. Fix robots.txt
7. Configure analytics

---

## Related Docs

- `WORDPRESS-AUDIT.md` — full code audit of repo theme
- `WORDPRESS-ARCHITECTURE.md` — architecture decisions
- `THEME-STRUCTURE.md` — template hierarchy
- `VPS-DEPLOYMENT-AND-MAINTENANCE.md` — deploy/ops guide
- `PLUGIN-AUDIT.md` — plugin recommendations
- `BLOG-SEO-STRUCTURE.md` — blog SEO plan
- `CONTENT-MODEL.md` — content model strategy
