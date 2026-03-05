<?php
/**
 * Elementor Team Widget
 * 
 * @package Elementor_Lege
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Team_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'team_widget';
    }

    public function get_style_depends(): array {
        return [ 'lege-team-widget' ];
    }

    public function get_script_depends(): array {
        return [ 'lege-team-slide' ];
    }

    public function get_title(): string {
        return esc_html__( 'Lege Team Widget', 'elementor-lege' );
    }

    public function get_icon(): string {
        return 'eicon-person';
    }

    public function get_categories(): array {
        return [ 'lege-widgets' ];
    }

    public function get_keywords(): array {
        return ['team', 'members'];
    }

    /*--------------------------------------------------------------
    # Controls
    --------------------------------------------------------------*/
    protected function register_controls(): void {

        $this->start_controls_section(
            'tm_section_content',
            [
                'label' => esc_html__( 'Content', 'elementor-lege' ),
            ]
        );

        $this->add_control(
            'tm_title_span',
            [
                'label' => esc_html__('Subheading', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Our', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'tm_title',
            [
                'label' => esc_html__('Heading', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('team', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'tm_title_tag',
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

        $this->end_controls_section();

        /*--------------------------------------------------------------
        # Style Controls
        --------------------------------------------------------------*/
        $this->start_controls_section(
            'tm_section_style_titles',
            [
                'label' => esc_html__( 'Titles', 'elementor-lege' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tm_title_color',
            [
                'label' => __( 'Heading Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tm_title_typography',
                'label' => __( 'Heading Typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .team__title',
            ]
        );

        $this->add_responsive_control(
            'tm_margin',
            [
                'label' => esc_html__( 'Margin', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * Arrows
        * ========================= */
        $this->start_controls_section(
            'tm_arrow_style',
            [
                'label' => esc_html__( 'Arrows', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Image upload
        $this->add_control(
            'tm_arrow_icon',
            [
                'label' => esc_html__( 'Arrow Icon (PNG)', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--tm-arrow-icon-url: url("{{URL}}");',
                ],
            ]
        );

        $this->add_control(
            'tm_arrow_icon_hover',
            [
                'label' => esc_html__( 'Arrow Icon Hover (PNG)', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--tm-arrow-icon-url-hover: url("{{URL}}");',
                ],
            ]
        );

        // Arrow bg color
        $this->add_control(
            'tm_arrow_bg_color',
            [
                'label' => esc_html__( 'Background color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--common-arrow-bg-color: {{VALUE}};',
                ],
            ]
        );

        // Arrow gradient color 1
        $this->add_control(
            'tm_arrow_color_1',
            [
                'label' => esc_html__( 'Hover background color 1', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0cf',
                'selectors' => [
                    '{{WRAPPER}} .common-arrow:hover' => '--common-arrow-img-color-1: {{VALUE}};',
                ],
            ]
        );

        // Arrow gradient color 2
        $this->add_control(
            'tm_arrow_color_2',
            [
                'label' => esc_html__( 'Hover background color 2', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00a2ff',
                'selectors' => [
                    '{{WRAPPER}} .common-arrow:hover' => '--common-arrow-img-color-2: {{VALUE}};',
                ],
            ]
        );

        // Arrow box-shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tm_arrow_box_shadow',
                'selector' => '{{WRAPPER}} .common-arrow',
                'selectors' => [
                    '{{WRAPPER}} .common-arrow' => '--common-arrow-shadow: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * Card
        * ========================= */
        $this->start_controls_section(
            'tm_card_style',
            [
                'label' => esc_html__( 'Card', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tm_heading_pears_content',
            [
                'label' => esc_html__( 'Pears Content', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // Team pears text color 
        $this->add_control(
            'tm_pears_text_color',
            [
                'label' => esc_html__( 'Team Pears Text Color', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team' => '--team-pears-text: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tm_pears_text_color_hover',
            [
                'label' => esc_html__( 'Team Pears Text Color Hover', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .team__item:hover .team__pers' => '--team-pears-text-hover: {{VALUE}};',
                ],
            ]
        );

        // Team position text color 
        $this->add_control(
            'tm_position_text_color',
            [
                'label' => esc_html__( 'Team Position Text Color', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team' => '--team-position-text: {{VALUE}};',
                ],
            ]
        );

        // Position background 
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tm_position_gradient',
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .team__position',
            ]
        );

        // Overlay bg color 
        $this->add_control(
            'tm_overlay_bg',
            [
                'label' => esc_html__( 'Overlay Background', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team' => '--team-overlay-bg: {{VALUE}};',
                ],
            ]
        );

        // Overlay text color
        $this->add_control(
            'tm_overlay_text',
            [
                'label' => esc_html__( 'Overlay Text Color', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team' => '--team-overlay-text: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tm_social_heading',
            [
                'label' => esc_html__( 'Social Icons', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // Social icon colors 
        $this->add_control(
            'tm_social_icon_color',
            [
                'label' => esc_html__( 'Social Icon Color', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team' => '--team-social-icon: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tm_social_icon_hover_color',
            [
                'label' => esc_html__( 'Social Icon Hover Color', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team__item:hover' => '--team-social-hover-icon: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tm_bg_heading',
            [
                'label' => esc_html__( 'Card Background', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // Background color
        $this->add_control(
            'tm_card_bg',
            [
                'label' => esc_html__( 'Card Background', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team' => '--team-card-bg: {{VALUE}};',
                ],
            ]
        );

        // Box shadow 
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tm_card_box_shadow',
                'selector' => '{{WRAPPER}} .team__item',
            ]
        );
    }

    /*--------------------------------------------------------------
    # Content Controls
    --------------------------------------------------------------*/
    protected function render(): void {
        $settings = $this->get_settings_for_display();

        $title_tag = \Elementor\Utils::validate_html_tag( $settings['tm_title_tag'] ?? 'h2' );

        // Fetch Team Members
        $team_query = new WP_Query([
            'post_type' => 'team',
            'posts_per_page' => '-1',
            'post_status' => 'publish',
        ]);

        ?>
        
        <section class="team">
            <div class="wrapper">

                <?php if ( ! empty( $settings['tm_title_span'] ) || ! empty( $settings['tm_title'] ) ) : ?>
                    <<?php echo $title_tag; ?> class="team__title secondary-title">
                        <?php if ( ! empty( $settings['tm_title_span'] ) ) : ?>
                            <span><?php echo esc_html($settings['tm_title_span']); ?></span><br>
                        <?php endif; ?>
                            <?php echo esc_html($settings['tm_title']); ?>
                    </<?php echo $title_tag; ?>>
                <?php endif; ?>

            </div>

            <div class="wrapper sl">
                <div class="team__slider">

                <?php if ( $team_query->have_posts() ) : ?>
                    <?php while ( $team_query->have_posts() ) : $team_query->the_post(); ?>

                        <?php
                        $post_id = get_the_ID();
                        
                        $job_position = get_post_meta( $post_id, 'lege_team_job_position', true );

                        $facebook  = get_post_meta( $post_id, 'lege_team_facebook', true );
                        $instagram = get_post_meta( $post_id, 'lege_team_instagram', true );
                        $vk        = get_post_meta( $post_id, 'lege_team_vk', true );
                        $twitter   = get_post_meta( $post_id, 'lege_team_twitter', true );
                        
                        $image = get_the_post_thumbnail_url( $post_id, 'large' );
                        $image_alt = get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true );
                        ?>

                        <div class="team__slide">
                            <div class="team__item">

                                <div class="team__img">
                                    <img 
                                        src="<?php echo esc_url( $image ); ?>" 
                                        alt="<?php echo esc_attr( $image_alt ?: get_the_title() ); ?>"
                                    >
                                    <p class="team__pers"><?php echo esc_html( get_the_title() ); ?></p>

                                    <?php if ( $job_position ) : ?>
                                        <p class="team__position"><?php echo esc_html( $job_position ); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="description">
                                    <p><?php echo wp_kses_post( wp_trim_words( get_the_content(), 40 ) ); ?></p>

                                    <ul class="social">

                                        <?php if ( $vk ) : ?>
                                        <li class="social__item">
                                            <span><?php echo esc_html__( 'Vk', 'elementor-lege' ); ?></span>
                                            <a class="social__icon social__icon_vk" href="<?php echo esc_url( $vk ); ?>" target="_blank" rel="noopener">
                                                <svg width="21" height="18"><use xlink:href="#vk"></use></svg>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if ( $facebook ) : ?>
                                        <li class="social__item">
                                            <span><?php echo esc_html__( 'Fb', 'elementor-lege' ); ?></span>
                                            <a class="social__icon social__icon_fb" href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener">
                                                <svg width="14" height="17"><use xlink:href="#facebook"></use></svg>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if ( $twitter ) : ?>
                                        <li class="social__item">
                                            <span><?php echo esc_html__( 'Tw', 'elementor-lege' ); ?></span>
                                            <a class="social__icon social__icon_tw" href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener">
                                                <svg width="18" height="15"><use xlink:href="#twitter"></use></svg>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if ( $instagram ) : ?>
                                        <li class="social__item">
                                            <a class="social__icon social__icon_inst" href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener">
                                                <svg width="16" height="16"><use xlink:href="#instagram"></use></svg>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>

                            </div>
                        </div>

                    <?php endwhile; wp_reset_postdata(); ?>
                <?php endif; ?>

                </div>
            </div>
        </section>
        <?php
    }

    protected function content_template(): void {
    ?> 
    <#
    var titleTag = elementor.helpers.validateHTMLTag( settings.tm_title_tag ) || 'h2';
    #>
    
    <!-- Team -->
    <section class="lege-tm-widget team">

        <div class="wrapper">
            <# if ( settings.tm_title_span || settings.tm_title ) { #>
                <{{ titleTag }} class="team__title secondary-title">
                    <# if ( settings.tm_title_span ) { #>
                        <span>{{ settings.tm_title_span }}</span><br>
                    <# } #>
                {{ settings.tm_title }}</{{ titleTag }}>
            <# } #>
        </div>

        <div class="wrapper sl">
            <div class="team__slider">
                <!-- One slide -->
                <# for ( let i = 0; i < settings.posts_per_page; i++ ) { #>
                <div class="team__slide">
                    <div class="team__item">
                        <div class="team__img">
                            <img src="img/pers3.jpg" alt="Андрей Егоров">
                            <p class="team__pers">Андрей Егоров</p>
                            <p class="team__position">Старший партнер</p>
                        </div>
                        <div class="description">
                            <p>Description goes here...</p>
                            <ul class="social">
                                <li class="social__item">
                                    <span>Vk</span>
                                    <a class="social__icon social__icon_vk" href="#">
                                        <svg  width="21" height="18">
                                            <use xlink:href="#vk"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Fb</span>
                                    <a class="social__icon social__icon_fb" href="#">
                                        <svg  width="14" height="17">
                                            <use xlink:href="#facebook"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Tw</span>
                                    <a class="social__icon social__icon_tw" href="#">
                                        <svg  width="18" height="15">
                                            <use xlink:href="#twitter"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a class="social__icon social__icon_inst" href="#">
                                        <svg width="16" height="16">
                                            <use xlink:href="#instagram"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <# } #>
                <!-- End one slide -->
                
            </div>
        </div>
    </section>

    <!-- End team -->

        <?php
    }
}
