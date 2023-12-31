<?php

if (! function_exists('fana_add_language_to_menu_storage_key')) {
    function fana_add_language_to_menu_storage_key( $storage_key )
    {
      global $sitepress;

      return $storage_key . '-' . $sitepress->get_current_language();
    }
}
add_filter( 'fana_menu_storage_key', 'fana_add_language_to_menu_storage_key', 10, 1 );