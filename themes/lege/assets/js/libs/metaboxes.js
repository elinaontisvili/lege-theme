/**
 * Custom jQuery for Custom Metaboxes and Fields
 */
jQuery(document).ready(function ($) {
	var formfield;
	/**
	 * Initialize timepicker (this will be moved inline in a future release)
	 */
	$('.lege_timepicker').each(function () {
		$('#' + jQuery(this).attr('id')).timePicker({
			startTime: "07:00",
			endTime: "22:00",
			show24Hours: false,
			separator: ':',
			step: 30
		});
	});

	/**
	 * Initialize jQuery UI datepicker (this will be moved inline in a future release)
	 */
	$('.lege_datepicker').each(function () {
		$('#' + jQuery(this).attr('id')).datepicker();
		// $('#' + jQuery(this).attr('id')).datepicker({ dateFormat: 'yy-mm-dd' });
		// For more options see http://jqueryui.com/demos/datepicker/#option-dateFormat
	});
	// Wrap date picker in class to narrow the scope of jQuery UI CSS and prevent conflicts
	$("#ui-datepicker-div").wrap('<div class="lege_element" />');
	
	/**
	 * Initialize color picker
	 */
	$('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $(Othis).next('input').attr('value');
		$(this).ColorPicker({
			color: initialColor,
			onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
			},
			onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
			},
			onChange: function (hsb, hex, rgb) {
			$(Othis).children('div').css('backgroundColor', '#' + hex);
			$(Othis).next('input').attr('value','#' + hex);
		}
		});
	});
	/**
	 * File and image upload handling //new media modal with wp.media
	 */
    $(document).on('click', '.lege_upload_button', function (e) {
    e.preventDefault();
    var button = $(this);
    var field = button.prev('input');

    var mediaUploader = wp.media({
        title: 'Select or Upload an Image',
        button: { text: 'Use this image' },
        multiple: false
    });

    mediaUploader.on('select', function () {
        var attachment = mediaUploader.state().get('selection').first().toJSON();
        field.val(attachment.url);
        field.siblings('.lege_upload_status').html(
            '<div class="img_status"><img src="' + attachment.url + '" style="max-width:150px;"/><a href="#" class="lege_remove_file_button" rel="' + field.attr('id') + '">Remove</a></div>'
        );
    });

    mediaUploader.open();
});

    // Remove file
    $(document).on('click', '.lege_remove_file_button', function (e) {
        e.preventDefault();
        var rel = $(this).attr('rel');
        $('#' + rel).val('');
        $(this).parent().remove();
    });
});