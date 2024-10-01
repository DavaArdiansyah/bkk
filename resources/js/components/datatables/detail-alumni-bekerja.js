import $ from "jquery";

import "datatables.net-bs5/css/dataTables.bootstrap5.css";
import "datatables.net-responsive-bs5/css/responsive.bootstrap5.css";

import "datatables.net";
import "datatables.net-bs5";
import "datatables.net-responsive";
import "datatables.net-responsive-bs5";

document.addEventListener("DOMContentLoaded", function () {
    $("#detail-alumni-bekerja").DataTable({
        "paging": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "lengthChange": false,
        "bFilter": false,
        "responsive": true,
    });
});
