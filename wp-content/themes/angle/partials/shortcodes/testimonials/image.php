<?php
$id = 'flexslider-' . rand(1,100);
$slideshow_class = $slideshow == 'on'? 'flexslider':''; ?>
<div id="<?php echo $id; ?>" class="<?php echo $slideshow_class; ?> feature-slider" data-flex-animation="slide" data-flex-controls-position="inside" data-flex-directions="hide" data-flex-speed="<?php echo esc_attr($speed); ?>" data-flex-controls="show" data-flex-slideshow="true">
    <ul class="slides list-unstyled"><?php
    foreach ($items as $item) :
        global $post;
        $post = $item;
        setup_postdata($post);
        $custom_fields = get_post_custom($post->ID);
        $cite  = (isset($custom_fields[THEME_SHORT.'_citation']))? $custom_fields[THEME_SHORT.'_citation'][0]:''; ?>
        <li>
            <blockquote class="fancy-blockquote">
                <div class="row">
                    <div class="col-md-2"><?php
                        echo oxy_create_shaped_featured_image( $post, 'round', 'huge', false, null, null, true ); ?>
                    </div>
                    <div class="col-md-10">
                        <p><?php
                            echo get_the_content(); ?>
                        </p>
                        <small><?php
                            the_title();
                            if( !empty( $cite ) ) {?>
                            <cite title="Source Title"><?php
                                echo $cite; ?>
                            </cite>
                        <?php } ?>
                        </small>
                    </div>
                </div>
            </blockquote>
        </li><?php
    endforeach; ?>
    </ul>
</div><?php
wp_reset_postdata(); ?>
