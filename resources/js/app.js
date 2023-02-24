import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


/**
 * Servicio de notificaciones
 */

/* Sweetalert 2 */
//Mensaje Simple
const GeneralSwal = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

/* Events */
//Disparador
window.addEventListener('notify', event => {
    GeneralSwal.fire({
        icon: 'success',
        title: event.detail.message //Aqui recibe el mensaje desde los componentes
    })
})
