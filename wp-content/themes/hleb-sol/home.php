<?php get_header(); ?>
<main class="container page-content">
  <h1>Новости</h1>
  <div class="news-grid">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="news-card">
      <a class="news-thumb" href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); else echo '🌾'; ?></a>
      <div class="body">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <time><?php echo get_the_date(); ?></time>
        <p><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
      </div>
    </article>
  <?php endwhile; else : ?>
    <p>Новостей пока нет.</p>
  <?php endif; ?>
  </div>
  <?php the_posts_pagination([
      'mid_size'  => 2,
      'prev_text' => '← Назад',
      'next_text' => 'Вперёд →',
  ]); ?>
</main>
<?php get_footer(); ?>
