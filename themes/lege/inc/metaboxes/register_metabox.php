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

$meta_boxes[] = array(
    'id'         => 'woocommerce_metaboxes',
    'title'      => 'Данные для Товара',
    'pages'      => array( 'product', ), // Post type
    'context'    => 'normal',
    'priority'   => 'low',
    'show_names' => true, // Show field names on the left
    //'show_on'    => array( 'key' => 'page-template', 'value' => array('template-contact.php'), ), // Specific post templates to display this metabox
    'fields' => array(
        array(
            'name' => 'Короткий заголовок',
            'desc' => 'Укажите короткий заголовок',
            'id'   => $prefix . 'short_title',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'name' => 'Текст кнопки',
            'desc' => 'Укажите какой либо текст для кнопки',
            'id'   => $prefix . 'sale_button_title',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'name' => 'Цвет кнопки',
            'desc' => 'Укажите цвет для кнопки',
            'id'   => $prefix . 'sale_button_color',
            'type' => 'text',
            'std' => '#fdba4a'
        ),
        array(
            'name' => 'Фото 1',
            'desc' => 'Загрузите фото',
            'id'   => $prefix . 'photo_one',
            'type' => 'file',
        ),
    )
);

$meta_boxes[] = array(
    'id'         => 'contact_metaboxes',
    'title'      => esc_html__( 'Данные для страницы контакта', 'lege' ),
    'pages'      => array( 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true,
    'show_on'    => array( 'key' => 'page-template', 'value' => array('template-contact.php') ),
    'fields' => array(
        array(
            'name' => esc_html__( 'Заголовок 1', 'lege' ),
            'desc' => esc_html__( 'Укажите заголовок для левой части страницы', 'lege' ),
            'id'   => $prefix . 'contact_title_left',
            'std'  => esc_html__( 'Как нас найти', 'lege' ),
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Заголовок 2', 'lege' ),
            'desc' => esc_html__( 'Укажите заголовок для правой части страницы', 'lege' ),
            'id'   => $prefix . 'contact_title_right',
            'std'  => esc_html__( 'Получите бесплатную консультацию уже сегодня', 'lege' ),
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Шорткод для Контактной формы', 'lege' ),
            'desc' => esc_html__( 'Создайте новую форму в плагине CF7 и вставьте сюда шорткод', 'lege' ),
            'id'   => $prefix . 'contact_shortcode',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Адрес', 'lege' ),
            'desc' => esc_html__( 'Укажите ваше адрес', 'lege' ),
            'id'   => $prefix . 'contact_address',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Телефон 1', 'lege' ),
            'desc' => esc_html__( 'Укажите ваш телефон 1', 'lege' ),
            'id'   => $prefix . 'contact_phone1',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Телефон 2', 'lege' ),
            'desc' => esc_html__( 'Укажите ваш телефон 2', 'lege' ),
            'id'   => $prefix . 'contact_phone2',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'Email', 'lege' ),
            'desc' => esc_html__( 'Укажите ваш Email', 'lege' ),
            'id'   => $prefix . 'contact_email',
            'type' => 'text',
        ),
        array(
            'name' => esc_html__( 'График', 'lege' ),
            'desc' => esc_html__( 'Укажите текст для рабочего графика', 'lege' ),
            'id'   => $prefix . 'contact_calendar',
            'type' => 'text',
            'std'  => esc_html__( 'Мы работаем с 9:00 до 22:00 в рабочие дни', 'lege'),
        ),
        array(
            'name' => esc_html__( 'Шорткод Карты', 'lege' ),
            'desc' => esc_html__( 'Установите плагин для отображения карт и вставьте сюда шоткод', 'lege' ),
            'id'   => $prefix . 'contact_map',
            'type' => 'text',
        ),
    )
);

return $meta_boxes;
}