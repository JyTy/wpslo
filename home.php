<?php get_header(); ?>

<div class="container" role="main">
    <div class="row">
        <div class="col-md-9">
             <?php
                // Get featured plugins
                $args = array(
                    'post_type' => 'wplugins',
                    'posts_per_page' => -1,
                    'meta_query'    => array(
                        'relation'      => 'AND',
                        array(
                            'key'       => 'feat',
                            'value'     => TRUE,
                            'compare'   => '=='
                        )
                    )
                );
                $query = new WP_Query( $args );
            ?>
                <!-- the loop -->
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="title"><?php the_title(); ?></div>
                <?php endwhile; ?>
                <!-- end of the loop -->
        </div>
    </div>
</div> <!-- END container -->

<?php get_footer(); ?>