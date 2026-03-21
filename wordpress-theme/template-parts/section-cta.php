<?php
$telegram_username = ltrim(switchonai_get_option('telegram_username', '@switchonai'), '@');
$telegram_url = 'https://t.me/' . $telegram_username;
$contact_email = switchonai_get_option('contact_email', 'hello@switchonai.ru');
?>

<!-- ===== CTA SECTION ===== -->
<section class="cta" id="cta">
    <div class="blur-decoration blur-blue cta-blur-1"></div>
    <div class="blur-decoration blur-cream cta-blur-2"></div>

    <div class="container">
        <div class="cta-content reveal">
            <span class="section-label">Основной маршрут</span>
            <h2>Запишитесь на <span class="text-accent">экскурсию по системе</span></h2>
            <p>
                Покажу, как устроен подход изнутри, разберу вашу ситуацию и честно скажу,
                подходит ли такой формат внедрения вам сейчас.
            </p>
            <div class="cta-buttons">
                <a href="<?php echo esc_url($telegram_url); ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                    Записаться на экскурсию
                    <svg class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z"/>
                    </svg>
                </a>
                <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="btn btn-outline">Написать на email</a>
            </div>
        </div>
    </div>
</section>
