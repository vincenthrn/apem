<?php
/*
Template Name: OnePage
*/


get_header();?>

    <div class="anim-container">
        <div class="scene scene1">
            <p class="scene1__msg">Selon l’Organisation Mondiale de la Santé,</p>
            <div class="scene1__drop">
                <p><span>+ de</span><span>60<sup>%</sup></span></p>
            </div>
            <p class="scene1__msg2">de la population africaine n’a pas accès à l’eau potable</p>
        </div>
        <div class="scene scene2">
            <img src="wp-content/uploads/2017/01/pin.svg" alt="">
            <p><span>PK11,</span> quartier de Douala</p>
        </div>
        <div class="scene scene3">
            <p>composé environ de 5000 habitants,</p>
            <div class="scene3__people">
                <div class="scene3__peoplePart1">
                    <img src="wp-content/uploads/2017/01/childShadow.png" alt="ombre enfant">
                    <img src="wp-content/uploads/2017/01/childShadow.png" alt="ombre enfant">
                </div>
                <img class="scene3__peopleChild" src="wp-content/uploads/2017/01/child.png" alt="">
                <div class="scene3__peoplePart2">
                    <img src="wp-content/uploads/2017/01/childShadow.png" alt="ombre enfant">
                    <img src="wp-content/uploads/2017/01/childShadow.png" alt="ombre enfant">
                </div>
            </div>
        </div>
        <div class="scene scene4">
            <p>80% des habitants ne sont pas connectés au réseau de distribution d’eau potable.</p>
            <div class="scene4__people">
                <div class="scene4__peoplePart1">
                    <img src="wp-content/uploads/2017/01/childShadow.png" alt="ombre enfant">
                </div>
                <img class="scene4__peopleChild" src="wp-content/uploads/2017/01/childSad.png" alt="">
                <div class="scene4__peoplePart2">
                    <img src="wp-content/uploads/2017/01/childShadow.png" alt="ombre enfant">
                </div>
            </div>
        </div>
        <div class="scene scene5">
            <img class="scene5__child" src="wp-content/uploads/2017/01/childSad.png" alt="ombre enfant">
            <img class="scene5__puit" src="wp-content/uploads/2017/01/puit.svg" alt="">
            <img class="scene5__foreuse" src="wp-content/uploads/2017/01/foreuse.svg" alt="">
            <img class="scene5__background" src="wp-content/uploads/2017/01/decor.jpg" alt="">
            <p class="scene5__paragraphe">Un ouvrier vient installer une pompe à eau en creusant plus profondément.</p>
            <img class="scene5__nuage" src="wp-content/uploads/2017/01/nuage.png" alt="">
            <p class="scene5__paragraphe2">Le coût des travaux s’élève à <span>23 638€</span>.</p>
        </div>
        <div class="scene scene6">
            <p>Un membre de l’association vient former les habitants du village.</p>
            <img src="wp-content/uploads/2017/01/peuple.png" alt="" class="scene6__peuple">
            <img src="wp-content/uploads/2017/01/assosAndChild.png" alt="" class="scene6__assos">
            <img src="wp-content/uploads/2017/01/bubbleRight.png" alt="" class="scene6__bubble1">
            <img src="wp-content/uploads/2017/01/bubbleLeft.png" alt="" class="scene6__bubble2">
            <img src="wp-content/uploads/2017/01/pointBubble.png" alt="" class="scene6__bubble3">
            <img src="wp-content/uploads/2017/01/famille.png" alt="" class="scene6__famille">
        </div>
        <div class="scene scene7">
            <p>La famille souscrit un abonnement de 24 centimes/mois</p>
            <img src="wp-content/uploads/2017/01/famille2.png" alt="" class="scene7__famille">
            <img src="wp-content/uploads/2017/01/bank.png" alt="" class="scene7__bank">
            <img src="wp-content/uploads/2017/01/coin.png" alt="" class="scene7__coin">
        </div>
        <div class="scene scene8">
            <p class="scene8__paragraphe">Lorsque un problème technique survient,</p>
            <p class="scene8__paragraphe2">Un technicien arrive pour réparer la panne.</p>
            <p class="scene8__paragraphe3">Il se fait payer par le comité grâce à la caisse.</p>
            <img src="wp-content/uploads/2017/01/pompe.svg" alt="" class="scene8__pompe">
            <img src="wp-content/uploads/2017/01/pompe2.svg" alt="" class="scene8__pompe2">
            <img src="wp-content/uploads/2017/01/technicien.png" alt="" class="scene8__technicien">
            <img src="wp-content/uploads/2017/01/cle.png" alt="" class="scene8__cle">
            <img src="wp-content/uploads/2017/01/bank.png" alt="" class="scene8__bank">
            <img src="wp-content/uploads/2017/01/arrow.png" alt="" class="scene8__arrow">
        </div>
        <div class="scene scene9">
            <img src="wp-content/uploads/2017/01/circle.png" alt="" class="scene9__circle">
            <img src="wp-content/uploads/2017/01/arrowCircle.png" alt="" class="scene9__arrow">
            <!-- <img src="wp-content/uploads/2017/01/logo.png" alt="" class="scene9__logo"> -->
        </div>
</div>

<?php global $post;
oxy_page_header( $post->ID );
while( have_posts() ) {
    the_post();
    get_template_part('partials/content', 'page');
}

$allow_comments = oxy_get_option( 'site_comments' );
?>






<?php if( $allow_comments == 'pages' || $allow_comments == 'all' ) : ?>
<section class="section <?php echo oxy_get_option('footer_swatch'); ?>">
    <div class="container">
        <div class="row">
            <?php comments_template( '', true ); ?>
        </div>
    </div>
</section>
<?php
endif;
get_footer();