<?php
if (!function_exists('fana_settings_global_typography_advanced')) {
    function fana_settings_global_typography_advanced($widget, $args)
    {
        $typography_key = Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_GROUP_PREFIX . 'typography';
        $font_family_key = Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_GROUP_PREFIX . 'font_family';
        $font_weight_key = Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_GROUP_PREFIX . 'font_weight';
        $default_typography = [
            [
                '_id' => 'primary',
                'title' => esc_html__('Primary', 'fana'),
                $typography_key => 'custom',
                $font_family_key => 'Default',
                $font_weight_key => '600',
            ], 
            [
                '_id' => 'secondary',
                'title' => esc_html__('Secondary', 'fana'),
                $typography_key => 'custom',
                $font_family_key => 'Default',
                $font_weight_key => '400',
            ],
            [
                '_id' => 'text',
                'title' => esc_html__('Text', 'fana'),
                $typography_key => 'custom',
                $font_family_key => 'Default',
                $font_weight_key => '400',
            ],
            [
                '_id' => 'accent',
                'title' => esc_html__('Accent', 'fana'),
                $typography_key => 'custom',
                $font_family_key => 'Default',
                $font_weight_key => '500',
            ],
        ];
        $widget->update_control(
            'system_typography',
            [
                'default' => $default_typography,
            ] 
        );
    }

    add_action('elementor/element/kit/section_global-typography/before_section_end', 'fana_settings_global_typography_advanced', 10, 2);
}
