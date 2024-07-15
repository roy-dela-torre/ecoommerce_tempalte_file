jQuery(document).ready(function ($) {
    function updateProducts(minPrice, maxPrice) {
        $.ajax({
            url: priceFilter.ajaxurl, // Make sure priceFilter.ajaxurl is defined
            type: 'POST',
            data: {
                action: 'filter_products_by_price',
                min_price: minPrice,
                max_price: maxPrice,
                nonce: priceFilter.nonce // Make sure priceFilter.nonce is defined
            },
            success: function (response) {
                $('.product_list').html(response);
            }
        });
    }

    function debounce(func, wait) {
        let timeout;
        return function () {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    const handlePriceChange = debounce(function () {
        var minPrice = parseFloat($('#min-price').val());
        var maxPrice = parseFloat($('#max-price').val());

        if (minPrice > maxPrice) {
            var temp = minPrice;
            minPrice = maxPrice;
            maxPrice = temp;
        }

        $('#min-price-input').val(minPrice);
        $('#max-price-input').val(maxPrice);

        updateProducts(minPrice, maxPrice);
    }, 1000);

    $('#min-price, #max-price').on('input change', handlePriceChange);

    $('#min-price-input, #max-price-input').on('input change', function () {
        var minPrice = parseFloat($('#min-price-input').val());
        var maxPrice = parseFloat($('#max-price-input').val());

        if (minPrice > maxPrice) {
            var temp = minPrice;
            minPrice = maxPrice;
            maxPrice = temp;
        }

        $('#min-price').val(minPrice);
        $('#max-price').val(maxPrice);

        updateProducts(minPrice, maxPrice);
    });
});