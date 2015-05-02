<?php 
/* 
  Template Name: Seznam pluginov
*/
get_header();
?>

<div class="container" role="main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="page-header">   
            <h1><?php the_title(); ?></h1>
        </div>

        <?php the_content();?>

    <?php endwhile; else: ?>
        <div class="page-header">   
            <h1>Oh no!</h1>
        </div>
        <p>We could not find this page!!!</p>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-2 col-md-push-10">
            <?php get_sidebar('plugins'); ?>
        </div>
        <div class="col-md-10 col-md-pull-2">
            <!-- List plugins -->
            <?php
                // Get all non-empty taxonomies
                $args = array(
                    'type'                     => 'wplugins',
                    'taxonomy'                 => 'wplugcat',
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hide_empty'               => 1
                ); 
                $taxonomies = get_categories($args);

                foreach ($taxonomies as $taxonomy) {
                    // Print taxonomy name and desc
            ?>
                    <div id="<?=$taxonomy->slug?>">
                        <h2><?=$taxonomy->name?></h2>
                        <?=$taxonomy->description?>
            <?php
                        // Get the plugins
                        $args = array(
                            'post_type' => 'wplugins',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxonomy->taxonomy,
                                    'field'    => 'slug',
                                    'terms'    => $taxonomy->slug
                                ),
                            ),
                            'orderby' => 'title',
                            'order'   => 'ASC'
                        );
                        $query = new WP_Query( $args );
            ?>
                        <div class="plugin-list">
                            <div class="row">
                                <!-- the loop -->
                                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                    <a href="<?php the_field('url') ?>" target="_blank" class="plugin">
                                        <div class="plugin-wrap">
                                            <div class="content-wrap">
                                                <div class="title">
                                                    <?php the_title(); ?>
                                                    <?php if( get_field('feat') ) { ?>
                                                        <div class="feat">Priporočamo</div>
                                                    <?php } ?>
                                                </div>
                                                <div class="desc">
                                                    <?php the_field('opis') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endwhile; ?>
                                <!-- end of the loop -->
                            </div>
                        </div>
                    </div>
            <?php
                } // End foreach
            ?>
        </div>
    </div> <!-- END row -->
</div> <!-- END container -->

<?php get_footer(); ?>