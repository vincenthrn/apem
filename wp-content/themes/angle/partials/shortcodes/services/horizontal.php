<ul class="list-unstyled row <?php echo $connected; ?> box-list"> <?php
foreach( $services as $post ) :
    setup_postdata($post);
    global $more;    // Declare global $more (before the loop).
    $more        = 0;
    $link        = oxy_get_slide_link( $post );
    $image_link  = $link_images === 'on' ? $link : null;
    $link_target = get_post_meta( $post->ID, THEME_SHORT. '_target', true ); ?>
    <li class="col-md-<?php echo $columns; ?>">
    <?php echo oxy_create_shaped_featured_image( $post, $image_shape, $image_size, $image_shadow === 'show', $image_link, null, null, $link_target); ?>
    <?php $link_target = empty($link_target) ? '' : ' target="' . $link_target . '"'; ?>
    <?php
    if( 'show' === $show_titles ) : ?>
        <h3 class="text-center">
        <?php
        if( 'on' === $link_titles ) : ?>
            <a href="<?php echo $link; ?>" <?php echo $link_target; ?>>
        <?php
        endif; ?>
            <?php the_title(); ?>
        <?php
        if( 'on' === $link_titles ) : ?>
            </a>
        <?php
        endif; ?>
        </h3>
    <?php
    endif; ?>
    <?php
    if( 'show' === $show_excerpts ) : ?>
        <p class="text-<?php echo $align_excerpts; ?>">
        <?php echo get_the_excerpt(); ?>
        </p>
    <?php
    endif; ?>
    <?php
    if( 'show' === $show_readmores ) : ?>
        <a href="<?php echo $link ?>" class="more-link text-<?php echo $align_excerpts; ?>" <?php echo $link_target; ?>>
        <?php echo $readmore_text; ?>
        </a>
    <?php
    endif ?>
    </li>
<?php
endforeach; ?>
</ul>