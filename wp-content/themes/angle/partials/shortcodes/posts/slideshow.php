<?php
$total_indicators = ceil( count( $posts )/$columns );
$indicator = 0;
$index = 1;
$id = 'news'. rand(1,100); ?>
<div class="carousel slide" id="<?php echo $id; ?>">
    <ol class="carousel-indicators"><?php
    $active = 'class="active"';
    while( $indicator < $total_indicators): ?>
        <li data-target="#<?php echo $id; ?>" data-slide-to="<?php echo $indicator++; ?>"<?php echo $active; ?>></li><?php
        $active = '';
    endwhile; ?>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <div class="row"><?php
            foreach( $posts as $post ):
                setup_postdata( $post );
                global $more;    // Declare global $more (before the loop).
                $more = 0;
                // setup a new row every x columns
                if($index++ > $columns): ?>
                    </div></div><div class="item"><div class="row"><?php
                    $index = 2;
                endif; ?>
                <div class="<?php echo $span; ?>">
                    <div class="grid-post <?php echo $post_swatch ?>"><?php
                        get_template_part( 'partials/content', get_post_format() ); ?>
                    </div>
                </div><?php
            endforeach; ?>
            </div>
        </div>
    </div>
</div>