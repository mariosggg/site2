<?php

// Remove default breadcrumb
add_filter('woocommerce_breadcrumb_defaults', 'fana_tbay_woocommerce_breadcrumb_defaults');
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('fana_woo_template_main_wrapper_before', 'woocommerce_breadcrumb', 20);


remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

/**
 * Product Rating
 *
 * @see fana_woocommerce_loop_item_rating()
 */

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('fana_woocommerce_loop_item_rating', 'woocommerce_template_loop_rating', 1);

//Change postition label sale
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

// Remove Default Sidebars
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);



/**
 * Product Add to cart.
 *
 * @see woocommerce_template_single_add_to_cart()
 * @see woocommerce_simple_add_to_cart()
 * @see woocommerce_grouped_add_to_cart()
 * @see woocommerce_variable_add_to_cart()
 * @see woocommerce_external_add_to_cart()
 * @see woocommerce_single_variation()
 * @see woocommerce_single_variation_add_to_cart_button()
 */
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 ); 
add_action('woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30);
add_action('woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30);
add_action('woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30);
add_action('woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30);
add_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
add_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);

add_action('woocommerce_single_product_summary', 'fana_woo_get_subtitle', 5);

add_action('woocommerce_single_product_summary', 'fana_product_popup_group_buttons', 35);
add_action('fana_woocommerce_single_product_summary_right', 'fana_product_popup_group_buttons', 15);

/*Add custom html before, after button add to cart*/
add_action('woocommerce_before_add_to_cart_form', 'fana_html_before_add_to_cart_button', 10, 0);
add_action('woocommerce_after_add_to_cart_form', 'fana_html_after_add_to_cart_button', 99);

/*Add custom html before, after inner product summary*/
add_action('woocommerce_single_product_summary', 'fana_html_before_inner_product_summary', 1, 0);
add_action('woocommerce_single_product_summary', 'fana_html_after_inner_product_summary', 99);
add_action('fana_woocommerce_single_product_summary_left', 'fana_html_after_inner_product_summary', 99);

add_action('woocommerce_before_single_product', 'fana_html_before_product_summary', 5, 0);
add_action('woocommerce_after_single_product', 'fana_html_after_product_summary', 5, 0);

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * Product Vertical
 *
 * @see woocommerce_after_shop_loop_item_vertical_title()
 */


add_action('woocommerce_after_shop_loop_item_vertical_title', 'woocommerce_template_loop_rating', 15);
add_action('woocommerce_after_shop_loop_item_vertical_title', 'woocommerce_template_loop_price', 10);


/**
 * Product Grid
 *
 */
add_action('fana_woo_before_shop_loop_item_caption', 'fana_woocommerce_quantity_mode_group_button', 5);
add_action('fana_woocommerce_group_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10, 1);

// Product Landing Page

add_action('fana_add_to_cart_landing_page', 'woocommerce_template_loop_add_to_cart', 10, 1);

/**
 * Product List
 * fana_woocommerce_group_buttons_list
 *
 */
add_action('fana_woocommerce_group_buttons_list', 'fana_the_quick_view', 10, 1);
add_action('fana_woocommerce_group_buttons_list', 'fana_the_yith_wishlist', 20, 1);
add_action('fana_woocommerce_group_buttons_list', 'fana_the_yith_compare', 30, 1);


remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

/**
 * Product List
 *
 */



add_action('fana_woo_list_right', 'fana_the_product_name', 10);
add_action('fana_woo_list_right', 'woocommerce_template_loop_price', 20);
add_action('fana_woo_list_right', 'woocommerce_template_loop_rating', 30);
add_action('fana_woocommerce_before_shop_list_item', 'fana_woocommerce_add_quantity_mode_list', 5);