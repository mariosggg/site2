
<?php
/**
 * fana_woocommerce_before_quick_view hook
 */
do_action('fana_woocommerce_before_quick_view');  
?>
<div id="tbay-quick-view-body" class="woocommerce single-product">
    <div id="tbay-quick-view-content"> 
        <div id="product-<?php the_ID(); ?>" <?php post_class('product '); ?>>
        <?php 
            wc_get_template_part( 'content', 'single-product' ); 
        ?>
        </div>
    </div>
</div>
<?php
/** 
 * fana_woocommerce_after_quick_view hook
 */
do_action('fana_woocommerce_after_quick_view');
