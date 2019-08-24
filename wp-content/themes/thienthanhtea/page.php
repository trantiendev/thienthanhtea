<?php get_header();?>
<div class="main">
  <?php if(is_page('newsletter')): ?>
    <?php
      $page = get_page_by_title( 'newsletter' );
      $content = apply_filters('the_content', $page->post_content);
      echo $content;
    ?>
  <?php endif; ?>
<?php get_footer('sup');?>
</div>
<?php get_footer();?>
