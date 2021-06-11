<?php 
/* Template Name: Gift Page */
  get_header();
?>
<div class="main">
  <section class="section section-lg has-padding-top">
    <div class="container">
      <div class="page-title">
        <h1 class="headline-xl"><?php echo get_category_by_slug('teaware')->name; ?></h1>
        <p class="page-title-description"><?php echo wp_strip_all_tags(category_description(9)); ?></p>
      </div>
    </div>
  </section>
  <section class="section section-xl">
    <div class="container">
      <div class="row">
      <?php 
          $parent = get_category_by_slug('gift');
          $categories = get_categories(array(
            'parent' => $parent->term_id,
          ));
          foreach($categories as $category) {
            $image = get_field('category_banner_image', $category->taxonomy . '_' . $category->term_id );
            echo '
            <div class="col col-3 col--md-6 col--sm-12">
              <div class="card card-primary">
                <a href="'. get_category_link($category->term_id) .'" class="card-image" style="background-image: url('. $image['url'] .')"></a>
                <div class="card-body">
                  <h3 class="card-headline headline"><a href="'. get_category_link($category->term_id) .'">'. $category->name .'</a></h3>
                  <p class="card-content">'. $category->description .'</p>
                </div>
              </div>
            </div>';
          }
        ?>
      </div>
    </div>
  </section>

  
  <?php get_footer('sup');?>
</div>
<?php get_footer();?>
