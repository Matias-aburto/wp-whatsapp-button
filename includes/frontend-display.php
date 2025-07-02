<?php
// Verificamos que este archivo no se acceda directamente
if (!defined('ABSPATH')) {
    exit; // Salida si se accede al archivo directamente
}

// Función para añadir el botón flotante en el sitio
function agregar_boton_chat() {
    if (get_option('floating_chat_button_active', 0) == 1) { // Si el botón está activado
        $floating_chat_number = esc_attr(get_option('floating_chat_number'));
        $floating_chat_image_url = get_option('floating_chat_image_url');
        if (empty($floating_chat_image_url)) {
            $floating_chat_image_url = FLOATING_CHAT_PLUGIN_URL . 'assets/whatsapp-default.webp';
        }
        $floating_chat_image_url = esc_attr($floating_chat_image_url);

        echo '<a href="https://wa.me/' . $floating_chat_number . '" target="_blank" id="floating-chat-button" title="¡Háblanos por chat!">';
        echo '<img src="' . $floating_chat_image_url . '" alt="Icono de chat">';
        echo '</a>';
    }
}
add_action('wp_footer', 'agregar_boton_chat');

// Función para añadir el CSS necesario
function estilos_boton_chat() {
    $position = esc_attr(get_option('floating_chat_button_position', 'right')); // Por defecto, 'right' (derecha)
    $web_width = esc_attr(get_option('floating_chat_image_width_web', '50')); // Por defecto, 50px
    $mobile_width = esc_attr(get_option('floating_chat_image_width_mobile', '50')); // Por defecto, 50px

    echo '<style>
        #floating-chat-button {
            position: fixed;
            bottom: 20px;
            ' . $position . ': 20px;
            z-index: 1000;
        }
        #floating-chat-button img {
            width: ' . $web_width . 'px;
            height: auto;
            border-radius: 100px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }
        @media (max-width: 768px) {
            #floating-chat-button img {
                width: ' . $mobile_width . 'px;
            }
        }
        #floating-chat-button:hover img {
            transform: scale(1.1);
        }
    </style>';
}
add_action('wp_head', 'estilos_boton_chat');
