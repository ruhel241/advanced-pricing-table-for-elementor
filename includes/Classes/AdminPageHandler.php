<?php

namespace APTFE\Classes;

use Elementor\Settings;

class AdminPageHandler {

	public function initialLoad() {
		add_action(
			'elementor/admin/after_create_settings/' . Settings::PAGE_ID,
			[ $this, 'register_settings_fields' ],
			11
		);
	
		add_action( 'admin_enqueue_scripts', array($this, 'enqueueScripts') );
	}

	public static function enqueueScripts()
    {
		wp_enqueue_style(
			'aptfe-admin-css',
			APTFE_PLUGIN_URL . 'assets/css/aptfe-admin.css',
			[],
			APTFE_PLUGIN_VERSION
		);
		
		wp_enqueue_script( 'aptfe-admin-js', APTFE_PLUGIN_URL.'assets/js/aptfe-admin.js', array('jquery'), APTFE_PLUGIN_VERSION, true);
		$assetsUrl = APTFE_PLUGIN_URL.'assets/';
		
		wp_localize_script('aptfe-admin-js', 'aptfeProVar', [
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'has_pro' => defined('APTFE_PRO'),
			'nonce'   => wp_create_nonce('aptfe_nonce'),
			'images_url' => $assetsUrl.'admin/images/'
		]);
    }

	public function register_settings_fields( $settings ) {
		$settings->add_tab(
			'aptfe-settings',
			[
				'label' => esc_html__( 'Pricing Table Settings', 'advanced-pricing-table-for-elementor' ),
				'sections' => [
					'aptfe-plugins-section' => [
						// 'label' => esc_html__( 'Recommended Addons', 'advanced-pricing-table-for-elementor' ),
						'callback' => function() {
							$this->renderPage();
						},
						'fields' => [],
					]
				],
			]
		);
	}

	public function renderPage() {
		?>
		<div class="wrap aptfe-admin-wrap">
			<h1>
				<?php esc_html_e( 'Advanced Pricing Table Settings', 'advanced-pricing-table-for-elementor' ); ?>
			</h1>
			<?php if (defined('APTFE_PRO')):  ?>
				<div class="aptfe-tabs">
					<div class="aptfe-tab-nav">
						<button class="aptfe-tab-btn active" data-tab="addons">
							<?php esc_html_e( 'Recommended Addons', 'advanced-pricing-table-for-elementor' ); ?>
						</button>
						<button class="aptfe-tab-btn" data-tab="license">
							<?php esc_html_e( 'License Settings', 'advanced-pricing-table-for-elementor' ); ?>
						</button>
					</div>
					<div class="aptfe-tab-content">
						<div class="aptfe-tab-pane active" id="addons">
							<?php $this->recommendedAddonsRender(); ?>
						</div>
						<div class="aptfe-tab-pane" id="license">
							<?php $this->licenseRender(); ?>
						</div>
					</div>
				</div>
			<?php else : ?>
				<?php $this->recommendedAddonsRender(); ?>
			<?php endif; ?>
		</div>
		<?php
	}

	public function recommendedAddonsRender() {
		?>
			<div class="aptfe-addons-wrapper">
				<div class="aptfe-addons-heading">
					<h1 style="display: initial"> Elementor Recommended Addons </h1>
					<p>	These are the Elementor addons that will help your business. </p>  
				</div>
				<div class="aptfe-addons-wrap"></div>

				<div id="aptfe-loading-addon" style="display: none">
					<img src="<?php echo esc_url( APTFE_PLUGIN_URL.'assets/images/loading.gif' ); ?>" alt="">
					<h2> Loading..... </h2>
				</div>
			</div>
		<?php
	}

	public function licenseRender() {
		?>
			<div class="notice notice-success" id="aptfe-notice-success" style="display: none">
				<p>The Advanced Pricing Table Pro Addon license activated.</p>
			</div>

			<div class="notice notice-error" id="aptfe-notice-error" style="display: none">
				<p>Something is wrong!</p>
			</div>

			<div class="aptfe_license_box">
				<div id="aptfe_activated_license" style="display: none">
					<h3 class="title">Please Provide a license key of Advanced Pricing Table Pro Addon</h3> 
					<div class="aptfe-input aptfe-input-group aptfe-input-group--append">
						<input type="text" id="aptfe_license_settings_field" placeholder="License Key" class="aptfe_input__inner">
						<div class="aptfe-input-group__append">
							<a href="#" id="aptfe_verify_btn" class="aptfe-button aptfe-button--success">
								&#128274; Verify License
							</a>
						</div>
					</div> 
					<hr style="margin: 20px 0px 30px;"> 
					<p>Don't have a license key? <a href="https://wpcreativeidea.com/" target="_blank" style="cursor:pointer">Purchase one here</a></p>
				</div>
				<div id="aptfe_deactivated_license" style="display: none">
					<div class="text-align-center">
						<span style="font-size: 50px;" class="el-icon el-icon-circle-check">
							<img src="<?php echo esc_url( APTFE_PLUGIN_URL.'assets/images/check.png' );?>" alt="">
						</span>
					</div>
					<h2>You license key is valid and activated</h2>
					<hr style="margin: 20px 0px;" />
					<p>Want to deactivate this license? <a id="aptfe_deactive_license" href="#">Click here</a></p>
				</div>
				<div id="aptfe-loading-license" style="display: none">
					<img src="<?php echo esc_url( APTFE_PLUGIN_URL.'assets/images/loading.gif' ); ?>" alt="">
					<h2> Loading..... </h2>
				</div>
			</div>
		<?php
	}
}