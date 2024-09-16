import $ from "jquery";

import "datatables.net-bs5/css/dataTables.bootstrap5.css";
import "datatables.net-responsive-bs5/css/responsive.bootstrap5.css";

import "datatables.net";
import "datatables.net-bs5";
import "datatables.net-responsive";
import "datatables.net-responsive-bs5";

document.addEventListener("DOMContentLoaded", function () {
    $("#aktivitas-pengguna").DataTable({
        order: [2, "desc"],
        responsive: true,
    });
});
