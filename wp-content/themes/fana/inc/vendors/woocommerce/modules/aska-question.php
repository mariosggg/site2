<?php
if ( !fana_woocommerce_activated() ) return;

/**
 * ------------------------------------------------------------------------------------------------
 * Size Guide button
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_the_aska_question')) {
    function fana_the_aska_question( $product_id )
    {
        $aska_question          = maybe_unserialize(fana_tbay_get_config('single_aska_question'));

        if( empty($aska_question) ) return;
        
        wp_enqueue_script('jquery-magnific-popup');
        wp_enqueue_style('magnific-popup');

        $product    = wc_get_product( $product_id );
        $image_id   = $product->get_image_id();
        $image      = wp_get_attachment_image( $image_id, 'woocommerce_thumbnail' );
        ?>
        <li class="item tbay-aska-question">
            <a href="#tbay-content-aska-question" class="popup-button-open">
                <i class="tb-icon tb-icon-question"></i>
                <span><?php esc_html_e('Ask a Question', 'fana'); ?></span>
            </a>
            <div id="tbay-content-aska-question" class="tbay-popup-content popup-aska-question zoom-anim-dialog mfp-hide">
                <div class="content">
                    <h3 class="tbay-headling-popup"><?php esc_html_e('Ask a Question', 'fana'); ?></h3>
                    <div class="tbay-product d-flex">
                        <div class="image">
                            <?php echo trim($image); ?>  
                        </div>
                        <div class="product-info">
                            <h4 class="name"><?php echo trim($product->get_name()); ?></h4>
                            <span class="price"><?php echo trim($product->get_price_html()); ?></span>
                        </div>
                    </div>
                    <div class="tbay-wrap">
                        <?php echo do_shortcode($aska_question); ?>
                    </div>
                </div>
            </div>
        </li>
        <?php
    }
}