<?php

if (!fana_woocommerce_activated()) {
    return;
}

// First Register the Tab by hooking into the 'woocommerce_product_data_tabs' filter
if (! function_exists('fana_add_custom_product_data_tab')) {
    add_filter('woocommerce_product_data_tabs', 'fana_add_custom_product_data_tab', 80);
    function fana_add_custom_product_data_tab($product_data_tabs)
    {
        $product_data_tabs['fana-options-tab'] = array(
          'label' => esc_html__('Fana Options', 'fana'),
          'target' => 'fana_product_data',
          'class'     => array(),
          'priority' => 100,
      );
        return $product_data_tabs;
    }
}

if (! function_exists('fana_options_woocom_product_data_fields')) {
    // functions you can call to output text boxes, select boxes, etc.
    add_action('woocommerce_product_data_panels', 'fana_options_woocom_product_data_fields');

    function fana_options_woocom_product_data_fields()
    {
        global $post;

        $args_subtitle = apply_filters( 'hara_woocommerce_subtitle_args', array(
            'id'          => '_subtitle',
            'label'       => esc_html__('Subtitle', 'fana'),
            'placeholder' => esc_html__('Subtitle....', 'fana'),
            'description' => esc_html__('Enter the subtitle.', 'fana')
        ));

        $args_video = apply_filters( 'fana_woocommerce_url_video_args', array(
            'id' => '_fana_video_url',
            'label' => esc_html__('Featured Video URL', 'fana'),
            'placeholder' => esc_html__('Video URL', 'fana'),
            'desc_tip' => true,
            'description' => esc_html__('Enter the video url at https://vimeo.com/ or https://www.youtube.com/', 'fana')
        ));

        $args_size_guide_type =  apply_filters( 'fana_woocommerce_size_guide_type_args', array(
            'id'          => '_fana_size_guide_type',
            'label'       => esc_html__( 'Size Guide Type', 'fana' ),
            'options'     => array(
              'global'     => esc_html__( 'Global Setting', 'fana' ),
              'customize' => esc_html__( 'Customize', 'fana' ),
            ),
            'desc_tip'    => true,
            'description' => esc_html__( 'Global Setting is to choose Size Guide on the theme option', 'fana' ),
          ));
    
          $args_size_guide =  apply_filters( 'fana_woocommerce_size_guide_args', array(
            'id'          => '_fana_size_guide', 
            'desc_tip'    => true,
            'label'       => esc_html__( 'Size Guide Customize', 'fana' ),
            'description' => esc_html__( 'Enter an optional shortcode or cusom text', 'fana' ),
            'wrapper_class'     => 'show_size_guide_customize',
          ));
    
          $args_delivery_type =  apply_filters( 'fana_woocommerce_delivery_return_type_args', array(
            'id'          => '_fana_delivery_return_type',
            'label'       => esc_html__( 'Delivery Return Type', 'fana' ),
            'options'     => array(
              'global'     => esc_html__( 'Global Setting', 'fana' ),
              'customize' => esc_html__( 'Customize', 'fana' ),
            ),
            'desc_tip'    => true,
            'description' => esc_html__( 'Global Setting is to choose Delivery Return on the theme option', 'fana' ),
          ));
    
          $args_delivery =  apply_filters( 'fana_woocommerce_delivery_return_args', array(
            'id'          => '_fana_delivery_return', 
            'desc_tip'    => true,
            'label'       => esc_html__( 'Delivery Return Customize', 'fana' ),
            'description' => esc_html__( 'Enter an optional shortcode or cusom text', 'fana' ),
            'wrapper_class'     => 'show_delivery_return_customize',
          ));
    
          $args_custom_tab_name =  apply_filters( 'fana_woocommerce_custom_tab_name_args', array(
            'id'            => '_fana_custom_tab_name',
            'label'         => esc_html__( 'Custom Tab Name', 'fana' ),
            'type'          => 'text',
          ));
    
          $args_custom_tab_content =  apply_filters( 'fana_woocommerce_custom_tab_content_args', array(
            'id'          => '_fana_custom_tab_content', 
            'desc_tip'      => true,
            'label'       => esc_html__( 'Custom Tab Content', 'fana' ),
            'description' => esc_html__( 'Enter an optional shortcode or cusom text', 'fana' ),
          ));
    
          $args_custom_tab_priority =  apply_filters( 'fana_woocommerce_custom_tab_priority_args', array(
            'id'                => '_fana_custom_tab_priority',
            'label'             => esc_html__('Custom Tab priority', 'fana'),
            'desc_tip'          => true,
            'type'              => 'number',
            'description' => esc_html__('Description – 10, </br>Additional information – 20, </br>Reviews – 30', 'fana'),
            'custom_attributes' => array(
                'step' => 'any',
            ),
          ));

        // Note the 'id' attribute needs to match the 'target' parameter set above
    ?> <div id='fana_product_data' class='panel woocommerce_options_panel'> <?php
        echo '<div class ="options_group">'. woocommerce_wp_text_input( $args_subtitle ). woocommerce_wp_text_input( $args_video ) .'</div>';

        echo '<div class ="options_group">'. woocommerce_wp_text_input( $args_custom_tab_name ) . woocommerce_wp_textarea_input( $args_custom_tab_content ) . woocommerce_wp_text_input( $args_custom_tab_priority ) .'</div>';

        echo '<div class ="options_group">'. woocommerce_wp_select($args_size_guide_type). woocommerce_wp_textarea_input( $args_size_guide ) .'</div>';

        echo '<div class ="options_group">'. woocommerce_wp_select($args_delivery_type). woocommerce_wp_textarea_input( $args_delivery ) .'</div>';
        ?> 
        <?php do_action( 'fana_woocommerce_options_product_data' ); ?>
    </div><?php
    }
}
// class hide sub title product
if (!function_exists('fana_tbay_woocommerce_hide_sub_title')) {
    function fana_tbay_woocommerce_hide_sub_title($active)
    {
        $active = fana_tbay_get_config('enable_hide_sub_title_product', false);

        $active = (isset($_GET['hide_sub_title'])) ? $_GET['hide_sub_title'] : $active;

        return $active;
    }
}
add_filter('fana_hide_sub_title', 'fana_tbay_woocommerce_hide_sub_title');

if (! function_exists('fana_woo_subtitle_field_save')) {
    function fana_woo_subtitle_field_save($post_id)
    {
        $subtitle = isset( $_POST['_subtitle'] ) ? wc_clean( wp_unslash( $_POST['_subtitle'] ) ) : '';
        if (isset($subtitle)) {
            update_post_meta($post_id, '_subtitle', esc_attr($subtitle));
        }
    }
    add_action('woocommerce_process_product_meta', 'fana_woo_subtitle_field_save');
}

if (! function_exists('fana_woo_get_subtitle')) {
    function fana_woo_get_subtitle()
    {
        if (apply_filters('fana_hide_sub_title', 10, 2)) {
            return;
        }
      
        global $product;

        $_subtitle = get_post_meta($product->get_id(), '_subtitle', true);
        if (!($_subtitle == null || $_subtitle == '')) {
            echo '<div class="tbay-subtitle">'. trim($_subtitle) .'</div>';
        }
    }

    add_action('fana_after_title_tbay_subtitle', 'fana_woo_get_subtitle', 0);
}

if (! function_exists('fana_options_woocom_save_proddata_custom_fields')) {
    /** Hook callback function to save custom fields information */
    function fana_options_woocom_save_proddata_custom_fields($product)
    {
        $video_url = isset($_POST['_fana_video_url']) ? wp_unslash($_POST['_fana_video_url']) : '';
        $old_value_url = $product->get_meta('_fana_video_url');

        if ($video_url !== $old_value_url) {
            $product->update_meta_data('_fana_video_url', $video_url);
            $img_id = '';
            if (! empty($video_url)) {
                $video_info = explode(':', fana_video_type_by_url($video_url));
                $img_id     = fana_save_video_thumbnail(array(
                        'host' => $video_info[0],
                        'id'   => $video_info[1]
                    ));
            }
            $product->update_meta_data('_fana_video_image_url', $img_id);
        }

        $tab_name        = isset( $_POST['_fana_custom_tab_name'] ) ? wc_clean( wp_unslash( $_POST['_fana_custom_tab_name'] ) ) : '';
        $old_tab_name    = $product->get_meta('_fana_custom_tab_name');
            
        $tab_content        = isset( $_POST['_fana_custom_tab_content'] ) ? wp_kses_post( wp_unslash( $_POST['_fana_custom_tab_content'] ) ) : '';
        $old_tab_content    = $product->get_meta('_fana_custom_tab_content');
      
        $tab_priority = isset( $_POST['_fana_custom_tab_priority'] ) ? wc_clean( wp_unslash( $_POST['_fana_custom_tab_priority'] ) ) : '';
        $old_tab_priority = $product->get_meta('_fana_custom_tab_priority');
      
        $size_guide_type           = isset($_POST['_fana_size_guide_type']) ? wp_unslash($_POST['_fana_size_guide_type']) : '';
        $old_size_guide_type       = $product->get_meta('_fana_size_guide_type');

        $size_guide                = isset($_POST['_fana_size_guide']) ? wp_unslash($_POST['_fana_size_guide']) : '';
        $old_size_guide            = $product->get_meta('_fana_size_guide');

        $delivery_return_type                = isset($_POST['_fana_delivery_return_type']) ? wp_unslash($_POST['_fana_delivery_return_type']) : '';
        $old_delivery_return_type            = $product->get_meta('_fana_delivery_return_type');
        
        $delivery_return                = isset($_POST['_fana_delivery_return']) ? wp_unslash($_POST['_fana_delivery_return']) : '';
        $old_delivery_return            = $product->get_meta('_fana_delivery_return');

        if ($tab_name !== $old_tab_name) {
            $product->update_meta_data('_fana_custom_tab_name', $tab_name);
        }

        if ($tab_content !== $old_tab_content) {
            $product->update_meta_data('_fana_custom_tab_content', $tab_content);
        }
      
        if ($tab_priority !== $old_tab_priority) {
            $product->update_meta_data('_fana_custom_tab_priority', $tab_priority);
        }

        if ($size_guide_type !== $old_size_guide_type) {
            $product->update_meta_data('_fana_size_guide_type', $size_guide_type);
        }
  
        if ($size_guide !== $old_size_guide) {
            $product->update_meta_data('_fana_size_guide', $size_guide);
        }
  
        if ($delivery_return_type !== $old_delivery_return_type) {
            $product->update_meta_data('_fana_delivery_return_type', $delivery_return_type);
        }
   
        if ($delivery_return !== $old_delivery_return) {
            $product->update_meta_data('_fana_delivery_return', $delivery_return);
        }
    }

    add_action('woocommerce_admin_process_product_object', 'fana_options_woocom_save_proddata_custom_fields', 20);
}


function fana_save_video_thumbnail($video_info)
{
    $name = isset($video_info['name']) ? $video_info['name'] : $video_info['id'];
    switch ($video_info['host']) {

    case 'vimeo':
      if (function_exists('simplexml_load_file')) {
          $img_url = 'http://vimeo.com/api/v2/video/' . $video_info['id'] . '.xml';
          $xml     = simplexml_load_file($img_url);

          $img_url = isset($xml->video->thumbnail_large) ? (string) $xml->video->thumbnail_large : '';

          if (! empty($img_url)) {
              $tmp = getimagesize($img_url);

              if (! is_wp_error($tmp)) {
                  $result = 'ok';
              }
          }
      }
      break;
    case 'youtube':
      $youtube_image_sizes = array(
        'maxresdefault',
        'hqdefault',
        'mqdefault',
        'sqdefault'
      );

      $youtube_url = 'https://img.youtube.com/vi/' . $video_info['id'] . '/';
      foreach ($youtube_image_sizes as $image_size) {
          $img_url      = $youtube_url . $image_size . '.jpg';
          $get_response = wp_remote_get($img_url);
          $result = $get_response['response']['code'] == '200' ? 'ok' : 'no';
          if ($result == 'ok') {
              break;
          }
      }

      break;
  }

    $img_id = '';

    if ('ok' === $result) {
        $img_id = fana_save_remote_image($img_url, $name);
    }

    return $img_id;
}

if (! function_exists('fana_save_remote_image')) {
    function fana_save_remote_image($url, $newfile_name = '')
    {
        $url = str_replace('https', 'http', $url);
        $tmp = download_url((string) $url);

        $file_array = array();
        preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', (string) $url, $matches);
        $file_name = basename($matches[0]);
        if ('' !== $newfile_name) {
            $file_name_info = explode('.', $file_name);
            $file_name      = $newfile_name . '.' . $file_name_info[1];
        }

        if (! function_exists('remove_accents')) {
            require_once ABSPATH . 'wp-includes/formatting.php';
        }

        $file_name = sanitize_file_name(remove_accents($file_name));
        $file_name = str_replace('-', '_', $file_name);

        $file_array['name']     = $file_name;
        $file_array['tmp_name'] = $tmp;

        // If error storing temporarily, unlink
        if (is_wp_error($tmp)) {
            @unlink($file_array['tmp_name']);
            $file_array['tmp_name'] = '';
        }

        // do the validation and storage stuff
        return media_handle_sideload($file_array, 0);
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Dropdown
 * ------------------------------------------------------------------------------------------------
 */
//Dropdown template
if (! function_exists('tbay_swatch_attribute_template')) {
    function tbay_swatch_attribute_template($post)
    {
        global $post;


        $attribute_post_id = get_post_meta($post->ID, '_fana_attribute_select');
        $attribute_post_id = isset($attribute_post_id[0]) ? $attribute_post_id[0] : ''; ?>

          <select name="fana_attribute_select" class="fana_attribute_taxonomy">
            <option value="" selected="selected"><?php esc_html_e('Global Setting', 'fana'); ?></option>

              <?php

                global $wc_product_attributes;

        // Array of defined attribute taxonomies.
        $attribute_taxonomies = wc_get_attribute_taxonomies();

        if (! empty($attribute_taxonomies)) {
            foreach ($attribute_taxonomies as $tax) {
                $attribute_taxonomy_name = wc_attribute_taxonomy_name($tax->attribute_name);
                $label                   = $tax->attribute_label ? $tax->attribute_label : $tax->attribute_name;

                echo '<option value="' . esc_attr($attribute_taxonomy_name) . '" '. selected($attribute_post_id, $attribute_taxonomy_name) .' >' . esc_html($label) . '</option>';
            }
        } ?>

          </select>

        <?php
    }
}


//Dropdown Save
if (! function_exists('fana_attribute_dropdown_save')) {
    add_action('woocommerce_process_product_meta', 'fana_attribute_dropdown_save', 30, 2);

    function fana_attribute_dropdown_save($post_id)
    {
        if (isset($_POST['fana_attribute_select'])) {
            update_post_meta($post_id, '_fana_attribute_select', $_POST['fana_attribute_select']);
        }
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Dropdown
 * ------------------------------------------------------------------------------------------------
 */
//Dropdown Single layout template
if (! function_exists('tbay_single_select_single_layout_template')) {
    function tbay_single_select_single_layout_template($post)
    {
        global $post;


        $layout_post_id = get_post_meta($post->ID, '_fana_single_layout_select');
        $layout_post_id = isset($layout_post_id[0]) ? $layout_post_id[0] : ''; ?>

          <select name="fana_layout_select" class="fana_single_layout_taxonomy">
              <?php
                $layout_selects = apply_filters('fana_layout_select_filters', array(
                    ''                      => esc_html__('Global Setting', 'fana'),
                    'horizontal-bottom'     => esc_html__('Image Horizontal Bottom', 'fana'),
                    'horizontal-top'        => esc_html__('Image Horizontal Top', 'fana'),
                    'vertical-left'         => esc_html__('Image Vertical Left', 'fana'),
                    'vertical-right'        => esc_html__('Image Vertical Right', 'fana'),
                    'stick'                 => esc_html__('Image Stick', 'fana'),
                    'gallery'               => esc_html__('Image Gallery', 'fana'),
                    'left-main'             => esc_html__('Left - Main Sidebar', 'fana'),
                    'main-right'            => esc_html__('Main - Right Sidebar', 'fana')
                  ));
 
                foreach ($layout_selects as $key => $select) {
                    echo '<option value="' . esc_attr($key) . '" '. selected($layout_post_id, $key, false) .' >' . esc_html($select) . '</option>';
                } ?>

          </select>

        <?php
    }
}


//Dropdown Save
if (! function_exists('fana_single_select_dropdown_save')) {
    add_action('woocommerce_process_product_meta', 'fana_single_select_dropdown_save', 30, 2);

    function fana_single_select_dropdown_save($post_id)
    {
        if (isset($_POST['fana_layout_select'])) {
            update_post_meta($post_id, '_fana_single_layout_select', $_POST['fana_layout_select']);
        }
    }
}
