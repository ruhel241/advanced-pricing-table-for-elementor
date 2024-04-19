<?php

namespace APT\Classes\Widgets;

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


/**
 * Elementor pricing Widget.
 *
 * @since 1.0.0
 */
class Advanced_Pricing_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve pricing widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'advanced-pricing-table';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve pricing widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Advanced Pricing Table', 'advanced-pricing-table' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve pricing widget icon.
	 *
	 * @since 1.0.0
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
	 * @since 1.0.0
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
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'price', 'pricing', 'table', 'product', 'image', 'plan', 'button' ];
	}

	/**
	 * Register pricing widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'apt_content_section',
			[
				'label' => esc_html__( 'Header', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);
			$this->add_control(
				'apt_header_title',
				[
					'label' => esc_html__( 'Title', 'advanced-pricing-table' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default' => esc_html__( 'Standard', 'advanced-pricing-table' ),
					'placeholder' => esc_html__( 'Standard', 'advanced-pricing-table' ),
				]
			);
			$this->add_control(
				'apt_header_description',
				[
					'label' => esc_html__( 'Description', 'advanced-pricing-table' ),
					'type' => Controls_Manager::TEXTAREA,
					'rows' => 10,
					// 'default' => esc_html__( 'Type your description here', 'advanced-pricing-table' ),
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'Type your description here', 'advanced-pricing-table' ),
				]
			);
			$this->add_control(
				'apt_header_title_tag',
				[
					'label' => esc_html__( 'Title HTML Tag', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'h2',
					'options' => [
						'h1'  => esc_html__( 'H1', 'advanced-pricing-table' ),
						'h2'  => esc_html__( 'H2', 'advanced-pricing-table' ),
						'h3'  => esc_html__( 'H3', 'advanced-pricing-table' ),
						'h4'  => esc_html__( 'H4', 'advanced-pricing-table' ),
						'h5'  => esc_html__( 'H5', 'advanced-pricing-table' ),
						'h6'  => esc_html__( 'H6', 'advanced-pricing-table' ),
					],
					// 'selectors' => [
					// 	'{{WRAPPER}} .your-class' => 'border-style: {{VALUE}};',
					// ],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'apt_pricing_section',
			[
				'label' => esc_html__( 'Pricing', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);
			$this->add_control(
				'apt_pricing_currency_symbol',
				[
					'label' => esc_html__( 'Currency Symbol', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => esc_html__( 'None', 'advanced-pricing-table' ),
						'&#36;'   => esc_html__( 'Dollar', 'advanced-pricing-table' ),
						'&#128;'  => esc_html__( 'Euro', 'advanced-pricing-table' ),
						'&#3647;' => esc_html__( 'Baht', 'advanced-pricing-table' ),
						'&#8355;' => esc_html__( 'Franc', 'advanced-pricing-table' ),
						'&fnof;'  => esc_html__( 'Guilder', 'advanced-pricing-table' ),
						'kr' 	  => esc_html__( 'Krona', 'advanced-pricing-table' ),
						'&#8356;' => esc_html__( 'Lira', 'advanced-pricing-table' ),
						'&#8359;' => esc_html__( 'Peseta', 'advanced-pricing-table' ),
						'&#8369;' => esc_html__( 'Peso', 'advanced-pricing-table' ),
						'&#163;'  => esc_html__( 'Pound Sterling', 'advanced-pricing-table' ),
						'R$'	  => esc_html__( 'Real', 'advanced-pricing-table' ),
						'&#8381;' => esc_html__( 'Ruble', 'advanced-pricing-table' ),
						'&#8360;' => esc_html__( 'Rupee', 'advanced-pricing-table' ),
						'&#8377;' => esc_html__( 'Rupee (Indian)', 'advanced-pricing-table' ),
						'&#8362;' => esc_html__( 'Shekel', 'advanced-pricing-table' ),
						'&#165;'  => esc_html__( 'Yen/Yuan', 'advanced-pricing-table' ),
						'&#8361;' => esc_html__( 'Won', 'advanced-pricing-table' ),
						'&#2547;' => esc_html__( 'Taka', 'advanced-pricing-table' ),
						'custom'  => esc_html__( 'Custom', 'advanced-pricing-table' ),
					],
					'default' => '&#36;',
				]
			);
			$this->add_control(
				'apt_pricing_currency_symbol_custom',
				[
					'label' => esc_html__( 'Custom Symbol', 'advanced-pricing-table' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'apt_pricing_currency_symbol' => 'custom',
					],
				]
			);
			$this->add_control(
				'apt_pricing_price',
				[
					'label' => esc_html__( 'Price', 'advanced-pricing-table' ),
					'type' => Controls_Manager::TEXT,
					'default' => '39.99',
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$this->add_control(
				'apt_pricing_currency_format',
				[
					'label' => esc_html__( 'Currency Format', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => '1,234.56 (Default)',
						',' => '1.234,56',
					],
				]
			);
			$this->add_control(
				'apt_pricing_sale',
				[
					'label' => esc_html__( 'Sale', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'advanced-pricing-table' ),
					'label_off' => esc_html__( 'Off', 'advanced-pricing-table' ),
					'default' => '',
				]
			);
			$this->add_control(
				'apt_pricing_original_price',
				[
					'label' => esc_html__( 'Original Price', 'advanced-pricing-table' ),
					'type' => Controls_Manager::NUMBER,
					'default' => '59',
					'condition' => [
						'apt_pricing_sale' => 'yes',
					],
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$this->add_control(
				'apt_pricing_period',
				[
					'label' => esc_html__( 'Period', 'advanced-pricing-table' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Monthly', 'advanced-pricing-table' ),
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'apt_features_section',
			[
				'label' => esc_html__( 'Features', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);
			$repeater = new Repeater();
			$repeater->add_control(
				'apt_features_item_text',
				[
					'label' => esc_html__( 'Text', 'advanced-pricing-table' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'List Item', 'advanced-pricing-table' ),
				]
			);
			$default_icon = [
					'value' => 'far fa-arrow-alt-circle-right',
					'library' => 'fa-regular'
			];
			$repeater->add_control(
				'apt_features_selected_item_icon',
				[
					'label' => esc_html__( 'Icon', 'advanced-pricing-table' ),
					'type' => Controls_Manager::ICONS,
					'fa4compatibility' => 'item_icon',
					'default' => $default_icon,
					'recommended' => [
						'fa-regular' => [
							'arrow-alt-circle-right',
						]
					]
				]
			);
			$repeater->add_control(
				'apt_features_item_icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features .items li i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .apt-pricing-table-container .apt-features .items li svg' => 'fill: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'apt_features_list',
				[
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'apt_features_item_text' => esc_html__( 'List Item #1', 'advanced-pricing-table' ),
							'apt_features_selected_item_icon' => $default_icon,
						],
						[
							'apt_features_item_text' => esc_html__( 'List Item #2', 'advanced-pricing-table' ),
							'apt_features_selected_item_icon' => $default_icon,
						],
						[
							'apt_features_item_text' => esc_html__( 'List Item #3', 'advanced-pricing-table' ),
							'apt_features_selected_item_icon' => $default_icon,
						],
					],
					'title_field' => '{{{ apt_features_item_text }}}',
				]
			);
			
		$this->end_controls_section();

		$this->start_controls_section(
			'apt_center_icon_section',
			[
				'label' => esc_html__( 'Center Icon', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => ['apt_center_icon_show' => 'yes']
			]
		);
			$this->add_control(
				'apt_features_top_icon',
				[
					'label' => esc_html__( 'Icon', 'textdomain' ),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-gem',
						'library' => 'fa-regular',
					],
					'recommended' => [
						'fa-regular' => [
							'gem',
						]
					]
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'apt_button_section',
			[
				'label' => esc_html__( 'Button', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => ['apt_button_show' => 'yes']
			]
		);
			$this->add_control(
				'apt_button_text',
				[
					'label' => esc_html__( 'Button Text', 'advanced-pricing-table' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Click Here', 'advanced-pricing-table' ),
					'dynamic' => [
						'active' => true,
					]
				]
			);
			$this->add_control(
				'apt_button_link',
				[
					'label' => esc_html__( 'Link', 'advanced-pricing-table' ),
					'type' => Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'advanced-pricing-table' ),
					'default' => [
						'url' => '#',
					],
					'dynamic' => [
						'active' => true,
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'apt_additional_text_section',
			[
				'label' => esc_html__( 'Additional Text', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => ['apt_additional_text_show' => 'yes']
			]
		);
			$this->add_control(
				'apt_additional_textarea',
				[
					'label' => esc_html__( 'Additional text', 'advanced-pricing-table' ),
					'type' => Controls_Manager::TEXTAREA,
					// 'type' => Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'This is text element', 'advanced-pricing-table' ),
					'rows' => 7,
					'dynamic' => [
						'active' => true,
					],
				]
			);

			// $this->add_control(
			// 	'apt_additional_textarea', [
			// 		'label' => __( 'Content', 'advanced-testimonial-carousel-for-elementor-pro' ),
			// 		'type' => Controls_Manager::WYSIWYG,
			// 		'default' => __( 'Lorem ipsum dolor sit amet, tpat dictum purus, at malesuada tellus convallis et. Aliquam erat volutpat. Vestibulum felis ex, ultrices posuere facilisis eget, malesuada quis elit. Nulla ac eleifend odio' , 'advanced-testimonial-carousel-for-elementor-pro' ),
			// 		'label_block' => true,
			// 		'dynamic' => [
			// 			'active' => true,
			// 		]
			// 	]
			// );


		$this->end_controls_section();

		$this->start_controls_section(
			'apt_ribbon_section',
			[
				'label' => esc_html__( 'Ribbon', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'apt_ribbon_show' => 'yes',
				],
			]
		);	
			$this->add_control(
				'apt_ribbon_title',
				[
					'label' => esc_html__( 'Title', 'advanced-pricing-table' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Popular', 'advanced-pricing-table' ),
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$this->add_control(
				'apt_ribbon_horizontal_position',
				[
					'label' => esc_html__( 'Position', 'advanced-pricing-table' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'advanced-pricing-table' ),
							'icon' => 'eicon-h-align-left',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'advanced-pricing-table' ),
							'icon' => 'eicon-h-align-right',
						],
					],
					'default' => 'left'
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'apt_section_pricing_table_style',
			[
				'label' => esc_html__( 'Pricing Table', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_STYLE,
				// 'show_label' => false
			]
		);

		$this->add_control(
			'apt_pricing_table_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advanced-pricing-table' ),
				'type' => Controls_Manager::COLOR,
				// 'global' => [
				// 	'default' => Global_Colors::COLOR_SECONDARY,
				// ],
				'selectors' => [
					'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'apt_pricing_table_border',
				// 'selector' => '{{WRAPPER}} .wrapper',
			]
		);

		$this->add_control(
			'apt_pricing_table_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'textdomain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					// '{{WRAPPER}} .your-class' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// $this->add_control(
		// 	'apt_pricing_table_box_shadow',
		// 	[
		// 		'label' => esc_html__( 'Box Shadow', 'textdomain' ),
		// 		'type' => \Elementor\Controls_Manager::BOX_SHADOW,
		// 		'selectors' => [
		// 			// '{{SELECTOR}}' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
		// 		],
		// 	]
		// );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'apt_pricing_table_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'advanced-pricing-table' ),
				// 'selector' => '{{WRAPPER}} .coupon .input-text, {{WRAPPER}} .e-cart-totals .input-text, {{WRAPPER}} select, {{WRAPPER}} .select2-selection--single',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'apt_section_header_style',
			[
				'label' => esc_html__( 'Header', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_STYLE,
				// 'show_label' => false
			]
		);
			$this->add_control(
				'apt_header_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_SECONDARY,
					// ],
					'selectors' => [
                        '{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header' => 'background-color: {{VALUE}};'
                    ],
				]
			);
			
			// $this->add_group_control(
			// 	Group_Control_Border::get_type(),
			// 	[
			// 		'name' => 'apt_header_border',
			// 		'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .title::after',
			// 	]
			// );

			$this->add_control(
				'apt_header_title_divider',
				[
					'label' => esc_html__( 'Divider', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .title::after' => 'border-top-style: none;',
					],
				]
			);
			$this->add_control(
				'apt_header_title_divider_style',
				[
					'label' => esc_html__( 'Style', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none'   => esc_html__( 'none', 'advanced-pricing-table' ),
						'solid'  => esc_html__( 'Solid', 'advanced-pricing-table' ),
						'double' => esc_html__( 'Double', 'advanced-pricing-table' ),
						'dotted' => esc_html__( 'Dotted', 'advanced-pricing-table' ),
						'dashed' => esc_html__( 'Dashed', 'advanced-pricing-table' ),
					],
					'default' => 'solid',
					'condition' => [
						'apt_header_title_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .title::after' => 'border-top-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'apt_header_title_divider_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ddd',
					'global' => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'condition' => [
						'apt_header_title_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .title::after' => 'border-top-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'apt_header_title_divider_weight',
				[
					'label' => esc_html__( 'Weight', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 2,
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 10,
						],
					],
					'condition' => [
						'apt_header_title_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .title::after' => 'border-top-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'apt_header_title_divider_width',
				[
					'label' => esc_html__( 'Width', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					// 'size_units' => [ 'px', '%' ],
					'range' => [
						// 'px' => [
						// 	'min' => 0,
						// 	'max' => 1000,
						// 	'step' => 5,
						// ],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 50,
					],
					'condition' => [
						'apt_header_title_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .title::after' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'apt_header_title_divider_gap',
				[
					'label' => esc_html__( 'Gap', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 10,
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 50,
						],
					],
					'condition' => [
						'apt_header_title_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .title::after' => 'margin: {{SIZE}}{{UNIT}} auto;',
					],
				]
			);
	
			$this->add_responsive_control(
				'apt_header_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
                        '{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
				]
			);
			$this->add_control(
				'apt_heading_hr',
				[
					'label' => esc_html__( 'Title', 'advanced-pricing-table' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'apt_heading_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .title' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'apt_heading_typography',
					'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .title',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
				]
			);
			$this->add_control(
				'apt_sub_heading_style',
				[
					'label' => esc_html__( 'Sub Title', 'advanced-pricing-table' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'apt_sub_heading_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .decription' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'apt_sub_heading_typography',
					'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-pricing-header .decription',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'apt_section_pricing_style',
			[
				'label' => esc_html__( 'Pricing', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
			$this->add_control(
				'apt_pricing_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price' => 'background-color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'apt_pricing_divider',
				[
					'label' => esc_html__( 'Divider', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => '',
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price:before' => 'border-top-style: none;',
					],
				]
			);
			$this->add_control(
				'apt_pricing_divider_style',
				[
					'label' => esc_html__( 'Style', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none'   => esc_html__( 'none', 'advanced-pricing-table' ),
						'solid'  => esc_html__( 'Solid', 'advanced-pricing-table' ),
						'double' => esc_html__( 'Double', 'advanced-pricing-table' ),
						'dotted' => esc_html__( 'Dotted', 'advanced-pricing-table' ),
						'dashed' => esc_html__( 'Dashed', 'advanced-pricing-table' ),
					],
					'default' => 'solid',
					'condition' => [
						'apt_pricing_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price:before' => 'border-top-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'apt_pricing_divider_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ddd',
					'global' => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'condition' => [
						'apt_pricing_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price:before' => 'border-top-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'apt_pricing_divider_weight',
				[
					'label' => esc_html__( 'Weight', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 2,
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 10,
						],
					],
					'condition' => [
						'apt_pricing_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price:before' => 'border-top-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'apt_pricing_divider_width',
				[
					'label' => esc_html__( 'Width', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					// 'size_units' => [ 'px', '%' ],
					'range' => [
						// 'px' => [
						// 	'min' => 0,
						// 	'max' => 1000,
						// 	'step' => 5,
						// ],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 50,
					],
					'condition' => [
						'apt_pricing_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price:before' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'apt_pricing_divider_gap',
				[
					'label' => esc_html__( 'Gap', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 10,
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'condition' => [
						'apt_pricing_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price:before' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'apt_pricing_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'apt_price_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price' => 'color: {{VALUE}}',
					],
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'price_typography',
					'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
				]
			);
			$this->add_control(
				'apt_heading_currency_style',
				[
					'label' => esc_html__( 'Currency Symbol', 'advanced-pricing-table' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'apt_pricing_currency_symbol!' => '',
					],
				]
			);
			$this->add_control(
				'apt_currency_size',
				[
					'label' => esc_html__( 'Size', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .currency' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'apt_pricing_currency_symbol!' => '',
					],
				]
			);
			$this->add_control(
				'apt_currency_position',
				[
					'label' => esc_html__( 'Position', 'advanced-pricing-table' ),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'before',
					'selectors_dictionary' => [
						'before' => '0',
						'after' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .currency' => 'order: {{VALUE}}',
					],
					'options' => [
						'before' => [
							'title' => esc_html__( 'Before', 'advanced-pricing-table' ),
							'icon' => 'eicon-h-align-left',
						],
						'after' => [
							'title' => esc_html__( 'After', 'advanced-pricing-table' ),
							'icon' => 'eicon-h-align-right',
						],
					],
				]
			);
			$this->add_control(
				'apt_currency_vertical_position',
				[
					'label' => esc_html__( 'Vertical Position', 'advanced-pricing-table' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'top' => [
							'title' => esc_html__( 'Top', 'advanced-pricing-table' ),
							'icon' => 'eicon-v-align-top',
						],
						'middle' => [
							'title' => esc_html__( 'Middle', 'advanced-pricing-table' ),
							'icon' => 'eicon-v-align-middle',
						],
						'bottom' => [
							'title' => esc_html__( 'Bottom', 'advanced-pricing-table' ),
							'icon' => 'eicon-v-align-bottom',
						],
					],
					'default' => 'top',
					'selectors_dictionary' => [
						'top' => 'flex-start',
						'middle' => 'center',
						'bottom' => 'flex-end',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .currency' => 'align-self: {{VALUE}}',
					],
					'condition' => [
						'apt_pricing_currency_symbol!' => '',
					],
				]
			);
			$this->add_control(
				'apt_fractional_part_style',
				[
					'label' => esc_html__( 'Fractional Part', 'advanced-pricing-table' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'apt_fractional-part_size',
				[
					'label' => esc_html__( 'Size', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .freaction-part' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'apt_fractional_part_vertical_position',
				[
					'label' => esc_html__( 'Vertical Position', 'advanced-pricing-table' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'top' => [
							'title' => esc_html__( 'Top', 'advanced-pricing-table' ),
							'icon' => 'eicon-v-align-top',
						],
						'middle' => [
							'title' => esc_html__( 'Middle', 'advanced-pricing-table' ),
							'icon' => 'eicon-v-align-middle',
						],
						'bottom' => [
							'title' => esc_html__( 'Bottom', 'advanced-pricing-table' ),
							'icon' => 'eicon-v-align-bottom',
						],
					],
					'default' => 'top',
					'selectors_dictionary' => [
						'top' => 'flex-start',
						'middle' => 'center',
						'bottom' => 'flex-end',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .freaction-part' => 'align-self: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'apt_heading_original_price_style',
				[
					'label' => esc_html__( 'Original Price', 'advanced-pricing-table' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'apt_pricing_sale' => 'yes',
						'apt_pricing_original_price!' => '',
					],
				]
			);
			$this->add_control(
				'apt_original_price_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_SECONDARY,
					// ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .original-price' => 'color: {{VALUE}}',
					],
					'condition' => [
						'apt_pricing_sale' => 'yes',
						'apt_pricing_original_price!' => '',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'apt_original_price_typography',
					'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .original-price',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'condition' => [
						'apt_pricing_sale' => 'yes',
						'apt_pricing_original_price!' => '',
					],
				]
			);
			$this->add_control(
				'apt_original_price_vertical_position',
				[
					'label' => esc_html__( 'Vertical Position', 'advanced-pricing-table' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'top' => [
							'title' => esc_html__( 'Top', 'advanced-pricing-table' ),
							'icon' => 'eicon-v-align-top',
						],
						'middle' => [
							'title' => esc_html__( 'Middle', 'advanced-pricing-table' ),
							'icon' => 'eicon-v-align-middle',
						],
						'bottom' => [
							'title' => esc_html__( 'Bottom', 'advanced-pricing-table' ),
							'icon' => 'eicon-v-align-bottom',
						],
					],
					'selectors_dictionary' => [
						'top' => 'flex-start',
						'middle' => 'center',
						'bottom' => 'flex-end',
					],
					'default' => 'bottom',
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .original-price' => 'align-self: {{VALUE}}',
					],
					'condition' => [
						'apt_pricing_sale' => 'yes',
						'apt_pricing_original_price!' => '',
					],
				]
			);
			$this->add_control(
				'apt_heading_period_style',
				[
					'label' => esc_html__( 'Period', 'advanced-pricing-table' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'apt_pricing_period!' => '',
					],
				]
			);
			$this->add_control(
				'apt_period_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_SECONDARY,
					// ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .period' => 'color: {{VALUE}}',
					],
					'condition' => [
						'apt_pricing_period!' => '',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'apt_period_typography',
					'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .period',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
					],
					'condition' => [
						'apt_pricing_period!' => '',
					],
				]
			);
			$this->add_control(
				'apt_period_position',
				[
					'label' => esc_html__( 'Position', 'advanced-pricing-table' ),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'before',
					'selectors_dictionary' => [
						'below' => '',
						'beside' => 'initial',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-pricing-price .period' => 'width: {{VALUE}}',
					],
					'options' => [
						'below' => [
							'title' => esc_html__( 'Below', 'advanced-pricing-table' ),
							'icon' => 'eicon-h-align-left',
						],
						'beside' => [
							'title' => esc_html__( 'Beside', 'advanced-pricing-table' ),
							'icon' => 'eicon-h-align-right',
						],
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_center_icon_style',
			[
				'label' => esc_html__( 'Center Icon', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => ['apt_center_icon_show' => 'yes']
			]
		);

			$this->add_control(
				'center_icon_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-center-icon svg' => 'fill: {{VALUE}}',
					]
				]
			);
			$this->add_control(
				'center_icon_bgcolor',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-center-icon' => 'background-color: {{VALUE}}',
					]
				]
			);
			$this->add_control(
				'apt_center_icon_size',
				[
					'label' => esc_html__( 'Size', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-center-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'apt_center_icon_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-center-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					]
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_features_list_style',
			[
				'label' => esc_html__( 'Features', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

			$this->add_control(
				'features_list_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features li' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_control(
				'features_list_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features' => 'background-color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'features_list_typography',
					'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-features li',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_TEXT,
					]
				]
			);
			$this->add_control(
				'features_list_alignment',
				[
					'label' => esc_html__( 'Alignment', 'advanced-pricing-table' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'advanced-pricing-table' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'advanced-pricing-table' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'advanced-pricing-table' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features .items li' => 'justify-content: {{VALUE}}',
					]
				]
			);
			$this->add_responsive_control(
				'features_list_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features .items li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			
			$this->add_control(
				'list_divider',
				[
					'label' => esc_html__( 'Divider', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features .items li+li:before' => 'border-top-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'divider_style',
				[
					'label' => esc_html__( 'Style', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none'   => esc_html__( 'none', 'advanced-pricing-table' ),
						'solid' => esc_html__( 'Solid', 'advanced-pricing-table' ),
						'double' => esc_html__( 'Double', 'advanced-pricing-table' ),
						'dotted' => esc_html__( 'Dotted', 'advanced-pricing-table' ),
						'dashed' => esc_html__( 'Dashed', 'advanced-pricing-table' ),
					],
					'default' => 'solid',
					'condition' => [
						'list_divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features .items li+li:before' => 'border-top-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'divider_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#272424',
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'condition' => [
						'list_divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features .items li+li:before' => 'border-top-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'divider_weight',
				[
					'label' => esc_html__( 'Weight', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 2,
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 10,
						],
					],
					'condition' => [
						'list_divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features .items li+li:before' => 'border-top-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'divider_width',
				[
					'label' => esc_html__( 'Width', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					// 'size_units' => [ 'px', '%' ],
					'range' => [
						// 'px' => [
						// 	'min' => 0,
						// 	'max' => 1000,
						// 	'step' => 5,
						// ],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 80,
					],
					'condition' => [
						'list_divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features .items li+li:before' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'divider_gap',
				[
					'label' => esc_html__( 'Gap', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					// 'default' => [
					// 	'size' => 20,
					// 	'unit' => 'px',
					// ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 50,
						],
					],
					'condition' => [
						'list_divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-features .items li' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => ['apt_button_show' => 'yes']
			]
		);
			$this->add_control(
				'button_div_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-button-box' => 'background-color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'button_div_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-button-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'heading_button_label',
				[
					'label' => esc_html__( 'Button', 'advanced-pricing-table' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);
			$this->add_control(
				'apt_button_size',
				[
					'label' => esc_html__( 'Size', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'md',
					'options' => [
						'xs' => esc_html__( 'Extra Small', 'advanced-pricing-table' ),
						'sm' => esc_html__( 'Small', 'advanced-pricing-table' ),
						'md' => esc_html__( 'Medium', 'advanced-pricing-table' ),
						'lg' => esc_html__( 'Large', 'advanced-pricing-table' ),
						'xl' => esc_html__( 'Extra Large', 'advanced-pricing-table' ),
					]
				]
			);

			$this->start_controls_tabs( 'tabs_button_style' );

				$this->start_controls_tab(
					'tab_button_normal',
					[
						'label' => esc_html__( 'Normal', 'advanced-pricing-table' ),
					]
				);
				$this->add_control(
					'button_text_color',
					[
						'label' => esc_html__( 'Text Color', 'advanced-pricing-table' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .apt-pricing-table-container .apt-button-box .apt-button' => 'color: {{VALUE}};',
						]
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'button_typography',
						// 'global' => [
						// 	'default' => Global_Typography::TYPOGRAPHY_ACCENT,
						// ],
						'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-button-box .apt-button',
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'button_background',
						'types' => [ 'classic', 'gradient' ],
						'exclude' => [ 'image' ],
						'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-button-box .apt-button',
						'fields_options' => [
							'background' => [
								'default' => 'classic',
							],
							// 'color' => [
							// 	'global' => [
							// 		'default' => Global_Colors::COLOR_ACCENT,
							// 	],
							// ],
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(), [
						'name' => 'button_border',
						'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-button-box .apt-button',
						'separator' => 'before',
					]
				);
				$this->add_control(
					'button_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'advanced-pricing-table' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%' ],
						'selectors' => [
							'{{WRAPPER}} .apt-pricing-table-container .apt-button-box .apt-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						]
					]
				);
				$this->add_control(
					'button_text_padding',
					[
						'label' => esc_html__( 'Text Padding', 'advanced-pricing-table' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							'{{WRAPPER}} .apt-pricing-table-container .apt-button-box .apt-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						]
					]
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_button_hover',
					[
						'label' => esc_html__( 'Hover', 'advanced-pricing-table' ),
					]
				);
					$this->add_control(
						'button_hover_color',
						[
							'label' => esc_html__( 'Text Color', 'advanced-pricing-table' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .apt-pricing-table-container .apt-button-box .apt-button:hover' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'button_background_hover',
							'types' => [ 'classic', 'gradient' ],
							'exclude' => [ 'image' ],
							'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-button-box .apt-button:hover',
							'fields_options' => [
								'background' => [
									'default' => 'classic',
								],
							]
						]
					);
					$this->add_control(
						'button_hover_border_color',
						[
							'label' => esc_html__( 'Border Color', 'advanced-pricing-table' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .apt-pricing-table-container .apt-button-box .apt-button:hover' => 'border-color: {{VALUE}};',
							]
						]
					);
					// $this->add_control(
					// 	'button_hover_animation',
					// 	[
					// 		'label' => esc_html__( 'Animation', 'advanced-pricing-table' ),
					// 		'type' => Controls_Manager::HOVER_ANIMATION,
					// 	]
					// );
				$this->end_controls_tab();

			$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'apt_section_additional_text_style',
			[	
				'label' => esc_html__( 'Additional Text', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'apt_additional_text_show' => 'yes',
					'apt_additional_textarea!' => '',
				]
			]
		);
			$this->add_control(
				'additional_text_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-additional-text .additional-text' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_control(
				'additional_text_bgcolor',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-additional-text' => 'background-color: {{VALUE}}',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'additional_text_typography',
					'selector' => '{{WRAPPER}} .apt-pricing-table-container .apt-additional-text .additional-text',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_TEXT,
					]
				]
			);
			$this->add_control(
				'additional_text_alignment',
				[
					'label' => esc_html__( 'Alignment', 'advanced-pricing-table' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'advanced-pricing-table' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'advanced-pricing-table' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'advanced-pricing-table' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-additional-text' => 'text-align: {{VALUE}}',
					]
				]
			);
			$this->add_control(
				'additional_text_margin',
				[
					'label' => esc_html__( 'Margin', 'advanced-pricing-table' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					// 'default' => [
					// 	'top' => 15,
					// 	'right' => 30,
					// 	'bottom' => 0,
					// 	'left' => 30,
					// 	'unit' => 'px',
					// ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-additional-text .additional-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					]
				]
			);
			$this->add_control(
				'additional_text_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					// 'default' => [
					// 	'top' => 15,
					// 	'right' => 30,
					// 	'bottom' => 0,
					// 	'left' => 30,
					// 	'unit' => 'px',
					// ],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .apt-additional-text .additional-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					]
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'apt_section_ribbon_style',
			[
				'label' => esc_html__( 'Ribbon', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'apt_ribbon_show' => 'yes',
				],
			]
		);
			$this->add_control(
				'apt_ribbon_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_ACCENT,
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .ribbon' => 'background-color: {{VALUE}}',
					],
				]
			);
			// $ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';
			// $this->add_responsive_control(
			// 	'apt_ribbon_distance',
			// 	[
			// 		'label' => esc_html__( 'Distance', 'advanced-pricing-table' ),
			// 		'type' => Controls_Manager::SLIDER,
			// 		'range' => [
			// 			'px' => [
			// 				'min' => 0,
			// 				'max' => 50,
			// 			],
			// 		],
			// 		'selectors' => [
			// 			'{{WRAPPER}} .apt-pricing-table-container .ribbon' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
			// 		],
			// 	]
			// );

			$this->add_responsive_control(
				'apt_ribbon_top',
				[
					'label' => esc_html__( 'Ribbon Top', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .ribbon' => 'top: {{SIZE}}{{UNIT}};'
					],
				]
			);
			$this->add_responsive_control(
				'apt_ribbon_left',
				[
					'label' => esc_html__( 'Ribbon Left', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .ribbon' => 'left: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'apt_ribbon_horizontal_position' => 'left',
					],
				]
			);
			$this->add_responsive_control(
				'apt_ribbon_right',
				[
					'label' => esc_html__( 'Ribbon Right', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .ribbon' => 'right: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'apt_ribbon_horizontal_position' => 'right',
					],
				]
			);
			$this->add_responsive_control(
				'apt_ribbon_height',
				[
					'label' => esc_html__( 'Ribbon Height', 'advanced-pricing-table' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .ribbon' => 'height: {{SIZE}}{{UNIT}};'
					],
				]
			);

			$this->add_control(
				'apt_ribbon_text_color',
				[
					'label' => esc_html__( 'Text Color', 'advanced-pricing-table' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ffffff',
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .apt-pricing-table-container .ribbon' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'apt_ribbon_typography',
					'selector' => '{{WRAPPER}} .apt-pricing-table-container .ribbon',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'apt_ribbon_box_shadow',
					'selector' => '{{WRAPPER}} .apt-pricing-table-container .ribbon',
				]
			);
		$this->end_controls_section();


		$this->start_controls_section(
			'apt_section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'advanced-pricing-table' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'apt_pricing_template',
			[
				'label'   => esc_html__( 'Pricing Table Template', 'advanced-pricing-table' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__( 'Template 1', 'advanced-pricing-table' ),
					'2' => esc_html__( 'Template 2', 'advanced-pricing-table' ),
					'3' => esc_html__( 'Template 3', 'advanced-pricing-table' ),
				],
				'default' => '1',
			]
		);

		$this->add_control(
			'apt_center_icon_show',
			[
				'label' 	   => esc_html__( 'Center Icon', 'advanced-pricing-table' ),
				'type' 		   => Controls_Manager::SWITCHER,
				'label_on' 	   => esc_html__( 'Show', 'advanced-pricing-table' ),
				'label_off'    => esc_html__( 'Hide', 'advanced-pricing-table' ),
				'return_value' => 'yes',
				'default' 	   => 'yes'
			]
		);

		$this->add_control(
			'apt_ribbon_show',
			[
				'label' => esc_html__( 'Ribbon', 'advanced-pricing-table' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' 	   => esc_html__( 'Show', 'advanced-pricing-table' ),
				'label_off'    => esc_html__( 'Hide', 'advanced-pricing-table' ),
				'return_value' => 'yes',
				'default' 	   => 'yes'
			]
		);

		$this->add_control(
			'apt_button_show',
			[
				'label' => esc_html__( 'Button', 'advanced-pricing-table' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' 	   => esc_html__( 'Show', 'advanced-pricing-table' ),
				'label_off'    => esc_html__( 'Hide', 'advanced-pricing-table' ),
				'return_value' => 'yes',
				'default' 	   => 'yes'
			]
		);

		$this->add_control(
			'apt_additional_text_show',
			[
				'label' => esc_html__( 'Additional Text', 'advanced-pricing-table' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' 	   => esc_html__( 'Show', 'advanced-pricing-table' ),
				'label_off'    => esc_html__( 'Hide', 'advanced-pricing-table' ),
				'return_value' => 'yes',
				'default' 	   => 'yes'
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render pricing widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$centerIconShow 	= $settings['apt_center_icon_show'];
		$ribbonShow 		= $settings['apt_ribbon_show'];
		$additionalTextShow = $settings['apt_additional_text_show']; 
		$buttonShow 	   	= $settings['apt_button_show']; 


		$this->add_render_attribute( 
			'apt_pricing_options', 
			[   
                'id'                => 'apt-pricing-table-' . intval( $this->get_id() ),
                'class'             => [
					'apt-pricing-table-container',
					'apt-pricing-table-template-'.$settings['apt_pricing_template']
				]
            ]
        );

		// Currency format
		$currency_format = empty( $settings['apt_pricing_currency_format'] ) ? '.' : $settings['apt_pricing_currency_format'];

		$price = explode( $currency_format, $settings['apt_pricing_price'] );
		$intpart = $price[0];
		
		$fraction = '';
		if ( 2 === count( $price ) ) {
			$fraction = $price[1];
		}

		if ($settings['apt_pricing_currency_symbol'] === 'custom') {
			$settings['apt_pricing_currency_symbol'] = $settings['apt_pricing_currency_symbol_custom']; 
		}

		// Button 
		$this->add_render_attribute( 'apt_render_button_attr', 'class', [
			'apt-button',
			'apt-button-size-'.$settings['apt_button_size']
		] );
		
		if ( ! empty( $settings['apt_button_link']['url'] ) ) {
			$this->add_link_attributes( 'apt_render_button_attr', $settings['apt_button_link'] );
		}

		// title tag ex: h1
		$this->add_render_attribute( 'apt_header_title_tag_attr', 'class', [
			'title',
		]);
		$titleTag = Utils::validate_html_tag( $settings['apt_header_title_tag'] );
	?>
		<div <?php echo wp_kses_post($this->get_render_attribute_string( 'apt_pricing_options')); ?>> 
			<div class="apt-pricing-header"> 
				<?php if ( ! empty( $settings['apt_header_title_tag'] ) ) : ?>
					<<?php Utils::print_validated_html_tag( $titleTag ); ?> <?php $this->print_render_attribute_string( 'apt_header_title_tag_attr' ); ?>>
						<?php $this->print_unescaped_setting( 'apt_header_title' ); ?>
					</<?php Utils::print_validated_html_tag( $titleTag ); ?>>
				<?php endif; ?>
				<p class="decription"> <?php echo esc_html($settings['apt_header_description']); ?> </p>
			</div>

			<div class="apt-pricing-price"> 
				<?php if ( 'yes' === $settings['apt_pricing_sale'] && !empty( $settings['apt_pricing_original_price'] ) ) : ?>
					<span class="original-price"> <?php echo esc_html($settings['apt_pricing_currency_symbol'] . $settings['apt_pricing_original_price']); ?></span>
				<?php endif; ?>
				<span class="currency <?php echo esc_attr("currency-position-".$settings['apt_currency_position']); ?>"> 
					<?php echo esc_html($settings['apt_pricing_currency_symbol']); ?> 
				</span>
				<span class="price"> <?php echo (int) $intpart; ?> </span>
				<span class="freaction-part"> <?php echo (int) $fraction; ?> </span>
				<span class="period"> 
					<?php echo esc_html($settings['apt_pricing_period']); ?> 
				</span>
			</div>

			<?php if ($centerIconShow === 'yes'): ?>
				<div class="apt-center-icon">
					<?php
						Icons_Manager::render_icon( 
							$settings['apt_features_top_icon'], 
							[ 'class' => 'apt-features-top-icon', 'aria-hidden' => 'true' ]
						);
					?>
				</div>
			<?php endif; ?> 

			<div class="apt-features">
				<ul class="items">
					<?php foreach($settings['apt_features_list'] as $item) : ?>
						<li>
							<span>
								<?php 
									Icons_Manager::render_icon( $item['apt_features_selected_item_icon'],  [ 'class' => 'apt-features-icon', 'aria-hidden' => 'true' ],  );
								?>
							</span> 
						<?php echo esc_html($item['apt_features_item_text']); ?> </li>
					<?php endforeach; ?>
				</ul>
			</div>

			<?php if ($buttonShow === 'yes') : ?>
				<div class="apt-button-box">
					<a <?php $this->print_render_attribute_string( 'apt_render_button_attr' ); ?> type="button">
						<?php $this->print_unescaped_setting( 'apt_button_text' ); ?>
					</a>
				</div>	
			<?php endif; ?>

			<?php if ($additionalTextShow === 'yes') : ?>
				<div class="apt-additional-text">
					<p class="additional-text"><?php echo esc_html($settings['apt_additional_textarea']); ?> </p>
				</div>
			<?php endif; ?>

			<?php if ($ribbonShow === 'yes' ) : ?>
				<div class="ribbon ribbon-<?php echo esc_attr($settings['apt_ribbon_horizontal_position']); ?>">
					<p><?php echo esc_html($settings['apt_ribbon_title']); ?></p>
				</div>
			<?php endif; ?> 
		</div>
	<?php
	}
}