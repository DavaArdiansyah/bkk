import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';

import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

FilePond.registerPlugin(
    FilePondPluginFileValidateType,
);

let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

FilePond.create(document.querySelector('.filepond-excel'), {
    acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
    credits: null,
    server: {
        process: {
            url: '/tmp/files',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        }
    }
});
