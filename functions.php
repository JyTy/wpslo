<?php
// CSS in JS
function pvz_theme_styles() {
    wp_enqueue_style( 'googlefont_css', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Lora:400,400italic,700,700italic&subset=latin,latin-ext' );
    wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'pvz_theme_styles' );

function pvz_theme_js() {
    wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'sticky_js', get_template_directory_uri() . '/js/jquery.sticky-kit.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/min/script-min.js', array('jquery', 'bootstrap_js', 'sticky_js'), '', true );      
}
add_action( 'wp_enqueue_scripts', 'pvz_theme_js' );

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

// Add nav support
add_theme_support( 'menus' );

function register_wpslo_menus() {
    register_nav_menus(
        array(
            'main-menu'     => __( 'Glavni Menu' )
        )
    );
}
add_action( 'init', 'register_wpslo_menus' );



// get Excerpt from given content
function get_excerpt($content, $chars){
    $excerpt = $content;
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $chars);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    return $excerpt;
}

// Dump array
function pr($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}