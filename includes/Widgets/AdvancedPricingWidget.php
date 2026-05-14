<?php

namespace APTFE\Widgets;
 
use Elementor\Utils;
use Elementor\Repeater;
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use \Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
// use \Elementor\Group_Control_Text_Shadow;
use APTFEPRO\Services\APTFEWidgetPro; 

/**
 * Elementor pricing Widget.
 *
 * @since  1.0.5
 */
class AdvancedPricingWidget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve pricing widget name.
	 *
	 * @since  1.0.5
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'advanced-pricing-table-for-elementor';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve pricing widget title.
	 *
	 * @since  1.0.5
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Advanced Pricing Table', 'advanced-pricing-table-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve pricing widget icon.
	 *
	 * @since  1.0.5
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-price-table';
	}

	
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the pricing widget belongs to.
	 *
	 * @since  1.0.5
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the pricing widget belongs to.
	 *
	 * @since  1.0.5
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'price', 'pricing', 'table', 'price table', 'pricing table' ];
	}

	/**
	 * Register pricing widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since  1.0.5
	 * @access protected
	 */
	protected function register_controls() 
	{
		(new AdvancedPricingWidgetSettings())->allSettings($this);
		(new AdvancedPricingWidgetStyles())->allStyles($this);
	}

	/**
	 * Render pricing widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.5
	 * @access protected
	 */
	
	protected function render() {
		$settings = $this->get_settings_for_display();
	
		$headerShow 	     = 'yes';
		$pricingShow 	     = 'yes';
		$centerIconShow      = 'no';
		$ribbonShow          = 'no';
		$additionalTextShow  = '';
		$buttonShow          = 'yes';
		$featuresShow 	     = 'yes';
		$iconPosition 		 = 'left';
		$currencyPosition 	 = 'before';
		$template            = defined('APTFE_PRO') ? $settings["aptfe_pricing_template"] : '1';
	
		$this->add_render_attribute(
			'aptfe_pricing_options',
			[
				'id'    => 'aptfe-pricing-table-' . intval( $this->get_id() ),
				'class' => [
					'aptfe-pricing-table-container',
					'aptfe-pricing-table-template-' . $template,
				],
			]
		);

		// Currency format
		$currency_format = ! empty( $settings['aptfe_pricing_currency_format'] ) ? $settings['aptfe_pricing_currency_format'] : '.';
	
		$price = explode( $currency_format, (string) ( $settings['aptfe_pricing_price'] ?? '' ));
	
		$intpart  = $price[0] ?? '';
		$fraction = $price[1] ?? '';
	
		// Currency symbol
		$currency_symbol = $settings['aptfe_pricing_currency_symbol'] ?? '';
	
		if ( 'custom' === $currency_symbol ) {
			$currency_symbol = $settings['aptfe_pricing_currency_symbol_custom'] ?? '';
		}

		// Button
		$buttonClasses = [ 'aptfe-button' ];
		if ( defined( 'APTFE_PRO' ) && ! empty( $settings['aptfe_button_size'] ) ) {
			$buttonClasses[] = 'aptfe-button-size-' . $settings['aptfe_button_size'];
		}

		$this->add_render_attribute(
			'aptfe_render_button_attr',
			'class',
			$buttonClasses
		);
	
		if ( ! empty( $settings['aptfe_button_link']['url'] ) ) {
			$this->add_link_attributes(
				'aptfe_render_button_attr',
				$settings['aptfe_button_link']
			);
		}
	
		// Title tag
		$this->add_render_attribute(
			'aptfe_header_title_tag_attr',
			'class',
			'title'
		);
	
		$titleTag = Utils::validate_html_tag(
			$settings['aptfe_header_title_tag'] ?? 'h3'
		);
	

		if (defined('APTFE_PRO')) {
			$headerShow 	     = $settings['aptfe_header_show'] ?? 'yes';
			$pricingShow 	     = $settings['aptfe_pricing_show'] ?? 'yes';
			$centerIconShow      = $settings['aptfe_center_icon_show'] ?? 'no';
			$ribbonShow          = $settings['aptfe_ribbon_show'] ?? 'no';
			$additionalTextShow  = $settings['aptfe_additional_text_show']?? '';
			$buttonShow          = $settings['aptfe_button_show'] ?? 'yes';
			$featuresShow 	     = $settings['aptfe_features_show']?? 'yes';
			$iconPosition 		 = $settings['aptfe_features_icon_position'] ?? 'left';
			$currencyPosition	 = $settings['aptfe_currency_position'] ?? 'before';
		}
		?>
	
		<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'aptfe_pricing_options' ) ); ?>>
			<?php if ( $headerShow === 'yes' ) : ?>
				<div class="aptfe-pricing-header">
					<?php if ( ! empty( $settings['aptfe_header_title'] ) ) : ?>
						<<?php Utils::print_validated_html_tag( $titleTag ); ?>
							<?php $this->print_render_attribute_string( 'aptfe_header_title_tag_attr' ); ?>>
		
							<?php $this->print_unescaped_setting( 'aptfe_header_title' ); ?>
		
						</<?php Utils::print_validated_html_tag( $titleTag ); ?>>
					<?php endif; ?>
		
					<?php if ( ! empty( $settings['aptfe_header_description'] ) ) : ?>
						<p class="decription">
							<?php echo esc_html( $settings['aptfe_header_description'] ); ?>
						</p>
					<?php endif; ?>
				</div>
			<?php endif; ?>
	
			<?php if ($pricingShow === 'yes') : ?>
				<div class="aptfe-pricing-container">
					<?php if ( ! empty( $settings['aptfe_pricing_additional_text'] ) ) : ?>
						<div class="pricing-additional-text">
							<?php echo esc_html( $settings['aptfe_pricing_additional_text'] ); ?>
						</div>
					<?php endif; ?>

					<div class="aptfe-pricing-price">
						<?php if (
							'yes' === ( $settings['aptfe_pricing_sale'] ?? '' ) &&
							! empty( $settings['aptfe_pricing_original_price'] )
						) : ?>
			
							<span class="original-price">
								<?php
								echo esc_html(
									$currency_symbol . $settings['aptfe_pricing_original_price']
								);
								?>
							</span>
			
						<?php endif; ?>
			
						<?php if ( 'before' === $currencyPosition ) : ?>
							<span class="currency currency-position-before">
								<?php echo esc_html( $currency_symbol ); ?>
							</span>
						<?php endif; ?>
			
						<?php if ( ! empty( $intpart ) ) : ?>
							<span class="price">
								<?php echo esc_html( $intpart ); ?>
							</span>
						<?php endif; ?>
			
						<?php if ( ! empty( $fraction ) ) : ?>
							<span class="fraction-part">
								<?php echo esc_html( $fraction ); ?>
							</span>
						<?php endif; ?>
			
						<?php if ( 'after' === $currencyPosition ) : ?>
							<span class="currency currency-position-after">
								<?php echo esc_html( $currency_symbol ); ?>
							</span>
						<?php endif; ?>
			
						<?php
							if ( ! empty( $settings['aptfe_pricing_period'] ) ) :
								$period_class = ( $settings['aptfe_period_position'] ?? '' ) === 'below'
									? 'period_position_below'
									: '';
						?>
							<span class="period <?php echo esc_attr( $period_class ); ?>">
								<?php echo esc_html( $settings['aptfe_pricing_period'] ); ?>
							</span>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
	
			<?php if ( 'yes' === $centerIconShow  && !empty( $settings['aptfe_features_top_icon']['value']) ) : ?>
				<div class="aptfe-center-icon">
					<?php
						Icons_Manager::render_icon(
							$settings['aptfe_features_top_icon'],
							[
								'class'       => 'aptfe-features-top-icon',
								'aria-hidden' => 'true',
							]
						);
					?>
				</div>
			<?php endif; ?>
					
			<?php if ( $featuresShow  === 'yes' ) : ?>
				<div class="aptfe-features">
					<?php if ( ! empty( $settings['aptfe_features_heading_text'] ) ) : ?>
						<div class="features-heading-container">
							<h3 class="features-heading">
								<?php echo esc_html( $settings['aptfe_features_heading_text'] ); ?>
							</h3>
						</div>
					<?php endif; ?>
					<ul class="items">
						<?php foreach ( $settings['aptfe_features_list'] as $item ) : ?>
							<li class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
								<?php
									if (defined('APTFE_PRO')) {
										// Custom Icon
										if ( ! empty( $item['aptfe_features_selected_item_icon']['value'] ) ) {
											Icons_Manager::render_icon(
												$item['aptfe_features_selected_item_icon'],
												[
													'class'       => 'aptfe-features-icon-' . esc_attr( $iconPosition ),
													'aria-hidden' => 'true',
												]
											);
										}
									} else {
										// Default icon for free users
										Icons_Manager::render_icon(
											[
												'value'   => 'fas fa-check',
												'library' => 'fa-solid',
											],
											[
												'class'       => 'aptfe-features-icon-' . esc_attr( $iconPosition ),
												'aria-hidden' => 'true',
											]
										);
									}
								?>
								<?php if ( ! empty( $item['aptfe_features_item_text'] ) ) : ?>
									<span class="item-text">
										<?php echo esc_html( $item['aptfe_features_item_text'] ); ?>
									</span>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
	
			<?php if ( $buttonShow === 'yes' ) : ?>
				<div class="aptfe-button-box">
					<a <?php $this->print_render_attribute_string( 'aptfe_render_button_attr' ); ?>>
						<?php
							$this->print_unescaped_setting( 'aptfe_button_text' );
						?>
					</a>
				</div>
			<?php endif; ?>
	
			<?php if ( 'yes' === $additionalTextShow && ! empty( $settings['aptfe_additional_textarea'] ) ) : ?>
				<div class="aptfe-additional-text">
					<?php echo wp_kses_post( $settings['aptfe_additional_textarea'] ); ?>
				</div>
			<?php endif; ?>
	
			<?php if ( 'yes' === $ribbonShow  && ! empty( $settings['aptfe_ribbon_title'] ) ) : ?>
				<div class="ribbon <?php echo esc_attr( $settings['aptfe_ribbon_position'] ?? 'ribbon-right-angle' ); ?>">
					<?php echo esc_html( $settings['aptfe_ribbon_title'] ?? '' ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Render element output in the editor.
	 *
	 * Used to generate the live preview, using a Backbone JavaScript template.
	 *
	 * @since 2.9.0
	 * @access protected
	 */

	public function getProNotice($image) {
		$proNotice = [
			'title'   => esc_html__( 'These are pro features', 'advanced-pricing-table-for-elementor' ),
			'message' => esc_html__( 'These are pro features, if you want to enable these features you need to upgrade to the pro version.', 'advanced-pricing-table-for-elementor' ),
			'link'    => esc_url( 'https://wpcreativeidea.com/pricing-table' ),
		];
			ob_start();
		?>
			<div class="aptfe-nerd-box">
				<div class="image-box">
					<img class="aptfe-nerd-box-icon" src="<?php echo esc_url( APTFE_PLUGIN_URL . 'assets/images/' .$image ); ?>" />
				</div>
				<div class="aptfe-nerd-box-title">
					<?php Utils::print_unescaped_internal_string( $proNotice['title'] ); ?>
				</div>
				<div class="aptfe-nerd-box-message">
					<?php Utils::print_unescaped_internal_string( $proNotice['message'] ); ?> <br/><br/>
				</div><br/>
				<a href="<?php echo esc_url( ( $proNotice['link'] ) ); ?>" class="aptfe-nerd-box-link aptfe-button aptfe-button-default aptfe-button-go-pro" target="_blank">
					<?php echo esc_html__( 'Upgrade Now', 'advanced-slider-for-elementor' ); ?>
				</a>
			</div>
		<?php
			return ob_get_clean();
	}
	
	protected function content_template() {
	}
}