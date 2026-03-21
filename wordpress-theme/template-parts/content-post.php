<?php
/**
 * Template part for displaying posts.
 *
 * @package SwitchOnAI
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(is_singular() ? 'entry-single' : 'entry-card'); ?>>
    <header class="entry-header">
        <?php if (is_singular()) : ?>
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <?php else : ?>
            <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
        <?php endif; ?>

        <div class="entry-meta">
            <span><?php echo esc_html(get_the_date()); ?></span>
            <span><?php echo esc_html(get_the_author()); ?></span>
            <?php if (get_the_category_list(', ')) : ?>
                <span><?php echo wp_kses_post(get_the_category_list(', ')); ?></span>
            <?php endif; ?>
        </div>
    </header>

    <?php if (is_singular()) : ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        <footer class="entry-footer">
            <?php the_tags('<span>Теги: </span>', ', '); ?>
        </footer>
    <?php else : ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
        <a class="read-more" href="<?php echo esc_url(get_permalink()); ?>">Читать материал</a>
    <?php endif; ?>
</article>
