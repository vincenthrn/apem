<ul class="isotope-filters small-screen-center">
    <li>
        <a class="pseudo-border active" data-filter="*" href="#">
            <?php _e( 'all', 'angle-td' ); ?>
        </a>
    </li><?php
    // render category filters.
    $category_filters = ( $cat == null )? get_categories() : $cat;
    foreach ( $category_filters as $filter ):
        $name = isset($filter->name)? $filter->name: $filter;
        $slug = isset($filter->slug)? $filter->slug: $filter; ?>
        <li>
            <a class="pseudo-border" data-filter=".filter-<?php echo urldecode($slug); ?>" href="#"><?php
                echo $name; ?>
            </a>
        </li><?php
    endforeach; ?>
</ul>
<div class="row">
    <div class="list-unstyled isotope no-transition <?php echo $container_class; ?>"><?php
    foreach( $posts as $post ):
        setup_postdata( $post );
        global $more;
        $more = 0;
        $post_categories = get_the_category();
        if($post_categories):
            $post_filters = array();
            foreach($post_categories as $category):
                $post_filters[] = 'filter-'.urldecode($category->slug);
            endforeach;
        endif; ?>
        <div class="post-item infinite-item <?php echo $span; ?> <?php echo implode( ' ', $post_filters); ?>">
            <div class="grid-post <?php echo $post_swatch ?>"><?php
                get_template_part( 'partials/content', get_post_format() ); ?>
            </div>
        </div><?php
    endforeach; ?>
    </div><?php
    if($pagination == 'on' || $infinite_scroll == 'on'){
        oxy_pagination('', 2, false, $infinite_scroll == 'on', true);
    } ?>
</div>