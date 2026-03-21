# Content Model

- Purpose: Модель контента для сайта и блога в WordPress.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/03-sitemap-and-page-briefs.md`, `docs/wordpress/BLOG-SEO-STRUCTURE.md`

## Core Entities

| Entity | WP Type | Editable In Admin | Notes |
|---|---|---|---|
| Home | Page | yes | primary marketing route |
| Product | Page | yes | AI-контент-система |
| How It Works | Page | yes | methodology/process |
| Cases / Proof | Page initially | yes | later can become CPT |
| About | Page | yes | founder trust layer |
| FAQ | Page or section data | yes | can live inside pages |
| Contact / Excursion | Page | yes | conversion route |
| Blog posts | Post | yes | SEO and trust engine |

## Global Data

Нужно редактировать централизованно:

- contact data;
- primary CTA label + URL;
- social links;
- legal company details;
- global proof disclaimer text;
- default section-level labels if reused.

## Cases Strategy

### V1

- one dedicated page with structured repeatable proof blocks

### Later

- CPT `case`
- taxonomy by segment / industry / result type

## What Must Not Stay Hardcoded

- key product copy;
- CTA destinations;
- proof claims;
- founder bio;
- FAQ data;
- contact/legal data.

## Editorial Principle

Редактор должен править смысл и контент в админке.  
Код должен править структуру, presentation и логику повторяемых блоков.
