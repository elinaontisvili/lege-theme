<?php
class Elementor_Help_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'help_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Help Widget', 'elementor-lege' );
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

	protected function register_controls(): void { 

        // Content Tab Start 
        $this->start_controls_section( 
            'help_content',
            [
                'label' => esc_html__('Help Section', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'main_title_span',
            [
                'label' => esc_html__('Main Title Span', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Кому мы', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Mian Title', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT, 
                'default' => esc_html__('помогаем', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Мы фокусируемся на юридических вопросах, актуальных для успешного современного бизнеса', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-lege'),
                'type' => Elementor\Controls_Manager::TEXT, 
                'default' => esc_html__('Получить консультацию', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'button_hover_text',
            [
                'label'       => esc_html__( 'Button Hover Text', 'elementor-lege' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html( 'Получить консультацию', 'elementor-lege' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        ); 

        // Item 1 
        $this->add_control(
            'item1_title',
            [
                'label' => esc_html__('Item 1 Title', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Стартапам', 'elementor-lege'),
            ]
        ); 
        
        $this->add_control(
            'item1_text',
            [
                'label' => esc_html__('Item 1 Text', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXTAREA, 
                'default' => esc_html__('Когда вы будете готовы вывести свой стартап на новый уровень, мы можем оказать вам юридические услуги, чтобы помочь вам расти', 'elementor-lege'),
            ]
        );
        
        // Item 2
        $this->add_control(
            'item2_title',
            [
                'label' => esc_html__('Iten 2 Title', 'elementor-lege'), 
                'type' => Elementor\Controls_Manager::TEXT, 
                'default' => esc_html__('Фрилансеру', 'elementor-lege'),
            ]
        );

        $this->add_control(
            'item2_text', 
            [
                'label' => esc_html__('Item 2 Text', 'elementor-lege'), 
                'type' => \Elementor\Controls_Manager::TEXTAREA, 
                'default' => esc_html__('Начать независимый бизнес проще, чем когда-либо...', 'elementor-lege'),
            ]
        );

        // Item 3 
        $this->add_control(
            'item3_title',
            [
                'label' => esc_html__('Item 3 Title', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT, 
                'default' => esc_html__('Малому бизнесу', 'elementor-lege'), 
            ]
        );

        $this->add_control(
            'item3_text', 
            [
                'label' => esc_html__('Item 3 Text', 'elementor-lege'), 
                'type' => \Elementor\Controls_Manager::TEXTAREA, 
                'default' => esc_html__('Мы поможем направить ваш бизнес в правильном направлении...', 'elementor-lege'),
            ]
        );


        $this->end_controls_section();
		// Content Tab End

		// Style Tab Start

        // Main Style Section
        $this->start_controls_section(
            'help_style_section',
            [
                'label' => esc_html__('Main Title', 'elementor-lege'), 
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Main title color
        $this->add_control(
            'help_main_title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR, 
                'selectors' => [
                    '{{WRAPPER}} .help__title' => 'color: {{VALUE}};', 
                    '{{WRAPPER}} .help__title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Main title typography 
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'main_title_typography', 
                'selector' => '{{WRAPPER}} .help__title',
            ]
            ); 

        // Spacing under main title 
        $this->add_responsive_control(
            'main_title_margin',
            [
                'label' => esc_html__('Bottom Spacing', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .help__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        // Description Style Section
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
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .help__descr',
                ]
            );

        $this->end_controls_section();

        // Button Style Section 
        $this->start_controls_section(
            'help_button_style',
            [
                'label' => esc_html__('Button', 'elementor-lege'), 
                'tab' => \Elementor\Controls_Manager::TAB_STYLE, 
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__('Text Color', 'elementor-lege'), 
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .help__btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg',
            [
                'label' => esc_html__('Background Color', 'elementor-lege'), 
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .help__btn' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'btn_color_hover',
            [
                'label' => esc_html__('Hover Text Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR, 
                'selectors' => [
                    '{{WRAPPER}} .help__btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover',
            [
                'label' => esc_html__('Hover Background Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR, 
                'selectors' => [
                    '{{WRAPPER}} .help__btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .help__btn',
            ]
        );

        // Padding 
        $this->add_control(
            'btn_padding',
            [
                'label' => esc_html__('Padding', 'elementor-lege'), 
                'type' => \Elementor\Controls_Manager::DIMENSIONS, 
                'selectors' => [
                    '{{WRAPPER}} .help__btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border Radius 
        $this->add_control(
            'btn_border_radius', 
            [
                'label' => esc_html__('Border Radius', 'elementor-lege'), 
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .help__btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ]
        );

        $this->end_controls_section();


        // Icon & Items Style Section
        $this->start_controls_section(
            'help_items_style',
            [
                'label' => esc_html__('Items', 'elementor-lege'), 
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_heading_color',
            [
                'label' => esc_html__('Heading Color', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::COLOR, 
                'selectors' => [
                    '{{WRAPPER}} .help__heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_text_color',
            [
                'label' => esc_html__('Text Color', 'elementor-lege'), 
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .help__par' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'item_text_typography',
                'selector' => '{{WRAPPER}} .help__par',
            ]
        );
            
        $this->end_controls_section();
		// Style Tab End
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
        $btn_url = $settings['button_link']['url'] ?? '#';
    ?>

    <!-- Help -->
    <section class="help">
        <div class="wrapper">
            <div class="help__block">
                <?php if ( ! empty( $settings['main_title_span'] ) || ! empty( $settings['main_title'] ) ) : ?>
                    <h2 class="help__title secondary-title">
                        <?php if ( ! empty( $settings['main_title_span'] ) ) : ?>
                            <span><?php echo wp_kses_post( $settings['main_title_span'] ); ?></span>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['main_title'] ) ) : ?>
                            <?php echo esc_html( $settings['main_title'] ); ?>
                        <?php endif; ?>
                    </h2>
                <?php endif; ?>

                <p class="help__descr">
                    <?php if ( ! empty( $settings['description'] ) ) : ?>
                        <?php echo esc_html($settings['description']); ?>
                    <?php endif; ?>
                </p>

                <?php if ( ! empty( $settings['button_text'] ) ) : ?>
                    <a href="<?php echo esc_url($btn_url); ?>" class="help__btn btn popup-link" data-content="<?php echo esc_attr( $settings['button_text'] ); ?>">
                        <?php echo esc_html($settings['button_text']); ?>
                    </a>
                <?php endif; ?>

            </div>

            <ul class="help__list">

                <li class="help__item">
                    <div class="help__icon help__icon_rocket"></div>
                    <h4 class="help__heading"><?php echo esc_html($settings['item1_title']); ?></h4>
                    <p class="help__par"><?php echo esc_html($settings['item1_text']); ?></p>
                </li>
                <li class="help__item">
                    <div class="help__icon help__icon_monitor"></div>
                    <h4 class="help__heading"><?php echo esc_html($settings['item2_title']); ?></h4>
                    <p class="help__par"><?php echo esc_html($settings['item2_text']); ?></p>
                </li>
                <li class="help__item">
                    <div class="help__icon help__icon_brain"></div>
                    <h4 class="help__heading"><?php echo esc_html($settings['item3_title']); ?></h4>
                    <p class="help__par"><?php echo esc_html($settings['item3_text']); ?></p>
                </li>
            </ul>
        </div>
    </section><!-- End help -->
   
	<?php

	}

	protected function content_template(): void {
		?>
        
        <!-- Help -->
		<section class="help">
			<div class="wrapper">
				<div class="help__block">

					<h2 class="help__title secondary-title">
                        <span>{{ settings.main_title_span }}</span> 
                        {{ settings.main_title }}
                    </h2>

					<p class="help__descr">
                        {{ settings.description }}
                    </p>
					
                    <a href="{{ settings.button_link.url }}" class="help__btn btn popup-link">
                        {{ settings.button_text}}
                    </a>

				</div>

				<ul class="help__list">

					<li class="help__item">
						<div class="help__icon help__icon_rocket"></div>
						<h4 class="help__heading">{{ settings.item1_title }}</h4>
						<p class="help__par">{{ settings.item1_text }}</p>
					</li>

					<li class="help__item">
						<div class="help__icon help__icon_monitor"></div>
						<h4 class="help__heading">{{ settings.item2_title }}</h4>
						<p class="help__par">{{ settings.item2_text }}</p>
					</li>

					<li class="help__item">
						<div class="help__icon help__icon_brain"></div>
						<h4 class="help__heading">{{ settings.item3_title }}</h4>
						<p class="help__par">{{ settings.item3_text }}</p>
					</li>

				</ul>
			</div>
		</section><!-- End help -->
		<?php
	}
}