import $ from "jquery";

import "datatables.net-bs5/css/dataTables.bootstrap5.css";
import "datatables.net-responsive-bs5/css/responsive.bootstrap5.css";

import "datatables.net";
import "datatables.net-bs5";
import "datatables.net-responsive";
import "datatables.net-responsive-bs5";

document.addEventListener("DOMContentLoaded", function () {
    $("#detail-alumni-bekerja").DataTable({
        "paging": false,        // Menonaktifkan paginasi
        "searching": false,     // Menonaktifkan fitur pencarian
        "ordering": false,      // Menonaktifkan fitur sorting
        "info": false,          // Menonaktifkan informasi jumlah data
        "lengthChange": false,  // Menonaktifkan pilihan jumlah data yang ditampilkan
        "bFilter": false,
        "responsive": true,
    });
});
