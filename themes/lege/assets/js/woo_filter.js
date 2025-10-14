jQuery(function($) {

    /*------------------Range price slider (woocommerce price slider filter)-------------------*/

    function getPriceMin() {
        return $("#priceMin").val();
    }

    function getPriceMax() {
        return $("#priceMax").val();
    }

    if ($('.lege_sortby').length) {

        var minprice = $('.lege_sortby').data('minprice');
        var maxprice = $('.lege_sortby').data('maxprice');
        var maximum = maxprice + maxprice * 0.15; // avoid handle on the edge

        if(isNaN(minprice)) minprice = 0;
        if(isNaN(maxprice)) maxprice = 2000;

        $("#slider-range").slider({
            range: true,
            min: 0,
            max: maximum,
            values: [minprice, maxprice],
            step: 5,
            slide: function(event, ui) {
                $("#priceMin").val(ui.values[0]);
                $("#priceMax").val(ui.values[1]);
            },
            stop: function() {
                $(document).trigger('lege:filter:update');
            }
        });

        $("#priceMin").val($("#slider-range").slider("values", 0));
        $("#priceMax").val($("#slider-range").slider("values", 1));
    }

    /*------------------Product Categories (woocommerce product categories)-------------------*/

    /*------------------Get selected categories-------------------*/
    function getCats() {
        var cats = [];

        $(".lege_filter_check input:checked").each(function() {
            cats.push($(this).val());
        }); 

        return cats;
    }

    /*------------------Main AJAX Loader-------------------*/
    function lege_get_posts(paged) { 
        var ajax_url = lege_settings.ajax_url;

        $.ajax({
            type: 'GET', 
            url: ajax_url, 
            data: {
                action: 'lege_filter', 
                category: getCats().join(','),
                min: typeof getPriceMin === "function" ? getPriceMin() : 0,
                max: typeof getPriceMax === "function" ? getPriceMax() : 999999, 
                paged: paged
            }, 
            beforeSend: function() {
                $('#main').html('<p>Загрузка...</p>');
            },
            success: function(data) { 
                $('#main').html(data);
            },
           error: function(xhr, status, error) {
            console.log("AJAX error:", status, error);
            $('#main').html('<p>Произошла ошибка загрузки данных.</p>');
           }
        });
    }

    /*------------------Event bindings-------------------*/
    // category checkboxes
    $(document).on('change', '.lege_filter_check input', function() {
        lege_get_posts(); //call the same Ajax loader used for cotegory filters
    });

    // price range stop event
    $(document).on('lege:filter:update', function() {
        lege_get_posts(); //call the same Ajax loader used for category filters
    })

    // pagination click
    $(document).on("click", ".page-numbers", function(e) {
        e.preventDefault(); 

        var url = $(this).attr('href'); 
        var paged = 1;

        if (url.indexOf('paged=') !== -1) {
        paged = url.split('paged=')[1];
        } else if (url.indexOf('/page/') !== -1) {
            paged = url.split('/page/')[1];
        }
        lege_get_posts(paged);
    });

    
    
});
    
		