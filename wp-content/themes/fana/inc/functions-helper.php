<?php if (! defined('FANA_THEME_DIR')) {
    exit('No direct script access allowed');
}

if (! function_exists('fana_tbay_body_classes')) {
    function fana_tbay_body_classes($classes)
    {
        global $post;
        if (is_page() && is_object($post)) {
            $class = get_post_meta($post->ID, 'tbay_page_extra_class', true);
            if (!empty($class)) {
                $classes[] = trim($class);
            }
        }
        if (fana_tbay_get_config('preload')) {
            $classes[] = 'tb-loader';
        }

        if (fana_tbay_is_home_page()) {
            $classes[] = 'tb-home';
        }
          
        if (!fana_redux_framework_activated()) {
            $classes[] = 'tb-default';
        }

        $menu_mobile_search 	= fana_tbay_get_config('menu_mobile_search', true);
        if ($menu_mobile_search) {
            $classes[] = 'tbay-search-mb';
        }

        if( fana_checkout_optimized() ) {
            $classes[] = 'tb-checkout-optimized';
        }

        if( !fana_tbay_get_config('always_display_logo', true) ) {
            $classes[] = 'hdmb-hdlogo';
        } 

        if( fana_tbay_get_config('dark_mode', false) || ( isset($_GET['darkmode']) && $_GET['darkmode'] == 'on' ) ) {
			$classes[] = 'tbay-dark-mode-active';
		}
           

        return $classes;
    }
    add_filter('body_class', 'fana_tbay_body_classes');
}

if (! function_exists('fana_tbay_get_shortcode_regex')) {
    function fana_tbay_get_shortcode_regex($tagregexp = '')
    {
        // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
        // Also, see shortcode_unautop() and shortcode.js.
        return
            '\\['                                // Opening bracket
            . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
            . "($tagregexp)"                     // 2: Shortcode name
            . '(?![\\w-])'                       // Not followed by word cfanacter or hyphen
            . '('                                // 3: Unroll the loop: Inside the opening shortcode tag
            . '[^\\]\\/]*'                   // Not a closing bracket or forward slash
            . '(?:'
            . '\\/(?!\\])'               // A forward slash not followed by a closing bracket
            . '[^\\]\\/]*'               // Not a closing bracket or forward slash
            . ')*?'
            . ')'
            . '(?:'
            . '(\\/)'                        // 4: Self closing tag ...
            . '\\]'                          // ... and closing bracket
            . '|'
            . '\\]'                          // Closing bracket
            . '(?:'
            . '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
            . '[^\\[]*+'             // Not an opening bracket
            . '(?:'
            . '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
            . '[^\\[]*+'         // Not an opening bracket
            . ')*+'
            . ')'
            . '\\[\\/\\2\\]'             // Closing shortcode tag
            . ')?'
            . ')'
            . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
    }
}

if (! function_exists('fana_tbay_tagregexp')) {
    function fana_tbay_tagregexp()
    {
        return apply_filters('fana_tbay_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|fana_tbay_media');
    }
}


if (! function_exists('fana_tbay_text_line')) {
    function fana_tbay_text_line($str)
    {
        return trim(preg_replace("/('|\"|\r?\n)/", '', $str));
    }
}

if ( !function_exists('fana_tbay_get_themes') ) {
	function fana_tbay_get_themes() {
		$themes = array();

		$themes['basic'] = array(
			'title' => esc_html__( 'Basic', 'fana' ),
			'img'   => FANA_ASSETS_IMAGES . '/active_theme/basic.jpg'
		);

		$themes['vest-suit'] = array(
			'title' => esc_html__( 'Vest Suit', 'fana' ),
			'img'   => FANA_ASSETS_IMAGES . '/active_theme/vest-suit.jpg'
		);

		$themes['bikini'] = array(
			'title' => esc_html__( 'Bikini', 'fana' ),
			'img'   => FANA_ASSETS_IMAGES . '/active_theme/bikini.jpg'
		);

		$themes['sport'] = array(
			'title' => esc_html__( 'Sport', 'fana' ),
			'img'   => FANA_ASSETS_IMAGES . '/active_theme/sport.jpg'
		);
		$themes['kids'] = array(
			'title' => esc_html__( 'Kids', 'fana' ),
			'img'   => FANA_ASSETS_IMAGES . '/active_theme/kids.jpg'
		);
		
		return $themes;

	}
}

if ( !function_exists('fana_tbay_get_theme') ) {
	function fana_tbay_get_theme() {
		$kin_default = 'basic';

		if( !empty($_GET['skin']) ) return $_GET['skin'];

		if( !empty(fana_tbay_get_global_config('active_theme',$kin_default)) ) {
		   return fana_tbay_get_global_config('active_theme',$kin_default);
		} else {
		   return $kin_default;
		}
	}
}


if (!function_exists('fana_tbay_get_header_layouts')) {
    function fana_tbay_get_header_layouts()
    {
        $headers = array( 'header_default' => esc_html__('Default', 'fana'));
        $args = array(
            'posts_per_page'   => -1,
            'offset'           => 0,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'tbay_custom_post', 
            'post_status'      => 'publish',
            'suppress_filters' => true,
            'meta_key'     => 'tbay_block_type',
            'meta_value'   => 'type_header',
            'meta_query'   => [
                'relation' => 'OR',
                [
                    'key'     => 'tbay_block_type',
                    'value'   => 'type_header',
                    'compare' => '==',
                    'type'    => 'post',
                ],
            ],
        );
        $posts = get_posts($args);
        foreach ($posts as $post) {
            $headers[$post->post_name] = $post->post_title;
        }
        return $headers;
    }
} 

if(!function_exists('fana_header_located_on_slider')) {
	function fana_header_located_on_slider() {
		$active  =   ( isset($_GET['header_located_on_slider']) ) ? $_GET['header_located_on_slider'] : fana_tbay_get_config('header_located_on_slider', false);
		
		$class = '';
		if($active) {
			$class = "header-on-slider";
		}
		
		return $class;
	}
}

if (!function_exists('fana_tbay_get_header_layout')) {
    function fana_tbay_get_header_layout()
    {
        if (is_page()) {
            global $post;
            $header = '';
            if (is_object($post) && isset($post->ID)) {
                $header = get_post_meta($post->ID, 'tbay_page_header_type', true);
                if ($header == 'global' ||  $header == '') {
                    return fana_tbay_get_config('header_type', 'header_default');
                }
            }
            return $header;
        } else if( class_exists( 'WooCommerce' ) && is_shop() ) {
			return fana_tbay_woo_get_header_layout( wc_get_page_id( 'shop' ) );
		} else if( class_exists( 'WooCommerce' ) && is_cart() ) {
			return fana_tbay_woo_get_header_layout( wc_get_page_id( 'cart' ) );
		} else if( class_exists( 'WooCommerce' ) && is_checkout() ) {
			return fana_tbay_woo_get_header_layout( wc_get_page_id( 'checkout' ) );
		}
        return fana_tbay_get_config('header_type', 'header_default');
    }
    add_filter('fana_tbay_get_header_layout', 'fana_tbay_get_header_layout');
}

if ( !function_exists('fana_tbay_woo_get_header_layout') ) {
	function fana_tbay_woo_get_header_layout( $page_id ) {
		$header = get_post_meta( $page_id, 'tbay_page_header_type', true );

		if ( $header == 'global' ||  $header == '') {
			return fana_tbay_get_config('header_type', 'header_default');
		} else {
			return $header;
		}
	}
}

if (!function_exists('fana_tbay_get_ids_custom_block')) {
    function fana_tbay_get_ids_custom_block()
    {
        $args = array(
            'posts_per_page'   => -1,
            'offset'           => 0,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'tbay_custom_post', 
            'post_status'      => 'publish',
            'suppress_filters' => true,
            'meta_key'     => 'tbay_block_type',
            'meta_value'   => 'custom',
            'meta_query'   => [
                'relation' => 'OR',
                [
                    'key'     => 'tbay_block_type',
                    'value'   => 'custom',
                    'compare' => '==',
                    'type'    => 'post',
                ],
            ],
        );
        $posts = get_posts($args);
        foreach ($posts as $post) {
            $custom[$post->ID] = $post->post_title;
        }
        return $custom;
    }
}

if (!function_exists('fana_tbay_get_footer_layouts')) {
    function fana_tbay_get_footer_layouts()
    {
        $footers = array( 'footer_default' => esc_html__('Default', 'fana'));
        $args = array(
            'posts_per_page'   => -1,
            'offset'           => 0,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'tbay_custom_post', 
            'post_status'      => 'publish',
            'suppress_filters' => true,
            'meta_key'     => 'tbay_block_type',
            'meta_value'   => 'type_footer',
            'meta_query'   => [
                'relation' => 'OR',
                [
                    'key'     => 'tbay_block_type',
                    'value'   => 'type_footer',
                    'compare' => '==',
                    'type'    => 'post',
                ],
            ],
        );
        $posts = get_posts($args);
        foreach ($posts as $post) {
            $footers[$post->post_name] = $post->post_title;
        }
        return $footers;
    }
}

if (!function_exists('fana_tbay_get_footer_layout')) {
    function fana_tbay_get_footer_layout()
    {
        if (is_page()) {
            global $post;
            $footer = '';
            if (is_object($post) && isset($post->ID)) {
                $footer = get_post_meta($post->ID, 'tbay_page_footer_type', true);
                if ($footer == 'global' ||  $footer == '') {
                    return fana_tbay_get_config('footer_type', 'footer_default');
                }
            }
            return $footer;
        } else if( class_exists( 'WooCommerce' ) && is_shop() ) {
			return fana_tbay_woo_get_footer_layout( wc_get_page_id( 'shop' ) );
		} else if( class_exists( 'WooCommerce' ) && is_cart() ) {
			return fana_tbay_woo_get_footer_layout( wc_get_page_id( 'cart' ) );
		} else if( class_exists( 'WooCommerce' ) && is_checkout() ) {
			return fana_tbay_woo_get_footer_layout( wc_get_page_id( 'checkout' ) );
		}
        return fana_tbay_get_config('footer_type', 'footer_default');
    }
    add_filter('fana_tbay_get_footer_layout', 'fana_tbay_get_footer_layout');
}

if ( !function_exists('fana_tbay_woo_get_footer_layout') ) {
	function fana_tbay_woo_get_footer_layout( $page_id ) {
		$footer = get_post_meta( $page_id, 'tbay_page_footer_type', true );

		if ( $footer == 'global' ||  $footer == '') {
			return fana_tbay_get_config('footer_type', 'footer_default');
		} else {
			return $footer;
		}
	}
}

if (!function_exists('fana_tbay_blog_content_class')) {
    function fana_tbay_blog_content_class($class)
    {
        $page = 'archive';
        if (is_singular('post')) {
            $page = 'single';
        }
        if (fana_tbay_get_config('blog_'.$page.'_fullwidth')) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter('fana_tbay_blog_content_class', 'fana_tbay_blog_content_class', 1, 1);

// layout class for woo page
if (!function_exists('fana_tbay_post_content_class')) {
    function fana_tbay_post_content_class($class)
    {
        $page = 'archive';
        if (is_singular('post')) {
            $page = 'single';

            if (!isset($_GET['blog_'.$page.'_layout'])) {
                $class .= ' '.fana_tbay_get_config('blog_'.$page.'_layout');
            } else {
                $class .= ' '.$_GET['blog_'.$page.'_layout'];
            }
        } else {
            if (!isset($_GET['blog_'.$page.'_layout'])) {
                $class .= ' '.fana_tbay_get_config('blog_'.$page.'_layout');
            } else {
                $class .= ' '.$_GET['blog_'.$page.'_layout'];
            }
        }
        return $class;
    }
}
add_filter('fana_tbay_post_content_class', 'fana_tbay_post_content_class');


if (!function_exists('fana_tbay_get_page_layout_configs')) {
    function fana_tbay_get_page_layout_configs()
    {
        global $post;
        if (isset($post->ID)) {
            $left = get_post_meta($post->ID, 'tbay_page_left_sidebar', true);
            $right = get_post_meta($post->ID, 'tbay_page_right_sidebar', true);

            switch (get_post_meta($post->ID, 'tbay_page_layout', true)) {
                case 'left-main':
                    $configs['sidebar'] = array( 'id' => $left, 'class' => 'col-12 col-lg-3'  );
                    $configs['main'] 	= array( 'class' => 'col-12 col-lg-9' );
                    break;
                case 'main-right':
                    $configs['sidebar'] = array( 'id' => $right,  'class' => 'col-12 col-lg-3' );
                    $configs['main'] 	= array( 'class' => 'col-12 col-lg-9' );
                    break;
                case 'main':
                    $configs['main'] = array( 'class' => 'col-12' );
                    break;
                default:
                    $configs['main'] = array( 'class' => 'col-12' );
                    break;
            }

            return $configs;
        }
    }
}

if (! function_exists('fana_tbay_get_first_url_from_string')) {
    function fana_tbay_get_first_url_from_string($string)
    {
        $pattern = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
        preg_match($pattern, $string, $link);

        return (! empty($link[0])) ? $link[0] : false;
    }
}

/*Check in home page*/
if (!function_exists('fana_tbay_is_home_page')) {
    function fana_tbay_is_home_page()
    {
        $is_home = false;

        if (is_home() || is_front_page() || is_page('home-1') || is_page('home-2') || is_page('home-3') || is_page('home-4') || is_page('home-5') || is_page('home-6') || is_page('home-7')) {
            $is_home = true;
        }

        return $is_home;
    }
}

if (!function_exists('fana_tbay_get_link_attributes')) {
    function fana_tbay_get_link_attributes($string)
    {
        preg_match('/<a href="(.*?)">/i', $string, $atts);

        return (! empty($atts[1])) ? $atts[1] : '';
    }
}

if (!function_exists('fana_tbay_post_media')) {
    function fana_tbay_post_media($content)
    {
        $is_video = (get_post_format() == 'video') ? true : false;
        $media = fana_tbay_get_first_url_from_string($content);
        if (! empty($media)) {
            global $wp_embed;
            $content = do_shortcode($wp_embed->run_shortcode('[embed]' . $media . '[/embed]'));
        } else {
            $pattern = fana_tbay_get_shortcode_regex(fana_tbay_tagregexp());
            preg_match('/' . $pattern . '/s', $content, $media);
            if (! empty($media[2])) {
                if ($media[2] == 'embed') {
                    global $wp_embed;
                    $content = do_shortcode($wp_embed->run_shortcode($media[0]));
                } else {
                    $content = do_shortcode($media[0]);
                }
            }
        }
        if (! empty($media)) {
            $output = '<div class="entry-media">';
            $output .= ($is_video) ? '<div class="pro-fluid"><div class="pro-fluid-inner">' : '';
            $output .= $content;
            $output .= ($is_video) ? '</div></div>' : '';
            $output .= '</div>';

            return $output;
        }

        return false;
    }
}

if (!function_exists('fana_tbay_post_gallery')) {
    function fana_tbay_post_gallery($content)
    {
        $pattern = fana_tbay_get_shortcode_regex('gallery');
        preg_match('/' . $pattern . '/s', $content, $media);
        if (! empty($media[2])) {
            return '<div class="entry-gallery">' . do_shortcode($media[0]) . '<hr class="pro-clear" /></div>';
        }

        return false;
    }
}

if (!function_exists('fana_tbay_random_key')) {
    function fana_tbay_random_key($length = 5)
    {
        $cfanacters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $return = '';
        for ($i = 0; $i < $length; $i++) {
            $return .= $cfanacters[rand(0, strlen($cfanacters) - 1)];
        }
        return $return;
    }
}

if (!function_exists('fana_tbay_substring')) {
    function fana_tbay_substring($string, $limit, $afterlimit = '[...]')
    {
        if (empty($string)) {
            return $string;
        }
        $string = explode(' ', strip_tags($string), $limit);

        if (count($string) >= $limit) {
            array_pop($string);
            $string = implode(" ", $string) .' '. $afterlimit;
        } else {
            $string = implode(" ", $string);
        }
        $string = preg_replace('`[[^]]*]`', '', $string);
        return strip_shortcodes($string);
    }
}

if (!function_exists('fana_tbay_subschars')) {
    function fana_tbay_subschars($string, $limit, $afterlimit='...')
    {
        if (strlen($string) > $limit) {
            $string = substr($string, 0, $limit);
        } else {
            $afterlimit = '';
        }
        return $string . $afterlimit;
    }
}


/*Fana get template parts*/
if (!function_exists('fana_tbay_get_page_templates_parts')) {
    function fana_tbay_get_page_templates_parts($slug = 'logo', $name = null)
    {
        return get_template_part('page-templates/parts/'.$slug.'', $name);
    }
}

/*testimonials*/
if (!function_exists('fana_tbay_get_testimonials_layouts')) {
    function fana_tbay_get_testimonials_layouts()
    {
        $testimonials = array();
        $files = glob(get_template_directory() . '/vc_templates/testimonial/testimonial.php');
        if (!empty($files)) {
            foreach ($files as $file) {
                $testi = str_replace("testimonial", '', str_replace('.php', '', basename($file)));
                $testimonials[$testi] = $testi;
            }
        }

        return $testimonials;
    }
}

/*Blog*/
if (!function_exists('fana_tbay_get_blog_layouts')) {
    function fana_tbay_get_blog_layouts()
    {
        $blogs = array(
            esc_html__('Grid', 'fana') => 'grid',
            esc_html__('Vertical', 'fana') => 'vertical',
        );
        $files = glob(get_template_directory() . '/vc_templates/post/carousel/_single_*.php');
        if (!empty($files)) {
            foreach ($files as $file) {
                $str = str_replace("_single_", '', str_replace('.php', '', basename($file)));
                $blogs[$str] = $str;
            }
        }

        return $blogs;
    }
}

// Number of blog per row
if (!function_exists('fana_tbay_blog_loop_columns')) {
    function fana_tbay_blog_loop_columns($number)
    {
        $sidebar_configs = fana_tbay_get_blog_layout_configs();

        $columns 	= fana_tbay_get_config('blog_columns');

        if (isset($_GET['blog_columns']) && is_numeric($_GET['blog_columns'])) {
            $value = $_GET['blog_columns'];
        } elseif (empty($columns) && isset($sidebar_configs['columns'])) {
            $value = 	$sidebar_configs['columns'];
        } else {
            $value = $columns;
        }

        if (in_array($value, array(1, 2, 3, 4, 5, 6))) {
            $number = $value;
        }
        return $number;
    }
}
add_filter('loop_blog_columns', 'fana_tbay_blog_loop_columns');

/*Check style blog image full*/
if (!function_exists('fana_tbay_blog_image_sizes_full')) {
    function fana_tbay_blog_image_sizes_full()
    {
        $style = false;
        $sidebar_configs = fana_tbay_get_blog_layout_configs();

        if (!is_singular('post')) {
            if (isset($sidebar_configs['image_sizes']) && $sidebar_configs['image_sizes'] == 'full') :
                   $style = true;
            endif;
        }

        return  $style;
    }
}


// Number of post per page
if (!function_exists('fana_tbay_loop_post_per_page')) {
    function fana_tbay_loop_post_per_page($number)
    {
        if (isset($_GET['posts_per_page']) && is_numeric($_GET['posts_per_page'])) {
            $value = $_GET['posts_per_page'];
        } else {
            $value = get_option('posts_per_page');
        }

        if (is_numeric($value) && $value) {
            $number = absint($value);
        }
        
        return $number;
    }
    add_filter('loop_post_per_page', 'fana_tbay_loop_post_per_page');
}

if (!function_exists('fana_tbay_posts_per_page')) {
    function fana_tbay_posts_per_page($wp_query)
    {
        if (is_admin() || ! $wp_query->is_main_query()) {
            return;
        }

        $value = apply_filters('loop_post_per_page', 6);

        if (isset($value) && is_category()) {
            $wp_query->query_vars['posts_per_page'] = $value;
        }
        return $wp_query;
    }
    add_action('pre_get_posts', 'fana_tbay_posts_per_page');
}

/*Post Views*/
if (!function_exists('fana_set_post_views')) {
    function fana_set_post_views($postID)
    {
        $count_key = 'fana_post_views_count';
        $count 		 = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            $count = 1;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '1');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}

if (!function_exists('fana_track_post_views')) {
    function fana_track_post_views($post_id)
    {
        if (!is_single()) {
            return;
        }
        if (empty($post_id)) {
            global $post;
            $post_id = $post->ID;
        }
        fana_set_post_views($post_id);
    }
    add_action('wp_head', 'fana_track_post_views');
}

if (!function_exists('fana_get_post_views')) {
    function fana_get_post_views($postID, $text = '')
    {
        $count_key = 'fana_post_views_count';
        $count = get_post_meta($postID, $count_key, true);

        if ($count == '') {
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0";
        }
        return $count.$text;
    }
}

/*Get Preloader*/
if (! function_exists('fana_get_select_preloader')) {
    add_action('wp_body_open', 'fana_get_select_preloader', 10);
    function fana_get_select_preloader()
    {
        $enable_preload = fana_tbay_get_global_config('preload', false);

        if (!$enable_preload) {
            return;
        }

        $preloader 	= fana_tbay_get_global_config('select_preloader', 'loader1');
        $media 		= fana_tbay_get_global_config('media-preloader');
        
        if (isset($preloader)) {
            switch ($preloader) {
                case 'loader1':
                    ?>
<div class="item-loader">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<?php
                    break;

                case 'loader2':
                    ?>
<div class="item-loader">
    <div class="tbay-loader tbay-loader-two">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<?php
                    break;
                case 'loader3':
                    ?>
<div class="item-loader">
    <div class="tbay-loader tbay-loader-three">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<?php
                    break;
                case 'loader4':
                    ?>
<div class="item-loader">
    <div class="tbay-loader tbay-loader-four"> <span class="spinner-cube spinner-cube1"></span> <span
            class="spinner-cube spinner-cube2"></span> <span class="spinner-cube spinner-cube3"></span> <span
            class="spinner-cube spinner-cube4"></span> <span class="spinner-cube spinner-cube5"></span> <span
            class="spinner-cube spinner-cube6"></span> <span class="spinner-cube spinner-cube7"></span> <span
            class="spinner-cube spinner-cube8"></span> <span class="spinner-cube spinner-cube9"></span> </div>
</div>
<?php
                    break;
                case 'loader5':
                    ?>
<div class="item-loader">
    <div class="tbay-loader tbay-loader-five"> <span class="spinner-cube-1 spinner-cube"></span> <span
            class="spinner-cube-2 spinner-cube"></span> <span class="spinner-cube-4 spinner-cube"></span> <span
            class="spinner-cube-3 spinner-cube"></span> </div>
</div>
<?php
                    break;
                case 'loader6':
                    ?>
<div class="item-loader">
    <div class="tbay-loader tbay-loader-six"> <span class=" spinner-cube-1 spinner-cube"></span> <span
            class=" spinner-cube-2 spinner-cube"></span> </div>
</div>
<?php
                    break;

                case 'custom_image':
                    ?>
<div class="item-loader loader-img">
    <?php if (isset($media['url']) && !empty($media['url'])): ?>
    <img alt="<?php echo (!empty($media['alt'])) ? esc_attr($media['alt']) : ''; ?>"
        src="<?php echo esc_url($media['url']); ?>">
    <?php endif; ?>
</div>
<?php
                    break;
                    
                default:
                    ?>
<div class="item-loader">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<?php
                    break;
            }
        }
    }
}

if (!function_exists('fana_gallery_atts')) {
    add_filter('shortcode_atts_gallery', 'fana_gallery_atts', 10, 3);
    
    /* Change attributes of wp gallery to modify image sizes for your needs */
    function fana_gallery_atts($output, $pairs, $atts)
    {
        if (isset($atts['columns']) && $atts['columns'] == 1) {
            //if gallery has one column, use large size
            $output['size'] = 'full';
        } elseif (isset($atts['columns']) && $atts['columns'] >= 2 && $atts['columns'] <= 4) {
            //if gallery has between two and four columns, use medium size
            $output['size'] = 'full';
        } else {
            //if gallery has more than four columns, use thumbnail size
            $output['size'] = 'full';
        }
    
        return $output;
    }
}

if (!function_exists('fana_get_custom_menu')) {

    
    /* Change attributes of wp gallery to modify image sizes for your needs */
    function fana_get_custom_menu($menu_id)
    {
        $_id = fana_tbay_random_key();

        $args = array(
            'menu'              => $menu_id,
            'container_class'   => 'nav',
            'menu_class'        => 'menu',
            'fallback_cb'       => '',
            'before'            => '',
            'after'             => '',
            'echo'              => true,
            'menu_id'           => 'menu-'.$menu_id.'-'.$_id
        );

        $output = wp_nav_menu($args);

    
        return $output;
    }
}

/*Set excerpt show enable default*/
if (! function_exists('fana_tbay_edit_post_show_excerpt')) {
    function fana_tbay_edit_post_show_excerpt()
    {
        $user = wp_get_current_user();
        $unchecked = get_user_meta($user->ID, 'metaboxhidden_post', true);
        if (is_array($unchecked)) {
            $key = array_search('postexcerpt', $unchecked);
            if (false !== $key) {
                array_splice($unchecked, $key, 1);
                update_user_meta($user->ID, 'metaboxhidden_post', $unchecked);
            }
        }
    }
    add_action('admin_init', 'fana_tbay_edit_post_show_excerpt', 10);
}

if (! function_exists('fana_texttrim')) {
    function fana_texttrim($str)
    {
        return trim(preg_replace("/('|\"|\r?\n)/", '', $str));
    }
}

/*Get query*/
if (!function_exists('fana_tbay_get_boolean_query_var')) {
    function fana_tbay_get_boolean_query_var($config)
    {
        $active = fana_tbay_get_config($config, true);

        $active = (isset($_GET[$config])) ? $_GET[$config] : $active;

        return (boolean)$active;
    }
}

if (!function_exists('fana_tbay_archive_blog_size_image')) {
    function fana_tbay_archive_blog_size_image()
    {
        $blog_size = fana_tbay_get_config('blog_image_sizes', 'medium');

        $blog_size = (isset($_GET['blog_image_sizes'])) ? $_GET['blog_image_sizes'] : $blog_size;

        return $blog_size;
    }
}
add_filter('fana_archive_blog_size_image', 'fana_tbay_archive_blog_size_image');


if (!function_exists('fana_tbay_archive_layout_blog')) {
    function fana_tbay_archive_layout_blog()
    {
        $layout_blog = fana_tbay_get_config('layout_blog', 'post-style-1');

        $layout_blog = (isset($_GET['layout_blog'])) ? $_GET['layout_blog'] : $layout_blog;

        return $layout_blog;
    }
}
add_filter('fana_archive_layout_blog', 'fana_tbay_archive_layout_blog');

if (!function_exists('fana_tbay_categories_blog_type')) {
    function fana_tbay_categories_blog_type()
    {
        $type = fana_tbay_get_config('categories_type', 'type-1');

        $type = (isset($_GET['categories_type'])) ? $_GET['categories_type'] : $type;

        return $type;
    }
}


// cart Postion
if (!function_exists('fana_tbay_header_mobile_position')) {
    function fana_tbay_header_mobile_position()
    {
        $position = fana_tbay_get_config('header_mobile', 'v1');

        $position = (isset($_GET['header_mobile'])) ? $_GET['header_mobile'] : $position;

        return $position;
    }
    add_filter('fana_header_mobile_position', 'fana_tbay_header_mobile_position');
}

if (!function_exists('fana_tbay_offcanvas_smart_menu')) {
    function fana_tbay_offcanvas_smart_menu()
    {
        fana_tbay_get_page_templates_parts('device/offcanvas-smartmenu');
    }
    add_action('fana_before_theme_header', 'fana_tbay_offcanvas_smart_menu', 10);
}

if (!function_exists('fana_tbay_the_topbar_mobile')) {
    function fana_tbay_the_topbar_mobile()
    {
        if (!fana_tbay_get_config('mobile_header', true)) {
            return;
        }

        $position = apply_filters('fana_header_mobile_position', 10, 2);

        fana_tbay_get_page_templates_parts('device/topbar-mobile', $position);
    }
    add_action('fana_before_theme_header', 'fana_tbay_the_topbar_mobile', 20);
}

if (!function_exists('fana_tbay_footer_mobile')) {
    function fana_tbay_footer_mobile()
    {
        if (fana_active_mobile_footer_icon()) {
            fana_tbay_get_page_templates_parts('device/footer-mobile');
        }
    }
    add_action('fana_before_theme_header', 'fana_tbay_footer_mobile', 40);
}

if ( ! function_exists( 'fana_product_ajax_search_sku' ) ) {
	function fana_product_ajax_search_sku( $where ) {
        if ( !fana_redux_framework_activated() ) return $where;

		if ( ! empty( $_REQUEST['query'] ) ) {
			$s = sanitize_text_field( $_REQUEST['query'] );

            return fana_sku_search_query( $where, $s );
		}

		return $where;
	}
}

if (!function_exists('fana_tbay_autocomplete_suggestions')) {
    add_action('wp_ajax_fana_autocomplete_search', 'fana_tbay_autocomplete_suggestions');
    add_action('wp_ajax_nopriv_fana_autocomplete_search', 'fana_tbay_autocomplete_suggestions');
    function fana_tbay_autocomplete_suggestions()
    {
        check_ajax_referer( 'fana-search-nonce', 'security' );

        $args = array(
            'post_status'         => 'publish',
            'orderby'         	  => 'relevance',
            'posts_per_page'      => -1,
            'ignore_sticky_posts' => 1,
            'suppress_filters'    => false,
        );

        if (! empty($_REQUEST['query'])) {
            $search_keyword = $_REQUEST['query'];
            $args['s'] = sanitize_text_field($search_keyword);
        }


        if (! empty($_REQUEST['post_type'])) {
            $post_type = strip_tags($_REQUEST['post_type']);
        }

        if ( class_exists('WooCommerce') && isset($_REQUEST['post_type']) && $_REQUEST['post_type'] === 'product' ) {
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['tax_query'] 	= WC()->query->get_tax_query();

            if ( apply_filters( 'fana_search_query_in', fana_tbay_get_config('search_query_in', 'title') === 'all' ) ) {
                add_filter( 'posts_search', 'fana_product_ajax_search_sku', 9 );
            } else {
                add_filter('posts_search', 'fana_product_search_title', 20, 2);
            }
        }

        if (! empty($_REQUEST['number'])) {
            $number 	= (int) $_REQUEST['number'];
        }

        if (isset($_REQUEST['post_type']) && $_REQUEST['post_type'] != 'all') {
            $args['post_type'] = $_REQUEST['post_type'];
        }


        if ( $post_type == 'product' && fana_woocommerce_activated() ) {
            
            $product_visibility_term_ids = wc_get_product_visibility_term_ids();
            $args['tax_query']['relation'] = 'AND';

            $args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'term_taxonomy_id',
                'terms'    => $product_visibility_term_ids['exclude-from-search'],
                'operator' => 'NOT IN',
            ); 
            
            if ( ! empty( $_REQUEST['product_cat'] ) ) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => strip_tags( $_REQUEST['product_cat'] ),
                );
            }
        }


        $results = new WP_Query($args);

        $suggestions = array();

        $count = $results->post_count;

        $view_all = (($count - $number) > 0) ? true : false;
        $index = 0;
        if ($results->have_posts()) {
            if ($post_type == 'product') {
                $factory = new WC_Product_Factory();
            }


            while ($results->have_posts()) {
                if ($index == $number) {
                    break;
                }

                $results->the_post();

                if ($count == 1) {
                    $result_text = esc_html__('result found with', 'fana');
                } else {
                    $result_text = esc_html__('results found with', 'fana');
                }

                if ($post_type == 'product') {
                    $product = $factory->get_product(get_the_ID());
                    $_subtitle = ( !empty(get_post_meta( get_the_ID(), '_subtitle', true )) ) ? get_post_meta( get_the_ID(), '_subtitle', true ) : '';
                    $suggestions[] = array(
                        'value' => get_the_title(),
                        'subtitle' => $_subtitle,
                        'sku' => ( fana_tbay_get_config('search_query_in', 'title') === 'all' && fana_tbay_get_config('search_sku_ajax', false) && $product->get_sku() ) ? esc_html__( 'SKU:', 'fana' ) . ' ' . $product->get_sku() : '',
                        'link' => get_the_permalink(),
                        'price' => $product->get_price_html(),
                        'image' => $product->get_image(),
                        'result' => '<span class="count">'.$count.' </span> '. $result_text .' <span class="keywork">"'. esc_html($search_keyword).'"</span>',
                        'view_all' => $view_all,
                    );


                } else {
                    $suggestions[] = array(
                        'value' => get_the_title(),
                        'link' => get_the_permalink(),
                        'image' => get_the_post_thumbnail( get_the_ID(), 'medium', ''),
                        'result' => '<span class="count">'.$count.' </span> '. $result_text .' <span class="keywork">"'. esc_html($search_keyword).'"</span>',
                        'view_all' => $view_all,
                    );
                }


                $index++;
            }

            wp_reset_postdata();
        } else {
            $suggestions[] = array(
                'value' => ($post_type == 'product') ? esc_html__('No products found.', 'fana') : esc_html__('No posts...', 'fana'),
                'no_found' => true,
                'link' => '',
                'view_all' => $view_all,
            );
        }

        echo json_encode(array(
            'suggestions' => $suggestions
        ));

        die();
    }
}

if (!function_exists('fana_add_cssclass')) {
    function fana_add_cssclass($add, $class)
    {
        $class = empty($class) ? $add : $class .= ' ' . $add;
        return $class;
    }
}

/*Fix woocomce don't active*/
if (!function_exists('fana_tbay_get_variation_swatchs')) {
    function fana_tbay_get_variation_swatchs()
    {
        $swatchs = array( '' => esc_html__('None', 'fana'));

        if ( !fana_woocommerce_activated() ) {
            return $swatchs;
        }

        // Array of defined attribute taxonomies.
        $attribute_taxonomies = wc_get_attribute_taxonomies();

        if (! empty($attribute_taxonomies)) {
            foreach ($attribute_taxonomies as $key => $tax) {
                $attribute_taxonomy_name = wc_attribute_taxonomy_name($tax->attribute_name);
                $label                   = $tax->attribute_label ? $tax->attribute_label : $tax->attribute_name;

                $swatchs[$attribute_taxonomy_name] = $label;
            }
        }

        return $swatchs;
    }
}

if (!function_exists('fana_tbay_get_custom_tab_layouts')) {
    function fana_tbay_get_custom_tab_layouts()
    {
        $tabs = array( '' => 'None');

        if (!fana_woocommerce_activated()) {
            return $tabs;
        }
        $args = array(
      'posts_per_page'   => -1,
      'offset'           => 0,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post_type'        => 'tbay_customtab',
      'post_status'      => 'publish',
      'suppress_filters' => true,
    );
        $posts = get_posts($args);
        foreach ($posts as $post) {
            $tabs[$post->post_name] = $post->post_title;
        }
        return $tabs;
    }
}

/*Get title mobile in top bar mobile*/
if (! function_exists('fana_tbay_get_title_mobile')) {
    function fana_tbay_get_title_mobile($title)
    {
        $delimiter = ' / ';

        if (is_search()) {
            $title = esc_html__('Search results for', 'fana') . ' "' . get_search_query() . '"';
        } elseif (is_tag()) {
            $title = esc_html__('Posts tagged "', 'fana'). single_tag_title('', false) . '"';
        } elseif (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_archive()) {
            $title = get_the_archive_title();
        } elseif (is_404()) {
            $title = esc_html__('Error 404', 'fana');
        } elseif (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) {
                echo(get_category_parents($parentCat, true, ' ' . $delimiter . ' '));
            }
            $title = single_cat_title('', false);
        } elseif (is_day()) {
            $title = get_the_time('d');
        } elseif (is_month()) {
            $title = get_the_time('F');
        } elseif (is_year()) {
            $title = get_the_time('Y');
        } elseif (is_single()  && !is_attachment()) {
            $title = get_the_title();
        } else {
            $title = get_the_title();
        }

        return $title;
    }
    add_filter('fana_get_filter_title_mobile', 'fana_tbay_get_title_mobile');
}


if (! function_exists('fana_tbay_get_cookie')) {
    function fana_tbay_get_cookie($name = '')
    {
        $check = (isset($_COOKIE[$name]) && !empty($_COOKIE[$name])) ? (boolean)$_COOKIE[$name] : false;
        return $check;
    }
}

if (! function_exists('fana_tbay_active_newsletter_sidebar')) {
    function fana_tbay_active_newsletter_sidebar()
    {
        $active = false;

        $cookie = fana_tbay_get_cookie('hiddenmodal');

        if (!$cookie && is_active_sidebar('newsletter-popup')) {
            $active = true;
        }

        return $active;
    }
}

if (! function_exists('fana_yith_compare_header')) {
    function fana_yith_compare_header()
    {
        if (class_exists('YITH_Woocompare')) { ?>
<?php
                global $yith_woocompare;
            ?>
<div class="yith-compare-header product">
    <a href="<?php echo esc_url($yith_woocompare->obj->view_table_url()); ?>" class="compare added">
        <i class="tb-icon tb-icon-sync"></i>
        <?php apply_filters('fana_get_text_compare', ''); ?>
    </a>
</div>
<?php }
    }
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
if (! function_exists('fana_pingback_header')) {
    function fana_pingback_header()
    {
        if (is_singular() && pings_open()) {
            echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
        }
    }
    add_action('wp_head', 'fana_pingback_header', 30);
}


if (! function_exists('fana_tbay_check_data_responsive')) {
    function fana_tbay_check_data_responsive($columns,$desktop, $desktopsmall, $tablet, $landscape_mobile, $mobile)
    {
        $data_array = array();

        $data_array['desktop']          =      isset($desktop) ? $desktop : $columns;
        $data_array['desktopsmall']     =      isset($desktopsmall) ? $desktopsmall : 3;
        $data_array['tablet']           =      isset($tablet) ? $tablet : 3;
        $data_array['landscape']        =      isset($landscape_mobile) ? $landscape_mobile : 3;
        $data_array['mobile']           =      isset($mobile) ? $mobile : 2;

        return $data_array;
    }
}

if (! function_exists('fana_tbay_check_data_responsive_carousel')) {
    function fana_tbay_check_data_responsive_carousel($columns, $desktop, $desktopsmall, $tablet, $landscape_mobile, $mobile)
    {
        $data_responsive = fana_tbay_check_data_responsive($columns,$desktop, $desktopsmall, $tablet, $landscape_mobile, $mobile);

        $datas = " data-items=\"". $columns ."\"";
        $datas .= " data-desktopslick=\"". $data_responsive['desktop'] ."\"";
        $datas .= " data-desktopsmallslick=\"". $data_responsive['desktopsmall'] ."\"";
        $datas .= " data-tabletslick=\"". $data_responsive['tablet'] ."\"";
        $datas .= " data-landscapeslick=\"". $data_responsive['landscape'] ."\"";
        $datas .= " data-mobileslick=\"". $data_responsive['mobile'] ."\"";

        return $datas;
    }
}


if (! function_exists('fana_tbay_check_data_responsive_grid')) {
    function fana_tbay_check_data_responsive_grid($columns, $desktop, $desktopsmall, $tablet, $landscape_mobile, $mobile)
    {
        $data_responsive = fana_tbay_check_data_responsive($columns, $desktop, $desktopsmall, $tablet, $landscape_mobile, $mobile);

        $datas  = "";
        $datas .= " data-xlgdesktop=\"" . esc_attr($columns) ."\"";
        $datas .= " data-desktop=\"" . esc_attr($data_responsive['desktop']) ."\"";
        $datas .= " data-desktopsmall=\"" . esc_attr($data_responsive['desktopsmall']) ."\"";
        $datas .= " data-tablet=\"" . esc_attr($data_responsive['tablet']) ."\"";
        $datas .= " data-landscape=\"" . esc_attr($data_responsive['landscape']) ."\"";
        $datas .= " data-mobile=\"" . esc_attr($data_responsive['mobile']) ."\"";

        return $datas;
    }
}

if (! function_exists('fana_tbay_check_data_carousel')) {
    function fana_tbay_check_data_carousel($rows, $nav_type, $pagi_type, $loop_type, $auto_type, $autospeed_type, $disable_mobile)
    {
        $data_array = array();

        $data_array['rows']				= isset($rows) ? $rows : 1;
        $data_array['nav'] 				= ($nav_type == 'yes') ? true : false;
        $data_array['pagination'] 		= ($pagi_type == 'yes') ? true : false;
        $data_array['loop'] 			= ($loop_type == 'yes') ? true : false;
        $data_array['auto'] 			= ($auto_type == 'yes') ? true : false;
        $data_array['autospeed'] 		= (!empty($autospeed_type)) ? $autospeed_type : 500;
        $data_array['disable_mobile'] 	= ($disable_mobile == 'yes') ? true : false;

        return $data_array;
    }
}

if (! function_exists('fana_tbay_data_carousel')) {
    function fana_tbay_data_carousel($rows, $nav_type, $pagi_type, $loop_type, $auto_type, $autospeed_type, $disable_mobile)
    {
        $data_array = fana_tbay_check_data_carousel($rows, $nav_type, $pagi_type, $loop_type, $auto_type, $autospeed_type, $disable_mobile);

        $datas  = " data-carousel=\"owl\"";
        $datas .= " data-rows=\"" . esc_attr($data_array['rows']) ."\"";
        $datas .= " data-nav=\"" . esc_attr($data_array['nav']) ."\"";
        $datas .= " data-pagination=\"" . esc_attr($data_array['pagination']) ."\"";
        $datas .= " data-loop=\"" . esc_attr($data_array['loop']) ."\"";
        $datas .= " data-auto=\"" . esc_attr($data_array['auto']) ."\"";

        if ($data_array['auto'] == 'yes') {
            $datas .= " data-autospeed=\"" . esc_attr($data_array['autospeed']) ."\"";
        }

        $datas .= " data-unslick=\"" . esc_attr($data_array['disable_mobile']) ."\"";

        return $datas;
    }
}

if (!function_exists('fana_get_template_product')) {
    function fana_get_template_product()
    {
        $output = array(
			'inner' => esc_html__('Inner' ,'fana'), 
			'vertical' => esc_html__('Vertical' ,'fana'), 
		);

        return $output;
    }
    add_filter('fana_get_template_product', 'fana_get_template_product', 10, 1);
}

if (!function_exists('fana_redux_framework_activated')) {
    function fana_redux_framework_activated()
    {
        return class_exists('Redux_Framework_Plugin');
    }
}

if (!function_exists('fana_wpthembay_core_activated')) {
    function fana_wpthembay_core_activated()
    {
        return class_exists('WPthembayClass');
    }
}

if (!function_exists('fana_elementor_activated')) {
    function fana_elementor_activated()
    {
        return function_exists('elementor_load_plugin_textdomain');
    }
}


if (!function_exists('fana_nextend_social_login_activated')) {
    function fana_nextend_social_login_activated()
    {
        return class_exists('NextendSocialLogin');
    }
}

if (!function_exists('fana_elementor_pro_activated')) {
    function fana_elementor_pro_activated()
    {
        return function_exists('elementor_pro_load_plugin');
    }
}

if (!function_exists('fana_wpml_is_activated')) {
    function fana_wpml_is_activated() {
        return class_exists('SitePress');
    }
}

if (! function_exists('fana_elementor_is_edit_mode')) {
    function fana_elementor_is_edit_mode()
    {
        return Elementor\Plugin::$instance->editor->is_edit_mode();
    }
}

if (! function_exists('fana_elementor_preview_page')) {
    function fana_elementor_preview_page()
    {
        return isset($_GET['preview_id']);
    }
}

if (! function_exists('fana_elementor_preview_mode')) {
    function fana_elementor_preview_mode()
    {
        return Elementor\Plugin::$instance->preview->is_preview_mode();
    }
}

if (!function_exists('fana_woocommerce_activated')) {
    function fana_woocommerce_activated()
    {
        return class_exists('WooCommerce');
    }
}

if (!function_exists('fana_is_woo_variation_swatches_pro')) {
    function fana_is_woo_variation_swatches_pro()
    {
        return class_exists('Woo_Variation_Swatches_Pro') ? true : false;
    }
}

if (!function_exists('fana_is_ajax_popup_quick')) {
    function fana_is_ajax_popup_quick()
    {
        $active = true;

        if (fana_is_woo_variation_swatches_pro()) {
            $active = false;
        }

        return $active;
    }
}

if (!function_exists('fana_is_meta_box')) {
    function fana_is_meta_box() {
        return class_exists( 'RWMB_Loader' ) ? true : false;
    }
}

if (!function_exists('fana_switcher_to_boolean')) {
    function fana_switcher_to_boolean($var)
    {
        if ($var === 'yes') {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('fana_sidebars_array')) {
    function fana_sidebars_array()
    {
        global $wp_registered_sidebars;
        $sidebars = array();

        
        if ( !empty($wp_registered_sidebars) ) {
            foreach ($wp_registered_sidebars as $sidebar) {
                $sidebars[$sidebar['id']] = $sidebar['name'];
            }
        }

        return $sidebars;
    }
}

/**
 * Dont Update the Theme
 *
 * If there is a theme in the repo with the same name, this prevents WP from prompting an update.
 *
 * @since  1.0.0
 * @param  array $r Existing request arguments
 * @param  string $url Request URL
 * @return array Amended request arguments
 */
if (!function_exists('fana_dont_update_theme')) {
    function fana_dont_update_theme($r, $url)
    {
        if (0 !== strpos($url, 'https://api.wordpress.org/themes/update-check/1.1/')) {
            return $r;
        } // Not a theme update request. Bail immediately.
        $themes = json_decode($r['body']['themes']);
        $child = get_option('stylesheet');
        unset($themes->themes->$child);
        $r['body']['themes'] = json_encode($themes);
        return $r;
    }
    add_filter('http_request_args', 'fana_dont_update_theme', 5, 2);
}

if (!function_exists('fana_elements_ready_slick')) {
    function fana_elements_ready_slick()
    {
        $array = [
            'brands',
            'custom-gallery', 
            'products',
            'posts-grid',
            'our-team',
            'product-category',
            'product-tabs',
            'testimonials',
            'product-categories-tabs',
            'list-categories-product',
            'custom-image-list-categories',
            'custom-image-list-tags',
            'product-recently-viewed',
            'product-flash-sales',
            'product-list-tags',
            'product-count-down'
        ];
     
        return $array;
    }
}

if (!function_exists('fana_elements_ready_products')) {
    function fana_elements_ready_products()
    {
        $array = [
            'products',
            'single-product-home',
            'product-category',
            'product-tabs',
            'product-categories-tabs',
        ];
     
        return $array;
    }
}

if (!function_exists('fana_elements_ajax_tabs')) {
    function fana_elements_ajax_tabs()
    {
        $array = [ 
            'product-categories-tabs',  
            'product-tabs',
        ];
     
        return $array;
    }
}


if (!function_exists('fana_tbay_footer_class')) {
    function fana_tbay_footer_class()
    {
        $classes = ['tbay-footer', apply_filters('fana_tbay_get_footer_layout', 'footer_default')];
        
        echo 'class="'. join(' ', apply_filters('fana_tbay_footer_class', $classes)) .'"';
    }
}

if (!function_exists('fana_elements_ready_countdown_timer')) {
    function fana_elements_ready_countdown_timer()
    {
        $array = [
            'product-flash-sales',
            'product-count-down'
        ];

        return $array;
    }
}

if (!function_exists('fana_elements_ready_nav_menu')) {
    function fana_elements_ready_nav_menu()
    {
        $array = [
            'nav-menu',
        ];

        return $array;
    }
}

if (!function_exists('fana_elements_ready_autocomplete')) {
    function fana_elements_ready_autocomplete()
    {
        $array = [
            'search-form',
            'search-canvas',
        ];

        return $array;
    }
}

if (!function_exists('fana_elements_ready_customfonts')) {
    function fana_elements_ready_customfonts()
    {
        $array = [
            'list-custom-fonts',
        ];

        return $array;
    }
}
 

if (!function_exists('fana_localize_translate')) {
    function fana_localize_translate()
    {
        $fana_hash_transient = get_transient( 'fana-hash-time' );
		if ( false === $fana_hash_transient ) {
			$fana_hash_transient = time();
			set_transient( 'fana-hash-time', $fana_hash_transient );
		}

        global $wp_query;
            
        $config = array( 
            'storage_key'  		=> apply_filters( 'fana_storage_key', 'fana_' . md5( get_current_blog_id() . '_' . get_home_url( get_current_blog_id(), '/' ) . get_template() . $fana_hash_transient ) ),
            'quantity_minus'    => apply_filters('fana_quantity_minus', '<i class="tb-icon tb-icon-minus"></i>'),
            'quantity_plus'     => apply_filters('fana_quantity_plus', '<i class="tb-icon tb-icon-plus"></i>'),
            'ajaxurl'			=> admin_url('admin-ajax.php'),
            'cancel'            => esc_html__('cancel', 'fana'),  
            'close'             => apply_filters('fana_quantity_plus', '<i class="tb-icon tb-icon-close-01"></i>'),
            'show_all_text'     => esc_html__('View all', 'fana'),
            'search'            => esc_html__('Search', 'fana'),
            'wp_searchnonce' 	=> wp_create_nonce('fana-search-nonce'),
            'wp_megamenunonce' 	=> wp_create_nonce('fana-megamenu-nonce'),
            'wp_menuclicknonce' => wp_create_nonce('fana-menuclick-nonce'),
            'wp_templateclicknonce' => wp_create_nonce('fana-templateclick-nonce'),
            'posts'             => json_encode($wp_query->query_vars),
            'mobile'            => wp_is_mobile(),
            'slick_prev'        => apply_filters('fana_slick_prev', '<i class="tb-icon tb-icon-angle-left"></i>'), 
            'slick_next'        => apply_filters('fana_slick_next', '<i class="tb-icon tb-icon-angle-right"></i>'), 
            /*Element ready default callback*/
            'elements_ready'  => array(
                'slick'               => fana_elements_ready_slick(),
                'products'            => fana_elements_ready_products(),
                'ajax_tabs'           => fana_elements_ajax_tabs(), 
                'countdowntimer'      => fana_elements_ready_countdown_timer(),
                'navmenu'        	  => fana_elements_ready_nav_menu(),
                'autocomplete'        => fana_elements_ready_autocomplete(),
                'customfonts'         => fana_elements_ready_customfonts(),
            )
        );

        if( fana_elementor_activated() ) {
            $config['combined_css']         = fana_get_elementor_css_print_method();
        }

        if (fana_woocommerce_activated()) {
            $position                       = (wp_is_mobile()) ? 'right' : apply_filters('fana_cart_position', 10, 2);
            $woo_mode                       = fana_tbay_woocommerce_get_display_mode();
            $quantity_mode                  = fana_woocommerce_quantity_mode_active();
            $loader                         = apply_filters('fana_quick_view_loader_gif', FANA_IMAGES . '/ajax-loader-alt.svg');

            $config['popup_cart_icon']      = apply_filters('fana_popup_cart_icon', '<i class="tb-icon tb-icon tb-icon-tick-circle"></i>', 2);
            $config['popup_cart_noti']      = esc_html__('was added to shopping cart.', 'fana');
 
            $config['cart_position']        = $position;
            $config['ajax_update_quantity'] = (bool) fana_tbay_get_config('ajax_update_quantity', false);

            $config['display_mode']         = $woo_mode;
            $config['quantity_mode']        = $quantity_mode;
            $config['loader']               = $loader;

            $config['is_checkout']          =  is_checkout();

            $config['mobile_form_cart_style']     =  fana_get_mobile_form_cart_style();
             
            $config['ajax_popup_quick']     =  apply_filters('fana_ajax_popup_quick', fana_is_ajax_popup_quick());

            $config['wc_ajax_url']          =  WC_AJAX::get_endpoint('%%endpoint%%');
            $config['checkout_url']         =  wc_get_checkout_url();
            $config['i18n_checkout']        =  esc_html__('Checkout', 'fana');

            $config['img_class_container']                  =  '.'.fana_get_gallery_item_class();
            $config['thumbnail_gallery_class_element']      =  '.'.fana_get_thumbnail_gallery_item();

            /** Create Nonce **/
            $config['wp_minicartquantitynonce']         = wp_create_nonce('fana-minicartquantity-nonce');
            $config['wp_productremovenonce']            = wp_create_nonce('fana-productremove-nonce');
            $config['wp_productscategoriestabnonce']    = wp_create_nonce('fana-productscategoriestab-nonce');
            $config['wp_productstabnonce']              = wp_create_nonce('fana-productstab-nonce');
            $config['wp_productslistnonce']             = wp_create_nonce('fana-productslist-nonce');
            $config['wp_productsgridnonce']             = wp_create_nonce('fana-productsgrid-nonce');
            $config['wp_singleaddtocartnonce']          = wp_create_nonce('fana-singleaddtocart-nonce');
            $config['wp_popupvariationnamenonce']       = wp_create_nonce('fana-popupvariationname-nonce');
            $config['wp_wishlistcountnonce']            = wp_create_nonce('fana-wishlistcount-nonce');
            $config['wp_quickviewproductnonce']         = wp_create_nonce('fana-quickviewproduct-nonce');

            $config['collapse_details_tab']     = (bool) fana_tbay_get_config('enable_collapse_product_details_tab', false);
            $config['maximum_height_collapse']  = fana_tbay_get_config('maximum_height_collapse', 300);
            $config['show_more']                = esc_html__('Show More', 'fana');
            $config['show_less']                = esc_html__('Show Less ', 'fana');
        }

        return apply_filters('fana_localize_translate', $config);
    }
}


if (! function_exists('fana_instagram_feed_row_class')) {
    function fana_instagram_feed_row_class($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $result = '';
        foreach ($array as $key => $value) {
            if ($key !== 'tb-atts' && $key !== 'user') {
                $result .= ' '.$key.'='."'$value'";
            }
        }

        echo trim($result);
    }
}

if (!function_exists('fana_sb_instagram_get_user_account_data')) {
    function fana_sb_instagram_get_user_account_data()
    {
        $sbi_options = get_option('sb_instagram_settings', array());
        $connected_accounts = $sbi_options['connected_accounts'];

        $users = array();

        if (empty($connected_accounts)) {
            return '';
        }

        foreach ($connected_accounts as $key => $value) {
            array_push($users, $value['username']);
        }

        return implode(",", $users);
    }
}


if (!function_exists('fana_wc_get_custom_tab_options')) {
    function fana_wc_get_custom_tab_options()
    {
        $tabs = array( '' => esc_html__('No Tab', 'fana'));
        $args = array(
            'posts_per_page'   => -1,
            'offset'           => 0,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'tbay_customtab',
            'post_status'      => 'publish',
            'suppress_filters' => true
        );
        $posts = get_posts($args);
        foreach ($posts as $post) {
            $tabs[$post->post_name] = $post->post_title;
        }
        return $tabs;
    }
}

if (!function_exists('fana_register_custom_tab')) {
    function fana_register_custom_tab($types)
    {
        array_push($types, 'customtab');

        return $types;
    }
    add_filter('tbay_elementor_register_post_types', 'fana_register_custom_tab', 10, 1);
}

if (!function_exists('fana_rocket_lazyload_exclude_class')) {
    function fana_rocket_lazyload_exclude_class($attributes)
    {
        $attributes[] = 'class="attachment-yith-woocompare-image size-yith-woocompare-image"';
        $attributes[] = 'class="logo-mobile-img"';

        return $attributes;
    }
    add_filter('rocket_lazyload_excluded_attributes', 'fana_rocket_lazyload_exclude_class');
}

if (! function_exists('fana_is_remove_scripts')) {
    function fana_is_remove_scripts()
    {
        if (function_exists('is_vendor_dashboard') && is_vendor_dashboard() && is_user_logged_in() && (is_user_mvx_vendor(get_current_user_id()) || is_user_mvx_pending_vendor(get_current_user_id()) || is_user_mvx_rejected_vendor(get_current_user_id())) && apply_filters('mvx_vendor_dashboard_exclude_header_footer', true)) {
            return true;
        }

        return false;
    }
}

/**
 * Check is vendor active
 *
 * @return bool
 */
if (! function_exists('fana_woo_is_active_vendor')) {
    function fana_woo_is_active_vendor()
    {
        if (function_exists('dokan_is_store_page')) {
            return true;
        }

        if (class_exists('WCV_Vendors')) {
            return true;
        }

        if (class_exists('MVX')) {
            return true;
        }

        if (function_exists('wcfm_is_store_page')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('fana_catalog_mode_active')) {
    function fana_catalog_mode_active()
    {
        $active = (isset($_GET['catalog_mode'])) ? $_GET['catalog_mode'] : fana_tbay_get_config('enable_woocommerce_catalog_mode', false);

        return $active;
    }
}

if (! function_exists('fana_checkout_optimized')) {
    function fana_checkout_optimized()
    {
        if( !fana_woocommerce_activated() || !is_checkout() ) return false;

        // Check cart has contents.
		if ( WC()->cart->is_empty() && ! is_customize_preview() && apply_filters( 'woocommerce_checkout_redirect_empty_cart', true ) ) {
			return false;
		}
       
        if( fana_tbay_get_config('show_checkout_optimized', false) ) {
            return true; 
        } else {
            return false;
        }
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Logo Checkout
 * ------------------------------------------------------------------------------------------------
 */

if (! function_exists('fana_the_logo_checkout')) {
    function fana_the_logo_checkout()
    {
        if( !fana_checkout_optimized() ) return;

        $ouput = fana_tbay_get_logo_checkout();
        echo trim($ouput);
    }
    add_action('fana_theme_header_checkout', 'fana_the_logo_checkout', 10);
}

if (! function_exists('fana_tbay_get_logo_checkout')) {
    function fana_tbay_get_logo_checkout()
    {
        $logo 			= fana_tbay_get_config('checkout_logo');

        $output 	= '<div class="checkout-logo">';
        if (isset($logo['url']) && !empty($logo['url'])) {
            $url    	= $logo['url'];
            $output 	.= '<a href="'. esc_url(home_url('/')) .'">';

            if (isset($logo['width']) && !empty($logo['width'])) {
                $output 		.= '<img src="'. esc_url($url) .'" width="'. esc_attr($logo['width']) .'" height="'. esc_attr($logo['height']) .'" alt="'. get_bloginfo('name') .'">';
            } else {
                $output 		.= '<img class="logo-checkout-img" src="'. esc_url($url) .'" alt="'. get_bloginfo('name') .'">';
            } 

                
            $output 		.= '</a>';
        } else {
            $output 		.= '<div class="logo-theme">';
            $output 	.= '<a href="'. esc_url(home_url('/')) .'">';
            $output 	.= '<img class="logo-checkout-img" src="'. esc_url_raw(FANA_IMAGES.'/'. fana_tbay_get_theme() .'/logo.svg') .'" alt="'. get_bloginfo('name') .'">';
            $output 	.= '</a>';
            $output 		.= '</div>';
        }
        $output 	.= '</div>';
        
        return apply_filters('fana_tbay_get_logo_checkout', $output, 10);
    }
}

if ( ! function_exists( 'fana_clean' ) ) {
	function fana_clean( $var ) {
		if ( is_array( $var ) ) {
			return array_map( 'fana_clean', $var );
		} else {
			return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		}
	}
}

if ( ! function_exists( 'fana_clear_transient' ) ) {
	function fana_clear_transient() {
		delete_transient( 'fana-hash-time' );
	} 
	add_action( 'wp_update_nav_menu_item', 'fana_clear_transient', 11, 1 );
} 

if (! function_exists('fana_nav_menu_get_menu_class')) {
    function fana_nav_menu_get_menu_class($layout)
    { 
 
        $menu_class    = 'elementor-nav-menu menu nav navbar-nav megamenu';

		switch ($layout) {
			case 'vertical':
				$menu_class .= ' flex-column';
				break;

			case 'treeview':
				$menu_class = 'menu navbar-nav';
				break;
			
			default:
				$menu_class .= ' flex-row';
				break;
		}

		return  $menu_class;
    }
}

if (! function_exists('fana_get_transliterate')) {
    function fana_get_transliterate( $slug ) {
        $slug = urldecode($slug);

        if (function_exists('iconv') && defined('ICONV_IMPL') && @strcasecmp(ICONV_IMPL, 'unknown') !== 0) {
            $slug = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $slug);
        }

        return $slug;
    }
}


if ( ! function_exists( 'fana_wpml_object_id' ) ) {
	function fana_wpml_object_id( $element_id, $element_type = 'post', $return_original_if_missing = false, $language_code = null ) {
		if ( function_exists( 'wpml_object_id_filter' ) ) {
			return wpml_object_id_filter( $element_id, $element_type, $return_original_if_missing, $language_code );
		} elseif ( function_exists( 'icl_object_id' ) ) {
			return icl_object_id( $element_id, $element_type, $return_original_if_missing, $language_code );
		} else {
			return $element_id;
		}
	}
}

if (! function_exists('fana_is_show_woo_catalog_ordering')) {
    function fana_is_show_woo_catalog_ordering() {
        $active = true;

        if( function_exists('dokan_is_store_page') && dokan_is_store_page() ) {
            $active = false;
        }

        return $active;
    }
}


if (! function_exists('fana_elementor_general_widgets')) {
    function fana_elementor_general_widgets() {
        $elements = array(
            'template',
            'heading',
            'brands',
            'banner',
            'posts-grid',
            'our-team',
            'testimonials',
            'tab-introduction',
            'list-custom-fonts',
            'button',
            'menu-vertical',
            'gallery',
            'compare-our-fit',
        );

        if ( function_exists( 'wpforms' ) ) {
            array_push($elements, 'wpforms-button-popup');
        }

        if (class_exists('MC4WP_MailChimp')) {
            array_push($elements, 'newsletter');
        }

        return apply_filters('fana_general_elements_array', $elements );
    }
}

if (! function_exists('fana_elementor_header_widgets')) {
    function fana_elementor_header_widgets() {
        $elements = array(
            'site-logo',
            'nav-menu',
            'search-form',
            'canvas-menu-template',
            'search-canvas',
            'search-popup',
        );

        if (fana_woocommerce_activated()) {
            array_push($elements, 'account');
            array_push($elements, 'product-recently-viewed-header');

            if (!fana_catalog_mode_active()) {
                array_push($elements, 'mini-cart');
            }
        }

        if (class_exists('WOOCS_STARTER')) {
            array_push($elements, 'currency');
        }

        if (class_exists('YITH_WCWL')) {
            array_push($elements, 'wishlist');
        }

        if (class_exists('YITH_Woocompare')) {
            array_push($elements, 'compare');
        }

        if (defined('TBAY_ELEMENTOR_DEMO')) {
            array_push($elements, 'custom-language');
        }

        return apply_filters('fana_header_elements_array', $elements );
    }
}

if (! function_exists('fana_elementor_woocommerce_widgets')) {
    function fana_elementor_woocommerce_widgets() {
        $elements = array(
            'products',
            'single-product-home',
            'product-category',
            'product-tabs',
            'woocommerce-tags',
            'custom-image-list-tags',
            'product-categories-tabs',
            'list-categories-product',
            'custom-image-list-categories',
            'product-recently-viewed-main',
            'product-flash-sales',
            'product-count-down',
            'product-list-tags'
        );

        return apply_filters('fana_woocommerce_elements_array', $elements );
    }
}


if (! function_exists('fana_redux_elementor_to_list_addons')) {
    function fana_redux_elementor_to_list_addons( $general_widgets ) {

        $fields_general = array();

        foreach( $general_widgets as $key => $value ) {
            $id     = 'addon_el_'. str_replace("-","_", $value);

            $name = sprintf( __('Fana %s', 'fana'), ucwords( str_replace("-"," ", $value) ) );

            $fields_general[] = array(
                'id'            => $id,
                'type'          => 'switch',
                'title'         => $name,
                'default'       => true
            );
        }

        return $fields_general;

    }
}