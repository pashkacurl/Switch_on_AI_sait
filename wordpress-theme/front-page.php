<?php
/**
 * The front page template file
 *
 * @package SwitchOnAI
 */

get_header();
?>

<!-- ===== HERO SECTION ===== -->
<section class="hero">
    <div class="blur-decoration blur-blue hero-blur-1"></div>
    <div class="blur-decoration blur-cream hero-blur-2"></div>

    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-eyebrow">
                    <span class="hero-eyebrow-dot"></span>
                    AI-контент-система для бизнеса
                </div>

                <h1>
                    <span class="line"><?php echo esc_html(switchonai_get_option('hero_title', 'Выключи')); ?></span>
                    <span class="line line-thin">хаос</span>
                    <span class="line text-accent"><?php echo esc_html(switchonai_get_option('hero_subtitle', 'Включи систему')); ?></span>
                </h1>

                <p class="hero-description">
                    <?php echo esc_html(switchonai_get_option('hero_description', 'Сначала смыслы и стратегия, затем AI и автоматизация. На выходе — управляемая контент-система, которая помогает бизнесу быть видимым без ежедневной рутины.')); ?>
                </p>

                <div class="hero-buttons">
                    <a href="#cta" class="btn btn-primary">
                        Записаться на экскурсию
                        <svg class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z"/>
                        </svg>
                    </a>
                    <a href="#process" class="btn btn-outline">Как это работает</a>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-value">10<span class="accent">+</span></div>
                        <div class="hero-stat-label">Площадок для публикации</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-value">1<span class="accent">м</span></div>
                        <div class="hero-stat-label">Ориентир на запуск системы</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-value">2-5<span class="accent">к</span></div>
                        <div class="hero-stat-label">Инфраструктура в месяц после запуска</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-visual-container">
                    <div class="hero-ring hero-ring-1"></div>
                    <div class="hero-ring hero-ring-2"></div>
                    <div class="hero-ring hero-ring-3"></div>
                    <div class="hero-orb"></div>
                    <div class="hero-dot hero-dot-1"></div>
                    <div class="hero-dot hero-dot-2"></div>
                    <div class="hero-dot hero-dot-3"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Include template parts for sections
get_template_part('template-parts/section', 'problems');
get_template_part('template-parts/section', 'services');
get_template_part('template-parts/section', 'process');
get_template_part('template-parts/section', 'cases');
get_template_part('template-parts/section', 'training');
get_template_part('template-parts/section', 'testimonials');
get_template_part('template-parts/section', 'faq');
get_template_part('template-parts/section', 'cta');

get_footer();
