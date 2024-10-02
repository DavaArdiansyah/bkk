import "flatpickr/dist/flatpickr.css";
import flatpickr from "flatpickr";

let tanggalAkhirElement = document.getElementById('tanggal-akhir');
let valueTanggalAkhir = tanggalAkhirElement ? tanggalAkhirElement.getAttribute('data-tanggal-akhir') : null;

let parsedWaktu = new Date(valueTanggalAkhir);

flatpickr('#tanggal', {
    enableTime: true,
    minDate: "today",
    defaultDate: parsedWaktu,
    dateFormat: "j F Y H:i",
});

