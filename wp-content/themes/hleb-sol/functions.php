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

// Картинки: берём файлы из папки темы /images (товары по артикулу HS-001..., новости по ссылке записи).
// Срабатывает один раз; чтобы заменить картинки заново, откройте в админке любую страницу с ?hs_images=1
add_action('admin_init', function () {
    $force = isset($_GET['hs_images']) && current_user_can('manage_options');
    if ((get_option('hs_images_done') === '3' && !$force) || !function_exists('wc_get_product_id_by_sku')) return;
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $dir = get_template_directory() . '/images/';
    $put = function ($base, $post_id) use ($force) {
        $file = '';
        foreach (['jpg', 'jpeg', 'png', 'webp', 'JPG', 'JPEG', 'PNG'] as $ext) {
            if (file_exists($base . '.' . $ext)) { $file = $base . '.' . $ext; break; }
        }
        if (!$file) return;
        if (has_post_thumbnail($post_id)) {
            if (!$force) return;
            wp_delete_attachment(get_post_thumbnail_id($post_id), true);
        }
        $tmp = wp_tempnam($file);
        copy($file, $tmp);
        $id = media_handle_sideload(['name' => basename($file), 'tmp_name' => $tmp], $post_id);
        if (is_wp_error($id)) { @unlink($tmp); return; }
        set_post_thumbnail($post_id, $id);
    };
    for ($i = 1; $i <= 15; $i++) {
        $sku = sprintf('HS-%03d', $i);
        $pid = wc_get_product_id_by_sku($sku);
        if ($pid) $put($dir . 'products/' . $sku, $pid);
    }
    foreach (get_posts(['post_type' => 'post', 'numberposts' => -1, 'post_status' => 'any']) as $p) {
        $put($dir . 'news/' . $p->post_name, $p->ID);
    }
    update_option('hs_images_done', '3');
});
