<?php
if ( !fana_woocommerce_activated() ) return;

/**
 * ------------------------------------------------------------------------------------------------
 * Size Guide button
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_the_size_guide')) {
    function fana_the_size_guide($product_id)
    {
        $size_guide_type     = maybe_unserialize(get_post_meta($product_id, '_fana_size_guide_type', true));

        if( !empty($size_guide_type) && $size_guide_type !== 'global' ) {
            $size_guide          = maybe_unserialize(get_post_meta($product_id, '_fana_size_guide', true));
        } else {
            $size_guide          = maybe_unserialize(fana_tbay_get_config('single_size_guide'));
        } 

        if( empty($size_guide) ) return;
        
        wp_enqueue_script('jquery-magnific-popup');
        wp_enqueue_style('magnific-popup');
        ?>
        <li class="item tbay-size-guide">
            <a href="#tbay-content-size-guide" class="popup-button-open">
                <i class="tb-icon tb-icon-size-guide"></i>
                <span><?php esc_html_e('Size Guide', 'fana'); ?></span>
            </a>
            <div id="tbay-content-size-guide" class="tbay-popup-content tbay-popup-size-guid zoom-anim-dialog mfp-hide">
                <div class="content">
                    <h3 class="tbay-headling-popup"><?php esc_html_e('Size Guide', 'fana'); ?></h3>
                    <?php echo do_shortcode($size_guide); ?>
                </div>
            </div>
        </li>
        <?php
    }
}