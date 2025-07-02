<?php
// Si la desinstalación no es llamada desde WordPress, entonces se sale.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Eliminar opciones del plugin de la base de datos
delete_option('floating_chat_button_active');
delete_option('floating_chat_number');
delete_option('floating_chat_image_url');
delete_option('floating_chat_image_width_web');
delete_option('floating_chat_image_width_mobile');
delete_option('floating_chat_button_position');
