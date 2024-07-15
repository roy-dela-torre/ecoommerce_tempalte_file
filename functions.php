<?php
if (!function_exists('wordpress_template')) :
    function wordpress_template_setup()
    {
        add_theme_support('post-thumbnails');
        add_theme_support('post-formats', array('aside', 'gallery', 'quote', 'image', 'video'));
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        register_nav_menus(array(
            'primary' => __('Primary Menu', 'wordpress_template'),
            'secondary' => __('Secondary Menu', 'wordpress_template'),
        ));
    }
    add_action('after_setup_theme', 'wordpress_template_setup');
endif;
function get_excerpt($limit, $source = null)
{
    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    return $excerpt;
}


// Modify the registration form shortcode
function registration_form()
{
    ob_start();
?>
    <form method="post" class="woocommerce-form woocommerce-form-register register">
        <?php do_action('woocommerce_before_customer_login_form'); ?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="first_name" id="reg_first_name" placeholder="First Name" value="<?php if (!empty($_POST['first_name'])) echo esc_attr($_POST['first_name']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="last_name" id="reg_last_name" placeholder="Last Name" value="<?php if (!empty($_POST['last_name'])) echo esc_attr($_POST['last_name']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" placeholder="Email Address" autocomplete="email" value="<?php if (!empty($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="number" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_phone" id="billing_phone" placeholder="Phone Number" value="<?php if (!empty($_POST['billing_phone'])) echo esc_attr($_POST['billing_phone']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" autocomplete="off" placeholder="Password" />
            <span class="show-password-input"></span>
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" autocomplete="off" placeholder="Confirm Password" />
            <span class="show-password-input"></span>
        </p>
        <div class="group">
            <p class="register-remember w-100">
                <label>
                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" class="" />
                    <span>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="<?php echo get_home_url(); ?>/privacy-policy/" target="_blank" rel="noopener noreferrer">Privacy Policy</a></span>
                </label>
            </p>
        </div>
        <p class="woocommerce-form-row form-row">
            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
            <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="Register"><?php echo is_page('sign-up') ? "Create Account" : "Submit" ?></button>
        </p>
        <?php do_action('woocommerce_after_customer_login_form'); ?>
    </form>

    <?php
    return ob_get_clean();
}

add_shortcode('registration_form', 'registration_form');

function custom_process_registration()
{
    if ('POST' !== strtoupper($_SERVER['REQUEST_METHOD'])) {
        return;
    }

    // Verify nonce
    $nonce_value = isset($_POST['woocommerce-register-nonce']) ? $_POST['woocommerce-register-nonce'] : '';
    if (!wp_verify_nonce($nonce_value, 'woocommerce-register')) {
        // wc_add_notice(__('Invalid registration attempt. Please try again.', 'woocommerce'), 'error');
        return;
    }

    // Validate input fields
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['billing_phone']) ? sanitize_text_field($_POST['billing_phone']) : '';
    $password = isset($_POST['password_1']) ? $_POST['password_1'] : '';
    $password2 = isset($_POST['password_2']) ? $_POST['password_2'] : '';
    $checkbox = isset($_POST['rememberme']) ? sanitize_text_field($_POST['rememberme']) : '';

    // Debugging
    echo '<script>console.log("Password 1: ' . $password . '");</script>';
    echo '<script>console.log("Password 2: ' . $password2 . '");</script>';
    echo '<script>console.log("Checkbox: ' . $checkbox . '");</script>';

    if (empty($first_name)) {
        wc_add_notice(__('First name is required.', 'woocommerce'), 'error');
    }

    if (empty($last_name)) {
        wc_add_notice(__('Last name is required.', 'woocommerce'), 'error');
    }

    if (empty($email) || !is_email($email)) {
        wc_add_notice(__('Please provide a valid email address.', 'woocommerce'), 'error');
    }

    if (empty($phone)) {
        wc_add_notice(__('Phone number is required.', 'woocommerce'), 'error');
    }

    if (empty($password)) {
        wc_add_notice(__('Password is required.', 'woocommerce'), 'error');
    }

    if (empty($password2)) {
        wc_add_notice(__('Confirm password is required.', 'woocommerce'), 'error');
    }

    if (!empty($password) && !empty($password2) && $password !== $password2) {
        wc_add_notice(__('Passwords do not match.', 'woocommerce'), 'error');
    }

    if (empty($checkbox)) {
        wc_add_notice(__('You must agree to the terms and conditions.', 'woocommerce'), 'error');
    }

    if (wc_notice_count('error') > 0) {
        return;
    }

    // Register the user
    $user_data = array(
        'user_login' => $email,
        'user_email' => $email,
        'user_pass' => $password,
        'first_name' => $first_name,
        'last_name' => $last_name,
    );

    $user_id = wp_insert_user($user_data);

    if (is_wp_error($user_id)) {
        wc_add_notice($user_id->get_error_message(), 'error');
    } else {
        // Save additional fields
        if (!empty($phone)) {
            update_user_meta($user_id, 'billing_phone', $phone);
        }

        // Log the user in
        wc_set_customer_auth_cookie($user_id);

        // Redirect to the My Account page
        $redirect = wc_get_page_permalink('myaccount');
        wp_redirect($redirect);
        exit;
    }
}
add_action('template_redirect', 'custom_process_registration');


// Hook into user registration to save first name and last name
function save_extra_user_fields($user_id)
{
    if (isset($_POST['first_name'])) {
        update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['first_name']));
    }
    if (isset($_POST['last_name'])) {
        update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['last_name']));
    }
    if (isset($_POST['billing_phone'])) {
        update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    }
}
add_action('user_register', 'save_extra_user_fields');


// cart page button and auto update quanty via ajax
/* Add Plus and Minus Button for Quantity Input */
add_action('woocommerce_before_quantity_input_field', 'custom_display_quantity_minus');
add_action('woocommerce_after_quantity_input_field', 'custom_display_quantity_plus');

function custom_display_quantity_minus()
{
    echo '<button type="button" class="minus">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
            <path d="M15.5 10.4997C15.5 10.7581 15.4305 11.0059 15.3067 11.1886C15.1829 11.3713 15.015 11.474 14.84 11.474H5.16C4.98496 11.474 4.81708 11.3713 4.69331 11.1886C4.56954 11.0059 4.5 10.7581 4.5 10.4997C4.5 10.2413 4.56954 9.99348 4.69331 9.81076C4.81708 9.62804 4.98496 9.52539 5.16 9.52539H14.84C15.015 9.52539 15.1829 9.62804 15.3067 9.81076C15.4305 9.99348 15.5 10.2413 15.5 10.4997Z" fill="white"/>
        </svg>
    </button>';
}
function custom_display_quantity_plus()
{
    echo '<button type="button" class="plus">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
            <path d="M14.9993 11.3307H10.8327V15.4974C10.8327 15.7184 10.7449 15.9304 10.5886 16.0866C10.4323 16.2429 10.2204 16.3307 9.99935 16.3307C9.77834 16.3307 9.56637 16.2429 9.41009 16.0866C9.25381 15.9304 9.16602 15.7184 9.16602 15.4974V11.3307H4.99935C4.77834 11.3307 4.56637 11.2429 4.41009 11.0867C4.25381 10.9304 4.16602 10.7184 4.16602 10.4974C4.16602 10.2764 4.25381 10.0644 4.41009 9.90814C4.56637 9.75186 4.77834 9.66406 4.99935 9.66406H9.16602V5.4974C9.16602 5.27638 9.25381 5.06442 9.41009 4.90814C9.56637 4.75186 9.77834 4.66406 9.99935 4.66406C10.2204 4.66406 10.4323 4.75186 10.5886 4.90814C10.7449 5.06442 10.8327 5.27638 10.8327 5.4974V9.66406H14.9993C15.2204 9.66406 15.4323 9.75186 15.5886 9.90814C15.7449 10.0644 15.8327 10.2764 15.8327 10.4974C15.8327 10.7184 15.7449 10.9304 15.5886 11.0867C15.4323 11.2429 15.2204 11.3307 14.9993 11.3307Z" fill="white"/>
        </svg>
    </button>';
}

/* Trigger update quantity script */
add_action('wp_footer', 'custom_add_cart_quantity_plus_minus');

function custom_add_cart_quantity_plus_minus()
{
    if (!is_product() && !is_cart()) return;

    wc_enqueue_js("
      jQuery(document).on('click', 'button.plus, button.minus', function() {

         var qty = jQuery(this).parent().find('.qty');
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr('max'));
         var min = parseFloat(qty.attr('min'));
         var step = parseFloat(qty.attr('step'));

         if (jQuery(this).is('.plus')) {
            if (max && (max <= val)) {
               qty.val(max).change();
            } else {
               qty.val(val + step).change();
            }
         } else {
            if (min && (min >= val)) {
               qty.val(min).change();
            } else if (val > 1) {
               qty.val(val - step).change();
            }
         }

         // Trigger cart update after changing quantity
         jQuery('[name=\"update_cart\"]').trigger('click');

      });
    ");
}


/* Trigger cart update when quantity changes */
add_action('wp_footer', 'cart_refresh_update_qty');

function cart_refresh_update_qty()
{
    if (is_cart()) {
    ?>
        <script type="text/javascript">
            let timeout;
            jQuery('div.woocommerce').on('change', 'input.qty', function() {
                if (timeout !== undefined) {
                    clearTimeout(timeout);
                }
                timeout = setTimeout(function() {
                    jQuery("[name='update_cart']").trigger("click"); // trigger cart update
                }, 1000); // 1 second
            });

            jQuery('div.woocommerce').on('click', 'button.minus, button.plus', function() {
                jQuery("[name='update_cart']").trigger("click");
            });
        </script>
    <?php
    }
}




remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_checkout_payment_hook', 'woocommerce_checkout_payment', 10);



// css for admin
function enqueue_custom_admin_css()
{
    wp_enqueue_style('custom-admin-style', get_stylesheet_directory_uri() . '/style.css');
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_css');


// shop page display product column
add_filter('loop_shop_per_page', 'custom_shop_per_page', 20);

function custom_shop_per_page($cols)
{
    return 6; // Change 8 to the desired number of products per page
}




// recentyl view product hooks and short code
add_action('template_redirect', 'bbloomer_track_product_view', 9999);

function bbloomer_track_product_view()
{
    if (!is_singular('product')) return;
    global $post;
    if (empty($_COOKIE['bbloomer_recently_viewed'])) {
        $viewed_products = array();
    } else {
        $viewed_products = wp_parse_id_list((array) explode('|', wp_unslash($_COOKIE['bbloomer_recently_viewed'])));
    }
    $keys = array_flip($viewed_products);
    if (isset($keys[$post->ID])) {
        unset($viewed_products[$keys[$post->ID]]);
    }
    $viewed_products[] = $post->ID;
    if (count($viewed_products) > 15) {
        array_shift($viewed_products);
    }
    wc_setcookie('bbloomer_recently_viewed', implode('|', $viewed_products));
}

add_shortcode('recently_viewed_products', 'bbloomer_recently_viewed_shortcode');

function bbloomer_recently_viewed_shortcode()
{
    $viewed_products = !empty($_COOKIE['bbloomer_recently_viewed']) ? (array) explode('|', wp_unslash($_COOKIE['bbloomer_recently_viewed'])) : array();
    $viewed_products = array_reverse(array_filter(array_map('absint', $viewed_products)));
    if (empty($viewed_products)) return;
    $title = '<h3>Recently Viewed</h3>';
    $product_ids = implode(",", $viewed_products);
    return $title . do_shortcode("[products ids='$product_ids']");
}


// Register the custom endpoint for recently view products
function add_custom_my_account_endpoint()
{
    add_rewrite_endpoint('recently-viewed', EP_ROOT | EP_PAGES);
}
add_action('init', 'add_custom_my_account_endpoint');

// Add the Recently Viewed tab to My Account navigation
function add_recently_viewed_tab($items)
{
    $items['recently-viewed'] = __('Recently Viewed Products', 'woocommerce');
    return $items;
}
add_filter('woocommerce_account_menu_items', 'add_recently_viewed_tab', 99);

// Display content for the Recently Viewed endpoint
function display_recently_viewed_products()
{
    echo do_shortcode('[recently_viewed_products]');
}
add_action('woocommerce_account_recently-viewed_endpoint', 'display_recently_viewed_products');


// Function to remove <br> tags from Contact Form 7 forms
function remove_br_from_cf7_form($form)
{
    // Remove <br> and <br /> tags
    $form = str_replace('<br>', '', $form);
    $form = str_replace('<br />', '', $form);
    return $form;
}

// Apply the function to the wpcf7_form_elements filter
add_filter('wpcf7_form_elements', 'remove_br_from_cf7_form');


// Price Filter

function price_filter_shortcode()
{
    ob_start();
    ?>
    <div id="price-filter" class="accordion-collapse collapse show">
        <div class="accordion-body">
            <p class="text-center">$500 is the maximum amount.</p>
            <div class="range-slider">
                <input id="min-price" value="0" min="0" max="200" step="1" type="range" />
                <input id="max-price" value="500" min="0" max="200" step="1" type="range" />
                <form action="">
                    <div class="range_input">
                        <div class="minimum">
                            <input type="number" id="min-price-input" value="0" min="0" max="200" />
                        </div>
                        <div class="maximum">
                            <input type="number" id="max-price-input" value="200" min="0" max="200" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('price_filter', 'price_filter_shortcode');


function filter_products_by_price()
{
    // Check nonce for security
    check_ajax_referer('price_filter_nonce', 'nonce');

    $min_price = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 0;
    $max_price = isset($_POST['max_price']) ? floatval($_POST['max_price']) : 200;

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 6,
        'meta_query' => array(
            array(
                'key' => '_price',
                'value' => array($min_price, $max_price),
                'compare' => 'BETWEEN',
                'type' => 'DECIMAL',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        woocommerce_product_loop_start();
        while ($query->have_posts()) {
            $query->the_post();

            // Set up product data
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $product = wc_get_product(get_the_ID());
            $product_id = get_the_ID();
            $video_iframe = get_field('video_iframe', $product_id);
            $title = get_the_title();
            $product_url = get_the_permalink();
            $price = $product->get_price_html();

            if ($product->is_type('variable')) {
                $min_variation_price = number_format($product->get_variation_price('min'), 2);
                $max_variation_price = number_format($product->get_variation_price('max'), 2);
                $price = '$' . $min_variation_price . ' - ' . '$' . $max_variation_price;
            }

            $data = array(
                'img_url' => $img_url,
                'title' => $title,
                'price' => $price,
                'product_url' => $product_url,
                'product' => $product,
                'product_id' => $product_id,
                'video_iframe' => $video_iframe
            );

            // Load the template
            ob_start();
    ?>
            <div class="col-lg-4 col-md-6 product_column">
                <?php echo wc_get_template('template/product_content.php', $data); ?>
            </div>
<?php
            echo ob_get_clean();
        }

        woocommerce_product_loop_end();

        // Pagination
        $totalPages = $query->max_num_pages;
        echo '<div class="paging d-flex justify-content-center align-items-center">';
        echo paginate_links(array(
            'total' => $totalPages,
            'mid_size' => 2
        ));
        echo '</div>';
    } else {
        echo '<p>No products found.</p>';
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_filter_products_by_price', 'filter_products_by_price');
add_action('wp_ajax_nopriv_filter_products_by_price', 'filter_products_by_price');


function enqueue_price_filter_scripts()
{
    wp_enqueue_script('price-filter-js', get_template_directory_uri() . '/inc/js/price-filter.js', array('jquery'), null, true);

    wp_localize_script('price-filter-js', 'priceFilter', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('price_filter_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_price_filter_scripts');





// minicart functions
function fab_business_shop_scripts()
{
    wp_enqueue_script('ic-cart-ajax', get_template_directory_uri() . '/inc/js/mini-cart.js', array('jquery'), '1.0', true);
    wp_localize_script(
        'ic-cart-ajax',
        'my_ajax_object',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('ic-mc-nc'),
        )
    );
}
add_action('wp_enqueue_scripts', 'fab_business_shop_scripts');


// Here is the AJAX call 
add_action('wp_ajax_ic_qty_update', 'ic_qty_update');
add_action('wp_ajax_nopriv_ic_qty_update', 'ic_qty_update');

function ic_qty_update()
{
    $key    = sanitize_text_field($_POST['key']);
    $number = intval(sanitize_text_field($_POST['number']));

    $cart = [
        'count'      => 0,
        'total'      => 0,
        'item_price' => 0,
    ];

    if ($key && $number > 0 && wp_verify_nonce($_POST['security'], 'ic-mc-nc')) {
        WC()->cart->set_quantity($key, $number);
        $items              = WC()->cart->get_cart();
        $cart               = [];
        $cart['count']      = WC()->cart->cart_contents_count;
        $cart['total']      = WC()->cart->get_cart_total();
        $cart['item_price'] = wc_price($items[$key]['line_total']);
    }

    echo json_encode($cart);
    wp_die();
}