<?php
$terms = get_page_by_path('terms');
$terms_url = $terms ? get_permalink($terms) : '#';
?>
<footer class="site-footer">
  <div class="container footer-in">
    <p>© <?php echo date('Y'); ?> «Хлеб Соль». Все права защищены.</p>
    <a href="<?php echo esc_url($terms_url); ?>">Условия использования сервисом</a>
    <div class="social">
      <a href="https://vk.com/" target="_blank" rel="noopener">ВКонтакте</a>
      <a href="https://t.me/" target="_blank" rel="noopener">Telegram</a>
      <a href="https://ok.ru/" target="_blank" rel="noopener">Одноклассники</a>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
