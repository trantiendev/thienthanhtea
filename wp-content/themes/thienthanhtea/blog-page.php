<?php
/* Template Name: Blog Page */
  get_header();
?>
<div class="main">
  <section class="section section-lg has-padding-top">
    <div class="container">
      <div class="page-title">
        <h1 class="headline-xl">Blog</h1>
        <p class="page-title-description"><?php the_field('blog_page_description'); ?></p>
      </div>
    </div>
  </section>

  <section class="section section-sm">
    <div class="container">
      <div class="tabnav js-filter-post">
        <label class="tabnav-item">
          <input type="radio" name="radio-tab" value="all" checked>
          <span><?php _e('Tất Cả', 'blogTab'); ?></span>
        </label>
        <label class="tabnav-item">
          <input type="radio" name="radio-tab" value="tea-knowledge">
          <span><?php _e('Kiến Thức Trà', 'blogTab'); ?></span>
        </label>
        <label class="tabnav-item">
          <input type="radio" name="radio-tab" value="tea-brew">
          <span><?php _e('Công Thức Pha Chế Trà', 'blogTab'); ?></span>
        </label>
        <label class="tabnav-item">
          <input type="radio" name="radio-tab" value="news">
          <span><?php _e('Tin Tức', 'blogTab'); ?></span>
        </label>
        <label class="tabnav-item">
          <input type="radio" name="radio-tab" value="hiring">
          <span><?php _e('Tuyển Dụng', 'blogTab'); ?></span>
        </label>
      </div>
    </div>
  </section>

  <section id="all" class="section section-lg js-tab-content">
    <div class="container">
      <?php
        $args = array(
          'post_type' => 'post',
          'category_name' => 'hiring,tea-brew,tea-knowledge,news',
          'posts_per_page' => -1
        );
        $_posts = new WP_Query($args);
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      ?>
      <?php if($_posts->have_posts()): ?>
        <?php while($_posts->have_posts()) : $_posts->the_post();?>
      <div class="card card-tertiary">
        <?php if(has_post_thumbnail()): ?>
        <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
        <?php endif;?>
        <div class="card-body">
          <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
          <p class="card-description"><?php echo get_the_date(get_option('date_format')); ?></p>
        </div>
      </div>
        <?php endwhile; ?>
      <?php endif; wp_reset_postdata();?>
    </div>
  </section>

  <section id="tea-knowledge" class="section section-lg u-hidden js-tab-content">
    <div class="container">
      <?php
        $args = array(
          'post_type' => 'post',
          'category_name' => 'tea-knowledge',
          'posts_per_page' => -1
        );
        $_posts = new WP_Query($args);
      ?>
      <?php if($_posts->have_posts()): ?>
        <?php while($_posts->have_posts()) : $_posts->the_post();?>
      <div class="card card-tertiary">
        <?php if(has_post_thumbnail()): ?>
        <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
        <?php endif;?>
        <div class="card-body">
          <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
          <p class="card-description"><?php echo get_the_date(get_option('date_format')); ?></p>
        </div>
      </div>
        <?php endwhile; ?>
      <?php endif;?>
    </div>
  </section>

  <section id="tea-brew" class="section section-lg u-hidden js-tab-content">
    <div class="container">
      <?php
        $args = array(
          'post_type' => 'post',
          'category_name' => 'tea-brew',
          'posts_per_page' => -1
        );
        $_posts = new WP_Query($args);
      ?>
      <?php if($_posts->have_posts()): ?>
        <?php while($_posts->have_posts()) : $_posts->the_post();?>
      <div class="card card-tertiary">
        <?php if(has_post_thumbnail()): ?>
        <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
        <?php endif;?>
        <div class="card-body">
          <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
          <p class="card-description"><?php echo get_the_date(get_option('date_format')); ?></p>
        </div>
      </div>
        <?php endwhile; ?>
      <?php endif;?>
    </div>
  </section>

  <section id="news" class="section section-lg u-hidden js-tab-content">
    <div class="container">
      <?php
        $args = array(
          'post_type' => 'post',
          'category_name' => 'news',
          'posts_per_page' => -1
        );
        $_posts = new WP_Query($args);
      ?>
      <?php if($_posts->have_posts()): ?>
        <?php while($_posts->have_posts()) : $_posts->the_post();?>
      <div class="card card-tertiary">
        <?php if(has_post_thumbnail()): ?>
        <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
        <?php endif;?>
        <div class="card-body">
          <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
          <p class="card-description"><?php echo get_the_date(get_option('date_format')); ?></p>
        </div>
      </div>
        <?php endwhile; ?>
      <?php endif;?>
    </div>
  </section>

  <section id="hiring" class="section section-lg u-hidden js-tab-content">
    <div class="container">
      <?php
        $args = array(
          'post_type' => 'post',
          'category_name' => 'hiring',
          'posts_per_page' => -1
        );
        $_posts = new WP_Query($args);
      ?>
      <?php if($_posts->have_posts()): ?>
        <?php while($_posts->have_posts()) : $_posts->the_post();?>
      <div class="card card-tertiary">
        <?php if(has_post_thumbnail()): ?>
        <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
        <?php endif;?>
        <div class="card-body">
          <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
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
