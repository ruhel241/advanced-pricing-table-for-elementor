<?php

namespace APTFE\Widgets;
 
use Elementor\Controls_Manager;
use APTFEPRO\Services\APTFEWidgetPro; 

/**
 * Elementor pricing Widget.
 *
 * @since  1.0.5
 */
class AdvancedPricingWidgetStyles {

    public function allStyles($that) {
       $that->start_controls_section(
			'aptfe_section_pricing_table_style',
			[
				'label' => esc_html__( 'Pricing Table', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				// 'show_label' => false
			]
		);
            if (defined('APTFE_PRO')) {
                (new APTFEWidgetPro)->pricingTableStyles($that);
            } else {
                $that->add_control(
                    'aptfe_important_notice_pricing_table_style',
                    [
                        'type' 		 => Controls_Manager::RAW_HTML,
                        'raw' 		 => $that->getProNotice('pricing-table-styles.png'),
                    ]
                );
            }	
		$that->end_controls_section();

		$that->start_controls_section(
			'aptfe_section_header_style',
			[
				'label' => esc_html__( 'Header', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				// 'show_label' => false
			]
		);
            if (defined('APTFE_PRO')) {
                (new APTFEWidgetPro)->headerStyles($that);
            } else {
                $that->add_control(
                    'aptfe_important_notice_header_style',
                    [
                        'type' 		 => Controls_Manager::RAW_HTML,
                        'raw' 		 => $that->getProNotice('header-styles.png'),
                    ]
                );
            }		
		$that->end_controls_section();

		$that->start_controls_section(
			'aptfe_section_pricing_style',
			[
				'label' => esc_html__( 'Pricing', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
            if (defined('APTFE_PRO')) {
                (new APTFEWidgetPro)->pricingStyles($that);
            } else {
                $that->add_control(
                    'aptfe_important_notice_pricing_style',
                    [
                        'type' 		 => Controls_Manager::RAW_HTML,
                        'raw' 		 => $that->getProNotice('pricing-styles.png'),
                    ]
                );
            }	
		$that->end_controls_section();

		$that->start_controls_section(
			'section_center_icon_style',
			[
				'label' => esc_html__( 'Center Icon', 'advanced-pricing-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => ['aptfe_center_icon_show' => 'yes']
			]
		);
            if (defined('APTFE_PRO')) {
                (new APTFEWidgetPro)->centerIconStyles($that);
            } else {
                $that->add_control(
                    'aptfe_important_notice_center_icon_style',
                    [
                        'type' 		 => Controls_Manager::RAW_HTML,
                        'raw' 		 => $that->getProNotice('center-icon-styles.png'),
                    ]
                );
            }
		$that->end_controls_section();

		// Features Lists Style
		$that->start_controls_section(
			'section_features_list_style',
			array_merge(
                [
                    'label' => esc_html__( 'Features', 'advanced-pricing-table-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                    'show_label' => false,
                ],
                defined( 'APTFE_PRO' ) ? [
                    'condition' => [
                        'aptfe_features_show' => 'yes',
                    ],
                ] : []
            )
		);
            if (defined('APTFE_PRO')) {
                (new APTFEWidgetPro)->featuresStyles($that);
            } else {
                $that->add_control(
                    'aptfe_important_notice_features_style',
                    [
                        'type' 		 => Controls_Manager::RAW_HTML,
                        'raw' 		 => $that->getProNotice('features-styles.png'),
                    ]
                );
            }
        $that->end_controls_section();

		$that->start_controls_section(
			'section_button_style',
			array_merge(
                [
                    'label' => esc_html__( 'Button', 'advanced-pricing-table-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                    'show_label' => false,
                ],
                defined( 'APTFE_PRO' ) ? [
                    'condition' => [
                        'aptfe_button_show' => 'yes',
                    ],
                ] : []
            )
		);
            if (defined('APTFE_PRO')) {
                (new APTFEWidgetPro)->buttonStyles($that);
            } else {
                $that->add_control(
                    'aptfe_important_notice_button_style',
                    [
                        'type' 		 => Controls_Manager::RAW_HTML,
                        'raw' 		 => $that->getProNotice('button-styles.png'),
                    ]
                );
            }
        $that->end_controls_section();

		// Ribbon Style
		$that->start_controls_section(
			'aptfe_section_ribbon_style',
			array_merge(
                [
                    'label' => esc_html__( 'Ribbon', 'advanced-pricing-table-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ],
                defined( 'APTFE_PRO' ) ? [
                    'condition' => [
                        'aptfe_ribbon_show' => 'yes',
                    ],
                ] : [] 
            )
		);
            if (defined('APTFE_PRO')) {
                (new APTFEWidgetPro)->ribbonStyles($that);
            } else {
                $that->add_control(
                    'aptfe_important_notice_ribbon_style',
                    [
                        'type' 		 => Controls_Manager::RAW_HTML,
                        'raw' 		 => $that->getProNotice('ribbon-styles.png'),
                    ]
                );
            }
		$that->end_controls_section();
    }
}