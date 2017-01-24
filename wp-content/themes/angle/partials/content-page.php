<?php
/**
 * Displays a single post
 *
 * @package Angle
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */
?>
<article id="post-<?php the_ID();?>"  <?php post_class(); ?>>
    <?php the_content( '', false ); ?>
    <?php oxy_atom_author_meta(); ?>
</article>
