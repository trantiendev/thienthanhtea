<?php get_header();
global $wp_query;
$total_results = $wp_query->found_posts;
?>
<div class="main">
  <section class="section section-lg has-padding-top">
    <div class="container">
      <div class="page-title">
        <h1 class="headline-xl">Kết quả tìm kiếm: “<?php echo get_search_query() ?>”</h1>
        <p class="page-title-description">Có <?= $total_results ?> kết quả tìm kiếm</p>
      </div>
    </div>
  </section>

  <section class="section section-lg">
    <div class="container">
      <div class="row">
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
          <?php get_template_part('content', 'search') ?>
        <?php endwhile; else : ?>
          <p><?php esc_html_e('Không tìm thấy sản phẩm nào khớp với lựa chọn của bạn.'); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php get_footer('sup');?>
</div>
<?php get_footer();?>
