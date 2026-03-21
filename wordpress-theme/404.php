<?php
/**
 * The template for displaying 404 pages.
 *
 * @package SwitchOnAI
 */

get_header();
?>

<main id="primary" class="site-main content-shell">
    <div class="container">
        <div class="content-layout">
            <section class="not-found-card">
                <span class="section-label">404</span>
                <h1>Эта страница не найдена</h1>
                <p>Возможно, материал был перемещен или ссылка устарела. Можно вернуться на главную или найти нужный материал через поиск.</p>

                <?php get_search_form(); ?>

                <div class="cta-buttons">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">На главную</a>
                    <a href="<?php echo esc_url(home_url('/#cta')); ?>" class="btn btn-outline">Записаться на экскурсию</a>
                </div>
            </section>
        </div>
    </div>
</main>

<?php
get_footer();
?>
