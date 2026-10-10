<?php get_header();
$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/');
?>

<section class="hero">
  <h1>Хлеб да соль!</h1>
  <p>Вкус настоящей русской кухни: борщ, пельмени, блины и пироги, как у бабушки.</p>
  <a class="btn" href="<?php echo esc_url($shop_url); ?>">Перейти в каталог</a>
</section>

<section class="section">
  <div class="container about">
    <div>
      <h2 style="text-align:left">О нас</h2>
      <p>«Хлеб Соль» готовит блюда по старинным русским рецептам. Мы берём свежие продукты, натуральное сливочное масло и настоящую русскую печь, а значит, вкус получается домашним.</p>
      <p>Хлеб и соль издавна встречали дорогих гостей. Мы хотим, чтобы каждый наш покупатель чувствовал себя именно так.</p>
    </div>
    <div class="about-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/about.jpg" alt="Хлеб Соль" style="width:100%;border-radius:10px;display:block"></div>
  </div>
</section>

<section class="section" style="background:#fff">
  <div class="container">
    <h2>Популярные блюда</h2>
    <?php echo do_shortcode('[products limit="4" columns="4" visibility="featured"]'); ?>
    <p style="text-align:center"><a class="btn" href="<?php echo esc_url($shop_url); ?>">Весь каталог</a></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Почему мы</h2>
    <div class="cards">
      <div class="card"><div class="ico">🥕</div><h3>Свежие продукты</h3><p>Работаем с местными фермерами и берём только свежее.</p></div>
      <div class="card"><div class="ico">👵</div><h3>Домашние рецепты</h3><p>Готовим по проверенным рецептам русской кухни.</p></div>
      <div class="card"><div class="ico">🚚</div><h3>Быстрая доставка</h3><p>Привозим горячими прямо к вашему столу.</p></div>
    </div>
  </div>
</section>

<section class="section" style="background:#fff">
  <div class="container">
    <h2>Последние новости</h2>
    <div class="news-grid">
    <?php $q = new WP_Query(['posts_per_page' => 3]);
    if ($q->have_posts()) : while ($q->have_posts()) : $q->the_post(); ?>
      <article class="news-card">
        <a class="news-thumb" href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); else echo '🌾'; ?></a>
        <div class="body">
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <time><?php echo get_the_date(); ?></time>
          <p><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
        </div>
      </article>
    <?php endwhile; wp_reset_postdata(); else : ?>
      <p>Новостей пока нет.</p>
    <?php endif; ?>
    </div>
  </div>
</section>

<section class="cta">
  <h2 style="margin-top:0">Проголодались?</h2>
  <p>Выбирайте блюда в каталоге и оформляйте заказ.</p>
  <a class="btn" href="<?php echo esc_url($shop_url); ?>">Заказать</a>
</section>

<?php get_footer(); ?>
