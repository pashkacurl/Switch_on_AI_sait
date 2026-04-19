# Дизайн-бриф: Референс tochkicamp.ru — что берём, что адаптируем, что отклоняем

- Автор: Джейн, дизайнер команды БАНДА
- Дата: 2026-04-03
- Статус: ready for review
- Контекст: Павлу понравился tochkicamp.ru. Этот бриф фиксирует, как адаптировать его язык к утверждённому направлению «Включи ИИ», не ломая conversion-first основу.
- Исходное направление: `docs/design/site-visual-direction.md`, `docs/05-design-principles.md`

---

## 1. Что берём из tochkicamp.ru и как адаптируем

### Берём: Карточная система с дышащими отступами

tochkicamp делает одно важное: он не боится пространства. Карточки не прижаты друг к другу, между ними живёт воздух. Сетка не пытается уместить как можно больше — она уважает читателя.

Это точно совпадает с нашим принципом: «Если сомневаемся — добавляем воздуха, а не декора».

**Адаптация:** Оставляем нашу 12-col grid, но увеличиваем gap между карточками с текущих 24px до 28–32px. Card padding расширяем до 32–36px для продуктовых карточек. max-width контейнера — 1100–1200px, как сейчас.

### Берём: Scroll-reveal анимации (облегчённая версия)

У tochkicamp приятная анимация появления: opacity 0→1 + translateY 40→0. Это не тяжело, не раздражает, помогает ритму страницы.

**Адаптация:** Это уже разрешено нашими motion principles. Реализуем через Intersection Observer, задержка stagger 80–120ms между карточками. Easing: `cubic-bezier(0.25, 0.1, 0.25, 1)`. Длительность: 420–480ms. translateY не больше 30px (у tochkicamp 40px — чуть много для нашего регистра).

### Берём: Hover на карточках с translateY

У tochkicamp карточки слегка поднимаются при hover + получают тень. Это деликатно и правильно — даёт ощущение интерактивности без агрессии.

**Адаптация:** В текущем prototype уже есть `translateY(-2px)`. Усиливаем до `-4px` + shadow stronger. Но только для продуктовых карточек, не для информационных текстовых блоков.

### Берём: Моноширинный акцент в типографике

IBM Plex Mono у tochkicamp создаёт технологичный характер без dark-tech давления. Это умный ход: mono не требует тёмного фона, оно работает на светлом.

**Адаптация:** У нас уже есть JetBrains Mono для code/prompt/схем. Расширяем его применение: использовать для eyebrow-лейблов в блоках с числами и метриками, для step-счётчиков в процессном блоке, для тегов / категорий. Не заменять Manrope как основной heading-шрифт.

### Берём: Outline CTA на тёмных секциях

У tochkicamp на тёмных фонах используются outline-кнопки: transparent bg + solid border. При hover — заливка. Это чисто, не агрессивно, хорошо читается.

**Адаптация:** Применять только в секциях на тёмном фоне (hero-dark вариант, финальный CTA). На светлом фоне — наш solid green primary button остаётся.

### Берём: FAQ с +/− иконками

Аккордеонный FAQ с иконкой плюс/минус — это чистая, понятная механика без лишних украшений. У tochkicamp это работает хорошо.

**Адаптация:** Реализовать FAQ через этот паттерн. Иконки inline, анимация раскрытия max-height + opacity через transition. Наш текущий design-direction уже предписывает FAQ делать «максимально просто».

---

## 2. Что НЕ берём из tochkicamp и почему

### Не берём: Тёмный фон #111111 как базовый

tochkicamp стоит на тёмной основе. Для «Включи ИИ» это противоречит двум задокументированным решениям:

1. `05-design-principles.md`: «Нельзя возвращаться в January dark-tech как в основной стиль без переутверждения стратегии».
2. `site-visual-direction.md`: «Основной режим — light-dominant. Сайт должен ощущаться чисто, дорого, но без премиального пафоса».

Тёмный фон отлично работает для creative studio с аудиторией дизайнеров. Аудитория «Включи ИИ» — предприниматели и эксперты, которым нужно доверие, ясность и ощущение системного порядка. Светлый фон здесь конвертирует лучше.

**Тёмное оставляем только как punctuation:** hero dark-версия (опционально), финальный CTA.

### Не берём: Неоновый жёлтый #EFFF3E как системный акцент

Жёлтый tochkicamp — это узнаваемый brand color той студии. У «Включи ИИ» уже есть собственный акцент — зелёный `#4BD392` + синий `#2F80ED`. Менять их без переутверждения стратегии нельзя: они прошиты в позиционировании («включение», «рост», «AI-энергия»).

Жёлтый также хуже работает как CTA-цвет в нашем контексте: у зелёного выше ассоциация с «действием» и «подтверждением».

**Что делаем вместо:** Добавляем тёплый тон через amber/warm-beige как accent-highlight на тёмных секциях (уже предусмотрен `--accent-amber-soft: #FFF2CC`). На тёмном фоне у кнопок можно добавить мягкий glow в зелёном спектре — визуально похожий эффект, но в нашем цвете.

### Не берём: Бежевые карточки #F9F7F1 как основу

Тёплые бежевые хорошо работают с тёмным фоном tochkicamp — они создают контраст фактуры. На светлом фоне #F5F6FA бежевые карточки теряют четкость и дают эффект «пожелтевшей бумаги», который противоречит нашему «чисто и технологично».

Белые карточки на нашем page-bg дают нужный контраст без ощущения архаичности.

### Не берём: Hover rotate(-1deg) на кнопках

Поворот кнопки при hover — характерный quirky-приём, хорошо работающий в playful-брендах (creatives, games, edu-camps). Для «Включи ИИ» это вносит ощущение несерьёзности, которое противоречит регистру «взрослый, системный, экспертный».

Наш hover: translateY(-1px) + shadow glow. Это достаточно.

### Не берём: Стиль «аналоговые скетчи + бумажные текстуры»

Ч/б фото в сепии, бумажные текстуры, hand-drawn элементы — это эстетика, которая у tochkicamp подчёркивает «живое, ручное, творческое». У «Включи ИИ» противоположная задача: передать технологичность, системность, автоматизацию. Аналоговая эстетика будет работать против позиционирования.

**Что делаем вместо:** Если нужна теплота (а она нужна, чтобы не улететь в cold-tech) — через качественный портрет Павла, через живые цитаты клиентов, через разговорный tone of voice в текстах. Но не через визуальные текстуры.

---

## 3. Обновлённая палитра

Базовая палитра из `site-visual-direction.md` остаётся source of truth. Добавляем несколько уточнений по мотивам референса.

```css
:root {
  /* === ФОНЫ === */
  --bg-page:        #F5F6FA;   /* основной фон страницы — светло-серый */
  --bg-surface:     #FFFFFF;   /* поверхность карточек */
  --bg-soft:        #EEF2F7;   /* мягкий альтернативный фон секций */
  --bg-warm:        #FAF8F4;   /* NEW: тёплый светлый фон для founder/about блоков */
  --bg-dark:        #1C1F33;   /* тёмные секции (hero dark / final CTA) */
  --bg-dark-2:      #162A40;   /* глубокий тёмный для hero overlay */

  /* === ТЕКСТ === */
  --text-primary:          #111827;
  --text-secondary:        #6B7280;
  --text-on-dark:          #FFFFFF;
  --text-on-dark-secondary: rgba(255,255,255,0.68);

  /* === АКЦЕНТЫ === */
  --accent-green:       #4BD392;   /* primary CTA — зелёный */
  --accent-green-hover: #3BB87D;
  --accent-green-glow:  rgba(75, 211, 146, 0.28);   /* для glow-эффектов на тёмном */
  --accent-green-text:  #102018;   /* тёмный текст на зелёной кнопке */

  --accent-blue:      #2F80ED;   /* interactive / links / info */
  --accent-blue-soft: #E8F1FF;
  --accent-mint-soft: #DDF8EC;

  /* NEW: тёплый amber — только для micro-highlights, не как системный цвет */
  --accent-warm:      #F5D87A;   /* адаптация жёлтого tochkicamp в нашу теплоту */
  --accent-amber-soft:#FFF2CC;

  /* === ГРАНИЦЫ === */
  --border-soft:   #E5E7EB;
  --border-strong: #D1D5DB;

  /* === ШРИФТЫ === */
  --font-heading:  'Manrope', sans-serif;
  --font-accent:   'Space Grotesk', sans-serif;
  --font-body:     'Inter', sans-serif;
  --font-mono:     'JetBrains Mono', monospace;   /* расширяем применение */

  /* === РАДИУСЫ === */
  --radius-sm: 12px;
  --radius-md: 18px;
  --radius-lg: 24px;
  --radius-xl: 32px;   /* NEW: для крупных hero-элементов */

  /* === ТЕНИ === */
  --shadow-card:       0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.03);
  --shadow-card-hover: 0 6px 24px rgba(0,0,0,0.10), 0 2px 6px rgba(0,0,0,0.05);
  --shadow-glow-green: 0 4px 20px rgba(75,211,146,0.30);   /* для CTA на тёмном */

  /* === АНИМАЦИИ === */
  --transition:       0.25s ease;
  --transition-slow:  0.42s cubic-bezier(0.25, 0.1, 0.25, 1);   /* scroll-reveal */
}
```

**Логика применения --accent-warm (#F5D87A):**
- маленькие highlight-бейджи на тёмных секциях;
- иконка-акцент в step-счётчике или proof-метрике;
- не использовать как фон кнопок, не использовать на светлом фоне — будет смотреться как желтуха.

---

## 4. Типографика — шрифты, размеры, иерархия

### Шрифтовая пара (без изменений относительно site-visual-direction)

| Роль | Шрифт | Где |
|------|-------|-----|
| Heading | Manrope 700/800 | H1–H4, section titles |
| Accent label | Space Grotesk 600 | eyebrow, nav, pill-badges |
| Body | Inter 400/500 | основной текст, описания |
| Mono | JetBrains Mono 400/500 | **расширенное применение** (см. ниже) |

### Расширенное применение JetBrains Mono (inspired by tochkicamp)

Добавляем mono в: step-числа (01, 02, 03...), метрики и цифры в proof-блоках, теги / категории статей, placeholder-текст в схемах процесса.

Пример:
```css
.step__number {
  font-family: var(--font-mono);
  font-size: 13px;
  font-weight: 500;
  letter-spacing: 0.05em;
  color: var(--accent-green);
}
```

### Размерная шкала (desktop / mobile)

| Элемент | Desktop | Mobile | Weight | Leading |
|---------|---------|--------|--------|---------|
| H1 | clamp(36px, 5vw, 60px) | 34–38px | 800 | 1.05 |
| H2 | clamp(30px, 4vw, 46px) | 28–32px | 700 | 1.1 |
| H3 | clamp(22px, 2.5vw, 30px) | 22–24px | 700 | 1.15 |
| H4 | clamp(18px, 2vw, 22px) | 18px | 700 | 1.2 |
| Eyebrow | 12–13px | 12px | 600 | — |
| Body L | 19–20px | 17px | 400 | 1.6 |
| Body | 16–17px | 16px | 400 | 1.65 |
| Small | 14px | 14px | 400 | 1.5 |
| Mono accent | 12–14px | 12px | 500 | — |

### Правила набора

- Eyebrow — uppercase, letter-spacing 0.10em, цвет `--accent-blue` на светлом или `--accent-warm` на тёмном.
- H1 — letter-spacing `-0.02em`, максимум 4 строки.
- Ни один заголовок не должен конкурировать с CTA-кнопкой за внимание.
- Mono-числа в proof-блоках: цвет `--accent-green`, размер 28–40px.

---

## 5. Стиль карточек и контейнеров

### Base Card (светлые секции)

```css
.card {
  background: var(--bg-surface);                  /* белая */
  border: 1px solid var(--border-soft);
  border-radius: var(--radius-lg);                /* 24px */
  padding: 32px;                                  /* увеличено с 28px */
  box-shadow: var(--shadow-card);
  transition: transform var(--transition), box-shadow var(--transition);
}

.card:hover {
  transform: translateY(-4px);                    /* усилено с -2px, inspired by tochkicamp */
  box-shadow: var(--shadow-card-hover);
}
```

### Product Card (направления: AI-команда, Экскурсия, Клуб...)

Чуть более выразительный вариант. Допускается слабый tinted gradient сверху.

```css
.card--product {
  background: linear-gradient(160deg, #FFFFFF 60%, var(--accent-mint-soft) 100%);
  border: 1px solid var(--border-soft);
  border-radius: var(--radius-xl);                /* 32px */
  padding: 36px 32px;
}
```

На тёмных секциях — карточки с полупрозрачным фоном:

```css
.card--on-dark {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.12);
  backdrop-filter: blur(12px);
  border-radius: var(--radius-lg);
}
```

### Контейнеры

- Основной контейнер: `max-width: 1200px`, padding `0 24px`
- Narrow (текстовые блоки): `max-width: 820px`
- Card grid gap: `28–32px` (было 24px)
- Section padding desktop: `96–120px 0`
- Section padding mobile: `56–72px 0`

### Что НЕ делаем с карточками

- Не glassmorphism как главный стиль (только точечно на тёмном hero).
- Не тяжёлые неоновые обводки.
- Не бежевые (#F9F7F1) карточки на светлом фоне — только белые.

---

## 6. Анимации и hover-эффекты

### Scroll-reveal

Реализуется через IntersectionObserver (vanilla JS, без библиотек):

```css
.reveal {
  opacity: 0;
  transform: translateY(28px);
  transition: opacity var(--transition-slow), transform var(--transition-slow);
}

.reveal.visible {
  opacity: 1;
  transform: translateY(0);
}
```

Stagger для card-групп: задержка `transition-delay` 0ms / 80ms / 160ms / 240ms по порядку.

Порог срабатывания: `threshold: 0.12` (появляется, когда 12% карточки в viewport).

### Hover на карточках

```css
.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 24px rgba(0,0,0,0.10), 0 2px 6px rgba(0,0,0,0.05);
}
```

Применять: product cards, case cards, route cards. Не применять к текстовым абзацам и FAQ.

### Hover на кнопках

Primary:
```css
.btn--primary:hover {
  background: var(--accent-green-hover);
  box-shadow: var(--shadow-glow-green);
  transform: translateY(-1px);
}
```

Outline (на тёмном фоне):
```css
.btn--outline:hover {
  background: var(--accent-green);
  color: var(--accent-green-text);
  box-shadow: var(--shadow-glow-green);
}
```

**Не используем rotate на кнопках.** Это приём tochkicamp из playful-регистра, не нашего.

### Что недопустимо

- WebGL / canvas-анимации в v1.
- Длинные intro-анимации (>600ms) в hero, которые задерживают восприятие оффера.
- Parallax тяжелее, чем 5–10% смещение на scroll.
- Анимации, которые ломают LCP / INP метрики.

---

## 7. CTA-стиль

### Primary CTA (светлый фон)

Сплошная кнопка, зелёный фон. Один доминирующий CTA на экран.

```css
.btn--primary {
  background: var(--accent-green);          /* #4BD392 */
  color: var(--accent-green-text);          /* #102018 */
  font-family: var(--font-heading);
  font-weight: 600;
  font-size: 16px;
  padding: 16px 28px;
  border-radius: var(--radius-md);          /* 18px */
  border: none;
  height: 52–56px;
}
```

### Outline CTA (тёмный фон — hero dark, final CTA section)

Inspired by tochkicamp, адаптировано в нашу систему:

```css
.btn--outline-dark {
  background: transparent;
  color: #FFFFFF;
  border: 2px solid rgba(255,255,255,0.5);
  font-family: var(--font-heading);
  font-weight: 600;
  font-size: 16px;
  padding: 16px 28px;
  border-radius: var(--radius-md);
}

.btn--outline-dark:hover {
  background: var(--accent-green);
  color: var(--accent-green-text);
  border-color: transparent;
  box-shadow: var(--shadow-glow-green);
}
```

### Secondary CTA (любой фон)

```css
.btn--secondary {
  background: var(--bg-surface);
  color: var(--text-primary);
  border: 1px solid var(--border-strong);
}

.btn--secondary:hover {
  background: var(--bg-soft);
}
```

### CTA Rules (без изменений, переподтверждаем)

- Один визуально доминирующий CTA на экран.
- В header — зелёная кнопка всегда видна.
- Copy максимально конкретный: «Записаться на экскурсию», не «Оставить заявку».
- Secondary CTA — никогда не соперничает с primary по цвету/размеру.

---

## 8. Section Rhythm — порядок блоков

Порядок секций из `05-design-principles.md` остаётся. Добавляем чередование фонов, мотивированное референсом:

| № | Секция | Фон | Регистр |
|---|--------|-----|---------|
| — | Header | sticky, glassmorphism light | утилитарный |
| 1 | Hero | `--bg-dark` или `--bg-page` | wow-controlled |
| 2 | JTBD / Для кого / Проблемы | `--bg-surface` (белый) | утилитарный |
| 3 | Метод / Как это работает | `--bg-soft` (#EEF2F7) | структурный |
| 4 | Продуктовые маршруты / Карточки | `--bg-page` (#F5F6FA) | продуктовый |
| 5 | Proof / Кейсы / Результаты | `--bg-dark` или `--bg-surface` | wow-от-ясности |
| 6 | Founder / About | `--bg-warm` (#FAF8F4) | тёплый, человеческий |
| 7 | FAQ | `--bg-surface` (белый) | утилитарный |
| 8 | Final CTA | `--bg-dark` или `--bg-dark-2` | эмоциональный, собранный |
| — | Footer | `--bg-dark` | утилитарный |

**Принцип:** тёмные блоки — как знаки препинания, не как фон всей страницы. Максимум 2 тёмных секции на всю страницу (hero + final CTA).

**Alternation logic:** light → white → soft → page → dark-accent → warm → white → dark-final.

Каждая секция выполняет одну задачу из трёх:
- снять тревогу;
- усилить понимание;
- повести к действию.

---

## 9. Мобильная адаптация

### Breakpoints

```css
/* Desktop-first approach */
@media (max-width: 1024px) { /* tablet */ }
@media (max-width: 768px)  { /* mobile landscape */ }
@media (max-width: 480px)  { /* mobile portrait */ }
```

### Ключевые правила

**Hero:**
- Визуал (портрет) уходит ниже headline + CTA на мобильном.
- H1 на мобильном: 34–38px, не меньше (оффер должен читаться с полметра).
- CTA-кнопка: full-width на мобильном, высота 52px, tappable.

**Навигация:**
- Burger-меню. В открытом состоянии — overlay с большими tappable links.
- Header CTA кнопка остаётся видимой даже в collapsed state.

**Cards:**
- Grid-3 → Grid-2 на tablet → Grid-1 на mobile.
- Padding карточек: 24px на мобильном (вместо 32px desktop).
- Hover-эффекты на мобильном: отключаем translateY (нет hover-state), оставляем только active-state tap feedback.

**Scroll-reveal:**
- На мобильном stagger уменьшаем до 60ms (иначе последние карточки появляются слишком поздно при быстром скролле).

**FAQ:**
- Аккордеон нативно mobile-friendly.
- Зона клика: min-height 56px, полная ширина строки.

**Section padding мобильный:** 56–64px 0 (против 96–120px desktop).

**Типографика мобильная:**
- Body: 16px (не меньше, иначе жалобы на читаемость).
- H2: 28–30px.
- Subtitle: 17px, max-width: 100%.

### Что НЕ разваливается

- Proof/метрики: не портянка цифр, а grid 2-col на tablet, 1-col на мобильном с крупными числами.
- Process steps: вертикальный timeline на мобильном, без горизонтального скролла.
- Header: не перегружен, логотип + burger + один CTA.

---

## Сводная таблица: берём / не берём из tochkicamp

| Элемент tochkicamp | Решение | Адаптация |
|--------------------|---------|-----------|
| Тёмный фон #111111 как база | Не берём | Тёмный только для hero (опц.) и final CTA |
| Бежевые карточки #F9F7F1 | Не берём | Белые карточки на нашем светлом фоне |
| Неоновый жёлтый #EFFF3E | Не берём | Тёплый акцент #F5D87A как micro-highlight |
| IBM Plex Mono | Адаптируем | JetBrains Mono — расширяем применение |
| Карточная система с воздухом | Берём | gap 28–32px, padding 32–36px |
| Scroll-reveal opacity+translateY | Берём | translateY 28px, 420ms, cubic easing |
| Hover карточки translateY + shadow | Берём | translateY(-4px), shadow stronger |
| Hover rotate(-1deg) кнопки | Не берём | Playful-приём, не наш регистр |
| Outline CTA кнопки на тёмном | Берём | Только на тёмных секциях, hover → green fill |
| Бумажные текстуры / сепия | Не берём | Теплота через портрет и tone of voice |
| FAQ аккордеон +/− | Берём | Как есть, без украшений |
| max-width 1100px | Адаптируем | max-width 1200px (наш стандарт) |

---

## Следующие шаги для Виктора

1. Обновить CSS-переменные в `frontend/index.html` согласно секции 3 этого брифа.
2. Добавить scroll-reveal через IntersectionObserver (vanilla JS, ~30 строк).
3. Обновить card hover: translateY(-4px) + shadow-card-hover.
4. Реализовать FAQ-аккордеон с +/− иконкой.
5. Добавить outline-кнопку для финального CTA-блока.
6. Расширить применение JetBrains Mono на step-числа и proof-метрики.
7. Проверить мобильное отображение: hero-visual под текстом, grid fallback, padding.

---

*Этот бриф сохраняет утверждённое conversion-first направление и добавляет лучшие приёмы tochkicamp там, где они не противоречат нашей стратегии и аудитории.*
