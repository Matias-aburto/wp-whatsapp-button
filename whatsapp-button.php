<?php
/*
Plugin Name: Simple Whatsapp
Description: Plugin para añadir un botón flotante de WhatsApp.
Version: 1.0.0
Author: <a href="https://simetry.cl" target="_blank">Simetry Code</a>
*/
// Definiciones generales
define('WHATSAPP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WHATSAPP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Incluye los archivos necesarios
require_once(WHATSAPP_PLUGIN_DIR . 'includes/settings.php');
require_once(WHATSAPP_PLUGIN_DIR . 'includes/admin-page.php');
require_once(WHATSAPP_PLUGIN_DIR . 'includes/frontend-display.php');
require_once(WHATSAPP_PLUGIN_DIR . 'includes/enqueues.php');