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
		return esc_html__( 'Why Us Widget', 'elementor-lege' );
	}

	public function get_icon(): string {
		return 'eicon-bullet-list';
	}

	public function get_categories(): array {
		return [ 'lege-widgets' ];
	}

	public function get_keywords(): array {
        return ['why us'];
	}

	protected function register_controls(): void { 

        // Content Tab Start 
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'elementor-lege' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Main title 
        $this->add_control(
            'main_title_span',
            [
                'label' => esc_html__('Main Title Span', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Почему мы –', 'elementor-lege'),
                'placeholder' => esc_html('Type your above title here', 'elementor-lege'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('правильный выбор для вас', 'elementor-lege'),
                'placeholder' => esc_html('Type your below title here', 'elementor-lege'),
                'label_block' => true,
            ]
        );

        // Description (repeater)
        $repeater = new \Elementor\Repeater(); 

        $repeater->add_control(
            'paragraph',
            [
                'label' => esc_html__('Paragraph', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXTAREA, 
                'default' => esc_html__('Description text...', 'elementor-lege'),
                'show_label' => true,
            ]
        );

        $this->add_control(
            'description_list',
            [
                'label' => esc_html__('Description Texts', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::REPEATER, 
                'fields' => $repeater->get_controls(), 
                'default' => [], 
                'title_field' => '{{{ paragraph }}}', 
            ]
        );
        
        // Button text 
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT, 
                'default' => esc_html__('Читать больше о компании', 'elementor-lege'), 
                'label_block' => true,
            ]
        );

        // Button URL 
        $this->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_url('https://your-link.com', 'elementor-lege'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();


		// Style Tab

        // Title Style Section 
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__( 'Title', 'elementor-lege' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color_span',
            [
                'label' => esc_html__( 'Title Span Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choise__title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choise__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), 
            [
                'name' => 'title_typography', 
                'label' => esc_html__( 'Typography', 'elementor-lege' ),
                'selector' => '{{WRAPPER}} .choise__title',
            ]
        );

        $this->end_controls_section();


        // Paragraph Style 
        $this->start_controls_section(
            'paragraph_style',
            [
                'label' => esc_html__( 'Paragraphs', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'paragraph_color',
            [
                'label'     => esc_html__( 'Text Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__descr' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'paragraph_typography',
                'selector' => '{{WRAPPER}} .choice__descr',
            ]
        );

        $this->add_responsive_control(
            'paragraph_spacing',
            [
                'label' => esc_html__( 'Spacing Below Title', 'elementor-lege' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .choice__descr' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Button Style 
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Text color
        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Background color
        $this->add_control(
            'button_background',
            [
                'label'     => esc_html__( 'Background Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .choice__btn',
            ]
        );

        // Padding
        $this->add_responsive_control(
            'button_padding',
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

        // Border radius
        $this->add_responsive_control(
            'button_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .choice__btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Hover controls
        $this->add_control(
            'button_hover_heading',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Hover', 'elementor-lege' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label'     => esc_html__( 'Text Hover Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg',
            [
                'label'     => esc_html__( 'Background Hover Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choice__btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Section Spacing 
        $this->start_controls_section(
            'section_spacing',
            [
                'label' => esc_html__( 'Section Spacing', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'section_padding',
            [
                'label'      => esc_html__( 'Padding', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .choice' => 
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); 

        // Background Style Section
        $this->start_controls_section(
            'background_style_section',
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
                'types'    => [ 'classic', 'gradient' ], // Image + color + gradient
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

	protected function render(): void {
		$settings = $this->get_settings_for_display();
    ?>

    <!-- Choice -->
    <section class="choice">
        <div class="wrapper">
            <div class="choice__wrap">

            <h2 class="choice__title secondary-title">
                <?php if ( ! empty( $settings['main_title_span'] ) ) : ?>
                    <span><?php echo $settings['main_title_span']; ?></span><br>
                <?php endif; ?>

                <?php if ( ! empty( $settings['main_title'] ) ) : ?>
                    <?php echo $settings['main_title']; ?>
                <?php endif; ?>
            </h2>

            <div class="choice__descr">
                <?php if ( ! empty( $settings['description_list'] ) ) : ?> 
                    <?php foreach ( $settings['description_list'] as $item ) : ?>
                        <?php echo $item['paragraph']; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if ( ! empty( $settings['button_text'] ) ) : ?>
                <a href="<?php echo esc_url( $settings['button_url']['url'] ); ?>" class="choice__btn noise">
                    <?php echo esc_html( $settings['button_text'] ); ?>
                    <svg width="18" height="20">
                        <use xlink:href="#nav-right"/>
                    </svg>
                </a>
            <?php endif; ?>

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
				<div class="choice__wrap">
					<h2 class="choice__title secondary-title"><span>{{ settings.main_title_span }}</span><br>{{ settings.main_title }}</h2>
					<div class="choice__descr">
						{{ settings.paragraph }}
					</div>
					<a href="{{ settings.button_url }}" class="choice__btn noise">
						{{ settings.button_text}}
						<svg width="18" height="20">
							<use xlink:href="#nav-right"/>
						</svg>
					</a>
				</div>
			</div>
		</section><!-- End choice -->

		<?php
	}
}