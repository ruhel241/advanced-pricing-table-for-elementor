<?php
/**
 * Plugin Name: Advanced Pricing Table For Elementor 
 * Description: Advanced Pricing Table for Elementor, this is elementor addon, and it's easy to use for elementor users.
 * Version:     1.0.1
 * Author:      wpcreativeidea
 * Author URI:  https://wpcreativeidea.com/
 * Plugin URI:  https://github.com/ruhel241/advanced-pricing-table-for-elementor
 * License: GPLv2 or later
 * Text Domain: advanced-pricing-table-for-elementor
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Main Advanced Pricing Table for Elementor Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.1
 */

define('APT_DIR_FILE', __FILE__);
define('APT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('APT_LITE', 'AdvancedPriceTableLite');
define('APT_PLUGIN_VERSION', '1.0.1');

final class AdvancedPricingTableLite 
{

	/**
	 * Plugin Version
	 *
	 * @since 1.0.1
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.1';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.1
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.7.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.1
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.1
	 *
	 * @access private
	 * @static
	 *
	 * @var AdvancedPricingTableLite 
	 * The single instance of the class.
	 */
	private static $_instance = null;

    /**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.1
	 *
	 * @access public
	 * @static
	 *
	 * @return AdvancedPricingTableLite 
	 * An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.1
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
	
		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

		add_action( 'admin_notices', [$this, 'apt_admin_Notice'] );
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



	public function apt_admin_Notice() {
	    //get the current screen
	 	$screen = get_current_screen();
 	    //Checks if settings updated 
        if ( $screen->id == 'dashboard' ||  $screen->id == 'plugins' ) {
            ?>
                <div class="notice notice-success is-dismissible">
                    <p>
                        <?php echo esc_html__('Congratulations! you have installed "Advanced Pricing Table" for elementor plugin, Please rating this plugin.', 'advanced-pricing-table-for-elementor'); ?>
                        <em><a href="https://wordpress.org/support/plugin/advanced-pricing-table-for-elementor/reviews/#new-post" target="_blank">Rating</a></em>
                    </p>
                </div>
            <?php
	 	}
	}
	
	/**
	 * Compatibility Checks
	 *
	 * Checks if the installed version of Elementor meets the plugin's minimum requirement.
	 * Checks if the installed PHP version meets the plugin's minimum requirement.
	 *
	 * @since 1.0.1
	 *
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.1
	 *
	 * @access public
	 */
	public function init() {
	
		$this->loadTextDomain();

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		
		add_action('elementor/frontend/after_enqueue_styles', function() {
			wp_enqueue_style( 'apt-pricing-table', plugin_dir_url( __FILE__ ).'assets/css/apt-pricing-table.css', array(), APT_PLUGIN_VERSION);
		});
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.1
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
	    require_once( __DIR__ . '/widgets/pricing-widget.php' );
        // Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new APT\Classes\Widgets\Advanced_Pricing_Widget() );
	}

	public function loadTextDomain()
    {
		load_plugin_textdomain('advanced-pricing-table-for-elementor', false, APT_PLUGIN_URL. '/languages');
	}
	
	
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.1
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'advanced-pricing-table-for-elementor' ),
			'<strong>' . esc_html__( 'Advanced Pricing Table for Elementor ', 'advanced-pricing-table-for-elementor' ) . '</strong>',
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message) );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.1
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'advanced-pricing-table-for-elementor' ),
			'<strong>' . esc_html__( 'Advanced Pricing Table for Elementor ', 'advanced-pricing-table-for-elementor' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message) );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.1
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'advanced-pricing-table-for-elementor' ),
			'<strong>' . esc_html__( 'Advanced Pricing Table for Elementor ', 'advanced-pricing-table-for-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'advanced-pricing-table-for-elementor' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message) );
	}
}
AdvancedPricingTableLite::instance();