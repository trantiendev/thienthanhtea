<?php get_header();?>
<div class="main">
  <section class="section section-lg has-padding-top">
    <div class="container">
      <div class="page-title">
        <h1 class="headline-xl">Whoops, that page is gone</h1>
        <p class="page-title-description">Clicked here to go back to homepage</p>
        <a class="btn btn-primary u-mt-40 w-276" href="<?php echo get_option("siteurl"); ?>">Go to Homepage</a>
      </div>
    </div>
  </section>
  <?php get_footer('sup');?>
</div>
<?php get_footer();?>
