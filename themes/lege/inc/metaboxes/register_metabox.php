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
        'title'      => esc_html__( 'Данные для отзыва', 'lege' ),
        'pages'      => array( 'testimonial' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true,
        'fields' => array(
            array(
                'name' => esc_html__( 'Социальная Сеть', 'lege' ),
                'desc' => esc_html__( 'Введите ссылку на соц сеть', 'lege' ),
                'id'   => $prefix . 'social_link',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Дата отзыва', 'lege' ),
                'desc' => esc_html__( 'Введите дату отзыва', 'lege' ),
                'id'   => $prefix . 'testy_date',
                'type' => 'text_date',
            ),
        )
    );

    // Metabox для Услуг.
    $meta_boxes[] = array(
        'id'         => 'service_metaboxes',
        'title'      => esc_html__( 'Данные для сервиса', 'lege' ),
        'pages'      => array( 'service' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true,
        'fields' => array(
            array(
                'name' => esc_html__( 'Стоимость', 'lege' ),
                'desc' => esc_html__( 'Введите цену данной услуги', 'lege' ),
                'id'   => $prefix . 'service_cost',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Фоновое изображение', 'lege' ),
                'desc' => esc_html__( 'Выберите фон для выбора', 'lege' ),
                'id'   => $prefix . 'service_icon',
                'type' => 'select',
                'options' => array(
                    array('name' => esc_html__( 'Стиль Статистика', 'lege' ), 'value' => 'stat'),
                    array('name' => esc_html__( 'Стиль Идея', 'lege' ), 'value' => 'idea'),
                    array('name' => esc_html__( 'Стиль Интернет', 'lege' ), 'value' => 'internet'),
                    array('name' => esc_html__( 'Стиль Инфо', 'lege' ), 'value' => 'info'),
                    array('name' => esc_html__( 'Стиль Деловой', 'lege' ), 'value' => 'busy'),
                    array('name' => esc_html__( 'Стиль Таргет', 'lege' ), 'value' => 'target'),
                ),
            ),
        )
    );

// Добавляет метабокс для страницы с шаблоном "template-order.php", позволяющий указать шорткод формы заказа
$meta_boxes[] = array(
    'id'         => 'order_metaboxes',
    'title'      => esc_html__( 'Данные для страницы заказа', 'lege' ),
    'pages'      => array( 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true,
    'show_on'    => array( 'key' => 'page-template', 'value' => array('template-order.php') ),
    'fields' => array(
        array(
            'name' => esc_html__( 'Шорткод формы', 'lege' ),
            'desc' => esc_html__( 'Установите плагин для формы и вставьте шорткод формы', 'lege' ),
            'id'   => $prefix . 'shortcode_order',
            'type' => 'text',
        ),
    )
);

return $meta_boxes;
}