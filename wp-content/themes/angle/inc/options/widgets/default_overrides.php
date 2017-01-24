<?php
/**
 * Default Widget Overrides
 *
 * @package Angle
 * @subpackage Frontend
 * @since 1.3
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */

/* ------------------- OVERRIDE DEFAULT RECENT POSTS WIDGET ------------------*/


Class Custom_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

    function widget($args, $instance) {

        extract( $args );

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'angle-td') : $instance['title'], $instance, $this->id_base);

        if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 10;

        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if( $r->have_posts() ) {
            echo $before_widget;
            if( $title ) {
                echo $before_title . $title . $after_title;
            }
            ?>
            <ul>
                <?php while( $r->have_posts() ) : $r->the_post(); ?>
                <?php
                    if( 'link' == get_post_format() ) {
                        $post_link = oxy_get_external_link();
                    }
                    else {
                        $post_link = get_permalink();
                    }
                ?>
                <li>
                    <div class="post-icon">
                        <?php oxy_post_icon( get_the_ID() ); ?>
                    </div>
                    <a href="<?php echo $post_link; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    <small>
                        <?php if($show_date) the_time( 'd F Y'); ?>
                    </small>
                </li>
                <?php endwhile; ?>
            </ul>

            <?php
            echo $after_widget;
            wp_reset_postdata();
        }
    }
}

class Custom_Archives_Widget extends WP_Widget_Archives{

    function widget($args, $instance) {

        extract( $args );
        $c = ! empty( $instance['count'] ) ? '1' : '0';
        $d = ! empty( $instance['dropdown'] ) ? '1' : '0';
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Archives', 'angle-td') : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;

        if( $d ) {
?>
        <select name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> <option value=""><?php echo esc_attr(__('Select Month', 'angle-td')); ?></option> <?php wp_get_archives(apply_filters('widget_archives_dropdown_args', array('type' => 'monthly', 'format' => 'option', 'show_post_count' => $c))); ?> </select>
<?php
        } else {
?>
        <ul>
        <?php wp_get_archives(apply_filters('widget_archives_args', array('type' => 'monthly', 'show_post_count' => $c , 'before'=> '' , 'after' => ''))); ?>
        </ul>
<?php
        }

        echo $after_widget;
    }
}

function oxy_widgets_init() {
    global $oxy_theme;
    global $oxy_theme_options;

    $upper_footer_columns = $oxy_theme_options['upper_footer_columns'];

    if( $upper_footer_columns == 1 ) {
        $oxy_theme->register_sidebar( 'Upper Footer middle', 'Middle upper-footer section', '', 'upper-footer-middle');
    }
    else if( $upper_footer_columns == 2 ) {
        $oxy_theme->register_sidebar( 'Upper Footer left', 'Left upper-footer section', '', 'upper-footer-left');
        $oxy_theme->register_sidebar( 'Upper Footer right', 'Right upper-footer section', '', 'upper-footer-right');
    }
    else if( $upper_footer_columns == 3 ) {
        $oxy_theme->register_sidebar( 'Upper Footer left', 'Left upper-footer section', '', 'upper-footer-left');
        $oxy_theme->register_sidebar( 'Upper Footer middle', 'Middle upper-footer section', '', 'upper-footer-middle');
        $oxy_theme->register_sidebar( 'Upper Footer right', 'Right upper-footer section', '', 'upper-footer-right');
    }
    else if( $upper_footer_columns == 4 ) {
        $oxy_theme->register_sidebar( 'Upper Footer left', 'Left upper-footer section', '', 'upper-footer-left');
        $oxy_theme->register_sidebar( 'Upper Footer middle left', 'Middle-left upper-footer section', '', 'upper-footer-middle-left');
        $oxy_theme->register_sidebar( 'Upper Footer middle right', 'Middle-right upper-footer section', '', 'upper-footer-middle-right');
        $oxy_theme->register_sidebar( 'Upper Footer right', 'Right upper-footer section', '', 'upper-footer-right');
    }

    $footer_columns = $oxy_theme_options['footer_columns'];

    if( $footer_columns == 1 ) {
        $oxy_theme->register_sidebar( 'Footer middle', 'Middle footer section', '', 'footer-middle');
    }
    else if( $footer_columns == 2 ) {
        $oxy_theme->register_sidebar( 'Footer left', 'Left footer section', '', 'footer-left');
        $oxy_theme->register_sidebar( 'Footer right', 'Right footer section', '', 'footer-right');
    }
    else if( $footer_columns == 3 ) {
        $oxy_theme->register_sidebar( 'Footer left', 'Left footer section', '', 'footer-left');
        $oxy_theme->register_sidebar( 'Footer middle', 'Middle footer section', '', 'footer-middle');
        $oxy_theme->register_sidebar( 'Footer right', 'Right footer section', '', 'footer-right');
    }
    else if( $footer_columns == 4 ) {
        $oxy_theme->register_sidebar( 'Footer left', 'Left footer section', '', 'footer-left');
        $oxy_theme->register_sidebar( 'Footer middle left', 'Middle-left footer section', '', 'footer-middle-left');
        $oxy_theme->register_sidebar( 'Footer middle right', 'Middle-right footer section', '', 'footer-middle-right');
        $oxy_theme->register_sidebar( 'Footer right', 'Right footer section', '', 'footer-right');
    }

    if (oxy_is_woocommerce_active()) {
        // register Product page widget for banners
        $oxy_theme->register_sidebar('Shop Widget', 'Widget used in the Shop', '', 'shop-widget');
    }

    // register header area widgets
    $oxy_theme->register_sidebar( 'Sidebar', 'Standard site sidebar', '', 'sidebar' );
    $oxy_theme->register_sidebar( 'Menu Bar', 'Widget to the left of menu', '', 'menu-bar');

    $oxy_theme->register_sidebar( 'Top bar left', 'Above Navigation section to the left', 'text-left small-screen-center', 'above-nav-left');
    $oxy_theme->register_sidebar( 'Top bar right', 'Above Navigation section to the right', 'text-right small-screen-center', 'above-nav-right');

    // replace default widgets
    unregister_widget('WP_Widget_Recent_Posts');
    register_widget('Custom_Recent_Posts_Widget');
    unregister_widget('WP_Widget_Archives');
    register_widget('Custom_Archives_Widget');
}
add_action( 'widgets_init', 'oxy_widgets_init' );
