import $ from "jquery";
import "flatpickr/dist/flatpickr.css";
import flatpickr from "flatpickr";
$(document).ready(function () {
    function toggleDisplay(showClass, hideClass) {
        $(showClass).removeClass("d-none").addClass("d-block");
        $(hideClass).removeClass("d-block").addClass("d-none");
    }

    var kategori = $("#data-kategori").text();
    $("#kategori").on("change", function () {
        var selectedValue = $(this).val() || kategori;
        $("#export-data").val(selectedValue);

        if (selectedValue === "lacak-alumni") {
            toggleDisplay(".angkatan", ".periode");
            // toggleDisplay(".jurusan", ".periode");
            // $("#jurusan").trigger("change");
            toggleDisplay(".lacak-alumni-content", ".detail-alumni-bekerja-content");
        } else if (selectedValue === "detail-alumni-bekerja") {
            toggleDisplay(".periode", ".angkatan");
            toggleDisplay(".periode", ".jurusan");
            toggleDisplay(".detail-alumni-bekerja-content", ".lacak-alumni-content");
        }
    });

    // $("#jurusan").on("change", function () {
    //     var selectedValue = $(this).val();
    //     var jurusanList = ["AK", "BR", "DKV", "MLOG", "MP", "RPL", "TKJ"];

    //     if (selectedValue === "Semua") {
    //         toggleDisplay(".Semua", jurusanList.map(j => `.${j}`).join(', '));
    //         $(".Semua").removeClass("d-none");
    //     } else {
    //         $(".Semua").addClass("d-none");
    //         toggleDisplay(`.${selectedValue}`, jurusanList.filter(j => j !== selectedValue).map(j => `.${j}`).join(', '));
    //     }
    // });

    $("#kategori").trigger("change");

    $("#export-form").on("click", "button", function () {
        var fileType = $(this).data("type");
        $("#type-file").val(fileType);
        $("#export-form").submit();
    });

    let periode = document.getElementById("periode").getAttribute("data-periode");

    function cekPeriode(periode) {
        if (periode.includes("sampai")) {
            const [startDate, endDate] = periode.split(" sampai ");
            return [startDate, endDate];
        } else {
            return [periode, periode];
        }
    }

    let waktu = cekPeriode(periode);

    flatpickr("#waktu", {
        dateFormat: "j F Y",
        mode: "range",
        defaultDate: waktu,
        locale: {
            rangeSeparator: " sampai ",
            // weekdays: {
            //     shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            //     longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            // },
            // months: {
            //     shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            //     longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            // },
        },
    });
});
