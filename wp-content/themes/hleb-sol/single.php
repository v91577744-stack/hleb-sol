<?php get_header(); ?>
<main class="container page-content">
<?php while (have_posts()) : the_post(); ?>
  <article>
    <h1><?php the_title(); ?></h1>
    <time><?php echo get_the_date(); ?></time>
    <?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?>
    <div><?php the_content(); ?></div>
    <p><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">← Все новости</a></p>
  </article>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
