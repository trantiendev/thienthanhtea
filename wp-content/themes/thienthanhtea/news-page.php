<?php
/* Template Name: News Page */
  get_header();
?>
<div class="main">
  <section class="section section-lg has-padding-top">
    <div class="container">
      <div class="page-title">
        <h1 class="headline-xl">Newsroom</h1>
        <p class="page-title-description">Oolong Tea is attractive for its rich floral and fruity fragrance.<br> By visiting tea gardens.</p>
      </div>
    </div>
  </section>
  <section class="section section-lg">
    <div class="container">
      <?php
        $args = array(
          'post_type' => 'post',
          'category_name' => 'news'
        );
        $_posts = new WP_Query($args);
      ?>
      <?php if($_posts->have_posts()): ?>
        <?php while($_posts->have_posts()) : $_posts->the_post();?>
      <div class="card card-tertiary">
        <?php if(has_post_thumbnail()): ?>
        <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url('product_image_small'); ?>)"></a>
        <?php endif;?>
        <div class="card-body">
          <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
          <p class="card-content"><?php echo wp_strip_all_tags(get_the_excerpt()) ?></p>
          <p class="card-description"><?php echo get_the_date(get_option('date_format')); ?></p>
        </div>
      </div>
      <?php endwhile; ?>
      <?php endif;?>
    </div>
  </section>
  <?php get_footer('sup'); ?>
</div>
<?php get_footer();?>
