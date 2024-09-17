import $ from "jquery";

import "datatables.net-bs5/css/dataTables.bootstrap5.css";
import "datatables.net-searchpanes-bs5/css/searchPanes.bootstrap5.css";
import "datatables.net-select-bs5/css/select.bootstrap5.css";
import "datatables.net-responsive-bs5/css/responsive.bootstrap5.css";

import "datatables.net";
import "datatables.net-bs5";
import "datatables.net-searchpanes";
import "datatables.net-searchpanes-bs5";
import "datatables.net-select";
import "datatables.net-select-bs5";
import "datatables.net-responsive";
import "datatables.net-responsive-bs5";

document.addEventListener("DOMContentLoaded", function () {
    $('#lamaran-saya').DataTable({
        responsive: true,
        layout: {
            top1: {
                searchPanes: {
                    orderable: false,
                    initCollapsed: true,
                }
            },
        },
        columnDefs: [{
            searchPanes: {
                show: true
            },
            targets: [2, 3]
        },
        // {
        //     searchPanes: {
        //         show: false
        //     },
        //     targets: [1]
        // }
    ]
    });
    });
