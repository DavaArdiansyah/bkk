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
    $("#lacak-alumni").DataTable({
        order: [
            [4, "desc"],
            [3, "asc"],
            [1, "asc"],
        ],
        responsive: true,
        layout: {
            top1: {
                searchPanes: {
                    //filter layout
                    orderable: false, //non aktif noise filter
                    initCollapsed: true, //non aktif filter dropdown
                },
            },
        },
        columnDefs: [
            {
                searchPanes: {
                    show: true, //filter show true
                },
                targets: [3, 4, 5], //target kolom index 3, 4 dan 5
            },
        ]
    });
});