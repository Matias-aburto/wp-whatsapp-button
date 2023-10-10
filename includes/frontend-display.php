<?php
// Verificamos que este archivo no se acceda directamente
if (!defined('ABSPATH')) {
    exit; // Salida si se accede al archivo directamente
}

// Función para añadir el botón flotante en el sitio
function agregar_boton_whatsapp() {
    if (get_option('whatsapp_button_active', 0) == 1) { // Si el botón está activado
        $whatsapp_number = esc_attr(get_option('whatsapp_number'));
        $whatsapp_image_url = esc_attr(get_option('whatsapp_image_url', plugins_url('whatsapp-default.png', WHATSAPP_PLUGIN_DIR . 'whatsapp-button.php')));

        echo '<a href="https://wa.me/' . $whatsapp_number . '" target="_blank" id="whatsapp-button" title="¡Háblanos por WhatsApp!">';
        echo '<img src="' . $whatsapp_image_url . '" alt="Icono de WhatsApp">';
        echo '</a>';
    }
}
add_action('wp_footer', 'agregar_boton_whatsapp');

// Función para añadir el CSS necesario
function estilos_boton_whatsapp() {
    $position = esc_attr(get_option('whatsapp_button_position', 'right')); // Por defecto, 'right' (derecha)
    $web_width = esc_attr(get_option('whatsapp_image_width_web', '50')); // Por defecto, 50px
    $mobile_width = esc_attr(get_option('whatsapp_image_width_mobile', '50')); // Por defecto, 50px

    echo '<style>
        #whatsapp-button {
            position: fixed;
            bottom: 20px;
            ' . $position . ': 20px;
            z-index: 1000;
        }
        #whatsapp-button img {
            width: ' . $web_width . 'px;
            height: auto;
            border-radius: 100px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }
        @media (max-width: 768px) {
            #whatsapp-button img {
                width: ' . $mobile_width . 'px;
            }
        }
        #whatsapp-button:hover img {
            transform: scale(1.1);
        }
    </style>';
}
add_action('wp_head', 'estilos_boton_whatsapp');
