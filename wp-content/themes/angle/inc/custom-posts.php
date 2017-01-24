<?php
/**
 * Oxygenna.com
 *
 * :: *(TEMPLATE_NAME)*
 * :: *(COPYRIGHT)*
 * :: *(LICENCE)*
 */

function oxy_fetch_custom_columns($column) {
    global $post;
    switch( $column ) {
        case 'menu_order':
            echo $post->menu_order;
            echo '<input id="qe_slide_order_"' . $post->ID . '" type="hidden" value="' . $post->menu_order . '" />';
        break;

        case 'featured-image':
            $editlink = get_edit_post_link( $post->ID );
            echo '<a href="' . $editlink . '">' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '</a>';
        break;

        case 'slideshows-category':
            echo get_the_term_list( $post->ID, 'oxy_slideshow_categories', '', ', ' );
        break;

        case 'service-category':
            echo get_the_term_list( $post->ID, 'oxy_service_category', '', ', ' );
        break;

        case 'departments-category':
            echo get_the_term_list( $post->ID, 'oxy_staff_department', '', ', ' );
        break;

        case 'job-title':
            echo get_post_meta( $post->ID, THEME_SHORT . '_position', true );
        break;

        case 'portfolio-category':
            echo get_the_term_list( $post->ID, 'oxy_portfolio_categories', '', ', ' );
        break;

        case 'swatch-status':
            $status = get_post_meta( $post->ID, THEME_SHORT . '_status', true );
            if( $status === 'enabled' ) {
                echo '<h4 class="swatch-status enabled">Swatch Enabled</h4>';
            }
            else {
                echo '<h4 class="swatch-status disabled">Swatch Disabled</h4>';
            }
        break;
        case 'testimonial-group':
            echo get_the_term_list( $post->ID, 'oxy_testimonial_group', '', ', ' );
        break;
        case 'testimonial-citation':
            echo get_post_meta( $post->ID, THEME_SHORT . '_citation', true );
        break;

        case 'swatch-preview':
            $header                 = get_post_meta( $post->ID, THEME_SHORT . '_header', true );
            $background             = get_post_meta( $post->ID, THEME_SHORT . '_background', true );
            $text                   = get_post_meta( $post->ID, THEME_SHORT . '_text', true );
            $icon                   = get_post_meta( $post->ID, THEME_SHORT . '_icon', true );
            $link                   = get_post_meta( $post->ID, THEME_SHORT . '_link', true );
            $link_hover             = get_post_meta( $post->ID, THEME_SHORT . '_link_hover', true );
            $foreground             = get_post_meta( $post->ID, THEME_SHORT . '_foreground', true );
            $overlay                = get_post_meta( $post->ID, THEME_SHORT . '_overlay', true );
            $form_background        = get_post_meta( $post->ID, THEME_SHORT . '_form_background', true );
            $form_text              = get_post_meta( $post->ID, THEME_SHORT . '_form_text', true );
            $form_active            = get_post_meta( $post->ID, THEME_SHORT . '_form_active', true );
            $form_button_background = get_post_meta( $post->ID, THEME_SHORT . '_primary_button_background', true );
            $form_button_text       = get_post_meta( $post->ID, THEME_SHORT . '_primary_button_text', true );
            ?>

            <div class="swatch-preview" style="background:<?php echo $background; ?>">
                <h2 style="color:<?php echo $header; ?>; text-align:center;">This is how a title will look</h2>
                <p style="color:<?php echo $text; ?>; line-height: 1.5em;">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Perspiciatis, <a href="#" style="color:<?php echo $link; ?>;" onmouseover="this.style.color='<?php echo $link_hover; ?>'" onmouseout="this.style.color='<?php echo $link; ?>'">Links will look like this neque quis cumque nobis</a> dolore provident unde hic aspernatur porro accusantium.
                    Ratione odit iste ducimus excepturi cupiditate amet similique laborum molestiae!
                </p>
                <p style="color:<?php echo $text;?>; text-align:center; margin-bottom: 12px;">Icons will look like this <span class="icons" style="color: <?php echo $icon; ?>; font-size: 2em; display: block; margin-top: 6px;">&hearts; &spades; &clubs; &diams;</span></p>
                <div style="background:<?php echo $foreground; ?>; padding: 10px; margin-bottom: 12px;">
                    <p style="color:<?php echo $background; ?>; margin-bottom: 0;">Foreground items will look like this</p>
                </div>
                <form style="padding: 0;">
                    <input type="text" value="This is a text field" style="background:<?php echo $form_background; ?>; color:<?php echo $form_text; ?>; padding: 5px; border: 0; border-radius: 0;"  />
                    <button style="color:<?php echo $form_button_text; ?>; text-align:center; padding: 6px; border: 0; border-radius: 0; display: block; margin: 12px 0 0 0; background:<?php echo $form_button_background; ?>;" >Thats a button</button>
                </form>
            </div>
        <?php
        break;

        default:
            // do nothing
        break;
    }
}
add_action( 'manage_posts_custom_column', 'oxy_fetch_custom_columns' );

/**
 * Slideshow Custom Post
 */

$labels = array(
    'name'               => __( 'Slideshow Images', 'angle-admin-td' ),
    'singular_name'      => __( 'Slideshow Image', 'angle-admin-td' ),
    'add_new'            => __( 'Add New', 'angle-admin-td' ),
    'add_new_item'       => __( 'Add New Image', 'angle-admin-td' ),
    'edit_item'          => __( 'Edit Image', 'angle-admin-td' ),
    'new_item'           => __( 'New Image', 'angle-admin-td' ),
    'view_item'          => __( 'View Image', 'angle-admin-td' ),
    'search_items'       => __( 'Search Images', 'angle-admin-td' ),
    'not_found'          => __( 'No images found', 'angle-admin-td' ),
    'not_found_in_trash' => __( 'No images found in Trash', 'angle-admin-td' ),
    'menu_name'          => __( 'Slider Images', 'angle-admin-td' )
);

$args = array(
    'labels'    => $labels,
    'public'    => false,
    'show_ui'   => true,
    'query_var' => false,
    'rewrite'   => false,
    'menu_icon' => 'dashicons-slides',
    'supports'  => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
);

// create custom post
register_post_type( 'oxy_slideshow_image', $args );

// Register slideshow taxonomy
$labels = array(
    'name'          => __( 'Slideshows', 'angle-admin-td' ),
    'singular_name' => __( 'Slideshow', 'angle-admin-td' ),
    'search_items'  => __( 'Search Slideshows', 'angle-admin-td' ),
    'all_items'     => __( 'All Slideshows', 'angle-admin-td' ),
    'edit_item'     => __( 'Edit Slideshow', 'angle-admin-td'),
    'update_item'   => __( 'Update Slideshow', 'angle-admin-td'),
    'add_new_item'  => __( 'Add New Slideshow', 'angle-admin-td'),
    'new_item_name' => __( 'New Slideshow Name', 'angle-admin-td')
);

register_taxonomy(
    'oxy_slideshow_categories',
    'oxy_slideshow_image',
    array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
        'query_var'    => false,
        'rewrite'      => false
    )
);

// move featured image box on slideshow
function oxy_move_slideshow_meta_box() {
    remove_meta_box( 'postimagediv', 'oxy_slideshow_image', 'side' );
    add_meta_box('postimagediv', __('Slideshow Image', 'angle-admin-td'), 'post_thumbnail_meta_box', 'oxy_slideshow_image', 'advanced', 'low');
}
add_action('do_meta_boxes', 'oxy_move_slideshow_meta_box');

function oxy_edit_columns_slideshow($columns) {
    $columns = array(
        'cb'                  => '<input type="checkbox" />',
        'title'               => __('Image Title', 'angle-admin-td'),
        'featured-image'      => __('Image', 'angle-admin-td'),
        'menu_order'          => __('Order', 'angle-admin-td'),
        'slideshows-category' => __('Slideshows', 'angle-admin-td'),
    );
    return $columns;
}
add_filter( 'manage_edit-oxy_slideshow_image_columns', 'oxy_edit_columns_slideshow' );


/* --------------------- SERVICES ------------------------*/

$labels = array(
    'name'               => __('Services', 'angle-admin-td'),
    'singular_name'      => __('Service', 'angle-admin-td'),
    'add_new'            => __('Add New', 'angle-admin-td'),
    'add_new_item'       => __('Add New Service', 'angle-admin-td'),
    'edit_item'          => __('Edit Service', 'angle-admin-td'),
    'new_item'           => __('New Service', 'angle-admin-td'),
    'all_items'          => __('All Services', 'angle-admin-td'),
    'view_item'          => __('View Service', 'angle-admin-td'),
    'search_items'       => __('Search Services', 'angle-admin-td'),
    'not_found'          => __('No Service found', 'angle-admin-td'),
    'not_found_in_trash' => __('No Service found in Trash', 'angle-admin-td'),
    'menu_name'          => __('Services', 'angle-admin-td')
);

// fetch service slug
$service_slug = trim( _x(oxy_get_option( 'services_slug' ), 'URL slug', 'angle-admin-td' ));
if( empty($service_slug) ) {
    $service_slug = _x('our-services', 'URL slug', 'angle-admin-td');
}

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-flag',
    'supports'           => array( 'title', 'excerpt', 'editor', 'thumbnail', 'page-attributes', 'revisions' ),
    'rewrite'            => array( 'slug' => $service_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
);
register_post_type( 'oxy_service', $args );

$labels = array(
    'name'          => __( 'Categories', 'angle-admin-td' ),
    'singular_name' => __( 'Category', 'angle-admin-td' ),
    'search_items'  => __( 'Search Categories', 'angle-admin-td' ),
    'all_items'     => __( 'All Categories', 'angle-admin-td' ),
    'edit_item'     => __( 'Edit Category', 'angle-admin-td'),
    'update_item'   => __( 'Update Category', 'angle-admin-td'),
    'add_new_item'  => __( 'Add New Category', 'angle-admin-td'),
    'new_item_name' => __( 'New Category Name', 'angle-admin-td')
);

register_taxonomy(
    'oxy_service_category',
    'oxy_service',
    array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
    )
);

function oxy_edit_columns_services($columns) {
   // $columns['featured_image']= 'Featured Image';
    $columns = array(
        'cb'             => '<input type="checkbox" />',
        'title'          => __('Service', 'angle-admin-td'),
        'featured-image' => __('Image', 'angle-admin-td'),
        'service-category'     => __('Category', 'angle-admin-td')
    );
    return $columns;
}
add_filter( 'manage_edit-oxy_service_columns', 'oxy_edit_columns_services' );

/* ------------------ TESTIMONIALS -----------------------*/

$labels = array(
    'name'               => __('Testimonial', 'angle-admin-td'),
    'singular_name'      => __('Testimonial', 'angle-admin-td'),
    'add_new'            => __('Add New', 'angle-admin-td'),
    'add_new_item'       => __('Add New Testimonial', 'angle-admin-td'),
    'edit_item'          => __('Edit Testimonial', 'angle-admin-td'),
    'new_item'           => __('New Testimonial', 'angle-admin-td'),
    'all_items'          => __('All Testimonial', 'angle-admin-td'),
    'view_item'          => __('View Testimonial', 'angle-admin-td'),
    'search_items'       => __('Search Testimonial', 'angle-admin-td'),
    'not_found'          => __('No Testimonial found', 'angle-admin-td'),
    'not_found_in_trash' => __('No Testimonial found in Trash', 'angle-admin-td'),
    'menu_name'          => __('Testimonials', 'angle-admin-td')
);

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-format-quote',
    'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
);
register_post_type('oxy_testimonial', $args);

$labels = array(
    'name'          => __( 'Groups', 'angle-admin-td' ),
    'singular_name' => __( 'Group', 'angle-admin-td' ),
    'search_items'  => __( 'Search Groups', 'angle-admin-td' ),
    'all_items'     => __( 'All Groups', 'angle-admin-td' ),
    'edit_item'     => __( 'Edit Group', 'angle-admin-td'),
    'update_item'   => __( 'Update Group', 'angle-admin-td'),
    'add_new_item'  => __( 'Add New Group', 'angle-admin-td'),
    'new_item_name' => __( 'New Group Name', 'angle-admin-td')
);

register_taxonomy(
    'oxy_testimonial_group',
    'oxy_testimonial',
    array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
        'query_var'    => true,
    )
);

function oxy_edit_columns_testimonial($columns) {
   // $columns['featured_image']= 'Featured Image';
    $columns = array(
        'cb'                   => '<input type="checkbox" />',
        'title'                => __('Author', 'angle-admin-td'),
        'featured-image'       => __('Image', 'angle-admin-td'),
        'testimonial-citation' => __('Citation', 'angle-admin-td'),
        'testimonial-group'    => __('Group', 'angle-admin-td')
    );
    return $columns;
}
add_filter( 'manage_edit-oxy_testimonial_columns', 'oxy_edit_columns_testimonial' );


/* --------------------- STAFF ------------------------*/

$labels = array(
    'name'               => __('Staff', 'angle-admin-td'),
    'singular_name'      => __('Staff', 'angle-admin-td'),
    'add_new'            => __('Add New', 'angle-admin-td'),
    'add_new_item'       => __('Add New Staff', 'angle-admin-td'),
    'edit_item'          => __('Edit Staff', 'angle-admin-td'),
    'new_item'           => __('New Staff', 'angle-admin-td'),
    'all_items'          => __('All Staff', 'angle-admin-td'),
    'view_item'          => __('View Staff', 'angle-admin-td'),
    'search_items'       => __('Search Staff', 'angle-admin-td'),
    'not_found'          => __('No Staff found', 'angle-admin-td'),
    'not_found_in_trash' => __('No Staff found in Trash', 'angle-admin-td'),
    'menu_name'          => __('Staff', 'angle-admin-td')
);

// fetch portfolio slug
$staff_slug = trim( _x( oxy_get_option( 'staff_slug' ), 'URL slug', 'angle-admin-td' )  );
if( empty($staff_slug) ) {
    $staff_slug = _x('staff', 'URL slug', 'angle-admin-td');
}

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-businessman',
    'supports'           => array( 'title', 'excerpt', 'editor', 'thumbnail', 'page-attributes', 'revisions' ),
    'rewrite' => array( 'slug' => $staff_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
);
register_post_type('oxy_staff', $args);

$labels = array(
    'name'          => __( 'Departments', 'angle-admin-td' ),
    'singular_name' => __( 'Department', 'angle-admin-td' ),
    'search_items'  =>  __( 'Search Departments', 'angle-admin-td' ),
    'all_items'     => __( 'All Departments', 'angle-admin-td' ),
    'edit_item'     => __( 'Edit Department', 'angle-admin-td'),
    'update_item'   => __( 'Update Department', 'angle-admin-td'),
    'add_new_item'  => __( 'Add New Department', 'angle-admin-td'),
    'new_item_name' => __( 'New Department Name', 'angle-admin-td')
);

register_taxonomy(
    'oxy_staff_department',
    'oxy_staff',
    array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
    )
);

function oxy_edit_columns_staff($columns) {
   // $columns['featured_image']= 'Featured Image';
    $columns = array(
        'cb'                   => '<input type="checkbox" />',
        'title'                => __('Name', 'angle-admin-td'),
        'featured-image'       => __('Image', 'angle-admin-td'),
        'job-title'            => __('Job Title', 'angle-admin-td'),
        'departments-category' => __('Department', 'angle-admin-td')
    );
    return $columns;
}
add_filter( 'manage_edit-oxy_staff_columns', 'oxy_edit_columns_staff' );


/***************** PORTFOLIO *******************/

$labels = array(
    'name'               => __('Portfolio Items', 'angle-admin-td'),
    'singular_name'      => __('Portfolio Item', 'angle-admin-td'),
    'add_new'            => __('Add New', 'angle-admin-td'),
    'add_new_item'       => __('Add New Portfolio Item', 'angle-admin-td'),
    'edit_item'          => __('Edit Portfolio Item', 'angle-admin-td'),
    'new_item'           => __('New Portfolio Item', 'angle-admin-td'),
    'view_item'          => __('View Portfolio Item', 'angle-admin-td'),
    'search_items'       => __('Search Portfolio Items', 'angle-admin-td'),
    'not_found'          =>  __('No images found', 'angle-admin-td'),
    'not_found_in_trash' => __('No images found in Trash', 'angle-admin-td'),
    'parent_item_colon'  => '',
    'menu_name'          => __('Portfolio Items', 'angle-admin-td')
);

// fetch portfolio slug
$permalink_slug = trim( _x( oxy_get_option( 'portfolio_slug' ), 'URL slug', 'angle-admin-td' ) );
if( empty($permalink_slug) ) {
    $permalink_slug = _x('portfolio', 'URL slug', 'angle-admin-td' );
}

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'query_var'          => true,
    'has_archive'        => true,
    'capability_type'    => 'post',
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-portfolio',
    'supports'           => array('title', 'excerpt', 'editor', 'thumbnail', 'page-attributes', 'post-formats' ),
    'rewrite' => array( 'slug' => $permalink_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
);

// create custom post
register_post_type( 'oxy_portfolio_image', $args );

// Register portfolio taxonomy
$labels = array(
    'name'          => __( 'Categories', 'angle-admin-td' ),
    'singular_name' => __( 'Category', 'angle-admin-td' ),
    'search_items'  =>  __( 'Search Categories', 'angle-admin-td' ),
    'all_items'     => __( 'All Categories', 'angle-admin-td' ),
    'edit_item'     => __( 'Edit Category', 'angle-admin-td'),
    'update_item'   => __( 'Update Category', 'angle-admin-td'),
    'add_new_item'  => __( 'Add New Category', 'angle-admin-td'),
    'new_item_name' => __( 'New Category Name', 'angle-admin-td')
);

register_taxonomy(
    'oxy_portfolio_categories',
    'oxy_portfolio_image',
    array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
        'query_var'    => true,
    )
);

$labels = array(
    'name'          => __( 'Features', 'angle-admin-td' ),
    'singular_name' => __( 'Feature', 'angle-admin-td' ),
    'search_items'  =>  __( 'Search Features', 'angle-admin-td' ),
    'all_items'     => __( 'All Features', 'angle-admin-td' ),
    'edit_item'     => __( 'Edit Feature', 'angle-admin-td' ),
    'update_item'   => __( 'Update Feature', 'angle-admin-td' ),
    'add_new_item'  => __( 'Add New Feature', 'angle-admin-td' ),
    'new_item_name' => __( 'New Feature Name', 'angle-admin-td' )
);

register_taxonomy(
    'oxy_portfolio_features',
    'oxy_portfolio_image',
    array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
        'query_var'    => true,
    )
);

function oxy_edit_columns_portfolio($columns) {
   // $columns['featured_image']= 'Featured Image';
    $columns = array(
        'cb'                 => '<input type="checkbox" />',
        'title'              => __('Item', 'angle-admin-td'),
        'featured-image'     => __('Image', 'angle-admin-td'),
        'menu_order'         => __('Order', 'angle-admin-td'),
        'portfolio-category' => __('Categories', 'angle-admin-td')
    );
    return $columns;
}
add_filter( 'manage_edit-oxy_portfolio_image_columns', 'oxy_edit_columns_portfolio' );

$labels = array(
    'name'               => __('Mega Menu', 'angle-admin-td'),
    'singular_name'      => __('Mega Menu', 'angle-admin-td'),
);

$args = array(
    'labels'             => $labels,
    'public'             => false,
    'publicly_queryable' => false,
    'show_ui'            => false,
    'show_in_menu'       => true,
    'query_var'          => false,
    'show_in_nav_menus'  => true,
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => null,
);
register_post_type('oxy_mega_menu', $args);

$labels = array(
    'name'               => __('Mega Menu Columns', 'angle-admin-td'),
    'singular_name'      => __('Mega Menu Columns', 'angle-admin-td'),
);

$args = array(
    'labels'             => $labels,
    'public'             => false,
    'publicly_queryable' => false,
    'show_ui'            => false,
    'show_in_menu'       => false,
    'query_var'          => false,
    'show_in_nav_menus'  => true,
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => null,
);
register_post_type('oxy_mega_columns', $args);

/* --------------------- SWATCHES ------------------------*/

$labels = array(
    'name'               => __('Swatches', 'angle-admin-td'),
    'singular_name'      => __('Swatch', 'angle-admin-td'),
    'add_new'            => __('Add New', 'angle-admin-td'),
    'add_new_item'       => __('Add New Swatch', 'angle-admin-td'),
    'edit_item'          => __('Edit Swatch', 'angle-admin-td'),
    'new_item'           => __('New Swatch', 'angle-admin-td'),
    'all_items'          => __('All Swatches', 'angle-admin-td'),
    'view_item'          => __('View Swatch', 'angle-admin-td'),
    'search_items'       => __('Search Swatch', 'angle-admin-td'),
    'not_found'          => __('No Swatch found', 'angle-admin-td'),
    'not_found_in_trash' => __('No Swatch found in Trash', 'angle-admin-td'),
    'menu_name'          => __('Swatches', 'angle-admin-td')
);

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'exclude_from_search'=> true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-admin-settings',
    'supports'           => array( 'title' )
);
register_post_type('oxy_swatch', $args);

function oxy_edit_columns_swatch($columns) {
   // $columns['featured_image']= 'Featured Image';
    $columns = array(
        'cb'             => '<input type="checkbox" />',
        'title'          => __('Swatch', 'angle-admin-td'),
        'swatch-preview' => __('Preview', 'angle-admin-td'),
        'swatch-status'  => __('Status', 'angle-admin-td'),
    );
    return $columns;
}
add_filter( 'manage_edit-oxy_swatch_columns', 'oxy_edit_columns_swatch' );
