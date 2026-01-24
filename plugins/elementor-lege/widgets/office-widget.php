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
        return esc_html__( 'Office Widget', 'elementor-lege' );
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

        // Content Tab
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'elementor-lege' ),
            ]
        );

        $this->add_control(
            'title_span',
            [
                'label' => __( 'Section Title Span', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Наши офисы расположены по', 'elementor-lege' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Section Title', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'всей России', 'elementor-lege' ),
            ]
        );

        $this->end_controls_section();

        // Styles 
        $this->start_controls_section(
        'section_style',
        [
            'label' => esc_html__( 'Title', 'elementor-lege' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
        );

        $this->add_control(
            'title_span_heading',
            [
                'label' => esc_html__( 'Title Span', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'title_span_color',
            [
                'label'     => esc_html__( 'Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offices__title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_span_typography',
                'selector' => '{{WRAPPER}} .offices__title span',
            ]
        );

        $this->add_responsive_control(
            'title_span_spacing',
            [
                'label'      => esc_html__( 'Spacing (bottom)', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'range'      => [
                    'px' => ['min' => 0, 'max' => 100],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .offices__title span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Main Title', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offices__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .offices__title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__( 'Margin', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .offices__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

    }

    // Render
    protected function render(): void {
        $settings = $this->get_settings_for_display();

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
                <h2 class="offices__title secondary-title">
                    <?php if ( ! empty( $settings['title_span'] ) ) : ?>
                        <span><?php echo esc_html( $settings['title_span'] ); ?></span><br>
                    <?php endif; ?>
                    <?php if ( ! empty( $settings['title'] ) ) : ?>
                        <?php echo esc_html( $settings['title'] ); ?>
                    <?php endif; ?>
                </h2>

                <div class="map">

                    <?php 
                    $i = 1;
                    while ( $office_query->have_posts() ) : $office_query->the_post();
                        $post_id = get_the_ID();
                        $image_url = get_the_post_thumbnail_url( $post_id, 'large' );
                        $image_alt = get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true );
                        $title = get_the_title();
                        $content = get_the_content();
                    ?>
                        <div class="address address_0<?php echo esc_attr( $i ); ?>">
                            <div class="address__descr">
                                <?php if ( $image_url ) : ?>
                                <div class="address__img blue-noise">
                                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ?: $title ); ?>">
                                </div>
                                <?php endif; ?>

                                <div class="address__text">
                                    <span><?php echo esc_html( $title ); ?></span>
                                    <?php echo wp_kses_post( wpautop( $content ) ); ?>
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
        <section class="offices">
            <div class="wrapper">
                <h2 class="offices__title secondary-title"><span>{{{ settings.title_span }}}</span><br>{{{ settings.title }}}</h2>
                <div class="map">
                    <# for ( let i = 0; i < 3; i++ ) { #>
                    <div class="address address_0{{ i+1 }}">
                        <div class="address__descr">
                            <div class="address__img blue-noise">
                                <img src="img/office.jpg" alt="Office Image">
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
