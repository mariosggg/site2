<?php if (! defined('FANA_THEME_DIR')) {
    exit('No direct script access allowed');
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Mobile Menu
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_tbay_get_button_mobile_menu')) {
    function fana_tbay_get_button_mobile_menu()
    {
        $output 	= '';
        $output 	.= '<a href="#tbay-mobile-menu-navbar" class="btn btn-sm">';
        $output  .= '<i class="tb-icon tb-icon-menu"></i>';
        $output  .= '</a>';

        
        return apply_filters('fana_tbay_get_button_mobile_menu', '<div class="active-mobile">'. $output . '</div>', 10);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Mobile Menu
 * ------------------------------------------------------------------------------------------------
 */

if (! function_exists('fana_the_button_mobile_menu')) {
    function fana_the_button_mobile_menu()
    {
        wp_enqueue_script('jquery-mmenu');
        $ouput = fana_tbay_get_button_mobile_menu();
        
        echo trim($ouput);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Logo Mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_tbay_get_logo_mobile')) {
    function fana_tbay_get_logo_mobile()
    {
        $mobilelogo 			= fana_tbay_get_config('mobile-logo');

        $output 	= '<div class="mobile-logo">';
        if (isset($mobilelogo['url']) && !empty($mobilelogo['url'])) {
            $url    	= $mobilelogo['url'];
            $output 	.= '<a href="'. esc_url(home_url('/')) .'">';

            if (isset($mobilelogo['width']) && !empty($mobilelogo['width'])) {
                $output 		.= '<img src="'. esc_url($url) .'" width="'. esc_attr($mobilelogo['width']) .'" height="'. esc_attr($mobilelogo['height']) .'" alt="'. get_bloginfo('name') .'">';
            } else {
                $output 		.= '<img class="logo-mobile-img" src="'. esc_url($url) .'" alt="'. get_bloginfo('name') .'">';
            }

                
            $output 		.= '</a>';
        } else {
            $output 		.= '<div class="logo-theme">';
            $output 	.= '<a href="'. esc_url(home_url('/')) .'">';
            $output 	.= '<img class="logo-mobile-img" src="'. esc_url_raw(FANA_IMAGES.'/'. fana_tbay_get_theme() .'/logo.svg') .'" alt="'. get_bloginfo('name') .'">';
            $output 	.= '</a>';
            $output 		.= '</div>';
        }
        $output 	.= '</div>';
        
        return apply_filters('fana_tbay_get_logo_mobile', $output, 10);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Logo Mobile Menu
 * ------------------------------------------------------------------------------------------------
 */

if (! function_exists('fana_the_logo_mobile')) {
    function fana_the_logo_mobile()
    {
        $ouput = fana_tbay_get_logo_mobile();
        echo trim($ouput);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Mini cart mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_the_icon_mini_cart_mobile')) {
    function fana_the_icon_mini_cart_mobile()
    {
        ?><div class="device-mini_cart top-cart tbay-element-mini-cart"><?php
            if (fana_woocommerce_activated() && !fana_catalog_mode_active()) {
                global $woocommerce;
                $_id 	= fana_tbay_random_key();
                if (!fana_woocommerce_activated() || fana_catalog_mode_active()) {
                    return;
                } ?>
                    <?php 
                        if( !is_checkout() && !is_cart() ) {
                            fana_tbay_get_page_templates_parts('device/offcanvas-cart', 'mobile');
                        }

                        $data_dropdown = ( is_checkout() || is_cart() ) ? '' : 'data-bs-toggle="offcanvas" data-bs-target="#cart-offcanvas-mobile" aria-controls="cart-offcanvas-mobile"';
                    ?>
					<div class="tbay-topcart">
						<div id="cart-<?php echo esc_attr($_id); ?>" class="cart-dropdown dropdown">
                            <a class="dropdown-toggle mini-cart v2" <?php echo $data_dropdown; ?>  href="<?php echo ( is_checkout() ) ? wc_get_cart_url() : 'javascript:void(0);'; ?>">
                                    <i class="tb-icon tb-icon-cart"></i>
									<span class="mini-cart-items">
									<?php echo sprintf('%d', $woocommerce->cart->cart_contents_count); ?>
									</span>
								<span><?php esc_html_e('Cart', 'fana'); ?></span>
							</a>   
						</div>
					</div> 
				<?php
            } ?></div><?php
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Mini cart header mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_the_icon_mini_cart_header_mobile')) {
    function fana_the_icon_mini_cart_header_mobile()
    {
        fana_the_icon_mini_cart_mobile();
    }
}


/**
 * ------------------------------------------------------------------------------------------------
 * The search header mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_the_search_header_mobile')) {
    function fana_the_search_header_mobile()
    {
        ?>
			<?php
                $menu_mobile_search 	= fana_tbay_get_config('menu_mobile_search', true);
        if (!$menu_mobile_search && !fana_tbay_is_home_page()) {
            return;
        }

        if ($menu_mobile_search || fana_tbay_is_home_page()) {
            ?>
					<div class="search-device"> 
						<?php fana_tbay_get_page_templates_parts('device/productsearchform', 'mobileheader'); ?>
					</div>
					<?php
        } ?>
			

		<?php
    }
    add_action('fana_after_header_mobile', 'fana_the_search_header_mobile', 5);
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Mini cart mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_the_mini_cart_header_mobile')) {
    function fana_the_mini_cart_header_mobile()
    {
        fana_tbay_get_page_templates_parts('offcanvas-cart', 'right');
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Top right header mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_top_header_mobile')) {
    function fana_top_header_mobile() { ?>
		<div class="top-right-mobile">
			<?php
                /**
                * Hook: fana_top_header_mobile.
                *
                * @hooked fana_the_mini_cart_header_mobile - 5
                */
                do_action('fana_top_header_mobile');
            ?>
		</div>
	<?php }
}


/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Back on Header Mobile
 * ------------------------------------------------------------------------------------------------
 */


/**
 * ------------------------------------------------------------------------------------------------
 * The icon Back On Header Mobile
 * ------------------------------------------------------------------------------------------------
 */


/**
 * ------------------------------------------------------------------------------------------------
 * Get Title Page Header Mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_tbay_get_title_page_mobile')) {
    function fana_tbay_get_title_page_mobile()
    {
        $output = '';

        if ( fana_woocommerce_activated() && is_product_category() ) { 
            $output     .= apply_filters('fana_get_filter_title_mobile', 10, 2);
        } else {
            $output     .= '<div class="topbar-title">';
            $output     .= apply_filters('fana_get_filter_title_mobile', 10, 2);
            $output     .= '</div>';
        }
        
        return apply_filters('fana_tbay_get_title_page_mobile', $output, 10);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The icon Back On Header Mobile
 * ------------------------------------------------------------------------------------------------
 */

if (! function_exists('fana_the_title_page_mobile')) {
    function fana_the_title_page_mobile()
    {
        $output = fana_tbay_get_title_page_mobile();
        echo trim($output);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Home Page On Header Mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_tbay_get_icon_home_page_mobile')) {
    function fana_tbay_get_icon_home_page_mobile()
    {
        $output 	= '<div class="topbar-icon-home">';
        $output 	.= '<a href="'. esc_url(home_url('/')) .'">';
        $output  	.= apply_filters('fana_get_mobile_home_icon', '<i class="tb-icon tb-icon-home3"></i>', 2);
        $output  	.= '</a>';
        $output  	.= '</div>';
        
        return apply_filters('fana_tbay_get_icon_home_page_mobile', $output, 10);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Home Page On Header Mobile
 * ------------------------------------------------------------------------------------------------
 */

if (! function_exists('fana_the_icon_home_page_mobile')) {
    function fana_the_icon_home_page_mobile()
    {
        $ouput = fana_tbay_get_icon_home_page_mobile();
        echo trim($ouput);
    }
}


/**
 * ------------------------------------------------------------------------------------------------
 * The Hook Config Header Mobile
 * ------------------------------------------------------------------------------------------------
 */

if (! function_exists('fana_the_hook_header_mobile_all_page')) {
    function fana_the_hook_header_mobile_all_page()
    {
        $always_display_logo 			= fana_tbay_get_config('always_display_logo', true);

        if ($always_display_logo) {
            remove_action('fana_header_mobile_content', 'fana_the_icon_home_page_mobile', 10);
        }
        
        if ($always_display_logo || fana_tbay_is_home_page()) {
            return;
        }

        remove_action('fana_header_mobile_content', 'fana_the_logo_mobile', 15);
        add_action('fana_header_mobile_content', 'fana_the_title_page_mobile', 15);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Hook Menu Mobile All page Header Mobile
 * ------------------------------------------------------------------------------------------------
 */



/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Home Page On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_tbay_get_icon_home_footer_mobile')) {
    function fana_tbay_get_icon_home_footer_mobile()
    {
        $active = (is_front_page()) ? 'active' : '';

        $output	 = '<div class="device-home '. $active .' ">';
        $output  .= '<a href="'. esc_url(home_url('/')) .'" >';
        $output  .= apply_filters('fana_get_mobile_home_icon', '<i class="tb-icon tb-icon-home3"></i>', 2);
        $output  .= '<span>'. esc_html__('Home', 'fana'). '</span>';
        $output  .='</a>';
        $output  .='</div>';
        
        return apply_filters('fana_tbay_get_icon_home_footer_mobile', $output, 10);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Home Page On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */

if (! function_exists('fana_the_icon_home_footer_mobile')) {
    function fana_the_icon_home_footer_mobile()
    {
        $ouput = fana_tbay_get_icon_home_footer_mobile();
        
        echo trim($ouput);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Wishlist On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_tbay_get_icon_wishlist_footer_mobile')) {
    function fana_tbay_get_icon_wishlist_footer_mobile()
    {
        $output = '';
        
        if (!class_exists('YITH_WCWL')) {
            return $output;
        }

        $wishlist_url 	= YITH_WCWL()->get_wishlist_url();
        $wishlist_count = YITH_WCWL()->count_products();

        $output	 .= '<div class="device-wishlist">';
        $output  .= '<a class="text-skin wishlist-icon" href="'. esc_url($wishlist_url) .'" >';
        $output  .= apply_filters('fana_get_mobile_wishlist_icon', '<i class="tb-icon tb-icon-heart"></i>', 2);
        $output  .= '<span class="count count_wishlist"><span>'. esc_html($wishlist_count) .'</span></span>';
        $output  .= '<span>'. esc_html__('Wishlist', 'fana'). '</span>';
        $output  .='</a>';
        $output  .='</div>';
        
        return apply_filters('fana_tbay_get_icon_wishlist_footer_mobile', $output, 10);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Wishlist On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */

if (! function_exists('fana_the_icon_wishlist_footer_mobile')) {
    function fana_the_icon_wishlist_footer_mobile()
    {
        $ouput = fana_tbay_get_icon_wishlist_footer_mobile();
        
        echo trim($ouput);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Account On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('fana_tbay_get_icon_account_footer_mobile')) {
    function fana_tbay_get_icon_account_footer_mobile()
    {
        $output = '';

        if (!fana_woocommerce_activated() || fana_catalog_mode_active()) {
            return $output;
        }

        $icon_text 	= apply_filters('fana_get_mobile_user_icon', '<i class="tb-icon tb-icon-user"></i>', 2);
        $icon_text .= '<span>'.esc_html__('Account', 'fana').'</span>';

        $active 	= (is_account_page()) ? 'active' : '';

        $output	 .= '<div class="device-account '. esc_attr($active) .'">';
        if (is_user_logged_in()) {
            $output .= '<a class="logged-in" href="'. esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) .'"  title="'. esc_attr__('Login', 'fana') .'">';
        } else {
            $output .= '<a class="popup-login" href="javascript:void(0);"  title="'. esc_attr__('Login', 'fana') .'">';
        }
        $output .= $icon_text;
        $output .= '</a>';

        $output  .='</div>';
        
        return apply_filters('fana_tbay_get_icon_account_footer_mobile', $output, 10);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Account On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */

if (! function_exists('fana_the_icon_account_footer_mobile')) {
    function fana_the_icon_account_footer_mobile()
    {
        $ouput = fana_tbay_get_icon_account_footer_mobile();
        
        echo trim($ouput);
    }
}


if (! function_exists('fana_the_custom_list_menu_icon')) {
    function fana_the_custom_list_menu_icon()
    {
        $slides = fana_tbay_get_config('mobile_footer_slides');

        if (!fana_tbay_get_config('mobile_footer_icon', true) || empty($slides)) {
            return;
        }

        $list_menu_icon = '';
        foreach ($slides as $key => $value) {
            $list_menu_icon .= fana_get_list_menu_icon($value);
        }

        if (!empty($list_menu_icon)) {
            printf('<div class="list-menu-icon">%s</div>', apply_filters('fana_list_menu_icon', $list_menu_icon));
        }
    }

    add_action('fana_footer_mobile_content', 'fana_the_custom_list_menu_icon', 10);
}

if (! function_exists('fana_get_list_menu_icon')) {
    function fana_get_list_menu_icon($value)
    {
        $title 	= (isset($value['title'])) ? $value['title'] : '';
        $link 	= (isset($value['url'])) ? $value['url'] : '';
        $icon 	= (isset($value['description'])) ? $value['description'] : '';
        $thumb 	= (isset($value['thumb'])) ? $value['thumb'] : '';
        $class  = '';

        $matches = array();
        preg_match_all('/{{(.*?)}}/', $link, $matches);
        
        if (isset($matches[1][0]) && !is_null($matches[1][0])) {
            $url_wishlist = $url_account = '';

            if (fana_woocommerce_activated() && !fana_catalog_mode_active()) {
                $url_account 	= apply_filters('wpml_woo_myaccount_url', get_permalink(get_option('woocommerce_myaccount_page_id')));
                $url_cart 		= apply_filters('wpml_woo_cart_url', wc_get_cart_url());
                $url_checkout 	= apply_filters('wpml_woo_checkout_url', wc_get_checkout_url());
                $url_shop 		= apply_filters('wpml_woo_shop_url', get_permalink(wc_get_page_id('shop')));
                if (class_exists('YITH_WCWL')) {
                    $url_wishlist = apply_filters('wpml_woo_wishlist_url', YITH_WCWL()->get_wishlist_url());
                }

                switch ($matches[1][0]) {
                    case 'home':
                        $link = apply_filters('wpml_home_url', get_home_url());
                        break;
                        
                    case 'wishlist':
                        $link = $url_wishlist;
                        break;
    
                    case 'shop':
                        $link = $url_shop;
                        break;
                        
                    case 'account':
                        $link = $url_account;
                        break;
    
                    case 'cart':
                        $link = $url_cart;
                        break;
    
                    case 'checkout':
                        $link = $url_checkout;
                        break;
                    
                    default:
                        break;
                }
            } else {
                $link = apply_filters('wpml_home_url', get_home_url());
            }

            if (empty($link)) {
                return;
            }

            $class .= $matches[1][0];
        }



        if (empty($title) && empty($icon)&& empty($thumb)) {
            return;
        }

        global $wp;
        $current_url = home_url(add_query_arg(array(), $wp->request));
        
        $class 	.= ($current_url == rtrim($link, "/")) ? ' active' : '';
        $output = '<div class="menu-icon">';

        if (!empty($link)) {

            if( isset($url_account) && $link === $url_account && !is_user_logged_in() ) {
                $output .= '<a data-bs-toggle="modal" data-bs-target="#custom-login-wrapper" href="javascript:void(0)">';
            } else {
                $output .= '<a title="'. esc_attr($title) .'" class="'. esc_attr($class) .'" href="'. esc_url($link) .'">';      
            }

        }

        $output .= '<span class="menu-icon-child">';
        if (!empty($thumb)) {
            $output .= '<img src="'. esc_url($thumb) .'">';
        } elseif (!empty($icon)) {
            $output .= '<i class="'. esc_attr($icon) .'"></i>';
        }

        if (isset($matches[1][0])  && class_exists('YITH_WCWL') && $matches[1][0] === 'wishlist') {
            $wishlist_count = YITH_WCWL()->count_products();
            $output .= '<span class="count count_wishlist"><span>'. trim($wishlist_count) .'</span></span>';
        }

        if (isset($matches[1][0])  && fana_woocommerce_activated() && $matches[1][0] === 'cart') {
            global $woocommerce;
            $output .= '<span class="mini-cart-items">'. trim($woocommerce->cart->cart_contents_count) .'</span>';
        }

        if (!empty($title)) {
            $output .= '<span>'. trim($title) .'</span>';
        }

        $output .= '</span>';

        if (!empty($link)) {
            $output .= '</a>';
        }

        $output .= '</div>';
        
        return $output;
    }
}
