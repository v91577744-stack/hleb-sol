<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
  <div class="container header-in">
    <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">🌾 Хлеб Соль</a>
    <?php wp_nav_menu([
        'theme_location' => 'main',
        'container'      => 'nav',
        'menu_class'     => 'menu',
        'fallback_cb'    => 'hs_fallback_menu',
    ]); ?>
    <?php if (function_exists('WC')) : ?>
    <a class="cart-link" href="<?php echo esc_url(wc_get_cart_url()); ?>">Корзина (<span class="cart-count"><?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?></span>)</a>
    <?php endif; ?>
  </div>
</header>
