<?php

function load_stylesheets() {
  wp_register_style('styles', get_template_directory_uri() . '/frontend_src/public/css/main.css', array(), 1, 'all');
  wp_enqueue_style('styles');
}

add_image_size('menu_dropdown_image', 100, 100, true);
add_action('wp_enqueue_scripts', 'load_stylesheets');

function addjs() {
  wp_register_script('javascript', get_template_directory_uri() . '/frontend_src/public/js/main.js', array(), 1, 1, 1);
  wp_enqueue_script('javascript');
}

add_action('wp_enqueue_scripts', 'addjs');

add_theme_support('menus');

register_nav_menus(
  array(
    'top-menu' => __('Top menu', 'theme'),
  )
);

class Dropdown_List_Walker extends Walker_Nav_Menu {
  public function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }

  public function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }
}