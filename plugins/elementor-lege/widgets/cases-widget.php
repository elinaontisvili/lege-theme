<?php
/**
 * Elementor Multiple Tabs – Dynamic Post Types + Taxonomies
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Cases_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'cases_dynamic_multi';
    }

    public function get_title() {
        return __( 'Cases Dynamic Multi', 'elementor-lege' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'lege-widgets' ];
    }

      public function get_keywords(): array {
        return ['cases'];
    }

    // Get all post types 
    private function get_all_post_types() {
        $post_types = get_post_types( [ 'public' => true ], 'objects' );
        $options = [];
        foreach ( $post_types as $pt ) {
            $options[$pt->name] = $pt->label;
        }
        return $options;
    }

    // Get all taxonomies 
    private function get_all_taxonomies() {
        $taxonomies = get_taxonomies( [ 'public' => true ], 'objects' );
        $options = [];
        foreach ( $taxonomies as $tax ) {
            $options[$tax->name] = $tax->label;
        }
        return $options;
    }

    /* Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_tabs',
            [ 'label' => __( 'Tabs', 'elementor-lege' ) ]
        );

        // Main title 
        $this->add_control(
            'main_title_span',
            [
                'label' => esc_html__( 'Title Small Letters', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Наши',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__( 'Main Title', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'кейсы',
                'label_block' => true,
            ]
        );

        // Small description 
        $this->add_control(
            'section_description',
            [
                'label' => esc_html__( 'Section Description', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Кейсы – это описание конкретной ситуации ...',
                'label_block' => true,
            ]
        );

        // Tabs repeater
        $repeater = new \Elementor\Repeater();

        // Tab title
        $repeater->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Новый таб',
            ]
        );

        // Post Type
        $repeater->add_control(
            'post_type',
            [
                'label' => __( 'Post Type', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_all_post_types(),
                'default' => 'post'
            ]
        );

        // Taxonomy
        $repeater->add_control(
            'taxonomy',
            [
                'label' => __( 'Taxonomy', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_all_taxonomies(),
                'default' => '',
            ]
        );

        // Taxonomy Term (text input)
        $repeater->add_control(
            'taxonomy_term',
            [
                'label' => __( 'Term Slug', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'example-term-slug', 'elementor-lege' ),
                'description' => __( 'Enter term slug to filter posts.', 'elementor-lege' )
            ]
        );

        // Posts per tab
        $repeater->add_control(
            'posts_per_page',
            [
                'label' => __( 'Posts Per Tab', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4
            ]
        );

        // Button
        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Читать больше'
            ]
        );

        // Repeater
        $this->add_control(
            'tabs_list',
            [
                'label' => __( 'Tabs List', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        // Button (view more cases)
        $this->add_control(
            'more_button_text',
            [
                'label' => esc_html__( 'Show More Button Text', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html('Показать больше кейсов', 'elementor-lege' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'more_button_url',
            [
                'label' => esc_html__( 'Show More Button URL', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab 
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Sections & Titles', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'main_title_color',
            [
                'label'     => __( 'Main Title Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cases__title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'main_title_typography',
                'selector' => '{{WRAPPER}} .cases__title',
            ]
        );

        $this->add_control(
            'main_title_span_color',
            [
                'label'     => __( 'Small Title (span) Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cases__title span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'main_title_span_typography',
                'selector' => '{{WRAPPER}} .cases__title span',
            ]
        );

        $this->add_control(
            'section_description_color',
            [
                'label'     => __( 'Description Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs__descr' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'section_description_typography',
                'selector' => '{{WRAPPER}} .tabs__descr',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Tabs
        $this->start_controls_section(
            'style_tabs_section',
            [
                'label' => __( 'Tabs', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label'     => __( 'Tab Text Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs__caption li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tab_active_text_color',
            [
                'label'     => __( 'Active Tab Text Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs__caption li.active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tab_border_color',
            [
                'label'     => __( 'Tab Bottom Border', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs__caption li' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tabs_typography',
                'selector' => '{{WRAPPER}} .tabs__caption li',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Cases 
        $this->start_controls_section(
            'style_cards_section',
            [
                'label' => __( 'Case Cards', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'card_background',
                'selector' => '{{WRAPPER}} .cases__item',
                'types'    => [ 'classic', 'gradient' ],
            ]
        );

        $this->add_control(
            'card_padding',
            [
                'label'      => __( 'Padding', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .cases__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_radius',
            [
                'label'      => __( 'Border Radius', 'elementor-lege' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .cases__item, {{WRAPPER}} .cases__img img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Buttons 
        $this->start_controls_section(
            'style_buttons_section',
            [
                'label' => __( 'Buttons', 'elementor-lege' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __( 'Text Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cases__link' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'     => __( 'Hover Text Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cases__link:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'more_button_color',
            [
                'label'     => __( '"Show More" Button Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cases__more' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'more_button_color_hover',
            [
                'label'     => __( '"Show More" Hover Color', 'elementor-lege' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cases__more:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Render 
    protected function render() {
        $settings = $this->get_settings_for_display();
        $tabs = $settings['tabs_list'];

        if ( empty( $tabs ) || ! is_array( $tabs ) ) {
            echo '<p>No tabs configured.</p>';
            return;
        }
        ?>

        <section class="cases tabs">
            <div class="wrapper">

                <h2 class="cases__title secondary-title">
                    <span><?php echo esc_html( $settings['main_title_span'] ); ?></span><br>
                    <?php echo esc_html( $settings['main_title'] ); ?>
                </h2>

                <div class="tabs__wrap">
                <?php if ( ! empty( $settings['section_description'] ) ) : ?>
                    <p class="tabs__descr"><?php echo esc_html( $settings['section_description'] ); ?></p>
                <?php endif; ?>

                    <!-- Tab titles -->
                    <ul class="tabs__caption">
                        <?php foreach ( $tabs as $index => $tab ) : ?>
                            <li class="<?php echo $index === 0 ? 'active' : ''; ?>">
                                <?php echo esc_html( $tab['tab_title'] ?? 'Untitled' ); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Tab content -->
                <?php foreach ( $tabs as $index => $tab ) : ?>

                    <div class="tabs__content <?php echo $index === 0 ? 'active' : ''; ?>">

                        <?php
                        $query_args = [
                            'post_type'      => $tab['post_type'] ?? 'post',
                            'posts_per_page' => absint( $tab['posts_per_page'] ?? 4 ),
                        ];

                        if ( ! empty( $tab['taxonomy'] ) && ! empty( $tab['taxonomy_term'] ) ) {
                            $query_args['tax_query'] = [
                                [
                                    'taxonomy' => $tab['taxonomy'],
                                    'field'    => 'slug',
                                    'terms'    => $tab['taxonomy_term'],
                                ]
                            ];
                        }

                        $query = new WP_Query( $query_args );

                        if ( $query->have_posts() ) :
                            while ( $query->have_posts() ) :
                                $query->the_post();

                                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                                if ( ! $img ) {
                                    $img = 'https://placehold.co/600x400?text=No+Image';
                                }
                                ?>

                                <div class="cases__item">
                                    <div class="cases__block">
                                        <h3 class="cases__heading"><?php echo esc_html( get_the_title() ); ?></h3>

                                        <a href="<?php the_permalink(); ?>" class="cases__link link-more">
                                            <?php echo esc_html( $tab['button_text'] ); ?>
                                            <svg width="18" height="20"><use xlink:href="#nav-right"/></svg>
                                        </a>
                                    </div>
                                    <div class="cases__img">
                                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                                    </div>
                                </div>

                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>No posts found.</p>';
                        endif;
                        ?>

                    </div>

                <?php endforeach; ?>

                <?php if ( ! empty( $settings['more_button_text'] ) ) : ?>
                    <a href="<?php echo esc_url( $settings['more_button_url']['url'] ); ?>" class="cases__more link-more">
                        <?php echo esc_html( $settings['more_button_text'] ); ?>
                        <svg width="18" height="20">
                            <use xlink:href="#nav-right"/>
                        </svg>
                    </a>
                <?php endif; ?>

            </div>
        </section>

        <?php
    }

    // Live preview
    protected function content_template(): void {
        ?>
        <section class="cases tabs">
        <div class="wrapper">


            <h2 class="cases__title secondary-title">
                <span>{{{ settings.main_title_span }}}</span><br>
                {{{ settings.main_title }}}
            </h2>


            <div class="tabs__wrap">
                <# if ( settings.section_description ) { #>
                    <p class="tabs__descr">{{{ settings.section_description }}}</p>
                <# } #>

                <!-- Tab titles -->
                <ul class="tabs__caption">
                    <# if ( settings.tabs_list.length ) {
                        _.each( settings.tabs_list, function( tab, index ) { #>
                            <li class="{{ index === 0 ? 'active' : '' }}">{{{ tab.tab_title }}}</li>
                        <# });
                    } else { #>
                        <li>No tabs</li>
                    <# } #>
                </ul>
            </div>

            <!-- Tab content -->
            <# if ( settings.tabs_list.length ) {
                _.each( settings.tabs_list, function( tab, index ) { #>


                    <div class="tabs__content {{ index === 0 ? 'active' : '' }}">
                        <#
                        let previewCount = tab.posts_per_page ? tab.posts_per_page : 3;
                        for ( let i = 0; i < previewCount; i++ ) {
                        #>

                            <div class="cases__item">
                                <div class="cases__block">
                                    <h3 class="cases__heading">Preview Title</h3>
                                    <a href="#" class="cases__link link-more">
                                        {{{ tab.button_text }}}
                                        <svg width="18" height="20"><use xlink:href="#nav-right"/></svg>
                                    </a>
                                </div>
                                <div class="cases__img">
                                    <img src="https://placehold.co/600x400" alt="">
                                </div>
                            </div>


                        <# } #>
                    </div>


                <# });
            } #>

            <# if ( settings.more_button_text ) { #>
                <a href="{{ settings.more_button_url.url }}" class="cases__more link-more">
                    {{{ settings.more_button_text }}}
                    <svg width="18" height="20"><use xlink:href="#nav-right"/></svg>
                </a>
            <# } #>

        </div>
    </section>
        <?php
    }
}
