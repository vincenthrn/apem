<?php $shadow_class = ($show_shadow === 'show') ? 'portfolio-shadows' : ''; ?>
<div class="portfolio isotope no-transition portfolio-<?php echo $shape; ?> <?php echo $shadow_class; ?> <?php echo implode( ' ', $container_class ); ?> row"><?php
foreach( $posts as $post ):
    setup_postdata($post);

    $thumbnail_id = get_post_thumbnail_id( $post->ID );
    $full_image_url = wp_get_attachment_image_src( $thumbnail_id, 'full' );
    $title = get_the_title();
    $magnific_title = '';
    $item_link = oxy_get_slide_link( $post );
    $link_target = get_post_meta( $post->ID, THEME_SHORT . '_target', true );
    $link_target = empty($link_target) ? '' : ' target="' . $link_target .'"';
    $item_data = oxy_get_portfolio_item_data( $post );
    $span_num = 12 / $columns;
    $classes = array(
        'col-md-' . $span_num,
        'col-sm-' . $span_num,
    );

    // Checking what type of captions the magnific popup will show
    if ( $magnific_caption === 'image_caption') {
        $magnific_title = oxy_get_image_caption(get_post_thumbnail_id( $post->ID ));
    } else if ( $magnific_caption === 'post_title_caption' ) {
        $magnific_title = get_the_title();
    }

    if ($magnific_caption === 'off') {
        $magnific_title = '';
    }

    $filter_tags = get_the_terms( $post->ID, 'oxy_portfolio_categories' );
    if( $filter_tags && ! is_wp_error( $filter_tags ) ) :
        foreach( $filter_tags as $tag ):
            $classes[] = 'filter-' .urldecode($tag->slug);
        endforeach;
    endif;
    $gallery_images = $item_data->isGallery == true ? ' data-links="'.$item_data->gallery_links.'" data-prev-text="'.__( 'Previous', 'angle-td' ).'" data-next-text="'.__( 'Next', 'angle-td' ).'" ':'';
    $image_link = $item_link;
    $image_class= "";
    if ( $show_overlay == "hide" && $show_magnific == 'show' ):
        $image_link  = $item_data->popup_link;
        $image_class = $item_data->popup_class;
    endif; ?>
    <div class="portfolio-item infinite-item <?php echo implode( ' ', $classes ); ?>" >
        <figure class="portfolio-figure">
            <a href="<?php echo $image_link; ?>" <?php echo $link_target ?> class="<?php echo $image_class; ?>" <?php echo $gallery_images; ?>>
                <?php echo get_the_post_thumbnail( $post->ID, $image_size , array( 'alt' => $item_data->title, 'class' => 'img-responsive' ) ); ?>
            </a><?php
        if($show_overlay == 'show'): ?>
            <figcaption><?php
            if($show_title == 'show'): ?>
                <h4>
                    <a href="<?php echo $item_link; ?>" <?php echo $link_target ?>><?php echo $item_data->title; ?></a>
                </h4><?php
            endif;
            if($show_excerpt == 'show'): ?>
                <p><?php
                    echo get_the_excerpt(); ?>
                </p><?php
            endif; ?>
                <a class="<?php echo $item_data->popup_class; ?> more image-all" href="<?php echo $item_data->popup_link; ?>" title="<?php echo $magnific_title;?> "<?php echo $gallery_images; ?> <?php echo $item_data->text_captions; ?> >
                    <i class="fa fa-search-plus"></i>
                </a>
                <a class="link" href="<?php echo $item_link; ?>" <?php echo $link_target ?>>
                    <i class="fa fa-link"></i>
                </a>
            </figcaption><?php
        endif; ?>
        </figure>
    </div>
    <?php
    wp_reset_postdata();

endforeach; ?>
</div><?php
if( $pagination !== 'off') {
    oxy_portfolio_pagination( $pagination );
}
