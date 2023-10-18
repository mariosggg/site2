<?php
if ( !fana_woocommerce_activated() ) return;

/**
 * ------------------------------------------------------------------------------------------------
 * QuickView button
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_the_quick_view')) {
    function fana_the_quick_view($product_id)
    {
        if( !fana_tbay_get_config('enable_quickview', false) ) return;
        ?>
        <div class="tbay-quick-view">  
            <a href="#" class="qview-button" title ="<?php esc_attr_e('Quick View', 'fana') ?>" data-effect="mfp-move-from-top" data-product_id="<?php echo esc_attr($product_id); ?>">
                <i class="tb-icon tb-icon-search-normal"></i>
                <span><?php esc_html_e('Quick View', 'fana') ?></span>
            </a>
        </div> 
        <?php
    }
}