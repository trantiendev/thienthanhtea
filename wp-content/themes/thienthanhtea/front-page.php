<?php get_header(); ?>
<div class="main">
  <section class="section section-sm">
    <div class="container container-full">
      <div id="carousel-home" class="carousel">
        <div class="carousel-items">
          <?php if( have_rows('home_carousel') ): ?>
          <?php while( have_rows('home_carousel') ): the_row();
            $carousel_image = get_sub_field('home_carousel_image');
            $carousel_link = get_sub_field('home_carousel_link');
          ?>
          <a href="<?php echo $carousel_link; ?>" target="_blank" class="carousel-img" style="background-image: url(<?php echo $carousel_image['url'] ?>)"></a>
          <?php endwhile; ?>
          <?php endif; ?>
        </div>
        <button class="carousel-prev js-carousel-prev u-hidden"></button>
        <button class="carousel-next js-carousel-next u-hidden"></button>
        <div class="carousel-dots"></div>
      </div>
    </div>
  </section>

  <section class="section section-lg u-mobile-hidden">
    <div class="container">
      <div class="row">
        <div class="col col-3 col--md-3 u-tablet-hidden">
          <div class="sidebar sidebar-overlap">
            <h3 class="sidebar-header headline">Category</h3>
            <div class="sidebar-body">
              <div class="sidebar-block">
                <a href="<?php echo home_url( '/teas/' ) ?>" class="sidebar-lead">Tea</a>
                <ul class="sidebar-list">
                  <?php
                    $parent = get_category_by_slug('teas');
                    $categories = get_categories(array(
                      'parent' => $parent->term_id,
                    ));
                    foreach($categories as $category) {
                      echo '<li class="sidebar-list-item"><a href="'. get_category_link($category->term_id) .'">'. $category->name .'</a></li>';
                    }
                  ?>
                </ul>
              </div>
              <div class="sidebar-block">
                <a href="<?php echo home_url( '/teaware/' ) ?>" class="sidebar-lead">Teaware</a>
                <ul class="sidebar-list">
                  <?php
                    $parent = get_category_by_slug('teaware');
                    $categories = get_categories(array(
                      'parent' => $parent->term_id,
                    ));
                    foreach($categories as $category) {
                      echo '<li class="sidebar-list-item"><a href="'. get_category_link($category->term_id) .'">'. $category->name .'</a></li>';
                    }
                  ?>
                </ul>
              </div>
              <div class="sidebar-block">
                <a href="<?php echo home_url( '/gift/' ) ?>" class="sidebar-lead">Gift</a>
                <ul class="sidebar-list">
                  <?php
                    $parent = get_category_by_slug('gift');
                    $categories = get_categories(array(
                      'parent' => $parent->term_id,
                    ));
                    foreach($categories as $category) {
                      echo '<li class="sidebar-list-item"><a href="'. get_category_link($category->term_id) .'">'. $category->name .'</a></li>';
                    }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <?php if( have_rows('home_thumbnails') ): ?>
        <?php while( have_rows('home_thumbnails') ): the_row();
          $image = get_sub_field('image');
      	?>
        <div class="col col-3 col--md-4">
          <div class="thumbnail" style="background-image: url(<?php echo $image['url'] ?>)"></div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="section-headline">
    <div class="container">
      <h2 class="headline-lg">New Features</h2>
    </div>
  </section>
  <section class="section section-lg">
    <div class="container">
      <div class="row">
        <?php
          $args = array(
            'post_type' => 'post',
            'category_name' => 'new feature',
            'posts_per_page' => 8,
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
      <h2 class="headline-lg">Visit Tea Garden</h2>
    </div>
  </section>
  <section class="section section-lg">
    <div class="container container-full">
      <div class="section-video">
        <?php the_field('home_video'); ?>
      </div>
    </div>
  </section>
  <section class="section-headline">
    <div class="container">
      <h2 class="headline-lg">Tea Class and Education</h2>
    </div>
  </section>
  <section class="section section-xl">
    <div class="container">
      <div class="row">
        <?php
          $args = array(
            'post_type' => 'post',
            'category_name' => 'education',
            'posts_per_page' => 4,
          );
          $_posts = new WP_Query($args);
        ?>
        <?php if($_posts->have_posts()): ?>
          <?php while($_posts->have_posts()) : $_posts->the_post();?>
            <div class="col col-3 col--md-6 col--sm-12">
              <div class="card card-secondary">
                <div class="card card-primary">
                  <?php if(has_post_thumbnail()): ?>
                  <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
                  <?php endif;?>
                  <div class="card-body">
                    <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <p class="card-content"><?php echo wp_strip_all_tags(get_the_excerpt()) ?></p>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif;?>
      </div>
    </div>
  </section>
  <?php get_footer('sup'); ?>
</div>
<?php get_footer(); ?>
