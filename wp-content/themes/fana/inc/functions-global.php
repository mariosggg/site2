<?php

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Fana 1.0
 */
define('FANA_THEME_VERSION', '1.0');

/**
 * ------------------------------------------------------------------------------------------------
 * Define constants.
 * ------------------------------------------------------------------------------------------------
 */
define('FANA_THEME_DIR', get_template_directory_uri());
define('FANA_THEMEROOT', get_template_directory());
define('FANA_IMAGES', FANA_THEME_DIR . '/images');
define('FANA_SCRIPTS', FANA_THEME_DIR . '/js');

define('FANA_STYLES', FANA_THEME_DIR . '/css');

define('FANA_INC', 'inc');
define('FANA_MERLIN', FANA_INC . '/merlin');
define('FANA_CLASSES', FANA_INC . '/classes');
define('FANA_VENDORS', FANA_INC . '/vendors');
define('FANA_CONFIG', FANA_VENDORS . '/redux-framework/config');
define('FANA_WOOCOMMERCE', FANA_VENDORS . '/woocommerce');
define('FANA_ELEMENTOR', FANA_THEMEROOT . '/inc/vendors/elementor');
define('FANA_ELEMENTOR_TEMPLATES', FANA_THEMEROOT . '/elementor_templates');
define('FANA_PAGE_TEMPLATES', FANA_THEMEROOT . '/page-templates');
define('FANA_WIDGETS', FANA_INC . '/widgets');

define('FANA_ASSETS', FANA_THEME_DIR . '/inc/assets');
define('FANA_ASSETS_IMAGES', FANA_ASSETS    . '/images');

define('FANA_MIN_JS', '');

define('TBAY_DISCOUNT_CAMPAIGN', true);

if (! isset($content_width)) {
    $content_width = 660;
}

function fana_tbay_get_config($name, $default = '')
{
    global $fana_options;
    if (isset($fana_options[$name])) {
        return $fana_options[$name];
    }
    return $default;
}

function fana_tbay_get_global_config($name, $default = '')
{
    $options = get_option('fana_tbay_theme_options', array());
    if (isset($options[$name])) {
        return $options[$name];
    }
    return $default;
}
