<ul class="list-unstyled <?php echo $connected; ?> box-list">
<?php
foreach( $services as $post ) :
    setup_postdata($post);
    global $more;    // Declare global $more (before the loop).
    $more        = 0;
    $link        = oxy_get_slide_link( $post );
    $image_link  = $link_images === 'on' ? $link : null;
    $link_target = get_post_meta( $post->ID, THEME_SHORT. '_target', true ); ?>
    <li class="row">
        <div class="col-md-3">
        <?php echo oxy_create_shaped_featured_image( $post, $image_shape, $image_size, $image_shadow === 'show', $image_link, null, null, $link_target ); ?>
        </div>
        <div class="col-md-9">
        <?php
        if( 'show' === $show_titles ) : ?>
            <h2 class="bordered-header small-screen-center">
            <?php
            if( 'on' === $link_titles ) : ?>
                <a href="<?php echo $link;?>" target="<?php echo $link_target; ?>" >
            <?php
            endif; ?>
                <?php the_title(); ?>
            <?php
            if( 'on' === $link_titles ) : ?>
                </a>
            <?php
            endif; ?>
            </h2>
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
            <a href="<?php echo $link ?>" class="more-link text-<?php echo $align_excerpts; ?>" target="<?php echo $link_target; ?>">
            <?php echo $readmore_text; ?>
            </a>
        <?php
        endif ?>
        </div>
    </li>
<?php
endforeach; ?>
</ul>