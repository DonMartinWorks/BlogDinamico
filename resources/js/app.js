import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

/**
 * Servicio de notificaciones
 */

/**
 * Para utilizar estos tipos de mensajes:
 *
 * hay unos tipos de mensajes que segun su addEventListener
 * Se mostrara en el browser. Ejemplo:
 *
 * notify: Mostrará un mensaje blanco con un ticket verde
 * deleteit: Mostrará un mensaje con titulo, texto y un boton de acepto y cancelar
 * deleteMessage: Mostrar un mensaje que se realizó una eliminacion de un item.
 */

/* Sweetalert 2 */
//Mensaje Simple
const GeneralSwal = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

//Preguntador para eliminar
const DeleteConfirmSwal = Swal.mixin({
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#ef4444",
    cancelButtonColor: "#3f3f46",
});

/* Events */
//Disparador
window.addEventListener("notify", (event) => {
    GeneralSwal.fire({
        icon: "success",
        title: event.detail.message, //Aqui recibe el mensaje desde los componentes
    });
});

//Confirmador de eliminado - ¿estas seguro?
window.addEventListener("deleteit", (event) => {
    DeleteConfirmSwal.fire({
        title: event.detail.title,
        text: event.detail.text,
        confirmButtonText: event.detail.confirmText,
        cancelButtonText: event.detail.cancelText,
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.emit(event.detail.eventName, event.detail.id);
        }
    });
});

//Eliminado completado
window.addEventListener("deleteMessage", (event) => {
    Swal.fire({
        confirmButtonColor: "#3f3f46",
        icon: "success",
        title: event.detail.message,
    });
});
