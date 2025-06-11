jQuery(document).ready(function($) {
    // Store the media frame instance
    var mediaFrame;

    // When the upload button is clicked
    $('#upload_image_button').on('click', function(e) {
        e.preventDefault();

        // If the frame already exists, reopen it
        if (mediaFrame) {
            mediaFrame.open();
            return;
        }

        // Create a new media frame
        mediaFrame = wp.media({
            title: 'Seleccionar o Subir Imagen de WhatsApp',
            button: {
                text: 'Usar esta imagen'
            },
            multiple: false
        });

        // When an image is selected, run a callback
        mediaFrame.on('select', function() {
            var attachment = mediaFrame.state().get('selection').first().toJSON();
            $('#whatsapp_image_url').val(attachment.url);
            $('#image_preview').attr('src', attachment.url).show();
        });

        // Open the media frame
        mediaFrame.open();
    });

    // When the remove button is clicked
    $('#remove_image_button').on('click', function(e) {
        e.preventDefault();
        $('#whatsapp_image_url').val('');
        $('#image_preview').attr('src', '').hide();
    });
}); 