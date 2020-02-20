<?php
/**
 * Stripe for EDD | Stripe Checkout Payment Method
 *
 * @since 1.0.0
 */

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'StripeForEDD_Checkout' ) ) {

	class StripeForEDD_Checkout {

		public $id = 'stripe_checkout';

		public function __construct() {
			add_action( "edd_{$this->id}_cc_form", '__return_false' );
		}
	}

	new StripeForEDD_Checkout();
}