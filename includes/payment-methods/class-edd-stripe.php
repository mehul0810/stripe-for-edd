<?php
/**
 * Stripe for EDD | Stripe On Site Payment Method
 *
 * @since 1.0.0
 */

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'StripeForEDD_OnSite' ) ) {

	class StripeForEDD_OnSite {

		/**
		 * ID.
		 *
		 * @var string
		 */
		public $id = 'stripe';

		/**
		 * StripeForEDD_OnSite constructor.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function __construct() {
			add_action( "edd_{$this->id}_cc_form", array( $this, 'add_cc_form' ) );
		}

		/**
		 * Add Credit Card fields form.
		 *
		 * @since  1.0.0
		 * @access public
		 *
		 * @return void|mixed
		 */
		public function add_cc_form() {
			ob_start();

			do_action( 'edd_before_cc_fields' );
			?>
			<fieldset id="edd_cc_fields" class="edd-do-validate">
				<legend><?php _e( 'Credit Card Info', 'easy-digital-downloads' ); ?></legend>
				<?php if( is_ssl() ) : ?>
					<div id="edd_secure_site_wrapper">
				<span class="padlock">
					<svg class="edd-icon edd-icon-lock" xmlns="http://www.w3.org/2000/svg" width="18" height="28" viewBox="0 0 18 28" aria-hidden="true">
						<path d="M5 12h8V9c0-2.203-1.797-4-4-4S5 6.797 5 9v3zm13 1.5v9c0 .828-.672 1.5-1.5 1.5h-15C.672 24 0 23.328 0 22.5v-9c0-.828.672-1.5 1.5-1.5H2V9c0-3.844 3.156-7 7-7s7 3.156 7 7v3h.5c.828 0 1.5.672 1.5 1.5z"/>
					</svg>
				</span>
						<span><?php _e( 'This is a secure SSL encrypted payment.', 'easy-digital-downloads' ); ?></span>
					</div>
				<?php endif; ?>
				<p id="edd-card-number-wrap">
					<label for="card_number" class="edd-label">
						<?php _e( 'Card Number', 'easy-digital-downloads' ); ?>
						<span class="edd-required-indicator">*</span>
						<span class="card-type"></span>
					</label>
					<span class="edd-description"><?php _e( 'The (typically) 16 digits on the front of your credit card.', 'easy-digital-downloads' ); ?></span>
					<input type="tel" pattern="^[0-9!@#$%^&* ]*$" autocomplete="off" name="card_number" id="card_number" class="card-number edd-input required" placeholder="<?php _e( 'Card number', 'easy-digital-downloads' ); ?>" />
				</p>
				<p id="edd-card-cvc-wrap">
					<label for="card_cvc" class="edd-label">
						<?php _e( 'CVC', 'easy-digital-downloads' ); ?>
						<span class="edd-required-indicator">*</span>
					</label>
					<span class="edd-description"><?php _e( 'The 3 digit (back) or 4 digit (front) value on your card.', 'easy-digital-downloads' ); ?></span>
					<input type="tel" pattern="[0-9]{3,4}" size="4" maxlength="4" autocomplete="off" name="card_cvc" id="card_cvc" class="card-cvc edd-input required" placeholder="<?php _e( 'Security code', 'easy-digital-downloads' ); ?>" />
				</p>
				<p id="edd-card-name-wrap">
					<label for="card_name" class="edd-label">
						<?php _e( 'Name on the Card', 'easy-digital-downloads' ); ?>
						<span class="edd-required-indicator">*</span>
					</label>
					<span class="edd-description"><?php _e( 'The name printed on the front of your credit card.', 'easy-digital-downloads' ); ?></span>
					<input type="text" autocomplete="off" name="card_name" id="card_name" class="card-name edd-input required" placeholder="<?php _e( 'Card name', 'easy-digital-downloads' ); ?>" />
				</p>
				<?php do_action( 'edd_before_cc_expiration' ); ?>
				<p class="card-expiration">
					<label for="card_exp_month" class="edd-label">
						<?php _e( 'Expiration (MM/YY)', 'easy-digital-downloads' ); ?>
						<span class="edd-required-indicator">*</span>
					</label>
					<span class="edd-description"><?php _e( 'The date your credit card expires, typically on the front of the card.', 'easy-digital-downloads' ); ?></span>
					<select id="card_exp_month" name="card_exp_month" class="card-expiry-month edd-select edd-select-small required">
						<?php for( $i = 1; $i <= 12; $i++ ) { echo '<option value="' . $i . '">' . sprintf ('%02d', $i ) . '</option>'; } ?>
					</select>
					<span class="exp-divider"> / </span>
					<select id="card_exp_year" name="card_exp_year" class="card-expiry-year edd-select edd-select-small required">
						<?php for( $i = date('Y'); $i <= date('Y') + 30; $i++ ) { echo '<option value="' . $i . '">' . substr( $i, 2 ) . '</option>'; } ?>
					</select>
				</p>
				<?php do_action( 'edd_after_cc_expiration' ); ?>

			</fieldset>
			<?php
			do_action( 'edd_after_cc_fields' );

			echo ob_get_clean();
		}
	}

	new StripeForEDD_OnSite();
}