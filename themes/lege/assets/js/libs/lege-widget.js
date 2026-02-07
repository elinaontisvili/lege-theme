(function($){
    function initLegeWidgetUploader(){

        $('.lege-media-button').off('click').on('click', function(e){
            e.preventDefault();

            var button = $(this);
            var input  = button.prev('.lege-image-url');
            var widget = button.closest('.widget');

            var frame = wp.media({
                title: 'Select Image',
                multiple: false
            });

            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();

                input.val(attachment.id + '|' + attachment.url).trigger('change').trigger('input');

                // Trigger widget save
                widget.find(':input').trigger('change');
                widget.trigger('change');
                widget.find('.widget-control-save').prop('disabled', false);
            });

            frame.open();
        });
    }

    $(document).ready(initLegeWidgetUploader);
    $(document).on('widget-added widget-updated', initLegeWidgetUploader);
})(jQuery);