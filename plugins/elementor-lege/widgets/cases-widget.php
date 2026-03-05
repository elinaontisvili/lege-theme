<?php
/**
 * Elementor Multiple Tabs – Dynamic Post Types + Taxonomies
 * 
 * @package Elementor_Lege
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Cases_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'cases_dynamic_multi';
    }

    public function get_title() {
        return __( 'Lege Cases Dynamic Multi', 'elementor-lege' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'lege-widgets' ];
    }

      public function get_keywords(): array {
        return ['cases', 'projects', 'our works'];
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
        $options = [
            '' => esc_html__( '— Select taxonomy —', 'elementor-lege' ),
        ];
        foreach ( $taxonomies as $tax ) {
            $options[$tax->name] = $tax->label;
        }
        return $options;
    }

    /*--------------------------------------------------------------
    # CONTROLS
    --------------------------------------------------------------*/
    protected function register_controls() {

    $this->start_controls_section(
        'section_tabs',
        [ 'label' => esc_html__( 'Tabs', 'elementor-lege' ) ]
    );

    /* Main title */
    $this->add_control(
        'cases_above_title',
        [
            'label' => esc_html__( 'Subheading', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'dynamic' => [ 'active' => true ],
            'default' => esc_html__('Our', 'elementor-lege'),
            'label_block' => true,
        ]
    );

    $this->add_control(
        'cases_main_title',
        [
            'label' => esc_html__( 'Heading', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'dynamic' => [ 'active' => true ],
            'default' => esc_html__('cases', 'elementor-lege'),
            'label_block' => true,
        ]
    );

    $this->add_control(
        'cases_title_tag',
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

    /* Description */
    $this->add_control(
        'cases_section_description',
        [
            'label' => esc_html__( 'Description', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'dynamic' => [ 'active' => true ],
            'default' => esc_html__('Cases are descriptions of a specific situation...', 'elementor-lege'),
            'label_block' => true,
        ]
    );

    /* Tabs repeater */
    $repeater = new \Elementor\Repeater();

    /* Tab title */
    $repeater->add_control(
        'cases_tab_title',
        [
            'label' => esc_html__( 'Tab Title', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'dynamic' => [ 'active' => true ],
            'default' => esc_html__('New tab', 'elementor-lege')
        ]
    );

    /* Post Type control */
    $repeater->add_control(
        'post_type',
        [
            'label' => esc_html__( 'Post Type', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $this->get_all_post_types(),
            'default' => 'feature'
        ]
    );

    /* Taxonomy */
    $repeater->add_control(
        'taxonomy',
        [
            'label' => esc_html__( 'Taxonomy', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $this->get_all_taxonomies(),
            'default' => '',
            'description' => esc_html__( 'Select a taxonomy to enable term filtering.', 'elementor-lege' ),
        ]
    );

    /* Taxonomy Term (text input) */
    $repeater->add_control(
        'taxonomy_term',
        [
            'label' => esc_html__( 'Term Slug', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'dynamic' => [ 'active' => true ],
            'placeholder' => esc_html__( 'term-slug', 'elementor-lege' ),
            'description' => esc_html__( 'Enter term slug to filter posts.', 'elementor-lege' ),
            'condition'   => [
                'taxonomy!' => '',
            ],
        ]
    );

    /* Posts per tab */
    $repeater->add_control(
        'posts_per_page',
        [
            'label' => esc_html__( 'Posts Per Tab', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 4
        ]
    );

    /* Button */
    $repeater->add_control(
        'cases_button_text',
        [
            'label' => esc_html__( 'Button Text', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'dynamic' => [ 'active' => true ],
            'default' => esc_html__('Read more', 'elementor-lege'),
        ]
    );

    /* Repeater */
    $this->add_control(
        'cases_tabs_list',
        [
            'label' => esc_html__( 'Tabs List', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ cases_tab_title }}}',
            'prevent_empty' => false,
        ]
    );

    /* Fallback image */
    $this->add_control(
        'cases_fallback_image',
        [
            'label' => esc_html__( 'Fallback Image', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'description' => esc_html__( 'Image shown if a post does not have a featured image.', 'elementor-lege' ),
        ]
    );

    /* Button (view more cases) */
    $this->add_control(
        'cases_more_button_text',
        [
            'label' => esc_html__( 'Button Text', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'dynamic' => [ 'active' => true ],
            'default' => esc_html__('Show more cases', 'elementor-lege' ),
            'label_block' => true,
        ]
    );

    $this->add_control(
        'cases_more_button_url',
        [
            'label' => esc_html__( 'Button URL', 'elementor-lege' ),
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
        'cases_style_section',
        [
            'label' => esc_html__( 'Heading', 'elementor-lege' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'cases_title_color',
        [
            'label'     => esc_html__( 'Color', 'elementor-lege' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cases__title' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'cases_main_title_typography',
            'selector' => '{{WRAPPER}} .cases__title',
        ]
    );

    $this->end_controls_section();

    // Description
    $this->start_controls_section(
        'cases_style_section_description',
        [
            'label' => esc_html__( 'Description', 'elementor-lege' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'cases_section_description_color',
        [
            'label'     => esc_html__( 'Color', 'elementor-lege' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tabs__descr' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'cases_section_description_typography',
            'selector' => '{{WRAPPER}} .tabs__descr',
        ]
    );

    $this->end_controls_section();

    /* =========================
    * TABS SECTION
    * ========================= */
    $this->start_controls_section(
        'cases_style_tabs_section',
        [
            'label' => esc_html__( 'Tabs', 'elementor-lege' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'cases_tab_text_color',
        [
            'label'     => esc_html__( 'Text Color', 'elementor-lege' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tabs__caption li' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'cases_tabs_hover_color',
        [
            'label' => esc_html__( 'Hover Text Color', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tabs__caption li' => '--tabs-hover-color: {{VALUE}};',
            ],
        ]
    );

    /* Divider color */
    $this->add_control(
        'cases_tabs_divider_color',
        [
            'label' => esc_html__( 'Divider Color', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tabs__caption li' => '--tabs-divider-color: {{VALUE}};',
            ],
        ]
    );

    /* Tabs Active gradient color 1 */
    $this->add_control(
        'cases_tabs_active_color_1',
        [
            'label' => esc_html__( 'Active Gradient Color 1', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tabs__caption li' => '--tabs-active-color-1: {{VALUE}};',
            ],
        ]
    );

    /* Tabs Active gradient color 2 */
    $this->add_control(
        'cases_tabs_active_color_2',
        [
            'label' => esc_html__( 'Active Gradient Color 2', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tabs__caption li' => '--tabs-active-color-2: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'cases_tab_active_text_color',
        [
            'label'     => esc_html__( 'Active Text Color', 'elementor-lege' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tabs__caption li' => '--tabs-active-text: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'cases_tabs_typography',
            'selector' => '{{WRAPPER}} .tabs__caption li',
        ]
    );

    $this->end_controls_section();

    /* =========================
    * CASE CARDS
    * ========================= */
    $this->start_controls_section(
        'cases_style_cards_section',
        [
            'label' => esc_html__( 'Case Cards', 'elementor-lege' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'cases_cart_title_text_color',
        [
            'label'     => esc_html__( 'Card Heading Color', 'elementor-lege' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cases__heading' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'heading_cases_typography',
            'selector' => '{{WRAPPER}} .cases__heading',
        ]
    );

    /* Link */
    $this->add_responsive_control(
        'cases_link_color',
        [
            'label'     => esc_html__( 'Link Color', 'elementor-lege' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cases__link' => '--link-more-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_responsive_control(
        'cases_link_color_hover',
        [
            'label'     => esc_html__( 'Link Hover Color', 'elementor-lege' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cases__link' => '--link-more-hover-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'cases_link_typography',
            'label' => esc_html__('Link Typography', 'elementor-lege'),
            'selector' => '{{WRAPPER}} .cases__link',
        ]
    );

    /* =========================
    * Card Background
    * ========================= */

    $this->add_control(
    'cases_bg_color',
        [
            'label' => esc_html__( 'Card Background', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cases__item' => '--cases-bg: {{VALUE}};',
            ],
        ]
    );

    /* Hover gradient bg */
    $this->add_responsive_control(
        'cases_hover_color_1',
        [
            'label' => esc_html__( 'Hover Gradient Color 1', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cases__item' => '--cases-hover-color-1: {{VALUE}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'cases_hover_color_2',
        [
            'label' => esc_html__( 'Hover Gradient Color 2', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cases__item' => '--cases-hover-color-2: {{VALUE}};',
            ],
        ]
    );

    /* Hover opacity */
    $this->add_control(
    'cases_hover_opacity',
        [
            'label' => esc_html__( 'Hover Opacity', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1,
                    'step' => 0.05,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cases__item' => '--cases-hover-opacity: {{SIZE}};',
            ],
        ]
    );

    /* Image overlay color */
    $this->add_responsive_control(
        'cases_overlay_color',
        [
            'label' => esc_html__( 'Image Overlay Color', 'elementor-lege' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cases__item' => '--cases-overlay: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_section();

    /* =========================
    * CTA BUTTON
    * ========================= */
    $this->start_controls_section(
        'cases_style_buttons_section',
        [
            'label' => esc_html__( 'CTA Button', 'elementor-lege' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'cases_more_button_color',
        [
            'label'     => esc_html__( 'CTA Button Color', 'elementor-lege' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cases__more' => '--cases-link-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'cases_more_button_color_hover',
        [
            'label'     => esc_html__( 'CTA Hover Color', 'elementor-lege' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cases__more:hover' => '--cases-link-hover-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'cta_button_cases_typography',
            'selector' => '{{WRAPPER}} .cases__more',
        ]
    );

    $this->end_controls_section();

    // Style tab end

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $tabs     = $settings['cases_tabs_list'] ?? [];

        if ( empty( $tabs ) || ! is_array( $tabs ) ) {
            echo '<p>' . esc_html__( 'No tabs configured.', 'elementor-lege' ) . '</p>';
            return;
        }

        $title_tag        = \Elementor\Utils::validate_html_tag( $settings['cases_title_tag'] ?? 'h2' );
        $fallback_img_url = ! empty( $settings['cases_fallback_image']['url'] )
            ? $settings['cases_fallback_image']['url']
            : plugins_url( 'assets/images/placeholder-vertical.jpg', __FILE__ );
    ?>

    <section class="cases tabs">
        <div class="wrapper">

            <?php if ( ! empty( $settings['cases_above_title'] ) || ! empty( $settings['cases_main_title'] ) ) : ?>
                <<?php echo esc_html( $title_tag ); ?> class="cases__title secondary-title">
                    <?php if ( ! empty( $settings['cases_above_title'] ) ) : ?>
                        <span><?php echo esc_html( $settings['cases_above_title'] ); ?></span><br>
                    <?php endif; ?>
                    <?php echo esc_html( $settings['cases_main_title'] ); ?>
                </<?php echo esc_html( $title_tag ); ?>>
            <?php endif; ?>

            <div class="tabs__wrap">
                <?php if ( ! empty( $settings['cases_section_description'] ) ) : ?>
                    <p class="tabs__descr"><?php echo esc_html( $settings['cases_section_description'] ); ?></p>
                <?php endif; ?>

                <ul class="tabs__caption">
                    <?php foreach ( $tabs as $index => $tab ) : ?>
                        <li class="<?php echo $index === 0 ? 'active' : ''; ?>">
                            <?php echo esc_html( $tab['cases_tab_title'] ?? 'Untitled' ); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php foreach ( $tabs as $index => $tab ) : 

                $query_args = [
                    'post_type'              => $tab['post_type'] ?? 'feature',
                    'posts_per_page'         => absint( $tab['posts_per_page'] ?? 4 ),
                    'post_status'            => 'publish',
                    'no_found_rows'          => true,
                    'ignore_sticky_posts'    => true,
                    'update_post_meta_cache' => false,
                    'update_post_term_cache' => false,
                ];

                // Add taxonomy filter if set
                if ( ! empty( $tab['taxonomy'] ) && ! empty( $tab['taxonomy_term'] ) ) {
                    $query_args['tax_query'] = [
                        [
                            'taxonomy' => $tab['taxonomy'],
                            'field'    => 'slug',
                            'terms'    => $tab['taxonomy_term'],
                        ],
                    ];
                }

                $query = new \WP_Query( $query_args );
            ?>

            <div class="tabs__content <?php echo $index === 0 ? 'active' : ''; ?>">

                <?php if ( $query->have_posts() ) : ?>

                    <?php while ( $query->have_posts() ) : $query->the_post();

                        $img = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: $fallback_img_url;
                    ?>

                        <div class="cases__item">
                            <div class="cases__block">
                                <h3 class="cases__heading"><?php the_title(); ?></h3>

                                <a href="<?php echo esc_url( get_permalink() ); ?>" class="cases__link link-more">
                                    <?php echo esc_html( $tab['cases_button_text'] ?? 'Read More' ); ?>
                                    <svg width="18" height="20"><use xlink:href="#nav-right"/></svg>
                                </a>
                            </div>

                            <div class="cases__img">
                                <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                        </div>

                    <?php endwhile; wp_reset_postdata(); ?>

                <?php else : ?>
                    <p><?php echo esc_html__( 'No posts found.', 'elementor-lege' ); ?></p>
                <?php endif; ?>

            </div>

            <?php endforeach; ?>

            <?php if ( ! empty( $settings['cases_more_button_text'] ) ) : ?>
                <?php $this->add_link_attributes( 'more_button', $settings['cases_more_button_url'] ); ?>
                <a class="cases__more link-more" <?php $this->print_render_attribute_string( 'more_button' ); ?>>
                    <?php echo esc_html( $settings['cases_more_button_text'] ); ?>
                    <svg width="18" height="20"><use xlink:href="#nav-right"/></svg>
                </a>
            <?php endif; ?>

        </div>
    </section>

    <?php
    }

    protected function content_template(): void {
    ?>
    <#
    var titleTag = elementor.helpers.validateHTMLTag( settings.cases_title_tag ) || 'h2';
    
    var fallbackImg = '';
    if ( settings.cases_fallback_image && settings.cases_fallback_image.url ) {
        fallbackImg = settings.cases_fallback_image.url;
    }
    #>
    
    <section class="cases tabs">
        <div class="wrapper">

            <# if ( settings.cases_above_title || settings.cases_main_title ) { #>
                <{{ titleTag }} class="cases__title secondary-title">
                    <# if ( settings.cases_above_title ) { #>
                        <span>{{ settings.cases_above_title }}</span><br>
                    <# } #>
                    {{ settings.cases_main_title }}
                </{{ titleTag }}>
            <# } #>

            <div class="tabs__wrap">
                <# if ( settings.cases_section_description ) { #>
                    <p class="tabs__descr">{{ settings.cases_section_description }}</p>
                <# } #>

                <ul class="tabs__caption">
                    <# if ( settings.cases_tabs_list && settings.cases_tabs_list.length ) {
                        _.each( settings.cases_tabs_list, function( tab, index ) { #>
                            <li class="{{ index === 0 ? 'active' : '' }}">{{ tab.cases_tab_title || 'Untitled' }}</li>
                        <# });
                    } else { #>
                        <li>No tabs</li>
                    <# } #>
                </ul>
            </div>

            <# if ( settings.cases_tabs_list && settings.cases_tabs_list.length ) {
                _.each( settings.cases_tabs_list, function( tab, index ) { #>

                    <div class="tabs__content {{ index === 0 ? 'active' : '' }}">
                        <#
                        var previewCount = tab.posts_per_page ? tab.posts_per_page : 4;
                        for ( var i = 0; i < previewCount; i++ ) {
                        #>
                            <div class="cases__item">
                                <div class="cases__block">
                                    <h3 class="cases__heading">Preview Post Title</h3>
                                    <a href="#" class="cases__link link-more">
                                        {{{ tab.cases_button_text || 'Read more' }}}
                                        <svg width="18" height="20"><use xlink:href="#nav-right"/></svg>
                                    </a>
                                </div>
                                <div class="cases__img">
                                    <# if ( fallbackImg ) { #>
                                        <img src="{{ fallbackImg }}" alt="Preview">
                                    <# } else { #>
                                        <div class="elementor-engine-placeholder" style="width:100%; height:200px; background:#ccc; display:flex; align-items:center; justify-content:center;">Image Placeholder</div>
                                    <# } #>
                                </div>
                            </div>
                        <# } #>
                    </div>

                <# });
            } #>

            <# if ( settings.cases_more_button_text ) { #>
                <a href="{{ settings.cases_more_button_url ? settings.cases_more_button_url.url : '#' }}" class="cases__more link-more">
                    {{{ settings.cases_more_button_text }}}
                    <svg width="18" height="20"><use xlink:href="#nav-right"/></svg>
                </a>
            <# } #>

        </div>
    </section>
    <?php
    }
}
