<?php
/**
 * Redux Framework checkbox config.
 * For full documentation, please visit: http://devs.redux.io/
 *
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;


$default_color = fana_tbay_default_theme_primary_color();
$default_fonts = fana_tbay_default_theme_primary_fonts();

if ( !isset($default_color['main_color_second']) ) {
	$default_color['main_color_second'] = '';
}

if ( !isset($default_fonts['main_font_second']) ) {
	$default_fonts['main_font_second'] = '';
}

/** Style Settings **/
Redux::set_section(
	$opt_name,
	array(
        'icon' => 'zmdi zmdi-format-color-text',
        'title' => esc_html__('Style', 'fana'),
	)
);

if (!function_exists('fana_settings_style_main_fields')) {
    function fana_settings_style_main_fields( $default_color )
    {

		$fields_color_text = $fields_color_sencond_text = array();
        $fields = array(
			array(
				'id'       => 'boby_bg',
				'type'     => 'background',
				'output'   => array( 'body' ),
				'title'    => esc_html__('Body Background', 'fana'),
				'subtitle' => esc_html__('Body background with image, color, etc.', 'fana'),
			),
			array(
				'title' => esc_html__('Theme Main Color', 'fana'),
				'id' => 'main_color',
				'type' => 'color',
				'transparent' => false,
				'default' => $default_color['main_color'],
			),
			array(
				'title' => esc_html__('Color Text of the button theme color', 'fana'),
				'id' => 'btn_text_color',
				'type' => 'color',
				'transparent' => false,
			)
        );

		if( !empty($default_color['main_color_text_enable']) && $default_color['main_color_text_enable'] ) {
            $fields_color_text = array(
				array(
					'title' => esc_html__('Theme Main Color (Text)', 'fana'),
					'id' => 'main_color_text',
					'type' => 'color',
					'transparent' => false,
					'default' => $default_color['main_color_text'],
				),
            );
		}

		if( !empty($default_color['enable_main_color_second']) && $default_color['enable_main_color_second'] ) {
            $fields_color_sencond_text = array(
				array(
					'title' => esc_html__('Theme Main Color Second', 'fana'),
					'id' => 'main_color_second',
					'type' => 'color',
					'transparent' => false,
					'default' => $default_color['main_color_second'],
				),
            );
		}

		$fields = array_merge($fields, $fields_color_text, $fields_color_sencond_text);

		return $fields;
	}
}


// Style main color settings
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__('Main', 'fana'),
		'subsection' => true,
		'fields' => fana_settings_style_main_fields( $default_color )
	)
);


// Style Typography settings
Redux::set_section(
	$opt_name,
	array(
		'subsection' => true,
		'title' => esc_html__('Typography', 'fana'),
		'fields' => array(
			array(
				'id' => 'show_typography',
				'type' => 'switch',
				'title' => esc_html__('Edit Typography', 'fana'),
				'default' => false
			),
			array(
				'title'    => esc_html__('Font Source', 'fana'),
				'id'       => 'font_source',
				'type'     => 'radio',
				'required' => array('show_typography','=', true),
				'options'  => array(
					'1' => 'Standard + Google Webfonts',
					'2' => 'Google Custom',
					'3' => 'Custom Fonts'
				),
				'default' => '1'
			),
			array(
				'id'=>'font_google_code',
				'type' => 'text',
				'title' => esc_html__('Google Link', 'fana'),
				'subtitle' => '<em>'.esc_html__('Paste the provided Google Code', 'fana').'</em>',
				'default' => '',
				'desc' => esc_html__('e.g.: https://fonts.googleapis.com/css?family=Open+Sans', 'fana'),
				'required' => array('font_source','=','2')
			),

			array(
				'id' => 'main_custom_font_info',
				'icon' => true,
				'type' => 'info',
				'raw' => '<h3 style="margin: 0;">'. sprintf(
					'%1$s <a href="%2$s">%3$s</a>',
					esc_html__('Video guide custom font in ', 'fana'),
					esc_url('https://www.youtube.com/watch?v=ljXAxueAQUc'),
					esc_html__('here', 'fana')
				) .'</h3>',
				'required' => array('font_source','=','3')
			),

			array(
				'id' => 'main_font_info',
				'icon' => true,
				'type' => 'info',
				'raw' => '<h3 style="margin: 0;"> '.esc_html__('Main Font', 'fana').'</h3>',
				'required' => array('show_typography','=', true),
			),

			// Standard + Google Webfonts
			array(
				'title' => esc_html__('Font Face', 'fana'),
				'id' => 'main_font',
				'type' => 'typography',
				'line-height' => false,
				'text-align' => false,
				'font-style' => false,
				'font-weight' => false,
				'all_styles'=> true,
				'font-size' => false,
				'color' => false,
				'default' => array(
					'font-family' => '',
					'subsets' => '',
				),
				'required' => array(
					array('font_source','=','1'),
					array('show_typography','=', true)
				)
			),
			
			// Google Custom
			array(
				'title' => esc_html__('Google Font Face', 'fana'),
				'subtitle' => '<em>'.esc_html__('Enter your Google Font Name for the theme\'s Main Typography', 'fana').'</em>',
				'desc' => esc_html__('e.g.: &#39;Open Sans&#39;', 'fana'),
				'id' => 'main_google_font_face',
				'type' => 'text',
				'default' => '',
				'required' => array(
					array('font_source','=','2'),
					array('show_typography','=', true)
				)
			),

			// main Custom fonts
			array(
				'title' => esc_html__('Main custom Font Face', 'fana'),
				'subtitle' => '<em>'.esc_html__('Enter your Custom Font Name for the theme\'s Main Typography', 'fana').'</em>',
				'desc' => esc_html__('e.g.: &#39;Open Sans&#39;', 'fana'),
				'id' => 'main_custom_font_face',
				'type' => 'text',
				'default' => '',
				'required' => array(
					array('font_source','=','3'),
					array('show_typography','=', true)
				)
			),

			array (
				'id' => 'main_font_second_info',
				'icon' => true,
				'type' => 'info',
				'raw' => '<h3 style="margin: 0;"> '.esc_html__('Font Second', 'fana').'</h3>',
				'required' => array( 
					array('show_typography','=', true),
					array('show_typography','=', $default_fonts['main_font_second']),
				)
			),

			// Standard + Google Webfonts
			array (
				'title' => esc_html__('Font Face Second', 'fana'),
				'id' => 'main_font_second',
				'type' => 'typography',
				'line-height' => false,
				'text-align' => false,
				'font-style' => false,
				'font-weight' => false,
				'all_styles'=> true,
				'font-size' => false,
				'color' => false,
				'default' => array (
					'font-family' => '',
					'subsets' => '',
				),
				'required' => array( 
					array('font_source','=','1'), 
					array('show_typography','=', true),
					array('show_typography','=', $default_fonts['font_second_enable']),
				)
			),

			// Google Custom                        
			array (
				'title' => esc_html__('Google Font Face Second', 'fana'),
				'subtitle' => '<em>'.esc_html__('Enter your Google Font Name for the theme\'s Main Typography', 'fana').'</em>',
				'desc' => esc_html__('e.g.: &#39;Open Sans&#39;, sans-serif', 'fana'),
				'id' => 'main_second_google_font_face',
				'type' => 'text',
				'default' => '',
				'required' => array( 
					array('font_source','=','2'), 
					array('show_typography','=', true),
					array('show_typography','=', $default_fonts['font_second_enable']),
				)
			),                    

			// main Custom fonts                      
			array (
				'title' => esc_html__('Custom Font Face Second', 'fana'),
				'subtitle' => '<em>'.esc_html__('Enter your Custom Font Name for the theme\'s Main Typography', 'fana').'</em>',
				'desc' => esc_html__('e.g.: &#39;Open Sans&#39;, sans-serif', 'fana'),
				'id' => 'main_second_custom_font_face',
				'type' => 'text',
				'default' => '',
				'required' => array( 
					array('font_source','=','3'), 
					array('show_typography','=', true),
					array('show_typography','=', $default_fonts['font_second_enable']),
				)
			),
		)
	)
);


// Style Header Mobile settings
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__('Header Mobile', 'fana'),
		'subsection' => true,
		'fields' => array(

			array(
				'title' => esc_html__('Background Color', 'fana'),
				'id' => 'header_mobile_bg',
				'type' => 'color',
				'transparent' => false,
			),

			array(
				'title' => esc_html__('Header Color', 'fana'),
				'id' => 'header_mobile_color',
				'type' => 'color',
				'transparent' => false,
			),
		)
	)
);