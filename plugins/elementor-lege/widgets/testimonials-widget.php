<?php
class Elementor_Testimonials_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'testimonials_widget';
    }

    public function get_title(): string {
        return esc_html__( 'Testimonials Widget', 'elementor-lege' );
    }

    public function get_icon(): string {
        return 'eicon-tabs';
    }

    public function get_categories(): array {
        return [ 'lege-widgets' ];
    }

    public function get_keywords(): array {
        return [ 'testimonials', 'reviews', 'feedback' ];
    }

    // Load all public post types 
    private function get_all_post_types() {
        $types = get_post_types([ 'public' => true ], 'objects');
        $options = [];

        // Отфильтровать нежелательные типы
        $exclude = ['attachment', 'elementor_library'];

        foreach ($types as $key => $pt) {
            if (!in_array($key, $exclude) && substr( $key, 0, 4 ) !== 'nav_') {
                $options[$key] = $pt->label;
            }
        }
        return $options;
    }

    protected function register_controls(): void {

        // CONTENT TAB

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-lege'),
            ]
        );

        // Title Span
        $this->add_control(
            'title_span',
            [
                'label' => __('Title Span (first line)', 'elementor-lege'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'За нас говорят',
            ]
        );

        // Main Title
        $this->add_control(
            'title_main',
            [
                'label'   => __('Main Title (second line)', 'elementor-lege'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'наши клиенты',
            ]
        );

        // Select post type
        $this->add_control(
            'post_type',
            [
                'label'   => __('Select Post Type', 'elementor-lege'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_all_post_types(),
                'default' => 'post'
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => __('Number of Posts', 'elementor-lege'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {

    $s = $this->get_settings_for_display();
    $current_post_type = $s['post_type'];

    $query = new WP_Query([
        'post_type'      => $current_post_type,
        'posts_per_page' => $s['posts_per_page'],
    ]);

    $is_testimonial_cpt = ($current_post_type === 'testimonial');
    $prefix = "lege_";

    ?>
    <section class="clients">
        <div class="wrapper">

            <h2 class="clients__title secondary-title">
                <span><?php echo esc_html($s['title_span']); ?></span><br>
                <?php echo esc_html($s['title_main']); ?>
            </h2>

            <div class="clients__slider">

                <?php
                $total = $query->found_posts;
                $i = 0;

                if ($query->have_posts()):
                    while ($query->have_posts()):
                        $query->the_post();

                        // Fetch custom metabox data start
                        $social_link = '';
                        $display_date = get_the_date('d.m.Y'); // Default to post creation date

                        if ($is_testimonial_cpt) {
                            $social_link = get_post_meta(get_the_ID(), $prefix . 'social_link', true);
                            $custom_date = get_post_meta(get_the_ID(), $prefix . 'testy_date', true);
                            
                            if (!empty($custom_date)) {
                                $timestamp = strtotime($custom_date);
                                if ($timestamp !== false) {
                                    $display_date = date('d.m.Y', $timestamp);
                                } else {
                                    $display_date = $custom_date; 
                                }
                            }
                        }
                    
                        $link_url = !empty($social_link) ? esc_url($social_link) : '#'; // falling back to '#'
                        // Fetch custom metabox data end


                        $i++;

                        // middle slide should be active
                        $active = ($i === ceil($total / 2)) ? ' active' : '';

                        $image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        if (!$image) {
                            $image = \Elementor\Utils::get_placeholder_image_src(); // Better Elementor fallback
                        }
                        ?>

                        <div class="clients__slide<?php echo $active; ?>">
                            <div class="clients__box">

                                <div class="clients__photo">
                                    <div class="clients__img">
                                        <img src="<?php echo esc_url($image); ?>"
                                             alt="<?php echo esc_attr(get_the_title()); ?>">
                                    </div>

                                    <?php if (!empty($social_link) || $is_testimonial_cpt): ?>
                                        <a href="<?php echo $link_url; ?>" class="clients__link" target="_blank" rel="noopener">
                                            <svg width="14" height="17">
                                                <use xlink:href="#facebook"/>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="clients__say">
                                    <p class="clients__name"><?php the_title(); ?></p>

                                    <div class="clients__text">
                                        <?php /* echo apply_filters('the_content', get_the_content()); */ ?>

                                        <?php /* Trim content
                                        $content = get_the_content();
                                        $trimmed = wp_trim_words( $content, 130, '...' );
                                        echo apply_filters('the_content', $trimmed);
                                        */ ?>

                                        <?php // Metabox for testimonial content for the slider
                                        $frontpage_testimonial = get_post_meta(get_the_ID(), $prefix . 'testy_frontpage', true);

                                        if ( !empty($frontpage_testimonial) ) {
                                            echo apply_filters('the_content', $frontpage_testimonial);
                                        } else {
                                            echo apply_filters('the_content', get_the_content());
                                        }
                                        ?>

                                    </div>
                                </div>

                                <div class="add-time">
                                    <svg width="13" height="13">
                                        <use xlink:href="#time"/>
                                    </svg>
                                    <p class="add-time__date"><?php echo esc_html($display_date); ?></p>
                                </div>
                            </div>

                        </div>

                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>

            </div>
        </div>
    </section>
    <?php
    }
}
?>