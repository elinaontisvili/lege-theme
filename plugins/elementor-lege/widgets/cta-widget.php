<?php
class Elementor_CTA_Widget extends \Elementor\Widget_Base {


    public function get_name(): string {
        return 'cta_widget';
    }


    public function get_title(): string {
        return esc_html__( 'CTA Widget', 'elementor-lege' );
    }


    public function get_icon(): string {
        return 'eicon-call-to-action';
    }


    public function get_categories(): array {
        return [ 'lege-widgets' ];
    }


    public function get_keywords(): array {
        return ['cta', 'call to action'];
    }

    protected function register_controls(): void {


        // Content Tab

        // Content Tab Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Title
        $this->add_control(
            'cta_title',
            [
                'label'       => esc_html__( 'CTA Title', 'elementor-lege' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Свяжитесь с нами, чтобы узнать, как мы можем помочь вашему бизнесу',
                'placeholder' => esc_html__( 'Enter CTA title...', 'elementor-lege' ),
                'label_block' => true,
            ]
        );

        // Button text
        $this->add_control(
            'cta_button_text',
            [
                'label'       => esc_html__( 'Button Text', 'elementor-lege' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Связаться с нами',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'cta_button_hover_text',
            [
                'label'       => esc_html__( 'Button Hover Text', 'elementor-lege' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html( 'Связаться с нами', 'elementor-lege' ),
                'label_block' => true,
            ]
        );

        // Button URL
        $this->add_control(
            'cta_button_url',
            [
                'label'       => esc_html__( 'Button URL', 'elementor-lege' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'elementor-lege' ),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();


        // Style Tab

        // Background options 
        $this->start_controls_section(
            'section_style_background',
            [
                'label' => esc_html__( 'Background', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'section_background',
                'label'    => esc_html__( 'Background', 'elementor-lege' ),
                'types'    => [ 'classic', 'gradient', 'video' ], // classic = color/image, gradient, video
                'selector' => '{{WRAPPER}} .connect',
            ]
        );

        $this->end_controls_section();

        // Side Image
        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__( 'Side Image', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'side_image',
            [
                'label' => esc_html__( 'Upload Image', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_responsive_control(
            'side_image_size',
            [
                'label' => esc_html__( 'Image Size (Width)', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .connect__img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function render(): void {
        $settings = $this->get_settings_for_display();

        $side_img = '';
        if ( ! empty( $settings['side_image']['url'] ) ) {
            $side_img = 'style="background-image:url(' . esc_url( $settings['side_image']['url'] ) . ');"';
        }

        ?>

        <section class="connect">
            <div class="connect__decor"></div>
            <div class="wrapper">
                <div class="connect__wrap">

                <?php if ( ! empty( $settings['cta_title']) ) : ?>
                    <h3 class="connect__title">
                        <?php echo wp_kses_post( $settings['cta_title'] ); ?>
                    </h3>
                <?php endif; ?>

                <?php if ( ! empty( $settings['cta_button_text'] ) ) : ?>
                    <a href="<?php echo esc_url( $settings['cta_button_url']['url'] ); ?>"
                        class="connect__btn btn-white popup-link" 
                        data-content="<?php echo esc_attr( $settings['cta_button_text'] ); ?>">
                        <?php echo esc_html( $settings['cta_button_text'] ) ; ?>
                    </a>
                <?php endif; ?>

                </div>

                <div class="connect__img" <?php echo $side_img; ?>></div>

            </div>

        </section>
   
    <?php

    }


    protected function content_template(): void {
        ?>

        <section class="connect">
            <div class="wrapper">
                <div class="connect__wrap">
                    <h3 class="connect__title">{{ settings.cta_title || '' }}</h3>
                    <a href="{{ settings.cta_button_url.url || '#' }}#callback" 
                    class="connect__btn btn-white popup-link"
                    data-content="{{ settings.cta_button_text || '' }}">
                        {{ settings.cta_button_text || '' }}
                    </a>
                </div>

                <# if ( settings.side_image && settings.side_image.url ) { #>
                    <div class="connect__img" style="background-image: url( '{{ settings.side_image.url }}' );"></div>
                <# } else { #>
                    <div class="connect__img"></div>
                <# } #>

            </div>
        </section>
       
        <?php
    }
}
