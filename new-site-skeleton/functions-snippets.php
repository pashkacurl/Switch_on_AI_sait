<?php
/**
 * switchonai.ru — Child Theme functions.php snippets
 * Добавить в functions.php дочерней темы
 *
 * ВАЖНО: Использовать Child Theme, не редактировать родительскую тему напрямую
 */

// =============================================
// 1. БЕЗОПАСНОСТЬ — скрыть версии
// =============================================

// Убрать WordPress версию из <meta generator>
remove_action('wp_head', 'wp_generator');

// Убрать версию WP из URL стилей и скриптов
function swai_remove_wp_version_strings($src) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'swai_remove_wp_version_strings');
add_filter('style_loader_src', 'swai_remove_wp_version_strings');

// Убрать X-Powered-By через PHP (дублирует nginx конфиг)
@header_remove('X-Powered-By');

// Убрать ненужные теги из <head>
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

// =============================================
// 2. ПРОИЗВОДИТЕЛЬНОСТЬ
// =============================================

// Убрать внешний старый jQuery если тема его подключает
function swai_fix_jquery() {
    if (!is_admin()) {
        // Убрать если тема деregistrирует встроенный WP jQuery
        // и подключает внешний старый
        $scripts = wp_scripts();
        if (isset($scripts->registered['jquery'])) {
            $jquery = $scripts->registered['jquery'];
            // Если src содержит googleapis или версию < 3 — заменить
            if (strpos($jquery->src, 'googleapis.com') !== false ||
                strpos($jquery->src, '1.7') !== false ||
                strpos($jquery->src, '1.8') !== false ||
                strpos($jquery->src, '1.9') !== false ||
                strpos($jquery->src, '2.') !== false) {
                wp_deregister_script('jquery');
                wp_register_script('jquery', includes_url('/js/jquery/jquery.min.js'), [], null, false);
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'swai_fix_jquery', 1);

// Добавить loading="lazy" ко всем изображениям автоматически
function swai_add_lazy_loading($content) {
    if (!is_admin()) {
        $content = preg_replace('/<img((?!.*loading=)[^>]*)>/i', '<img$1 loading="lazy">', $content);
    }
    return $content;
}
add_filter('the_content', 'swai_add_lazy_loading');
add_filter('post_thumbnail_html', 'swai_add_lazy_loading');

// WebP поддержка в загрузчике медиа
function swai_add_webp_support($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('mime_types', 'swai_add_webp_support');
add_filter('upload_mimes', 'swai_add_webp_support');

// =============================================
// 3. SEO — ON-PAGE
// =============================================

// Убрать meta keywords (устарел, но Yoast иногда оставляет пустой тег)
function swai_remove_meta_keywords() {
    // Yoast не добавляет keywords по умолчанию, но на всякий случай
    // Убедиться что Yoast → Advanced → нет keywords
}

// Добавить H1 на страницу архива /stati/ если отсутствует
function swai_blog_archive_h1() {
    if (is_home() && !is_front_page()) {
        echo '<h1 class="archive-title screen-reader-text">Блог об AI-автоматизации для бизнеса</h1>';
    }
}
add_action('wp_head', 'swai_blog_archive_h1');

// Canonical для пагинации
function swai_pagination_canonical() {
    if (is_paged()) {
        $paged = get_query_var('paged');
        if ($paged > 1) {
            $canonical = get_pagenum_link($paged);
            // Yoast обрабатывает canonical автоматически, но для надёжности
        }
    }
}

// =============================================
// 4. SCHEMA — JSON-LD через wp_head
// =============================================

// Добавить Person + Service schema на главную
// (альтернатива: через WPCode плагин — предпочтительнее)
function swai_homepage_schema() {
    if (is_front_page()) {
        $schema_file = get_stylesheet_directory() . '/schema-homepage.json';
        if (file_exists($schema_file)) {
            $schema = file_get_contents($schema_file);
            echo '<script type="application/ld+json">' . $schema . '</script>' . "\n";
        }
    }
}
add_action('wp_head', 'swai_homepage_schema');

// =============================================
// 5. OPEN GRAPH — дополнения к Yoast
// =============================================

// OG image по умолчанию если не задан на странице
function swai_default_og_image() {
    if (!is_singular() || !has_post_thumbnail()) {
        $default_og = 'https://switchonai.ru/wp-content/uploads/og-default.jpg';
        echo '<meta property="og:image" content="' . esc_url($default_og) . '">' . "\n";
        echo '<meta property="og:image:width" content="1200">' . "\n";
        echo '<meta property="og:image:height" content="630">' . "\n";
    }
}
// Раскомментировать если Yoast не добавляет default OG image:
// add_action('wp_head', 'swai_default_og_image', 20);

// =============================================
// 6. АНАЛИТИКА
// =============================================

// Место для GA4 Event tracking (если не через Site Kit)
// function swai_ga4_events() { ... }

// =============================================
// 7. БЕЗОПАСНОСТЬ — дополнительно
// =============================================

// Ограничить количество попыток входа (базовая защита)
function swai_limit_login_attempts($user, $username, $password) {
    // Реализовать через плагин Limit Login Attempts Reloaded
    return $user;
}

// Отключить редактор файлов в админке
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

// Добавить в wp-config.php:
// define('DISALLOW_FILE_EDIT', true);
// define('DISALLOW_FILE_MODS', false); // true если не нужны плагины из админки

// =============================================
// 8. BREADCRUMBS
// =============================================

// Yoast breadcrumbs — включить в шаблоне через:
// if (function_exists('yoast_breadcrumb')) {
//     yoast_breadcrumb('<nav class="breadcrumb" aria-label="Хлебные крошки">', '</nav>');
// }
