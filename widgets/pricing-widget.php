<?php

namespace APTFE\Classes\Widgets;
 
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
 * @since  1.0.4
 */
class Advanced_Pricing_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve pricing widget name.
	 *
	 * @since  1.0.4
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
	 * @since  1.0.4
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
	 * @since  1.0.4
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
	 * @since  1.0.4
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
	 * @since  1.0.4
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
	 * @since  1.0.4
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'aptfe_content_section',
			[
				'label' => esc_html__( 'Header', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);
			$this->add_control(
				'aptfe_header_title',
				[
					'label' => esc_html__( 'Title', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default' => esc_html__( 'Standard', 'advanced-pricing-table-for-elementor' ),
					'placeholder' => esc_html__( 'Standard', 'advanced-pricing-table-for-elementor' ),
				]
			);
			$this->add_control(
				'aptfe_header_description',
				[
					'label' => esc_html__( 'Description', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXTAREA,
					'rows' => 10,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'Type your description here', 'advanced-pricing-table-for-elementor' ),
				]
			);
			$this->add_control(
				'aptfe_header_title_tag',
				[
					'label' => esc_html__( 'Title HTML Tag', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'h2',
					'options' => [
						'h1'  => esc_html__( 'H1', 'advanced-pricing-table-for-elementor' ),
						'h2'  => esc_html__( 'H2', 'advanced-pricing-table-for-elementor' ),
						'h3'  => esc_html__( 'H3', 'advanced-pricing-table-for-elementor' ),
						'h4'  => esc_html__( 'H4', 'advanced-pricing-table-for-elementor' ),
						'h5'  => esc_html__( 'H5', 'advanced-pricing-table-for-elementor' ),
						'h6'  => esc_html__( 'H6', 'advanced-pricing-table-for-elementor' ),
					],
					// 'selectors' => [
					// 	'{{WRAPPER}} .your-class' => 'border-style: {{VALUE}};',
					// ],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'aptfe_pricing_section',
			[
				'label' => esc_html__( 'Pricing', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);
			$this->add_control(
				'aptfe_pricing_currency_symbol',
				[
					'label' => esc_html__( 'Currency Symbol', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => esc_html__( 'None', 'advanced-pricing-table-for-elementor' ),
						'&#36;'   => esc_html__( 'Dollar', 'advanced-pricing-table-for-elementor' ),
						'&#128;'  => esc_html__( 'Euro', 'advanced-pricing-table-for-elementor' ),
						'&#3647;' => esc_html__( 'Baht', 'advanced-pricing-table-for-elementor' ),
						'&#8355;' => esc_html__( 'Franc', 'advanced-pricing-table-for-elementor' ),
						'&fnof;'  => esc_html__( 'Guilder', 'advanced-pricing-table-for-elementor' ),
						'kr' 	  => esc_html__( 'Krona', 'advanced-pricing-table-for-elementor' ),
						'&#8356;' => esc_html__( 'Lira', 'advanced-pricing-table-for-elementor' ),
						'&#8359;' => esc_html__( 'Peseta', 'advanced-pricing-table-for-elementor' ),
						'&#8369;' => esc_html__( 'Peso', 'advanced-pricing-table-for-elementor' ),
						'&#163;'  => esc_html__( 'Pound Sterling', 'advanced-pricing-table-for-elementor' ),
						'R$'	  => esc_html__( 'Real', 'advanced-pricing-table-for-elementor' ),
						'&#8381;' => esc_html__( 'Ruble', 'advanced-pricing-table-for-elementor' ),
						'&#8360;' => esc_html__( 'Rupee', 'advanced-pricing-table-for-elementor' ),
						'&#8377;' => esc_html__( 'Rupee (Indian)', 'advanced-pricing-table-for-elementor' ),
						'&#8362;' => esc_html__( 'Shekel', 'advanced-pricing-table-for-elementor' ),
						'&#165;'  => esc_html__( 'Yen/Yuan', 'advanced-pricing-table-for-elementor' ),
						'&#8361;' => esc_html__( 'Won', 'advanced-pricing-table-for-elementor' ),
						'&#2547;' => esc_html__( 'Taka', 'advanced-pricing-table-for-elementor' ),
						'custom'  => esc_html__( 'Custom', 'advanced-pricing-table-for-elementor' ),
					],
					'default' => '&#36;',
				]
			);
			$this->add_control(
				'aptfe_pricing_currency_symbol_custom',
				[
					'label' => esc_html__( 'Custom Symbol', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'aptfe_pricing_currency_symbol' => 'custom',
					],
				]
			);
			$this->add_control(
				'aptfe_pricing_price',
				[
					'label' => esc_html__( 'Price', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => '39.99',
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$this->add_control(
				'aptfe_pricing_currency_format',
				[
					'label' => esc_html__( 'Currency Format', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => '1,234.56 (Default)',
						',' => '1.234,56',
					],
				]
			);
			$this->add_control(
				'aptfe_pricing_sale',
				[
					'label' => esc_html__( 'Sale', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'advanced-pricing-table-for-elementor' ),
					'label_off' => esc_html__( 'Off', 'advanced-pricing-table-for-elementor' ),
					'default' => '',
				]
			);
			$this->add_control(
				'aptfe_pricing_original_price',
				[
					'label' => esc_html__( 'Original Price', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::NUMBER,
					'default' => '59',
					'condition' => [
						'aptfe_pricing_sale' => 'yes',
					],
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$this->add_control(
				'aptfe_pricing_period',
				[
					'label' => esc_html__( 'Period', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Monthly', 'advanced-pricing-table-for-elementor' ),
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'aptfe_features_section',
			[
				'label' => esc_html__( 'Features', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);
			$repeater = new Repeater();
			$repeater->add_control(
				'aptfe_features_item_text',
				[
					'label' => esc_html__( 'Text', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'List Item', 'advanced-pricing-table-for-elementor' ),
				]
			);
			$default_icon = [
					'value' => 'far fa-arrow-alt-circle-right',
					'library' => 'fa-regular'
			];
			$repeater->add_control(
				'aptfe_features_selected_item_icon',
				[
					'label' => esc_html__( 'Icon', 'advanced-pricing-table-for-elementor' ),
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
				'aptfe_features_item_icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features .items li i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features .items li svg' => 'fill: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'aptfe_features_list',
				[
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'aptfe_features_item_text' => esc_html__( 'List Item #1', 'advanced-pricing-table-for-elementor' ),
							'aptfe_features_selected_item_icon' => $default_icon,
						],
						[
							'aptfe_features_item_text' => esc_html__( 'List Item #2', 'advanced-pricing-table-for-elementor' ),
							'aptfe_features_selected_item_icon' => $default_icon,
						],
						[
							'aptfe_features_item_text' => esc_html__( 'List Item #3', 'advanced-pricing-table-for-elementor' ),
							'aptfe_features_selected_item_icon' => $default_icon,
						],
					],
					'title_field' => '{{{ aptfe_features_item_text }}}',
				]
			);
			
		$this->end_controls_section();

		$this->start_controls_section(
			'aptfe_center_icon_section',
			[
				'label' => esc_html__( 'Center Icon', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => ['aptfe_center_icon_show' => 'yes']
			]
		);
			$this->add_control(
				'aptfe_features_top_icon',
				[
					'label' => esc_html__( 'Icon', 'advanced-pricing-table-for-elementor' ),
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
			'aptfe_button_section',
			[
				'label' => esc_html__( 'Button', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => ['aptfe_button_show' => 'yes']
			]
		);
			$this->add_control(
				'aptfe_button_text',
				[
					'label' => esc_html__( 'Button Text', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Click Here', 'advanced-pricing-table-for-elementor' ),
					'dynamic' => [
						'active' => true,
					]
				]
			);
			$this->add_control(
				'aptfe_button_link',
				[
					'label' => esc_html__( 'Link', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'advanced-pricing-table-for-elementor' ),
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
			'aptfe_additional_text_section',
			[
				'label' => esc_html__( 'Additional Text', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => ['aptfe_additional_text_show' => 'yes']
			]
		);
			$this->add_control(
				'aptfe_additional_textarea',
				[
					'label' => esc_html__( 'Additional text', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXTAREA,
					// 'type' => Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'This is text element', 'advanced-pricing-table-for-elementor' ),
					'rows' => 7,
					'dynamic' => [
						'active' => true,
					],
				]
			);

			// $this->add_control(
			// 	'aptfe_additional_textarea', [
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
			'aptfe_ribbon_section',
			[
				'label' => esc_html__( 'Ribbon', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'aptfe_ribbon_show' => 'yes',
				],
			]
		);	
			$this->add_control(
				'aptfe_ribbon_title',
				[
					'label' => esc_html__( 'Title', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Popular', 'advanced-pricing-table-for-elementor' ),
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$this->add_control(
				'aptfe_ribbon_horizontal_position',
				[
					'label' => esc_html__( 'Position', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-h-align-left',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-h-align-right',
						],
					],
					'default' => 'left'
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'aptfe_section_pricing_table_style',
			[
				'label' => esc_html__( 'Pricing Table', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				// 'show_label' => false
			]
		);

		$this->add_control(
			'aptfe_pricing_table_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advanced-pricing-table-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				// 'global' => [
				// 	'default' => Global_Colors::COLOR_SECONDARY,
				// ],
				'selectors' => [
					'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'aptfe_pricing_table_border',
				// 'selector' => '{{WRAPPER}} .wrapper',
			]
		);

		$this->add_control(
			'aptfe_pricing_table_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'advanced-pricing-table-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					// '{{WRAPPER}} .your-class' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// $this->add_control(
		// 	'aptfe_pricing_table_box_shadow',
		// 	[
		// 		'label' => esc_html__( 'Box Shadow', 'advanced-pricing-table-for-elementor' ),
		// 		'type' => \Elementor\Controls_Manager::BOX_SHADOW,
		// 		'selectors' => [
		// 			// '{{SELECTOR}}' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
		// 		],
		// 	]
		// );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'aptfe_pricing_table_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'advanced-pricing-table-for-elementor' ),
				// 'selector' => '{{WRAPPER}} .coupon .input-text, {{WRAPPER}} .e-cart-totals .input-text, {{WRAPPER}} select, {{WRAPPER}} .select2-selection--single',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'aptfe_section_header_style',
			[
				'label' => esc_html__( 'Header', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				// 'show_label' => false
			]
		);
			$this->add_control(
				'aptfe_header_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_SECONDARY,
					// ],
					'selectors' => [
                        '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header' => 'background-color: {{VALUE}};'
                    ],
				]
			);
			
			// $this->add_group_control(
			// 	Group_Control_Border::get_type(),
			// 	[
			// 		'name' => 'aptfe_header_border',
			// 		'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .title::after',
			// 	]
			// );

			$this->add_control(
				'aptfe_header_title_divider',
				[
					'label' => esc_html__( 'Divider', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .title::after' => 'border-top-style: none;',
					],
				]
			);
			$this->add_control(
				'aptfe_header_title_divider_style',
				[
					'label' => esc_html__( 'Style', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none'   => esc_html__( 'none', 'advanced-pricing-table-for-elementor' ),
						'solid'  => esc_html__( 'Solid', 'advanced-pricing-table-for-elementor' ),
						'double' => esc_html__( 'Double', 'advanced-pricing-table-for-elementor' ),
						'dotted' => esc_html__( 'Dotted', 'advanced-pricing-table-for-elementor' ),
						'dashed' => esc_html__( 'Dashed', 'advanced-pricing-table-for-elementor' ),
					],
					'default' => 'solid',
					'condition' => [
						'aptfe_header_title_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .title::after' => 'border-top-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'aptfe_header_title_divider_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ddd',
					'global' => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'condition' => [
						'aptfe_header_title_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .title::after' => 'border-top-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'aptfe_header_title_divider_weight',
				[
					'label' => esc_html__( 'Weight', 'advanced-pricing-table-for-elementor' ),
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
						'aptfe_header_title_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .title::after' => 'border-top-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'aptfe_header_title_divider_width',
				[
					'label' => esc_html__( 'Width', 'advanced-pricing-table-for-elementor' ),
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
						'aptfe_header_title_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .title::after' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'aptfe_header_title_divider_gap',
				[
					'label' => esc_html__( 'Gap', 'advanced-pricing-table-for-elementor' ),
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
						'aptfe_header_title_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .title::after' => 'margin: {{SIZE}}{{UNIT}} auto;',
					],
				]
			);
	
			$this->add_responsive_control(
				'aptfe_header_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
                        '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
				]
			);
			$this->add_control(
				'aptfe_heading_hr',
				[
					'label' => esc_html__( 'Title', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'aptfe_heading_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .title' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'aptfe_heading_typography',
					'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .title',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
				]
			);
			$this->add_control(
				'aptfe_sub_heading_style',
				[
					'label' => esc_html__( 'Sub Title', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'aptfe_sub_heading_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .decription' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'aptfe_sub_heading_typography',
					'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-header .decription',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'aptfe_section_pricing_style',
			[
				'label' => esc_html__( 'Pricing', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
			$this->add_control(
				'aptfe_pricing_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price' => 'background-color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'aptfe_pricing_divider',
				[
					'label' => esc_html__( 'Divider', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => '',
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price:before' => 'border-top-style: none;',
					],
				]
			);
			$this->add_control(
				'aptfe_pricing_divider_style',
				[
					'label' => esc_html__( 'Style', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none'   => esc_html__( 'none', 'advanced-pricing-table-for-elementor' ),
						'solid'  => esc_html__( 'Solid', 'advanced-pricing-table-for-elementor' ),
						'double' => esc_html__( 'Double', 'advanced-pricing-table-for-elementor' ),
						'dotted' => esc_html__( 'Dotted', 'advanced-pricing-table-for-elementor' ),
						'dashed' => esc_html__( 'Dashed', 'advanced-pricing-table-for-elementor' ),
					],
					'default' => 'solid',
					'condition' => [
						'aptfe_pricing_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price:before' => 'border-top-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'aptfe_pricing_divider_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ddd',
					'global' => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'condition' => [
						'aptfe_pricing_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price:before' => 'border-top-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'aptfe_pricing_divider_weight',
				[
					'label' => esc_html__( 'Weight', 'advanced-pricing-table-for-elementor' ),
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
						'aptfe_pricing_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price:before' => 'border-top-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'aptfe_pricing_divider_width',
				[
					'label' => esc_html__( 'Width', 'advanced-pricing-table-for-elementor' ),
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
						'aptfe_pricing_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price:before' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'aptfe_pricing_divider_gap',
				[
					'label' => esc_html__( 'Gap', 'advanced-pricing-table-for-elementor' ),
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
						'aptfe_pricing_divider!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price:before' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'aptfe_pricing_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'aptfe_price_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price' => 'color: {{VALUE}}',
					],
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'price_typography',
					'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
				]
			);
			$this->add_control(
				'aptfe_heading_currency_style',
				[
					'label' => esc_html__( 'Currency Symbol', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'aptfe_pricing_currency_symbol!' => '',
					],
				]
			);
			$this->add_control(
				'aptfe_currency_size',
				[
					'label' => esc_html__( 'Size', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .currency' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'aptfe_pricing_currency_symbol!' => '',
					],
				]
			);
			$this->add_control(
				'aptfe_currency_position',
				[
					'label' => esc_html__( 'Position', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'before',
					'selectors_dictionary' => [
						'before' => '0',
						'after' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .currency' => 'order: {{VALUE}}',
					],
					'options' => [
						'before' => [
							'title' => esc_html__( 'Before', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-h-align-left',
						],
						'after' => [
							'title' => esc_html__( 'After', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-h-align-right',
						],
					],
				]
			);
			$this->add_control(
				'aptfe_currency_vertical_position',
				[
					'label' => esc_html__( 'Vertical Position', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'top' => [
							'title' => esc_html__( 'Top', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-v-align-top',
						],
						'middle' => [
							'title' => esc_html__( 'Middle', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-v-align-middle',
						],
						'bottom' => [
							'title' => esc_html__( 'Bottom', 'advanced-pricing-table-for-elementor' ),
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
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .currency' => 'align-self: {{VALUE}}',
					],
					'condition' => [
						'aptfe_pricing_currency_symbol!' => '',
					],
				]
			);
			$this->add_control(
				'aptfe_fractional_part_style',
				[
					'label' => esc_html__( 'Fractional Part', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'aptfe_fractional-part_size',
				[
					'label' => esc_html__( 'Size', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .freaction-part' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'aptfe_fractional_part_vertical_position',
				[
					'label' => esc_html__( 'Vertical Position', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'top' => [
							'title' => esc_html__( 'Top', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-v-align-top',
						],
						'middle' => [
							'title' => esc_html__( 'Middle', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-v-align-middle',
						],
						'bottom' => [
							'title' => esc_html__( 'Bottom', 'advanced-pricing-table-for-elementor' ),
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
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .freaction-part' => 'align-self: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'aptfe_heading_original_price_style',
				[
					'label' => esc_html__( 'Original Price', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'aptfe_pricing_sale' => 'yes',
						'aptfe_pricing_original_price!' => '',
					],
				]
			);
			$this->add_control(
				'aptfe_original_price_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_SECONDARY,
					// ],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .original-price' => 'color: {{VALUE}}',
					],
					'condition' => [
						'aptfe_pricing_sale' => 'yes',
						'aptfe_pricing_original_price!' => '',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'aptfe_original_price_typography',
					'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .original-price',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'condition' => [
						'aptfe_pricing_sale' => 'yes',
						'aptfe_pricing_original_price!' => '',
					],
				]
			);
			$this->add_control(
				'aptfe_original_price_vertical_position',
				[
					'label' => esc_html__( 'Vertical Position', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'top' => [
							'title' => esc_html__( 'Top', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-v-align-top',
						],
						'middle' => [
							'title' => esc_html__( 'Middle', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-v-align-middle',
						],
						'bottom' => [
							'title' => esc_html__( 'Bottom', 'advanced-pricing-table-for-elementor' ),
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
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .original-price' => 'align-self: {{VALUE}}',
					],
					'condition' => [
						'aptfe_pricing_sale' => 'yes',
						'aptfe_pricing_original_price!' => '',
					],
				]
			);
			$this->add_control(
				'aptfe_heading_period_style',
				[
					'label' => esc_html__( 'Period', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'aptfe_pricing_period!' => '',
					],
				]
			);
			$this->add_control(
				'aptfe_period_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_SECONDARY,
					// ],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .period' => 'color: {{VALUE}}',
					],
					'condition' => [
						'aptfe_pricing_period!' => '',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'aptfe_period_typography',
					'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .period',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
					],
					'condition' => [
						'aptfe_pricing_period!' => '',
					],
				]
			);
			$this->add_control(
				'aptfe_period_position',
				[
					'label' => esc_html__( 'Position', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'before',
					'selectors_dictionary' => [
						'below' => '',
						'beside' => 'initial',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-pricing-price .period' => 'width: {{VALUE}}',
					],
					'options' => [
						'below' => [
							'title' => esc_html__( 'Below', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-h-align-left',
						],
						'beside' => [
							'title' => esc_html__( 'Beside', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-h-align-right',
						],
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_center_icon_style',
			[
				'label' => esc_html__( 'Center Icon', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => ['aptfe_center_icon_show' => 'yes']
			]
		);

			$this->add_control(
				'center_icon_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-center-icon svg' => 'fill: {{VALUE}}',
					]
				]
			);
			$this->add_control(
				'center_icon_bgcolor',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-center-icon' => 'background-color: {{VALUE}}',
					]
				]
			);
			$this->add_control(
				'aptfe_center_icon_size',
				[
					'label' => esc_html__( 'Size', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-center-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'aptfe_center_icon_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-center-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					]
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_features_list_style',
			[
				'label' => esc_html__( 'Features', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

			$this->add_control(
				'features_list_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features li' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_control(
				'features_list_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features' => 'background-color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'features_list_typography',
					'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features li',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_TEXT,
					]
				]
			);
			$this->add_control(
				'features_list_alignment',
				[
					'label' => esc_html__( 'Alignment', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features .items li' => 'justify-content: {{VALUE}}',
					]
				]
			);
			$this->add_responsive_control(
				'features_list_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features .items li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			
			$this->add_control(
				'list_divider',
				[
					'label' => esc_html__( 'Divider', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features .items li+li:before' => 'border-top-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'divider_style',
				[
					'label' => esc_html__( 'Style', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none'   => esc_html__( 'none', 'advanced-pricing-table-for-elementor' ),
						'solid' => esc_html__( 'Solid', 'advanced-pricing-table-for-elementor' ),
						'double' => esc_html__( 'Double', 'advanced-pricing-table-for-elementor' ),
						'dotted' => esc_html__( 'Dotted', 'advanced-pricing-table-for-elementor' ),
						'dashed' => esc_html__( 'Dashed', 'advanced-pricing-table-for-elementor' ),
					],
					'default' => 'solid',
					'condition' => [
						'list_divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features .items li+li:before' => 'border-top-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'divider_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#272424',
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'condition' => [
						'list_divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features .items li+li:before' => 'border-top-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'divider_weight',
				[
					'label' => esc_html__( 'Weight', 'advanced-pricing-table-for-elementor' ),
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
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features .items li+li:before' => 'border-top-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'divider_width',
				[
					'label' => esc_html__( 'Width', 'advanced-pricing-table-for-elementor' ),
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
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features .items li+li:before' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_control(
				'divider_gap',
				[
					'label' => esc_html__( 'Gap', 'advanced-pricing-table-for-elementor' ),
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
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-features .items li' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => ['aptfe_button_show' => 'yes']
			]
		);
			$this->add_control(
				'button_div_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box' => 'background-color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'button_div_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'heading_button_label',
				[
					'label' => esc_html__( 'Button', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);
			$this->add_control(
				'aptfe_button_size',
				[
					'label' => esc_html__( 'Size', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'md',
					'options' => [
						'xs' => esc_html__( 'Extra Small', 'advanced-pricing-table-for-elementor' ),
						'sm' => esc_html__( 'Small', 'advanced-pricing-table-for-elementor' ),
						'md' => esc_html__( 'Medium', 'advanced-pricing-table-for-elementor' ),
						'lg' => esc_html__( 'Large', 'advanced-pricing-table-for-elementor' ),
						'xl' => esc_html__( 'Extra Large', 'advanced-pricing-table-for-elementor' ),
					]
				]
			);

			$this->start_controls_tabs( 'tabs_button_style' );

				$this->start_controls_tab(
					'tab_button_normal',
					[
						'label' => esc_html__( 'Normal', 'advanced-pricing-table-for-elementor' ),
					]
				);
				$this->add_control(
					'button_text_color',
					[
						'label' => esc_html__( 'Text Color', 'advanced-pricing-table-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box .aptfe-button' => 'color: {{VALUE}};',
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
						'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box .aptfe-button',
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'button_background',
						'types' => [ 'classic', 'gradient' ],
						// 'exclude' => [ 'image' ],
						'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box .aptfe-button',
						'fields_options' => [
							'background' => [
								'default' => 'classic',
							]
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(), [
						'name' => 'button_border',
						'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box .aptfe-button',
						'separator' => 'before',
					]
				);
				$this->add_control(
					'button_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'advanced-pricing-table-for-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%' ],
						'selectors' => [
							'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box .aptfe-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						]
					]
				);
				$this->add_control(
					'button_text_padding',
					[
						'label' => esc_html__( 'Text Padding', 'advanced-pricing-table-for-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box .aptfe-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						]
					]
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_button_hover',
					[
						'label' => esc_html__( 'Hover', 'advanced-pricing-table-for-elementor' ),
					]
				);
					$this->add_control(
						'button_hover_color',
						[
							'label' => esc_html__( 'Text Color', 'advanced-pricing-table-for-elementor' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box .aptfe-button:hover' => 'color: {{VALUE}};',
							]
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'button_background_hover',
							'types' => [ 'classic', 'gradient' ],
							// 'exclude' => [ 'image' ],
							'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box .aptfe-button:hover',
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
							'label' => esc_html__( 'Border Color', 'advanced-pricing-table-for-elementor' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-button-box .aptfe-button:hover' => 'border-color: {{VALUE}};',
							]
						]
					);
					// $this->add_control(
					// 	'button_hover_animation',
					// 	[
					// 		'label' => esc_html__( 'Animation', 'advanced-pricing-table-for-elementor' ),
					// 		'type' => Controls_Manager::HOVER_ANIMATION,
					// 	]
					// );
				$this->end_controls_tab();

			$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'aptfe_section_additional_text_style',
			[	
				'label' => esc_html__( 'Additional Text', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'aptfe_additional_text_show' => 'yes',
					'aptfe_additional_textarea!' => '',
				]
			]
		);
			$this->add_control(
				'additional_text_color',
				[
					'label' => esc_html__( 'Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-additional-text .additional-text' => 'color: {{VALUE}}',
					]
				]
			);
			$this->add_control(
				'additional_text_bgcolor',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					// 'global' => [
					// 	'default' => Global_Colors::COLOR_TEXT,
					// ],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-additional-text' => 'background-color: {{VALUE}}',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'additional_text_typography',
					'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .aptfe-additional-text .additional-text',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_TEXT,
					]
				]
			);
			$this->add_control(
				'additional_text_alignment',
				[
					'label' => esc_html__( 'Alignment', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'advanced-pricing-table-for-elementor' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-additional-text' => 'text-align: {{VALUE}}',
					]
				]
			);
			$this->add_control(
				'additional_text_margin',
				[
					'label' => esc_html__( 'Margin', 'advanced-pricing-table-for-elementor' ),
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
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-additional-text .additional-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					]
				]
			);
			$this->add_control(
				'additional_text_padding',
				[
					'label' => esc_html__( 'Padding', 'advanced-pricing-table-for-elementor' ),
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
						'{{WRAPPER}} .aptfe-pricing-table-container .aptfe-additional-text .additional-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					]
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'aptfe_section_ribbon_style',
			[
				'label' => esc_html__( 'Ribbon', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'aptfe_ribbon_show' => 'yes',
				],
			]
		);
			$this->add_control(
				'aptfe_ribbon_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_ACCENT,
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .ribbon' => 'background-color: {{VALUE}}',
					],
				]
			);
			// $ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';
			// $this->add_responsive_control(
			// 	'aptfe_ribbon_distance',
			// 	[
			// 		'label' => esc_html__( 'Distance', 'advanced-pricing-table-for-elementor' ),
			// 		'type' => Controls_Manager::SLIDER,
			// 		'range' => [
			// 			'px' => [
			// 				'min' => 0,
			// 				'max' => 50,
			// 			],
			// 		],
			// 		'selectors' => [
			// 			'{{WRAPPER}} .aptfe-pricing-table-container .ribbon' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
			// 		],
			// 	]
			// );

			$this->add_responsive_control(
				'aptfe_ribbon_top',
				[
					'label' => esc_html__( 'Ribbon Top', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .ribbon' => 'top: {{SIZE}}{{UNIT}};'
					],
				]
			);
			$this->add_responsive_control(
				'aptfe_ribbon_left',
				[
					'label' => esc_html__( 'Ribbon Left', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .ribbon' => 'left: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'aptfe_ribbon_horizontal_position' => 'left',
					],
				]
			);
			$this->add_responsive_control(
				'aptfe_ribbon_right',
				[
					'label' => esc_html__( 'Ribbon Right', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .ribbon' => 'right: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'aptfe_ribbon_horizontal_position' => 'right',
					],
				]
			);
			$this->add_responsive_control(
				'aptfe_ribbon_height',
				[
					'label' => esc_html__( 'Ribbon Height', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .ribbon' => 'height: {{SIZE}}{{UNIT}};'
					],
				]
			);

			$this->add_control(
				'aptfe_ribbon_text_color',
				[
					'label' => esc_html__( 'Text Color', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ffffff',
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .aptfe-pricing-table-container .ribbon' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'aptfe_ribbon_typography',
					'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .ribbon',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'aptfe_ribbon_box_shadow',
					'selector' => '{{WRAPPER}} .aptfe-pricing-table-container .ribbon',
				]
			);
		$this->end_controls_section();


		$this->start_controls_section(
			'aptfe_section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'aptfe_pricing_template',
			[
				'label'   => esc_html__( 'Template', 'advanced-pricing-table-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__( 'Template 1', 'advanced-pricing-table-for-elementor' ),
					'2' => esc_html__( 'Template 2', 'advanced-pricing-table-for-elementor' ),
					'3' => esc_html__( 'Template 3', 'advanced-pricing-table-for-elementor' ),
				],
				'default' => '2',
			]
		);

		$this->add_control(
			'aptfe_center_icon_show',
			[
				'label' 	   => esc_html__( 'Center Icon', 'advanced-pricing-table-for-elementor' ),
				'type' 		   => Controls_Manager::SWITCHER,
				'label_on' 	   => esc_html__( 'Show', 'advanced-pricing-table-for-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'advanced-pricing-table-for-elementor' ),
				'return_value' => 'yes',
				'default' 	   => 'yes'
			]
		);

		$this->add_control(
			'aptfe_ribbon_show',
			[
				'label' => esc_html__( 'Ribbon', 'advanced-pricing-table-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' 	   => esc_html__( 'Show', 'advanced-pricing-table-for-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'advanced-pricing-table-for-elementor' ),
				'return_value' => 'yes',
				'default' 	   => 'yes'
			]
		);

		$this->add_control(
			'aptfe_button_show',
			[
				'label' => esc_html__( 'Button', 'advanced-pricing-table-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' 	   => esc_html__( 'Show', 'advanced-pricing-table-for-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'advanced-pricing-table-for-elementor' ),
				'return_value' => 'yes',
				'default' 	   => 'yes'
			]
		);

		$this->add_control(
			'aptfe_additional_text_show',
			[
				'label' => esc_html__( 'Additional Text', 'advanced-pricing-table-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' 	   => esc_html__( 'Show', 'advanced-pricing-table-for-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'advanced-pricing-table-for-elementor' ),
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
	 * @since  1.0.4
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$centerIconShow 	= $settings['aptfe_center_icon_show'];
		$ribbonShow 		= $settings['aptfe_ribbon_show'];
		$additionalTextShow = $settings['aptfe_additional_text_show']; 
		$buttonShow 	   	= $settings['aptfe_button_show']; 


		$this->add_render_attribute( 
			'aptfe_pricing_options', 
			[   
                'id'                => 'aptfe-pricing-table-' . intval( $this->get_id() ),
                'class'             => [
					'aptfe-pricing-table-container',
					'aptfe-pricing-table-template-'.$settings['aptfe_pricing_template']
				]
            ]
        );

		// Currency format
		$currency_format = empty( $settings['aptfe_pricing_currency_format'] ) ? '.' : $settings['aptfe_pricing_currency_format'];

		$price = explode( $currency_format, $settings['aptfe_pricing_price'] );
		$intpart = $price[0];
		
		$fraction = '';
		if ( 2 === count( $price ) ) {
			$fraction = $price[1];
		}

		if ($settings['aptfe_pricing_currency_symbol'] === 'custom') {
			$settings['aptfe_pricing_currency_symbol'] = $settings['aptfe_pricing_currency_symbol_custom']; 
		}

		// Button 
		$this->add_render_attribute( 'aptfe_render_button_attr', 'class', [
			'aptfe-button',
			'aptfe-button-size-'.$settings['aptfe_button_size']
		] );
		
		if ( ! empty( $settings['aptfe_button_link']['url'] ) ) {
			$this->add_link_attributes( 'aptfe_render_button_attr', $settings['aptfe_button_link'] );
		}

		// title tag ex: h1
		$this->add_render_attribute( 'aptfe_header_title_tag_attr', 'class', [
			'title',
		]);
		
		$titleTag = Utils::validate_html_tag( $settings['aptfe_header_title_tag'] );
	?>
		<div <?php echo wp_kses_post($this->get_render_attribute_string( 'aptfe_pricing_options')); ?>> 
			<div class="aptfe-pricing-header"> 
				<?php if ( ! empty( $settings['aptfe_header_title_tag'] ) ) : ?>
					<<?php Utils::print_validated_html_tag( $titleTag ); ?> <?php $this->print_render_attribute_string( 'aptfe_header_title_tag_attr' ); ?>>
						<?php $this->print_unescaped_setting( 'aptfe_header_title' ); ?>
					</<?php Utils::print_validated_html_tag( $titleTag ); ?>>
				<?php endif; ?>
				<p class="decription"> <?php echo esc_html($settings['aptfe_header_description']); ?> </p>
			</div>

			<div class="aptfe-pricing-price"> 
				<?php if ( 'yes' === $settings['aptfe_pricing_sale'] && !empty( $settings['aptfe_pricing_original_price'] ) ) : ?>
					<span class="original-price"> <?php echo esc_html($settings['aptfe_pricing_currency_symbol'] . $settings['aptfe_pricing_original_price']); ?></span>
				<?php endif; ?>
				<span class="currency <?php echo esc_attr("currency-position-".$settings['aptfe_currency_position']); ?>"> 
					<?php echo esc_html($settings['aptfe_pricing_currency_symbol']); ?> 
				</span>
				<span class="price"> <?php echo esc_html((int) $intpart); ?> </span>
				<span class="freaction-part"> <?php echo esc_html((int) $fraction); ?> </span>
				<span class="period"> 
					<?php echo esc_html($settings['aptfe_pricing_period']); ?> 
				</span>
			</div>

			<?php if ($centerIconShow === 'yes'): ?>
				<div class="aptfe-center-icon">
					<?php
						Icons_Manager::render_icon( 
							$settings['aptfe_features_top_icon'], 
							[ 'class' => 'aptfe-features-top-icon', 'aria-hidden' => 'true' ]
						);
					?>
				</div>
			<?php endif; ?> 

			<div class="aptfe-features">
				<ul class="items">
					<?php foreach($settings['aptfe_features_list'] as $item) : ?>
						<li>
							<span>
								<?php 
									Icons_Manager::render_icon( $item['aptfe_features_selected_item_icon'],  [ 'class' => 'aptfe-features-icon', 'aria-hidden' => 'true' ],  );
								?>
							</span> 
						<?php echo esc_html($item['aptfe_features_item_text']); ?> </li>
					<?php endforeach; ?>
				</ul>
			</div>

			<?php if ($buttonShow === 'yes') : ?>
				<div class="aptfe-button-box">
					<a <?php $this->print_render_attribute_string( 'aptfe_render_button_attr' ); ?> type="button">
						<?php $this->print_unescaped_setting( 'aptfe_button_text' ); ?>
					</a>
				</div>	
			<?php endif; ?>

			<?php if ($additionalTextShow === 'yes') : ?>
				<div class="aptfe-additional-text">
					<p class="additional-text"><?php echo esc_html($settings['aptfe_additional_textarea']); ?> </p>
				</div>
			<?php endif; ?>

			<?php if ($ribbonShow === 'yes' ) : ?>
				<div class="ribbon ribbon-<?php echo esc_attr($settings['aptfe_ribbon_horizontal_position']); ?>">
					<p><?php echo esc_html($settings['aptfe_ribbon_title']); ?></p>
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
	protected function content_template() {}
}