<?php
// Verificamos que este archivo no se acceda directamente
if (!defined('ABSPATH')) {
    exit; // Salida si se accede al archivo directamente
}

// Añade el menú de opciones en el área de administración
function floating_chat_button_menu() {
    add_options_page(
        'Configuración de Floating Chat Button',
        'Floating Chat Button',
        'manage_options',
        'floating-chat-button',
        'floating_chat_button_options_page'
    );
}
add_action('admin_menu', 'floating_chat_button_menu');

// Página de configuración del plugin
function floating_chat_button_options_page() {
    ?>
    <div class="wrap whatsapp-button-admin">

        <h2>Configuración de Floating Chat Button</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('floating_chat_button_settings');
            do_settings_sections('floating-chat-button');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Mostrar botón de chat:</th>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="floating_chat_button_active" value="1" <?php checked(1, get_option('floating_chat_button_active', 0), true); ?> />
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
                
                
                <tr valign="top">
                    <th scope="row">Número de teléfono:</th>
                    <td><input type="text" name="floating_chat_number" value="<?php echo esc_attr(get_option('floating_chat_number', '')); ?>"placeholder="5634567890"/></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Imagen del botón:</th>
                    <td>
                                                <?php
                        $floating_chat_image_url = get_option('floating_chat_image_url');
                        if (empty($floating_chat_image_url)) {
                            $floating_chat_image_url = plugins_url('assets/whatsapp-default.webp', dirname(__FILE__));
                        }
                        ?>
                        <input type="text" id="floating_chat_image_url" name="floating_chat_image_url" value="<?php echo esc_attr($floating_chat_image_url); ?>" class="regular-text" />
                        <input type="button" id="upload_image_button" class="button" value="Seleccionar Imagen" />
                        <input type="button" id="remove_image_button" class="button" value="Eliminar Imagen" />
                        <br/>
                        <img id="image_preview" src="<?php echo esc_attr($floating_chat_image_url); ?>" style="max-width: 100px; margin-top: 10px; <?php echo empty(get_option('floating_chat_image_url')) ? '' : ''; ?>" />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Ancho de imagen en Web (px):</th>
                    <td><input type="text" name="floating_chat_image_width_web" value="<?php echo esc_attr(get_option('floating_chat_image_width_web', '50')); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Ancho de imagen en Móvil (px):</th>
                    <td><input type="text" name="floating_chat_image_width_mobile" value="<?php echo esc_attr(get_option('floating_chat_image_width_mobile', '50')); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Posición del botón:</th>
                    <td>
                        <select name="floating_chat_button_position">
                            <option value="right" <?php selected(get_option('floating_chat_button_position'), 'right'); ?>>Derecha</option>
                            <option value="left" <?php selected(get_option('floating_chat_button_position'), 'left'); ?>>Izquierda</option>
                        </select>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
