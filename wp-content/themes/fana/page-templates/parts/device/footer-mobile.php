<?php
    if( fana_checkout_optimized() ) return;
    /**
     * fana_before_topbar_mobile hook
     */
    do_action('fana_before_footer_mobile');
    $mobile_footer_slides = fana_tbay_get_config('mobile_footer_slides');
?>



<?php
    if ($mobile_footer_slides && !empty($mobile_footer_slides)) {
        ?>
            <div class="footer-device-mobile d-xl-none clearfix">
            <?php
                /**
                * fana_before_footer_mobile hook
                */
                do_action('fana_before_footer_mobile');

        /**
        * Hook: fana_footer_mobile_content.
        *
        * @hooked fana_the_custom_list_menu_icon - 10
        */

        do_action('fana_footer_mobile_content');

        /**
        * fana_after_footer_mobile hook
        */
        do_action('fana_after_footer_mobile'); ?>
            </div>
        <?php
    }
?>

