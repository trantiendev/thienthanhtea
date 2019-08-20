<?php get_header();?>
<div class="main">
<section class="section section-lg has-no-padding">
    <div class="container">
      <div class="row category-title">
        <div class="col col-4 col--md-5 col--sm-12">
          <h1 class="headline-xl"><?php single_cat_title();?></h1>
        </div>
        <div class="col col-7 col-offset-1 col--md-offset-1 col--md-6 col--sm-12">
          <?php the_archive_description(); ?>
        </div>
      </div>
    </div>
  </section>
  <section class="section section-lg">
    <div class="container container-full">
      <?php
        $term = get_queried_object();
        $category_image = get_field('category_banner_image', $term);
      ?>
      <div class="category-hero" style="background-image: url(<?php echo $category_image['url']; ?>)"></div>
    </div>
  </section>
  <section class="section section-xl">
    <div class="container">
      <div class="row">
      <?php if (have_posts()) : while(have_posts()) : the_post();?>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-primary">
            <?php if(has_post_thumbnail()): ?>
              <a href="<?php the_permalink(); ?>" class="card-image" style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></a>
            <?php endif;?>
            <div class="card-body">
              <h3 class="card-headline headline"><a href="<?php the_permalink(); ?>"><?php  the_title();?></a></h3>
              <p class="card-content"><?php echo wp_strip_all_tags(get_the_excerpt()) ?></p>
              <p class="card-price">$ Price tag <span class="card-description">/ Net weight (OZ)</span></p>
            </div>
          </div>
        </div>
      <?php  endwhile; endif; ?> 
      </div>
    </div>
  </section>
  <?php get_footer('sup');?>
</div>
<?php get_footer();?>
