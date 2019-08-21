<?php get_header();?>
<div class="main">
  <?php if (have_posts()) : while(have_posts()) : the_post();?>
    <section class="section section-md">
      <div class="container container-full">
      <?php if( have_rows('single_post_carousel') ): ?>
        <div id="carousel-post" class="carousel">
          <div class="carousel-items">
            <?php while( have_rows('single_post_carousel') ): the_row();
              $single_post_carousel_image = get_sub_field('single_post_carousel_image');
            ?>
            <div class="carousel-img" style="background-image: url(<?php echo $single_post_carousel_image['url'] ?>)"></div>
            <?php endwhile; ?>
          </div>
          <div class="carousel-thumbnails">
            <div class="container">
              <div class="row">
                <div class="col col-7 col--md-7 col--sm-12">
                  <ul class="list-image">
                    <?php while( have_rows('single_post_carousel') ): the_row();
                      $single_post_carousel_image = get_sub_field('single_post_carousel_image');
                    ?>
                    <li class="list-image-item" style="background-image: url(<?php echo $single_post_carousel_image['url'] ?>)"></li>
                    <?php endwhile; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <button class="carousel-prev js-carousel-prev u-hidden"><</button>
          <button class="carousel-next js-carousel-next u-hidden">></button>
        </div>
        <?php endif; ?>
      </div>
    </section>
    <section class="section section-lg">
      <div class="container">
        <div class="row row-reverse">
          <div class="col col-7 col--md-7 col--sm-12">
            <h3 class="headline u-mb-24">Summary</h3>
            <ul class="list-description">
              <?php if( have_rows('list_description') ): ?>
                <?php while( have_rows('list_description') ): the_row();
                  $list_description_label = get_sub_field('list_description_label');
                  $list_description_info = get_sub_field('list_description_info');
                ?>
                <li class="list-description-item">
                  <p class="list-description-label"><?php echo $list_description_label; ?></p>
                  <p class="list-description-body"><?php echo $list_description_info; ?></p>
                </li>
                <?php endwhile; ?>
              <?php endif; ?>
            </ul>
          </div>
          <div class="col col-4 col-offset-1 col--md-5 col--sm-12">
            <div class="banner banner-overlap">
              <h3 class="banner-title headline-lg"><?php the_title(); ?></h3>
              <p class="banner-text"><?php echo wp_strip_all_tags(get_the_content()) ?></p>
              <?php $product_unit = get_field('product_unit');?>
              <p class="banner-price headline"><?php echo $product_unit['product_unit_price']; ?></p>
              <p class="banner-info"><?php echo $product_unit['product_unit_weight']; ?></p>
              <a href="<?php echo $product_unit['product_unit_link']; ?>" class="btn btn-primary" target="_blank">Mua không</a>
            </div>
            <h3 class="headline u-mb-24 u-mt-40">Recommend Brewing Method</h3>
            <div class="content">
              <div class="content-block">
                <p class="content-title content-title-sm">Cup Method</p>
                <ul class="list-infomation">
                  <?php if( have_rows('list_cup_method') ): ?>
                    <?php while( have_rows('list_cup_method') ): the_row();
                      $list_cup_method_text = get_sub_field('list_cup_method_text');
                    ?>
                    <li><?php echo $list_cup_method_text ?></li>
                    <?php endwhile; ?>
                  <?php endif; ?>
                </ul>
              </div>
              <div class="content-block">
                <p class="content-title content-title-sm">Chinese Gongfu Method</p>
                <ul class="list-infomation">
                  <?php if( have_rows('list_chinese_gongfu_method') ): ?>
                    <?php while( have_rows('list_chinese_gongfu_method') ): the_row();
                      $list_chinese_gongfu_method_text = get_sub_field('list_chinese_gongfu_method_text');
                    ?>
                    <li><?php echo $list_chinese_gongfu_method_text; ?></li>
                    <?php endwhile; ?>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-lg">
      <div class="container">
        <div class="separator"></div>
      </div>
    </section>
    <section class="section section-lg">
      <div class="container">
        <div class="row">
          <div class="col col-8 col-offset-2">
            <div class="post">
              <?php if( have_rows('single_post_content_large') ): ?>
              <?php while( have_rows('single_post_content_large') ): the_row();
                $single_post_content_large_image = get_sub_field('single_post_content_large_image');
                $single_post_content_large_title = get_sub_field('single_post_content_large_title');
                $single_post_content_large_text = get_sub_field('single_post_content_large_text');
              ?>
              <?php if($single_post_content_large_image): ?>
                <img class="post-image" src="<?php echo $single_post_content_large_image; ?>" alt="">
              <?php endif;?>

              <?php if($single_post_content_large_title || $single_post_content_large_text): ?>
              <div class="row">
                <div class="col col-10 col-offset-1">
                  <div class="content">
                    <?php if($single_post_content_large_title): ?>
                    <h3 class="content-title content-title-lg"><?php echo $single_post_content_large_title; ?></h3>
                    <?php endif;?>
                    <?php if($single_post_content_large_text): ?>
                    <div class="content-text"><?php echo $single_post_content_large_text; ?></div>
                    <?php endif;?>
                  </div>
                </div>
              </div>
              <?php endif;?>

              <?php endwhile; ?>
              <?php endif; ?>

              <?php if( have_rows('single_post_content_small') ): ?>
              <?php while( have_rows('single_post_content_small') ): the_row();
                $single_post_content_small_image_1 = get_sub_field('single_post_content_small_image_1');
                $single_post_content_small_image_2 = get_sub_field('single_post_content_small_image_2');
                $single_post_content_small_caption = get_sub_field('single_post_content_small_caption');
                $single_post_content_small_title = get_sub_field('single_post_content_small_title');
                $single_post_content_small_text = get_sub_field('single_post_content_small_text');
              ?>

              <?php if($single_post_content_small_image_1 || $single_post_content_small_image_2): ?>
              <div class="post-thumbnail">
                <div class="row">
                  <div class="col col-6 col--md-6 col--sm-10 col--sm-offset-1">
                    <?php if($single_post_content_small_image_1): ?>
                    <img src="<?php echo $single_post_content_small_image_1; ?>" alt="">
                    <?php endif;?>
                  </div>
                  <div class="col col-6 col--md-6 col--sm-10 col--sm-offset-1">
                    <?php if($single_post_content_small_image_2): ?>
                    <img src="<?php echo $single_post_content_small_image_2; ?>" alt="">
                    <?php endif;?>
                  </div>
                </div>
              </div>
              <?php endif;?>

              <?php if($single_post_content_small_caption): ?>
              <p class="post-caption"><?php echo $single_post_content_small_caption; ?></p>
              <?php endif;?>

              <?php if($single_post_content_small_title || $single_post_content_small_text): ?>
              <div class="row">
                <div class="col col-10 col-offset-1">
                  <div class="content">
                    <?php if($single_post_content_small_title): ?>
                    <h3 class="content-title content-title-lg"><?php echo $single_post_content_small_title; ?></h3>
                    <?php endif;?>
                    <?php if($single_post_content_small_text): ?>
                    <div class="content-text"><?php echo $single_post_content_small_text; ?></div>
                    <?php endif;?>
                  </div>
                </div>
              </div>
              <?php endif; ?>

              <?php endwhile; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php  endwhile; endif; ?>
  <?php get_footer('sup');?>
</div>
<?php get_footer();?>
