<?php
if (!function_exists('fana_hex2rgba_opacity')) {
	function fana_hex2rgba_opacity($color, $opacity = false) {
	
		$default = 'rgb(0,0,0)';
	
		//Return default if no color provided
		if(empty($color))
			return $default; 
	
		//Sanitize $color if "#" is provided 
			if ($color[0] == '#' ) {
				$color = substr( $color, 1 );
			}
	
			//Check if color has 6 or 3 characters and get values
			if (strlen($color) == 6) {
					$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
					$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
					return $default;
			}
	
			//Convert hexadec to rgb
			$rgb =  array_map('hexdec', $hex);
	
			//Check if opacity is set(rgba or rgb)
			if($opacity){
				if(abs($opacity) === 1)  
					$opacity = 1.0;
				$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
			} else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
	
			//Return rgb(a) color string
			return $output;
	}
}


if (!function_exists('fana_tbay_color_lightens_darkens')) {
    /**
     * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
     * @param str $hex Colour as hexadecimal (with or without hash);
     * @percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
     * @return str Lightened/Darkend colour as hexadecimal (with hash);
     */
    function fana_tbay_color_lightens_darkens($hex, $percent)
    {
		if( empty($hex) ) return $hex;
        
       	// validate hex string
		
		$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
		$new_hex = '#';
		
		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}
		
		// convert to decimal and change luminosity
		for ($i = 0; $i < 3; $i++) {
			$dec = substr( $hex, $i*2, 2 );
			$dec = intval( $dec, 16 );
			$dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
			$new_hex .= str_pad( sprintf("%02x", $dec) , 2, 0, STR_PAD_LEFT );
		}		
		
		return $new_hex;
    }
}




if (!function_exists('fana_tbay_default_theme_primary_color')) {
    function fana_tbay_default_theme_primary_color()
    {
		$active_theme = fana_tbay_get_theme();

		$theme_variable = array();

		switch ($active_theme) {
			case 'vest-suit':
				$theme_variable['boby_bg'] 				= 'transparent';
				$theme_variable['main_color'] 			= '#EDB658';
				$theme_variable['main_color_text_enable'] = false;
				$theme_variable['enable_main_color_second'] = false;
				$theme_variable['header_mobile_bg'] 	= '#fff';
				$theme_variable['header_mobile_color'] 	= '#191919';
				break;

			case 'bikini':
				$theme_variable['boby_bg'] 				= 'transparent';
				$theme_variable['main_color'] 			= '#ca6d6f';
				$theme_variable['main_color_text_enable'] = false;
				$theme_variable['enable_main_color_second'] = false;
				$theme_variable['header_mobile_bg'] 	= '#fff';
				$theme_variable['header_mobile_color'] 	= '#191919';
				break;

			case 'sport':
				$theme_variable['boby_bg'] 				= 'transparent';
				$theme_variable['main_color'] 			= '#CFEE10';
				$theme_variable['main_color_text_enable'] = true;
				$theme_variable['enable_main_color_second'] = false;
				$theme_variable['main_color_text'] 		= '#121216';
				$theme_variable['header_mobile_bg'] 	= '#fff';
				$theme_variable['header_mobile_color'] 	= '#191919';
				break;
			
			case 'kids':
				$theme_variable['boby_bg'] 				= 'transparent';
				$theme_variable['main_color'] 			= '#FC4CA5';
				$theme_variable['main_color_text_enable'] = false;
				$theme_variable['main_color_second'] 	 = '#A2BC00';
                $theme_variable['enable_main_color_second']  = true;
				$theme_variable['header_mobile_bg'] 	= '#fff';
				$theme_variable['header_mobile_color'] 	= '#191919';
				break;
				
			default:
				$theme_variable['boby_bg'] 				= 'transparent';
				$theme_variable['main_color'] 			= '#2f4799'; 
				$theme_variable['main_color_text_enable'] = false;
				$theme_variable['enable_main_color_second'] = false;
				$theme_variable['header_mobile_bg'] 	= '#fff';
				$theme_variable['header_mobile_color'] 	= '#191919';
		}

        return apply_filters('fana_get_default_theme_color', $theme_variable);
    }
}

if ( !function_exists ('fana_tbay_default_theme_primary_fonts') ) {
	function fana_tbay_default_theme_primary_fonts() {
		$active_theme = fana_tbay_get_theme();

		$theme_variable = array();

		switch ($active_theme) {
			case 'vest-suit':
				$theme_variable['main_font'] 			= 'SFU Futura';
				$theme_variable['main_font_second'] 	= 'EB Garamond';
				$theme_variable['font_second_enable'] 	= true;
				break;

			case 'sport':
				$theme_variable['main_font'] 			= 'SFU Futura';
				$theme_variable['main_font_second'] 	= 'SFU DIN';
				$theme_variable['font_second_enable'] 	= true;
				break;

			case 'kids':
				$theme_variable['main_font'] 			= 'SFU Futura';
				$theme_variable['main_font_second'] 	= 'Baloo';
				$theme_variable['font_second_enable'] 	= true;
				break;

			default:
				$theme_variable['main_font'] 			= 'SFU Futura';
				$theme_variable['main_font_second'] 	= 'Ivy Mode';
				$theme_variable['font_second_enable'] 	= true;

		}

		return apply_filters( 'fana_get_default_theme_fonts', $theme_variable);
	}
}

if (!function_exists('fana_tbay_check_empty_customize')) {
    function fana_tbay_check_empty_customize($option, $default){
	 	echo !empty($option) ? esc_html($option) : esc_html($default);
	}
}


if (!function_exists('fana_tbay_theme_primary_color')) {
    function fana_tbay_theme_primary_color()
    {
		$default_color 		= fana_tbay_default_theme_primary_color(); 
		$boby_bg   			= fana_tbay_get_config(('boby_bg'));
		$active_theme 		= fana_tbay_get_theme();


		$main_color   		= fana_tbay_get_config(('main_color'),$default_color['main_color']);

		if( !empty($default_color['main_color_text_enable']) ) {
			$main_color_text   = fana_tbay_get_config(('main_color_text'),$default_color['main_color_text']);
		}

		$header_mobile_bg   = fana_tbay_get_config(('header_mobile_bg'),$default_color['header_mobile_bg']);
		$header_mobile_color   = fana_tbay_get_config(('header_mobile_color'),$default_color['header_mobile_color']);

		$btn_text_color   = fana_tbay_get_config('btn_text_color');  

		/*Theme Color*/
		?>
		:root {
			--tb-theme-color: <?php fana_tbay_check_empty_customize( $main_color, $default_color['main_color']) ?>;
			--tb-theme-body: <?php echo ( !empty($boby_bg['background-color']) ) ? $boby_bg['background-color'] : $default_color['boby_bg']; ?>;
			--tb-theme-color-bg-opacity-01: <?php fana_tbay_check_empty_customize( fana_hex2rgba_opacity($main_color, 0.08), $default_color['main_color']) ?>;
			--tb-theme-color-hover: <?php fana_tbay_check_empty_customize( fana_tbay_color_lightens_darkens($main_color, -0.05), fana_tbay_color_lightens_darkens($default_color['main_color'], -0.05) );  ?>;
			--tb-header-mobile-bg: <?php fana_tbay_check_empty_customize($header_mobile_bg, $default_color['header_mobile_bg']) ?>;
			--tb-header-mobile-color: <?php fana_tbay_check_empty_customize($header_mobile_color, $default_color['header_mobile_color'] )?>;

			<?php if( !empty($default_color['main_color_text_enable']) ) : ?>
				--tb-theme-color-text: <?php fana_tbay_check_empty_customize( $main_color_text, $default_color['main_color_text']) ?>;
			<?php else: ?>
				--tb-theme-color-text: <?php fana_tbay_check_empty_customize( $main_color, $default_color['main_color']) ?>;
			<?php endif; ?>

			<?php if( !empty($default_color['enable_main_color_second']) && $default_color['enable_main_color_second'] ) : ?>
				--tb-theme-color-second: <?php fana_tbay_check_empty_customize( fana_tbay_get_config(('main_color_second'),$default_color['main_color_second']), $default_color['main_color_second']) ?>;
			<?php endif; ?>

			<?php if( !empty($btn_text_color) ) : ?>
				--tb-btn-text-color: <?php fana_tbay_check_empty_customize( $btn_text_color, '') ?>;
			<?php endif; ?>

			
			<?php if( $active_theme === 'kids' ) : ?>
				--tb-label-sale: <?php fana_tbay_check_empty_customize( $main_color, $default_color['main_color']) ?>;
				--tb-label-featured: <?php fana_tbay_check_empty_customize( fana_tbay_get_config(('main_color_second'),$default_color['main_color_second']), $default_color['main_color_second']) ?>;
			<?php endif; ?>
			
		} 
		<?php
    }
}
 
if (!function_exists('fana_tbay_custom_styles')) {
    function fana_tbay_custom_styles()
    {
		ob_start();

		fana_tbay_theme_primary_color();

		$default_fonts 		= fana_tbay_default_theme_primary_fonts();

		if ( !fana_redux_framework_activated() ) {
			?>  
			:root { 
				--tb-text-primary-font: '<?php echo trim($default_fonts['main_font']); ?>'; 
				--tb-text-second-font: '<?php echo trim($default_fonts['main_font_second']); ?>';
			} 
			<?php
        }

		/*End Theme Color*/
		if (fana_redux_framework_activated()) {
			$logo_img_width        		= fana_tbay_get_config('logo_img_width');
			$logo_padding        		= fana_tbay_get_config('logo_padding');

			$logo_img_width_mobile 		= fana_tbay_get_config('logo_img_width_mobile');
			$logo_mobile_padding 		= fana_tbay_get_config('logo_mobile_padding');

			$checkout_img_width 		= fana_tbay_get_config('checkout_img_width');

			$custom_css 			= fana_tbay_get_config('custom_css');
			$css_desktop 			= fana_tbay_get_config('css_desktop');
			$css_tablet 			= fana_tbay_get_config('css_tablet');
			$css_wide_mobile 		= fana_tbay_get_config('css_wide_mobile');
			$css_mobile         	= fana_tbay_get_config('css_mobile');

			$primary_font  =  $default_fonts['main_font'];
			$second_font  =  $default_fonts['main_font_second'];


			$show_typography        = (bool) fana_tbay_get_config('show_typography', false);
			
			if ($show_typography) {
                $font_source 			= fana_tbay_get_config('font_source');

				if ( !empty(fana_tbay_get_config('main_font')['font-family']) ) {
					$primary_font 			= fana_tbay_get_config('main_font')['font-family'];
				}
				if ( !empty(fana_tbay_get_config('main_font_second')['font-family']) ) {
					$second_font					= fana_tbay_get_config('main_font_second')['font-family'];
				}
                $main_google_font_face = fana_tbay_get_config('main_google_font_face');
                $main_custom_font_face = fana_tbay_get_config('main_custom_font_face');
                $main_second_google_font_face 	= fana_tbay_get_config('main_second_google_font_face');
                $main_second_custom_font_face 	= fana_tbay_get_config('main_second_custom_font_face');
 
                if ($font_source  == "2" && $main_google_font_face) {
                    $primary_font = $main_google_font_face;
                    $second_font = $main_second_google_font_face;
                } elseif ($font_source  == "3" && $main_custom_font_face) {
                    $primary_font = $main_custom_font_face;
                    $second_font = $main_second_custom_font_face;
                } ?>
				:root {
					--tb-text-primary-font: '<?php echo trim($primary_font); ?>';

					<?php if ($default_fonts['font_second_enable']) : ?> 
						--tb-text-second-font: '<?php echo trim($second_font); ?>';  
					<?php endif; ?>
				}  
				<?php 
            } else {
				?>
					:root { 
						--tb-text-primary-font: '<?php echo trim($default_fonts['main_font']); ?>';
						<?php if ($default_fonts['font_second_enable']) : ?>
							--tb-text-second-font: '<?php echo trim($default_fonts['main_font_second']); ?>';
						<?php endif; ?>
					}
				<?php
			}

			?>
			/* Theme Options Styles */
			

					<?php if ($logo_img_width != "") : ?>
					.site-header .logo img {
						max-width: <?php echo esc_html($logo_img_width); ?>px;
					} 
					<?php endif; ?>

					<?php if ($checkout_img_width != "") : ?>
					.checkout-logo img {
						max-width: <?php echo esc_html($checkout_img_width); ?>px;
					} 
					<?php endif; ?>

					<?php if ($logo_padding != "") : ?>
					.site-header .logo img {

						<?php if (!empty($logo_padding['padding-top'])) : ?>
							padding-top: <?php echo esc_html($logo_padding['padding-top']); ?>;
						<?php endif; ?>

						<?php if (!empty($logo_padding['padding-right'])) : ?>
							padding-right: <?php echo esc_html($logo_padding['padding-right']); ?>;
						<?php endif; ?>
						
						<?php if (!empty($logo_padding['padding-bottom'])) : ?>
							padding-bottom: <?php echo esc_html($logo_padding['padding-bottom']); ?>;
						<?php endif; ?>

						<?php if (!empty($logo_padding['padding-left'])) : ?>
							padding-left: <?php echo esc_html($logo_padding['padding-left']); ?>;
						<?php endif; ?>

					}
					<?php endif; ?> 

					@media (max-width: 1199px) {

						<?php if ($logo_img_width_mobile != "") : ?>
						/* Limit logo image height for mobile according to mobile header height */
						.mobile-logo a img {
							width: <?php echo esc_html($logo_img_width_mobile); ?>px;
						}     
						<?php endif; ?>       

						<?php if ($logo_mobile_padding['padding-top'] != "" || $logo_mobile_padding['padding-right'] || $logo_mobile_padding['padding-bottom'] || $logo_mobile_padding['padding-left']) : ?>
						.mobile-logo a img {

							<?php if (!empty($logo_mobile_padding['padding-top'])) : ?>
								padding-top: <?php echo esc_html($logo_mobile_padding['padding-top']); ?>;
							<?php endif; ?>

							<?php if (!empty($logo_mobile_padding['padding-right'])) : ?>
								padding-right: <?php echo esc_html($logo_mobile_padding['padding-right']); ?>;
							<?php endif; ?>

							<?php if (!empty($logo_mobile_padding['padding-bottom'])) : ?>
								padding-bottom: <?php echo esc_html($logo_mobile_padding['padding-bottom']); ?>;
							<?php endif; ?>

							<?php if (!empty($logo_mobile_padding['padding-left'])) : ?>
								padding-left: <?php echo esc_html($logo_mobile_padding['padding-left']); ?>;
							<?php endif; ?>
						
						}
						<?php endif; ?>
					}

					@media screen and (max-width: 782px) {
						html body.admin-bar{
							top: -46px !important;
							position: relative;
						}
					}

				/* Custom CSS */
				<?php
				if ($custom_css != '') {
					echo trim($custom_css);
				}
			if ($css_desktop != '') {
				echo '@media (min-width: 1024px) { ' . trim($css_desktop) . ' }';
			}
			if ($css_tablet != '') {
				echo '@media (min-width: 768px) and (max-width: 1023px) {' . trim($css_tablet) . ' }';
			}
			if ($css_wide_mobile != '') {
				echo '@media (min-width: 481px) and (max-width: 767px) { ' . trim($css_wide_mobile) . ' }';
			}
			if ($css_mobile != '') {
				echo '@media (max-width: 480px) { ' . trim($css_mobile) . ' }';
			}
		}

        
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}

		$custom_css = implode($new_lines);

		wp_enqueue_style('fana-style', FANA_THEME_DIR . '/style.css', array(), '1.0');

		wp_add_inline_style('fana-style', $custom_css);
		
    }

    add_action('wp_enqueue_scripts', 'fana_tbay_custom_styles', 200);
}
