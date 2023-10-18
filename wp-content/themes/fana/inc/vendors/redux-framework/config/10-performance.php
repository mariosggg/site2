<?php
/**
 * Redux Framework checkbox config.
 * For full documentation, please visit: http://devs.redux.io/
 *
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;


/** Performance Settings **/
Redux::set_section(
	$opt_name,
	array(
        'icon' => 'el-icon-cog',
        'title' => esc_html__('Performance', 'fana'),
	)
);

Redux::set_section(
	$opt_name,
	array(
        'subsection' => true,
        'title' => esc_html__('Performance', 'fana'),
        'fields' => array(
            array(
                'id'       => 'minified_js',
                'type'     => 'switch',
                'title'    => esc_html__('Include minified JS', 'fana'),
                'subtitle' => esc_html__('Minified version of functions.js and device.js file will be loaded', 'fana'),
                'default' => true
            ),
        )
	)
);

Redux::set_section(
	$opt_name,
	array(
        'subsection' => true,
        'title' => esc_html__('Preloader', 'fana'),
        'fields' => array(
            array(
                'id'        => 'preload',
                'type'      => 'switch',
                'title'     => esc_html__('Preload Website', 'fana'),
                'default'   => false
            ),
            array(
                'id' => 'select_preloader',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Select Preloader', 'fana'),
                'subtitle' => esc_html__('Choose a Preloader for your website.', 'fana'),
                'required'  => array('preload','=',true),
                'options' => array(
                    'loader1' => array(
                        'title' => esc_html__('Loader 1', 'fana'),
                        'img'   => FANA_ASSETS_IMAGES . '/preloader/loader1.png'
                    ),
                    'loader2' => array(
                        'title' => esc_html__('Loader 2', 'fana'),
                        'img'   => FANA_ASSETS_IMAGES . '/preloader/loader2.png'
                    ),
                    'loader3' => array(
                        'title' => esc_html__('Loader 3', 'fana'),
                        'img'   => FANA_ASSETS_IMAGES . '/preloader/loader3.png'
                    ),
                    'loader4' => array(
                        'title' => esc_html__('Loader 4', 'fana'),
                        'img'   => FANA_ASSETS_IMAGES . '/preloader/loader4.png'
                    ),
                    'loader5' => array(
                        'title' => esc_html__('Loader 5', 'fana'),
                        'img'   => FANA_ASSETS_IMAGES . '/preloader/loader5.png'
                    ),
                    'loader6' => array(
                        'title' => esc_html__('Loader 6', 'fana'),
                        'img'   => FANA_ASSETS_IMAGES . '/preloader/loader6.png'
                    ),
                    'custom_image' => array(
                        'title' => esc_html__('Custom image', 'fana'),
                        'img'   => FANA_ASSETS_IMAGES . '/preloader/custom_image.png'
                    ),
                ),
                'default' => 'loader1'
            ),
            array(
                'id' => 'media-preloader',
                'type' => 'media',
                'required' => array('select_preloader','=', 'custom_image'),
                'title' => esc_html__('Upload preloader image', 'fana'),
                'subtitle' => esc_html__('Image File (.gif)', 'fana'),
                'desc' =>   sprintf(wp_kses(__('You can download some the Gif images <a target="_blank" href="%1$s">here</a>.', 'fana'), array(  'a' => array( 'href' => array(), 'target' => array() ) )), 'https://loading.io/'),
            ),
        )
	)
);