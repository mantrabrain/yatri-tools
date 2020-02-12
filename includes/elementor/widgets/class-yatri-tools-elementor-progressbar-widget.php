<?php
namespace Yatri_Tools_Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use \Elementor\Repeater;
use \Elementor\Scheme_Color;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Yatri_Tools_Elementor_Progressbar_widget extends Widget_Base {
	
	public function get_name() {
		return 'yte-progressbar';
	}
	
	public function get_title() {
		return __( 'Progress Bar', 'yatri-tools' );
	}
	
	public function get_icon() {
		return 'fas fa-chart-line';
	}

	public function get_categories() {
		return [ YATRI_TOOLS_ELEMENTOR_CATEGORY ];
	}

	public function get_style_depends() {
		return [ 'yte-progressbar' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Yatri Progress Bar', 'yatri-tools' ),
			]
		);

			$this->add_control(
				'yte_progressbar_list',
				[
					'label' => __( 'Progress Bar', 'yatri-tools' ),
					'type' => Controls_Manager::REPEATER,
					'default' => [
						[
							'yte_progressbar_title'         => __('Graphic Design','yatri-tools'),
							'yte_progressbar_value'         => '93',
						],
						[
							'yte_progressbar_title'         => __('Web Design','yatri-tools'),
							'yte_progressbar_value'         => '84',
						],
						[
							'yte_progressbar_title'         => __('Photoshop','yatri-tools'),
							'yte_progressbar_value'         => '89',

						],
					],

					'fields' => [
						[
							'name'        => 'yte_progressbar_title',
							'label'       => __( 'Title', 'yatri-tools' ),
							'type'        => Controls_Manager::TEXT,
							'default'     => __( 'Item' , 'yatri-tools' ),
						],

						[
							'name' => 'yte_progressbar_value',
							'label' => __( 'Progress Bar Value', 'yatri-tools' ),
							'type' => Controls_Manager::SLIDER,
							'range' => [
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => '%',
								'size' => 50,
							],
							'selectors' => [
								'{{WRAPPER}} .yatri-tools-elementor-progressbar {{CURRENT_ITEM}} > .progressbar' => 'width: {{SIZE}}{{UNIT}};',
							]
						],

						[
							'name' => 'yte_progressbar_color',
							'label' => __( 'Progress Bar Color', 'yatri-tools' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .yatri-tools-elementor-progressbar .progress-bar{{CURRENT_ITEM}} > .progressbar' => 'background: {{VALUE}};',
							],
						],
						
						[
							'name' => 'yte_progressbar_bgcolor',
							'label' => __( 'Background Color', 'yatri-tools' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .yatri-tools-elementor-progressbar .progress-bar{{CURRENT_ITEM}}' => 'background: {{VALUE}};',
							],
						],
					],
					'title_field' => '{{{ yte_progressbar_title }}}',
				]
			);

        $this->end_controls_section();
        
        // ProgressBar Styling
        $this->start_controls_section(
			'progressbar_style',
			[
				'label' => __( 'Progress Bar Styling', 'yatri-tools' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'bar_type',
				[
					'label' => __( 'Bar Type', 'yatri-tools' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'  => __( 'Default', 'yatri-tools' ),
						'striped' => __( 'Striped', 'yatri-tools' ),
						'animated' => __( 'Animated Striped', 'yatri-tools' ),
					],
				]
			);

			$this->add_control(
				'yte_title_position',
				[
					'label' => __( 'Title Position', 'yatri-tools' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'outside',
					'options' => [
						'inside'  => __( 'Inside', 'yatri-tools' ),
						'outside' => __( 'Outside', 'yatri-tools' ),
					],
				]
			);

			$this->add_control(
				'yte_show_percentage',
				[
					'label' => __( 'Show percentage', 'yatri-tools' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'On', 'yatri-tools' ),
					'label_off' => __( 'Off', 'yatri-tools' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
			
			$this->add_control(
				'yte_percentage_position',
				[
					'label' => __( 'Percentage Position', 'yatri-tools' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'outside',
					'options' => [
						'inside'  => __( 'Inside', 'yatri-tools' ),
						'outside' => __( 'Outside', 'yatri-tools' ),
					],
					'condition' => [
						'yte_show_percentage' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'yte_progressbar_size',
				[
					'label' => __( 'Size', 'yatri-tools' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .progress-bar' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'yte_progressbar_spacing',
				[
					'label' => __( 'Spacing', 'yatri-tools' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 5,
					],
					'selectors' => [
						'{{WRAPPER}} .yatri-tools-elementor-progressbar .progress-bar:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
                'yte_progressbar_global_color',
                [
                    'label' => __( 'Color', 'yatri-tools' ),
						  'type' => Controls_Manager::COLOR,
						  'default' => '#4965fb',
					'selectors' => [
						'{{WRAPPER}} .yatri-tools-elementor-progressbar .progress-bar .progressbar' => 'background: {{VALUE}};',
					],
                ]
			);
			
			$this->add_control(
                'yte_progressbar_bg_color',
                [
                    'label' => __( 'Background Color', 'yatri-tools' ),
						  'type' => Controls_Manager::COLOR,
						  'default' => '#e8eaf0',
                    'selectors' => [
                        '{{WRAPPER}} .yatri-tools-elementor-progressbar .progress-bar' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'border_type',
					'label' => __( 'Border', 'yatri-tools' ),
					'selector' => '{{WRAPPER}} .yatri-tools-elementor-progressbar .progress-bar',
				]
			);

			$this->add_control(
                'border_radius',
                [
                    'label' => __( 'Border Radius', 'yatri-tools' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .yatri-tools-elementor-progressbar .progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
			);
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'bar_shadow',
                    'label' => __( 'Bar Shadow', 'yatri-tools' ),
                    'selector' => '{{WRAPPER}} .yatri-tools-elementor-progressbar .progress-bar',
                ]
            );

		$this->end_controls_section();

		// Text Styling
        $this->start_controls_section(
			'progressbar_text_style',
			[
				'label' => __( 'Text Styling', 'yatri-tools' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'text_color',
				[
					'label' => __( 'Text Color', 'yatri-tools' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#333',
					'selectors' => [
						'{{WRAPPER}} .yatri-tools-elementor-progressbar' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
                    'name' => 'yatri_tools_elementor_title_typography',
                    'label' => __( 'Typography', 'yatri-tools' ),
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .yatri-tools-elementor-progressbar .progressbar-details *',
				]
            );

        $this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();

        $animation = false;
        $striped = false;
        $percentage = false;

        if ( $settings['bar_type'] === 'animated' ) {
			$animation = true;
			$striped = true;
        }
        if ( $settings['bar_type'] === 'striped' ) {
            $striped = true;
        }
        if ( $settings['yte_show_percentage'] === 'yes' ) {
            $percentage = true;
        }

        echo '<div class="yatri-tools-elementor-progressbar">';
        foreach ( $settings['yte_progressbar_list'] as $progressbar ) :

			if ( $settings['yte_title_position'] === 'outside' || $settings['yte_percentage_position'] === 'outside' ) {

				echo '<div class="progressbar-details">';

					if ( $settings['yte_title_position'] === 'outside' ) {
						echo '<div class="progressbar-title">'. $progressbar['yte_progressbar_title'] . '</div>';
					}

					if ( $settings['yte_percentage_position'] === 'outside' ) {
						echo '<div class="progressbar-percentage">' . ( ($percentage===true) ? $progressbar['yte_progressbar_value']['size'] . $progressbar['yte_progressbar_value']['unit'] .'' : '' ) .'</div>';
					}

				echo '</div>';

			}

            echo '<div class="progress-bar'. (($animation===true) ? ' animated' : '') .''. (($striped===true) ? ' striped' : '') .' elementor-repeater-item-'. $progressbar['_id'] . '">';

			echo '<div class="progressbar">';

				if ( $settings['yte_title_position'] === 'inside' || $settings['yte_percentage_position'] === 'inside' ) {
					
					echo '<div class="progressbar-details">';

					if ( $settings['yte_title_position'] === 'inside' ) {
						echo '<div class="progressbar-title">'. $progressbar['yte_progressbar_title'] . '</div>';
					}
	
					if ( $settings['yte_percentage_position'] === 'inside' ) {
						echo '<div class="progressbar-percentage">' . ( ($percentage===true) ? $progressbar['yte_progressbar_value']['size'] . $progressbar['yte_progressbar_value']['unit'] .'' : '' ) .'</div>';
					}

					echo '</div>';

				}
			
            echo '</div>';	# .progressbar
            echo '</div>';	# .progress-bar
        endforeach;
        echo '</div>'; # .yatri-tools-elementor-progressbar
	}
	
	protected function _content_template() {
	}
}
