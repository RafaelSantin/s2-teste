var total_photos_counter = 0;
Dropzone.options.myDropzone = {
    uploadMultiple: true,
    parallelUploads: 2,
    maxFilesize: 16,
    previewTemplate: document.querySelector('#preview').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove file',
    dictFileTooBig: 'Image is larger than 16MB',
    timeout: 10000,
 
    init: function () {
        this.on("removedfile", function (file) {
            $.post({
                url: '/images-delete',
                data: {id: file.name, _token: $('[name="_token"]').val()},
                dataType: 'json',
                success: function (data) {
                    // total_photos_counter--;
                    // $("#counter").text("# " + total_photos_counter);
                }
            });
        });
        this.on('error', function(file, errorMessage) {
            $(file.previewElement).find('.dz-error-message').text("Ocorreu um erro ao fazer upload, favor verificar se o arquivo XML está correto e não contem erros.");
            // $('.dz-error-message').text('Ocorreu um erro ao fazer upload, favor verificar se o arquivo XML está correto e não contem erros.');
        });
    },
    success: function (file, done) {
        total_photos_counter++;
        $("#counter").text("# " + total_photos_counter);
    }
};