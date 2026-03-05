<?php
/**
 * Elementor Testimonials Widget
 * 
 * @package Elementor_Lege
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Testimonials_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'testimonials_widget';
    }

    public function get_title(): string {
        return esc_html__( 'Lege Testimonials Widget', 'elementor-lege' );
    }

    public function get_icon(): string {
        return 'eicon-editor-quote';
    }

    public function get_categories(): array {
        return [ 'lege-widgets' ];
    }

    public function get_keywords(): array {
        return [ 'testimonials', 'reviews', 'feedback' ];
    }

    // Load all public post types 
    private function get_all_post_types() {
        static $options = null; 

        if ( $options !== null ) {
            return $options;
        }

        $types = get_post_types([ 'public' => true ], 'objects');
        $options = [];

        // Отфильтровать нежелательные типы
        $exclude = ['attachment', 'elementor_library'];

        foreach ($types as $key => $pt) {
            if (!in_array($key, $exclude, true) && strpos( $key, 'nav_' ) !== 0 ) {
                $options[$key] = $pt->label;
            }
        }
        return $options;
    }

    /*--------------------------------------------------------------
    # Controls
    --------------------------------------------------------------*/
    protected function register_controls(): void {

        /* =========================
        * CONTENT SECTION
        * ========================= */
        $this->start_controls_section(
            'testim_content_section',
            [
                'label' => esc_html__('Content', 'elementor-lege'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'testim_title_span',
            [
                'label' => esc_html__('Subheading', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('What They Say About Us', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'testim_title_main',
            [
                'label'   => esc_html__('Heading', 'elementor-lege'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('our clients', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'testim_title_tag',
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

        // Select post type
        $this->add_control(
            'post_type',
            [
                'label'   => esc_html__('Select Post Type', 'elementor-lege'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_all_post_types(),
                'default' => 'testimonial'
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => esc_html__('Number of Posts', 'elementor-lege'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        $this->end_controls_section();

        /*--------------------------------------------------------------
        # Style Controls
        --------------------------------------------------------------*/
        $this->start_controls_section(
            'testim_style_section',
            [
                'label' => esc_html__('Content', 'elementor-lege'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /* =========================
        * CONTENT SECTION
        * ========================= */
        $this->add_control(
            'testim_title_color',
            [
                'label' => esc_html__('Heading color', 'elementor-lege'),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clients__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'testim_title_typography',
                'label' => esc_html__('Heading typography', 'elementor-lege'),
                'selector' => '{{WRAPPER}} .clients__title',
            ]
        );

        $this->add_control(
            'testim_name_color',
            [
                'label' => esc_html__('Clients name color', 'elementor-lege'),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clients__name' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'testim_name_typography',
                'label' => esc_html__('Clients name typography', 'elementor-lege'),
                'selector' => '{{WRAPPER}} .clients__name',
            ]
        );

        $this->add_control(
            'testim_review_text_color',
            [
                'label' => esc_html__('Review text color', 'elementor-lege'),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clients__text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'testim_review_text_typography',
                'label' => esc_html__('Review text typography', 'elementor-lege'),
                'selector' => '{{WRAPPER}} .clients__text',
            ]
        );

        $this->end_controls_section();

        /* =========================
        * IMAGE SECTION
        * ========================= */
        $this->start_controls_section(
            'testim_clients_photo',
            [
                'label' => esc_html__( 'Clients Picture', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Image width
        $this->add_control(
            'testim_image_width',
            [
                'label' => esc_html__('Width', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 40,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 224,
                ],
                'selectors' => [
                    '{{WRAPPER}} .clients__img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Height image
        $this->add_control(
            'testim_image_height',
            [
                'label' => esc_html__('Height', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 40,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .clients__img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * DATE INFO SECTION
        * ========================= */
        $this->start_controls_section(
            'testim_section_style_date',
            [
                'label' => esc_html__( 'Date', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'testim_date_icon_color',
            [
                'label' => esc_html__( 'Icon color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add-time svg' => '--date-icon-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'testim_date_text_color',
            [
                'label'     => esc_html__( 'Date text color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add-time__date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'testim_date_color_1',
            [
                'label' => esc_html__( 'Date background color 1', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add-time__date' => '--date-color-1: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'testim_date_color_2',
            [
                'label' => esc_html__( 'Date background color 2', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add-time__date' => '--date-color-2: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testim_date_box_shadow',
                'selector' => '{{WRAPPER}} .add-time__date',
                'selectors' => [
                    '{{WRAPPER}} .add-time__date' => 'box-shadow: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * SOCIAL SECTION
        * ========================= */
        $this->start_controls_section(
            'testim_section_social',
            [
                'label' => esc_html__( 'Social', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'testim_social_color',
            [
                'label' => esc_html__( 'Icon color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clients__link svg' => '--clients-social-image-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'testim_social_bg_hover',
            [
                'label' => esc_html__(' Hover background color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clients__link:hover' => '--clients-social-image-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'testim_social_color_hover',
            [
                'label' => esc_html__(' Hover icon color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clients__link:hover svg' => '--clients-social-image-hover-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * BOX SECTION
        * ========================= */
        $this->start_controls_section(
            'testim_box',
            [
                'label' => esc_html__('Background', 'elementor-lege'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'testim_box_bg_color',
            [
                'label' => esc_html__('Background color', 'elementor-lege'),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .clients__box' => '--clients-box-bg-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * Arrows
        * ========================= */
        $this->start_controls_section(
            'testim_section_arrows',
            [
                'label' => esc_html__( 'Arrows (Tablet / Mobile)', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Image upload
        $this->add_control(
            'testim_arrow_icon',
            [
                'label' => esc_html__( 'Arrow icon (PNG)', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--arrow-icon-url: url("{{URL}}");',
                ],
            ]
        );

        $this->add_control(
            'testim__arrow_icon_hover',
            [
                'label' => esc_html__( 'Arrow icon hover (PNG)', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--arrow-icon-url-hover: url("{{URL}}");',
                ],
            ]
        );

        $this->add_control(
            'testim_arrow_bg_color',
            [
                'label' => esc_html__( 'Background color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--common-arrow-bg-color: {{VALUE}};',
                ],
            ]
        );

        // Gradient color 1
        $this->add_control(
            'testim_arrow_color_1',
            [
                'label' => esc_html__( 'Hover background color 1', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0cf',
                'selectors' => [
                    '{{WRAPPER}} .common-arrow:hover' => '--common-arrow-img-color-1: {{VALUE}};',
                ],
            ]
        );

        // Gradient color 2
        $this->add_control(
            'testim_arrow_color_2',
            [
                'label' => esc_html__( 'Hover background color 2', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00a2ff',
                'selectors' => [
                    '{{WRAPPER}} .common-arrow:hover' => '--common-arrow-img-color-2: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testim_arrow_box_shadow',
                'selector' => '{{WRAPPER}} .common-arrow',
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--common-arrow-shadow: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab End 

    }

    /*--------------------------------------------------------------
    # Content Controls
    --------------------------------------------------------------*/
    protected function render(): void {

    $settings  = $this->get_settings_for_display();
    $title_tag = \Elementor\Utils::validate_html_tag( $settings['testim_title_tag'] ?? 'h2' );

    $current_post_type = $settings['post_type'];

    $query = new WP_Query([
        'post_type'         => $current_post_type,
        'posts_per_page'    => $settings['posts_per_page'],
        'post_status'       => 'publish',
        'no_found_rows'     => true, // no pagination
        'ignore_sticky_posts'    => true,
        'update_post_meta_cache' => true,
        'update_post_term_cache' => false, // not using terms
    ]);

    $is_testimonial_cpt = ($current_post_type === 'testimonial');
    $prefix = "lege_";

    ?>
    <section class="clients" aria-labelledby="clients-title">
        <div class="wrapper">

        <?php if ( ! empty( $settings['testim_title_span'] ) || ! empty( $settings['testim_title_main' ] ) ) : ?>
            <<?php echo $title_tag; ?> id="clients-title" class="clients__title secondary-title">
                <?php if ( ! empty($settings['testim_title_span'] ) ) : ?>
                    <span><?php echo esc_html($settings['testim_title_span']); ?></span><br>
                <?php endif; ?>
                <?php echo esc_html($settings['testim_title_main']); ?>
            </<?php echo $title_tag; ?>>
        <?php endif; ?>

            <div class="clients__slider">

                <?php
                $i = 0;

                if ($query->have_posts()):
                    while ($query->have_posts()):
                        $query->the_post();

                        // Fetch custom metabox data
                        $social_link = '';
                        $display_date = get_the_date('d.m.Y');

                        if ($is_testimonial_cpt) {
                            $social_link = get_post_meta(get_the_ID(), $prefix . 'social_link', true);
                            $custom_date = get_post_meta(get_the_ID(), $prefix . 'testy_date', true);
                            
                            if (!empty($custom_date)) {
                                $timestamp = strtotime($custom_date);
                                if ($timestamp !== false) {
                                    $display_date = date('d.m.Y', $timestamp);
                                } else {
                                    $display_date = $custom_date; 
                                }
                            }
                        }
                    
                        $link_url = !empty($social_link) ? esc_url($social_link) : '#';

                        $i++;

                        // Middle slide should be active
                        $active = ($i === 1) ? ' active' : '';

                        // Get image from metabox 
                        $custom_image_meta = get_post_meta(get_the_ID(), $prefix . 'testimonial_image', true);

                        if ($custom_image_meta) {
                            // If numeric, treat as attachment ID; otherwise treat as URL
                            $image = is_numeric($custom_image_meta) 
                                ? wp_get_attachment_image_url($custom_image_meta, 'large') 
                                : esc_url($custom_image_meta);
                        } else {
                            // Fallback to featured image
                            $image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        }
                        ?>

                        <div class="clients__slide<?php echo $active; ?>">
                            <div class="clients__box">

                                <div class="clients__photo">
                                    <div class="clients__img">
                                        <img src="<?php echo esc_url($image); ?>"
                                            alt="Photo of <?php echo esc_attr(get_the_title()); ?>">
                                    </div>

                                    <?php if (!empty($social_link) || $is_testimonial_cpt): ?>
                                        <a href="<?php echo $link_url; ?>" class="clients__link" target="_blank" rel="noopener">
                                            <svg width="14" height="17">
                                                <use xlink:href="#facebook"/>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="clients__say">
                                    <p class="clients__name"><?php echo esc_html(get_the_title()); ?></p>

                                    <div class="clients__text">
  
                                        <?php
                                        $frontpage_testimonial = get_post_meta(get_the_ID(), $prefix . 'testy_frontpage', true);

                                        if ( !empty($frontpage_testimonial) ) {
                                            echo wp_kses_post( wpautop( $frontpage_testimonial ) );
                                        } else {
                                            echo apply_filters('the_content', get_the_content());
                                        }
                                        ?>

                                    </div>
                                </div>

                                <div class="add-time">
                                    <svg width="13" height="13">
                                        <use xlink:href="#time"/>
                                    </svg>
                                    <p class="add-time__date"><?php echo esc_html($display_date); ?></p>
                                </div>
                            </div>

                        </div>

                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>

            </div>
        </div>
    </section>
    <?php
    }

    protected function content_template(): void {
    ?> 
    <# 
    var titleTag = elementor.helpers.validateHTMLTag( settings.testim_title_tag ) || 'h2';
    #>

    <section class="clients">
        <div class="wrapper">

            <# if ( settings.testim_title_span || settings.testim_title_main ) { #>
                <{{ titleTag }} class="clients__title secondary-title">
                    <# if ( settings.testim_title_span ) { #>
                        <span>{{ settings.testim_title_span }}</span><br>
                    <# } #>
                    {{ settings.testim_title_main }}
                </{{ titleTag }}>
            <# } #>

            <div class="clients__slider">

            <# for ( let i = 0; i < settings.posts_per_page; i++ ) { #>
                <div class="clients__slide">
                    <div class="clients__box">
                        <div class="clients__photo">
                            <div class="clients__img">
                                <img src="<?php echo esc_url( \Elementor\Utils::get_placeholder_image_src() ); ?>">
                            </div>
                            <a href="#" class="clients__link">
                                <svg  width="14" height="17">
                                    <use xlink:href="#facebook"/>
                                </svg>
                            </a>
                        </div>
                        <div class="clients__say">
                            
                            <p class="clients__name">Client Name</p>

                            <div class="clients__text">
                                <p>This is sample preview text…</p>
                                <p>This is sample preview text…</p>
                            </div>
                        </div>
                        <div class="add-time">
                            <svg width="13" height="13">
                                <use xlink:href="#time"/>
                            </svg>
                            <p class="add-time__date">20.05.2018</p>
                        </div>
                    </div>
                </div>
            <# } #>
            </div>
        </div>
    </section>

    <?php 
    }
}
