<?php
/**
 * Templates Name: Elementor
 * Widget: Banner
 */

$settings = $this->get_settings_for_display();

// Link settings.
if ($settings['link'] && $settings['link']['url']) {
    $this->add_render_attribute('wrapper', 'class', 'cursor-pointer');
}
if (isset($settings['link']['is_external']) && 'on' === $settings['link']['is_external']) {
    $onclick = 'window.open(\'' . esc_url($settings['link']['url']) . '\',\'_blank\')';
} else {
    $onclick = 'window.location.href=\'' . esc_url($settings['link']['url']) . '\'';
}
$this->add_render_attribute('wrapper', 'class', 'effect-'. $settings['banner_effects']); 
?>
<div <?php echo $this->get_render_attribute_string('wrapper'); ?> <?php echo (! fana_elementor_is_edit_mode() && $settings['link']['url']) ? 'onclick="' . esc_attr($onclick) . '"' : ''; ?>>
    <?php $this->render_item_image(); ?>
    <?php $this->render_item_content(); ?>
</div>