<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Services_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'services_dynamic';
    }

    public function get_title(): string {
        return esc_html__( 'Services Dynamic', 'elementor-lege' );
    }

    public function get_icon(): string {
        return 'eicon-post-list';
    }

    public function get_categories(): array {
        return [ 'lege-widgets' ];
    }

    public function get_keywords(): array {
        return ['service', 'services'];
    }

    // Get Post Types
    private function get_all_post_types() {
        $post_types = get_post_types([ 'public' => true ], 'objects');
        $options = [];
        foreach ($post_types as $pt) {
            $options[$pt->name] = $pt->label;
        }
        return $options;
    }

    // Get Taxonomies 
    private function get_all_taxonomies() {
        $taxonomies = get_taxonomies(['public' => true], 'objects');
        $options = [];
        foreach ($taxonomies as $tax) {
            $options[$tax->name] = $tax->label;
        }
        return $options;
    }

    // Get Terms Dynamically 
    private function get_terms_for_tax($taxonomy) {
        $options = [];

        if (!taxonomy_exists($taxonomy)) {
            return $options;
        }

        $terms = get_terms([
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        ]);

        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
        return $options;
    }

     // Controls
    protected function register_controls(): void {

        $this->start_controls_section(
            'section_content',
            [ 'label' => esc_html__('Content', 'elementor-lege') ]
        );

        $this->add_control(
            'title_small',
            [
                'label' => esc_html__( 'Small Title', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Наши',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_main',
            [
                'label' => esc_html__( 'Main Title', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'услуги',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'View All Button Text', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Все услуги',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'View All Button URL', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [ 'url' => '#' ],
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __( 'Post Type', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_all_post_types(),
                'default' => 'service',
            ]
        );

        $this->add_control(
            'taxonomy',
            [
                'label' => esc_html__( 'Taxonomy', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_all_taxonomies(),
                'default' => 'service-type',
            ]
        );

        $this->add_control(
            'terms',
            [
                'label' => esc_html__( 'Terms', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_terms_for_tax('service-type'),
                'default' => [],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'elementor-lege' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 20,
            ]
        );

        $this->end_controls_section();
    }


     // Render 
    protected function render(): void {
        $settings = $this->get_settings_for_display();

        global $lege_options;
        $currency = $lege_options['servicecurrency'] ?? '$';

        $args = [
            'post_type' => $settings['post_type'],
            'posts_per_page' => $settings['posts_per_page'],
        ];

        if (!empty($settings['taxonomy']) && !empty($settings['terms'])) {
            $args['tax_query'] = [
                [
                    'taxonomy' => $settings['taxonomy'],
                    'field'    => 'slug',
                    'terms'    => $settings['terms'],
                ]
            ];
        }

        $query = new WP_Query($args);
        ?>

        <!-- Services -->
        <section class="services">
            <div class="wrapper">
                <div class="services__wrap">
                    <h2 class="services__title secondary-title">
                        <span><?php echo esc_html($settings['title_small']); ?></span><br>
                        <?php echo esc_html($settings['title_main']); ?>
                    </h2>

                    <?php if (!empty($settings['button_text'])) : ?>
                        <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="services__btn btn" data-content="<?php echo esc_attr($settings['button_text']); ?>">
                            <?php echo esc_html($settings['button_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <ul class="services__list">
                <?php
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();

                        $ID = get_the_ID();

                        // Custom fields
                        $cost  = get_post_meta($ID, 'lege_service_cost', true);
                        $icon  = get_post_meta($ID, 'lege_service_icon', true); // stat, idea, internet 

                        if (!$icon) { $icon = 'stat'; }

                        ?>
                        <li class="services__item services__item_<?php echo esc_attr($icon); ?>">
                            <h3 class="services__heading"><?php the_title(); ?></h3>

                            <p class="services__descr">
                                <?php echo esc_html(get_the_excerpt()); ?>
                            </p>

                            <?php if ($cost): ?>
                                <p class="services__price">
                                    <?php echo esc_html($currency); ?>
                                    <?php echo esc_html($cost); ?>
                                </p>
                            <?php endif; ?>

                            <a href="<?php the_permalink(); ?>" class="services__order btn">
                                <?php echo esc_html__('Подробнее', 'elementor-lege'); ?>
                            </a>

                            <div class="services__bg services__bg_<?php echo esc_attr($icon); ?>"></div>
                        </li>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p><?php esc_html_e('No services found.', 'elementor-lege'); ?></p>
                <?php endif; ?>
                </ul>
            </div>
        </section>

        <?php
    }

    protected function content_template(): void {

    ?> 

    <!-- Services -->
		<section class="services">
			<div class="wrapper">
				<div class="services__wrap">
					<h2 class="services__title secondary-title">
                        <span>{{{ settings.title_small }}}</span><br>
                        {{{ settings.title_main }}}
                    </h2>
					<a href="{{ settings.button_link.url }}" class="services__btn btn">
                        {{{ settings.button_text }}}
                    </a>

				</div>
                
				<ul class="services__list">
                    <# for ( let i = 0; i < settings.posts_per_page; i++ ) { #>
					<li class="services__item services__item_stat">
						<h3 class="services__heading">Корпоративная практика, M&A</h3>
						<p class="services__descr">Услуги в области корпоративного управления, рынков капитала, M&A</p>
						<p class="services__price">$350</p>
						<a href="service.html" class="services__order btn">Подробнее</a>
						<div class="services__bg services__bg_stat"></div>
					</li>
                    <# } #>
				</ul>
                
			</div>
		</section><!-- End services -->
        <?php 
    }

}
