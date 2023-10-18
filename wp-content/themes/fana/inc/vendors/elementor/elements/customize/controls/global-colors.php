<?php
if (!function_exists('fana_settings_global_colors_advanced')) {
    function fana_settings_global_colors_advanced($widget, $args)
    {
		$active_theme = fana_tbay_get_theme();

		switch ($active_theme) {
			case 'vest-suit':
				$default_colors_primary = [
					[
						'_id' => 'primary',
						'title' => esc_html__( 'Primary', 'fana' ),
						'color' => '#EDB658',
					],
				];
				break; 

			case 'bikini':
				$default_colors_primary = [
					[
						'_id' => 'primary',
						'title' => esc_html__( 'Primary', 'fana' ),
						'color' => '#ca6d6f',
					],
				];
				break; 

			case 'sport':
				$default_colors_primary = [
					[
						'_id' => 'primary',
						'title' => esc_html__( 'Primary', 'fana' ),
						'color' => '#CFEE10',
					],
				];
				break; 

			
			case 'kids':
				$default_colors_primary = [
					[
						'_id' => 'primary',
						'title' => esc_html__( 'Primary', 'fana' ),
						'color' => '#FC4CA5',
					],
				];
				break; 

			default:
				$default_colors_primary = [
					[
						'_id' => 'primary',
						'title' => esc_html__( 'Primary', 'fana' ),
						'color' => '#2F4799',
					],
				];
		}

		if( $active_theme == 'kids' ) {
			$default_colors_secondary = [
				[
					'_id' => 'secondary',
					'title' => esc_html__( 'Secondary', 'fana' ),
					'color' => '#060C8F',
				],
			];
		} else {
			$default_colors_secondary = [
				[
					'_id' => 'secondary',
					'title' => esc_html__( 'Secondary', 'fana' ),
					'color' => '#CA6D6F',
				],
			];
		}

		
		$default_colors = [
			[
				'_id' => 'text',
				'title' => esc_html__( 'Text', 'fana' ),
				'color' => '#121216',
			],
			[
				'_id' => 'accent',
				'title' => esc_html__( 'Border', 'fana' ),
				'color' => '#DDDDDD',
			],
		];


		$default_colors = array_merge($default_colors_primary, $default_colors_secondary, $default_colors);

        $widget->update_control(
            'system_colors',
            [
                'default' => $default_colors,
            ] 
        );
    }

    add_action('elementor/element/kit/section_global_colors/before_section_end', 'fana_settings_global_colors_advanced', 10, 2);
}