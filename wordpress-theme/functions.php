<?php
/**
 * Switch On AI Theme Functions
 *
 * @package SwitchOnAI
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function switchonai_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'switchonai'),
        'footer' => __('Footer Menu', 'switchonai'),
    ));

    // Set content width
    if (!isset($GLOBALS['content_width'])) {
        $GLOBALS['content_width'] = 1400;
    }
}
add_action('after_setup_theme', 'switchonai_setup');

/**
 * Enqueue Scripts and Styles
 */
function switchonai_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'switchonai-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style('switchonai-style', get_stylesheet_uri(), array(), '1.0.0');

    // Main JavaScript
    wp_enqueue_script(
        'switchonai-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'switchonai_scripts');

/**
 * Register Widget Areas
 */
function switchonai_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Column 1', 'switchonai'),
        'id'            => 'footer-1',
        'description'   => __('Appears in the footer area', 'switchonai'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Column 2', 'switchonai'),
        'id'            => 'footer-2',
        'description'   => __('Appears in the footer area', 'switchonai'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Column 3', 'switchonai'),
        'id'            => 'footer-3',
        'description'   => __('Appears in the footer area', 'switchonai'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'switchonai_widgets_init');

/**
 * Custom excerpt length
 */
function switchonai_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'switchonai_excerpt_length');

/**
 * Custom excerpt more
 */
function switchonai_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'switchonai_excerpt_more');

/**
 * Add custom body classes
 */
function switchonai_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    return $classes;
}
add_filter('body_class', 'switchonai_body_classes');

/**
 * Customizer Settings
 */
function switchonai_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('switchonai_hero', array(
        'title'    => __('Hero Section', 'switchonai'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Выключи рутину',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Title', 'switchonai'),
        'section' => 'switchonai_hero',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Включи систему',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'switchonai'),
        'section' => 'switchonai_hero',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_description', array(
        'default'           => 'Сначала смыслы и стратегия, затем AI и автоматизация. На выходе — управляемая контент-система, которая помогает бизнесу быть видимым без ежедневной рутины.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('hero_description', array(
        'label'   => __('Hero Description', 'switchonai'),
        'section' => 'switchonai_hero',
        'type'    => 'textarea',
    ));

    // Contact Settings
    $wp_customize->add_section('switchonai_contact', array(
        'title'    => __('Contact Information', 'switchonai'),
        'priority' => 35,
    ));

    $wp_customize->add_setting('contact_email', array(
        'default'           => 'hello@switchonai.ru',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label'   => __('Email', 'switchonai'),
        'section' => 'switchonai_contact',
        'type'    => 'email',
    ));

    $wp_customize->add_setting('contact_phone', array(
        'default'           => '+7 (900) 123-45-67',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_phone', array(
        'label'   => __('Phone', 'switchonai'),
        'section' => 'switchonai_contact',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('telegram_username', array(
        'default'           => '@switchonai',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('telegram_username', array(
        'label'   => __('Telegram Username', 'switchonai'),
        'section' => 'switchonai_contact',
        'type'    => 'text',
    ));

    // Social Media
    $wp_customize->add_section('switchonai_social', array(
        'title'    => __('Social Media', 'switchonai'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('social_telegram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('social_telegram', array(
        'label'   => __('Telegram URL', 'switchonai'),
        'section' => 'switchonai_social',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('social_youtube', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('social_youtube', array(
        'label'   => __('YouTube URL', 'switchonai'),
        'section' => 'switchonai_social',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('social_vk', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('social_vk', array(
        'label'   => __('VK URL', 'switchonai'),
        'section' => 'switchonai_social',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'switchonai_customize_register');

/**
 * Helper function to get customizer value
 */
function switchonai_get_option($option, $default = '') {
    return get_theme_mod($option, $default);
}
