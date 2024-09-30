import $ from 'jquery';
import "flatpickr/dist/flatpickr.css";
import flatpickr from "flatpickr";
$(document).ready(function() {
    var kategori = $('#data-kategori').text();
    $('#kategori').on('change', function() {
        var selectedValue = $(this).val() || kategori;
        $('#export-data').val(selectedValue);

        if (selectedValue === 'lacak-alumni') {
            $('.angkatan').removeClass('d-none').addClass('d-block');
            $('.periode').removeClass('d-block').addClass('d-none');
            $('.lacak-alumni-content').removeClass('d-none').addClass('d-block');
            $('.detail-alumni-bekerja-content').removeClass('d-block').addClass('d-none');
        } else if (selectedValue === 'detail-alumni-bekerja') {
            $('.periode').removeClass('d-none').addClass('d-block');
            $('.angkatan').removeClass('d-block').addClass('d-none');
            $('.detail-alumni-bekerja-content').removeClass('d-none').addClass('d-block');
            $('.lacak-alumni-content').removeClass('d-block').addClass('d-none');
        }
    });

    $('#kategori').trigger('change');

    $('#export-form').on('click', 'button', function() {
        var fileType = $(this).data('type');
        $('#type-file').val(fileType);
        $('#export-form').submit();
    });

let periode = document.getElementById('periode').getAttribute('data-periode');

function cekPeriode(periode) {
    if (periode.includes('sampai')) {
        const [startDate, endDate] = periode.split(' sampai ');
        return [startDate, endDate];
    } else {
        return [periode, periode];
    }
}

let waktu = cekPeriode(periode);

flatpickr('#waktu', {
    dateFormat: "j F Y",
    mode: 'range',
    defaultDate: waktu,
    locale: {
        rangeSeparator: ' sampai ',
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



