<?php
/**
 * Plugin Name: Advanced Pricing Table For Elementor 
 * Description: Advanced Pricing Table for Elementor, this is elementor addon, and it's easy to use for elementor users.
 * Version:     1.0.4
 * Author:      WPCreativeIdea
 * Author URI:  https://profiles.wordpress.org/wpcreativeidea/
 * Plugin URI:  https://github.com/ruhel241/advanced-pricing-table-for-elementor
 * License: GPLv2 or later
 * Text Domain: advanced-pricing-table-for-elementor
 * Domain Path: /language
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Advanced Pricing Table for Elementor Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since  1.0.4
 */

define('APTFE_DIR_FILE', __FILE__);
define('APTFE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('APTFE_LITE', 'AdvancedPriceTableLite');
define('APTFE_PLUGIN_VERSION', '1.0.4');

final class APTFE_Pricing_Table_Lite 
{
	/**
	 * Instance
	 *
	 * @since  1.0.4
	 *
	 * @access private
	 * @static
	 *
	 * @var APTFE_Pricing_Table_Lite 
	 * The single instance of the class.
	 */
	private static $instance = null;

    /**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since  1.0.4
	 *
	 * @access public
	 * @static
	 *
	 * @return APTFE_Pricing_Table_Lite 
	 * An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;

	}

	/**
	 * Constructor
	 *
	 * @since  1.0.4
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
	}

	
	public function on_plugins_loaded() {
		
		if (! did_action( 'elementor/loaded' ) ) {
			return $this->injectDependency();
		}
	
		add_action( 'elementor/init', [ $this, 'init' ] );
	}


	 /**
     * Notify the user about the Advanced Pricing Table dependency and instructs to install it.
     */
    protected function injectDependency()
    {
        add_action('admin_notices', function () {
            $pluginInfo = $this->getInstallationDetails();

            $class = 'notice notice-error';

            $install_url_text = 'Click Here to Install the Plugin';

            if ($pluginInfo->action == 'activate') {
                $install_url_text = 'Click Here to Activate the Plugin';
            }

			$message = 'Advanced Pricing Table For Elementor Add-On Requires Elementor Base Plugin, <b><a href="' . $pluginInfo->url
                . '">' . $install_url_text . '</a></b>';

            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), wp_kses_post($message));
        });
    }

    /**
     * Get the Advanced Pricing Table plugin installation information e.g. the URL to install.
     *
     * @return \stdClass $activation
     */
    protected function getInstallationDetails()
    {
        $activation = (object)[
            'action' => 'install',
            'url'    => ''
        ];

        $allPlugins = get_plugins();

        if (isset($allPlugins['elementor/elementor.php'])) {
            $url = wp_nonce_url(
                self_admin_url('plugins.php?action=activate&plugin=elementor/elementor.php'),
                'activate-plugin_elementor/elementor.php'
            );
            
            $activation->action = 'activate';
        } else {
            $api = (object)[
                'slug' => 'elementor'
            ];

            $url = wp_nonce_url(
                self_admin_url('update.php?action=install-plugin&plugin=' . $api->slug),
                'install-plugin_' . $api->slug
            );
        }

        $activation->url = $url;

        return $activation;
    }

	
	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since  1.0.4
	 *
	 * @access public
	 */
	public function init() {
	
		$this->loadTextDomain();

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		
		add_action('elementor/frontend/after_enqueue_styles', function() {
			wp_enqueue_style( 'aptfe-pricing-table', plugin_dir_url( __FILE__ ).'assets/css/aptfe-pricing-table.css', array(), APTFE_PLUGIN_VERSION);
		});
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since  1.0.4
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
	    require_once( __DIR__ . '/widgets/pricing-widget.php' );
        // Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new APTFE\Classes\Widgets\Advanced_Pricing_Widget() );
	}

	public function loadTextDomain()
    {
		load_plugin_textdomain('advanced-pricing-table-for-elementor', false, APTFE_PLUGIN_URL. '/languages');
	}
	
}
APTFE_Pricing_Table_Lite::instance();

function aptfeDeactivatePlugin() {
	$user_id = get_current_user_id();
	update_user_meta($user_id, 'aptfe-notice-dismissed', 'active');
}
register_deactivation_hook( __FILE__, 'aptfeDeactivatePlugin' );