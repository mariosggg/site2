<?php if (! defined('FANA_THEME_DIR')) {
    exit('No direct script access allowed');
}
/**
 * Fana woocommerce Template Hooks
 *
 * Action/filter hooks used for Fana woocommerce functions/templates.
 *
 */


/**
 * Fana Header Mobile Content.
 *
 * @see fana_the_button_mobile_menu()
 * @see fana_the_logo_mobile()
 */
add_action('fana_header_mobile_content', 'fana_the_button_mobile_menu', 5);
add_action('fana_header_mobile_content', 'fana_the_icon_home_page_mobile', 10);
add_action('fana_header_mobile_content', 'fana_the_logo_mobile', 15);
add_action('fana_header_mobile_content', 'fana_the_icon_mini_cart_header_mobile', 20);


/**
 * Fana Header Mobile before content
 *
 * @see fana_the_hook_header_mobile_all_page
 */
add_action('fana_before_header_mobile', 'fana_the_hook_header_mobile_all_page', 5);

/**Page Cart**/
remove_action('woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20);
