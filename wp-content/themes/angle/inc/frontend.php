<?php
/**
 * This is where all the themes frontend actions at
 *
 * @package Angle
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */

/******************************
 *
 * THEME SETUP
 *
 *****************************/

function oxy_create_image_sizes() {
    if( function_exists( 'add_image_size' ) ) {
        add_image_size( 'square-image', 600, 600, true );
        add_image_size( 'hex-image', 600, 518, true );
        add_image_size( 'rect-image', 600, 450, true );

        add_image_size( 'square-image-small', 300, 300, true );
        add_image_size( 'hex-image-small', 300, 259, true );
        add_image_size( 'rect-image-small', 300, 225, true );

        add_image_size( 'portfolio-thumb', oxy_get_option('portfolio_item_width'), oxy_get_option('portfolio_item_height'), oxy_get_option('portfolio_item_crop') === 'on' );
    }
}
add_action( 'init', 'oxy_create_image_sizes');

function oxy_detect_user_agent() {
    global $oxy_is_iphone, $oxy_is_ipad, $oxy_is_android;
    $oxy_is_iphone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $oxy_is_ipad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $oxy_is_android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
}

add_action( 'init', 'oxy_detect_user_agent');

function oxy_display_image_sizes( $sizes ) {
    $sizes['square-image'] = __('Square Image', 'angle-admin-td');
    $sizes['hex-image']    = __('Hexagon Image', 'angle-admin-td');
    $sizes['rect-image']   = __('Rectangle Image', 'angle-admin-td');

    $sizes['square-image-small'] = __('Square Small Image', 'angle-admin-td');
    $sizes['hex-image-small']    = __('Hexagon Small Image', 'angle-admin-td');
    $sizes['rect-image-small']   = __('Rectangle Small Image', 'angle-admin-td');
    return $sizes;
}
// hook for displaying the size in the media screen
add_filter( 'image_size_names_choose', 'oxy_display_image_sizes');


/******************************
 *
 * HEAD
 *
 *****************************/

/**
 * Apple device icons
 *
 * @return echos html for apple icons
 **/
function oxy_add_apple_icons( $option_name, $sizes = '' ) {
    $icon = oxy_get_option( $option_name );
    if( false !== $icon ) {
        $rel = oxy_get_option( $option_name . '_pre', 'apple-touch-icon' );
        echo '<link rel="' . $rel . '" href="' . $icon . '" ' . $sizes  . ' />';
    }
}

/******************************
 *
 * HEADER
 *
 *****************************/

function oxy_create_logo() {
    if( function_exists( 'icl_get_home_url' ) ) {
        $home_link = icl_get_home_url();
    }
    else {
        $home_link = home_url();
    }

    $output = '<a href="' . $home_link . '" class="navbar-brand">';

    $url = oxy_get_option( 'logo_image' );
    if( '' !== $url ) {
        $output .= '<img src="';
        $output .= $url;
        $output .= '" alt="' . get_bloginfo('name');
        $output .= '"/>';
    }
    $output .= oxy_get_option( 'logo_text' );
    $output.= '</a>';

    echo $output;
}

function oxy_is_version( $version ) {
    global $wp_version;
    return version_compare( $wp_version, $version, '>=' );
}

// Register main menu
register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'angle-admin-td' ),
    'account' => __( 'Account Navigation', 'angle-admin-td' ),
));

/**
 * Gets a theme option
 *
 * @return theme option value or false if not set
 * @since 1.0
 **/
function oxy_get_option( $name ) {
    global $oxy_theme_options;
    if( isset( $oxy_theme_options[$name] ) ) {
        return $oxy_theme_options[$name];
    }
    else {
        return false;
    }
}


/**
 * Loads theme scripts
 *
 * @return void
 *
 **/
function oxy_load_scripts() {
    global $oxy_theme_options;

    $assets_file_name = 'theme';
    $minified_assets = oxy_get_option('minified_assets');
    if ($minified_assets === 'on' || $minified_assets === false) {
        $assets_file_name = $assets_file_name . '.min';
    }
    // load js
    wp_enqueue_script( THEME_SHORT.'-theme', OXY_THEME_URI . 'assets/js/' . $assets_file_name . '.js', array( 'jquery', 'wp-mediaelement' ), '1.0', true );

    global $wp_customize;
    $site_loader = isset($wp_customize) ? 'off' : oxy_get_option('site_loader');

    wp_localize_script( THEME_SHORT.'-theme', 'scriptData', array(
        'navbarHeight'          => oxy_get_option('navbar_height'),
        'navbarScrolled'        => oxy_get_option('navbar_scrolled'),
        'navbarScrolledPoint'   => oxy_get_option('navbar_scrolled_point'),
        'scrollFinishedMessage' => __('No more items to load.', 'angle-td'),
        'scrollTextMessage'     => __('Loading the next set of posts...', 'angle-td'),
        'siteLoader'             => $site_loader,
        'hoverMenu'              => array(
            'hoverActive'    => $oxy_theme_options['hover_menu'] === 'on',
            'hoverDelay'     => $oxy_theme_options['hover_menu_delay'],
            'hoverFadeDelay' => $oxy_theme_options['hover_menu_fade_delay'],
        )
    ));

    // load theme style
    wp_enqueue_style( THEME_SHORT.'-bootstrap', OXY_THEME_URI . 'assets/css/bootstrap.min.css', array(), false, 'all' );
    wp_enqueue_style( THEME_SHORT.'-theme', OXY_THEME_URI . 'assets/css/' . $assets_file_name . '.css', array( THEME_SHORT.'-bootstrap', 'wp-mediaelement' ), false, 'all' );

    if( oxy_get_option( 'swatch_css_save' ) === 'file' ) {
        $upload_dir = wp_upload_dir();
        $swatch_files = get_option( THEME_SHORT . '-swatch-files', array() );
        foreach ( $swatch_files as $id => $filename ) {
            wp_enqueue_style( THEME_SHORT.'-swatch-'.$id , $upload_dir['baseurl'] . '/' . $filename, array( THEME_SHORT . '-theme' ), false, 'all' );
        }
    }

    if ( wp_style_is( 'js_composer_front', 'registered' ) ) {
        wp_deregister_style( 'js_composer_front');
    }

}
add_action( 'wp_enqueue_scripts', 'oxy_load_scripts' );

/*************** COMMENTS ***************************/

/** COMMENTS WALKER */
class OxyCommentWalker extends Walker_Comment {

    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );


    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        if ( !$element )
           return;

        $id_field = $this->db_fields['id'];
        $id = $element->$id_field;
        // we add li tags only in 0 depth comments
        if($depth==0){?>
            <li class="media media-comment"><?php
        }
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

        // If we're at the max depth, and the current element still has children, loop over those and display them at this level
        // This is to prevent them being orphaned to the end of the list.
        if ( $max_depth <= $depth + 1 && isset( $children_elements[$id]) ) {
            foreach ( $children_elements[ $id ] as $child )
                $this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );

            unset( $children_elements[ $id ] );
        }
        // we add li tags only in 0 depth comments
        if($depth==0){?>
            </li><?php
        }

    }

    /** CONSTRUCTOR
     * You'll have to use this if you plan to get to the top of the comments list, as
     * start_lvl() only goes as high as 1 deep nested comments */
    function __construct() { ?>



    <?php }

    /** START_LVL
     * Starts the list before the CHILD elements are added. Unlike most of the walkers,
     * the start_lvl function means the start of a nested comment. It applies to the first
     * new level under the comments that are not replies. Also, it appear that, by default,
     * WordPress just echos the walk instead of passing it to &$output properly. Go figure.  */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

                <!--<ul class="children">-->
    <?php }

    /** END_LVL
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

        <!--</ul>--><!-- /.children -->

    <?php }

    /** START_EL */
    function start_el( &$output, $comment, $depth=0, $args=array(), $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;
        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
        <?php
        switch ( $comment->comment_type ) :
             case 'pingback':
             case 'trackback':
             // Display trackbacks differently than normal comments.
        ?>
        <div>
            <p><?php _e( 'Pingback:', 'angle-td' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'angle-td' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
            break;
            default:
            // Proceed with normal comments.
            global $post;
            if($depth != 0){?>
                <div <?php comment_class( 'media media-comment' ); ?> ><?php
            }
        ?>
                    <div class="box-round box-mini pull-left">
                        <div class="box-dummy"></div>
                        <?php echo get_avatar( $comment, 48 ); ?>
                    </div>
                    <div class="media-body">
                        <div class="media-inner">
                            <div <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
                                <h5 class="media-heading clearfix">
                                    <?php comment_author_link(); ?>
                                    -
                                    <?php comment_date(); ?>
                                    <span class="comment-reply pull-right">
                                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'reply', 'angle-td' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                                    </span>
                                </h5>
                                <?php comment_text(); ?>
                            </div>
                        </div>

    <?php endswitch; ?>

    <?php }

    function end_el(&$output, $comment, $depth = 0, $args = array() ) {
        switch ( $comment->comment_type ) :
            case 'pingback':
            case 'trackback':
             // Display trackbacks differently than normal comments.
        ?>
        </div>
        <?php
            break;
            default:
        ?>
                </div><!-- /media body -->
        <?php if($depth != 0){?>
            </div><?php
        }
        endswitch;
    }

    /** DESTRUCTOR
     * I just using this since we needed to use the constructor to reach the top
     * of the comments list, just seems to balance out :) */
    function __destruct() { ?>

    <!-- /#comment-list -->

    <?php }
}


/**
 * Customize comments form
 *
 *@return void
 *@since 1.0
 **/
function oxy_comment_form( $args = array(), $post_id = null ) {
    global $user_identity, $id;

    if ( null === $post_id )
        $post_id = $id;
    else
        $id = $post_id;

    $commenter = wp_get_current_commenter();

    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array(
        'author' => '<div class="form-group form-icon-group"><input id="author" name="author" placeholder="' . __('YOUR NAME *', 'angle-td') . '" type="text" class="input-block-level form-control" value="' . esc_attr( $commenter['comment_author'] ) .  '"/><i class="fa fa-user"></i></div>',
        'email'  => '<div class="form-group form-icon-group"><input id="email" name="email" placeholder="' . __('YOUR EMAIL *', 'angle-td') . '" type="text" class="input-block-level form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /><i class="fa fa-envelope"></i></div>',
        'url'    => '',
    );

    $required_text = sprintf( ' ' . __('Required fields are marked %s', 'angle-td'), '<span class="required"><a>*</a></span>' );
    $defaults = array(
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'        => '<div class="form-group form-icon-group"><textarea id="comment" name="comment" placeholder="' . __('YOUR MESSAGE', 'angle-td') . '" class="input-block-level form-control" rows="3"></textarea><i class="fa fa-pencil"></i></div>',
        'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'angle-td' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'angle-td' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'comment_notes_before' => '',
        'comment_notes_after'  => '',

        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'title_reply'          => __( 'Join the conversation', 'angle-td' ),
        'title_reply_to'       => __( 'Leave a Reply', 'angle-td' ),
        'cancel_reply_link'    => __( 'Cancel reply', 'angle-td' ),
        'label_submit'         => __( 'Add comment', 'angle-td' ),
    );

    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

    ?>
        <?php if ( comments_open() ) : ?>
            <?php do_action( 'comment_form_before' ); ?>
            <div class="comments-form post-showinfo"  id="respond">
                <div class="comments-head small-screen-center">
                    <h3 id="reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small id="cancel-comment-reply"><?php cancel_comment_reply_link('Cancel') ?></small></h3>
                    <div class="post-icon flat-hex">
                        <div class="hex hex-big">
                            <i class="fa fa-comment"></i>
                        </div>
                    </div>
                </div>
                <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
                    <?php echo $args['must_log_in']; ?>
                    <?php do_action( 'comment_form_must_log_in_after' ); ?>
                <?php else : ?>
                    <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comments-body">
                        <fieldset>
                        <?php do_action( 'comment_form_top' ); ?>
                        <?php if ( is_user_logged_in() ) : ?>
                            <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
                            <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
                        <?php else : ?>
                            <?php echo $args['comment_notes_before']; ?>
                            <?php
                            do_action( 'comment_form_before_fields' );
                            foreach( (array) $args['fields'] as $name => $field ) {
                                echo apply_filters( 'comment_form_field_'.$name, $field ) . "\n";
                            }
                            do_action( 'comment_form_after_fields' );
                            ?>
                        <?php endif; ?>
                        <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
                        <?php echo $args['comment_notes_after']; ?>
                        <div class="form-group small-screen-center">
                            <div class="controls small-screen-center">
                                <button name="submit" type="submit" class="btn btn-primary btn-icon btn-icon-right" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>">
                                    <?php echo esc_attr( $args['label_submit'] ); ?>
                                    <div class="hex-alt">
                                        <i class="fa fa-comment"></i>
                                    </div>
                                </button>
                                <?php comment_id_fields(); ?>
                            </div>
                        </div>


                        <?php do_action( 'comment_form', $post_id ); ?>
                        </fieldset>
                    </form>
                <?php endif; ?>

            </div><!-- #respond -->
            <?php do_action( 'comment_form_after' ); ?>
        <?php else : ?>
            <?php do_action( 'comment_form_comments_closed' ); ?>
        <?php endif; ?>
    <?php
}

/**
 * Enables threaded comments
 *
 *@return void
 *@since 1.0
 **/

function oxy_enable_threaded_comments(){
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
            wp_enqueue_script('comment-reply');
    }
}

add_action('get_header', 'oxy_enable_threaded_comments');


/**
 * Add theme support for automatic feed links. required by developer.
 *
 **/
add_theme_support( 'automatic-feed-links' );

/*
 * add theme support for post formats.
 **/
add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'link', 'audio', 'quote' ) );

// add support for featured images
add_theme_support( 'post-thumbnails' );
// add support for custom background
add_theme_support( 'custom-background' );
// add support for custom editor style
add_theme_support('editor_style');
add_editor_style('/inc/assets/stylesheets/custom-editor-style.css');

/*
 * Set theme content width. Required
 *
 **/
if ( ! isset( $content_width ) )  {
    $content_width = 1170;
}


/**
 * Adds rounded class to avatars
 *
 * @return modified css
 * @since 1.0
 **/
function oxy_change_avatar_css($class , $id , $size) {
    // if it's the admin bar , don't touch it.
    if( $size == 150 || $size == 48 || $size == 300 ) {
        // comment walker sends an object
        if( is_object( $id ) ) {
            $author_url = $id->user_id == 0 ? '#' : get_author_posts_url( $id->user_id );
        }
        else {
            $author_url = get_author_posts_url( $id );
        }
        // show avatar option
        if( oxy_get_option('site_avatars') == 'on'){
            $class = str_replace("class='avatar", "class='media-objects img-circle ", $class);
            return  '<a class="box-inner" href="' . $author_url . '">' . $class . '</a>';
        }
        //don't show anything
        return '';
    }
    return $class;

}
add_filter( 'get_avatar', 'oxy_change_avatar_css' ,10 , 5);


// override default tag cloud widget output
function oxy_custom_wp_tag_cloud_filter($content, $args) {
    $content = str_replace('<a' , '<li><a' , $content);
    $content = str_replace('</a>' , '</a></li>' , $content);
    return '<ul>'. $content . '</ul>';
}

add_filter('wp_tag_cloud','oxy_custom_wp_tag_cloud_filter', 10, 2);

/**
 * returns a section decoration
 *
 * @return section decoration SVG
 **/
function oxy_section_decoration( $position, $decoration ) {
    $output = '';
    if( !empty( $decoration ) && $decoration !== 'none' ) {
        $output .= '<div class="decor-' . $position . '">';
        ob_start();
        include( locate_template( 'assets/decorations/' . $position . '/' . $decoration . '.svg' ) );
        $output .= ob_get_contents();
        ob_end_clean();
        $output .= '</div>';
    }
    return $output;
}

/* function to return an icon depending the format of the post */

function oxy_post_icon( $post_id , $echo =true){
    $format = get_post_format( $post_id );
    switch ($format) {
        case 'image':
            $output = '<i class="fa fa-picture-o"></i>';
        break;
        case 'gallery':
            $output = '<i class="fa fa-camera"></i>';
        break;
        case 'link':
            $output = '<i class="fa fa-link"></i>';
        break;
        case 'quote':
            $output = '<i class="fa fa-quote-right"></i>';
        break;
        case 'audio':
            $output = '<i class="fa fa-headphones"></i>';
        break;
        case 'video':
            $output = '<i class="fa fa-play"></i>';
        break;
        default:
            $output = '<i class="fa fa-file-text"></i>';
        break;
    }
    if($echo)
        echo $output;
    else
        return $output;
}

// use option read more link
add_filter( 'the_content_more_link', 'oxy_filter_more_link', 10, 2 );

function oxy_filter_more_link( $more_link, $more_link_text ) {
    // remove #more
    $more_link = preg_replace( '|#more-[0-9]+|', '', $more_link );
    return str_replace( $more_link_text, oxy_get_option('blog_readmore'), $more_link );
}

function oxy_read_more_link( $echo = true){
    global $post;
    $output = "";
    if( isset( $post ) ) {
        $more_text = oxy_get_option('blog_readmore')? oxy_get_option('blog_readmore'): __('Read more','angle-td');
        $output .= '<a href="'. get_permalink().'" class="more-link">'.$more_text.'</a>';
    }

    if($echo == true){
        echo $output;
    }
    else{
        return $output;
    }
}

function oxy_get_content_shortcode( $post, $shortcode_name ) {
    $pattern = get_shortcode_regex();
    // look for an embeded shortcode in the post content
    if( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( $shortcode_name, $matches[2] ) ) {
        return $matches;
    }
}

function oxy_get_content_gallery( $post ) {
    $pattern = get_shortcode_regex();
    $gallery_ids = null;
    if( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'gallery', $matches[2] ) ) {
        // gallery shortcode is being used

        // do we have some attribues?
        if( array_key_exists( 3, $matches ) ) {
            if( array_key_exists( 0, $matches[3] ) ) {
                $gallery_attrs = shortcode_parse_atts( $matches[3][0] );
                if( array_key_exists( 'ids', $gallery_attrs) ) {
                    $gallery_ids = explode( ',', $gallery_attrs['ids'] );
                    return $gallery_ids;
                }
            }
        }
    }
}


/**
 * Gets the url that a slide should link to
 *
 * @return url link
 * @since 1.2
 **/
function oxy_get_slide_link( $post ) {
    $link_type = get_post_meta( $post->ID, THEME_SHORT . '_link_type', true );
    switch( $link_type ) {
        case 'page':
            $id = get_post_meta( $post->ID, THEME_SHORT . '_page_link', true );
            return esc_url(get_permalink( $id ));
        break;
        case 'post':
            $id = get_post_meta( $post->ID, THEME_SHORT . '_post_link', true );
            return esc_url(get_permalink( $id ));
        break;
        case 'category':
            $slug = get_post_meta( $post->ID, THEME_SHORT . '_category_link', true );
            $cat = get_category_by_slug( $slug );
            return esc_url(get_category_link( $cat->term_id ));
        break;
        case 'portfolio':
            $id = get_post_meta( $post->ID, THEME_SHORT . '_portfolio_link', true );
            return esc_url(get_permalink( $id ));
        break;
        case 'url':
            return esc_url(get_post_meta( $post->ID, THEME_SHORT . '_url_link', true ));
        break;
        case 'none':
            return null;
        break;
        case 'default':
        default:
            return esc_url(get_permalink( $post ));
        break;
    }
}



/*----------------- CREATES A FLEXSLIDER -----------------*/
function oxy_create_flexslider( $slug_or_ids, $options = array(), $echo = true ) {
    global $oxy_theme_options;
    global $post;
    $tmp_post = $post;
    extract( shortcode_atts( array(
        'animation'          => $oxy_theme_options['animation'],
        'direction'          => $oxy_theme_options['direction'],
        'speed'              => $oxy_theme_options['speed'],
        'duration'           => $oxy_theme_options['duration'],
        'directionnav'       => $oxy_theme_options['directionnav'],
        'directionnavtype'   => $oxy_theme_options['directionnavtype'],
        'controlsposition'   => $oxy_theme_options['controlsposition'],
        'itemwidth'          => '',
        'showcontrols'       => $oxy_theme_options['showcontrols'],
        'controlsalign'      => $oxy_theme_options['controlsalign'],
        'reverse'            => $oxy_theme_options['reverse'],
        'animationloop'      => $oxy_theme_options['animationloop'],
        'captions'           => $oxy_theme_options['captions'],
        'captions_vertical'  => $oxy_theme_options['captions_vertical'],
        'captions_horizontal'=> $oxy_theme_options['captions_horizontal'],
        'autostart'          => $oxy_theme_options['autostart'],
        'tooltip'            => $oxy_theme_options['tooltip'],
    ), $options ) );

    if( is_array( $slug_or_ids ) ){
        $slides = get_posts( array( 'post_type' => 'attachment', 'post__in' => $slug_or_ids, 'orderby' => 'post__in', 'posts_per_page' => -1 ) );
    }
    else {
        $slides = get_posts( array(
            'numberposts' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'oxy_slideshow_categories',
                    'field' => 'slug',
                    'terms' => $slug_or_ids
                )
            ),
            'post_type' => 'oxy_slideshow_image',
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ));
    }
    $flex_itemwidth = ( $itemwidth!=='' )?' data-flex-itemwidth='.$itemwidth.'px':'';
    $id = 'flexslider-' . rand(1,100);
    $output = '';
    $output .= '<div id="' . $id . '" class="flexslider feature-slider"'.$flex_itemwidth.' data-flex-animation="'.$animation.'" data-flex-controlsalign="'.$controlsalign.'" data-flex-controlsposition="'.$controlsposition.'" data-flex-directions="'.$directionnav.'" data-flex-directions-type="'.$directionnavtype.'" data-flex-speed="'.$speed.'" data-flex-controls="'.$showcontrols.'" data-flex-slideshow="' . $autostart . '" data-flex-duration="'.$duration.'" data-flex-captionvertical="'.$captions_vertical.'" data-flex-captionhorizontal="'.$captions_horizontal.'" data-flex-sliderdirection="'.$direction.'" data-flex-reverse="'.$reverse.'" data-flex-animationloop="'.$animationloop.'">';
    $output .= '<ul class="slides">';

    global $post;
    foreach( $slides as $post ) {
        setup_postdata( $post );
        $output .= '<li><figure>';
        $title = "";
        $content = "";
        if( $post->post_type == 'attachment' ) {
            $title = $post->post_title;
            $content = $post->post_excerpt;
            // Don't link anuwhere for now.
            $output .= '<img src="' . $post->guid . '"  alt="'. basename ( get_attached_file($post->ID) ).'"/>';
        }
        else {
            $title = get_the_title();
            $content = get_the_content();
            $link_type = get_post_meta($post->ID, THEME_SHORT. '_target', true  );
            $link = oxy_get_slide_link( $post );
            $magnific = $link_type == 'magnific' ? 'class="magnific"' : '';
            $link_type = empty($link_type) || $link_type == 'magnific' ? '' : ' target="' . $link_type . '"';

            if( null !== $link ) {

                $output .= '<a ' . $magnific . ' href="' . $link . '" ' .  $link_type . '>';
            }
            $tooltip_attrs = array();
            if( $tooltip == 'show'){
                $tooltip_attrs['data-original-title'] = get_the_title();
                $tooltip_attrs['data-toggle'] = 'tooltip';
            }
            $output .= get_the_post_thumbnail( $post->ID, 'full', $tooltip_attrs );
            if( null !== $link ) {
                $output .= '</a>';
            }
        }
        if( $captions == 'show') {
            if( !empty( $title ) || !empty( $content ) ) {
                $output .= '<figcaption>';
                if( !empty( $title ) ) {
                    $output .= '<h3>' . oxy_filter_title( $title ) . '</h3>';
                }
                if( !empty( $content ) ) {
                    $output .= '<p>'.$content.'</p>';
                }
                $output .= '</figcaption>';
            }
        }
        $output .= '</figure></li>';
    }
    $output .=  '</ul></div>';

    $post = $tmp_post;
    if( $post !== null ) {
        setup_postdata( $post );
    }
    if( $echo ) {
        echo $output;
    }
    else {
        return $output;
    }
}


/* --------------- add a wrapper for the embeded videos -------------*/

function oxy_add_video_embed_note( $html, $url, $attr ) {
    $parsed_url = parse_url( $url );
    if( strpos( $parsed_url['host'], 'youtube.com' ) !== false ||
        strpos( $parsed_url['host'], 'vimeo.com' ) !== false ||
        strpos( $parsed_url['host'], 'wordpress.tv' ) !== false ) {
        return '<div class="video-wrapper feature-video">'. $html .'</div>';
    }
    else {
        return $html;
    }
}
add_filter('embed_oembed_html', 'oxy_add_video_embed_note', 10, 3);


function oxy_create_hero_section( $image = null, $title = null ) {
    $image = $image === null ? get_header_image() : $image;
?>
<section class="section section-alt">
    <div class="row">
        <div class="super-hero-unit">
            <figure>
                <img alt="some image" src="<?php echo $image; ?>">
            </figure>
        </div>
    </div>
</section>
<?php
}

/* Function for replacing title contents including underscores with span tags*/
function oxy_filter_title( $title ) {
    $title = preg_replace("/_(.*)_\b/",'<span class="light">$1</span>' , $title);
    return $title;
}

/* function for limiting the excerpt */
function oxy_limit_excerpt($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if( count($words) > $word_limit ) {
        array_pop($words);
    }
    return implode(' ', $words).'...';
}

function oxy_remove_readmore_span($content) {
    global $post;
    if( isset( $post ) ) {
        $content = str_replace('<span id="more-' . $post->ID . '"></span><!--noteaser-->', '', $content);
        $content = str_replace('<span id="more-' . $post->ID . '"></span>', '', $content);
    }
    return $content;
}
add_filter('the_content', 'oxy_remove_readmore_span');


function oxy_fix_shortcodes($content) {
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'oxy_fix_shortcodes');


function change_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'change_excerpt_more');


// add custom active class in menu items
function custom_active_item_class($classes = array(), $menu_item = false){
    if(in_array('current-menu-item', $menu_item->classes)){
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'custom_active_item_class', 10, 2 );


// returns the hover color for each icon
function oxy_get_icon_color( $icon ) {
    $colour = '';
    switch( $icon ) {
        case 'adn':
            $colour = '#003871 ';
        break;
        case 'android':
            $colour = '#a4c639';
        break;
        case 'apple':
            $colour = '#333333';
        break;
        case 'bitbucket':
        case 'bitbucket-square':
            $colour = '#205081';
        break;
        case 'bitcoin':
        case 'btc':
            $colour = '#FF6600';
        break;
        case 'css3':
            $colour = '#404040';
        break;
        case 'dribbble':
            $colour = '#ea4c89';
        break;
        case 'dropbox':
            $colour = '#3d9ae8';
        break;
        case 'facebook':
        case 'facebook-square':
            $colour = '#3b5998';
        break;
        case 'flickr':
            $colour = '#0063dc';
        break;
        case 'foursquare':
            $colour = '#25a0ca';
        break;
        case 'github':
        case 'github-alt':
        case 'github-square':
            $colour = '#4183c4';
        break;
        case 'gittip':
            $colour = '#614C3E';
        break;
        case 'google-plus':
        case 'google-plus-square':
            $colour = '#E45135';
        break;
        case 'html5':
            $colour = '#ec6231';
        break;
        case 'instagram':
            $colour = '#634d40';
        break;
        case 'linkedin':
        case 'linkedin-square':
            $colour = '#5FB0D5';
        break;
        case 'linux':
            $colour = '#294170';
        break;
        case 'maxcdn':
            $colour = '#e47911';
        break;
        case 'pagelines':
            $colour = '#288EFE';
        break;
        case 'pinterest':
        case 'pinterest-square':
            $colour = '#910101';
        break;
        case 'renren':
            $colour = '#005eac';
        break;
        case 'skype':
            $colour = '#00aff0';
        break;
        case 'stack-exchange':
            $colour = '#3a6da6';
        break;
        case 'stack-overflow':
            $colour = '#ef8236';
        break;
        case 'trello':
            $colour = '#00c6d4';
        break;
        case 'tumblr':
        case 'tumblr-square':
            $colour = '#34526f';
        break;
        case 'twitter':
        case 'twitter-square':
            $colour = '#00acee';
        break;
        case 'vimeo-square':
            $colour = '#86c9ef';
        break;
        case 'vk':
            $colour = '#45668e';
        break;
        case 'weibo':
            $colour = '#e64141';
        break;
        case 'windows':
            $colour = '#00CCFF';
        break;
        case 'xing':
        case 'xing-square':
            $colour = '#126567';
        break;
        case 'youtube':
        case 'youtube-play':
        case 'youtube-square':
            $colour = '#c4302b';
        break;
    }

    return apply_filters( 'oxy_social_icon_colour', $colour, $icon );
}


// Renders the Top bar header section
function oxy_top_bar_nav(){ ?>
<div id="top-bar" class="<?php echo oxy_get_option('top_bar_swatch'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php dynamic_sidebar( 'above-nav-left' ); ?>
            </div>
            <div class="col-md-6">
                <?php dynamic_sidebar( 'above-nav-right' ); ?>
            </div>
        </div>
    </div>
</div>
<?php
}

/**
 * Overrides default site swatch for navbar
 *
 * @return void
 * @author
 **/
function oxy_navbar_page_overrides( $classes ) {
    global $post;

    $is_blog = oxy_query_is_blog();
    $page_for_posts = get_option('page_for_posts');
    if( is_page() || ($is_blog && !empty($page_for_posts))) {
        // if we are on the blog page make sure you use the blog page id for transparancy option
        $page_id = $is_blog ? get_option('page_for_posts') : $post->ID;

        $swatch = get_post_meta( $page_id, THEME_SHORT . '_site_top_swatch', true );

        if( !empty( $swatch ) ) {
            // remove site swatch
            for( $i = 0 ; $i < count( $classes ) ; $i++ ) {
                if( strpos( $classes[$i], 'swatch-' ) !== false ) {
                    unset( $classes[$i] );
                }
            }
            $classes[] = $swatch;
        }
    }
    return $classes;
}
add_filter( 'oxy_navbar_class', 'oxy_navbar_page_overrides', 10 , 1 );


function oxy_get_external_link(){
    global $post;
    $link_shortcode = oxy_get_content_shortcode( $post, 'link' );
    if( $link_shortcode !== null ) {
        if( isset( $link_shortcode[5] ) ) {
            $link_shortcode = $link_shortcode[5];
            if( isset( $link_shortcode[0] ) ) {
                return $link_shortcode[0] ;
            }
            else{
                return get_permalink();
            }
        }
    }
}

function oxy_create_nav_top_bar() {
?>
<div class="top-bar <?php oxy_top_bar_classes(); ?>">
    <div class="container">
        <div class="top top-left">
            <?php dynamic_sidebar( 'above-nav-left' ); ?>
        </div>
        <div class="top top-right">
            <?php dynamic_sidebar( 'above-nav-right' ); ?>
        </div>
    </div>
</div>
<?php
}

function oxy_top_bar_classes() {
    global $oxy_theme_options;
    $classes = array();

    // add swatch to top bar
    $classes[] = $oxy_theme_options['top_bar_swatch'];

    // add extra class if one of the top sidebars has a shopping cart
    $sidebar_widgets = wp_get_sidebars_widgets();
    $top_bar_widgets = array();
    if( isset($sidebar_widgets['above-nav-left']) && isset( $sidebar_widgets['above-nav-right'] ) ) {
        $top_bar_widgets = array_merge( $sidebar_widgets['above-nav-left'], $sidebar_widgets['above-nav-right'] );
    }
    foreach( $top_bar_widgets as $widget ) {
        if( strpos( $widget, 'woocommerce_widget_cart' ) !== false ) {
            $classes[] = 'has-shopping-cart';
        }
    }
    $classes = apply_filters( 'oxy_top_bar_class', $classes );
    echo implode( ' ', $classes );
}

function oxy_navbar_class() {
    global $oxy_theme_options;
    $classes = array();

    $classes[] = $oxy_theme_options['header_type'];

    // add header swatch class
    $classes[] = $oxy_theme_options['header_swatch'];

    $header_caps = $oxy_theme_options['header_capitalization'];
    switch( $header_caps ) {
        case 'on':
            $classes[] = 'text-caps';
        break;
        case 'off':
            $classes[] = 'text-lowercase';
        break;
        case 'lowercase':
            $classes[] = 'text-lower';
        break;
        case 'capitalize':
            $classes[] = 'text-capitalize';
        break;
    }


    $classes = apply_filters( 'oxy_navbar_class', $classes );
    echo implode( ' ', $classes );
}

//Renders the middle header part when we don't have a combo menu with 3 sections
function oxy_create_nav() {
    global $oxy_theme_options;
    global $post;

    $show_top_bar = true;
    $show_top_nav = true;
    $menu_swatch = $oxy_theme_options['header_swatch'];
    $is_blog = oxy_query_is_blog();
    $page_for_posts = get_option('page_for_posts');
    if( is_page() || ($is_blog && !empty($page_for_posts))) {
        // if we are on the blog page make sure you use the blog page id for transparancy option
        $page_id = $is_blog ? get_option('page_for_posts') : $post->ID;
        // are we showing the top bar?
        if( get_post_meta( $page_id, THEME_SHORT . '_site_top_bar', true ) === 'hide' ) {
            $show_top_bar = false;
        }
        // are we showing the top nav?
        if( get_post_meta( $page_id, THEME_SHORT . '_site_top_nav', true ) === 'hide' ) {
            $show_top_nav = false;
        }
        // does the page override the swatch?
        $menu_swatch_override = get_post_meta( $page_id, THEME_SHORT . '_site_top_swatch', true );
        if( !empty( $menu_swatch_override ) ) {
            $menu_swatch = $menu_swatch_override;
        }
    }

    // render the top bar
    if ( $show_top_bar ) {
        oxy_create_nav_top_bar();
    }

    if ( $show_top_nav ) {?>
        <header class="navbar navbar-static-top <?php oxy_navbar_class(); ?>" id="masthead" role="banner">
            <div class="container">
                <div class="navbar-header">

                    <button class="navbar-toggle collapsed" data-target=".main-navbar" data-toggle="collapse" data-original-title="" title="">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php oxy_create_logo(); ?>
                </div>
                <nav class="collapse navbar-collapse main-navbar" role="navigation">
                    <div class="menu-sidebar pull-right">
                        <?php dynamic_sidebar( 'menu-bar' ); ?>
                    </div>
                    <?php
                    if( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array(
                            'menu' => 'primary',
                            'theme_location' => 'primary',
                            'menu_class' => 'nav navbar-nav navbar-right',
                            'depth' => 4,
                            'walker' => new FrontendBootstrapMegaMenuWalker()
                        ));
                    }
                    ?>
                </nav>
            </div>
        </header><?php
    }
}

// SEARCH WIDGET OUTPUT OVERRIDE

/* -------------------- OVERRIDE DEFAULT SEARCH WIDGET OUTPUT ------------------*/
function oxy_custom_search_form( $form ) {
    $output = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '">';
    $output .= '<div class="input-group">';
    $output .= '<input type="text" value="' . get_search_query() . '" name="s" id="s" class="form-control" placeholder="' . __('Search', 'angle-td') . '"/>';
    $output .= '<span class="input-group-btn">';
    $output .= '<button class="btn" type="submit" id="searchsubmit" value="'. esc_attr__('Search') . '">';
    $output .= '<i class="fa fa-search"></i>';
    $output .= '</button></span>';
    $output .= '</div></form>';
    return $output;
}
add_filter( 'get_search_form', 'oxy_custom_search_form' );


// REMOVING DEFAULT CONTACT FORM 7 STYLES
add_action( 'wp_print_styles', 'oxy_remove_cf7_css', 100 );

function oxy_remove_cf7_css(){
    wp_deregister_style( 'contact-form-7' );
}

function oxy_portfolio_pagination( $pagination_type ) {
    global $wp_query;
    global $paged;
    $range = 2;
    switch( $pagination_type ) {
        case 'infinite': ?>
            <div class="infinite-scroll" style="visibility:hidden;">
                <a href="<?php echo get_pagenum_link($paged + 1) ?>">&rsaquo;</a>
            </div>
        <?php
        break;
        case 'simple':
        default:
            $showitems = ($range * 2) + 1;
            $paged = $wp_query->query_vars['paged'];

            // only show pages if we have more than 1
            if( !empty( $wp_query->max_num_pages ) ) : ?>
                <div class="text-center">
                    <ul class="post-navigation pagination">
                        <li class="<?php echo $paged > 1 ? '' : 'disabled' ?>">
                            <?php if( $paged > 1 ) : ?>
                                <a href="<?php echo get_pagenum_link( $paged - 1 ); ?>">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            <?php else : ?>
                                <a>
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            <?php endif; ?>
                        </li>

                        <?php for( $i = 1; $i <= $wp_query->max_num_pages; $i++ ) : ?>
                            <?php if( $paged == $i ) : ?>
                                <li class="active">
                                    <a class="current">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php else : ?>
                                <li>
                                    <a href="<?php echo get_pagenum_link( $i ); ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <li class="<?php echo $paged < $wp_query->max_num_pages ? '' : 'disabled' ?>">
                            <?php if( $paged < $wp_query->max_num_pages ) : ?>
                                <a href="<?php echo get_pagenum_link( $paged + 1 ); ?>">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            <?php else : ?>
                                <a>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            <?php endif;
        break;
    }
}

function oxy_pagination( $pages = '', $range = 2, $blog = true, $infinite = false, $echo = true ) {
    global $wp_query;
    global $paged;
    $output = '';
    if($infinite == false){
        // we don't use infinite pagination , show display the chosen pagination style
        switch( oxy_get_option( 'blog_pagination' ) ) {
            case 'next_prev':
                if( $wp_query->max_num_pages > 1 ) {
                    $output .= '<nav id="nav-below" class="post-navigation padded">';
                    $output .= '<ul class="pager">';
                    $output .= '<li class="previous">' . get_next_posts_link( __( ' <span class="hex-alt"><i class="fa fa-angle-left"></i></span>Previous', 'angle-td' ) ) . '</li>';
                    $output .= '<li class="next">' . get_previous_posts_link( __( 'Next<span class="hex-alt"><i class="fa fa-angle-right"></i></span>', 'angle-td' ) ) . '</li>';
                    $output .= '</ul>';
                    $output .= '</nav>';
                }
            break;
            case 'pages':
            default:
                $showitems = ($range * 2)+1;
                if(empty($paged)) {
                    $paged = 1;
                }

                if($pages == '') {
                    global $wp_query;
                    $pages = $wp_query->max_num_pages;
                    if(!$pages) {
                        $pages = 1;
                    }
                }

                $extraClass = "";
                if($blog == true){
                    // this class pushes the pagination 80px to the right in blog pages
                    $extraClass = "post-showinfo";
                }

                if(1 != $pages) {
                    $output.= '<div class="text-center '.$extraClass.'"><ul class="post-navigation pagination">';
                    $output.= ($paged > 1 )? "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>":"<li class='disabled'><a>&lsaquo;</a></li>";

                    for($i=1; $i <= $pages; $i++) {
                        if(1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                            $output.= ($paged == $i) ? '<li class="active"><span class="current">' . $i . '</span></li>' : '<li><a href="' . get_pagenum_link($i) . '" class="inactive">' . $i . '</a></li>';
                        }
                    }

                    $output.= ($paged < $pages)? "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>": "<li class='disabled'><a>&rsaquo;</a></li>";
                    $output.= "</ul></div>\n";
                }
            break;
        }
    }
    else{
        // lazy loading is on , hide pagination but preserve 'next' link
        $output .= '<div class="infinite-scroll" style="visibility:hidden;"><a href="'.get_pagenum_link($paged + 1).'">&rsaquo;</a></div>';
    }


    if($echo == true) {
        echo $output;
    }
    else {
        return $output;
    }
}

/**
 * Bootstrap the page links under a post
 *
 * @return void
 * @author
 **/
function oxy_wp_link_pages($args = '') {
    $defaults = array(
        'before' => '' ,
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'next_or_number' => 'number',
        'nextpagelink' => __('Next page', 'angle-td' ),
        'previouspagelink' => __('Previous page', 'angle-td' ),
        'pagelink' => '%',
        'echo' => 1
    );

    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more, $pagenow;

    $output = '';
    if ( $multipage ) {
        if ( 'number' == $next_or_number ) {
            $output .= $before . '<ul class="post-navigation pagination">';
            $laquo = $page == 1 ? 'class="disabled"' : '';
            $output .= '<li ' . $laquo .'>' . _wp_link_page($page -1) . '&laquo;</a></li>';
            for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
                $j = str_replace('%',$i,$pagelink);

                if ( ($i != $page) || ((!$more) && ($page==1)) ) {
                    $output .= '<li>';
                    $output .= _wp_link_page($i) ;
                }
                else{
                    $output .= '<li class="active">';
                    $output .= _wp_link_page($i) ;
                }
                $output .= $link_before . $j . $link_after ;
                $output .= '</a>';

                $output .= '</li>';
            }
            $raquo = $page == $numpages ? 'class="disabled"' : '';
            $output .= '<li ' . $raquo .'>' . _wp_link_page($page +1) . '&raquo;</a></li>';
            $output .= '</ul>' . $after;
        }
        else {
            if ( $more ) {
                $output .= $before . '<ul class="pager">';
                $i = $page - 1;
                if ( $i && $more ) {
                    $output .= '<li class="previous">' . _wp_link_page($i);
                    $output .= $link_before. $previouspagelink . $link_after . '</a></li>';
                }
                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
                    $output .= '<li class="next">' .  _wp_link_page($i);
                    $output .= $link_before. $nextpagelink . $link_after . '</a></li>';
                }
                $output .= '</ul>' . $after;
            }
        }
    }

    if ( $echo ) {
        echo $output;
    }

    return $output;
}

function oxy_post_thumbnail_name($post , $echo = false){
    $name = basename ( get_attached_file(  get_post_thumbnail_id($post->ID)) );
    if($echo == true){
        echo $name;
    }
    else{
        return $name;
    }
}

function oxy_remove_category_list_rel( $output ) {
    // make rel valid
    return str_replace( ' rel="category tag"', ' rel="tag"', $output );
}
add_filter( 'wp_list_categories', 'oxy_remove_category_list_rel' );
add_filter( 'the_category', 'oxy_remove_category_list_rel' );

function oxy_query_is_blog() {
    global $wp_query, $post;
    return ( ( ( $wp_query->is_archive) || ($wp_query->is_author) || ($wp_query->is_category) || ($wp_query->is_home) || ($wp_query->is_single) || ($wp_query->is_tag)) && ( $post->post_type === 'post' ) );
}

// remove site header on pages with the site header turned off
function oxy_filter_body_class( $classes ) {
    global $oxy_theme_options;
    global $post;

    if( $oxy_theme_options['layout_type'] == 'boxed') {
        $classes[] = 'layout-boxed';
    }
    $is_blog = oxy_query_is_blog();
    $page_for_posts = get_option('page_for_posts');
    if( is_page() || ($is_blog && !empty($page_for_posts))) {
        $page_id = $is_blog ? get_option('page_for_posts') : $post->ID;
        if( get_post_meta( $page_id, THEME_SHORT . '_site_top_nav', true ) === 'hide' ) {
            $classes[] = 'no-header';
        }
    }
    // add classes for mobile agents
    global $oxy_is_iphone, $oxy_is_android, $oxy_is_ipad;
    if($oxy_is_iphone){
        $classes[] = 'oxy-agent-iphone';
    }
    else if($oxy_is_ipad){
        $classes[] = 'oxy-agent-ipad';
    }
    else if($oxy_is_android){
        $classes[] = 'oxy-agent-android';
    }

    // current language code if wpml is installed
    if( function_exists( 'icl_get_home_url' ) ) {
        $classes[] = ICL_LANGUAGE_CODE;
    }

    // woocommerce cart popup option
    if( $oxy_theme_options['woo_cart_popup'] == 'show' ){
        $classes[] = 'woo-cart-popup';
    }

    // Add class when loader is on
    global $wp_customize;
    if (!isset($wp_customize) && $oxy_theme_options['site_loader'] === 'on') {
        $classes[] = 'pace-on';
        $classes[] = 'pace-' . $oxy_theme_options['site_loader_style'];
    }

    // in multisites signup page admin bar is not being displayed but the class
    // is still there messing things up. Remove it.
    if ( in_array( $GLOBALS['pagenow'], array( 'wp-signup.php' ) ) ) {
        $admin_class = array_search('admin-bar',$classes);
        if( $admin_class !== false ) {
            unset( $classes[$admin_class] );
        }
    }

    return $classes;
}
add_filter( 'body_class', 'oxy_filter_body_class');


function oxy_is_woocommerce_active() {
    // check if woo commerce is active
    if (class_exists('woocommerce')) {
        return true;
    }
    return false;
}

function oxy_woo_page_title( $echo = false ){
    if( is_search() ) {
        $page_title = sprintf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );
        if ( get_query_var( 'paged' ) ){
            $page_title .= sprintf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );
        }
    }
    elseif( is_tax() ) {
        $page_title = single_term_title( "", false );

    }
    else {
        $shop_page_id = woocommerce_get_page_id( 'shop' );
        $page_title   = get_the_title( $shop_page_id );
    }
    if($echo){
        echo $page_title;
    }
    else{
        return $page_title;
    }
}

add_filter('next_posts_link_attributes', 'next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'prev_posts_link_attributes');

function next_posts_link_attributes() {
    return 'class="btn btn-primary btn-icon btn-icon-left"';
}
function prev_posts_link_attributes() {
    return 'class="btn btn-primary btn-icon btn-icon-right"';
}

/**
 * Creates a shaped image for a post
 *
 * @return HTML for the image
 **/
function oxy_create_shaped_featured_image( $post, $shape, $shape_size, $shadow, $link = null, $figcaption = null, $small_image_version = null, $link_target = '_self' ) {

    $image_box = '';
    $shadow_class = $shadow ? ' flat-shadow' : '';

    if ( $shape == 'hex' ) {
        $image_box .= '<div class="box-wrap">';
    }
    $image_box .= '<div class="box-' . $shape . $shadow_class . ' box-' . $shape_size . '">';
    $image_box .= '<div class="box-dummy"></div>';

    $shape_image_size = $shape === 'round' ? 'square-image' : $shape . '-image';
    $extra_image_class = $shape === 'round' ? 'img-circle' : '';
    if($small_image_version == true){
        $shape_image_size = $shape_image_size . '-small';
    }

    $image_type = get_post_meta( $post->ID, THEME_SHORT. '_image_type', true );
    if( '' !== $image_type ) {
        $icon           = get_post_meta( $post->ID, THEME_SHORT. '_icon', true );
        $icon_animation = get_post_meta( $post->ID, THEME_SHORT. '_icon_animation', true );

        switch( $image_type ) {
            case 'image':
                $image_tag = get_the_post_thumbnail( $post->ID,  $shape_image_size, array( 'data-animation' => $icon_animation , 'class' => $extra_image_class ) );
            break;
            case 'both':
                $image_tag = get_the_post_thumbnail( $post->ID,  $shape_image_size, array( 'class' => $extra_image_class ) );
                $image_tag .= '<i class="fa fa-' . $icon . '" data-animation="' . $icon_animation . '"></i>';
            break;
            case 'icon':
                $image_tag = '<i class="fa fa-' . $icon . '" data-animation="' . $icon_animation . '"></i>';
            break;
        }
    }
    else {
        $image_tag = get_the_post_thumbnail( $post->ID,  $shape_image_size, array() );
    }

    $link_target = empty($link_target) ? '' : ' target="' . $link_target . '"';
    if( null !== $figcaption ){
        // staff figcaption
        $image_box .= '<figure class="box-inner">' . $image_tag . '<figcaption class="box-caption">'.$figcaption.'</figcaption></figure>';
    }
    else if( null === $link ) {
        $image_box .= '<div class="box-inner">' . $image_tag . '</div>';
    }
    else {
        $image_box .= '<a class="box-inner" href="' . $link . '"' . $link_target . '>' . $image_tag . '</a>';
    }

    $image_box .= '</div>';

    if ( $shape == 'hex' ) {
        $image_box .= '</div>';
    }

    return $image_box;
}

function oxy_get_portfolio_item_data( $item ) {
    // setup post data
    global $post;
    $post = $item;
    setup_postdata($post);
    global $more;    // Declare global $more (before the loop).
    $more = 0;
    $captions = array();

    // grab the featured image
    $full_image_id = get_post_thumbnail_id( $post->ID );
    $full_image_src = wp_get_attachment_image_src( $full_image_id, 'full' );

    // create info data structure
    $info = new stdClass();
    $info->text_captions = '';
    $info->title = get_the_title( $post->ID );
    if( false !== $full_image_src ) {
        $info->full_image_url = $full_image_src[0];
    }
    else {
        $info->full_image_url = '';
    }
    // set default popup link
    $info->popup_link = $info->full_image_url;
    $info->isGallery = false;
    // post format specific data
    $format = get_post_format( $post->ID );
    if( false === $format ) {
        $format = 'standard';
    }
    switch( $format ) {
        case 'standard':
            $info->icon = 'fa fa-search-plus';
            $info->popup_class = 'magnific';
        break;
        case 'image':
            $info->icon = 'fa fa-picture-o';
            $info->popup_class = 'magnific';
        break;
        case 'video':
            $info->icon = 'fa fa-play';
            $info->popup_class = 'magnific-vimeo';
            $video_shortcode = oxy_get_content_shortcode( $post, 'embed' );
            if( $video_shortcode !== null ) {
                if( isset( $video_shortcode[5] ) ) {
                    $video_shortcode = $video_shortcode[5];
                    if( isset( $video_shortcode[0] ) ) {
                        $info->popup_link = $video_shortcode[0];
                    }
                }
            }
        break;
        case 'audio':
            $info->icon = 'fa fa-play';
            $info->popup_class = 'magnific-audio';
            $audio_shortcode = oxy_get_content_shortcode( $post, 'audio' );
            if( $audio_shortcode !== null){
                $audio_src = null;
                if( array_key_exists( 3, $audio_shortcode ) ) {
                    if( array_key_exists( 0, $audio_shortcode[3] ) ) {
                        $audio_attrs = shortcode_parse_atts( $audio_shortcode[3][0] );
                        if( array_key_exists( 'src', $audio_attrs) ) {
                            $info->popup_link = $audio_attrs['src'];
                        }
                    }
                }
            }
        break;
        case 'gallery':
            $info->icon = 'fa fa-search-plus';
            $info->popup_class = 'magnific-gallery';
            $info->isGallery = true;
            $gallery_ids = oxy_get_content_gallery( $post );
            if( $gallery_ids !== null ) {
                if( count( $gallery_ids ) > 0 ) {
                    // ok lets create a gallery
                    $gallery_rel = 'rel="gallery' . $post->ID . '"';
                    $gallery_images = array();
                    foreach( $gallery_ids as $gallery_image_id ) {
                        $gallery_image = wp_get_attachment_image_src( $gallery_image_id, 'full');
                        $gallery_images[] = $gallery_image[0] ;

                        //gathering the image captions
                        $captions[] = oxy_get_image_caption($gallery_image_id);
                    }
                    $info->text_captions = empty($captions) ? '' : 'data-captions="' . esc_attr(implode( ',', $captions )) . '"';
                    $info->gallery_links = implode(",", $gallery_images);
                }
            }
        break;
    }

    $info->item_link = get_permalink( $post->ID );
    return $info;
}

function oxy_get_image_caption($post_id) {
    $thumbnail_image = get_posts(array('p' => $post_id, 'post_type' => 'attachment'));
    $magnific_popup_caption = $thumbnail_image[0]->post_excerpt;
    return $magnific_popup_caption;
}

/**
 * Outputs a page header
 *
 * @return void
 **/
function oxy_page_header( $id ) {
    $custom = get_post_custom( $id );
    if( isset( $custom[THEME_SHORT.'_show_header'] ) && $custom[THEME_SHORT.'_show_header'][0] == 'show' ) {
        echo oxy_shortcode_section( array(
            // header options
            'title'           => $custom[THEME_SHORT.'_title'][0],
            'subtitle'        => $custom[THEME_SHORT.'_subtitle'][0],
            'title_size'      => $custom[THEME_SHORT.'_title_size'][0],
            'title_weight'    => $custom[THEME_SHORT.'_title_weight'][0],
            'title_align'     => $custom[THEME_SHORT.'_title_align'][0],
            'title_underline' => $custom[THEME_SHORT.'_title_underline'][0],
            // section options
            'swatch'          => $custom[THEME_SHORT.'_header_swatch'][0],
            'height'          => $custom[THEME_SHORT.'_header_height'][0],
            // background options
            'background_image'               => $custom[THEME_SHORT.'_background_image'][0],
            'background_video'               => $custom[THEME_SHORT.'_background_video'][0],
            'background_position_vertical'   => isset( $custom[THEME_SHORT.'_background_position_vertical'][0] ) ? $custom[THEME_SHORT.'_background_position_vertical'][0] : '0',
            'overlay_colour'                 => $custom[THEME_SHORT.'_overlay_colour'][0],
            'overlay_opacity'                => $custom[THEME_SHORT.'_overlay_opacity'][0],
            'overlay_grid'                   => isset( $custom[THEME_SHORT.'_overlay_grid'][0] ) ? $custom[THEME_SHORT.'_overlay_grid'][0] : 'off',
            'background_image_size'          => $custom[THEME_SHORT.'_background_image_size'][0],
            'background_image_repeat'        => $custom[THEME_SHORT.'_background_image_repeat'][0],
            'background_image_attachment'    => $custom[THEME_SHORT.'_background_image_attachment'][0],
        ));
    }
}

/**
 * Outputs the blog header
 *
 * @return void
 **/
function oxy_blog_header( $title = null, $subtitle = null ) {
    global $oxy_theme_options;
    $title = $title === null ? $oxy_theme_options['title'] : $title;
    $subtitle = $subtitle === null ? $oxy_theme_options['subtitle'] : $subtitle;
    if( $oxy_theme_options['show_header'] === 'show' ) {
        echo oxy_shortcode_section( array(
            // header options
            'title'           => $title,
            'subtitle'        => $subtitle,
            'title_size'      => $oxy_theme_options['title_size'],
            'title_weight'    => $oxy_theme_options['title_weight'],
            'title_align'     => $oxy_theme_options['title_align'],
            'title_underline' => $oxy_theme_options['title_underline'],
            // section options
            'swatch'          => $oxy_theme_options['blog_header_swatch'],
            'height'          => $oxy_theme_options['height'],
            // background options
            'background_image'                => $oxy_theme_options['background_image'],
            'background_video'                => $oxy_theme_options['background_video'],
            'background_video_webm'           => $oxy_theme_options['background_video_webm'],
            'background_position_vertical'    => $oxy_theme_options['background_position_vertical'],
            'overlay_colour'                  => $oxy_theme_options['overlay_colour'],
            'overlay_opacity'                 => $oxy_theme_options['overlay_opacity'],
            'overlay_grid'                    => $oxy_theme_options['overlay_grid'],
            'background_image_size'           => $oxy_theme_options['background_image_size'],
            'background_image_repeat'         => $oxy_theme_options['background_image_repeat'],
            'background_image_attachment'     => $oxy_theme_options['background_image_attachment'],
        ));
    }
}

/**
 * Overrides default footer swatch for page
 *
 * @return new classes array
 **/
function oxy_footer_page_overrides( $classes ){
    global $post;

    $is_blog = oxy_query_is_blog();
    $page_for_posts = get_option('page_for_posts');
    if( is_page() || ($is_blog && !empty($page_for_posts))) {
        $page_id = $is_blog ? get_option('page_for_posts') : $post->ID;
        $swatch = get_post_meta( $page_id, THEME_SHORT . '_site_footer_swatch', true );
        if( $swatch !== '' ) {
            // remove site swatch
            for( $i = 0 ; $i < count( $classes ) ; $i++ ) {
                if( strpos( $classes[$i], 'swatch-' ) !== false ) {
                    unset( $classes[$i] );
                }
            }
            $classes[] = $swatch;
        }
    }
    return $classes;
}
add_filter( 'oxy_footer_section_class', 'oxy_footer_page_overrides' );

/**
 * Creates the classes for the footer section
 *
 * @return space separated list of footer classes
 **/
function oxy_footer_section_classes() {
    global $oxy_theme_options;

    $classes = array();
    $classes[] = $oxy_theme_options['footer_swatch'];
    $classes[] = 'section-' . $oxy_theme_options['footer_height'];
    $classes[] = $oxy_theme_options['footer_decoration'] !== 'none' ? 'has-top' : '';

    $classes = apply_filters( 'oxy_footer_section_class', $classes );
    echo implode( ' ', $classes );
}

/**
 * Creates the classes for the footer section
 *
 * @return space separated list of footer classes
 **/
function oxy_upper_footer_section_classes() {
    global $oxy_theme_options;

    $classes = array();
    $classes[] = $oxy_theme_options['upper_footer_swatch'];
    $classes[] = 'section-' . $oxy_theme_options['upper_footer_height'];
    $classes[] = $oxy_theme_options['upper_decoration'] !== 'none' ? 'has-top' : '';

    $classes = apply_filters( 'oxy_upper_footer_section_class', $classes );
    echo implode( ' ', $classes );
}

// filter to skip quote posts in next/prev pagination
function oxy_adjacent_post_where( $where )
{
    $quote_format = get_term_by( 'slug', 'post-format-quote', 'post_format' );
    $link_format  = get_term_by( 'slug', 'post-format-link', 'post_format' );

    if ( $quote_format !== false || $link_format !== false ) {
        $terms = array();
        if( $quote_format !== false ){
            $terms[] = $quote_format->term_id;
        }
        if( $link_format !== false ){
            $terms[] = $link_format->term_id;
        }
        $ex_cats_posts = get_objects_in_term( $terms, array('post_format') );
        if( !empty($ex_cats_posts) ){
            return $where . ' AND p.ID NOT IN (' .  implode($ex_cats_posts, ','). ' )';
        }
    }
    return $where;
}
add_filter( 'get_previous_post_where', 'oxy_adjacent_post_where' );
add_filter( 'get_next_post_where', 'oxy_adjacent_post_where' );

function oxy_output_extra_css() { ?>
    <style type="text/css" media="screen">
        <?php echo get_option( THEME_SHORT . '-header-css', '' ); ?>
        <?php echo get_option( THEME_SHORT . '-default-css' ); ?>
    </style>
    <?php
        if( oxy_get_option( 'swatch_css_save' ) === 'head' ) {
            $swatches = get_option( THEME_SHORT . '-swatch-list', array() );
            if( !empty( $swatches ) ){
                foreach ( $swatches as $swatch_css ) {
                    echo '<style type="text/css" media="screen">' . $swatch_css . '</style>';
                }
            }
            else{
                echo '<style type="text/css" media="screen">' . get_option( THEME_SHORT . '-swatches' ) . '</style>';
            }
        }
    ?>
    <style type="text/css" media="screen">
        <?php echo oxy_get_option( 'extra_css' ); ?>
        <?php if( is_admin_bar_showing() ) : ?>
            @media screen and (min-width: 782px) {
                .admin-bar .navbar-stuck {
                    top: 32px !important;
                }
            }
        <?php endif; ?>
    </style>
    <?php echo get_option('oxy-typography-js'); ?>
    <?php echo get_option('oxy-typography-css'); ?>

<?php
}
add_action('wp_head', 'oxy_output_extra_css');

function oxy_output_extra_js() {
    $extra_js = oxy_get_option( 'extra_js' );
    if( !empty( $extra_js ) ) { ?>
        <script type="text/javascript">
            <?php echo $extra_js; ?>
        </script>
<?php
    }
}
add_action('wp_head', 'oxy_output_extra_js');


/**
 * Converts hex to rgba with optional opacity
 *
 * @return space separated list of footer classes
 **/
function oxy_hex2rgba($color, $opacity = false) {

    $default = false;

    //Return default if no color provided
    if(empty($color)) {
        return $default;
    }

    //Check for a hex color string '#c1c2b4'
    if( ! preg_match('/^#[a-f0-9]{6}$/i', $color) ) {
        return $default;
    }

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if( $opacity !== false ){
        if(abs($opacity) > 1) {
            $opacity = 1.0;
        }
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}

function oxy_prefix_options_id( $prefix, $options ){
    foreach( $options as $index => &$val ) {
        $val['id'] = $prefix.'_'.$val['id'];
    }
    return $options;
}


/**
 * Adds an atom autor metadata tags
 *
 * @return void
 * @author
 **/

function oxy_atom_author_meta()
{
    $author = sprintf('%s', get_the_author());
    $title = sprintf('%s', get_the_title());

    $date = sprintf(
        '<time class="entry-date updated" datetime="%1$s">%2$s</time>',
        esc_attr(get_the_date('c')),
        esc_html(get_the_date('m.d.Y'))
    );
    $author_str = oxy_get_option('atom_author') === 'on' ? '<span class="author vcard"><span class="fn">' . $author . '</span></span>' : '';
    $title_str = oxy_get_option('atom_title') === 'on' ? '<span class="entry-title">' . $title . '</span>' : '';
    $date_str = oxy_get_option('atom_date') === 'on' ? $date : '';

    printf(
        '<span class="hide">%1$s%2$s%3$s</span>',
        $author_str,
        $title_str,
        $date_str
    );
}

function oxy_fix_paged_redirects( $redirect_url, $requested_url ) {
    if ( strpos( $requested_url, 'page/' ) !== false )
        return $requested_url;

    return $redirect_url;
}

add_filter( 'redirect_canonical', 'oxy_fix_paged_redirects', 10, 2 );

/**
 * Adds site title to wp_title filter
 *
 * @return Site title
 * @author
 **/
function oxy_set_wp_title($title, $sep)
{
    if (is_feed()) {
        return $title;
    }

    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo('name', 'display');

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title .= ' ' . $sep . ' ' . $site_description;
    }

    // Add a page number if necessary:
    if (($paged >= 2 || $page >= 2) && ! is_404()) {
        $title .= ' ' . $sep  . ' ' . sprintf(__('Page %s', 'angle-td'), max($paged, $page));
    }

    return $title;
}
add_filter('wp_title', 'oxy_set_wp_title', 10, 2);