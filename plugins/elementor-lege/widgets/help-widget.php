<?php
/**
 * Elementor Who We Help Widget
 * 
 * @package Elementor_Lege
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Help_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'help_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Lege Who We Help Widget', 'elementor-lege' );
	}

	public function get_icon(): string {
		return 'eicon-tools';
	}

	public function get_categories(): array {
		return [ 'lege-widgets' ];
	}

	public function get_keywords(): array {
        return ['help', 'support', 'consultation' ];
	}

    /* -------------------------------------------------
     * CONTROLS
     * ------------------------------------------------- */
	protected function register_controls(): void { 

        /* =========================
         * CONTENT SECTION
         * ========================= */
        $this->start_controls_section( 
            'help_content',
            [
                'label' => esc_html__('Content Section', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'help_main_title_span',
            [
                'label' => esc_html__('Subheading', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('Who we', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'help_main_title',
            [
                'label' => esc_html__('Heading', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('help', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'title_tag',
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

        $this->add_control(
            'help_description',
            [
                'label' => esc_html__('Description', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'help_button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-lege'),
                'type' => Elementor\Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__('Get a consultation', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'help_button_link',
            [
                'label' => esc_html__('Button Link', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [ 'active' => true ],
            ]
        ); 

        /* Items */
        for ( $i = 1; $i <= 3; $i++ ) {
            $this->add_control( 
                "item{$i}_title", 
            [
                'label' => esc_html__("Service {$i}: Title", 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'separator' => 'before',
            ]);

            $this->add_control( 
                "item{$i}_icon_type", 
            [
                'label' => esc_html__( 'Icon Type', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'icon'  => [ 'title' => esc_html__( 'Icon', 'elementor-lege' ), 'icon' => 'eicon-star' ],
                    'image' => [ 'title' => esc_html__( 'Image', 'elementor-lege' ), 'icon' => 'eicon-image-bold' ],
                ],
                'default' => 'image',
            ]);

            $this->add_control( 
                "item{$i}_icon", 
            [
                'label' => esc_html__( 'Icon', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [ "item{$i}_icon_type" => 'icon' ],
            ]);

            $this->add_control( 
                "item{$i}_icon_image", 
            [
                'label' => esc_html__( 'Image', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [ "item{$i}_icon_type" => 'image' ],
            ]);

            $this->add_control( 
                "item{$i}_text", 
            [
                'label' => esc_html__("Service {$i}: Content", 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]);
        }

        $this->end_controls_section();


    /*--------------------------------------------------------------
    # Style Controls
    --------------------------------------------------------------*/

        /* =========================
        * HEADING SECTION
        * ========================= */
        $this->start_controls_section(
            'help_style_section',
            [
                'label' => esc_html__('Heading', 'elementor-lege'), 
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /* Title color */
        $this->add_control(
            'help_main_title_color',
            [
                'label' => esc_html__('Text color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR, 
                'selectors' => [
                    '{{WRAPPER}} .help__title' => 'color: {{VALUE}};', 
                    '{{WRAPPER}} .help__title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        /* Title typography */
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'help_main_title_typography', 
                'selector' => '{{WRAPPER}} .help__title',
            ]
        ); 

        /* Margin */
        $this->add_responsive_control(
            'help_main_title_margin',
            [
                'label' => esc_html__('Margin', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .secondary-title' => 'margin: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        /* Padding */
        $this->add_responsive_control(
            'help_main_title_padding',
            [
                'label' => esc_html__('Padding', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .secondary-title' => 'padding: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->end_controls_section();

        /* Description */
        $this->start_controls_section(
            'help_description_style',
            [
                'label' => esc_html__('Description', 'elementor-lege'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        ); 

        $this->add_control(
            'help_description_color',
            [
                'label' => esc_html__('Text Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .help__descr' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'help_description_typography',
                'selector' => '{{WRAPPER}} .help__descr',
            ]
        );

        /* Margin */
        $this->add_responsive_control(
            'help_description_margin',
            [
                'label' => esc_html__('Margin', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .help__descr' => 'margin: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        /* Padding */
        $this->add_responsive_control(
            'help_description_padding',
            [
                'label' => esc_html__('Padding', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .help__descr' => 'padding: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->end_controls_section();

        /* =========================
        * BUTTON SECTION
        * ========================= */
        /*

        /* Button Section */
        $this->start_controls_section(
            'help_section_style_button',
            [
                'label' => esc_html__( 'Button', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /* Base typography (normal text) */
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );

        /* Button width */
        $this->add_responsive_control(
            'help_button_width',
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
            ]
        );

        /* Button padding */
        $this->add_responsive_control(
            'help_btn_padding',
            [
                'label' => esc_html__( 'Padding', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* Button border radius */
        $this->add_control(
            'btn_border_radius',
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

        /* -------------------------------------------------
        * Normal / Hover Tabs
        * ------------------------------------------------- */
        $this->start_controls_tabs( 'cta_button_tabs' );

        /* NORMAL */
        $this->start_controls_tab(
            'help_button_tab_normal',
            [ 'label' => esc_html__( 'Normal', 'elementor-lege' ) ]
        );

        /* Text color */
        $this->add_control(
            'help_button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-text: {{VALUE}};',
                ],
            ]
        );

        /* Background */
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_bg',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );
        
        /* Button shadow */
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'selector' => '{{WRAPPER}} .lege-btn',
            ]
        );
        $this->end_controls_tab();

        /* HOVER */
        $this->start_controls_tab(
            'help_cta_button_hover',
            [ 'label' => esc_html__( 'Hover', 'elementor-lege' ) ]
        );

        /* Hover text color */
        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-hover-text: {{VALUE}};',
                ],
            ]
        );

        /* Text font weight on hover */
        $this->add_control(
            'help_button_hover_font_weight',
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

        /* Letter spacing on hover */
        $this->add_responsive_control(
            'help_button_hover_letter_spacing',
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

        $this->end_controls_tab();

        $this->end_controls_tabs();

        /* -------------------------------------------------
        * Button Ring
        * ------------------------------------------------- */

        $this->add_control(
            'help_button_ring_color',
            [
                'label' => esc_html__( 'Ring Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lege-btn' => '--btn-ring-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'help_button_ring_opacity',
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

        /* =========================
        * SERVICES CONTENT SECTION
        * ========================= */
        $this->start_controls_section(
            'help_items_style',
            [
                'label' => esc_html__('Services', 'elementor-lege'), 
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'help_item_heading_color',
            [
                'label' => esc_html__('Heading color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR, 
                'selectors' => [
                    '{{WRAPPER}} .help__heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'help_item_heading_typography',
                'selector' => '{{WRAPPER}} .help__heading',
            ]
        );

        $this->add_control(
            'help_item_text_color',
            [
                'label' => esc_html__('Text color', 'elementor-lege'), 
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .help__par' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'help_item_text_typography',
                'selector' => '{{WRAPPER}} .help__par',
            ]
        );
            
        $this->end_controls_section();

        /* =========================
        * SERVICES ICON / IMAGE SECTION
        * ========================= */
        $this->start_controls_section(
            'help_items_images_style',
            [
                'label' => esc_html__('Icons / Images', 'elementor-lege'), 
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /* =========================
        * ICON SECTION
        * ========================= */
        $this->add_control(
            'help_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .help__icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .help__icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'help_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [ 'min' => 10, 'max' => 200 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .help__icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .help__icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        /* =========================
        * IMAGE SIZE SECTION
        * ========================= */

        /* Width */
        $this->add_responsive_control(
			'help_image_width',
			[
				'label' => esc_html__( 'Image width', 'elementor-lege' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
                    '{{WRAPPER}} .help__icon img' => 'width: auto; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        /* Max width */
		$this->add_responsive_control(
            'help_image_max_width',
            [
                'label' => esc_html__( 'Image max width', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .help__icon img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        /* Height */
		$this->add_responsive_control(
			'help_image_height',
			[
				'label' => esc_html__( 'Image height', 'elementor-lege' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
				'selectors' => [
					'{{WRAPPER}} .help__icon img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        // Style tab end

        }

    /*--------------------------------------------------------------
    # Content Controls
    --------------------------------------------------------------*/
	protected function render(): void {
		$settings = $this->get_settings_for_display();

        $title_tag = \Elementor\Utils::validate_html_tag( $settings['title_tag'] ?? 'h3' );
    ?>

    <!-- Help -->
    <section class="help">
        <div class="wrapper">
            <div class="help__block">
                <?php if ( ! empty( $settings['help_main_title_span'] ) || ! empty( $settings['help_main_title'] ) ) : ?>
                    <<?php echo $title_tag; ?> class="help__title secondary-title">
                        <?php if ( ! empty( $settings['help_main_title_span'] ) ) : ?>
                            <span><?php echo wp_kses_post( $settings['help_main_title_span'] ); ?></span>
                        <?php endif; ?>

                        <?php echo esc_html( $settings['help_main_title'] ); ?>

                    </<?php echo $title_tag; ?>>
                <?php endif; ?>

                <?php if (!empty($settings['help_description'])) : ?>
                    <p class="help__descr"><?php echo esc_html($settings['help_description']); ?></p>
                <?php endif; ?>

                <?php if ( ! empty( $settings['help_button_text'] ) ) :
                    $this->add_link_attributes( 'button', $settings['help_button_link'] );
                    $this->add_render_attribute( 'button', 'class', 'help__btn lege-btn btn--blue popup-link' );
                    ?>
                    <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
                        <?php echo esc_html($settings['help_button_text']); ?>
                    </a>
                <?php endif; ?>

            </div>

            <ul class="help__list">
                <?php for ( $i = 1; $i <= 3; $i++ ) : 
                    if ( empty( $settings["item{$i}_title"] ) ) continue;
                    ?>
                    <li class="help__item">
                        <div class="help__icon">
                            <?php if ( 'icon' === $settings["item{$i}_icon_type"] ) : ?>
                                <?php \Elementor\Icons_Manager::render_icon( $settings["item{$i}_icon"], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( $settings["item{$i}_icon_image"]['url'] ); ?>" alt="">
                            <?php endif; ?>
                        </div>
                        <h4 class="help__heading"><?php echo esc_html($settings["item{$i}_title"]); ?></h4>
                        <p class="help__par"><?php echo esc_html($settings["item{$i}_text"]); ?></p>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </section><!-- End help -->
   
	<?php

	}

	protected function content_template(): void {
		?>  
        <#
        // Define the tag and fallback to h3 if not set
        var titleTag = elementor.helpers.validateHTMLTag( settings.title_tag ) || 'h3';
        #>

        <!-- Help -->
		<section class="help">
			<div class="wrapper">
				<div class="help__block">
                    <# if ( settings.help_main_title_span || settings.help_main_title ) { #>
                        <{{{ titleTag }}} class="help__title secondary-title">
                            <span>{{{ settings.help_main_title_span }}}</span> {{{ settings.help_main_title }}}
                        </{{{ titleTag }}}>
                    <# } #>

                    <# if ( settings.help_description ) { #>
                        <p class="help__descr">{{{ settings.help_description }}}</p>
                    <# } #>
					
                    <# if ( settings.help_button_text ) { #>
                        <a href="{{ settings.help_button_link.url }}" class="help__btn lege-btn btn--blue">
                            {{{ settings.help_button_text }}}
                        </a>
                    <# } #>
				</div>

				<ul class="help__list">
                
                <# for ( var i = 1; i <= 3; i++ ) { 
                    var itemTitle = settings['item' + i + '_title'];
                    if ( ! itemTitle ) continue;
                    #>
                        <li class="help__item">
                            <div class="help__icon">
                                <# if ( settings['item' + i + '_icon_type'] === 'icon' ) { 
                                    var iconHTML = elementor.helpers.renderIcon( view, settings['item' + i + '_icon'], { 'aria-hidden': true }, 'i' , 'object' );
                                #>
                                    {{{ iconHTML.value }}}
                                <# } else { #>
                                    <img src="{{ settings['item' + i + '_icon_image'].url }}" alt="">
                                <# } #>
                            </div>
                            <h4 class="help__heading">{{{ itemTitle }}}</h4>
                            <p class="help__par">{{{ settings['item' + i + '_text'] }}}</p>
                        </li>
                    <# } #>

				</ul>
			</div>
		</section><!-- End help -->
		<?php
	}
}