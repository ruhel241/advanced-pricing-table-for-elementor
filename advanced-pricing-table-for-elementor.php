<?php
/**
 * Plugin Name: Advanced Pricing Table For Elementor
 * Description: Advanced Pricing Table for Elementor, this is elementor addon, and it's easy to use for elementor users.
 * Version:     1.0.0
 * Author:      WPCreativeIdea
 * Author URI:  https://profiles.wordpress.org/wpcreativeidea/
 * Plugin URI:  https://wpcreativeidea.com/advanced-pricing-table-for-elementor
 * License: GPLv2 or later
 * Text Domain: advanced-pricing-table-for-elementor
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Constants
 */
define( 'APTFE_DIR_FILE', __FILE__ );
define( 'APTFE_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'APTFE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'APTFE_PLUGIN_VERSION', '1.0.0' );
define( 'APTFE_LITE', true );

/**
 * Autoload
 */
require_once APTFE_DIR_PATH . 'autoload.php';

/**
 * Main Plugin Class
 */
final class APTFE_Pricing_Table_Lite {

	/**
	 * Instance
	 *
	 * @var self|null
	 */
	private static $instance = null;

	/**
	 * Get Instance
	 *
	 * @return self
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
	}

	/**
	 * Plugins Loaded
	 */
	public function on_plugins_loaded() {

		if ( ! did_action( 'elementor/loaded' ) ) {
			$this->inject_dependency_notice();
			return;
		}

		add_action( 'elementor/init', [ $this, 'init' ] );

		if (defined('APTFE_PRO_DIR_FILE')) {
			if (!class_exists(APTFEPRO\Classes\APTFEWidgetPro::class)) {
				require_once(APTFE_PRO_DIR_PATH.'Classes/APTFEWidgetPro.php');
			}
		}
	}

	/**
	 * Init Plugin
	 */
	public function init() {

		/**
		 * Register Widgets
		 */
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );

		/**
		 * Frontend Styles
		 */
		add_action(
			'elementor/frontend/after_enqueue_styles',
			function () {

				wp_enqueue_style(
					'aptfe-pricing-table',
					APTFE_PLUGIN_URL . 'assets/css/aptfe-pricing-table.css',
					[],
					APTFE_PLUGIN_VERSION
				);
			}
		);

		/**
		 * Editor Styles
		 */
		add_action(
			'elementor/editor/after_enqueue_styles',
			function () {
				wp_enqueue_style(
					'aptfe-admin-css',
					APTFE_PLUGIN_URL . 'assets/css/aptfe-admin.css',
					[],
					APTFE_PLUGIN_VERSION
				);
			}
		);
	}

	/**
	 * Register Widgets
	 *
	 * @param object $widgets_manager Elementor widgets manager.
	 */
	public function init_widgets( $widgets_manager ) {

		$widgets_manager->register(
			new APTFE\Widgets\AdvancedPricingWidget()
		);
	}

	/**
	 * Elementor Dependency Notice
	 */
	protected function inject_dependency_notice() {

		add_action(
			'admin_notices',
			function () {

				$plugin_info = $this->get_installation_details();

				$class = 'notice notice-error';

				$button_text = esc_html__( 'Install Elementor', 'advanced-pricing-table-for-elementor' );

				if ( 'activate' === $plugin_info->action ) {
					$button_text = esc_html__( 'Activate Elementor', 'advanced-pricing-table-for-elementor' );
				}

				$message = sprintf(
					'%1$s <strong><a href="%2$s">%3$s</a></strong>',
					esc_html__( 'Advanced Pricing Table For Elementor requires Elementor plugin.', 'advanced-pricing-table-for-elementor' ),
					esc_url( $plugin_info->url ),
					esc_html( $button_text )
				);

				printf(
					'<div class="%1$s"><p>%2$s</p></div>',
					esc_attr( $class ),
					wp_kses_post( $message )
				);
			}
		);
	}

	/**
	 * Get Elementor Installation Details
	 *
	 * @return object
	 */
	protected function get_installation_details() {

		$activation = (object) [
			'action' => 'install',
			'url'    => '',
		];

		$all_plugins = get_plugins();

		if ( isset( $all_plugins['elementor/elementor.php'] ) ) {

			$url = wp_nonce_url(
				self_admin_url( 'plugins.php?action=activate&plugin=elementor/elementor.php' ),
				'activate-plugin_elementor/elementor.php'
			);

			$activation->action = 'activate';

		} else {

			$url = wp_nonce_url(
				self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ),
				'install-plugin_elementor'
			);
		}

		$activation->url = $url;

		return $activation;
	}
}

/**
 * Init Plugin
 */
APTFE_Pricing_Table_Lite::instance();