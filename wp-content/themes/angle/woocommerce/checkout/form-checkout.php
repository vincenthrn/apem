<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$shop_decoration = oxy_get_option('woocom_general_decoration');

?>
<section class="section section-commerce section-short <?php echo apply_filters( 'oxy_woocommerce_shop_classes', 10 ); ?> has-top">
	<?php echo oxy_section_decoration( 'top', $shop_decoration ); ?>
	<div class="container">

		<?php wc_print_notices(); ?>

		<?php
		do_action( 'woocommerce_before_checkout_form', $checkout );

		// If checkout registration is disabled and not logged in, the user cannot checkout
		if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
			echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
			return;
		}

		// filter hook for include new pages inside the payment method
		$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

		<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div class="row col2-set" id="customer_details">

					<div class="col-md-6 col-1">

						<?php do_action( 'woocommerce_checkout_billing' ); ?>

					</div>

					<div class="col-md-6 col-2">

						<?php do_action( 'woocommerce_checkout_shipping' ); ?>

					</div>

				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<h3 id="order_review_heading" class="margin-top"><?php _e( 'Your order', 'woocommerce' ); ?></h3>

			<?php endif; ?>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

		</form>

		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
	</div>
</section>