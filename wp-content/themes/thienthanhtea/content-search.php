<div class="col col-3 col--md-6 col--sm-12">
  <div id="post-<?php the_ID(); ?>" class="card card-primary">
    <?php if(has_post_thumbnail()): ?>
      <a href="<?php the_permalink(); ?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
    <?php endif;?>
    <div class="card-body">
      <h3 class="card-headline headline"><a href="post.html"><?php the_title(); ?></a></h3>
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
