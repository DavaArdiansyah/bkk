import 'sweetalert2/dist/sweetalert2.css';
import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function() {
    const statusElement = document.getElementById('status');
    const messageElement = document.getElementById('message');

    const status = statusElement ? statusElement.textContent.trim() : null;
    const message = messageElement ? messageElement.textContent.trim() : null;

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    if (status && message) {
        Toast.fire({
            icon: status,
            title: message
        });
    }
});
