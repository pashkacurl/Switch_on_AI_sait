<!-- ===== FOOTER ===== -->
<footer class="footer" id="contacts">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <div class="logo-mark">AI</div>
                    <span><?php bloginfo('name'); ?></span>
                </a>
                <p>
                    <?php
                    $description = get_bloginfo('description', 'display');
                    echo $description ? esc_html($description) : 'Экосистема AI-решений для людей и бизнеса. Помогаем освобождать время и усиливать мышление.';
                    ?>
                </p>
                <div class="footer-social">
                    <?php
                    $telegram_url = switchonai_get_option('social_telegram');
                    $youtube_url = switchonai_get_option('social_youtube');
                    $vk_url = switchonai_get_option('social_vk');

                    if ($telegram_url) : ?>
                        <a href="<?php echo esc_url($telegram_url); ?>" aria-label="Telegram" target="_blank" rel="noopener noreferrer">TG</a>
                    <?php endif;

                    if ($youtube_url) : ?>
                        <a href="<?php echo esc_url($youtube_url); ?>" aria-label="YouTube" target="_blank" rel="noopener noreferrer">YT</a>
                    <?php endif;

                    if ($vk_url) : ?>
                        <a href="<?php echo esc_url($vk_url); ?>" aria-label="VK" target="_blank" rel="noopener noreferrer">VK</a>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php else : ?>
                <div class="footer-column">
                    <h4>Услуги</h4>
                    <ul>
                        <li><a href="#">Контент-завод</a></li>
                        <li><a href="#">Чат-боты</a></li>
                        <li><a href="#">Автоматизация</a></li>
                        <li><a href="#">Обучение</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            <?php else : ?>
                <div class="footer-column">
                    <h4>Компания</h4>
                    <ul>
                        <li><a href="#">О нас</a></li>
                        <li><a href="#">Кейсы</a></li>
                        <li><a href="#">Блог</a></li>
                        <li><a href="#">Контакты</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            <?php else : ?>
                <div class="footer-column">
                    <h4>Контакты</h4>
                    <ul>
                        <li><a href="mailto:<?php echo esc_attr(switchonai_get_option('contact_email', 'hello@switchonai.ru')); ?>"><?php echo esc_html(switchonai_get_option('contact_email', 'hello@switchonai.ru')); ?></a></li>
                        <li><a href="tel:<?php echo esc_attr(str_replace(array(' ', '(', ')', '-'), '', switchonai_get_option('contact_phone', '+79001234567'))); ?>"><?php echo esc_html(switchonai_get_option('contact_phone', '+7 (900) 123-45-67')); ?></a></li>
                        <li><a href="https://t.me/<?php echo esc_attr(ltrim(switchonai_get_option('telegram_username', '@switchonai'), '@')); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(switchonai_get_option('telegram_username', '@switchonai')); ?></a></li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Все права защищены.</p>
            <a href="#">Политика конфиденциальности</a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
