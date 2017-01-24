<div class="list-fancy-icons">
    <div class="list-item">
        <?php if( $show_icon === 'true') : ?>
            <?php if( $icon !== '') : ?>
                <div class="<?php echo $shape; ?>"> 
                    <i class="fa fa-<?php echo $icon; ?>" data-animation="<?php echo $animation; ?>"></i>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php
        if( !empty( $title ) ) : ?>
            <h3><?php echo $title; ?></h3>
        <?php
        endif; ?>
        <?php
        if( !empty( $content ) ) : ?>
            <p><?php echo $content; ?></p>
        <?php
        endif; ?>
    </div>
</div>
