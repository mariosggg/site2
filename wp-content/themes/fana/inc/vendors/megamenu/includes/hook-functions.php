<?php

defined( 'ABSPATH' ) || exit();

add_filter( 'elementor/editor/footer', 'fana_megamenu_add_back_button_inspector' );
function fana_megamenu_add_back_button_inspector() {
	if ( ! isset( $_GET['fana-menu-editable'] ) || ! $_GET['fana-menu-editable'] ) {
		return;
	}
	?>
		<script type="text/javascript">
            (function($){
                 $( '#tmpl-elementor-panel-footer-content' ).remove();
            })(jQuery);
        </script>
        <script type="text/template" id="tmpl-elementor-panel-footer-content">
            <div id="elementor-panel-footer-back-to-admin" class="elementor-panel-footer-tool elementor-leave-open tooltip-target" data-tooltip="<?php esc_attr_e( 'Back', 'fana' ); ?>">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>
			</div>
			<div id="elementor-panel-footer-responsive" class="elementor-panel-footer-tool">
				<i class="eicon-device-desktop tooltip-target" aria-hidden="true" data-tooltip="<?php esc_attr_e( 'Responsive Mode', 'fana' ); ?>"></i>
				<span class="elementor-screen-only">
					<?php echo esc_html__( 'Responsive Mode', 'fana' ); ?>
				</span>
				<div class="elementor-panel-footer-sub-menu-wrapper">
					<div class="elementor-panel-footer-sub-menu">
						<div class="elementor-panel-footer-sub-menu-item" data-device-mode="desktop">
							<i class="elementor-icon eicon-device-desktop" aria-hidden="true"></i>
							<span class="elementor-title"><?php echo esc_html__( 'Desktop', 'fana' ); ?></span>
							<span class="elementor-description"><?php echo esc_html__( 'Default Preview', 'fana' ); ?></span>
						</div>
						<div class="elementor-panel-footer-sub-menu-item" data-device-mode="tablet">
							<i class="elementor-icon eicon-device-tablet" aria-hidden="true"></i>
							<span class="elementor-title"><?php echo esc_html__( 'Tablet', 'fana' ); ?></span>
							<?php $breakpoints = \Elementor\Plugin::$instance->breakpoints->get_breakpoints();; ?>
							<span class="elementor-description"><?php echo sprintf( esc_html__( 'Preview for %s', 'fana' ), $breakpoints['md'] . 'px' ); ?></span>
						</div>
						<div class="elementor-panel-footer-sub-menu-item" data-device-mode="mobile">
							<i class="elementor-icon eicon-device-mobile" aria-hidden="true"></i>
							<span class="elementor-title"><?php echo esc_html__( 'Mobile', 'fana' ); ?></span>
							<span class="elementor-description"><?php echo esc_html__( 'Preview for 360px', 'fana' ); ?></span>
						</div>
					</div>
				</div>
			</div>
			<div id="elementor-panel-footer-history" class="elementor-panel-footer-tool elementor-leave-open tooltip-target" data-tooltip="<?php esc_attr_e( 'History', 'fana' ); ?>">
				<i class="fa fa-history" aria-hidden="true"></i>
				<span class="elementor-screen-only"><?php echo esc_html__( 'History', 'fana' ); ?></span>
			</div>
			<div id="elementor-panel-saver-button-preview" class="elementor-panel-footer-tool tooltip-target" data-tooltip="<?php esc_attr_e( 'Preview Changes', 'fana' ); ?>">
				<span id="elementor-panel-saver-button-preview-label">
					<i class="fa fa-eye" aria-hidden="true"></i>
					<span class="elementor-screen-only"><?php echo esc_html__( 'Preview Changes', 'fana' ); ?></span>
				</span>
			</div>
			<div id="elementor-panel-saver-publish" class="elementor-panel-footer-tool">
				<button id="elementor-panel-saver-button-publish" class="elementor-button elementor-button-success elementor-saver-disabled">
					<span class="elementor-state-icon">
						<i class="fa fa-spin fa-circle-o-notch" aria-hidden="true"></i>
					</span>
					<span id="elementor-panel-saver-button-publish-label">
						<?php echo esc_html__( 'Publish', 'fana' ); ?>
					</span>
				</button>
			</div>
			<div id="elementor-panel-saver-save-options" class="elementor-panel-footer-tool" >
				<button id="elementor-panel-saver-button-save-options" class="elementor-button elementor-button-success tooltip-target elementor-saver-disabled" data-tooltip="<?php esc_attr_e( 'Save Options', 'fana' ); ?>">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
					<span class="elementor-screen-only"><?php echo esc_html__( 'Save Options', 'fana' ); ?></span>
				</button>
				<div class="elementor-panel-footer-sub-menu-wrapper">
					<p class="elementor-last-edited-wrapper">
						<span class="elementor-state-icon">
							<i class="fa fa-spin fa-circle-o-notch" aria-hidden="true"></i>
						</span>
						<span class="elementor-last-edited">
							{{{ elementor.config.document.last_edited }}}
						</span>
					</p>
					<div class="elementor-panel-footer-sub-menu">
						<div id="elementor-panel-saver-menu-save-draft" class="elementor-panel-footer-sub-menu-item elementor-saver-disabled">
							<i class="elementor-icon fa fa-save" aria-hidden="true"></i>
							<span class="elementor-title"><?php echo esc_html__( 'Save Draft', 'fana' ); ?></span>
						</div>
						<div id="elementor-panel-saver-menu-save-template" class="elementor-panel-footer-sub-menu-item">
							<i class="elementor-icon fa fa-folder" aria-hidden="true"></i>
							<span class="elementor-title"><?php echo esc_html__( 'Save as Template', 'fana' ); ?></span>
						</div>
					</div>
				</div>
			</div>
        </script>

	<?php
}

/**
 * Hook to delete post elementor related with this menu
 */
if (! function_exists('fana_megamenu_on_delete_menu_item')) {
	add_action( "before_delete_post", "fana_megamenu_on_delete_menu_item", 9 );
	function fana_megamenu_on_delete_menu_item($post_id)
	{
		if (is_nav_menu_item($post_id)) {
			$related_id = fana_megamenu_get_post_related_menu($post_id);
			if ($related_id) {
				wp_delete_post($related_id, true);
			}
		}
	}
}

if (! function_exists('fana_megamenu_load_menu_data')) {
	add_action( 'wp_ajax_fana_load_menu_data', 'fana_megamenu_load_menu_data' );
	function fana_megamenu_load_menu_data() {
		$nonce = ! empty($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
		$menu_id = ! empty($_POST['menu_id']) ? absint($_POST['menu_id']) : false;
		if (! wp_verify_nonce($nonce, 'fana-menu-data-nonce') || ! $menu_id) {
			wp_send_json(array(
					'message' => esc_html__('Access denied', 'fana')
				));
		}

		$data =  fana_megamenu_get_item_data($menu_id);

		$data = $data ? $data : array();
		if (isset($_POST['istop']) && absint($_POST['istop']) == 1) {
			if (fana_elementor_activated()) {
				if (isset($data['enabled']) && $data['enabled']) {
					$related_id = fana_megamenu_get_post_related_menu($menu_id);
					if (! $related_id) {
						fana_megamenu_create_related_post($menu_id);
						$related_id = fana_megamenu_get_post_related_menu($menu_id);
					}

					if ($related_id && isset($_REQUEST['menu_id']) && is_admin()) {
						$url = Elementor\Plugin::instance()->documents->get($related_id)->get_edit_url();
						$data['edit_submenu_url'] = add_query_arg(array( 'fana-menu-editable' => 1 ), $url);
					}
				} else {
					$url = admin_url();
					$data['edit_submenu_url'] = add_query_arg(array( 'fana-menu-createable' => 1, 'menu_id' => $menu_id ), $url);
				}
			}
		}

		$results = apply_filters('fana_menu_settings_data', array(
				'status' => true,
				'data' => $data
		));

		wp_send_json($results);
	}
}

if (! function_exists('fana_megamenu_update_menu_item_data')) {
	add_action( 'wp_ajax_fana_update_menu_item_data', 'fana_megamenu_update_menu_item_data' );
	function fana_megamenu_update_menu_item_data() {
		$nonce = ! empty($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
		if (! wp_verify_nonce($nonce, 'fana-update-menu-item')) {
			wp_send_json(array(
					'message' => esc_html__('Access denied', 'fana')
				));
		}

		$settings = ! empty($_POST['fana-menu-item']) ? ($_POST['fana-menu-item']) : array();
		$menu_id = ! empty($_POST['menu_id']) ? absint($_POST['menu_id']) : false;

		do_action('fana_before_update_menu_settings', $settings);


		fana_megamenu_update_item_data($menu_id, $settings);

		do_action('fana_menu_settings_updated', $settings);
		wp_send_json(array( 'status' => true ));
	}
}

if (! function_exists('fana_megamenu_underscore_template')) {
	add_action( 'admin_footer', 'fana_megamenu_underscore_template' );
	function fana_megamenu_underscore_template() {
		global $pagenow;
		if ($pagenow === 'nav-menus.php') { ?>
			<script type="text/html" id="tpl-fana-menu-item-modal">
				<div id="fana-modal" class="fana-modal">
					<div id="fana-modal-body" class="<%= data.edit_submenu === true ? 'edit-menu-active' : ( data.is_loading ? 'loading' : '' ) %>">
						<% if ( data.edit_submenu !== true && data.is_loading !== true ) { %>
							<form id="menu-edit-form">
						<% } %>
							<div class="fana-modal-content">
								<% if ( data.edit_submenu === true ) { %>
									<iframe src="<%= data.edit_submenu_url %>" /></iframe>
								<% } else if ( data.is_loading === true ) { %>
									<i class="fa fa-spin fa-spinner"></i>
								<% } else { %>

									<div class="form-group toggle-select-setting">
										<label for="icon"><?php esc_html_e('Icon', 'fana') ?></label>
										<select id="icon" name="fana-menu-item[icon]" class="form-control icon-picker fana-input-switcher fana-input-switcher-true" data-target=".icon-custom">
											<option value=""<%= data.icon == '' ? ' selected' : '' %>><?php echo esc_html__("No Use", "fana") ?></option>
											<option value="1"<%= data.icon == 1 ? ' selected' : '' %>><?php echo esc_html__("Custom Class", "fana") ?></option>
											<?php foreach (fana_megamenu_get_icons() as $value) : ?>
												<option value="<?php echo 'tb-icon tb-icon-'.esc_attr($value) ?>"<%= data.icon == '<?php echo 'tb-icon tb-icon-'.esc_attr($value) ?>' ? ' selected' : '' %>><?php echo 'tb-icon tb-icon-'.esc_attr($value) ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group icon-custom toggle-select-setting" style="display: none">
										<label for="icon_custom"><?php esc_html_e('Icon Class Name', 'fana') ?></label>
										<input type="text" name="fana-menu-item[icon_custom]" class="input" value="<%= data.icon_custom %>" id="icon_custom"/>
										<span class="des"><?php printf(__('This support display icon from <a href="%s" target="_blank">FontAwsome 5 Free</a> and <a href="%s" target="_blank">Material Design Iconic</a> and <a href="%s" target="_blank">simple line icons</a> .', 'fana'), '//fontawesome.com/', '//fonts.thembay.com/material-design-iconic/', '//fonts.thembay.com/simple-line-icons/');?></span>
									</div>
									<div class="form-group">
										<label for="icon_color"><?php esc_html_e('Icon Color', 'fana') ?></label>
										<input class="color-picker" name="fana-menu-item[icon_color]" value="<%= data.icon_color %>" id="icon_color" />
									</div>

									<div class="form-group submenu-setting toggle-select-setting">
										<label><?php esc_html_e('Mega Submenu Enabled', 'fana') ?></label>
										<select name="fana-menu-item[enabled]" class="fana-input-switcher fana-input-switcher-true" data-target=".submenu-width-setting">
											<option value="1" <%= data.enabled == 1? 'selected':'' %>> <?php esc_html_e('Yes', 'fana') ?></opttion>
											<option value="0" <%= data.enabled == 0? 'selected':'' %>><?php esc_html_e('No', 'fana') ?></opttion>
										</select>
										<button id="edit-megamenu" class="button button-primary button-large">
											<?php esc_html_e('Edit Megamenu Submenu', 'fana') ?>
										</button>
									</div>

									<div class="form-group submenu-width-setting toggle-select-setting" style="display: none">
										<label><?php esc_html_e('Sub Megamenu Width', 'fana') ?></label>
										<select name="fana-menu-item[customwidth]" class="fana-input-switcher fana-input-switcher-true" data-target=".submenu-subwidth-setting">
											<option value="0" <%= data.customwidth == 0? 'selected':'' %>><?php esc_html_e('Full Width', 'fana') ?></opttion>
											<option value="1" <%= data.customwidth == 1? 'selected':'' %>> <?php esc_html_e('Yes', 'fana') ?></opttion>
										</select>
									</div>

									<div class="form-group submenu-width-setting submenu-subwidth-setting toggle-select-setting" style="display: none">
										<label for="menu_subwidth"><?php esc_html_e('Sub Mega Menu Max Width', 'fana') ?></label>
										<input type="text" name="fana-menu-item[subwidth]" value="<%= data.subwidth?data.subwidth:'600' %>" class="input" id="menu_subwidth" />
										<span class="unit">px</span>
									</div>

									<div class="form-group submenu-width-setting submenu-subwidth-setting toggle-select-setting" style="display: none">
										<label><?php esc_html_e('Sub Mega Menu Position Left', 'fana') ?></label>
										<select name="fana-menu-item[menuposition]">
											<option value="" <%= data.menuposition == '' ? 'selected':'' %>><?php esc_html_e('None', 'fana') ?></opttion>
											<option value="left" <%= data.menuposition == 'left' ? 'selected':'' %>> <?php esc_html_e('Left', 'fana') ?></opttion>
											<option value="right" <%= data.menuposition == 'right' ? 'selected':'' %>> <?php esc_html_e('Right', 'fana') ?></opttion>
										</select>
									</div>

								<% } %>
							</div>
							<% if ( data.is_loading !== true && data.edit_submenu !== true ) { %>
								<div class="fana-modal-footer">
									<a href="#" class="close button"><%= fana_memgamnu_params.i18n.close %></a>
									<?php wp_nonce_field('fana-update-menu-item', 'nonce') ?>
									<input name="menu_id" value="<%= data.menu_id %>" type="hidden" />
									<button type="submit" class="button button-primary button-large menu-save pull-right"><%= fana_memgamnu_params.i18n.submit %></button>
								</div>
							<% } %>
						<% if ( data.edit_submenu !== true && data.is_loading !== true ) { %>
							</form>
						<% } %>
					</div>
					<div class="fana-modal-overlay"></div>
				</div>
			</script>
		<?php }
	}
}