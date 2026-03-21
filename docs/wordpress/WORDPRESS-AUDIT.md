# WordPress Audit

- Purpose: Сводный аудит текущей WordPress-части по локальным данным.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/wordpress/WORDPRESS-ARCHITECTURE.md`, `docs/06-technical-implementation-plan.md`

## What Is Confirmed

- В репозитории есть кастомная standalone classic theme: `wordpress-theme/`.
- Это не block theme, не child theme, не Elementor layout export.
- Тема ориентирована почти полностью на маркетинговую главную:
  `front-page.php` + `template-parts/section-*.php`.
- Редактируемость через админку минимальная:
  - hero title;
  - hero subtitle;
  - hero description;
  - contact data;
  - social URLs;
  - footer widgets.

## What Is Broken Or Incomplete

- Theme coverage для обычных WP-маршрутов почти отсутствует.
- `index.php` вызывает `template-parts/content-*`, которых в репозитории нет.
- Нет `page.php`, `single.php`, `home.php`, `archive.php`, `search.php`.
- Значит страница постов, отдельные записи и архивы в текущей теме либо не покрыты, либо будут вести себя пусто/ломко.

## Blog Reality By Local Evidence

- В `Действующий сайт/main-style.css` присутствует большой legacy слой блога:
  - archive;
  - single;
  - sidebar;
  - pagination;
  - breadcrumbs;
  - related posts.
- Там же есть признаки plugin-specific styling:
  - `wpcf7-*` classes;
  - `wpcp-carousel-*` classes.
- Локальный вывод: блоговая часть, скорее всего, живет либо на старой теме/слое, либо была построена в другом поколении проекта, не в текущей кастомной теме.

## Code Risks

- Почти весь маркетинговый контент в секциях захардкожен.
- В теме есть placeholder links и generic anchors.
- В JS smooth scroll вешается на все `a[href^="#"]`; при `href="#"` это легко превращается в JS edge case.
- В теме присутствуют неподтвержденные proof claims, конфликтующие с активной стратегией.

## Documentation Risks

- Старые docs все еще указывают на `Astra + Elementor`, что противоречит реальному коду.
- Без formal SoT легко принять неправильное решение по стеку или способу редактирования.

## Unknown Without Admin / VPS Access

- Какая тема реально активна на проде.
- Какие плагины реально установлены.
- Есть ли CPT, taxonomies, ACF, forms plugin, SEO plugin.
- Как устроены cache, backup, rollback, monitoring.
- Какой реальный editor workflow на проде.

## Audit Conclusion

WordPress не требует переписывания или ухода с платформы.  
Но требует немедленного перехода от `front-page-only theme` к `working site theme`, где есть:

1. минимально полное template coverage;
2. управляемый контент;
3. согласованная связь сайта и блога;
4. подтвержденный plugin + VPS layer.
