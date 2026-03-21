<?php
/**
 * Generic template part fallback.
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
    </header>

    <div class="<?php echo is_singular() ? 'entry-content' : 'entry-summary'; ?>">
        <?php
        if (is_singular()) {
            the_content();
        } else {
            the_excerpt();
        }
        ?>
    </div>
</article>
