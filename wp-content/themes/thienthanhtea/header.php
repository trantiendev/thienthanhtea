<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Thien Thanh Tea</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>
<body>
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
      <a href="<?php echo get_option("siteurl"); ?>" class="navbar-brand"><img src="<?php bloginfo('template_directory');?>/frontend_src/public/img/ico_logo.png" alt=""></a>
      <div class="navbar-search js-navbar-search">
        <button class="btn btn-search navbar-search-btn js-btn-seach"></button>
        <form class="form-search js-form-search">
          <input class="form-input form-input-md search-box" type="text" placeholder="Search">
        </form>
      </div>
    </div>
  </nav>
</header>
add plugin && refactor js && setup up header and footer php