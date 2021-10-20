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
                      echo '<li class="sidebar-list-item"><a href="'. get_category_link($category->term_id) .'">'.($category->slug !== 'export' ? $category->name : '').'</a></li>';
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

              <div class="sidebar-block">
                <a href="<?php echo get_category_link(74); ?> " class="sidebar-lead"><?php echo get_category_by_slug('export')->name; ?></a>
                <ul class="sidebar-list">
                  <?php
                    $categories = get_categories(array(
                      'parent' => icl_object_id( 74, 'category', ICL_LANGUAGE_CODE ),
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
          $link = get_sub_field('link');
      	?>
        <div class="col col-3 col--md-4">
          <a href="<?php echo $link; ?>" target="_blank" class="thumbnail" style="background-image: url(<?php echo $image['url'] ?>)"></a>
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
  <section id="carousel-list-best-seller" class="section section-lg list-scroll-wrapper list-scroll-unique">
    <div class="container">
      <div class="carousel-items list-scroll-best-seller">
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
          <div class="col">
            <div class="card card-primary <?php if (in_category('best-seller')) echo 'has-best-seller is-carousel'; ?>">
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
    <button class="carousel-next js-carousel-next u-hidden"></button>
    <button class="carousel-prev js-carousel-prev u-hidden"></button>
  </section>

  <section class="section">
    <div class="container container-full">
    <?php
      $select_value = get_field('home_select_video_or_banner');
      $home_banner = get_field('home_banner');
    ?>
      <?php if( $select_value == 'Banner' ): ?>
        <img class="u-vertical-middle" src="<?php echo esc_url($home_banner['url']); ?>" alt="<?php echo esc_attr($home_banner['banner image']); ?>">

      <?php elseif( $select_value == 'Video' ) : ?>
        <div class="section-video">
          <?php
            $iframe = get_field('home_video');

            preg_match('/src="(.+?)"/', $iframe, $matches);
            $src = $matches[1];

            $params = array(
              'autoplay' => 1
            );
            $new_src = add_query_arg($params, $src);
            $iframe = str_replace($src, $new_src, $iframe);

            $attributes = 'frameborder="0"&mute=1';
            $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

            echo $iframe;
          ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="section section-balance section-education">
    <div class="container">
      <div class="section-headline">
        <div class="container">
          <?php if( have_rows('home_section_title') ): ?>
            <?php while( have_rows('home_section_title') ): the_row();
              $headline_tea_class_and_education = get_sub_field('headline_tea_class_and_education');
            ?>
            <h2 class="headline-lg"><?php echo $headline_tea_class_and_education; ?></h2>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="row has-balance-height">
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

  <section class="section section-headline has-padding-top">
    <div class="container">
      <?php if( have_rows('home_section_title') ): ?>
        <?php while( have_rows('home_section_title') ): the_row();
          $headline_our_partners = get_sub_field('headline_our_partners');
        ?>
        <h2 class="headline-lg"><?php echo $headline_our_partners ?></h2>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </section>

  <section id="carousel-list-partners" class="section section-lg list-scroll-wrapper">
    <div class="container container-full">
      <?php if( have_rows('home_partners') ): ?>

        <div class="list-scroll carousel-items">
          <?php while( have_rows('home_partners') ): the_row();
            $home_partners_brand = get_sub_field('partners_brand');
            $home_partners_logo = get_sub_field('partners_logo');
          ?>
            <div class="box list-scroll-item">
              <img class="box-image" src="<?php echo $home_partners_logo['url'] ?>" alt="image logo">
              <p class="box-heading"><?php echo $home_partners_brand ?></p>
            </div>
   
          <?php endwhile; ?>
        </div>

        <button class="carousel-prev js-carousel-prev u-hidden"></button>
        <button class="carousel-next js-carousel-next u-hidden"></button>
      <?php endif; ?>
    </div>
  </section>
  <?php get_footer('sup'); ?>
</div>
<?php get_footer(); ?>
