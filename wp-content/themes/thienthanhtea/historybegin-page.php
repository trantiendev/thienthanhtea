<?php
/* Template Name: History Begin Page */
  get_header();
?>
<div class="main">
  <section class="section section-lg has-padding-top">
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