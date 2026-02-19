<?php 
/**
 * Elementor Button Widget
 * 
 * @package Elementor_Lege
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Lege_Button extends \Elementor\Widget_Base {

    public function get_name() {
        return 'lege_button';
    }

    public function get_title() {
        return esc_html__( 'Lege Button', 'elementor-lege' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'lege-widgets' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content',
            [ 'label' => esc_html__( 'Content', 'elementor-lege' ) ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Click me', 'elementor-lege' ),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::URL,
            ]
        );

        $this->end_controls_section();

        /*--------------------------------------------------------------
        # Style Controls
        --------------------------------------------------------------*/

        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__( 'Button', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /* Normal text */
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .lege-btn',
                'fields_options' => [
                    'font_weight' => [
                        'default' => '600',
                    ],
                ],
            ]
        );

        /* Width */
        $this->add_responsive_control(
            'button_width',
            [
                'label' => esc_html__( 'Width', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 182,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        /* Padding */
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 12,
					'right' => 12,
					'bottom' => 12,
					'left' => 12,
					'unit' => 'px',
					'isLinked' => false,
				],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* Border */
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );

        /* Border radius */
        $this->add_control(
            'btn_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'top'      => '50',
                    'right'    => '50',
                    'bottom'   => '50',
                    'left'     => '50',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* -------------------------------------------------
        * Normal / Hover Tabs
        * ------------------------------------------------- */
        $this->start_controls_tabs( 'cta_button_tabs' );

        /* NORMAL */
        $this->start_controls_tab(
            'button_tab_normal',
            [ 'label' => esc_html__( 'Normal', 'elementor-lege' ) ]
        );

        /* Text color */
        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-text: {{VALUE}};',
                ],
            ]
        );

        /* Background */
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_bg',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );
        
        /* Button shadow */
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );
        $this->end_controls_tab();

        /* HOVER */
        $this->start_controls_tab(
            'cta_button_hover',
            [ 'label' => esc_html__( 'Hover', 'elementor-lege' ) ]
        );

        /* Text color */
        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-hover-text: {{VALUE}};',
                ],
            ]
        );

        /* Font weight */
        $this->add_control(
            'button_hover_font_weight',
            [
                'label' => esc_html__( 'Font Weight', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '500',
                'options' => [
                    '400' => '400',
                    '500' => '500',
                    '600' => '600',
                    '700' => '700',
                ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-hover-weight: {{VALUE}};',
                ],
            ]
        );

        /* Letter spacing */
        $this->add_responsive_control(
            'button_hover_letter_spacing',
            [
                'label' => esc_html__( 'Letter Spacing', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 1.0,
                        'step' => 0.01,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1.0,
                        'step' => 0.01,
                    ],
                ],
                'default' => [
                    'unit' => 'em',
                    'size' => 0.02,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-hover-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        /* Padding / Margin */

        /* Margin - Primary */
        $this->add_responsive_control(
            'btn_outside_margin',
            [
                'label' => esc_html__( 'Margin', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => '37',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* Padding - Secondary */
        $this->add_responsive_control(
            'btn_outside_padding',
            [
                'label' => esc_html__( 'Padding', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* -------------------------------------------------
        * Border
        * ------------------------------------------------- */

        /* Border color */
        $this->add_control(
            'button_ring_color',
            [
                'label' => esc_html__( 'Border Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-ring-color: {{VALUE}};',
                ],
            ]
        );

        /* Border opacity */
        $this->add_control(
            'button_ring_opacity',
            [
                'label' => esc_html__( 'Border Opacity', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.05,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-ring-opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_section(); 

        // Style tab end

    }

    /*--------------------------------------------------------------
    # Render
    --------------------------------------------------------------*/

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'link', $settings['link'] );
        }
        ?>
        <a
            <?php echo $this->get_render_attribute_string( 'link' ); ?>
            class="lege-btn"
            data-content="<?php echo esc_attr( $settings['text'] ); ?>"
        >
            <?php echo esc_html( $settings['text'] ); ?>
        </a>
        <?php
    }
}
