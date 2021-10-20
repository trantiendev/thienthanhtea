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
      <h1 class="archive-title h2"><?php post_type_archive_title(); ?></h1>
    </div>
  </section>

  <section class="section section-xl">
    <div class="container">
  
      <?php
        $term = get_queried_object();
        $post_type = 'post';
        $taxonomy = $term->taxonomy;

        $term_args = array('parent' => $term->term_id, 'orderby'=>'id', 'order'=>'ASC', 'hide_empty'=>false, );
        $get_terms = get_terms($taxonomy, $term_args);
        
      ?>
      <?php if($get_terms) : foreach($get_terms as $parent) : ?>
        <h3 class="headline-lg is-list-category">
          <a href="<?php echo get_term_link($parent, $parent->taxonomy); ?>"><?php echo $parent->name ?></a>
        </h3>

        <div class="row list-row-archive-category">
          <?php
            $parent_id = $parent->term_id; //Store the category ID as a variable to be used in WP_Query
            $term_children = get_term_children( $parent_id, $taxonomy );

            if(count($term_children) > 0) {
              foreach ( $term_children as $child ) {
              $term = get_term_by( 'id', $child, $taxonomy );
              $child_id = $term->term_id;
              echo '<p><a href="' . get_term_link( $child, $taxonomy ) . '">' . $term->name . '</a></p>';

              wpq_posts_list($post_type, $taxonomy, $child_id);

              }
            } else {
              wpq_posts_list($post_type, $taxonomy, $parent_id);
            }
          ?>
        </div>

        <?php endforeach; else: ?>
          <!-- display grouped without parent category -->
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
        <?php endif; ?>

        <!-- display grouped with parent category -->
        <?php 
         function wpq_posts_list($post_type, $taxonomy, $term_id) {
          $args = array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
            'tax_query' => array(
              array(
              'taxonomy' => $taxonomy,
              'field' => 'id',
              'terms' => $term_id,
              ),
            ),
          );

          $wpq = new WP_Query($args);
        ?>
        <?php if ($wpq->have_posts()) : while($wpq->have_posts()) : $wpq->the_post();?>
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
        <?php endwhile; endif; } ?> 
    </div>
  </section>

  <?php get_footer('sup');?>
</div>
<?php get_footer();?>
