<?php
global $product;

$attachment_ids = $product->get_gallery_image_ids();

wp_enqueue_script('slick');
wp_enqueue_script('fana-custom-slick');

$sidebar_configs    = fana_tbay_get_woocommerce_layout_configs();
$images_layout      = ( !empty($sidebar_configs['thumbnail']) ) ? $sidebar_configs['thumbnail'] : 'horizontal';
$images_position      = ( !empty($sidebar_configs['position']) ) ? $sidebar_configs['position'] : 'horizontal-top';
$is_rtl 			= (is_rtl()) ? 'yes' : 'no'; 

$columns           = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();

$video_url              = $product->get_meta( '_aora_video_url' );

$wrapper_classes   = apply_filters('woocommerce_single_product_image_gallery_classes', array(
    'woocommerce-product-gallery',
    'woocommerce-product-gallery--' . ($product->get_image_id() ? 'with-images' : 'without-images'),
    'woocommerce-product-gallery--columns-' . absint($columns),
    'images', 
    ( !empty($attachment_ids) || !empty($video_url) ) ? 'has-gallery' : 'no-gallery',
));

?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-rtl="<?php echo esc_attr($is_rtl); ?>" data-position=<?php echo esc_attr($images_position); ?> data-layout=<?php echo esc_attr($images_layout); ?> style="opacity: 0; transition: opacity .25s ease-in-out;">

	<div class="woocommerce-product-gallery__wrapper">
		<?php
        do_action('fana_woocommerce_before_product_thumbnails');
        
        if ($product->get_image_id()) {
            $html = wc_get_gallery_image_html($post_thumbnail_id, true);
        } else {
            $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
            $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_attr__('Awaiting product image', 'fana'));
            $html .= '</div>';
        }

            
        echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
        do_action('woocommerce_product_thumbnails');
        
        ?>
	</div>
    <?php 
		do_action( 'fana_woocommerce_after_product_thumbnails' );
	?>
</div>
