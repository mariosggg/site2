<?php

if (! defined('ABSPATH') || function_exists('Fana_Elementor_Mini_Cart')) {
    exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

class Fana_Elementor_Mini_Cart extends Fana_Elementor_Widget_Base
{
    protected $nav_menu_index = 1;

    public function get_name()
    {
        return 'tbay-mini-cart';
    }

    public function get_title()
    {
        return esc_html__('Fana Mini Cart', 'fana');
    }

    public function get_icon()
    {
        return 'eicon-cart-medium';
    }
    
    protected function get_html_wrapper_class()
    {
        return 'w-auto elementor-widget-' . $this->get_name();
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Mini Cart', 'fana'),
            ]
        );

        $this->add_control(
            'heading_mini_cart',
            [
                'label' => esc_html__('Mini Cart', 'fana'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'icon_mini_cart',
            [
                'label'              => esc_html__('Icon', 'fana'),
                'type'               => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'tb-icon tb-icon-bag-happy',
                    'library' => 'tbay-custom',
                ],
            ]
        );
        $this->add_control(
            'icon_mini_cart_size',
            [
                'label' => esc_html__('Font Size Icon', 'fana'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .cart-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'show_title_mini_cart',
            [
                'label'              => esc_html__('Display Title "Mini-Cart"', 'fana'),
                'type'               => Controls_Manager::SWITCHER,
                'default' => ''
            ]
        );
        $this->add_control(
            'title_mini_cart',
            [
                'label'              => esc_html__('"Mini-Cart" Title', 'fana'),
                'type'               => Controls_Manager::TEXT,
                'default'            => esc_html__('Shopping cart', 'fana'),
                'condition'          => [
                    'show_title_mini_cart' => 'yes'
                ]
            ]
        );
        
        $this->add_control(
            'price_mini_cart',
            [
                'label'              => esc_html__('Show "Mini-Cart" Price', 'fana'),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'separator'    => 'after',
            ]
        );


        $this->end_controls_section();
        $this->register_section_style_icon();
        $this->register_section_style_text();
        $this->register_section_style_total();
        $this->register_section_style_popup_cart();
        $this->register_section_style_price();
    }


    protected function register_section_style_icon()
    {
        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__('Style Icon', 'fana'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'margin_icon_cart',
            [
                'label'     => esc_html__('Margin Icon Cart', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .cart-dropdown .cart-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_style_icon');

        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => esc_html__('Normal', 'fana'),
            ]
        );

        $this->add_control(
            'color_icon',
            [
                'label'     => esc_html__('Color', 'fana'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .cart-icon'    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'bg_icon',
            [
                'label'     => esc_html__('Background Color', 'fana'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .cart-icon'    => 'background-color: {{VALUE}}',
                ],
            ]
        );

        

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => esc_html__('Hover', 'fana'),
            ]
        );
        $this->add_control(
            'hover_color_icon',
            [
                'label'     => esc_html__('Color', 'fana'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .cart-icon:hover'    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'hover_bg_icon',
            [
                'label'     => esc_html__('Background Color', 'fana'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .cart-icon:hover'    => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function register_section_style_text()
    {
        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__('Style Text', 'fana'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title_mini_cart' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'margin_text_cart',
            [
                'label'     => esc_html__('Margin Text Cart', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .cart-dropdown .text-cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('tabs_style_text');

        $this->start_controls_tab(
            'tab_text_normal',
            [
                'label' => esc_html__('Normal', 'fana'),
            ]
        );
        $this->add_control(
            'color_text',
            [
                'label'     => esc_html__('Color', 'fana'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .text-cart'    => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_text_hover',
            [
                'label' => esc_html__('Hover', 'fana'),
            ]
        );
        $this->add_control(
            'hover_color_text',
            [
                'label'     => esc_html__('Color', 'fana'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .text-cart:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function register_section_style_popup_cart()
    {
        $this->start_controls_section(
            'section_style_popup_cart',
            [
                'label' => esc_html__('Style Popup', 'fana'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_popup',
                'selector' => '{{WRAPPER}} .cart-popup.show .dropdown-menu',
            ]
        );
        $this->add_control(
            'border_radius_popup_cart',
            [
                'label'     => esc_html__('Border Radius', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .cart-popup.show .dropdown-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'position_popup_cart',
            [
                'label' => esc_html__('Position Popup', 'fana'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ,'%'],
                'selectors' => [
                    '{{WRAPPER}} .cart-popup .dropdown-menu.show'=> 'inset: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} auto auto !important;',
                    '.rtl {{WRAPPER}} .cart-popup .dropdown-menu.show'=> 'inset: {{TOP}}{{UNIT}} auto auto {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
       
        $this->end_controls_section();
    }
    protected function register_section_style_price()
    {
        $this->start_controls_section(
            'section_style_price_cart',
            [
                'label' => esc_html__('Style Price', 'fana'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'price_mini_cart' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'cart_price_margin',
            [
                'label'     => esc_html__('Margin', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .subtotal .woocommerce-Price-amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cart_price_typography',
                'selector' => '{{WRAPPER}} .subtotal .woocommerce-Price-amount',
            ]
        );

        $this->start_controls_tabs('tabs_style_price');

        $this->start_controls_tab(
            'tab_price_normal',
            [
                'label' => esc_html__('Normal', 'fana'),
            ]
        );

        $this->add_control(
            'color_cart_price',
            [
                'label'     => esc_html__('Color', 'fana'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .subtotal .woocommerce-Price-amount' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_price_hover',
            [
                'label' => esc_html__('Hover', 'fana'),
            ]
        );

        $this->add_control(
            'color_cart_price_hover',
            [
                'label'     => esc_html__('Color', 'fana'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .subtotal .woocommerce-Price-amount:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }

    private function register_section_style_total()
    {
        $this->start_controls_section(
            'section_style_total',
            [
                'label' => esc_html__('Style Total', 'fana'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cart_total_typography',
                'selector' => '{{WRAPPER}} .cart-icon span.mini-cart-items',
            ]
        );

        
        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'fana'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cart-icon span.mini-cart-items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color_number',
            [
                'label'     => esc_html__('Color', 'fana'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-icon span.mini-cart-items'    => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'bg_total',
            [
                'label'     => esc_html__('Background', 'fana'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-icon span.mini-cart-items'    => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'position_top',
            [
                'label'     => esc_html__('Position Top', 'fana'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -20,
                        'max' => 40,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cart-icon span.mini-cart-items' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'position_left',
            [
                'label'     => esc_html__('Position Left', 'fana'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 40,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cart-icon span.mini-cart-items' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render_woocommerce_mini_cart()
    {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $args = [
            'icon_mini_cart'                 => $icon_mini_cart,
            'show_title_mini_cart'           => $show_title_mini_cart,
            'title_mini_cart'                => $title_mini_cart,
            'price_mini_cart'                => $price_mini_cart,
        ];
        
        fana_tbay_get_woocommerce_mini_cart($args);
    }
}
$widgets_manager->register(new Fana_Elementor_Mini_Cart());
