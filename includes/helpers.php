<?php
/**
 * Stripe for EDD | Helper Functions
 *
 * @since 1.0.0
 */

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This helper function will be used to get the application fee percentage.
 *
 * @since 1.0.0
 *
 * @return int
 */
function stripeforedd_get_application_fee_percentage() {
	return 2;
}

