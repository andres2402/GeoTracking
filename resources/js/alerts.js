const Swal = require('sweetalert2');
const customSwal = Swal.mixin();
const Toast = Swal.mixin({
  toast: true,
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
module.exports = {
  Confirmation(title = '¿Estas Seguro?', text = 'Se eliminara esto', icon = 'question') {
    return customSwal.fire({
      title: title,
      text: text,
      icon: icon,
      showCancelButton: true,
      confirmButtonText: 'Si, aceptar',
      cancelButtonText: 'No, cancelar',
      reverseButtons: true
    })
  },
  success(action="realizar esta operacion", message = "") {
    return customSwal.fire({
      icon: 'success',
      title: 'Exito al ' + action,
      text: message ? message : '',
      timer: 2300
    })
  },
  error(message) {
    return Toast.fire({
      icon: 'error',
      title: message,
    })
  },
  correct(message) {
    return Toast.fire({
      icon: 'success',
      title: message,
    })
  },
  load(title = 'Cargando...') {
    return customSwal.fire({
      title: title,
      allowEscapeKey: false,
      allowOutsideClick: false,
      onOpen: () => {
        Swal.showLoading();
      }
    });
  },
  stopLoad() {
    return customSwal.close()
  }
  


}




