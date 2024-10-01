import "flatpickr/dist/flatpickr.css";
import flatpickr from "flatpickr";


flatpickr('#tanggal', {
    enableTime: true,
    minDate: "today",
    dateFormat: "j F Y H:i",
});
