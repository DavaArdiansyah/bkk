import $ from 'jquery';
import "flatpickr/dist/flatpickr.css";
import flatpickr from "flatpickr";
$(document).ready(function() {
    $('#kategori').on('change', function() {
        var selectedValue = $(this).val();
        $('#export-data').val(selectedValue);

        if (selectedValue === 'info-loker') {
            $('.info-loker-content').removeClass('d-none').addClass('d-block');
            $('.detail-alumni-bekerja-content').removeClass('d-block').addClass('d-none');
        } else if (selectedValue === 'detail-alumni-bekerja') {
            $('.detail-alumni-bekerja-content').removeClass('d-none').addClass('d-block');
            $('.info-loker-content').removeClass('d-block').addClass('d-none');
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



