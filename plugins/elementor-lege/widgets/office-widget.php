<?php
/**
 * Elementor Offices Widget
 * 
 * @package Elementor_Lege
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Office_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'office_widget';
    }

    public function get_title(): string {
        return esc_html__( 'Lege Offices Widget', 'elementor-lege' );
    }

    public function get_icon(): string {
        return 'eicon-google-maps';
    }

    public function get_categories(): array {
        return [ 'lege-widgets' ];
    }

    public function get_keywords(): array {
        return ['offices'];
    }

    protected function register_controls(): void {

    /*--------------------------------------------------------------
    # Controls
    --------------------------------------------------------------*/
        $this->start_controls_section(
            'of_section_content',
            [
                'label' => esc_html__( 'Content', 'elementor-lege' ),
            ]
        );

        $this->add_control(
            'of_title_span',
            [
                'label' => __( 'Subheading', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => __( 'Our offices are located at', 'elementor-lege' ),
            ]
        );

        $this->add_control(
            'of_title',
            [
                'label' => __( 'Heading', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => __( 'all of Russia', 'elementor-lege' ),
            ]
        );

        $this->add_control(
            'of_title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'div' => 'div',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_control(
            'of_map_image',
            [
                'label' => esc_html__( 'Map Image', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::MEDIA, 
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .offices' => '--offices-map-image: url("{{URL}}");',
                ],
            ]
        );

        $this->add_responsive_control(
            'of_map_background_size_control',
            [
                'label'     => esc_html__( 'Map Image Size', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'contain',
                'options'   => [
                    'cover'   => esc_html__( 'Cover', 'elementor-lege' ),
                    'contain' => esc_html__( 'Contain', 'elementor-lege' ),
                    'auto'    => esc_html__( 'Auto', 'elementor-lege' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .offices .map' => 'background-size: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'of_map_margin_top_control',
            [
                'label'      => esc_html__( 'Desktop Map Offset', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [ 'min' => -200, 'max' => 100 ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -74,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .offices .map' => '--map-desktop-offset: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*--------------------------------------------------------------
        # Style Controls
        --------------------------------------------------------------*/
        $this->start_controls_section(
        'of_section_style',
        [
            'label' => esc_html__( 'Content', 'elementor-lege' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
        );

        $this->add_control(
            'of_title_color',
            [
                'label'     => esc_html__( 'Heading Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offices__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'of_title_typography',
                'label'    => esc_html__( 'Heading Typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .offices__title',
            ]
        );

        $this->add_responsive_control(
            'of_title_margin',
            [
                'label'      => esc_html__( 'Margin', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .offices__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'of_title_padding',
            [
                'label'      => esc_html__( 'Padding', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .offices__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * MAP STYLING
        * ========================= */

        /*--------------------------------------------------------------
        # Marker
        --------------------------------------------------------------*/
        $this->start_controls_section(
            'of_section_marker_style',
            [
                'label' => esc_html__( 'Map Markers', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Color
        $this->add_control(
            'of_marker_color',
            [
                'label' => esc_html__( 'Border Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offices' => '--office-marker-border-color: {{VALUE}};',
                ],
            ]
        );

        // Background
        $this->add_control(
            'of_marker_bg',
            [
                'label'     => esc_html__( 'Background Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .offices' => '--office-marker-bg: {{VALUE}};',
                ],
            ]
        );

        // Hover gradient
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'of_marker_hover_bg',
                'label' => esc_html__( 'Marker Hover Gradient', 'elementor-lege' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .address:hover:before',
            ]
        );

        // Hover shadow
        $this->add_control(
            'of_marker_hover_color',
            [
                'label'     => esc_html__( 'Hover Shadow Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => 'rgba(0, 163, 255, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .offices' => '--office-marker-hover-shadow: 0 0 15px {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*--------------------------------------------------------------
        # Tooltip
        --------------------------------------------------------------*/
        $this->start_controls_section(
            'of_section_tooltip_style',
            [
                'label' => esc_html__( 'Office Tooltips', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'of_office_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .address__text span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'of_office_title_typography',
                'label'    => esc_html__( 'Title Typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .address__text span',
            ]
        );

        $this->add_control(
            'of_office_text_color',
            [
                'label'     => esc_html__( 'Description Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .address__text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'of_office_text_typography',
                'label'    => esc_html__( 'Description Typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .address__text',
            ]
        );

        // Responsive Text Width Control
        $this->add_responsive_control(
            'of_text_width',
            [
                'label'      => esc_html__( 'Content Width', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range'      => [
                    'px' => [ 'min' => 150, 'max' => 500 ],
                    '%'  => [ 'min' => 20, 'max' => 100 ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .address__text' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'of_tooltip_padding',
            [
                'label'      => esc_html__( 'Padding', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .address__descr' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Image Overlay Color 
        $this->add_control(
            'of_tooltip_img_overlay_color',
            [
                'label'     => esc_html__( 'Image Overlay Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offices' => '--blue-noise-overlay-bg: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'of_tooltip_bg',
            [
                'label'     => esc_html__( 'Background Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .offices' => '--office-tooltip-bg: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'of_tooltip_shadow_color',
            [
                'label'     => esc_html__( 'Shadow Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => 'rgba(206, 218, 228, 0.6)',
                'selectors' => [
                    '{{WRAPPER}} .offices' => '--office-tooltip-shadow: 0 5px 30px {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // End style tab

    }

    /*--------------------------------------------------------------
    # Content Controls
    --------------------------------------------------------------*/
    protected function render(): void {
        $settings = $this->get_settings_for_display();
        $title_tag = \Elementor\Utils::validate_html_tag( $settings['of_title_tag'] ?? 'h2' );

        $office_query = new WP_Query([
            'post_type'      => 'offices',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        ]);

        if ( ! $office_query->have_posts() ) {
            return;
        }
        ?>

        <section class="offices">
            <div class="wrapper">

                <?php if ( ! empty( $settings['of_title_span'] ) || ! empty( $settings['of_title'] ) ) : ?>
                    <<?php echo $title_tag; ?> class="offices__title secondary-title">
                        <?php if ( ! empty( $settings['of_title_span'] ) ) : ?>
                            <span><?php echo esc_html( $settings['of_title_span'] ); ?></span><br>
                        <?php endif; ?>
                        <?php echo esc_html( $settings['of_title'] ); ?>
                    </<?php echo $title_tag; ?>>
                <?php endif; ?>

                <div class="map">
                    <?php 
                    $i = 1;
                    while ( $office_query->have_posts() ) : $office_query->the_post();
                        $post_id = get_the_ID();
                        $image_url = get_the_post_thumbnail_url( $post_id, 'large' );
                    ?>
                        <div class="address address_0<?php echo $i; ?>">
                            <div class="address__descr">
                                <?php if ( $image_url ) : ?>
                                    <div class="address__img blue-noise">
                                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title_attribute(); ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="address__text">
                                    <span><?php the_title(); ?></span>
                                    <?php the_content(); ?>
                                </div>

                            </div>
                        </div>
                    <?php 
                        $i++;
                    endwhile; 
                    wp_reset_postdata(); 
                    ?>
                </div>
            </div>
        </section>
        <?php
    }

    protected function content_template(): void {
        ?>
        <#
        var titleTag = elementor.helpers.validateHTMLTag( settings.of_title_tag ) || 'h2';
        #>

        <section class="offices">
            <div class="wrapper">

            <# if ( settings.of_title_span || settings.of_title ) { #>
                <{{ titleTag }} class="offices__title secondary-title">
                    <# if ( settings.of_title_span ) { #>
                        <span>{{ settings.of_title_span }}</span><br>
                    <# } #>
                    {{ settings.of_title }}
                </{{ titleTag }}>
            <# } #>  
                
                <div class="map">
                    <# for ( let i = 0; i < 3; i++ ) { #>
                    <div class="address address_0{{ i+1 }}">
                        <div class="address__descr">
                            <div class="address__img blue-noise">
                                <img src="<?php echo \Elementor\Utils::get_placeholder_image_src(); ?>" alt="Placeholder">
                            </div>
                            <p class="address__text">
                                <span>Office Title</span>
                                Address and description here
                            </p>
                        </div>
                    </div>
                    <# } #>
                </div>
            </div>
        </section>
        <?php
    }
}
