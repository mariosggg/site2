<?php
    if( fana_checkout_optimized() ) return;
    $class_top_bar 	=  '';

    $always_display_logo 			= fana_tbay_get_config('always_display_logo', true);
    if (!$always_display_logo && !fana_catalog_mode_active() && fana_woocommerce_activated() && (is_product() || is_cart() || is_checkout())) {
        $class_top_bar .= ' active-home-icon';
    }
?>
<div class="topbar-device-mobile d-xl-none clearfix <?php echo esc_attr($class_top_bar); ?>">

	<?php
        /**
        * fana_before_header_mobile hook
        */
        do_action('fana_before_header_mobile');

        /**
        * Hook: fana_header_mobile_content.
        *
        * @hooked fana_the_button_mobile_menu - 5
        * @hooked fana_the_logo_mobile - 10
        * @hooked fana_the_title_page_mobile - 10
        */

        do_action('fana_header_mobile_content');

        /**
        * fana_after_header_mobile hook

        * @hooked fana_the_search_header_mobile - 5
        */
        
        do_action('fana_after_header_mobile');
    ?>
</div>