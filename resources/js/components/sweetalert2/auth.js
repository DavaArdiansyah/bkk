import 'sweetalert2/dist/sweetalert2.css';
import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function() {
    const statusElement = document.getElementById('status');
    const messageElement = document.getElementById('message');

    const status = statusElement ? statusElement.textContent.trim() : null;
    const message = messageElement ? messageElement.textContent.trim() : null;

    if (status && message) {
        Swal.fire({
            icon: status,
            title: message
        });
    }
});
