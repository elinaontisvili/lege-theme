(function($) {
    'use strict';

    $(document).on('change input', '.grouped_form .qty', function() {
        var $form = $(this).closest('.grouped_form');
        var $button = $form.find('.single_add_to_cart_button');
        var hasQuantity = false;

        $form.find('.qty').each(function() {
            var val = parseFloat($(this).val());
            if (val > 0) {
                hasQuantity = true;
                return false;
            }
        });

        if (hasQuantity) {
            $button.removeClass('disabled').prop('disabled', false);
        } else {
            $button.addClass('disabled').prop('disabled', true);
        }
    });

})(jQuery);