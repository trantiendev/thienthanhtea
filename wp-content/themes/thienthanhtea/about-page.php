<?php
/* Template Name: About Us Page */
  get_header();
?>
<div class="main">
  <section class="section section-lg has-padding-top">
    <div class="container u-text-center">
      <h1 class="headline-xl u-mb-16"><?php single_post_title(); ?></h1>
      <p><?php the_field('about_page_description'); ?></p>
    </div>
  </section>

  <section class="section section-lg">
    <div class="container">
      <div class="row">

      <?php if( have_rows('about_page_post')) : ?>
        <?php while ( have_rows('about_page_post')) : the_row(); ?>

          <?php 
            $post_object = get_sub_field('about_page_media');
            if( $post_object ) :
            $post = $post_object;
            setup_postdata($post);
          ?>

          <div class="col col-3 col--md-6 col--sm-12">
            <div class="card card-secondary">
              <div class="card card-primary">
                <a href="<?php the_permalink(); ?>" class="card-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></a>
                <div class="card-body">
                  <h3 class="card-headline headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div>
              </div>
            </div>
          </div>

          <?php wp_reset_postdata(); ?>
          <?php endif; ?> 
        <?php endwhile; ?>
      <?php endif; ?>
        
      </div>
    </div>
  </section>

  <section class="section section-lg">
    <div class="container">
      <div class="row">
        <div class="col col-8 col-offset-2 col--md-10 col--md-offset-1">
          <div class="post">
            <?php echo get_the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php get_footer('sup');?>  
</div>
<?php get_footer();?>
