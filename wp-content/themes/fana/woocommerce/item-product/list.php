<?php
global $product;

?>
<div class="product-block list" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
	<?php
        /**
        * Hook: fana_woocommerce_before_shop_list_item.
        *
        * @hooked fana_remove_add_to_cart_list_product - 10
        */
        do_action('fana_woocommerce_before_shop_list_item');
    ?>
	<div class="product-content row">
		<div class="block-inner col-lg-4 col-4">
			<?php
                /**
                * Hook: woocommerce_before_shop_loop_item.
                *
                * @hooked woocommerce_template_loop_product_link_open - 10
                */
                do_action('woocommerce_before_shop_loop_item');
            ?>
			<figure class="image <?php fana_product_block_image_class(); ?>">
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="product-image">
					<?php
                        /**
                        * woocommerce_before_shop_loop_item_title hook
                        *
                        * @hooked woocommerce_show_product_loop_sale_flash - 10
                        * @hooked woocommerce_template_loop_product_thumbnail - 10
                        */
                        do_action('woocommerce_before_shop_loop_item_title');
                    ?>
				</a>

				<?php
                    /**
                    * fana_tbay_after_shop_loop_item_title hook
                    *
                    */
                    do_action('fana_tbay_after_shop_loop_item_title');
                ?>
				<?php
                    /**
                    * tbay_woocommerce_before_content_product hook
                    *
                    * @hooked woocommerce_show_product_loop_sale_flash - 10
                    */
                    do_action('tbay_woocommerce_before_content_product');
                ?>
				
			</figure>
		</div>
		<div class="caption col-lg-8 col-8">
            <div class="caption-right">
                <?php               
                    /**
                    * fana_woo_list_right hook
                    *
                    * @hooked fana_the_product_name - 10
                    * @hooked woocommerce_template_loop_price - 20
                    * @hooked woocommerce_template_loop_rating - 30
                    */
                    do_action('fana_woo_list_right');
                ?>

                <?php
                    /**
                    * fana_after_title_tbay_subtitle hook
                    *
                    * @hooked fana_woo_get_subtitle - 0
                    */
                    do_action('fana_after_title_tbay_subtitle');
                ?>


                <?php
                    do_action('fana_woo_before_shop_list_caption');
                ?>
                
				
				<?php
                if (!empty(get_the_excerpt())) {
                    ?>
					<div class="woocommerce-product-details__short-description">
						<?php the_excerpt(); ?>
					</div>
					<?php
                }
                ?>
				
				   <?php
                    /**
                    * fana_woo_list_after_short_description hook
                    *
                    * @hooked the_woocommerce_variable - 5
                    * @hooked list_variable_swatches_pro - 5
                    * @hooked fana_tbay_total_sales - 15
                    */
                    do_action('fana_woo_list_after_short_description');
                ?>


                <?php
                    /**
                    * Hook: woocommerce_after_shop_loop_item.
                    */
                    do_action('woocommerce_after_shop_loop_item');
                ?>
				
            </div>

            <div class="caption-left">
                <div class="group-buttons">	
                    <?php
                        /**
                        * fana_woocommerce_group_buttons_list hook
                        *
                        * @hooked woocommerce_template_loop_add_to_cart - 10
                        * @hooked fana_the_yith_wishlist - 20
                        * @hooked fana_the_yith_compare - 30
                        * @hooked fana_the_quick_view - 40
                        */
                        do_action('fana_woocommerce_group_buttons_list', $product->get_id());
                    ?>
                </div>
                <div class="group-add-to-cart">
                    <?php 
                        /**
                        * fana_woocommerce_group_add_to_cart hook
                        *
                        * @hooked woocommerce_template_loop_add_to_cart - 10
                        */
                        do_action( 'fana_woocommerce_group_add_to_cart', $product->get_id() );
                    ?>
                </div>
            </div>
	    </div>
	</div>
	<?php
        do_action('fana_woocommerce_after_shop_list_item');
    ?>
</div>


