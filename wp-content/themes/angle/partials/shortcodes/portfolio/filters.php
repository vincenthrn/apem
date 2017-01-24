<?php
foreach( $filters as $key => $filter ):
    // remove portfolio from filter if not needed
    if( !in_array( $filter->slug, $selected_portfolios ) ) :
        unset( $filters[$key] );
    endif;
endforeach; ?>
<ul class="isotope-filters text-center">
    <li class="active">
        <a class="pseudo-border active" data-filter="*" href="#"><?php _e( 'all', 'angle-td' ); ?></a>
    </li><?php
    foreach( $filters as $filter ) : ?>
        <li><a class="pseudo-border" data-filter=".filter-<?php echo urldecode($filter->slug); ?>" href="#"><?php echo $filter->name; ?></a></li><?php
    endforeach; ?>
</ul>
