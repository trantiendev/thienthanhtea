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
                <a href="<?php echo home_url( '/teas/' ) ?>" class="sidebar-lead"><?php echo get_category_by_slug('teas')->name; ?></a>
                <ul class="sidebar-list">
                  <?php
                    // $parent = get_the_category_by_ID(icl_object_id( 19, 'category', ICL_LANGUAGE_CODE ));
                    $categories = get_categories(array(
                      'parent' => icl_object_id( 19, 'category', ICL_LANGUAGE_CODE ),
                    ));
                    foreach($categories as $category) {
                      echo '<li class="sidebar-list-item"><a href="'. get_category_link($category->term_id) .'">'. $category->name .'</a></li>';
                    }
                  ?>
                </ul>
              </div>
              <div class="sidebar-block">
                <a href="<?php echo home_url( '/teaware/' ) ?>" class="sidebar-lead"><?php echo get_category_by_slug('teaware')->name; ?></a>
                <ul class="sidebar-list">
                  <?php
                    // $parent = get_the_category_by_ID(icl_object_id( 8, 'category', ICL_LANGUAGE_CODE ));
                    
                    $categories = get_categories(array(
                      'parent' => icl_object_id( 8, 'category', ICL_LANGUAGE_CODE ),
                    ));
                    foreach($categories as $category) {
                      echo '<li class="sidebar-list-item"><a href="'. get_category_link($category->term_id) .'">'. $category->name .'</a></li>';
                    }
                  ?>
                </ul>
              </div>
              <div class="sidebar-block">
                <a href="<?php echo home_url( '/gift/' ) ?>" class="sidebar-lead"><?php echo get_category_by_slug('gift')->name; ?></a>
                <ul class="sidebar-list">
                  <?php
                    $categories = get_categories(array(
                      'parent' => icl_object_id( 9, 'category', ICL_LANGUAGE_CODE ),
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
      <h2 class="headline-lg"><?php echo get_category_by_slug('best-seller')->name; ?></h2>
    </div>
  </section>
  <section class="section section-lg list-scroll-wrapper list-scroll-unique">
    <div class="container">
      <div class="row list-scroll">
        <?php
          $args = array(
            'post_type' => 'post',
            'category_name' => 'best-seller',
            'posts_per_page' => 8,
          );
          $_posts = new WP_Query($args);
        ?>
        <?php if($_posts->have_posts()): ?>
          <?php while($_posts->have_posts()) : $_posts->the_post();?>
            <div class="col col-3 col--md-4 col--sm-12">
              <div class="card card-primary list-scroll-item <?php if (in_category('best-seller')) echo 'has-best-seller'; ?>">
                <?php if(has_post_thumbnail()): ?>
                <a href="<?php the_permalink();?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
                <?php endif;?>
                <div class="card-body">
                  <h3 class="card-headline headline"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                  <?php $product_unit = get_field('product_unit');?>
                  <p class="card-content"><?php echo $product_unit['product_unit_description']; ?></p>
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

  <section class="section section-lg">
    <div class="container container-full">
      <!-- <div class="section-video">
        <?php the_field('home_video'); ?>
      </div> -->
      <img src="<?php bloginfo('template_directory');?>/frontend_src/public/img/dummy-banner.png" alt="Image">
    </div>
  </section>

  <section class="section-headline">
    <div class="container">
      <h2 class="headline-lg">Tea Class and Education</h2>
    </div>
  </section>

  <section class="section section-lg">
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
                  </div>
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
      <h2 class="headline-lg">Our Partners</h2>
    </div>
  </section>

  <section class="section section-lg list-scroll-wrapper">
    <div class="container">
      <?php if( have_rows('home_partners') ): ?>
        <div class="row list-scroll">
          <?php while( have_rows('home_partners') ): the_row();
            $home_partners_brand = get_sub_field('partners_brand');
            $home_partners_logo = get_sub_field('partners_logo');
          ?>
          <div class="col col-3 col--md-4 col--sm-12">
            <div class="box list-scroll-item">
              <img class="box-image" src="<?php echo $home_partners_logo['url'] ?>" alt="image logo">
              <p class="box-heading"><?php echo $home_partners_brand ?></p>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
  <?php get_footer('sup'); ?>
</div>
<?php get_footer(); ?>
