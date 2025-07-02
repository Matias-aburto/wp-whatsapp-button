<?php
/*
Plugin Name: Floating Chat Button
Plugin URI: https://simetry.cl
Description: Plugin para añadir un botón flotante de chat personalizable en tu sitio web. Permite configurar número de teléfono, imagen, posición y tamaño para conectar con tus clientes.
Version: 1.1.0
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
Author: Simetry
Author URI: https://simetry.cl
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: floating-chat-button
Domain Path: /languages
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Definiciones generales
define('FLOATING_CHAT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FLOATING_CHAT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('FLOATING_CHAT_PLUGIN_VERSION', '1.1.0');

// Incluye los archivos necesarios
require_once(FLOATING_CHAT_PLUGIN_DIR . 'includes/settings.php');
require_once(FLOATING_CHAT_PLUGIN_DIR . 'includes/admin-page.php');
require_once(FLOATING_CHAT_PLUGIN_DIR . 'includes/frontend-display.php');
require_once(FLOATING_CHAT_PLUGIN_DIR . 'includes/enqueues.php');

// Añadir enlace de configuración en la lista de plugins
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'floating_chat_add_settings_link');

function floating_chat_add_settings_link($links) {
    $settings_link = '<a href="admin.php?page=floating-chat-button">' . __('Settings', 'floating-chat-button') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}