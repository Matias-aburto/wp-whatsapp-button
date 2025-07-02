<?php
// Verificamos que este archivo no se acceda directamente
if (!defined('ABSPATH')) {
    exit; // Salida si se accede al archivo directamente
}

// Función para encolar los estilos del admin
function floating_chat_button_admin_styles() {
    // Asegúrate de agregar un archivo CSS real si decides crear uno. Por ahora, usamos este placeholder.
    wp_enqueue_style('floating-chat-button-admin', FLOATING_CHAT_PLUGIN_URL . 'assets/css/admin-style.css', array(), '1.0.0', 'all');
    
    // Enqueue WordPress media scripts
    wp_enqueue_media();
    
    // Enqueue our custom script
    wp_enqueue_script('floating-chat-button-admin', FLOATING_CHAT_PLUGIN_URL . 'assets/js/admin-script.js', array('jquery'), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'floating_chat_button_admin_styles');

// Función para encolar estilos o scripts en el frontend si es necesario en el futuro
function floating_chat_button_frontend_scripts() {
    // Asegúrate de agregar un archivo CSS real si decides crear uno. Por ahora, usamos este placeholder.
    //wp_enqueue_style('floating-chat-button-frontend', FLOATING_CHAT_PLUGIN_URL . 'assets/css/frontend-style.css', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'floating_chat_button_frontend_scripts');
