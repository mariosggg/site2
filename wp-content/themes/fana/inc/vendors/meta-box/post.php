<?php
if (!function_exists('fana_register_post_meta_boxes')) {
    add_filter( 'rwmb_meta_boxes', 'fana_register_post_meta_boxes' );
    function fana_register_post_meta_boxes($meta_boxes)
    {
        $prefix = 'tbay_post_';
        $fields = array(
            array(
                'id'               => "{$prefix}gallery_files",
                'name'             => esc_html__('Images Gallery', 'fana'),
                'type'             => 'image_advanced',
                'force_delete'     => false,
                'max_file_uploads' => 10,
                'max_status'       => false,
                'image_size'       => 'thumbnail',
            ),
            array(
                'id'   => "{$prefix}video_link",
                'name' => esc_html__('Video Link', 'fana'),
                'type' => 'oembed',
            ),
            array(
                'id'   => "{$prefix}audio_link",
                'name' => esc_html__('Audio Link', 'fana'),
                'type' => 'oembed',
            ),
        );
        
        $meta_boxes[$prefix . 'format_setting'] = array(
            'id'                        => 'post_format_standard_post_meta',
            'title'                     => esc_html__('Format Setting', 'fana'),
            'post_types'                => array( 'post' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'autosave'                  => true,
            'fields'                    => $fields
        );

        return $meta_boxes;
    }
}
