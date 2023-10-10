<?php
// Verificamos que este archivo no se acceda directamente
if (!defined('ABSPATH')) {
    exit; // Salida si se accede al archivo directamente
}

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
                    <td><input type="text" name="whatsapp_number" value="<?php echo esc_attr(get_option('whatsapp_number', '')); ?>"placeholder="5634567890"/></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Imagen de WhatsApp:</th>
                    <td><input type="text" name="whatsapp_image_url" value="<?php echo esc_attr(get_option('whatsapp_image_url', plugins_url('assets/whatsapp-default.png', dirname(__FILE__)))); ?>" /><br/>
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
