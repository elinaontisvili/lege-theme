<?php
class Elementor_News_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'news_widget';
    }

    public function get_title(): string {
        return esc_html__( 'News Widget', 'elementor-lege' );
    }

    public function get_icon(): string {
        return 'eicon-post-slider';
    }

    public function get_categories(): array {
        return [ 'lege-widgets' ];
    }

    public function get_keywords(): array {
        return ['news', 'posts', 'slider'];
    }

    // Controls
    protected function register_controls(): void {

        // Content tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Title
        $this->add_control(
            'main_title',
            [
                'label' => __( 'Main Title', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'новости',
                'label_block' => true,
            ]
        );

        // Main title 
        $this->add_control(
            'main_title_span',
            [
                'label' => esc_html__( 'Title Small Letters', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Актуальные',
                'label_block' => true,
            ]
        );

        // Number of posts
        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Number of News to Show', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
                'min' => 1,
                'max' => 20,
            ]
        );

        // Button
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Все новости',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __( 'Button Link', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://site.com/news',
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab 
        $this->start_controls_section(
            'section_style_titles',
            [
                'label' => __( 'Titles', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Main Title Style
        $this->add_control(
            'main_title_color',
            [
                'label'     => __( 'Main Title Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'main_title_typo',
                'selector' => '{{WRAPPER}} .news__title',
                'scheme'   => \Elementor\Group_Control_Typography::get_type(),
            ]
        );

        // Span Title Style
        $this->add_control(
            'main_title_span_color',
            [
                'label'     => __( 'Small Title Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__title span' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'main_title_span_typo',
                'selector' => '{{WRAPPER}} .news__title span',
                'scheme'   => \Elementor\Group_Control_Typography::get_type(),
            ]
        );

        $this->end_controls_section();


        // Item Style
        $this->start_controls_section(
            'section_style_item',
            [
                'label' => __( 'News Item', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Background
        $this->add_control(
            'item_bg',
            [
                'label'     => __( 'Item Background', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Border radius
        $this->add_control(
            'item_radius',
            [
                'label' => __( 'Border Radius', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 40,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .news__item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Text Style
        $this->start_controls_section(
            'section_style_text',
            [
                'label' => __( 'Text', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Heading
        $this->add_control(
            'heading_color',
            [
                'label'     => __( 'Heading Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typo',
                'selector' => '{{WRAPPER}} .news__heading',
            ]
        );

        // Excerpt
        $this->add_control(
            'excerpt_color',
            [
                'label'     => __( 'Excerpt Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__text' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'excerpt_typo',
                'selector' => '{{WRAPPER}} .news__text',
            ]
        );

        $this->end_controls_section();


        // Button Style
        $this->start_controls_section(
            'section_style_button',
            [
                'label' => __( 'Button', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_text_color',
            [
                'label'     => __( 'Text Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label'     => __( 'Background Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typo',
                'selector' => '{{WRAPPER}} .news__btn',
            ]
        );

        $this->add_control(
            'btn_padding',
            [
                'label'      => __( 'Padding', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .news__btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    // Render
    protected function render(): void {
        $settings = $this->get_settings_for_display();

        $query = new WP_Query([
            'post_type'      => 'news',
            'posts_per_page' => $settings['posts_per_page'] ?? 4,
            'order'          => 'DESC',
            'orderby'        => 'date'
        ]);

        $button_url = !empty($settings['button_link']['url']) 
                      ? esc_url( $settings['button_link']['url'] ) 
                      : '#';
    ?>

        <!-- News -->
        <section class="news">
            <div class="wrapper">

                <h2 class="news__title secondary-title">
                    <span><?php echo wp_kses_post( $settings['main_title_span'] ); ?></span><br>
                    <?php echo esc_html( $settings['main_title'] ); ?>
                </h2>

                <div class="news__slider">

                    <?php if ( $query->have_posts() ) : ?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                            <div class="news__slide">
                                <div class="news__item">

                                    <div class="add-time">
                                        <svg width="13" height="13">
                                            <use xlink:href="#time"></use>
                                        </svg>
                                        <p class="add-time__date">
                                            <?php echo get_the_date('d.m.Y'); ?>
                                        </p>
                                    </div>

                                    <h5 class="news__heading"><?php the_title(); ?></h5>

                                    <p class="news__text">
                                        <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                                    </p>

                                    <a href="<?php the_permalink(); ?>" class="news__link link-more">
                                        <?php echo esc_html__( 'Читать больше', 'elementor-lege '); ?>
                                        <svg width="18" height="20">
                                            <use xlink:href="#nav-right"></use>
                                        </svg>
                                    </a>
                                </div>

                                <div class="news__img blue-noise">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail('large'); ?>
                                    <?php else : ?>
                                        <img src="https://placehold.co/600x400?text=No+Image" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endwhile; wp_reset_postdata(); ?>
                    <?php endif; ?>

                </div>

                <a href="<?php echo $button_url; ?>" class="news__btn btn">
                    <?php echo esc_html( $settings['button_text'] ); ?>
                </a>

            </div>
        </section>

        <?php
    }

    protected function content_template(): void {

        ?> 

        <!-- News -->
		<section class="news">
            <div class="wrapper">

                <h2 class="news__title secondary-title">
                    <span>{{{ settings.main_title_span }}}</span><br>
                    {{{ settings.main_title }}}
                </h2>

                <div class="news__slider">

                    <# for ( let i = 0; i < settings.posts_per_page; i++ ) { #>
                        <div class="news__slide">

                            <div class="news__item">
                                <div class="add-time">
                                    <svg width="13" height="13"><use xlink:href="#time"></use></svg>
                                    <p class="add-time__date">01.01.2024</p>
                                </div>

                                <h5 class="news__heading">Sample News Title</h5>
                                <p class="news__text">This is sample preview text for Elementor live editor…</p>

                                <a href="#" class="news__link link-more">
                                    Читать больше
                                    <svg width="18" height="20"><use xlink:href="#nav-right"></use></svg>
                                </a>
                            </div>

                            <div class="news__img blue-noise">
                                <img src="https://placehold.co/600x400" alt="">
                            </div>

                        </div>
                    <# } #>

                </div>

                <a href="{{ settings.button_link.url }}" class="news__btn btn">
                    {{{ settings.button_text }}}
                </a>

            </div>
        </section><!-- End news -->
        <?php
    }
}
