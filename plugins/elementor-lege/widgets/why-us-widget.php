<?php
/**
 * Elementor Why Us Widget
 * 
 * @package Elementor_Lege
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Why_Us_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'why_us_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Lege Why Us Widget', 'elementor-lege' );
	}

	public function get_icon(): string {
		return 'eicon-bullet-list';
	}

	public function get_categories(): array {
		return [ 'lege-widgets' ];
	}

	public function get_keywords(): array {
        return ['why us', 'why choose us', 'our advantages', 'what makes us different', 'our story'];
	}

    /*--------------------------------------------------------------
    # CONTROLS
    --------------------------------------------------------------*/
	protected function register_controls(): void { 

        /* =========================
         * CONTENT SECTION
         * ========================= */
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content Section', 'elementor-lege' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        /* Title */
        $this->add_control(
            'why_us_main_title_span',
            [
                'label' => esc_html__('Subheading', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('Why we are –', 'elementor-lege'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'why_us_main_title',
            [
                'label' => esc_html__('Heading', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('the right choice for you', 'elementor-lege'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'why_us_title_tag',
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
                'default' => 'h3',
            ]
        );

        /* WYSIWYG Editor */
        $this->add_control(
            'why_us_description',
            [
                'label' => esc_html__( 'Description', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( '<p>JC is a <b>law firm</b>...</p>', 'elementor-lege' ),
                'show_label' => true,
                'editor_settings' => [
                    'tinymce' => [
                        'extended_valid_elements' => 'span[class|style],b,strong,p',
                        'verify_html' => false,
                    ],
                ],
            ]
        );

        /* Button */
        $this->add_control(
            'why_us_button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('Read more about the company', 'elementor-lege'), 
                'label_block' => true,
            ]
        );

        $this->add_control(
            'why_us_button_url',
            [
                'label' => esc_html__('Button URL', 'elementor-lege'),
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
            'why_us_title_style_section',
            [
                'label' => esc_html__( 'Heading', 'elementor-lege' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'why_us_title_color',
            [
                'label' => esc_html__( 'Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .choice__title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), 
            [
                'name' => 'title_typography', 
                'label' => esc_html__( 'Typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .choice__title',
            ]
        );

        $this->end_controls_section();

        /* Style for WYSIWYG */
        $this->start_controls_section(
            'why_us_description_style',
            [
                'label' => esc_html__( 'Description', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'why_us_description_color',
            [
                'label'     => esc_html__( 'Text Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__descr, {{WRAPPER}} .choice__descr p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .choice__descr',
            ]
        );

        $this->end_controls_section();

        /* Button Styling */
        $this->start_controls_section(
            'why_us_button_style',
            [
                'label' => esc_html__( 'Button', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'why_us_button_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'why_us_button_background',
            [
                'label'     => esc_html__( 'Background Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .choice__btn',
            ]
        );

        /* Padding */
        $this->add_responsive_control(
            'why_us_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .choice__btn' => 
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* Border radius */
        $this->add_responsive_control(
            'why_us_button_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .choice__btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        /* Hover controls */
        $this->add_control(
            'why_us_button_hover_heading',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Hover', 'elementor-lege' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'why_us_button_hover_color',
            [
                'label'     => esc_html__( 'Text Hover Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'why_us_button_hover_bg',
            [
                'label'     => esc_html__( 'Background Hover Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* Background Style Section */
        $this->start_controls_section(
            'why_us_background_style_section',
            [
                'label' => esc_html__( 'Background', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'choice_background',
                'label'    => esc_html__( 'Background', 'elementor-lege' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .choice',
                'default' => [
                    'background' => [
                        'image' => [
                            'url' => get_template_directory_uri() . '/assets/img/bg_choice.jpg',
                        ],
                    ],
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
        $settings = $this->get_settings_for_display();

        $title_tag = \Elementor\Utils::validate_html_tag( $settings['why_us_title_tag'] ?? 'h2' );
        ?>

        <section class="choice">
            <div class="wrapper">
                <div class="choice__wrap">
                    <?php if ( ! empty( $settings['why_us_main_title_span'] ) || ! empty( $settings['why_us_main_title'] ) ) : ?>
                        <<?php echo $title_tag; ?> class="choice__title secondary-title">
                            <?php if ( ! empty( $settings['why_us_main_title_span'] ) ) : ?>
                                <span><?php echo esc_html( $settings['why_us_main_title_span'] ); ?></span><br>
                            <?php endif; ?>

                            <?php echo esc_html( $settings['why_us_main_title'] ); ?>
                        </<?php echo $title_tag; ?>>
                    <?php endif; ?>

                    <div class="choice__descr">
                        <?php 
                            echo wp_kses_post( $settings['why_us_description'] ); 
                        ?>
                    </div>

                    <?php if ( ! empty( $settings['why_us_button_text'] ) ) : ?>
                        <a href="<?php echo esc_url( $settings['why_us_button_url']['url'] ); ?>" class="choice__btn noise">
                            <?php echo esc_html( $settings['why_us_button_text'] ); ?>
                            <svg width="18" height="20"><use xlink:href="#nav-right"/></svg>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </section>
        <?php
    }

    protected function content_template(): void {
        ?>
        <#
        var titleTag = elementor.helpers.validateHTMLTag( settings.why_us_title_tag ) || 'h2';
        #>

        <section class="choice">
            <div class="wrapper">
                <div class="choice__wrap">
                    <# if ( settings.why_us_main_title_span || settings.why_us_main_title ) { #>
                        <{{{ titleTag }}} class="choice__title secondary-title">
                            <# if ( settings.why_us_main_title_span ) { #>
                                <span>{{{ settings.why_us_main_title_span }}}</span><br>
                            <# } #>
                            {{{ settings.why_us_main_title }}}
                        </{{{ titleTag }}}>
                    <# } #>

                    <div class="choice__descr">
                        {{{ settings.why_us_description }}}
                    </div>
                    <# if ( settings.why_us_button_text ) { #>
                        <a href="{{ settings.why_us_button_url.url }}" class="choice__btn noise">
                            {{{ settings.why_us_button_text }}}
                            <svg width="18" height="20"><use xlink:href="#nav-right"/></svg>
                        </a>
                    <# } #>
                </div>
            </div>
        </section>
        <?php
    }
}