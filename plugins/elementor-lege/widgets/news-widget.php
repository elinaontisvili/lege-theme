<?php
/**
 * Elementor News Widget
 * * @package Elementor_Lege
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_News_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'news_widget';
    }

    public function get_style_depends(): array {
        return [ 'lege-news-widget' ];
    }

    public function get_title(): string {
        return esc_html__( 'Lege News Widget', 'elementor-lege' );
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

    /*--------------------------------------------------------------
    # CONTROLS
    --------------------------------------------------------------*/
    protected function register_controls(): void {

        $this->start_controls_section(
            'news_content_section',
            [
                'label' => esc_html__( 'Content', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'news_main_title',
            [
                'label' => esc_html__( 'Heading', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('news', 'elementor-lege'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'news_main_title_span',
            [
                'label' => esc_html__( 'Subheading', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('Hot', 'elementor-lege'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'news_title_tag',
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
                'default' => 'h2',
            ]
        );

        $this->add_control(
            'news_posts_per_page',
            [
                'label' => esc_html__( 'Number of News to Show', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
                'min' => 1,
                'max' => 20,
            ]
        );

        $this->add_control(
            'news_fallback_image',
            [
                'label' => esc_html__( 'Fallback Featured Image', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Used if a post has no featured image.', 'elementor-lege' ),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'news_button_text',
            [
                'label' => esc_html__( 'Button Text', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('View all news', 'elementor-lege'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'news_button_link',
            [
                'label' => esc_html__( 'Button Link', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [ 'active' => true ],
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        /*--------------------------------------------------------------
        # Style Controls
        --------------------------------------------------------------*/
        $this->start_controls_section(
            'news_section_style_titles',
            [
                'label' => esc_html__( 'Heading', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'news_main_title_color',
            [
                'label'     => esc_html__( 'Text Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_main_title_typo',
                'selector' => '{{WRAPPER}} .news__title',
            ]
        );

        $this->end_controls_section();

        /* =========================
        * Arrows
        * ========================= */
        $this->start_controls_section(
            'news_section_style_arrow',
            [
                'label' => esc_html__( 'Arrows', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Image upload
        $this->add_control(
            'news_arrow_icon',
            [
                'label' => esc_html__( 'Arrow Icon (PNG)', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--news-arrow-icon-url: url("{{URL}}");',
                ],
            ]
        );

        $this->add_control(
            'news_arrow_icon_hover',
            [
                'label' => esc_html__( 'Arrow Icon Hover (PNG)', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--news-arrow-icon-url-hover: url("{{URL}}");',
                ],
            ]
        );

        // Arrow bg color
        $this->add_control(
            'news_arrow_bg_color',
            [
                'label' => esc_html__( 'Background color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--news-common-arrow-bg-color: {{VALUE}};',
                ],
            ]
        );

        // Arrow gradient color 1
        $this->add_control(
            'news_arrow_color_1',
            [
                'label' => esc_html__( 'Hover background color 1', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0cf',
                'selectors' => [
                    '{{WRAPPER}} .common-arrow:hover' => '--news-common-arrow-img-color-1: {{VALUE}};',
                ],
            ]
        );

        // Arrow gradient color 2
        $this->add_control(
            'news_arrow_color_2',
            [
                'label' => esc_html__( 'Hover background color 2', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00a2ff',
                'selectors' => [
                    '{{WRAPPER}} .common-arrow:hover' => '--news-common-arrow-img-color-2: {{VALUE}};',
                ],
            ]
        );

        // Arrow box-shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'news_arrow_box_shadow',
                'selector' => '{{WRAPPER}} .common-arrow',
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--news-common-arrow-shadow: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * NEWS ITEM
        * ========================= */
        $this->start_controls_section(
            'news_section_style_item',
            [
                'label' => esc_html__( 'News Post', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'news_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Heading', 'elementor-lege' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'news_heading_color',
            [
                'label'     => esc_html__( 'Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_heading_typo',
                'label'     => esc_html__( 'Typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .news__heading',
            ]
        );

        // Excerpt color
        $this->add_control(
            'news_heading_excerpt',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Content', 'elementor-lege' ),
            ]
        );

        $this->add_control(
            'news_excerpt_color',
            [
                'label'     => esc_html__( 'Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_excerpt_typo',
                'label'     => esc_html__( 'Typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .news__text',
            ]
        );

        // Link
        $this->add_control(
            'news_link_heading',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Link', 'elementor-lege' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'news_link_color',
            [
                'label' => esc_html__( 'Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--news-link-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'news_link_hover_color',
            [
                'label' => esc_html__( 'Hover color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--news-link-hover-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_link_typo',
                'label' => esc_html__('Typography', 'elementor-lege'),
                'selector' => '{{WRAPPER}} .news__link',
            ]
        );

        $this->add_control(
            'news_bg_heading',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Background / Image', 'elementor-lege' ),
            ]
        );

        $this->add_control(
            'news_item_bg',
            [
                'label'     => esc_html__( 'Background color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Image overlay color
        $this->add_control(
            'news_overlay_color',
            [
                'label' => esc_html__( 'Image overlay color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--news-overlay-bg: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * DATE INFO SECTION
        * ========================= */
        $this->start_controls_section(
            'news_section_style_date',
            [
                'label' => esc_html__( 'Date', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'news_date_icon_color',
            [
                'label' => esc_html__( 'Icon color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--news-date-icon-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'news_date_text_color',
            [
                'label'     => esc_html__( 'Text color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add-time__date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'news_date_color_1',
            [
                'label' => esc_html__( 'Gradient color 1', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__item' => '--news-date-color-1: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'news_date_color_2',
            [
                'label' => esc_html__( 'Gradient color 2', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news__item' => '--news-date-color-2: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'news_date_box_shadow',
                'label' => esc_html__( 'Shadow color', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .add-time__date',
                'selectors' => [
                    '{{WRAPPER}} .add-time__date' => 'box-shadow: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * BUTTON SECTION
        * ========================= */

        $this->start_controls_section(
            'news_section_style_button',
            [
                'label' => esc_html__( 'Button', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /* -------------------------------------------------
        * Normal / Hover Tabs
        * ------------------------------------------------- */
        $this->start_controls_tabs( 'cta_button_tabs' );

        // NORMAL
        $this->start_controls_tab(
            'news_button_tab_normal',
            [ 'label' => esc_html__( 'Normal', 'elementor-lege' ) ]
        );

        // Base typography (normal text)
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_button_typography',
                'label' => esc_html__( 'Base typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );

        // Text color
        $this->add_control(
            'news_button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-text: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );

        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'news_button_bg',
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );

        $this->end_controls_tab();

        // HOVER
        $this->start_controls_tab(
            'news_cta_button_hover',
            [ 'label' => esc_html__( 'Hover', 'elementor-lege' ) ]
        );

        // Text font weight on hover
        $this->add_control(
            'news_button_hover_text_color',
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

        // Letter spacing on hover
        $this->add_responsive_control(
            'news_button_hover_letter_spacing',
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

        // Hover text color
        $this->add_control(
            'news_button_text_color_hover',
            [
                'label' => esc_html__( 'Text Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-hover-text: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );

        // Background hover
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'news_button_bg_hover',
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .lege-btn:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Button width
        $this->add_responsive_control(
            'news_button_width',
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
                'separator' => 'before',
            ]
        );

        // Button padding
        $this->add_responsive_control(
            'news_btn_padding',
            [
                'label' => esc_html__( 'Padding', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Button border radius
        $this->add_control(
            'news_btn_border_radius',
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

        // Button shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'news_button_shadow',
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );

        /* -------------------------------------------------
        * Button Ring
        * ------------------------------------------------- */

        $this->add_control(
            'news_button_ring_heading',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Hover Ring', 'elementor-lege' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'news_button_ring_color',
            [
                'label' => esc_html__( 'Ring Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-ring-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'news_button_ring_opacity',
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

    }

    /*--------------------------------------------------------------
    # RENDER
    --------------------------------------------------------------*/
    protected function render(): void {

        $settings  = $this->get_settings_for_display();
        $title_tag = \Elementor\Utils::validate_html_tag( $settings['news_title_tag'] ?? 'h2' );
        $posts_per_page = $settings['news_posts_per_page'] ?? 4;

        $query_args = [
            'post_type'      => 'news',
            'posts_per_page' => $posts_per_page,
            'order'          => 'DESC',
            'orderby'        => 'date',
            'post_status'    => 'publish',
            'no_found_rows'  => true,
            'fields'         => 'ids',
        ];

        $news_query = new \WP_Query( $query_args );
        $posts      = $news_query->posts;

        $this->add_link_attributes( 'button_arg', $settings['news_button_link'] );
        $this->add_render_attribute( 'button_arg', [
            'class'        => 'news__btn lege-btn btn--blue',
            'data-content' => $settings['news_button_text'],
        ] );

        $fallback_url = ! empty( $settings['news_fallback_image']['url'] ) 
            ? $settings['news_fallback_image']['url'] 
            : plugin_dir_url( __FILE__ ) . '../assets/images/placeholder-horizontal.jpg';
    ?>

    <section class="lege-news-widget news">
        <div class="wrapper">

            <?php if ( ! empty( $settings['news_main_title_span'] ) || ! empty( $settings['news_main_title'] ) ) : ?>
                <<?php echo $title_tag; ?> class="news__title secondary-title">
                    <?php if ( ! empty( $settings['news_main_title_span'] ) ) : ?>
                        <span><?php echo esc_html( $settings['news_main_title_span'] ); ?></span><br>
                    <?php endif; ?>
                    <?php echo esc_html( $settings['news_main_title'] ); ?>
                </<?php echo $title_tag; ?>>
            <?php endif; ?>

            <div class="news__slider">
                <?php if ( ! empty( $posts ) ) : ?>
                    <?php foreach ( $posts as $post_id ) : ?>
                        <div class="news__slide">
                            <div class="news__item">
                                <div class="add-time">
                                    <svg width="13" height="13"><use xlink:href="#time"></use></svg>
                                    <p class="add-time__date"><?php echo get_the_date( 'd.m.Y', $post_id ); ?></p>
                                </div>
                                <h5 class="news__heading"><?php echo esc_html( get_the_title( $post_id ) ); ?></h5>
                                <p class="news__text"><?php echo wp_trim_words( get_the_excerpt( $post_id ), 20 ); ?></p>
                                <a href="<?php echo get_permalink( $post_id ); ?>" class="news__link link-more">
                                    <?php echo esc_html__( 'Read more', 'elementor-lege' ); ?>
                                    <svg width="18" height="20"><use xlink:href="#nav-right"></use></svg>
                                </a>
                            </div>

                            <div class="news__img blue-noise">
                                <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                                    <?php echo get_the_post_thumbnail( $post_id, 'large' ); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url( $fallback_url ); ?>" alt="">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>

            <?php if ( ! empty( $settings['news_button_text'] ) ) : ?>
                <a <?php $this->print_render_attribute_string( 'button_arg' ); ?>>
                    <?php echo esc_html( $settings['news_button_text'] ); ?>
                </a>
            <?php endif; ?>
        </div>
    </section>
    <?php
    }

    protected function content_template(): void {
        $default_placeholder = esc_url( plugin_dir_url( __FILE__ ) . '../assets/images/placeholder-horizontal.jpg' );
        ?> 
        <#
        var titleTag = elementor.helpers.validateHTMLTag( settings.news_title_tag ) || 'h2';

        var fallbackUrl = ( settings.news_fallback_image && settings.news_fallback_image.url ) 
                        ? settings.news_fallback_image.url 
                        : '<?php echo $default_placeholder; ?>';

        view.addRenderAttribute( 'button_arg', {
            'class': 'news__btn lege-btn btn--blue',
            'href': settings.news_button_link ? settings.news_button_link.url : '#',
            'data-content': settings.news_button_text
        });
        #>

        <section class="lege-news-widget news">
            <div class="wrapper">
                <# if ( settings.news_main_title_span || settings.news_main_title ) { #>
                    <{{ titleTag }} class="news__title secondary-title">
                        <# if ( settings.news_main_title_span ) { #>
                            <span>{{ settings.news_main_title_span }}</span><br>
                        <# } #>
                        {{ settings.news_main_title }}
                    </{{ titleTag }}>
                <# } #>

                <div class="news__slider">
                    <#
                    var count = settings.news_posts_per_page ? settings.news_posts_per_page : 4;

                    for ( let i = 0; i < count; i++ ) { 
                    #>
                        <div class="news__slide">
                            <div class="news__item">
                                <div class="add-time">
                                    <svg width="13" height="13"><use xlink:href="#time"></use></svg>
                                    <p class="add-time__date">01.01.2024</p>
                                </div>
                                <h5 class="news__heading">Sample News Title</h5>
                                <p class="news__text">This is sample preview text…</p>
                                <a href="#" class="news__link link-more">
                                    {{{ 'Read more' }}}
                                    <svg width="18" height="20"><use xlink:href="#nav-right"></use></svg>
                                </a>
                            </div>
                            <div class="news__img blue-noise"> 
                                <img src="{{ fallbackUrl }}" alt="No image available">
                            </div>
                        </div>
                    <# } #>
                </div>

                <# if ( settings.news_button_text ) { #>
                    <a {{{ view.getRenderAttributeString( 'button_arg' ) }}}>
                        {{ settings.news_button_text }}
                    </a>
                <# } #>
            </div>
        </section>
        <?php
    }
}