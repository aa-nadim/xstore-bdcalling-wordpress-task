<?php
/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'twentytwentyfour_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'twentytwentyfour' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfour' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'twentytwentyfour' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'twentytwentyfour' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'twentytwentyfour_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'twentytwentyfour_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfour_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'twentytwentyfour' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfour' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_pattern_categories' );



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