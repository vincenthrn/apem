<div class="<?php echo implode( ' ', $classes ); ?>">
    <?php
    if( $heading !== "" ) : ?>
    <h2 class="pricing-head"><?php echo $heading; ?></h2>
    <?php
    endif; ?>
    <div class="pricing-body">
        <?php
        if( $show_price === 'true' ) : ?>
        <div class="pricing-price">
            <div class="overlay">
                <h4>
                    <?php
                    if( $currency === 'custom' ) : ?>
                    <small><?php echo $custom_currency; ?></small>
                    <?php
                    else : ?>
                    <small><?php echo $currency; ?></small>
                    <?php
                    endif; ?>
                    <?php echo $price; ?>
                    <small><?php echo $per; ?></small>
                </h4>
            </div>
        </div>
        <?php
        endif; ?>
        <ul class="pricing-list">
        <?php
        foreach( $list as $item ) : ?>
            <li><?php echo $item; ?></li>
        <?php
        endforeach; ?>
        </ul>
        <?php
        if( $show_button === 'true' ) : ?>
        <a href="<?php echo $button_link; ?>" class="btn btn-lg btn-primary"><?php echo $button_text; ?></a>
        <?php
        endif; ?>
    </div>
</div>