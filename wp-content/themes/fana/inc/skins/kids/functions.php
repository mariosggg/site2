<?php 

if (!function_exists('fana_tbay_private_size_image_setup')) {
    function fana_tbay_private_size_image_setup()
    {
        if (fana_tbay_get_global_config('config_media', false)) {
            return;
        }

        // Post Thumbnails Size 
        set_post_thumbnail_size(480, 320, true); // Unlimited height, soft crop
        update_option('thumbnail_size_w', 480);
        update_option('thumbnail_size_h', 320);

        update_option('medium_size_w', 555);    
        update_option('medium_size_h', 333);

        update_option('large_size_w', 770);
        update_option('large_size_h', 462); 
    }
    add_action('after_setup_theme', 'fana_tbay_private_size_image_setup');
}
  
/**
 *  Include Load Google Front
 */

if ( !function_exists('fana_fonts_url') ) {
	function fana_fonts_url() {
        /**
         * Load Google Front
         */

        $fonts_url = '';

        /* Translators: If there are cfanacters in your language that are not
        * supported by Montserrat, translate this to 'off'. Do not translate
        * into your own language.
        */
        $Lato       = _x('on', 'Lato font: on or off', 'fana');

     
        if ('off' !== $Lato) {
            $font_families = array();
     
            if ('off' !== $Lato) {
                $font_families[] = 'Lato:400,500,600,700';
            }

            $query_args = array(
                'family' => rawurlencode( implode('|', $font_families) ),
                'subset' => urlencode('latin,latin-ext'),
                'display' => urlencode('swap'),
            );
            
            $protocol = is_ssl() ? 'https:' : 'http:';
            $fonts_url = add_query_arg($query_args, $protocol .'//fonts.googleapis.com/css');
        }
     
        return esc_url_raw($fonts_url);
		
	}
}

if ( !function_exists('fana_tbay_fonts_url') ) {
	function fana_tbay_fonts_url() {  
        $show_typography  = fana_tbay_get_config('show_typography', false);
        $font_source      = fana_tbay_get_config('font_source', "1");
        $font_google_code = fana_tbay_get_config('font_google_code');
        if ( $show_typography && $font_source == "2" && !empty($font_google_code)) {
            wp_enqueue_style('fana-theme-fonts', $font_google_code, array(), null);
        } else {
            wp_enqueue_style('sfufutura', FANA_STYLES . '/sfufutura.css', array(), '1.0'); 
            wp_enqueue_style('baloo', FANA_STYLES . '/baloo.css', array(), '1.0');
        }
	}
	add_action('wp_enqueue_scripts', 'fana_tbay_fonts_url');
}
