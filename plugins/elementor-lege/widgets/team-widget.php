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

    public function get_title(): string {
        return esc_html__( 'Team Widget', 'elementor-lege' );
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

    protected function register_controls(): void {

        // Content tab 
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'elementor-lege' ),
            ]
        );

        $this->add_control(
            'title_span',
            [
                'label' => __('Section Title', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Нашa', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Section Title', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('команда', 'elementor-lege'),
            ]
        );

        $this->end_controls_section();

        // Style tab
        $this->start_controls_section(
            'section_style_titles',
            [
                'label' => esc_html__( 'Titles', 'elementor-lege' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Style for the span part
        $this->add_control(
            'title_span_color',
            [
                'label' => esc_html__( 'Span Title Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team__title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_span_typography',
                'label' => esc_html__( 'Span Title Typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .team__title span',
            ]
        );

        // Style for main title
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .team__title',
            ]
        );

        // Space between span and main title
        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__( 'Space Between Titles', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .team__title span' => 'display: block; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        // Fetch Team Members
        $team_query = new WP_Query([
            'post_type' => 'team',
            'posts_per_page' => '-1',
            'post_status' => 'publish',
        ]);

        ?>
        
        <section class="team">
            <div class="wrapper">

                <h2 class="team__title secondary-title">
                    <?php if ( ! empty( $settings['title_span'] ) ) : ?>
                        <span><?php echo $settings['title_span']; ?></span><br>
                    <?php endif; ?>
                        
                    <?php if ( ! empty( $settings['title'] ) ) : ?> 
                        <?php echo $settings['title']; ?>
                    <?php endif; ?>
                </h2>

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
    <!-- Team -->
    <section class="team">
        <div class="wrapper">
            <h2 class="team__title secondary-title"><span>{{{ settings.title_span }}}</span><br>{{{ settings.title }}}</h2>
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
                            <p>Сергей помог бесчисленным компаниям справиться с юридическими и нормативными трудностями и стать процветающими источниками дохода и создания рабочих мест в Москве</p>
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
