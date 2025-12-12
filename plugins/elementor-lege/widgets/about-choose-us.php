<?php
class Elementor_About_Choose_Us_Widget extends \Elementor\Widget_Base {


    public function get_name(): string {
        return 'about_choose_us_widget';
    }


    public function get_title(): string {
        return esc_html__( 'Who We Are Widget', 'elementor-lege' );
    }


    public function get_icon(): string {
        return 'eicon-components';
    }


    public function get_categories(): array {
        return [ 'lege-widgets' ];
    }


    public function get_keywords(): array {
        return ['who we are'];
    }

    protected function register_controls(): void {

        // Content Tab
        $this->start_controls_section(
                'content_section',
                [
                    'label' => esc_html__('Content', 'elementor-lege'),
                ]
            );

            // Main title small
            $this->add_control(
                'title_small',
                [
                    'label' => esc_html__('Small Title', 'elementor-lege'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Почему мы –',
                    'label_block' => true,
                ]
            );

            // Main title
            $this->add_control(
                'title_main',
                [
                    'label' => esc_html__('Main Title', 'elementor-lege'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'правильный выбор для вас',
                    'label_block' => true,
                ]
            );

            // Description (textarea)
            $this->add_control(
                'description',
                [
                    'label' => esc_html__('Description', 'elementor-lege'),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'default' => '<p>JC - это юридическая фирма с полным спектром услуг...</p>',
                ]
            );

            // Director Name
            $this->add_control(
                'director_name',
                [
                    'label' => esc_html__('Director Name', 'elementor-lege'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Дмитрий Львович',
                ]
            );

            // Director Position
            $this->add_control(
                'director_position',
                [
                    'label' => esc_html__('Director Position', 'elementor-lege'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Директор компании',
                ]
            );

            // Director Quote
            $this->add_control(
                'director_quote',
                [
                    'label' => esc_html__('Director Quote', 'elementor-lege'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => 'Мы здесь, чтобы помочь вам построить и поддержать свою мечту.',
                ]
            );

            // About image
            $this->add_control(
                'about_image',
                [
                    'label' => esc_html__('About Image', 'elementor-lege'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => 'https://placehold.co/600x400',
                    ],
                ]
            );

            // Director image
            $this->add_control(
                'director_image',
                [
                    'label' => esc_html__('Director Image', 'elementor-lege'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => 'https://placehold.co/150x150',
                    ],
                ]
            );

            // Signature image
            $this->add_control(
                'signature_image',
                [
                    'label' => esc_html__('Signature Image', 'elementor-lege'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => 'https://placehold.co/200x80',
                    ],
                ]
            );

            $this->end_controls_section();


        // Style tab 
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'elementor-lege'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Small title color
        $this->add_control(
            'title_small_color',
            [
                'label' => esc_html__('Small Title Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Main title color
        $this->add_control(
            'title_main_color',
            [
                'label' => esc_html__('Main Title Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Description color
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__descr' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Director quote color
        $this->add_control(
            'director_quote_color',
            [
                'label' => esc_html__('Director Quote Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .director__quote' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Director name color
        $this->add_control(
            'director_name_color',
            [
                'label' => esc_html__('Director Name Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .director__pers span' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Director position color
        $this->add_control(
            'director_position_color',
            [
                'label' => esc_html__('Director Position Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .director__pers' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Images border radius
        $this->add_control(
            'images_border_radius',
            [
                'label' => esc_html__('Images Border Radius', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .choice__pic img, {{WRAPPER}} .director__img img, {{WRAPPER}} .director__sign img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
    ?>

        <!-- Choice -->
        <section class="choice">
            <div class="wrapper">
                <div class="choice__block">
                    <div class="choice__image">
                        <div class="choice__pic blue-noise">
                            <img src="<?php echo esc_url($settings['about_image']['url']); ?>" alt="JC">
                        </div>
                        <div class="director">
                            <div class="director__img">
                                <img src="<?php echo esc_url($settings['director_image']['url']); ?>" alt="<?php echo esc_attr($settings['director_name']); ?>">
                            </div>
                            <div class="director__text">
                                <p class="director__quote"><?php echo esc_html($settings['director_quote']); ?></p>
                                <div class="director__pers">
                                    <span><?php echo esc_html($settings['director_name']); ?></span>
                                    <?php echo esc_html($settings['director_position']); ?>
                                </div>
                            </div>
                            <div class="director__sign">
                                <img src="<?php echo esc_url($settings['signature_image']['url']); ?>" alt="Подпись">
                            </div>
                        </div>
                    </div>
                    <div class="choice__wrap">
                        <h2 class="choice__title secondary-title">
                            <span><?php echo esc_html($settings['title_small']); ?></span><br>
                            <?php echo esc_html($settings['title_main']); ?>
                        </h2>
                        <div class="choice__descr">
                            <?php echo wp_kses_post($settings['description']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End choice -->

    <?php
    }

    protected function content_template(): void {
        ?>

        <!-- Choice -->
        <section class="choice">
            <div class="wrapper">
                <div class="choice__block">
                    <div class="choice__image">
                        <div class="choice__pic blue-noise">
                            <img src="{{ settings.about_image.url }}" alt="JC">
                        </div>
                        <div class="director">
                            <div class="director__img">
                                <img src="{{ settings.director_image.url }}" alt="{{ settings.director_name }}">
                            </div>
                            <div class="director__text">
                                <p class="director__quote">{{{ settings.director_quote }}}</p>
                                <div class="director__pers">
                                    <span>{{{ settings.director_name }}}</span>
                                    {{{ settings.director_position }}}
                                </div>
                            </div>
                            <div class="director__sign">
                                <img src="{{ settings.signature_image.url }}" alt="Подпись">
                            </div>
                        </div>
                    </div>
                    <div class="choice__wrap">
                        <h2 class="choice__title secondary-title">
                            <span>{{{ settings.title_small }}}</span><br>
                            {{{ settings.title_main }}}
                        </h2>
                        <div class="choice__descr">
                            {{{ settings.description }}}
                        </div>
                    </div>
                </div>
            </div>
    </section><!-- End choice -->

        <?php
    }
}