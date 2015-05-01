<?php 
/* 
  Template Name: Seznam pluginov
*/
get_header();
?>

<div class="container" role="main">
    <div class="row">
        <div class="col-md-9">
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
        </div>
    </div>
</div> <!-- END container -->

<?php get_footer(); ?>