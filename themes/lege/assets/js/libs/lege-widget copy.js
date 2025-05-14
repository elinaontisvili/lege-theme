(function($){
    function initLegeWidgetUploader(){
        //console.log('Init image upload buttons'); // DEBUG

        $('.lege-upload-image').off('click').on('click', function(e){
            //console.log('Choose Image clicked'); // DEBUG
            
            e.preventDefault();

            var button = $(this);
            var container = button.closest('.lege-widget-image-field');
            var input = container.find('input[type="hidden"]');

            var custom_uploader = wp.media({
                title: 'Select Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });

            custom_uploader.on('select', function(){
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                input.val(attachment.id).trigger('change'); // <<< ADD .trigger('change') HERE
                container.find('.lege-widget-preview').html('<img src="' + attachment.url + '" style="max-width:100%;" />');
            });

            custom_uploader.open();
        });

        $('.lege-remove-image').off('click').on('click', function(e){
            e.preventDefault();
            var container = $(this).closest('.lege-widget-image-field');
            container.find('input[type="hidden"]').val('').trigger('change'); // <<< ADD .trigger('change') HERE
            container.find('.lege-widget-preview').html('');
        });
    }

    $(document).ready(initLegeWidgetUploader);
    $(document).on('widget-added widget-updated', initLegeWidgetUploader);
})(jQuery);