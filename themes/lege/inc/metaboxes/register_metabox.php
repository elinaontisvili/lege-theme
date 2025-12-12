<?php
/**
 * Регистрируем Metaboxes.
 */
function lege_metaboxes($meta_boxes) {

    $meta_boxes = array();
    $prefix = "lege_";

    // Metabox для Отзывов.
    $meta_boxes[] = array(
        'id'         => 'testimonial_metaboxes',
        'title'      => esc_html__( 'Testimonial Data', 'lege' ),
        'pages'      => array( 'testimonial' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true,
        'fields' => array(
            array(
                'name' => esc_html__( 'Social Network', 'lege' ),
                'desc' => esc_html__( 'Enter the social network link', 'lege' ),
                'id'   => $prefix . 'social_link',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Testimonial Date', 'lege' ),
                'desc' => esc_html__( 'Enter the testimonial date', 'lege' ),
                'id'   => $prefix . 'testy_date',
                'type' => 'text_date',
            ), 
            array(
                'name' => esc_html__( 'Testimonial to show on Home Page', 'lege' ),
                'desc' => esc_html__( 'Enter the testimonial', 'lege' ),
                'id'   => $prefix . 'testy_frontpage',
                'type' => 'textarea',
            ), 
            array(
                'name' => esc_html__( 'Client Image (Frontpage)', 'lege' ),
                'desc' => esc_html__( 'Upload a custom image for use in the Elementor testimonials widget.', 'lege' ),
                'id'   => $prefix . 'testimonial_image',
                'type' => 'file',
                'options' => array(
                    'url' => false, // don't show the URL field
                ),
            ),
        )
    );

    // Metabox для Услуг.
    $meta_boxes[] = array(
        'id'         => 'service_metaboxes',
        'title'      => esc_html__( 'Service Data', 'lege' ),
        'pages'      => array( 'service' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true,
        'fields' => array(
            array(
                'name' => esc_html__( 'Cost', 'lege' ),
                'desc' => esc_html__( 'Enter the service price', 'lege' ),
                'id'   => $prefix . 'service_cost',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Background Image', 'lege' ),
                'desc' => esc_html__( 'Select a background', 'lege' ),
                'id'   => $prefix . 'service_icon',
                'type' => 'select',
                'options' => array(
                    array('name' => esc_html__( 'Statistics Style', 'lege' ), 'value' => 'stat'),
                    array('name' => esc_html__( 'Idea Style', 'lege' ), 'value' => 'idea'),
                    array('name' => esc_html__( 'Internet Style', 'lege' ), 'value' => 'internet'),
                    array('name' => esc_html__( 'Info Style', 'lege' ), 'value' => 'info'),
                    array('name' => esc_html__( 'Business Style', 'lege' ), 'value' => 'busy'),
                    array('name' => esc_html__( 'Target Style', 'lege' ), 'value' => 'target'),
                ),
            ),
        )
    );

    // Metabox для Команды (Team Members)
    $meta_boxes[] = array(
        'id'         => 'team_metaboxes',
        'title'      => esc_html__( 'Team Member Data', 'lege' ),
        'pages'      => array( 'team' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true,
        'fields' => array(

            array(
                'name' => esc_html__( 'Job Position', 'lege' ),
                'desc' => esc_html__( 'Enter the job title or position', 'lege' ),
                'id'   => $prefix . 'team_job_position',
                'type' => 'text',
            ),

            array(
                'name' => esc_html__( 'Facebook', 'lege' ),
                'desc' => esc_html__( 'Enter Facebook profile URL', 'lege' ),
                'id'   => $prefix . 'team_facebook',
                'type' => 'text',
            ),

            array(
                'name' => esc_html__( 'Instagram', 'lege' ),
                'desc' => esc_html__( 'Enter Instagram profile URL', 'lege' ),
                'id'   => $prefix . 'team_instagram',
                'type' => 'text',
            ),

            array(
                'name' => esc_html__( 'VK', 'lege' ),
                'desc' => esc_html__( 'Enter VK profile URL', 'lege' ),
                'id'   => $prefix . 'team_vk',
                'type' => 'text',
            ),

            array(
                'name' => esc_html__( 'Twitter / X', 'lege' ),
                'desc' => esc_html__( 'Enter Twitter/X profile URL', 'lege' ),
                'id'   => $prefix . 'team_twitter',
                'type' => 'text',
            ),

        )
    );

    
// Добавляет метабокс для страницы с шаблоном "template-order.php", позволяющий указать шорткод формы заказа
$meta_boxes[] = array(
    'id'         => 'order_metaboxes',
    'title'      => esc_html__( 'Order Page Data', 'lege' ),
    'pages'      => array( 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true,
    'show_on'    => array( 'key' => 'page-template', 'value' => array('template-order.php') ),
    'fields' => array(
        array(
            'name' => esc_html__( 'Form Shortcode', 'lege' ),
            'desc' => esc_html__( 'Install a form plugin and insert its shortcode', 'lege' ),
            'id'   => $prefix . 'shortcode_order',
            'type' => 'text',
        ),
    )
);

$meta_boxes[] = array(
    'id'         => 'woocommerce_metaboxes',
    'title'      => esc_html__('Product Data', 'lege'),
    'pages'      => array( 'product', ),
    'context'    => 'normal',
    'priority'   => 'low',
    'show_names' => true,
    'fields' => array(
        array(
            'name' => esc_html__('Short Title', 'lege'),
            'desc' => esc_html__('Enter a short title', 'lege'),
            'id'   => $prefix . 'short_title',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__('Button Text', 'lege'),
            'desc' => esc_html__('Enter button text', 'lege'),
            'id'   => $prefix . 'sale_button_title',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__('Button Color', 'lege'),
            'desc' => esc_html__('Enter a button color', 'lege'),
            'id'   => $prefix . 'sale_button_color',
            'type' => 'text',
            'std' => '#fdba4a'
        ),
        array(
            'name' => esc_html__('Photo 1', 'lege'),
            'desc' => esc_html__('Upload a photo', 'lege'),
            'id'   => $prefix . 'photo_one',
            'type' => 'file',
        ),
        array(
            'name' => esc_html('Photo 1 Alt text', 'lege'),
            'desc' => esc_html('Alt text', 'lege'),
            'id' => $prefix . 'photo_one_alt',
            'type' => 'text',
        )
    )
);

$meta_boxes[] = array(
    'id'         => 'contact_metaboxes',
    'title'      => esc_html__( 'Contact Page Data', 'lege' ),
    'pages'      => array( 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true,
    'show_on'    => array( 'key' => 'page-template', 'value' => array('template-contact.php') ),
    'fields' => array(
        array(
            'name' => esc_html__( 'Title 1', 'lege' ),
            'desc' => esc_html__( 'Enter the title for the left section', 'lege' ),
            'id'   => $prefix . 'contact_title_left',
            'std'  => esc_html__( 'How to Find Us', 'lege' ),
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Title 2', 'lege' ),
            'desc' => esc_html__( 'Enter the title for the right section', 'lege' ),
            'id'   => $prefix . 'contact_title_right',
            'std'  => esc_html__( 'Get a free consultation today', 'lege' ),
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Contact Form Shortcode', 'lege' ),
            'desc' => esc_html__( 'Create a new form in the CF7 plugin and insert the shortcode here', 'lege' ),
            'id'   => $prefix . 'contact_shortcode',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Address', 'lege' ),
            'desc' => esc_html__( 'Enter your address', 'lege' ),
            'id'   => $prefix . 'contact_address',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Phone number 1', 'lege' ),
            'desc' => esc_html__( 'Enter your phone number 1', 'lege' ),
            'id'   => $prefix . 'contact_phone1',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Phone number 2', 'lege' ),
            'desc' => esc_html__( 'Enter your phone number 2', 'lege' ),
            'id'   => $prefix . 'contact_phone2',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Email', 'lege' ),
            'desc' => esc_html__( 'Enter your email', 'lege' ),
            'id'   => $prefix . 'contact_email',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Working Hours', 'lege' ),
            'desc' => esc_html__( 'Enter your working hours', 'lege' ),
            'id'   => $prefix . 'contact_calendar',
            'type' => 'text',
            'std'  => esc_html__( 'We work from 9:00 to 22:00 on weekdays', 'lege'),
        ),
        array(
            'name' => esc_html__( 'Map Shortcode', 'lege' ),
            'desc' => esc_html__( 'Install a map plugin and insert the shortcode here', 'lege' ),
            'id'   => $prefix . 'contact_map',
            'type' => 'text',
        ),
    )
);

return $meta_boxes;
}



