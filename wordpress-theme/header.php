<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ===== HEADER ===== -->
<header class="header" id="header">
    <div class="container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
            <div class="logo-mark">AI</div>
            <span><?php bloginfo('name'); ?></span>
        </a>

        <?php if (has_nav_menu('primary')) : ?>
            <nav class="nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => '',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ));
                ?>
            </nav>
        <?php else : ?>
            <nav class="nav">
                <a href="#services">Услуги</a>
                <a href="#cases">Кейсы</a>
                <a href="#training">Обучение</a>
                <a href="#faq">FAQ</a>
                <a href="#contacts">Контакты</a>
            </nav>
        <?php endif; ?>

        <a href="#cta" class="btn btn-glass header-cta">Консультация</a>

        <button class="mobile-menu-btn" aria-label="Меню">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
