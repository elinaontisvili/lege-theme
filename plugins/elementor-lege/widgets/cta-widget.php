<?php
/**
 * Elementor Connect CTA Widget
 * 
 * @package Elementor_Lege
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_CTA_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'cta_widget';
    }

    public function get_title(): string {
        return esc_html__( 'Lege CTA Widget', 'elementor-lege' );
    }

    public function get_icon(): string {
        return 'eicon-call-to-action';
    }

    public function get_categories(): array {
        return [ 'lege-widgets' ];
    }

    /* -------------------------------------------------
     * CONTROLS
     * ------------------------------------------------- */
    protected function register_controls(): void {

        /* =========================
         * CONTENT SECTION
         * ========================= */
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'cta_content',
            [
                'label' => esc_html__( 'CTA Content', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Contact us ...', 'elementor-lege' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'p'   => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'cta_button_text',
            [
                'label' => esc_html__( 'Button Text', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( 'Contact us', 'elementor-lege' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'cta_button_url',
            [
                'label' => esc_html__( 'Button URL', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [ 'active' => true ],
                'default' => [ 'url' => '#' ],
            ]
        );

        $this->end_controls_section();

        /* =========================
         * BACKGROUND SECTION
         * ========================= */
        $this->start_controls_section(
            'section_style_background',
            [
                'label' => esc_html__( 'Background', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'section_background',
                'types'    => [ 'classic', 'gradient' ], 
                'selector' => '{{WRAPPER}} .connect',
                'fields_options' => [
                    'background' => [
                        'default' => 'gradient',
                    ],
                    'color' => [
                        'default' => '#00ccff',
                    ],
                    'color_b' => [
                        'default' => '#00a2ff',
                    ],
                    'gradient_angle' => [
                        'default' => [
                            'unit' => 'deg',
                            'size' => 66,
                        ],
                    ],
                ],
            ]
        );

        /* Padding */
        $this->add_responsive_control(
            'section_padding',
            [
                'label' => esc_html__( 'Section Padding', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .connect' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 106,
                    'bottom' => 106,
                    'unit' => 'px',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
         * SIDE IMAGE SECTION
         * ========================= */
        $this->start_controls_section(
            'section_side_image',
            [
                'label' => esc_html__( 'Side Image', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'side_image_desktop',
            [
                'label' => esc_html__( 'Desktop Image', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'side_image_mobile',
            [
                'label' => esc_html__( 'Mobile Image', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_responsive_control(
            'hide_side_image',
            [
                'label' => esc_html__( 'Hide Side Image', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .connect__image-wrapper' => 'display:none;',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * DECOR IMAGE SECTION
        * ========================= */
        $this->start_controls_section(
            'section_decor_image',
            [
                'label' => esc_html__( 'Decor Image', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'decor_image',
            [
                'label' => esc_html__( 'Upload Decor Image', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'selectors' => [
                    '{{WRAPPER}} .connect__decor' => 'background-image: url("{{URL}}"); background-size: contain; background-repeat: no-repeat;',
                ],
            ]
        );

        $this->add_responsive_control(
            'decor_image_size',
            [
                'label' => esc_html__( 'Image Size (Width)', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 50, 'max' => 2000 ],
                    '%'  => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .connect__decor' => 'width: {{SIZE}}{{UNIT}}; aspect-ratio: 1 / 1; background-size: cover; height: auto;',
                ],
            ]
        );

        $this->end_controls_section();

        /*--------------------------------------------------------------
        # Style Controls
        --------------------------------------------------------------*/

        /* Cta text */
        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__( 'Heading', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cta_text_color',
            [
                'label'     => esc_html__( 'Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .connect__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'cta_text_typography',
                'selector' => '{{WRAPPER}} .connect__title',
            ]
        );

        /* Text alignment */
        $this->add_responsive_control(
            'cta_text_align',
            [
                'label' => esc_html__( 'Text Alignment', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementor-lege' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor-lege' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor-lege' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .connect__title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        /* CTA Margin - Primary */
        $this->add_responsive_control(
            'cta_margin',
            [
                'label' => esc_html__( 'Margin', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .connect__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* CTA Padding - Secondary */
        $this->add_responsive_control(
            'cta_padding',
            [
                'label' => esc_html__( 'Padding', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .connect__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* Text Max Width */
        $this->add_responsive_control(
            'cta_text_max_width',
            [
                'label' => esc_html__( 'Max Width', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 1200,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 635,
                ],
                'selectors' => [
                    '{{WRAPPER}} .connect__title' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* Button Section */
        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__( 'Button', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /* Base typography (normal text) */
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );

        /* Button width */
        $this->add_responsive_control(
            'button_width',
            [
                'label' => esc_html__( 'Width', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        /* Button padding */
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* Button border */
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );

        /* Button border radius */
        $this->add_control(
            'btn_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'top'      => '30',
                    'right'    => '30',
                    'bottom'   => '30',
                    'left'     => '30',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        /* Button Position Control (Button Alignment) */
        $this->add_responsive_control(
            'button_alignment',
            [
                'label' => esc_html__( 'Button Alignment', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'right',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementor-lege' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor-lege' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor-lege' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .connect__wrap' => 'text-align: {{VALUE}};',
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

        /* Hover text color */
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

        /* Text font weight, hover */
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

        /* Letter spacing on hover */
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
                    'size' => 0.04,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-hover-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        /* Padding / Margin */

        /* CTA Margin - Primary */
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
                    '{{WRAPPER}} .connect__btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* CTA Padding - Secondary */
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
        * Button Ring
        * ------------------------------------------------- */

        $this->add_control(
            'button_ring_color',
            [
                'label' => esc_html__( 'Ring Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-ring-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_ring_opacity',
            [
                'label' => esc_html__( 'Ring Opacity', 'elementor-lege' ),
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

        /* Content Wrapper Width */
        $this->start_controls_section(
            'section_content_wrapper',
            [
                'label' => esc_html__( 'Content Wrapper', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_wrap_width',
            [
                'label' => esc_html__( 'Content Width', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 1200,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 635,
                ],
                'selectors' => [
                    '{{WRAPPER}} .connect__wrap' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
                ],
            ]
        );

        $this->end_controls_section();
    }
    
    /* -------------------------------------------------
     * RENDER
     * ------------------------------------------------- */
    protected function render(): void {

        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['cta_button_url']['url'] ) ) {
            $this->add_link_attributes( 'cta_button_url', $settings['cta_button_url'] );
        }

        $title_tag = $settings['title_tag'];
        ?>

        <section class="connect">
            <?php if ( ! empty( $settings['decor_image']['url'] ) ) : ?>
                <div class="connect__decor"></div>
            <?php endif; ?>

            <div class="wrapper">

                <div class="connect__wrap">

                    <?php if ( ! empty( $settings['cta_content'] ) ) : ?>
                        <<?php echo esc_attr( $title_tag ); ?> class="connect__title">
                            <?php echo wp_kses_post( $settings['cta_content'] ); ?>
                        </<?php echo esc_attr( $title_tag ); ?>>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['cta_button_text'] ) ) : ?>
                        <a
                            <?php echo $this->get_render_attribute_string( 'cta_button_url' ); ?>
                            class="connect__btn lege-btn btn--default popup-link"
                            data-content="<?php echo esc_attr( $settings['cta_button_text'] ); ?>"
                        >
                            <?php echo esc_html( $settings['cta_button_text'] ); ?>
                        </a>
                    <?php endif; ?>

                </div>

                <?php if ( ! empty( $settings['side_image_desktop']['url'] ) ) : ?>
                    <div class="connect__image-wrapper connect__img">

                        <picture>

                            <?php if ( ! empty( $settings['side_image_mobile']['url'] ) ) : ?>
                                <source 
                                    media="(max-width: 992px)"
                                    srcset="<?php echo esc_url( $settings['side_image_mobile']['url'] ); ?>">
                            <?php endif; ?>

                            <img 
                                class="connect__img__img"
                                src="<?php echo esc_url( $settings['side_image_desktop']['url'] ); ?>"
                                alt=""
                            >

                        </picture>

                    </div>
                <?php endif; ?>

            </div>

        </section>

        <?php
    }

    /* -------------------------------------------------
     * EDITOR PREVIEW
     * ------------------------------------------------- */
    protected function content_template(): void {
    ?>
        <#
        var titleTag = settings.title_tag;
        #>

        <section class="connect">
            <section class="connect">
                
            <div class="connect__decor"></div>

            <div class="wrapper">

                <div class="connect__wrap">

                    <# if ( settings.cta_content ) { #>
                        <{{ titleTag }} class="connect__title">
                            {{{ settings.cta_content }}}
                        </{{ titleTag }}>
                    <# } #>

                    <# if ( settings.cta_button_text ) { #>
                        <a 
                            href="{{ settings.cta_button_url.url || '#' }}"
                            class="connect__btn lege-btn btn--default popup-link"
                            data-content="{{ settings.cta_button_text }}">
                            {{ settings.cta_button_text }}
                        </a>
                    <# } #>

                </div>

                <# if ( settings.side_image_desktop && settings.side_image_desktop.url ) { #>
                    <div class="connect__image-wrapper connect__img">

                        <picture>

                            <# if ( settings.side_image_mobile && settings.side_image_mobile.url ) { #>
                                <source media="(max-width: 992px)" srcset="{{ settings.side_image_mobile.url }}">
                            <# } #>

                            <img class="connect__img_img" src="{{ settings.side_image_desktop.url }}" alt="">

                        </picture>

                    </div>
                <# } #>

            </div>
        </section>
    <?php
    }
}
