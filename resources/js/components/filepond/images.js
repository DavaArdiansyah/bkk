import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

// Registrasi plugin
FilePond.registerPlugin(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview,
    FilePondPluginImageCrop
);

let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

FilePond.create(document.querySelector('.filepond'), {
    acceptedFileTypes: ['image/jpeg', 'image/png'],
    credits: null,
    allowMultiple: false,
    allowImagePreview: true,
    allowImageCrop: true,
    imageCropAspectRatio: 1,
    imageCropCircle: true,
    server: {
        process: {
            url: '/tmp/images',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
        }
    }
});
