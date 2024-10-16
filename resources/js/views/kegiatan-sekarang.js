import $ from "jquery";

var kegiatanSekarang = $("#data-kegiatan-sekarang").attr('data-kegiatan-sekarang');
$("#kegiatan-sekarang").on("change", function () {
    var selectedValue = $(this).val() || kegiatanSekarang;

    if (selectedValue === "Tidak Bekerja") {
        $('.keterangan').addClass("d-none");
    } else {
        $('.keterangan').removeClass("d-none");
    }
});

$("#kegiatan-sekarang").trigger("change");
