<?php
/**
 * Elementor About Widget
 * 
 * @package Elementor_Lege
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_About_Choose_Us_Widget extends \Elementor\Widget_Base {


    public function get_name(): string {
        return 'about_choose_us_widget';
    }


    public function get_title(): string {
        return esc_html__( 'Lege Who We Are Widget', 'elementor-lege' );
    }


    public function get_icon(): string {
        return 'eicon-components';
    }


    public function get_categories(): array {
        return [ 'lege-widgets' ];
    }


    public function get_keywords(): array {
        return ['who we are', 'about us'];
    }

    protected function register_controls(): void {

    /*--------------------------------------------------------------
    # Controls
    --------------------------------------------------------------*/
        $this->start_controls_section(
            'ch_content_section',
            [
                'label' => esc_html__('Content', 'elementor-lege'),
            ]
        );

        // Title span
        $this->add_control(
            'ch_title_span',
            [
                'label' => esc_html__('Subheading', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( 'Why we are –', 'elementor-lege' ),
                'label_block' => true,
            ]
        );

        // Main title
        $this->add_control(
            'ch_title_main',
            [
                'label' => esc_html__('Heading', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( 'the right choice for you', 'elementor-lege' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ch_title_tag',
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

        // Description
        $this->add_control(
            'ch_description',
            [
                'label' => esc_html__('Description', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( '<p>JC is a legal firm with a full range of services...</p>', 'elementor-lege' ),
            ]
        );

        // Director Name
        $this->add_control(
            'ch_director_name',
            [
                'label' => esc_html__('Director Name', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( 'Dmitry Lvovich', 'elementor-lege' ),
            ]
        );

        // Director Position
        $this->add_control(
            'ch_director_position',
            [
                'label' => esc_html__('Director Position', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ], 
                'default' => esc_html__( 'Company Director', 'elementor-lege' ),
            ]
        );

        // Director Quote
        $this->add_control(
            'ch_director_quote',
            [
                'label' => esc_html__('Director Quote', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( 'We are here to help you build and support your dream.', 'elementor-lege' ),
            ]
        );

        // About image
        $this->add_control(
            'ch_about_image',
            [
                'label' => esc_html__('About Image', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [ 'active' => true ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Director image
        $this->add_control(
            'ch_director_image',
            [
                'label' => esc_html__('Director Image', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [ 'active' => true ],
                'default' => [
                    'url' => plugin_dir_url( __FILE__ ) . '../assets/images/placeholder-square.jpg',
                ],
            ]
        );

        // Signature image
        $this->add_control(
            'ch_signature_image',
            [
                'label' => esc_html__('Signature Image', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [ 'active' => true ],
                'default' => [
                    'url' => plugin_dir_url( __FILE__ ) . '../assets/images/placeholder-square.jpg',
                ],
            ]
        );

        $this->end_controls_section();

        /*--------------------------------------------------------------
        # Style Controls
        --------------------------------------------------------------*/
        $this->start_controls_section(
            'ch_style_section',
            [
                'label' => esc_html__('Style', 'elementor-lege'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Title color
        $this->add_control(
            'ch_title_color',
            [
                'label' => esc_html__('Heading Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Description color
        $this->add_control(
            'ch_description_color',
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
            'ch_director_quote_color',
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
            'ch_director_name_color',
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
            'ch_director_position_color',
            [
                'label' => esc_html__('Director Position Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .director__pers' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Background color
        $this->add_control(
            'ch_service_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__image' => '--choice-bg-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // End style tab

    }

    /* -------------------------------------------------
     * RENDER
     * ------------------------------------------------- */
    protected function render(): void {
        $settings = $this->get_settings_for_display();

        $title_tag = \Elementor\Utils::validate_html_tag( $settings['ch_title_tag'] ?? 'h2' );
    ?>

        <!-- Choice -->
        <section class="choice">
            <div class="wrapper">
                <div class="choice__block">

                <?php 
                $has_about_image = ! empty( $settings['ch_about_image']['url'] );
                $has_director_info = ( 
                    ! empty( $settings['ch_director_image']['url'] ) || 
                    ! empty( $settings['ch_director_name'] ) || 
                    ! empty( $settings['ch_director_position'] ) || 
                    ! empty( $settings['ch_director_quote'] ) 
                );

                if ( $has_about_image || $has_director_info ) : ?>
                    <div class="choice__image">

                        <?php if ( $has_about_image ) : ?>
                            <div class="choice__pic blue-noise">
                                <img src="<?php echo esc_url($settings['ch_about_image']['url']); ?>" alt="JC">
                            </div>
                        <?php endif; ?>

                        <?php if ( $has_director_info ) : ?>
                            <div class="director">

                                <div class="director__img">
                                    <?php if (!empty($settings['ch_director_image']['url'])) : ?>
                                        <img src="<?php echo esc_url($settings['ch_director_image']['url']); ?>" alt="<?php echo esc_attr($settings['director_name']); ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="director__text">
                                    <?php if ( ! empty($settings['ch_director_quote'])) : ?>
                                        <p class="director__quote"><?php echo esc_html($settings['ch_director_quote']); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['ch_director_name']) || ! !empty($settings['ch_director_position'])) : ?>
                                        <div class="director__pers">
                                            <?php if (!empty($settings['ch_director_name'])) : ?>
                                                <span><?php echo esc_html($settings['ch_director_name']); ?></span>
                                            <?php endif; ?>
                                            <?php echo esc_html($settings['ch_director_position']); ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <?php if (!empty($settings['ch_signature_image']['url'])) : ?>
                                    <div class="director__sign">
                                        <img src="<?php echo esc_url($settings['ch_signature_image']['url']); ?>" alt="Signature">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <?php endif; // End Master Check ?>

                    <div class="choice__wrap">
                        <?php if ( ! empty( $settings['ch_title_span'] ) || ! empty( $settings['ch_title_main' ] ) ) : ?>
                            <<?php echo $title_tag ?> class="choice__title secondary-title">
                                <?php if ( ! empty($settings['ch_title_span'] ) ) : ?>
                                    <span><?php echo esc_html($settings['ch_title_span']); ?></span><br>
                                <?php endif; ?>
                                <?php echo esc_html($settings['ch_title_main']); ?>
                            </<?php echo $title_tag ?>>
                        <?php endif ?>

                        <div class="choice__descr">
                            <?php if ( ! empty($settings['ch_description'] ) ) : ?>
                                <?php echo wp_kses_post($settings['ch_description']); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End choice -->

    <?php
    }

    protected function content_template(): void {
        ?>
        <#
        var titleTag = elementor.helpers.validateHTMLTag( settings.ch_title_tag ) || 'h2';

        // Master check
        var hasAboutImage = settings.ch_about_image.url ? true : false;
        var hasDirectorInfo = ( 
            settings.ch_director_image.url || 
            settings.ch_director_name || 
            settings.ch_director_position || 
            settings.ch_director_quote 
        ) ? true : false;
        #>

        <!-- Choice -->
        <section class="choice">
            <div class="wrapper">
                <div class="choice__block">

                <# if ( hasAboutImage || hasDirectorInfo ) { #>
                    <div class="choice__image">


                        <# if ( hasAboutImage ) { #>
                            <div class="choice__pic blue-noise">
                                <img src="{{ settings.ch_about_image.url }}" alt="About Image">
                            </div>
                        <# } #>

                        <# if ( hasDirectorInfo ) { #>
                            <div class="director">
                                <# if ( settings.ch_director_image.url ) { #>
                                    <div class="director__img">
                                        <img src="{{ settings.ch_director_image.url }}" alt="{{ settings.director_name }}">
                                    </div>
                                <# } #>

                                <div class="director__text">
                                    <# if ( settings.ch_director_quote ) { #>
                                        <p class="director__quote">{{{ settings.ch_director_quote }}}</p>
                                    <# } #>

                                    <# if ( settings.ch_director_name || settings.ch_director_position ) { #>
                                        <div class="director__pers">
                                            <# if ( settings.ch_director_name ) { #>
                                                <span>{{{ settings.ch_director_name }}}</span>
                                            <# } #>
                                            {{{ settings.ch_director_position }}}
                                        </div>
                                    <# } #>
                                </div>

                                <# if ( settings.ch_signature_image.url ) { #>
                                    <div class="director__sign">
                                        <img src="{{ settings.ch_signature_image.url }}" alt="Signature">
                                    </div>
                                <# } #>

                            </div>
                        <# } #>

                    </div>
                    <# } #>

                    <div class="choice__wrap">
                        <# if ( settings.ch_title_span || settings.ch_title_main ) { #>
                            <{{ titleTag }} class="choice__title secondary-title">
                                <# if ( settings.ch_title_span ) { #>
                                    <span>{{ settings.ch_title_span }}</span><br>
                                    <# } #>
                                {{ settings.ch_title_main }}
                            </{{ titleTag }}>
                        <# } #>

                        <div class="choice__descr">
                            <# if ( settings.ch_description ) { #>
                                {{ settings.ch_description }}
                            <# } #>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End choice -->

        <?php
    }
}