<ul class="list-unstyled row box-list">
<?php
$members_count = count( $members );

foreach ($members as $member) :
    global $post;
    $post = $member;
    setup_postdata($post);
    global $more;
    $more = 0;
    $custom_fields = get_post_custom($post->ID);
    $position      = (isset($custom_fields[THEME_SHORT . '_position']))?  $custom_fields[THEME_SHORT . '_position'][0]:'';
    $moto_title    = (isset($custom_fields[THEME_SHORT . '_moto_title']))?$custom_fields[THEME_SHORT . '_moto_title'][0]:'';
    $moto_text     = (isset($custom_fields[THEME_SHORT . '_moto_text']))? $custom_fields[THEME_SHORT . '_moto_text'][0]:'';
    $link          = oxy_get_slide_link( $post );
    $post_link_target   = get_post_meta( $post->ID, THEME_SHORT . '_target', true );
    $post_link_target = empty($post_link_target) ? '' : ' target="' . $post_link_target . '"';

    $figcaption    = '<h4>'.$moto_title.'</h4><p>'.$moto_text.'</p>'; ?>
    <li class="col-md-<?php echo $columns; ?>">
        <?php echo oxy_create_shaped_featured_image( $post, $image_shape, $image_size, $image_shadow === 'show', $link, $figcaption ); ?>
        <h3 class="text-center"><?php
        if( 'on' === $link_name ) : ?>
            <a href="<?php echo $link ?>" <?php echo $post_link_target; ?>><?php
        endif;
            the_title();
        if( 'on' === $link_name ) : ?>
            </a><?php
        endif;
        if( 'show' === $show_position ) : ?>
            <small class="block"><?php
                echo $position; ?>
            </small><?php
        endif; ?>
        </h3><?php

        if( 'show' === $show_excerpts ) : ?>
            <p class="text-<?php echo $align_excerpts; ?>">
            <?php echo get_the_excerpt(); ?>
            </p><?php
        endif;
        if( 'show' === $show_social ) : ?>
            <ul class="list-inline text-center social-icons social-simple"><?php
            for( $i = 0; $i < 5; $i++):
                $icon = (isset($custom_fields[THEME_SHORT . '_icon'.$i]))? $custom_fields[THEME_SHORT . '_icon'.$i][0]:'';
                $url = (isset($custom_fields[THEME_SHORT . '_link'.$i]))? $custom_fields[THEME_SHORT . '_link'.$i][0]:'';
                if($url !== ''): ?>
                    <li>
                        <a href="<?php echo $url; ?>" <?php echo $post_link_target; ?>>
                            <i class="fa fa-<?php echo $icon; ?>"></i>
                        </a>
                    </li><?php
                endif;
            endfor; ?>
            </ul><?php
        endif; ?>
    </li><?php
endforeach; ?>
</ul>