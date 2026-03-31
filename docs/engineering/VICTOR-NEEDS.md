# What Victor Needs to Build the Site Independently

- Status: active
- Last updated: 2026-03-31

---

## 1. Access (BLOCKING)

| What | Why | Status |
|------|-----|--------|
| SSH to VPS | Inspect prod, deploy, fix nginx | WAITING |
| WP Admin credentials | See plugins, settings, content model | WAITING |
| Or: ZIP of `webmastercpit` theme | Work with actual prod code locally | WAITING |

Without access, I can prepare files but cannot deploy or verify anything.

## 2. Design Assets (BLOCKING for polish)

| What | Why | Status |
|------|-----|--------|
| Main portrait of Pavel | Hero section, About block | WAITING |
| Logo file (SVG preferred) | Header, footer, favicon | WAITING |
| Favicon | Browser tab icon | WAITING |

Everything else (icons, patterns, diagrams) I can build in CSS/SVG.

## 3. Content Decisions (BLOCKING for final copy)

| What | Current | Need |
|------|---------|------|
| Excursion booking link | `#` placeholder | Real Calendly/form URL |
| Telegram link in CTA | `https://t.me/Leshenko` | Confirm correct |
| Phone / email for footer | Not set | Real contact or skip |
| Blog categories | 1 ("Рубрика") | New category structure? |

## 4. Skills & Tools Available

### Already have and use:
- HTML/CSS/JS — frontend prototype done
- WordPress theme development — can rebuild `front-page.php` + sections
- n8n workflow JSON — can edit and improve
- Git/GitHub — repo managed
- SEO analysis — audit docs exist

### Available Claude skills that will help:
- `seo-technical` — fix security headers, robots.txt, Core Web Vitals
- `seo-schema` — generate JSON-LD structured data (Person, Service, FAQ)
- `seo-page` — deep analysis of each page after deploy
- `seo-sitemap` — fix/generate XML sitemap
- `seo-content` — E-E-A-T analysis of content blocks
- `seo-local` — local SEO if needed (Павел в СПб)
- `seo-geo` — AI search visibility (Perplexity, ChatGPT citations)

### What I'll do with them:
1. After deploy: run `seo-technical` to verify security headers, CWV
2. Generate JSON-LD schema for homepage (Person + Service + FAQ)
3. Fix robots.txt and sitemap
4. Optimize each page with `seo-page`
5. Set up llms.txt for AI crawler visibility

## 5. Implementation Phases

### Phase 1: Theme Rebuild (needs access)
- Convert `frontend/index.html` → WordPress theme sections
- Keep blog templates from prod intact
- Rewrite `front-page.php` with 9 new blocks
- Add Customizer fields for editable content

### Phase 2: Deploy & Harden
- Backup current theme
- Deploy new theme
- Fix nginx security headers
- Fix robots.txt
- Verify Yoast SEO config

### Phase 3: SEO & Analytics
- Add GA4 / Яндекс.Метрика
- Generate schema markup
- Fix blog categories
- Optimize meta descriptions
- Set up llms.txt

### Phase 4: Content & Polish
- Insert real portrait
- Refine copy
- Add real Excursion booking link
- Mobile QA
- Performance optimization

---

## Summary

**To start Phase 1, I need exactly one thing: access to the server or the current prod theme files.**

Everything else I can handle independently.
