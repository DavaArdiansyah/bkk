import * as FilePond from "filepond";
import "filepond/dist/filepond.min.css";

import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";

FilePond.registerPlugin(
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize
);

let csrfToken = document.querySelector('meta[name="csrf-token"]') ?.getAttribute("content");

document.querySelectorAll(".filepond").forEach((inputElement) => {
    const idLoker = inputElement.dataset.id;
    if (idLoker) {
        FilePond.create(inputElement, {
            acceptedFileTypes: ["application/pdf"],
            credits: null,
            maxFileSize: "2MB",
            labelMaxFileSizeExceeded: "Ukuran maksimum file adalah 2 MB.",
            server: {
                process: {
                    url: "/tmp/files",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                },
            },
        });
    }
});
