# xstore-bdcalling-wordpress-task

# How you can see the project

0. download or git clone my github repository `https://github.com/aa-nadim/xstore-bdcalling-wordpress-task`

1. setup WAMP

2. download wordpress --> `https://wordpress.org/latest.zip`

3. in WAMP, copy paste the wordpress folder

4. in `C:\wamp64\www\XStore\wp-content\themes`, copy paste `https://github.com/aa-nadim/xstore-bdcalling-wordpress-task/tree/main/wp-content/themes/twentytwentyfour` (my twenty twenty four theme). you can install new 'twenty twenty four' theme. if you install new 'twenty twenty four' theme, in your theme 'functions.php' file just add..

```
// Custom XStore functions (BDCalling IT)

// add a custom field to the WooCommerce product page for products in the 'Walking Tours' category
function add_participants_field() {
				// print_r('i am here');
    global $product; // This variable holds the current product object
    if (has_term('walking-tours', 'product_cat', $product->get_id())) {
        echo '<div class="participants_field" style="padding-bottom: 15px;">
                <label for="participants">Number of Participants</label>
                <input type="number" id="participants" name="participants" value="1" min="1" max="140" required style="height: 40px; width: 100px; font-size: 16px;" />
              </div>';
    }
}
add_action('woocommerce_before_add_to_cart_button', 'add_participants_field');

// add custom data to the WooCommerce cart item when a product is added to the cart
function add_participants_to_cart_item($cart_item_data, $product_id) {
    if (isset($_POST['participants'])) {
        $cart_item_data['participants'] = absint($_POST['participants']);
    }
    return $cart_item_data;
}
add_filter('woocommerce_add_cart_item_data', 'add_participants_to_cart_item', 10, 2);


// calculate the price of cart items based on the number of participants and updates the cart item's price accordingly
function calculate_price_based_on_participants($cart_object) {
    foreach ($cart_object->get_cart() as $cart_item_key => $cart_item) {
        if (isset($cart_item['participants']) && has_term('walking-tours', 'product_cat', $cart_item['product_id'])) {
            $participants = $cart_item['participants'];
            $product_id = $cart_item['product_id'];

            // Fetch custom prices from product meta
            $price_11_34 = get_post_meta($product_id, '_price_11_34', true) ?: 45;
            $price_35_70 = get_post_meta($product_id, '_price_35_70', true) ?: 40;
            $price_71_140 = get_post_meta($product_id, '_price_71_140', true) ?: 35;

            $price = 0;

            if ($participants <= 10) {
                $price = 450;
            } elseif ($participants <= 34) {
                $price = $participants * $price_11_34;
            } elseif ($participants <= 70) {
                $price = $participants * $price_35_70;
            } elseif ($participants <= 140) {
                $price = $participants * $price_71_140;
            }

            $cart_item['data']->set_price($price);
        }
    }
}
add_action('woocommerce_before_calculate_totals', 'calculate_price_based_on_participants', 10, 1);

// add custom data to the cart item display on the WooCommerce cart and checkout pages.
function display_participants_cart($item_data, $cart_item) {
    if (isset($cart_item['participants'])) {
        $item_data[] = array(
            'name' => 'Participants',
            'value' => $cart_item['participants']
        );
    }
    return $item_data;
}
add_filter('woocommerce_get_item_data', 'display_participants_cart', 10, 2);

// add custom pricing fields to the WooCommerce product edit page in the WordPress admin area.
function add_custom_pricing_fields() {
    echo '<div class="options_group">';

    woocommerce_wp_text_input(array(
        'id' => '_price_11_34',
        'label' => __('Price for 11-34 participants'),
        'desc_tip' => 'true',
        'description' => __('Enter the price per participant for 11-34 participants'),
        'type' => 'number',
    ));

    woocommerce_wp_text_input(array(
        'id' => '_price_35_70',
        'label' => __('Price for 35-70 participants'),
        'desc_tip' => 'true',
        'description' => __('Enter the price per participant for 35-70 participants'),
        'type' => 'number',
    ));

    woocommerce_wp_text_input(array(
        'id' => '_price_71_140',
        'label' => __('Price for 71-140 participants'),
        'desc_tip' => 'true',
        'description' => __('Enter the price per participant for 71-140 participants'),
        'type' => 'number',
    ));

    echo '</div>';
}
add_action('woocommerce_product_options_pricing', 'add_custom_pricing_fields');

// save the custom pricing fields that were added to the WooCommerce product edit page.
function save_custom_pricing_fields($post_id) {
    $product = wc_get_product($post_id);

    $price_11_34 = isset($_POST['_price_11_34']) ? sanitize_text_field($_POST['_price_11_34']) : '';
    $price_35_70 = isset($_POST['_price_35_70']) ? sanitize_text_field($_POST['_price_35_70']) : '';
    $price_71_140 = isset($_POST['_price_71_140']) ? sanitize_text_field($_POST['_price_71_140']) : '';

    $product->update_meta_data('_price_11_34', $price_11_34);
    $product->update_meta_data('_price_35_70', $price_35_70);
    $product->update_meta_data('_price_71_140', $price_71_140);

    $product->save();
}
add_action('woocommerce_process_product_meta', 'save_custom_pricing_fields');

```

5. Activate the 'Woocommerce' plugin.

6. Now you can check this in the WordPress dashboard: Go to Products > All Products.Find your product and click Edit.
   On the right side under Product Categories, ensure "Walking Tours" is checked where Slug must be 'walking-tours'.

7. I also added the database. you can input it into phpmyadmin. `https://github.com/aa-nadim/xstore-bdcalling-wordpress-task/blob/main/database/xstore.sql`

## Project's demo

![Xstore admin](https://raw.githubusercontent.com/aa-nadim/xstore-bdcalling-wordpress-task/main/database/XStore%20admin.png)

![Xstore Single Product](https://raw.githubusercontent.com/aa-nadim/xstore-bdcalling-wordpress-task/main/database/Xstore%20single%20product.png)

![XStore Cart](https://raw.githubusercontent.com/aa-nadim/xstore-bdcalling-wordpress-task/main/database/XStore%20cart.png)
