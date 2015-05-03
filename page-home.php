<?php
/* 
  Template Name: Homepage
*/
get_header(); ?>

<div class="container homepage" role="main">
    <div class="row">
        <div class="col-md-9">
            <div class="jumbotron">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php
                        // GET META
                        $pluginsTitle = get_post_meta( get_the_ID(), 'plugins-title', true );
                        $pluginsText = get_post_meta( get_the_ID(), 'plugins-text', true );
                    ?>

                    <div class="page-header">   
                        <h1><?php the_title(); ?></h1>

                        <p><?php the_content();?></p>
                    </div>

                <?php endwhile; endif; ?>
            </div>
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
                <div class="grp-desc">
                    <h2><?=$pluginsTitle?></h2>
                    <p><?=$pluginsText?></p>
                </div>
                <div class="plugin-list">
                    <div class="row">
                        <!-- the loop -->
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <?php $term = get_field('plugintax'); ?>
                            <a href="<?php the_field('url') ?>" target="_blank" class="plugin">
                                <div class="plugin-wrap">
                                    <div class="content-wrap">
                                        <div class="title">
                                            <?php the_title(); ?>
                                            <?php if( get_field('feat') ) { ?>
                                                <div class="feat"><?php echo $term->name; ?></div>
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
        <div class="col-md-3">
            <?php get_sidebar('page'); ?>
        </div>
    </div>
</div> <!-- END container -->

<?php get_footer(); ?>