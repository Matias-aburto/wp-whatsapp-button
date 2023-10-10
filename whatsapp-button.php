<?php
/*
Plugin Name: Simple Whatsapp
Description: Plugin para añadir un botón flotante de WhatsApp.
Version: 1.0.0
Author: <a href="https://simetry.cl" target="_blank">Simetry Code</a>
*/

// Añade el menú de opciones en el área de administración
function whatsapp_button_menu() {
    add_options_page(
        'Configuración de WhatsApp Button',
        'WhatsApp Button',
        'manage_options',
        'whatsapp-button',
        'whatsapp_button_options_page'
    );
}
add_action('admin_menu', 'whatsapp_button_menu');

// Página de configuración del plugin
function whatsapp_button_options_page() {
    ?>
    <div class="wrap">
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input { 
                opacity: 0;
                width: 0;
                height: 0;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked + .slider {
                background-color: #2196F3;
            }

            input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }
        </style>

        <h2>Configuración de WhatsApp Button</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('whatsapp_button_settings');
            do_settings_sections('whatsapp-button');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Mostrar botón de WhatsApp:</th>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="whatsapp_button_active" value="1" <?php checked(1, get_option('whatsapp_button_active', 0), true); ?> />
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">Número de WhatsApp:</th>
                    <td><input type="text" name="whatsapp_number" value="<?php echo esc_attr(get_option('whatsapp_number', '')); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Imagen de WhatsApp:</th>
                    <td><input type="text" name="whatsapp_image_url" value="<?php echo esc_attr(get_option('whatsapp_image_url', plugins_url('whatsapp-default.png', __FILE__))); ?>" /><br/>
                        <span>Añade la URL de la imagen o utiliza el uploader de medios de WordPress para obtener la URL.</span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Ancho de imagen en Web (px):</th>
                    <td><input type="text" name="whatsapp_image_width_web" value="<?php echo esc_attr(get_option('whatsapp_image_width_web', '50')); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Ancho de imagen en Móvil (px):</th>
                    <td><input type="text" name="whatsapp_image_width_mobile" value="<?php echo esc_attr(get_option('whatsapp_image_width_mobile', '50')); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Posición del botón:</th>
                    <td>
                        <select name="whatsapp_button_position">
                            <option value="right" <?php selected(get_option('whatsapp_button_position'), 'right'); ?>>Derecha</option>
                            <option value="left" <?php selected(get_option('whatsapp_button_position'), 'left'); ?>>Izquierda</option>
                        </select>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Registra las opciones en la base de datos de WordPress
function whatsapp_button_register_settings() {
    register_setting('whatsapp_button_settings', 'whatsapp_number');
    register_setting('whatsapp_button_settings', 'whatsapp_image_url');
    register_setting('whatsapp_button_settings', 'whatsapp_image_width_web');
    register_setting('whatsapp_button_settings', 'whatsapp_image_width_mobile');
    register_setting('whatsapp_button_settings', 'whatsapp_button_position');
    register_setting('whatsapp_button_settings', 'whatsapp_button_active');
}
add_action('admin_init', 'whatsapp_button_register_settings');

// Añade el botón flotante en el sitio
function agregar_boton_whatsapp() {
    if (get_option('whatsapp_button_active', 0) == 1) { // Si el botón está activado
        $whatsapp_number = esc_attr(get_option('whatsapp_number'));
        $whatsapp_image_url = esc_attr(get_option('whatsapp_image_url'));

        echo '<a href="https://wa.me/' . $whatsapp_number . '" target="_blank" id="whatsapp-button" title="¡Háblanos por WhatsApp!">';
        echo '<img src="' . $whatsapp_image_url . '" alt="Icono de WhatsApp">';
        echo '</a>';
    }
}
add_action('wp_footer', 'agregar_boton_whatsapp');

// Añade el CSS necesario
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
            border-radius:100px;
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
