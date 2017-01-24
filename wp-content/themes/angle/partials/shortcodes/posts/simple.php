<div class="row">
    <ul class="list-unstyled list-container"><?php
    foreach( $posts as $post ):
        setup_postdata( $post );
        global $more;
        $more = 0; ?>
        <li class="post-item <?php echo $span; ?>">
            <div class="grid-post <?php echo $post_swatch ?>"><?php
                get_template_part( 'partials/content', get_post_format() ); ?>
            </div>
        </li><?php
    endforeach; ?>
    </ul>
</div><?php
if($pagination == 'on'){
    oxy_pagination('', 2, false, false, true);
} ?>