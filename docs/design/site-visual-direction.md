# Site visual direction — handoff для Виктора

Статус: draft for implementation
Дата: 2026-03-29
Подготовила: Джейн

---

## 1) Короткий вывод

Для сайта «Включи ИИ» нужен **не dark-tech шоурум и не шумный инфобиз-лендинг**, а **светлый conversion-first интерфейс с технологичными акцентами**.

Формула направления:
- база — **светлая, чистая, взрослая**;
- акценты — **AI-энергия через синий + mint/green**, тонкие сетки, glow, графические паттерны;
- подача — **спокойная, уверенная, системная**;
- визуальный характер — **"эксперт-проводник в AI", а не "футуристичный маг ради вау"**.

Это соответствует:
- `docs/05-design-principles.md` — light-dominant trust-first, conversion-first;
- `docs/research/competitor-analysis.md` — не копировать Титова по плотности и шуму;
- `docs/research/repo-audit.md` — собрать зрелую систему из уже имеющихся материалов;
- брендбуку — сохранить узнаваемые зелёно-синие AI-акценты, но не тащить январский dark-tech как основной стиль.

---

## 2) Визуальное направление сайта

### Что делаем

**Основной режим:** light-dominant.

Сайт должен ощущаться так:
- чисто;
- дорого, но без премиального пафоса;
- технологично, но без перегруза техно-декором;
- понятно уже на первом экране;
- "система и порядок", а не "ярмарка AI-чудес".

### На что ориентируемся по ощущению

Берём микс из:
- **Codearia** — воздух, зрелость, аккуратный ритм;
- **BotHelp / Botmother** — ясность структуры и низкий когнитивный шум;
- **частично Avtograf / Титов** — только энергию CTA и продуктовость посадок, но **не** их шум, плотность и множественные конкурирующие офферы.

### Чего не делаем

- не уходим в тяжёлый чёрный фон как базовый режим;
- не делаем кислотный AI-cyberpunk;
- не используем 3D/эффекты как основной носитель ценности;
- не копируем визуальный язык Титова: много градиентов, много CTA, перегретая драматизация;
- не строим каждую секцию как отдельный рекламный баннер.

---

## 3) Дизайн-система

### 3.1 Цветовая система

Нужна **двухрежимная логика**: светлая основа + тёмные акцентные блоки.

#### Core palette

```css
--bg-page: #F5F6FA;
--bg-surface: #FFFFFF;
--bg-soft: #EEF2F7;
--bg-dark: #1C1F33;
--bg-dark-2: #162A40;

--text-primary: #111827;
--text-secondary: #6B7280;
--text-on-dark: #FFFFFF;

--accent-green: #4BD392;
--accent-blue: #2F80ED;
--accent-mint-soft: #DDF8EC;
--accent-blue-soft: #E8F1FF;
--accent-amber-soft: #FFF2CC;

--border-soft: #E5E7EB;
--border-strong: #D1D5DB;
```

#### Принцип применения
- **Основной фон сайта:** `#F5F6FA` / белый.
- **Основной текст:** глубокий тёмный, не чисто чёрный.
- **Primary CTA:** зелёный `#4BD392`.
- **Interactive / links / info accents:** синий `#2F80ED`.
- **Тёмные секции:** только точечно — hero, финальный CTA, отдельные wow/proof-блоки.
- **Amber** — только как маленький trust/highlight, не как системный акцент.

#### Важное правило
Зелёный должен ощущаться как **сигнал действия и включения**, а не как декоративная краска по всей странице.

---

### 3.2 Типографика

#### Рекомендуемая пара
- **Headings:** Manrope как основной выбор.
- **Alternative accent headings:** Space Grotesk точечно, только для отдельных short labels / numbers / tech-accent.
- **Body:** Inter.
- **Mono / code / prompts / схемы:** JetBrains Mono.

> Почему не Montserrat как базу из брендбука: для сайта она тяжелее и более шаблонная. По `05-design-principles` Manrope / humanist sans лучше даёт современную, спокойную, доверительную подачу. Montserrat можно оставить только как fallback/reference, но не как основной tone-setter.

#### Иерархия размеров

Desktop:
- H1: 56–64 / 1.05–1.1
- H2: 40–48 / 1.1
- H3: 28–32 / 1.15
- H4: 22–24 / 1.2
- Body L: 20 / 1.6
- Body: 16–18 / 1.65
- Small: 14 / 1.5
- Eyebrow: 12–13 uppercase / 0.12em tracking

Mobile:
- H1: 34–40
- H2: 28–32
- H3: 22–24
- Body: 16
- Small: 14

#### Правила набора
- заголовки короткие, 2–4 строки максимум;
- не злоупотреблять fully uppercase;
- длинные абзацы дробить;
- key claim можно подсвечивать градиентом/акцентом, но только одно место на экран.

---

### 3.3 Spacing / layout rhythm

#### Grid
- Desktop container: `1200–1240px`
- Content container narrow: `760–820px`
- 12-column grid desktop
- 4/8-column logic tablet/mobile

#### Vertical rhythm
- Section padding desktop: `96–128px`
- Section padding mobile: `56–72px`
- Gap inside sections: `24 / 32 / 48`
- Card padding: `24–32px`
- Hero top padding: generous, не меньше `88–112px`

#### Общий принцип
Сайт должен дышать. Если сомневаемся — **добавляем воздуха, а не декора**.

---

### 3.4 Кнопки

#### Primary button
- фон: `#4BD392`
- текст: тёмный `#102018`
- высота: `52–56px`
- border radius: `14–18px`
- padding X: `20–24px`
- weight: 600
- hover: чуть темнее + мягкий shadow/glow

#### Secondary button
- фон: белый / transparent
- border: `1px solid #D1D5DB`
- текст: `#111827`
- hover: soft fill `#EEF2F7`

#### Tertiary / text link
- цвет: `#2F80ED`
- underline on hover / arrow icon

#### CTA rule
На одном экране — **одна визуально доминирующая кнопка**. Вторая может быть только вспомогательной.

---

### 3.5 Карточки

#### Base card
- background: white
- border: `1px solid #E5E7EB`
- radius: `20–24px`
- shadow: very soft, low blur
- content padding: `24–32px`

#### Accent card
- background: white with faint top gradient or glow
- border accent by context (green/blue, very subtle)
- используется только для hero-proof, featured product, CTA cards

#### Card behavior
- hover: translateY `-2px`, shadow slightly stronger
- не делать glassmorphism как основной стиль
- не использовать тяжёлые неоновые обводки

---

### 3.6 Иконки

- стиль: outline / duotone light
- stroke: `1.5–1.75px`
- углы слегка скруглены
- размеры базово `20/24/32`
- контейнер иконки: мягкий tinted badge (mint / blue soft)
- иконки должны выглядеть как часть продукта, не как generic emoji-set

Подходящие мотивы:
- nodes / workflow / cursor / bot / spark / checklist / chart / shield / play / message.

---

### 3.7 Визуальные паттерны

Использовать умеренно:
- тонкие сетки и графовые линии;
- мягкие radial gradients;
- AI-nodes / синоптические точки на фоне;
- code/prompt snippets в mono;
- product frames / pseudo-interface mockups.

Не использовать как фон постоянно:
- тяжёлые сияющие волны;
- noisy particles everywhere;
- декоративные 3D-сцены ради красоты.

---

### 3.8 Motion

Допустимо:
- fade/reveal/stagger;
- лёгкий parallax на иллюстрациях;
- subtle gradient drift;
- мягкое появление карточек;
- hover на кнопках/карточках.

Недопустимо:
- тяжёлые webgl-сцены для v1;
- длинные hero-анимации, которые мешают понять оффер;
- motion, который ухудшает LCP/INP.

---

## 4) Где нужен wow, а где utilitarian UI

### Wow-зоны

#### 1. Hero
Здесь нужен controlled wow:
- сильная композиция;
- крупный заголовок;
- portrait/founder visual + AI-layer;
- хороший depth через light, glow, soft grid;
- визуал должен усиливать идею "включаем систему", а не просто показывать человека.

#### 2. Product routes / key offers
Карточки направлений можно сделать чуть более выразительными:
- AI-команда
- Экскурсия
- Клуб
- Разбор / кейсы

Здесь допустимы:
- subtle tinted backgrounds;
- accent highlights;
- pseudo-product visuals.

#### 3. Proof / cases / results
Тут нужен не “шоу-wow”, а **wow от ясности**:
- цифры крупно;
- аккуратные кейс-карточки;
- before/after;
- процесс + результат.

#### 4. Final CTA
Можно сделать тёмным, собранным, эмоционально сильным блоком.

### Спокойный utilitarian UI

#### 1. FAQ
Максимально просто. Аккордеоны, белый фон, читаемость.

#### 2. Blog / articles / knowledge pages
Почти editorial UI:
- белый фон;
- комфортный текстовый ритм;
- минимум декоративности.

#### 3. Service pages below the fold
Блоки “как это работает”, “что входит”, “кому подходит”, “этапы” — чисто, структурно, без визуального цирка.

#### 4. Forms / lead capture / contact blocks
Утилитарно и спокойно. Форма должна ощущаться надёжной, а не “рекламной”.

---

## 5) Страница-прокладка из соцсетей

Это критичный сценарий. Нельзя делать её как просто “link in bio”.

### Задача страницы
Поймать человека из Telegram / Instagram / Reels и быстро ответить:
1. кто вы;
2. чем можете помочь;
3. куда мне идти дальше.

### Визуальный формат

#### Above the fold
- компактный hero
- портрет Павла или бренд-символ + короткий оффер
- 2–3 маршрута максимум

#### Рекомендуемая структура
1. Мини-хедер с логотипом
2. Короткий headline: что делает «Включи ИИ»
3. Один абзац в простом языке
4. 3 главных действия-карточки:
   - `Записаться на экскурсию`
   - `Посмотреть кейсы`
   - `Узнать про AI-команду / клуб`
5. Ниже — social proof / короткая цитата / мини-результаты
6. Повтор CTA

### Визуально
- не делать длинной страницей;
- максимально mobile-first;
- большие tappable cards;
- лёгкая branded motion;
- портрет использовать умеренно — здесь важнее маршрутизация, чем презентация.

### Отличие от главной
Главная — объясняет систему.
Прокладка — **моментально маршрутизирует**.

---

## 6) Какие медиа и визуалы нужны по ключевым блокам

Ниже — что нужно для каждой важной секции.

### 6.1 Hero
Нужно:
- основной портрет Павла в хорошем качестве, clean background или легко отделяемый;
- один сильный branded background / abstract AI texture;
- optional pseudo-interface or workflow overlay.

Формат:
- desktop hero visual 3:4 / 4:5
- mobile crop отдельный
- webp + retina versions

Из имеющегося использовать:
- `iSite/05_Медиа/Портреты/Павел Лещенко @Leschenko @ (1).png`
- дополнительно проверить:
  - `iSite/05_Медиа/Портреты/ChatGPT Image 11 сент. 2025 г., 16_21_07.png`
  - `iSite/05_Медиа/Портреты/Gemini_Generated_Image_myjej6myjej6myje.png`
  - `iSite/05_Медиа/Портреты/Gemini_Generated_Image_rrghz3rrghz3rrgh.png`

Что, вероятно, нужно дозаказать/доделать:
- **1 clean hero portrait** в единой цветокоррекции;
- **1 аккуратный hero-composite** с AI-overlay под сайт;
- мобильная версия кропа.

### 6.2 Блок “Для кого / проблемы / JTBD”
Нужно:
- не фото-сток, а иконографика / схемы / микро-иллюстрации;
- карточки проблем/сценариев.

Из имеющегося:
- прямых готовых материалов, скорее всего, недостаточно.

Нужно сделать:
- набор 6–8 унифицированных product icons;
- 3–4 простых diagram-style иллюстрации.

### 6.3 Блок “Как это работает”
Нужно:
- step diagram / workflow visualization;
- возможно, product-flow mockup;
- один чистый схематичный visual, который объясняет систему.

Использовать:
- графические паттерны из брендбука как основа;
- mono snippets / nodes / connectors.

Нужно сделать:
- кастомную схему 4-step process;
- mini-версии для product pages.

### 6.4 Продуктовые маршруты / карточки направлений
Нужно:
- серия карточек в одном стиле;
- для каждой — иконка + короткий descriptor + фоновый паттерн.

Из имеющегося использовать как inspiration:
- `iSite/05_Медиа/Обложки/20250731_1357_Обложка ИИ для Telegram_remix_01k1g1z58sej2sqgqhd2vm1jep.png`
- `iSite/05_Медиа/Обложки/20250731_1357_Обложка ИИ для Telegram_remix_01k1g1z58vekbs567302jqrb9x.png`

Нужно сделать:
- не просто вставить эти обложки на сайт,
- а **пересобрать их язык в карточечную систему**.

### 6.5 Proof / кейсы / результаты
Нужно:
- кейс-карточки;
- скриншоты/артефакты;
- цифры в clean stat modules;
- возможно, логотипы клиентов позже.

Из имеющегося:
- зависит от наполнения, но визуально лучше строить как UI-модули, не как баннеры.

Нужно сделать:
- reusable case card template;
- metric strip / results row.

### 6.6 Founder / about
Нужно:
- 1 основной портрет;
- 1–2 вторичных кадра / детали;
- возможно, цитатный блок с мягким бренд-фоном.

Из имеющегося:
- те же портреты из `iSite/05_Медиа/Портреты/`.

Нужно дозаказать/доделать:
- если текущие портреты слишком разностильные, выбрать 1 мастер-изображение и привести всё к одному виду.

### 6.7 Blog / media / articles
Нужно:
- шаблон обложек статей;
- category badges;
- author card;
- quote / note / prompt blocks.

Из имеющегося использовать:
- логотипы и обложки как референс палитры, не как финальные article covers.

Нужно сделать:
- универсальную cover-system для блога.

### 6.8 Final CTA
Нужно:
- выразительный, но лаконичный branded background;
- без новой фотоистории, можно на абстрактной графике.

Из имеющегося использовать:
- фоны из `iSite/05_Медиа/Фоны/`
- особенно проверить:
  - `20250703_1445_Фон #F5F6FA_remix_01jz81km1becd85qkzy6xd88ts.png`
  - `ChatGPT Image 18 сент. 2025 г., 09_38_05.png`
  - `ChatGPT Image 18 сент. 2025 г., 09_48_32.png`
  - `ChatGPT Image 3 июл. 2025 г., 12_05_05.png`
  - `ChatGPT Image 3 июл. 2025 г., 12_24_02.png`

---

## 7) Что использовать из существующего, а что нужно создать

### Использовать уже сейчас

#### Бренд-основа
- `iSite/03_Брендинг/Брендбук Включи ИИ.pdf`
- логика палитры: dark blue + green + blue + light backgrounds
- логика паттернов: nodes / neural links / glow points

#### Медиа
- логотипы из `iSite/05_Медиа/Логотипы/`
- портреты из `iSite/05_Медиа/Портреты/`
- фоны из `iSite/05_Медиа/Фоны/`
- обложки из `iSite/05_Медиа/Обложки/` как mood/reference source

### Использовать с осторожностью / только как референс
- старые тёмные/слишком эффектные фоны, если они уводят в dark-tech;
- обложки соцсетей напрямую на сайт — только после адаптации под веб-систему;
- любые слишком AI-generic арт-изображения без функции.

### Нужно создать/дозаказать обязательно

#### Must-have
1. **Hero portrait master asset**
   - единый главный портрет Павла для hero/about/social landing

2. **UI illustration kit**
   - 6–10 иконок
   - 3–4 схемы/diagram visuals
   - 2–3 branded background compositions

3. **Case card templates**
   - reusable visual system для кейсов и результатов

4. **Blog cover system**
   - шаблон обложек статей / кейсов / гайдов

5. **Social entry page visual kit**
   - compact hero
   - 3 route cards
   - mini-proof strip

#### Nice-to-have, not MVP-critical
- короткий loop video / motion background для hero;
- interactive workflow demo;
- advanced micro-illustrations for all product pages.

---

## 8) Практические правила для реализации в теме

### Header
- светлый / почти прозрачный в начале;
- на скролле — белый или glass-light, не тёмный heavy bar;
- CTA в хедере всегда виден.

### Hero
- текст слева, visual справа на desktop;
- на mobile visual уходит ниже headline/CTA;
- не ставить 2 тяжёлых visual объекта сразу.

### Section alternation
Ритм секций:
- light
- white
- light
- dark-accent
- white
- light
- final dark CTA

То есть тёмные блоки — как punctuations, не как фон всего сайта.

### Content density
- один экран = одна главная мысль;
- максимум 3–4 карточки в ряд;
- длинные объяснения разбивать на subheads, steps, lists.

### Founder presence
Павел должен быть на сайте заметен, но не превращать сайт в культ личности.
Формула:
- founder visible in hero / about / selected quotes;
- дальше сайт продаёт **систему и результат**, не только человека.

---

## 9) Что я рекомендую Виктору как production direction

### Базовая формула
**Light-first AI brand system**
с такими опорами:
- clean layout;
- Manrope + Inter;
- green CTA + blue interaction;
- white cards;
- subtle AI-pattern backgrounds;
- dark-accent hero / final CTA only if needed.

### Если в одном предложении
Сайт должен выглядеть как:
**«спокойный, взрослый, технологичный проводник в AI-автоматизацию для бизнеса»**, а не как **«кричащий футуристичный лендинг про магию нейросетей»**.

---

## 10) Checklist для следующего шага

1. Зафиксировать токены дизайн-системы в Figma / CSS vars.
2. Выбрать 1 основной логотип и 1 favicon symbol.
3. Выбрать 1 master portrait Павла.
4. Собрать 3 moodboards:
   - hero
   - product cards
   - social landing page
5. Отрисовать/собрать:
   - icon set
   - 4-step process visual
   - case card template
   - article cover template
6. Проверить, что визуал не скатывается в dark-tech или в generic SaaS.

---

## Sources
- `shared/Switch_on_AI_sait/docs/05-design-principles.md`
- `shared/Switch_on_AI_sait/Документация/01_Исследование_дизайна_сайтов.md`
- `shared/Switch_on_AI_sait/docs/research/competitor-analysis.md`
- `shared/Switch_on_AI_sait/docs/research/repo-audit.md`
- `shared/Switch_on_AI_sait/iSite/03_Брендинг/Брендбук Включи ИИ.pdf`
- `shared/Switch_on_AI_sait/iSite/05_Медиа/`
