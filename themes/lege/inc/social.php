<?php
function lege_get_share($type = 'fb', $permalink = false, $title = false) {
    if (!$permalink) {
        $permalink = get_permalink();
    }
    if (!$title) {
        $title = get_the_title();
    }

    // For safe URLs
    $encoded_permalink = urlencode($permalink);
    $encoded_title = urlencode($title);

    switch ($type) {
        case 'twi':
            return 'https://twitter.com/intent/tweet?text=' . $encoded_title . '%20' . $encoded_permalink;
        case 'fb':
            return 'https://www.facebook.com/sharer/sharer.php?u=' . $encoded_permalink;
        case 'vk':
            return 'https://vk.com/share.php?url=' . $encoded_permalink . '&title=' . $encoded_title;
        default:
            return '';
    }
}
?>
