<?php
// Verificamos que este archivo no se acceda directamente
if (!defined('ABSPATH')) {
    exit; // Salida si se accede al archivo directamente
}

// Función para registrar las opciones en la base de datos de WordPress
function whatsapp_button_register_settings() {
    register_setting('whatsapp_button_settings', 'whatsapp_button_active');
    register_setting('whatsapp_button_settings', 'whatsapp_number');
    register_setting('whatsapp_button_settings', 'whatsapp_image_url');
    register_setting('whatsapp_button_settings', 'whatsapp_image_width_web');
    register_setting('whatsapp_button_settings', 'whatsapp_image_width_mobile');
    register_setting('whatsapp_button_settings', 'whatsapp_button_position');
}
add_action('admin_init', 'whatsapp_button_register_settings');
