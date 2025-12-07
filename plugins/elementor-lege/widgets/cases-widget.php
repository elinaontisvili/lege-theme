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
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $tabs = $settings['tabs_list'];
        ?>

        <section class="cases tabs">
            <div class="wrapper">

                <h2 class="cases__title secondary-title">
                    <span><?php echo $settings['main_title_span']; ?></span><br>
                    <?php echo $settings['main_title']; ?>
                </h2>

                <div class="tabs__wrap">
                <?php if ( ! empty( $settings['section_description'] ) ) : ?>
                    <p class="tabs__descr"><?php echo $settings['section_description']; ?></p>
                <?php endif; ?>

                    <!-- Tab titles -->
                    <ul class="tabs__caption">
                        <?php foreach ( $tabs as $index => $tab ) : ?>
                            <li class="<?php echo $index === 0 ? 'active' : ''; ?>">
                                <?php echo esc_html( $tab['tab_title'] ); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Tab content -->
                <?php foreach ( $tabs as $index => $tab ) : ?>

                    <div class="tabs__content <?php echo $index === 0 ? 'active' : ''; ?>">

                        <?php
                        $query_args = [
                            'post_type'      => $tab['post_type'],
                            'posts_per_page' => $tab['posts_per_page'],
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
                                    $img = 'https://via.placeholder.com/600x400?text=No+Image';
                                }
                                ?>

                                <div class="cases__item">
                                    <div class="cases__block">
                                        <h3 class="cases__heading"><?php the_title(); ?></h3>

                                        <a href="<?php the_permalink(); ?>" class="cases__link link-more">
                                            <?php echo esc_html( $tab['button_text'] ); ?>
                                            <svg width="18" height="20"><use xlink:href="#nav-right"/></svg>
                                        </a>
                                    </div>
                                    <div class="cases__img">
                                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>">
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
}
