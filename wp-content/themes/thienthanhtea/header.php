<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>
  <?php
    if (function_exists('is_tag') && is_tag()) {
        single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
    elseif (is_archive()) {
        wp_title(''); echo ' Archive - '; }
    elseif (is_search()) {
        echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
    elseif ( !(is_404()) && (is_single()) || (is_page()) && !(is_front_page()) ) {
        wp_title(''); echo ' - ';}
    elseif (is_404()) {
        echo 'Not Found - '; }

    if (is_home()) {
        bloginfo('name'); echo ' - '; bloginfo('description');
    } else {
      bloginfo('name');
    }
    if ($paged>1) echo ' - page '. $paged;
  ?>
  </title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700&display=swap" rel="stylesheet">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P4C2NS2');</script>
<!-- End Google Tag Manager -->

  <?php wp_head(); ?>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4C2NS2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <header class="header">
  <nav class="container">
    <div class="navbar js-navbar">
      <div class="navbar-collapse js-navbar-collapse"></div>
      <?php
      $dropdown_walker = new Dropdown_List_Walker;
      wp_nav_menu(
        array (
          'theme_location' => 'top-menu',
          'container' => 'ul',
          'menu_class' => 'navbar-list',
          'walker' => $dropdown_walker,
        )
      );
    ?>
      <a href="<?php echo get_option("siteurl"); ?>" class="navbar-brand"><img src="<?php bloginfo('template_directory');?>/frontend_src/public/img/ico_logo.png" alt="ico logo"></a>
      <div class="navbar-search js-navbar-search">
        <button class="btn btn-search navbar-search-btn js-btn-seach"></button>
        <?php get_search_form(); ?>
      </div>
    </div>
  </nav>
</header>
