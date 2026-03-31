# CLAUDE.md

## Project Overview

Website for **"ВКЛЮЧИ ИИ" (Switch On AI)** — AI-контент-системы для предпринимателей и экспертов.
Автор: Павел Лещенко (@Leshenko). Домен: `switchonai.ru`.

## Current State (March 2026)

### Production Site
- **URL:** https://switchonai.ru
- **CMS:** WordPress 6.9.4 on VPS
- **Active theme on prod:** `webmastercpit` (custom, fully coded, no page builders)
- **Blog:** 170+ posts at `/stati/`, single category "Рубрика"
- **SEO:** Yoast SEO v26.9
- **Content pipeline:** n8n → Airtable → WordPress REST API
- **Issues:** missing security headers, xmlrpc.php open, robots.txt blocks pages with "page"

### Design Direction (approved March 2026)
- **Light-first**, not dark-tech
- Palette: `#F5F6FA` bg, `#4BD392` green CTA, `#2F80ED` blue accents
- Fonts: Manrope (headings), Inter (body), Space Grotesk (eyebrow), JetBrains Mono (code)
- Visual direction doc: `docs/design/site-visual-direction.md`

### WordPress Theme in Repo
- `wordpress-theme/` — custom classic theme (January dark version, needs rebuild to match new design)
- Vanilla CSS + vanilla JS, no build tools, no Composer
- Blog templates exist but need verification against prod

## Repository Structure

```
.
├── frontend/            # Current HTML prototype (light design, 9 blocks)
│   └── index.html       # ← Active main page prototype
│
├── wordpress-theme/     # WP theme (needs update to match new design)
│
├── docs/                # Active documentation (source of truth)
│   ├── START-HERE.md    # Entry point
│   ├── content/         # Content architecture
│   ├── design/          # Visual direction, design system
│   ├── engineering/     # Implementation handoff
│   ├── research/        # Competitor analysis, repo audit
│   ├── seo/             # SEO audit, action plans
│   ├── strategy/        # Funnel strategy
│   └── wordpress/       # WP audit, architecture, deployment
│
├── n8n/                 # n8n workflows for content automation
│   ├── workflows/       # JSON workflow files
│   └── README.md        # Status of 12 enhancements
│
├── iSite/               # Brand library (strategy, branding, media)
│   ├── 03_Брендинг/     # Brandbook PDF
│   └── 05_Медиа/        # Portraits, logos, backgrounds, covers
│
├── ВКЛЮЧИ ИИ/           # Marketing knowledge base (positioning, content, skills)
│
├── _archive/            # Legacy artifacts (January dark prototype, old docs)
│
└── README.md
```

## Key Documents

| What | Where |
|------|-------|
| Entry point | `docs/START-HERE.md` |
| Content blocks (9 sections) | `docs/content/site-content-architecture.md` |
| Visual direction | `docs/design/site-visual-direction.md` |
| Design principles | `docs/05-design-principles.md` |
| Funnel strategy | `docs/strategy/site-funnel-strategy.md` |
| WordPress audit | `docs/wordpress/WORDPRESS-AUDIT.md` |
| Technical plan | `docs/06-technical-implementation-plan.md` |
| SEO audit | `docs/seo/FULL-AUDIT-REPORT.md` |
| Positioning & offer | `ВКЛЮЧИ ИИ/Маркетинг/ОФФЕР v6.0.md` |
| Founder persona | `ВКЛЮЧИ ИИ/Я/Моя распаковка (про бизнес).md` |

## Development Workflow

No build tools. Manual workflow:
1. Edit theme files locally
2. Upload to WordPress server (FTP / ZIP via WP Admin)
3. Activate theme, test in browser

## What Needs to Happen Next

1. Get VPS/WP admin access to verify prod state
2. Rebuild `wordpress-theme/` to match `frontend/index.html` (light design)
3. Complete blog template coverage
4. Deploy updated theme to prod
5. Configure security headers, fix robots.txt
