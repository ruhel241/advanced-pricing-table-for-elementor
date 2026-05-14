<?php

namespace APTFE\Widgets;
 
use Elementor\Repeater;
use Elementor\Controls_Manager;
use APTFEPRO\Services\APTFEWidgetPro; 

/**
 * Elementor pricing Widget.
 *
 * @since  1.0.0
 */
class AdvancedPricingWidgetSettings {

    public function allSettings($that) {
        // header section
		$that->start_controls_section(
			'aptfe_content_section',
			array_merge(
                [
                    'label' => esc_html__( 'Header', 'advanced-pricing-table-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ],
                defined( 'APTFE_PRO' ) ? [
                    'condition' => [
                        'aptfe_header_show' => 'yes',
                    ],
                ] : []
            )
		);
			$that->add_control(
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
			$that->add_control(
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
			$that->add_control(
				'aptfe_header_description',
				[
					'label' => esc_html__( 'Sub Title', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					// 'rows' => 3,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'Type your description here', 'advanced-pricing-table-for-elementor' ),
				]
			);	
		$that->end_controls_section();

		// Pricing
		$that->start_controls_section(
			'aptfe_pricing_section',
			array_merge(
                [
                    'label' => esc_html__( 'Pricing', 'advanced-pricing-table-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ],
                defined( 'APTFE_PRO' ) ? [
                    'condition' => [
                        'aptfe_pricing_show' => 'yes',
                    ],
                ] : []
            )
		);
			$that->add_control(
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
						'Rs.' => esc_html__( 'Rupee', 'advanced-pricing-table-for-elementor' ),
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
			$that->add_control(
				'aptfe_pricing_currency_symbol_custom',
				[
					'label' => esc_html__( 'Custom Symbol', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'aptfe_pricing_currency_symbol' => 'custom',
					],
				]
			);
			$that->add_control(
				'aptfe_pricing_price',
				[
					'label' => esc_html__( 'Price', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => '39',
					'dynamic' => [
						'active' => true,
					]
				]
			);
			$that->add_control(
				'aptfe_pricing_currency_format',
				[
					'label' => esc_html__( 'Currency Format', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => '1,234.56 (Default)',
						',' => '1.234,56',
					]
				]
			);
			$that->add_control(
				'aptfe_pricing_sale',
				[
					'label' => esc_html__( 'Sale', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'advanced-pricing-table-for-elementor' ),
					'label_off' => esc_html__( 'Off', 'advanced-pricing-table-for-elementor' ),
					'default' => '',
				]
			);
			$that->add_control(
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
			$that->add_control(
				'aptfe_pricing_additional_text',
				[
					'label' => esc_html__( 'Additional text', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => '',
				]
			);
			$that->add_control(
				'aptfe_pricing_period',
				[
					'label' => esc_html__( 'Period', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( '/Monthly', 'advanced-pricing-table-for-elementor' ),
				]
			);
		$that->end_controls_section();

		// Features lists
		$that->start_controls_section(
			'aptfe_features_section',
			array_merge(
                [
                    'label' => esc_html__( 'Features', 'advanced-pricing-table-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ],
                defined( 'APTFE_PRO' ) ? [
                    'condition' => [
                        'aptfe_features_show' => 'yes',
                    ],
                ] : []
            )
		);
			$that->add_control(
				'aptfe_features_heading_text',
				[
					'label' => esc_html__( 'Features Heading', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => '',
				]
			);
			
			$repeater = new Repeater();
			/**
			 * TEXT FIELD
			 */
			$repeater->add_control(
				'aptfe_features_item_text',
				[
					'label' => esc_html__( 'Text', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'List Item', 'advanced-pricing-table-for-elementor' ),
				]
			);
			/**
			 * ICON settings
			 */
			if (defined('APTFE_PRO')) {
                (new APTFEWidgetPro)->featuresIconSetting($repeater);
            } else {
                $repeater->add_control(
                    'aptfe_important_notice_features_icon_settings',
                    [
                        'type' 		 => Controls_Manager::RAW_HTML,
                        'raw' 		 => $that->getProNotice('features-icon-settings.png'),
                    ]
                );
            }	
			
			/**
			 * REPEATER MAIN CONTROL
			 */
			$that->add_control(
				'aptfe_features_list',
				[
					'label' => esc_html__( 'Features List', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'aptfe_features_item_text' => esc_html__( '50GB Disk Space', 'advanced-pricing-table-for-elementor' ),
						],
						[
							'aptfe_features_item_text' => esc_html__( '50 Email Account', 'advanced-pricing-table-for-elementor' ),
						],
						[
							'aptfe_features_item_text' => esc_html__( '50GB Monthly Bandwidth', 'advanced-pricing-table-for-elementor' ),
						],
						[
							'aptfe_features_item_text' => esc_html__( '50 Domians', 'advanced-pricing-table-for-elementor' ),
						],
						[
							'aptfe_features_item_text' => esc_html__( 'Unlimited Subdomains', 'advanced-pricing-table-for-elementor' ),
						],
					],
					'title_field' => '{{{ aptfe_features_item_text }}}',
				]
			);
		$that->end_controls_section();

		// center Icon
		$that->start_controls_section(
			'aptfe_center_icon_section',
			array_merge(
                [
                    'label' => esc_html__( 'Center Icon', 'advanced-pricing-table-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ],
                defined( 'APTFE_PRO' ) ? [
                    'condition' => [
                        'aptfe_center_icon_show' => 'yes',
                    ],
                ] : []
            )
		);	
            if (defined('APTFE_PRO')) {
                (new APTFEWidgetPro)->centerIconSetting($that);
            } else {
                $that->add_control(
                    'aptfe_important_notice_center_icon_settings',
                    [
                        'type' 		 => Controls_Manager::RAW_HTML,
                        'raw' 		 => $that->getProNotice('center-icon-settings.png'),
                    ]
                );
            }		
		$that->end_controls_section();

		// Button
		$that->start_controls_section(
            'aptfe_button_section',
            array_merge(
                [
                    'label' => esc_html__( 'Button', 'advanced-pricing-table-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ],
                defined( 'APTFE_PRO' ) ? [
                    'condition' => [
                        'aptfe_button_show' => 'yes',
                    ],
                ] : []
            )
        );
			$that->add_control(
				'aptfe_button_text',
				[
					'label' => esc_html__( 'Button Text', 'advanced-pricing-table-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Explore Package', 'advanced-pricing-table-for-elementor' ),
					'dynamic' => [
						'active' => true,
					]
				]
			);
			$that->add_control(
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
		$that->end_controls_section();

		//  Ribbon options
		$that->start_controls_section(
			'aptfe_ribbon_section',
			array_merge(
                [
                    'label' => esc_html__( 'Ribbon', 'advanced-pricing-table-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ],
                defined( 'APTFE_PRO' ) ? [
                    'condition' => [
                        'aptfe_ribbon_show' => 'yes',
                    ],
                ] : []
            )
		);	

        if (defined('APTFE_PRO')) {
            (new APTFEWidgetPro)->ribbonSettings($that);
        } else {
            $that->add_control(
                'aptfe_important_notice_ribbon_settings',
                [
                    'type' 		 => Controls_Manager::RAW_HTML,
                    'raw' 		 => $that->getProNotice('ribbon-settings.png'),
                ]
            );
        } 
			
		$that->end_controls_section();

		//  Additional Text
		$that->start_controls_section(
			'aptfe_additional_text_section',
			array_merge(
                [
                    'label' => esc_html__( 'Additional Text', 'advanced-pricing-table-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ],
                defined( 'APTFE_PRO' ) ? [
                    'condition' => [
                        'aptfe_additional_text_show' => 'yes',
                    ],
                ] : []
            )
		);
            if (defined('APTFE_PRO')) {
                (new APTFEWidgetPro)->additionalText($that);
            } else {
                $that->add_control(
                    'aptfe_important_notice_additional_text',
                    [
                        'type' 		 => Controls_Manager::RAW_HTML,
                        'raw' 		 => $that->getProNotice('additional-text.png'),
                    ]
                );
            } 
		$that->end_controls_section();

		// Additional options
		$that->start_controls_section(
			'aptfe_section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
			if (defined('APTFE_PRO')) {
				(new APTFEWidgetPro)->additionalOptionsMore($that);
			} else {
				$that->add_control(
					'aptfe_important_notice_additional_options',
					[
						'type' 		 => Controls_Manager::RAW_HTML,
						'raw' 		 => $that->getProNotice('additional-options.png'),
					]
				);
			} 
		$that->end_controls_section();
    }
}