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
class wpslo_cta_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'wpslo_cta_widget', 

            // Widget name will appear in UI
            __('Text z CTA gumbom', 'wpslo_cta_widget_domain'), 

            // Widget description
            array( 'description' => __( 'Tekstovni banner z CTA gumbom in linkom', 'wpslo_cta_widget_domain' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            // echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output
        echo '
                <h3>'.$instance['title'].'</h3>
                <p>'.$instance['text'].'</p>
                <a href="'.$instance['link'].'" class="btn btn-default">
                    '.$instance['cta'].'
                </a>
            ';
        echo $args['after_widget'];
    }
            
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'New title', 'wpslo_cta_widget_domain' );
        }
        if ( isset( $instance[ 'cta' ] ) ) {
            $cta = $instance[ 'cta' ];
        } else {
            $cta = "CTA";
        }
        if ( isset( $instance[ 'link' ] ) ) {
            $link = $instance[ 'link' ];
        } else {
            $link = "#";
        }
        if ( isset( $instance[ 'text' ] ) ) {
            $text = $instance[ 'text' ];
        } else {
            $text = "Tekstovni nagovor";
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'cta' ); ?>"><?php _e( 'CTA:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'cta' ); ?>" name="<?php echo $this->get_field_name( 'cta' ); ?>" type="text" value="<?php echo esc_attr( $cta ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Povezava:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Textarea:', 'wp_widget_plugin'); ?></label>
            <textarea id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" class="widefat"><?php echo $text; ?></textarea>
        </p>
        <?php 
        }
            
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
        $instance['cta'] = ( ! empty( $new_instance['cta'] ) ) ? strip_tags( $new_instance['cta'] ) : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
        return $instance;
    }
} // Class wpslo_cta_widget ends here

// Widget for displaying latest added plugins
class wpslo_latest_plg_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'wpslo_latest_plg_widget', 

            // Widget name will appear in UI
            __('Zadnji Plugini', 'wpslo_latest_plg_widget_domain'), 

            // Widget description
            array( 'description' => __( 'Seznam zadnjih dodanih pluginov', 'wpslo_latest_plg_widget_domain' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )

        // This is where you run the code and display the output
        // Get featured plugins
        $qargs = array(
            'post_type' => 'wplugins',
            'posts_per_page' => $instance['number'],
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $query = new WP_Query( $qargs );

        echo '
                <h3>'.$instance['title'].'</h3>
                <ul class="latest-plugins">
            ';

        while ( $query->have_posts() ) : $query->the_post(); ?>
            <?php $term = get_field('plugintax'); ?>
            <li>
                <a href="<?php the_field('url') ?>" target="_blank">
                    <div class="title">
                        <?php the_title(); ?>
                    </div>
                    <div class="cat">
                        <?php echo $term->name; ?>
                    </div>
                </a>
            </li>
        <?php endwhile;
        wp_reset_postdata();

        echo $args['after_widget'];
    }
            
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'New title', 'wpslo_latest_plg_widget_domain' );
        }
        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        } else {
            $number = "5";
        }
        
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Št. pluginov:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <?php 
        }
            
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        return $instance;
    }
} // Class wpslo_latest_plg_widget ends here

// Register and load the widget
function wpslo_load_widget() {
    register_widget( 'wpslo_cta_widget' );
    register_widget( 'wpslo_latest_plg_widget' );
}
add_action( 'widgets_init', 'wpslo_load_widget' );