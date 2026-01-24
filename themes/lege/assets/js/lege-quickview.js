$(document).on('click', '.popup-link-quickview', function (e) {
    e.preventDefault();

    var $this = $(this);
    var productId = $this.data('product-id');
    
    if (!productId) return;

    if (typeof legeQuickview === 'undefined' || !legeQuickview.ajax_url) return;

    var $popup     = $('#one-click');
    var $container = $popup.find('.js-popup-product');

    $container.html('<div class="popup-loader">Loading…</div>');

    $.magnificPopup.open({
        items: { src: '#one-click' },
        type: 'inline'
    });

    // Fetch product data
    $.post(
        legeQuickview.ajax_url,
        {
            action: 'lege_load_popup_product',
            product_id: productId
        },
        function (response) {
            // Template HTML
            $container.html(response);

            // Grouped products 
            $container.find('.grouped_form .qty').first().trigger('change');

            // Variation products 
            $container.find('.variations_form').each(function () {
                var $form = $(this);
                
                $form.wc_variation_form();
                
                $form.trigger('check_variations');
                $form.trigger('reset_data');
            });
        }
    ).fail(function(xhr, status, error) {
        $container.html('<p style="color:red; padding:20px;">Error: ' + error + '</p>');
    });
});