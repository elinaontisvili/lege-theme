<?php 
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lege
 */

get_header(); 

global $lege_options;

$services_types = get_terms([
    'taxonomy'   => 'service-type',
    'hide_empty' => true,
]);

if (!empty($services_types) && !is_wp_error($services_types)) :
?>

<section class="inner services tabs">
    <div class="wrapper">

        <h2 class="services__title secondary-title">
            <span><?php echo esc_html($lege_options['servicearchivetitle11'] ?? ''); ?></span><br>
            <?php echo esc_html($lege_options['servicearchivetitle12'] ?? ''); ?>
        </h2>

        <div class="tabs__wrap">
            <p class="tabs__descr">
                <?php echo wp_kses_post($lege_options['servicearchivedesc'] ?? ''); ?>
            </p>

            <ul class="tabs__caption">
                <?php foreach ($services_types as $index => $type) : ?>
                    <li class="<?php echo $index === 0 ? 'active' : ''; ?>">
                        <?php echo esc_html($type->name); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php foreach ($services_types as $index => $category) : ?>

            <div class="tabs__content <?php echo $index === 0 ? 'active' : ''; ?>">
                <ul class="services__list">

                <?php
                $services = new WP_Query([
                    'post_type'              => 'service',
                    'posts_per_page'         => -1,
                    'no_found_rows'          => true,
                    'update_post_meta_cache' => true,
                    'update_post_term_cache' => false,
                    'tax_query' => [
                        [
                            'taxonomy' => 'service-type',
                            'field'    => 'term_id',
                            'terms'    => $category->term_id,
                        ],
                    ],
                ]);

                if ($services->have_posts()) :
                    while ($services->have_posts()) :
                        $services->the_post();

                        $ID = get_the_ID();

                        $cost = get_post_meta($ID, 'lege_service_cost', true);

                        $base_url  = get_post_meta($ID, 'lege_service_icon_base', true);
                        $hover_url = get_post_meta($ID, 'lege_service_icon_hover', true);

                        if (!$hover_url) {
                            $hover_url = $base_url;
                        }
                ?>

                    <li class="services__item"
                        <?php if ($base_url) : ?>
                            style="
                                --service-icon-base: url('<?php echo esc_url($base_url); ?>');
                                --service-icon-hover: url('<?php echo esc_url($hover_url); ?>');
                            "
                        <?php endif; ?>
                    >                 

                        <h3 class="services__heading">
                            <?php the_title(); ?>
                        </h3>

                        <p class="services__descr">
                            <?php
                            $excerpt = get_the_excerpt();
                            echo esc_html(
                                !empty($excerpt)
                                    ? $excerpt
                                    : wp_trim_words(get_the_content(), 20)
                            );
                            ?>
                        </p>

                        <?php if ($cost) : ?>
                            <p class="services__price">
                                <?php echo esc_html($lege_options['servicecurrency'] ?? '$'); ?>
                                <?php echo esc_html($cost); ?>
                            </p>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>"
                           class="services__order btn"
                           data-content="<?php esc_attr_e('Read more', 'lege'); ?>">
                            <?php esc_html_e('Read more', 'lege'); ?>
                        </a>

                        <div class="services__bg"></div>

                    </li>

                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<div>' . esc_html__('No services found', 'lege') . '</div>';
                endif;
                ?>

                </ul>
            </div>

        <?php endforeach; ?>

    </div>
</section>

<?php
endif;

get_footer();