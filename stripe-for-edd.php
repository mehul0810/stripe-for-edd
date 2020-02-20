<?php
/**
 * Stripe for Easy Digital Downloads
 *
 * @package           StripeforEDD
 * @author            Mehul Gohil
 * @copyright         2020 Mehul Gohil
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Stripe for Easy Digital Downloads
 * Plugin URI:        https://mehulgohil.com/plugins/stripe-for-edd
 * Description:       Integrated Stripe with Easy Digital Downloads.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            Mehul Gohil
 * Author URI:        https://mehulgohil.com
 * Text Domain:       stripe-for-edd
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class StripeForEDD {

	/**
	 * StripeForEDD constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Init Plugin.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function init() {
		$this->constants();
		$this->includes();
		$this->load_textdomain();
	}

	/**
	 * Define Constants.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function constants() {

		if ( ! defined( 'STRIPEFOREDD_VERSION' ) ) {
			define( 'STRIPEFOREDD_VERSION', '1.0.0' );
		}

		if ( ! defined( 'STRIPEFOREDD_PLUGIN_FILE' ) ) {
			define( 'STRIPEFOREDD_PLUGIN_FILE', __FILE__ );
		}

		if ( ! defined( 'STRIPEFOREDD_PLUGIN_DIR' ) ) {
			define( 'STRIPEFOREDD_PLUGIN_DIR', dirname( STRIPEFOREDD_PLUGIN_FILE ) );
		}

		if ( ! defined( 'STRIPEFOREDD_PLUGIN_URL' ) ) {
			define( 'STRIPEFOREDD_PLUGIN_URL', plugin_dir_url( STRIPEFOREDD_PLUGIN_FILE ) );
		}

		if ( ! defined( 'STRIPEFOREDD_PLUGIN_BASENAME' ) ) {
			define( 'STRIPEFOREDD_PLUGIN_BASENAME', plugin_basename( STRIPEFOREDD_PLUGIN_FILE ) );
		}
	}

	/**
	 * Load Files.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function includes() {

		// Load admin files only.
		if ( is_admin() ) {
			require_once STRIPEFOREDD_PLUGIN_DIR . '/admin/filters.php';
			require_once STRIPEFOREDD_PLUGIN_DIR . '/admin/actions.php.php';
		}

		require_once STRIPEFOREDD_PLUGIN_DIR . '/includes/filters.php';
		require_once STRIPEFOREDD_PLUGIN_DIR . '/includes/actions.php';
		require_once STRIPEFOREDD_PLUGIN_DIR . '/includes/helpers.php';
	}

	/**
	 * Load Textdomain.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'stripe-for-edd', false, dirname( STRIPEFOREDD_PLUGIN_BASENAME ) . '/languages' );
	}

}

// Initialize Plugin.
new StripeForEDD();