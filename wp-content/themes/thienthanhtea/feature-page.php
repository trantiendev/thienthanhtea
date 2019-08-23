<?php
/* Template Name: Feature Page */
  get_header();
?>
<div class="main">
  <section class="section section-lg has-padding-top">
    <div class="container">
      <div class="page-title">
        <h1 class="headline-xl">Best Offers</h1>
        <p class="page-title-description">Oolong Tea is attractive for its rich floral and fruity fragrance.<br> By visiting tea gardens.</p>
      </div>
    </div>
  </section>
  <section class="section-headline">
    <div class="container">
      <h2 class="headline-lg">Features</h2>
    </div>
  </section>
  <section class="section section-lg">
    <div class="container">
      <div class="row">
        <?php
          $args = array(
            'post_type' => 'post',
            'category_name' => 'features'
          );
          $_posts = new WP_Query($args);
        ?>
        <?php if($_posts->have_posts()): ?>
          <?php while($_posts->have_posts()) : $_posts->the_post();?>
            <div class="col col-3 col--md-6 col--sm-12">
              <div class="card card-primary">
                <?php if(has_post_thumbnail()): ?>
                <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
                <?php endif;?>
                <div class="card-body">
                  <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                  <p class="card-content"><?php echo wp_strip_all_tags(get_the_excerpt()) ?></p>
                  <?php $product_unit = get_field('product_unit');?>
                  <p class="card-price">
                    <?php echo $product_unit['product_unit_price']; ?>
                    <?php if($product_unit['product_unit_weight']):?>
                    <span class="card-description"> / <?php echo $product_unit['product_unit_weight']; ?></span>
                    <?php endif;?>
                  </p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; wp_reset_postdata();?>
      </div>
    </div>
  </section>
  <section class="section-headline">
    <div class="container">
      <h2 class="headline-lg">Best Seller</h2>
    </div>
  </section>
  <section class="section section-lg">
    <div class="container">
      <div class="row">
        <?php
          $args = array(
            'post_type' => 'post',
            'category_name' => 'best-seller'
          );
          $_posts = new WP_Query($args);
        ?>
        <?php if($_posts->have_posts()): ?>
          <?php while($_posts->have_posts()) : $_posts->the_post();?>
            <div class="col col-3 col--md-6 col--sm-12">
              <div class="card card-primary">
                <?php if(has_post_thumbnail()): ?>
                <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
                <?php endif;?>
                <div class="card-body">
                  <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                  <p class="card-content"><?php echo wp_strip_all_tags(get_the_excerpt()) ?></p>
                  <?php $product_unit = get_field('product_unit');?>
                  <p class="card-price">
                    <?php echo $product_unit['product_unit_price']; ?>
                    <?php if($product_unit['product_unit_weight']):?>
                    <span class="card-description"> / <?php echo $product_unit['product_unit_weight']; ?></span>
                    <?php endif;?>
                  </p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; wp_reset_postdata();?>
      </div>
    </div>
  </section>
  <section class="section-headline">
    <div class="container">
      <h2 class="headline-lg">Special Discount</h2>
    </div>
  </section>
  <section class="section section-lg">
    <div class="container">
      <div class="row">
        <?php
          $args = array(
            'post_type' => 'post',
            'category_name' => 'special-discount'
          );
          $_posts = new WP_Query($args);
        ?>
        <?php if($_posts->have_posts()): ?>
          <?php while($_posts->have_posts()) : $_posts->the_post();?>
            <div class="col col-3 col--md-6 col--sm-12">
              <div class="card card-primary">
                <?php if(has_post_thumbnail()): ?>
                <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
                <?php endif;?>
                <div class="card-body">
                  <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                  <p class="card-content"><?php echo wp_strip_all_tags(get_the_excerpt()) ?></p>
                  <?php $product_unit = get_field('product_unit');?>
                  <p class="card-price">
                    <?php echo $product_unit['product_unit_price']; ?>
                    <?php if($product_unit['product_unit_weight']):?>
                    <span class="card-description"> / <?php echo $product_unit['product_unit_weight']; ?></span>
                    <?php endif;?>
                  </p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; wp_reset_postdata();?>
      </div>
    </div>
  </section>
  <?php get_footer('sup');?>
</div>
<?php get_footer();?>
