<?php 

if(!class_exists('WooCommerce')) return;

add_action('fana_woocommerce_group_buttons', 'fana_the_quick_view', 20, 1);
add_action('fana_woocommerce_group_buttons', 'fana_the_yith_wishlist', 30, 1);
add_action('fana_woocommerce_group_buttons', 'fana_the_yith_compare', 40, 1);
add_action('fana_woocommerce_group_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10, 1);

if ( ! function_exists( 'fana_woocommerce_setup_size_image' ) ) {
    function fana_woocommerce_setup_size_image() {
        $thumbnail_width = 440;
        $main_image_width = 800;
        $cropping_custom_width = 220;
        $cropping_custom_height = 293;

        // Image sizes
        update_option('woocommerce_thumbnail_image_width', $thumbnail_width);
        update_option('woocommerce_single_image_width', $main_image_width);

        update_option('woocommerce_thumbnail_cropping', 'custom');
        update_option('woocommerce_thumbnail_cropping_custom_width', $cropping_custom_width);
        update_option('woocommerce_thumbnail_cropping_custom_height', $cropping_custom_height);
    }
    add_action( 'after_setup_theme', 'fana_woocommerce_setup_size_image' );
}

if(fana_tbay_get_global_config('config_media',false)) {
    remove_action( 'after_setup_theme', 'fana_woocommerce_setup_size_image' );
}

if ( ! function_exists( 'fana_woocommerce_change_grid_group_buttons' ) ) {
    function fana_woocommerce_change_grid_group_buttons() {
        remove_action( 'fana_woocommerce_group_buttons', 'woocommerce_template_loop_add_to_cart', 10);
    }
    add_action('fana_woocommerce_before_product_block_grid', 'fana_woocommerce_change_grid_group_buttons', 10);
}

if ( ! function_exists( 'fana_woocommerce_quantity_mode_remove_grid_block_add_to_cart' ) ) {
    function fana_woocommerce_quantity_mode_remove_grid_block_add_to_cart() {
        if( fana_is_woo_variation_swatches_pro() || fana_woocommerce_quantity_mode_active() ) {
            remove_action( 'fana_woocommerce_group_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10 );
        }
    }
    add_action( 'fana_tbay_after_shop_loop_item_title', 'fana_woocommerce_quantity_mode_remove_grid_block_add_to_cart', 10 ); 
}