<?php
// Подключение стилей и шрифтов
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('hs-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=PT+Serif:wght@400;700&subset=cyrillic&display=swap', [], null);
    wp_enqueue_style('hs-style', get_stylesheet_uri(), [], '1.0');
});

// Возможности темы
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    register_nav_menus(['main' => 'Главное меню']);
});

// Счётчик корзины обновляется без перезагрузки страницы
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    $fragments['span.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
    return $fragments;
});

// Меню по умолчанию, пока не создано в админке
function hs_fallback_menu() {
    echo '<ul class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Главная</a></li>';
    if (function_exists('wc_get_page_permalink')) {
        echo '<li><a href="' . esc_url(wc_get_page_permalink('shop')) . '">Каталог</a></li>';
    }
    $news = get_option('page_for_posts');
    if ($news) echo '<li><a href="' . esc_url(get_permalink($news)) . '">Новости</a></li>';
    $c = get_page_by_path('kontakty');
    if (!$c) $c = get_page_by_path('контакты');
    if ($c) echo '<li><a href="' . esc_url(get_permalink($c)) . '">Контакты</a></li>';
    echo '</ul>';
}
