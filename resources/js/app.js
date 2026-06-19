import * as bootstrap from 'bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

import { io } from 'socket.io-client';

const socket = io('http://localhost:3001');

socket.on('connect', () => {
    console.log(
        'Conectado a Socket.IO: ' +
        socket.id
    );
});

socket.on('ticket-creado', (data) => {

    mostrarToast(
        '🔔 Nuevo Ticket',
        '#' + data.id + ' - ' + data.titulo
    );

});

window.socket = socket;
function mostrarToast(titulo, mensaje)
{
    const toastContainer =
        document.getElementById('toast-container');

    if (!toastContainer) return;

    const toast = document.createElement('div');

    toast.className =
        'toast align-items-center text-bg-primary border-0 mb-2';

    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <strong>${titulo}</strong><br>
                ${mensaje}
            </div>
            <button
                type="button"
                class="btn-close btn-close-white me-2 m-auto"
                data-bs-dismiss="toast">
            </button>
        </div>
    `;

    toastContainer.appendChild(toast);

    const bsToast = new bootstrap.Toast(toast, {
        delay: 5000
    });

    bsToast.show();

    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
}
