<?php
/**
 * Stripe for EDD | Admin Filters
 *
 * @since 1.0.0
 */

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This function will register gateways to EDD.
 *
 * @param array $gateways List of payment gateways.
 *
 * @since 1.0.0
 *
 * @return array
 */
function stripeforedd_register_gateway( $gateways ) {

	// Stripe Checkout.
	$gateways['stripe_checkout'] = array(
		'admin_label'    => __( 'Stripe Checkout', 'stripe-for-edd' ),
		'checkout_label' => __( 'Checkout', 'stripe-for-edd' ),
		'supports'       => array(
			'buy_now'
		)
	);

	// Stripe - On Page Credit Card fields.
	$gateways['stripe'] = array(
		'admin_label'    => __( 'Stripe', 'stripe-for-edd' ),
		'checkout_label' => __( 'Credit Card', 'stripe-for-edd' ),
		'supports'       => array(
			'buy_now'
		)
	);

	return $gateways;
}

add_filter( 'edd_payment_gateways', 'stripeforedd_register_gateway' );