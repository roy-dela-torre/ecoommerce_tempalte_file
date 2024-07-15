jQuery(function ($) {
    $(document).ready(function () {
        // Click event for minus button
        $("body").on("click", ".minus", function () {
            ic_quantity_update_buttons($(this), "minus");
        });

        // Click event for plus button
        $("body").on("click", ".plus", function () {
            ic_quantity_update_buttons($(this), "plus");
        });

        // Blur event for input field
        $("body").on("blur", ".ic-cart-sidebar-wrapper_body input", function () {
            ic_quantity_update_input_blur($(this));
        });

        // Toggle mini cart display
        $('body').on('click', '.ic-cart-header-btn', function (e) {
            e.preventDefault();
            $('body').addClass('active-mini-cart');
        });

        $('body').on('click', '.ic-cart-header-btn-close', function (e) {
            $('body').removeClass('active-mini-cart');
        });

        var ic_quantity_update_send = true;

        // Update cart quantity on button click
        function ic_quantity_update_buttons(el, type) {
            if (ic_quantity_update_send) {
                $(".ic-cart-sidebar-wrapper_body ul").addClass("loading");
                ic_quantity_update_send = false;

                var wrap = $(el).closest(".woocommerce-mini-cart-item");
                var input = $(wrap).find(".qty");
                var key = $(wrap).data("key");
                var number = parseInt($(input).val());

                if (type === "minus") {
                    number--;
                } else if (type === "plus") {
                    number++;
                }

                if (number < 1) {
                    number = 1;
                }

                $(input).val(number);

                var data = {
                    action: "ic_qty_update",
                    key: key,
                    number: number,
                    security: my_ajax_object.nonce
                };

                $.ajax({
                    url: my_ajax_object.ajax_url,
                    type: 'POST',
                    data: data,
                    beforeSend: function(xhr) {
                        $("#overlay").show(); // Show loading overlay
                    },
                    success: function(res) {
                        var cart_res = JSON.parse(res);
                        updateCartTotals(cart_res.total);
                        updateItemPrice(wrap, cart_res.item_price);
                    },
                    complete: function() {
                        $("#overlay").hide(); // Hide loading overlay
                        ic_quantity_update_send = true;
                        $(".ic-cart-sidebar-wrapper_body ul").removeClass("loading");
                    }
                });
            }
        }

        // Update cart quantity on input blur
        function ic_quantity_update_input_blur(input) {
            $(".ic-cart-sidebar-wrapper_body ul").addClass("loading");
            ic_quantity_update_send = false;

            var wrap = $(input).closest(".woocommerce-mini-cart-item");
            var key = $(wrap).data("key");
            var number = parseInt($(input).val());

            if (!number || number < 1) {
                number = 1;
            }

            $(input).val(number);

            var data = {
                action: "ic_qty_update",
                key: key,
                number: number,
                security: my_ajax_object.nonce
            };

            $.ajax({
                url: my_ajax_object.ajax_url,
                type: 'POST',
                data: data,
                beforeSend: function(xhr) {
                    $("#overlay").show(); // Show loading overlay
                },
                success: function(res) {
                    var cart_res = JSON.parse(res);
                    updateCartTotals(cart_res.total);
                    updateItemPrice(wrap, cart_res.item_price);
                },
                complete: function() {
                    $("#overlay").hide(); // Hide loading overlay
                    ic_quantity_update_send = true;
                    $(".ic-cart-sidebar-wrapper_body ul").removeClass("loading");
                }
            });
        }

        // Function to update subtotal and total with decimal places
        function updateCartTotals(totalHtml) {
            var totalText = $(totalHtml).text();
            var numericTotal = parseFloat(totalText.replace(/[^\d.-]/g, ''));
            var formattedTotal = numericTotal.toFixed(2);
            $("p.woocommerce-mini-cart__total.total .amount").html('<bdi><span class="woocommerce-Price-currencySymbol">₱</span>' + formattedTotal + '</bdi>');
        }

        // Function to update item price with decimal places
        function updateItemPrice(wrap, itemPriceHtml) {
            var itemPriceText = $(itemPriceHtml).text();
            var numericItemPrice = parseFloat(itemPriceText.replace(/[^\d.-]/g, ''));
            var formattedItemPrice = numericItemPrice.toFixed(2);
            $(wrap).find(".ic-custom-render-total").html('<bdi><span class="woocommerce-Price-currencySymbol">₱</span>' + formattedItemPrice + '</bdi>');
        }

        // Event listener for removing item from mini-cart
        $('body').on('click', '.remove_from_cart_button', function (e) {
            e.preventDefault();
            var $this = $(this);
            var cart_item_key = $this.data('cart_item_key');

            var data = {
                action: 'ic_remove_item_from_cart',
                cart_item_key: cart_item_key,
                security: my_ajax_object.nonce
            };

            $.ajax({
                url: my_ajax_object.ajax_url,
                type: 'POST',
                data: data,
                beforeSend: function(xhr) {
                    $("#overlay").show(); // Show loading overlay
                },
                success: function(response) {
                    if (response.success) {
                        $this.closest('.woocommerce-mini-cart-item').remove();
                        updateCartTotals(response.data.total);
                    } else {
                        alert(response.data.error);
                    }
                },
                complete: function() {
                    $("#overlay").hide(); // Hide loading overlay
                }
            });
        });
    });
});
