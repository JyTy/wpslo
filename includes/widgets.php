<?php
// define Widgets areas
function wpslo_create_widget( $name, $id, $description ) {

    register_sidebar(array(
        'name' => __( $name ),   
        'id' => $id, 
        'description' => __( $description ),
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="module-heading">',
        'after_title' => '</h2>'
    ));

}

wpslo_create_widget( 'Page Sidebar', 'page', 'Splošni sidebar' );

// Text widget with a CTA button