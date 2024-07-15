<?php get_header(); ?>
<section class="cart">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="cart-container">
                    <h1 class="red_text text-center">my cart</h1>
                    <?php echo do_shortcode('[woocommerce_cart]')?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
<script>
    $(document).ready(function(){
        $(document).on('click', '#delete_cart_item', function(event){
            event.preventDefault(); // Corrected typo here
            $('input.input-text.qty.text').val(0).change();
            setTimeout(() => {
                $('button.red_button.update_cart.button').click();
            }, 1000);
        });

        $('section.cart .cart-container .woocommerce').addClass('row');
        $(document).on('click', '.cart_totals button.red_button.button', function(){
            var coupon_value = $('.cart_totals .coupon input#coupon_code').val();
            console.log(coupon_value);
            $('form.woocommerce-cart-form input#coupon_code').val(coupon_value).change();
            $('form.woocommerce-cart-form .coupon button.button').click();
        });
    });
</script>

<!-- <?php 
// $coupon_code = "NEWUSER";
//   global $woocommerce;
//   $cart = $woocommerce->cart;
//   $totalQty = $cart->get_cart_contents_count();
//   $CartTotal = $cart->get_subtotal();
//   $GrandTotal = $cart->get_cart_total();
//   $userid = get_current_user_id();
//   $numorders = wc_get_customer_order_count($userid);
//   if ($numorders > 0) {
//     // echo '<p>You have placed ' . $numorders . ' orders with us.</p>';
//   } else {
    // echo '<p>You have not placed any orders yet.</p>';
    ?>
    <script>
        $(document).ready(function(){
            setTimeout(() => {
                $('.cart_totals .coupon input#coupon_code').val('<?//php echo $coupon_code;?>').change()
                if($('.cart_totals .coupon input#coupon_code').val().trim() !== ''){
                    $('.cart_totals button.red_button.button').click()
                }
            }, 2000);
        })
    </script>
    <?//php
  //}
?> -->

