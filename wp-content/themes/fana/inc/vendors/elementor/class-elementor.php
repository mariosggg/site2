<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Fana_Elementor_Addons
{
    public function __construct()
    {
        $this->include_control_customize_widgets();
        $this->include_render_customize_widgets();

        add_action('elementor/elements/categories_registered', array( $this, 'add_category' ));

        add_action('elementor/widgets/register', array( $this, 'include_widgets' ));

        add_action('wp', [ $this, 'regeister_scripts_frontend' ]);

        // frontend
        // Register widget scripts
        add_action('elementor/frontend/after_register_scripts', [ $this, 'frontend_after_register_scripts' ]);
        add_action('elementor/frontend/after_enqueue_scripts', [ $this, 'frontend_after_enqueue_scripts' ]);

        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_icons'], 99);

        // editor
        add_action('elementor/editor/after_register_scripts', [ $this, 'editor_after_register_scripts' ]);
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_after_enqueue_scripts']);

    
        add_action('widgets_init', array( $this, 'register_wp_widgets' ));

        //Add Font Group
        add_filter( 'elementor/fonts/groups', array( $this, 'editor_custom_fonts_theme_groups'), 10, 1);

        //Add Group Fonts
        add_filter( 'elementor/fonts/additional_fonts', array( $this, 'editor_custom_fonts_theme'), 10, 1);
    }

    public function editor_after_register_scripts()
    {
        if (fana_is_remove_scripts()) {
            return;
        }

        $suffix = (fana_tbay_get_config('minified_js', false)) ? '.min' : FANA_MIN_JS;
        // /*slick jquery*/
        wp_register_script('slick', FANA_SCRIPTS . '/slick' . $suffix . '.js', array(), '1.0.0', true);
        wp_register_script('fana-custom-slick', FANA_SCRIPTS . '/custom-slick' . $suffix . '.js', array( ), FANA_THEME_VERSION, true);

        wp_register_script('fana-script', FANA_SCRIPTS . '/functions' . $suffix . '.js', array(), FANA_THEME_VERSION, true);
    
        wp_register_script('popper', FANA_SCRIPTS . '/popper' . $suffix . '.js', array( ), '1.12.9', true);
        wp_register_script('bootstrap', FANA_SCRIPTS . '/bootstrap' . $suffix . '.js', array( 'popper' ), '5.1', true);
          
        // Add before after image
        wp_register_script( 'before-after-image', FANA_SCRIPTS . '/cndk.beforeafter' . $suffix . '.js', array('fana-script' ), '0.0.2', true ); 
        wp_register_style( 'before-after-image', FANA_STYLES . '/cndk.beforeafter.css', array(), '0.0.2' );

        /*Treeview menu*/
        wp_register_script('jquery-treeview', FANA_SCRIPTS . '/jquery.treeview' . $suffix . '.js', array( ), '1.4.0', true);

        wp_enqueue_script('waypoints', FANA_SCRIPTS . '/jquery.waypoints' . $suffix . '.js', array(), '4.0.0', true);
       
        // Add js Sumoselect version 3.0.2
        wp_register_style('sumoselect', FANA_STYLES . '/sumoselect.css', array(), '1.0.0', 'all');
        wp_register_script('jquery-sumoselect', FANA_SCRIPTS . '/jquery.sumoselect' . $suffix . '.js', array(), '3.0.2', true);
    }

    public function frontend_after_enqueue_scripts()
    {
    }

    public function editor_after_enqueue_scripts()
    {
    }

    public function enqueue_editor_icons()
    {
        wp_enqueue_style('font-awesome', FANA_STYLES . '/font-awesome.css', array(), '5.10.2');
        wp_enqueue_style('simple-line-icons', FANA_STYLES . '/simple-line-icons.css', array(), '2.4.0');
        wp_enqueue_style('fana-font-tbay-custom', FANA_STYLES . '/font-tbay-custom.css', array(), '1.0.0');
        wp_enqueue_style('material-design-iconic-font', FANA_STYLES . '/material-design-iconic-font.css', array(), '2.2.0');

        if (fana_elementor_is_edit_mode() || fana_elementor_preview_page() || fana_elementor_preview_mode()) {
            wp_enqueue_style('fana-elementor-editor', FANA_STYLES . '/elementor-editor.css', array(), FANA_THEME_VERSION);
        }
    }


    /**
     * @internal Used as a callback
     */
    public function frontend_after_register_scripts()
    {
        $this->editor_after_register_scripts();
    }


    public function register_wp_widgets()
    {
    }

    public function regeister_scripts_frontend()
    {
    }


    public function add_category( $elements_manager )
    {
        $elements_manager->add_category(
            'fana-elements',
            array(
                'title' => esc_html__('Fana Elements', 'fana'),
                'icon'  => 'fa fa-plug',
            )
        );
    }

    /**
     * @param $widgets_manager Elementor\Widgets_Manager
     */
    public function include_widgets($widgets_manager)
    {
        $this->include_abstract_widgets($widgets_manager);
        $this->include_general_widgets($widgets_manager);
        $this->include_header_widgets($widgets_manager);
        $this->include_woocommerce_widgets($widgets_manager);
    }


    /**
     * Widgets General Theme
     */
    public function include_general_widgets($widgets_manager)
    {
        $elements = fana_elementor_general_widgets();

        foreach ($elements as $file) {
            $addon = 'addon_el_'. str_replace("-","_", $file);
            if( fana_tbay_get_global_config($addon, true) ) {
                $path   = FANA_ELEMENTOR .'/elements/general/' . $file . '.php';
                if (file_exists($path)) {
                    require_once $path;
                }
            }
        }
    }

    /**
     * Widgets WooComerce Theme
     */
    public function include_woocommerce_widgets($widgets_manager)
    {
        if (!fana_woocommerce_activated()) {
            return;
        }

        $woo_elements = fana_elementor_woocommerce_widgets();

        foreach ($woo_elements as $file) {
            $addon = 'addon_el_'. str_replace("-","_", $file);
            if( fana_tbay_get_global_config($addon, true) ) {
                $path   = FANA_ELEMENTOR .'/elements/woocommerce/' . $file . '.php';
                if (file_exists($path)) {
                    require_once $path;
                }
            }
        }
    }

    /**
     * Widgets Header Theme
     */
    public function include_header_widgets($widgets_manager)
    {
        $elements = fana_elementor_header_widgets();

        foreach ($elements as $file) {
            $addon = 'addon_el_'. str_replace("-","_", $file);
            if( fana_tbay_get_global_config($addon, true) ) {
                $path   = FANA_ELEMENTOR .'/elements/header/' . $file . '.php';
                if (file_exists($path)) {
                    require_once $path;
                }
            }
        }
    }


    /**
     * Widgets Abstract Theme
     */
    public function include_abstract_widgets($widgets_manager)
    {
        $abstracts = array(
            'image',
            'base',
            'responsive',
            'carousel',
        );

        $abstracts = apply_filters('fana_abstract_elements_array', $abstracts);

        foreach ($abstracts as $file) {
            $path   = FANA_ELEMENTOR .'/abstract/' . $file . '.php';
            if (file_exists($path)) {
                require_once $path;
            }
        }
    }

    public function include_control_customize_widgets()
    {
        $widgets = array(
            'sticky-header',
            'column',
            'button',
            'settings-layout',
            'global-typography',
            'global-colors',
        );

        $widgets = apply_filters('fana_customize_elements_array', $widgets);
 
        foreach ($widgets as $file) {
            $control   = FANA_ELEMENTOR .'/elements/customize/controls/' . $file . '.php';
            if (file_exists($control)) {
                require_once $control;
            }
        }
    }

    public function include_render_customize_widgets()
    {
        $widgets = array(
            'sticky-header',
        );

        $widgets = apply_filters('fana_customize_elements_array', $widgets);
 
        foreach ($widgets as $file) {
            $render    = FANA_ELEMENTOR .'/elements/customize/render/' . $file . '.php';
            if (file_exists($render)) {
                require_once $render;
            }
        }
    }
    public function editor_custom_fonts_theme_groups( $font_groups ) {
        $custom_fonts = array(
            'theme_fonts' => esc_html__( 'Fana Fonts', 'fana' )
        );

        $custom_fonts = array_merge($custom_fonts, $font_groups);
        
        return $custom_fonts;
    }

    public function editor_custom_fonts_theme( $additional_fonts  ) {
        $active_theme = fana_tbay_get_theme();

		$additional_fonts = array();

		switch ($active_theme) {
            case 'bikini':
				$additional_fonts['Ivy Mode'] 	    = 'theme_fonts';
				$additional_fonts['SFU Futura'] 	= 'theme_fonts';
				break;

			case 'vest-suit':
				$additional_fonts['SFU Futura'] 	= 'theme_fonts';
				break;

			case 'sport':
				$additional_fonts['SFU Futura'] 	= 'theme_fonts';
				$additional_fonts['SFU DIN'] 	    = 'theme_fonts';
				break;

			case 'kids':
				$additional_fonts['SFU Futura'] 	= 'theme_fonts';
				$additional_fonts['Baloo'] 	        = 'theme_fonts';
				break;

            default:
				$additional_fonts['Whisper'] 		= 'theme_fonts';
				$additional_fonts['Ivy Mode'] 	    = 'theme_fonts';
				$additional_fonts['SFU Futura'] 	= 'theme_fonts';
                break;
		}

        return $additional_fonts;
    }
    
}

new Fana_Elementor_Addons();
