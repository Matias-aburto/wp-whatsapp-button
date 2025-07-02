<?php
// Verificamos que este archivo no se acceda directamente
if (!defined('ABSPATH')) {
    exit; // Salida si se acceda al archivo directamente
}

// Función para sanitizar el estado activo del botón
function floating_chat_sanitize_active($input) {
    return (bool) $input;
}

// Función para sanitizar el número de teléfono
function floating_chat_sanitize_number($input) {
    // Eliminar todos los caracteres excepto números
    $sanitized = preg_replace('/[^0-9]/', '', $input);
    return $sanitized;
}

// Función para sanitizar la URL de la imagen
function floating_chat_sanitize_image_url($input) {
    return esc_url_raw($input);
}

// Función para sanitizar el ancho de imagen
function floating_chat_sanitize_image_width($input) {
    $width = absint($input);
    // Limitar el ancho entre 20 y 200 píxeles
    return max(20, min(200, $width));
}

// Función para sanitizar la posición del botón
function floating_chat_sanitize_position($input) {
    $allowed_positions = array('left', 'right');
    return in_array($input, $allowed_positions) ? $input : 'right';
}

// Función para registrar las opciones en la base de datos de WordPress
function floating_chat_button_register_settings() {
    register_setting(
        'floating_chat_button_settings', 
        'floating_chat_button_active',
        array(
            'sanitize_callback' => 'floating_chat_sanitize_active',
            'default' => 0
        )
    );
    
    register_setting(
        'floating_chat_button_settings', 
        'floating_chat_number',
        array(
            'sanitize_callback' => 'floating_chat_sanitize_number',
            'default' => ''
        )
    );
    
    register_setting(
        'floating_chat_button_settings', 
        'floating_chat_image_url',
        array(
            'sanitize_callback' => 'floating_chat_sanitize_image_url',
            'default' => ''
        )
    );
    
    register_setting(
        'floating_chat_button_settings', 
        'floating_chat_image_width_web',
        array(
            'sanitize_callback' => 'floating_chat_sanitize_image_width',
            'default' => 50
        )
    );
    
    register_setting(
        'floating_chat_button_settings', 
        'floating_chat_image_width_mobile',
        array(
            'sanitize_callback' => 'floating_chat_sanitize_image_width',
            'default' => 50
        )
    );
    
    register_setting(
        'floating_chat_button_settings', 
        'floating_chat_button_position',
        array(
            'sanitize_callback' => 'floating_chat_sanitize_position',
            'default' => 'right'
        )
    );
}
add_action('admin_init', 'floating_chat_button_register_settings');
