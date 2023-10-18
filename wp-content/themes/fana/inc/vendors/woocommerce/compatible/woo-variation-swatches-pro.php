<?php

if ( !fana_is_woo_variation_swatches_pro() ) return;

if ( ! function_exists( 'fana_quantity_swatches_pro_field_archive' ) ) {
    function fana_quantity_swatches_pro_field_archive( ) {

        global $product;
        if ( fana_is_quantity_field_archive() ) {
            woocommerce_quantity_input( array( 'min_value' => 1, 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity() ) );
        }

    }
}

if ( ! function_exists( 'fana_variation_swatches_pro_group_button' ) ) {
    add_action('fana_woo_before_shop_loop_item_caption', 'fana_variation_swatches_pro_group_button', 5);
    function fana_variation_swatches_pro_group_button() {
        if( !fana_is_woo_variation_swatches_pro() ) return;

        $class_active = '';

        if( fana_woocommerce_quantity_mode_active() ) {
            $class_active .= 'quantity-group-btn';

            if( fana_is_quantity_field_archive() ) {
                $class_active .= ' active';
            }
        } else { 
            $class_active .= 'woo-swatches-pro-btn';
        }

        echo '<div class="'. esc_attr($class_active) .'">';

            if( fana_woocommerce_quantity_mode_active() ) {
                fana_quantity_swatches_pro_field_archive();
            }

            woocommerce_template_loop_add_to_cart();
        echo '</div>';
    }
}