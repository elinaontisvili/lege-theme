<?php
/**
 * Elementor Circular Progress Widget
 * 
 * @package Elementor_Lege
 */

if (!defined('ABSPATH')) {
    exit;
}

class Elementor_Progress_Widget extends \Elementor\Widget_Base {

    /**
     * Widget name
     */
    public function get_name(): string {
        return 'circular_progress_widget';
    }

    /**
     * Widget title
     */
    public function get_title(): string {
        return esc_html__('Circular Progress', 'elementor-lege');
    }

    /**
     * Widget icon
     */
    public function get_icon(): string {
        return 'eicon-counter-circle';
    }

    /**
     * Widget categories
     */
    public function get_categories(): array {
        return ['lege-widgets'];
    }

    /**
     * Widget keywords for search
     */
    public function get_keywords(): array {
        return ['progress', 'circular', 'radial', 'percentage', 'stats'];
    }

    /**
     * Register script
     */
    public function get_script_depends(): array {
        return [ 'lege-circular-progress' ];
    }

    // Controls
    protected function register_controls(): void {

    // Content Tab
    $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementor-lege' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
    
    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
        'title',
        [
            'label' => __( 'Title', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Качество обслуживания', 'elementor-lege' ),
            'label_block' => true,
        ]
    );

    $repeater->add_control(
        'percent',
        [
            'label' => __( 'Percentage', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 0,
            'max' => 100,
            'default' => 75,
        ]
    );

    $repeater->add_control(
        'show_percentage',
        [
            'label' => __( 'Show Percentage', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]
    );

    $this->add_control(
        'progress_items',
        [
            'label' => __( 'Progress Items', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
        ]
    );

    $this->end_controls_section(); 

    $this->start_controls_section(
    'style_title',
    [
        'label' => __( 'Title', 'elementor-lege' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
    );

    $this->add_control(
        'title_color',
        [
            'label' => __( 'Color', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .numbers__text' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .numbers__text',
        ]
    );

    $this->end_controls_section();

    // percentage text style 
    $this->start_controls_section(
    'style_percentage',
    [
        'label' => __( 'Percentage Text', 'elementor-lege' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
    );

    $this->add_control(
        'percentage_color',
        [
            'label' => __( 'Color', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} text.percentage' => 'fill: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'percentage_typography',
            'selector' => '{{WRAPPER}} text.percentage',
        ]
    );

    $this->end_controls_section();

    // circle styling 
    $this->start_controls_section(
    'style_circle',
    [
        'label' => __( 'Circle', 'elementor-lege' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
    );

    // * Inactive circle color stays simple (solid only)
    $this->add_control(
        'inactive_color',
        [
            'label' => __( 'Inactive Color', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#e5e5e5',
            'selectors' => [
                '{{WRAPPER}} circle.incomplete' => 'stroke: {{VALUE}};',
            ],
        ]
    );

    // Color Type switch
    $this->add_control(
        'active_color_type',
        [
            'label' => __( 'Active Color Type', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'solid',
            'options' => [
                'solid' => __( 'Solid', 'elementor-lege' ),
                'gradient' => __( 'Gradient', 'elementor-lege' ),
            ],
        ]
    );

    // Solid color
    $this->add_control(
    'active_color',
        [
            'label' => __( 'Active Color', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
            ],
            'condition' => [
                'active_color_type' => 'solid',
            ],
        ]
    );

    // Gradient colors 
    $this->add_control(
    'active_gradient_start',
        [
            'label' => __( 'Gradient Start', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'condition' => [
                'active_color_type' => 'gradient',
            ],
        ]
    );

    $this->add_control(
        'active_gradient_end',
        [
            'label' => __( 'Gradient End', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'condition' => [
                'active_color_type' => 'gradient',
            ],
        ]
    );

    $this->add_control(
        'stroke_width',
        [
            'label' => __( 'Stroke Width', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [ 'min' => 1, 'max' => 20 ],
            ],
            'default' => [ 'size' => 8 ],
            'selectors' => [
                '{{WRAPPER}} circle' => 'stroke-width: {{SIZE}}px;',
            ],
        ]
    );

    $this->end_controls_section();
       
    }

    // Render
    protected function render(): void {

    $settings = $this->get_settings_for_display();
    $gradient_id = 'progress-gradient-' . $this->get_id();


    if ( empty( $settings['progress_items'] ) ) {
        return;
    }
    ?>


    <?php
    foreach ( $settings['progress_items'] as $index => $item ) :

    $percent = (int) $item['percent'];
    $uid = $this->get_id() . '-' . $index;

    ?>

    <div class="numbers__item">
        <svg class="radial-progress"
            data-percentage="<?php echo esc_attr( $percent ); ?>"
            viewBox="0 0 80 80">

            <?php if ( $settings['active_color_type'] === 'gradient' ) : ?>
            <defs>
                <linearGradient id="<?php echo esc_attr( $gradient_id ); ?>" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="<?php echo esc_attr( $settings['active_gradient_start'] ); ?>" />
                    <stop offset="100%" stop-color="<?php echo esc_attr( $settings['active_gradient_end'] ); ?>" />
                </linearGradient>
            </defs>
            <?php endif; ?>

            <circle class="incomplete" cx="40" cy="40" r="35"></circle> 
            <circle
                class="complete"
                cx="40"
                cy="40"
                r="35"
                style="
                    stroke: <?php
                        echo ( $settings['active_color_type'] === 'gradient' )
                            ? 'url(#' . esc_attr( $gradient_id ) . ')'
                            : esc_attr( $settings['active_color'] );
                    ?>;
                "
            ></circle>

            <?php if ( 'yes' === $item['show_percentage'] ) : ?>
                <text class="percentage"
                    x="50%" y="57%"
                    transform="matrix(0, 1, -1, 0, 80, 0)"></text>
            <?php endif; ?>

        </svg>

        <span class="numbers__text">
            <?php echo esc_html( $item['title'] ); ?>
        </span>
    </div>

    <?php endforeach; ?>

    <?php 
    }
}