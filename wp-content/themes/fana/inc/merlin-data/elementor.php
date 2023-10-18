<?php

class Fana_Merlin_Elementor
{
    public function import_files_demo_default()
    {
        $rev_sliders = array(
            "http://demosamples.thembay.com/fana/default/revslider/slider-1.zip",
        );
    
        $data_url = "http://demosamples.thembay.com/fana/default/data.xml";
        $widget_url = "http://demosamples.thembay.com/fana/default/widgets.wie";
        

        return array(
            array(
                'import_file_name'           => 'Demo Default Home 1',
                'home'                       => 'home',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/default/home1/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/default/home1/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana/',
            ),
            array(
                'import_file_name'           => 'Demo Default Home 2',
                'home'                       => 'home-2',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/default/home2/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/default/home2/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana/home-2/',
            ),
        );
    }

    public function import_files_demo_vest()
    {
        $rev_sliders = array(
            "http://demosamples.thembay.com/fana/vest/revslider/slider-1.zip",
        );
    
        $data_url = "http://demosamples.thembay.com/fana/vest/data.xml";
        $widget_url = "http://demosamples.thembay.com/fana/vest/widgets.wie";
        

        return array(
            array(
                'import_file_name'           => 'Demo Vest Suit',
                'home'                       => 'home',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/vest/home1/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/vest/home1/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_vest/',
            ),
        );
    }

    
    public function import_files_demo_bikini()
    {
        $rev_sliders = array(
            "http://demosamples.thembay.com/fana/bikini/revslider/slider-1.zip",
            "http://demosamples.thembay.com/fana/bikini/revslider/slider-2.zip",
            "http://demosamples.thembay.com/fana/bikini/revslider/slider-3.zip",
        );
    
        $data_url = "http://demosamples.thembay.com/fana/bikini/data.xml";
        $widget_url = "http://demosamples.thembay.com/fana/bikini/widgets.wie";
        

        return array(
            array(
                'import_file_name'           => 'Demo Bikini Home 1',
                'home'                       => 'home',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/bikini/home1/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/bikini/home1/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_bikini/',
            ),
            array(
                'import_file_name'           => 'Demo Bikini Home 2',
                'home'                       => 'home-2',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/bikini/home2/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/bikini/home2/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_bikini/home-2/',
            ),
        );
    }

    public function import_files_demo_sport()
    {
        $rev_sliders = array(
            "http://demosamples.thembay.com/fana/sport/revslider/slider-1.zip",
            "http://demosamples.thembay.com/fana/sport/revslider/slider-2.zip",
        );
    
        $data_url = "http://demosamples.thembay.com/fana/sport/data.xml";
        $widget_url = "http://demosamples.thembay.com/fana/sport/widgets.wie";
        

        return array(
            array(
                'import_file_name'           => 'Demo Sport Home 1',
                'home'                       => 'home',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/sport/home1/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/sport/home1/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_sport/',
            ),
            array(
                'import_file_name'           => 'Demo Sport Home 2',
                'home'                       => 'home-2',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/sport/home2/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/sport/home2/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_sport/home-2/',
            ),
        );
    }

    public function import_files_demo_kids()
    {
        $rev_sliders = array(
            "http://demosamples.thembay.com/fana/kids/revslider/slider-1.zip",
            "http://demosamples.thembay.com/fana/kids/revslider/slider-2.zip",
        );
    
        $data_url = "http://demosamples.thembay.com/fana/kids/data.xml";
        $widget_url = "http://demosamples.thembay.com/fana/kids/widgets.wie";
        

        return array(
            array(
                'import_file_name'           => 'Demo Kids Home 1',
                'home'                       => 'home',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/kids/home1/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/kids/home1/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_kids/',
            ),
            array(
                'import_file_name'           => 'Demo Kids Home 2',
                'home'                       => 'home-2',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/kids/home2/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/kids/home2/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_kids/home-2/',
            ),
        );
    }

    public function import_files_demo_dark()
    {
        $rev_sliders = array(
            "http://demosamples.thembay.com/fana/dark/revslider/slider-1.zip",
        );
    
        $data_url = "http://demosamples.thembay.com/fana/dark/data.xml";
        $widget_url = "http://demosamples.thembay.com/fana/dark/widgets.wie";
        

        return array(
            array(
                'import_file_name'           => 'Demo Dark Mode',
                'home'                       => 'home',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/dark/home1/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/dark/home1/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_dark/',
            ),
        );
    }



    public function import_files_demo_rtl()
    {
        $rev_sliders = array(
            "http://demosamples.thembay.com/fana/demo-rtl/revslider/slider-rtl.zip",
        );
    
        $data_url = "http://demosamples.thembay.com/fana/demo-rtl/data.xml";
        $widget_url = "http://demosamples.thembay.com/fana/demo-rtl/widgets.wie";
        

        return array(
            array(
                'import_file_name'           => 'Demo RTL Home 1',
                'home'                       => 'home',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/demo-rtl/home1/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/demo-rtl/home1/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_rtl/',
            ),
            array(
                'import_file_name'           => 'Demo RTL Home 2',
                'home'                       => 'home-2',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/demo-rtl/home2/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/demo-rtl/home2/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_rtl/home-2/',
            ),
        );
    }

    public function import_files_demo_dokan()
    {
        $rev_sliders = array(
            "http://demosamples.thembay.com/fana/dokan/revslider/slider-1.zip",
        );
    
        $data_url = "http://demosamples.thembay.com/fana/dokan/data.xml";
        $widget_url = "http://demosamples.thembay.com/fana/dokan/widgets.wie";
        

        return array(
            array(
                'import_file_name'           => 'Demo Dokan Home 1',
                'home'                       => 'home',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/dokan/home1/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/home1/dokan/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_dokan/',
            ),
            array(
                'import_file_name'           => 'Demo Dokan Home 2',
                'home'                       => 'home-2',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/dokan/home2/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/dokan/home2/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_dokan/home-2/',
            ),
        );
    }

    public function import_files_demo_mvx()
    {
        $rev_sliders = array(
            "http://demosamples.thembay.com/fana/mvx/revslider/slider-1.zip",
        );
    
        $data_url = "http://demosamples.thembay.com/fana/mvx/data.xml";
        $widget_url = "http://demosamples.thembay.com/fana/mvx/widgets.wie";
        

        return array(
            array(
                'import_file_name'           => 'Demo MultiVendorX Home 1',
                'home'                       => 'home',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/mvx/home1/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/mvx/home1/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_mvx/',
            ),
            array(
                'import_file_name'           => 'Demo MultiVendorX Home 2',
                'home'                       => 'home',
                'import_file_url'          	 => $data_url,
                'import_widget_file_url'     => $widget_url,
                'import_redux'         => array(
                    array(
                        'file_url'   => "http://demosamples.thembay.com/fana/mvx/home2/redux_options.json",
                        'option_name' => 'fana_tbay_theme_options',
                    ),
                ),
                'rev_sliders'                => $rev_sliders,
                'import_preview_image_url'   => "http://demosamples.thembay.com/fana/mvx/home2/screenshot.jpg",
                'import_notice'              => esc_html__('After you import this demo, you will have to setup the slider separately.', 'fana'),
                'preview_url'                => 'https://el4.thembaydev.com/fana_mvx/home-2/',
            ),
        );
    }
}
