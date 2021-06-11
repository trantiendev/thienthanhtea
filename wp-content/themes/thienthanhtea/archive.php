<?php get_header();?>
<div class="main">
<section class="section section-lg has-no-padding">
    <div class="container">
      <div class="row category-title">
        <div class="col col-4 col--md-12 col--sm-12">
          <h1 class="headline-xl category-title-lead"><?php single_cat_title();?></h1>
        </div>
        <div class="col col-7 col-offset-1 col--md-offset-0 col--md-12 col--sm-12">
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
          
          <div class="card card-primary <?php if (in_category('best-seller')) echo 'has-best-seller'; ?>">
            <?php if(has_post_thumbnail()): ?>
              <a href="<?php the_permalink(); ?>" class="card-image" style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></a>
            <?php endif;?>
            <div class="card-body">
              <h3 class="card-headline headline"><a href="<?php the_permalink(); ?>"><?php  the_title();?></a></h3>
              <?php $product_unit = get_field('product_unit');?>
              <p class="card-content"><?php echo $product_unit['product_unit_description']; ?></p>
              <p class="card-price"><?php echo $product_unit['product_unit_price']; ?>
                <?php if($product_unit['product_unit_weight']):?>
                <span class="card-description"> / <?php echo $product_unit['product_unit_weight']; ?></span>
                <?php endif;?>
              </p>
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
