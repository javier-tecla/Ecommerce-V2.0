/*================================================
Formatear envio  de formulario lado servidor
=============================================== */

function fncFormatInputs() {
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
}

/*================================================
Alerta SweetAlert
=============================================== */

function fncSweerAlert(type, text, url) {
  switch (type) {
    case "error":
      if (url == "") {
        Swal.fire({
          incon: "error",
          title: "Error",
          text: text,
        });
      } else {
        Swal.fire({
          incon: "error",
          title: "Error",
          text: text,
        }).then((result) => {
          if (result.value) {
            window.open(url, "top");
          }
        });
      }

      break;

    case "success":
      if (url == "") {
        Swal.fire({
          incon: "success",
          title: "Correcto",
          text: text,
        });
      } else {
        Swal.fire({
          incon: "success",
          title: "Correcto",
          text: text,
        }).then((result) => {
          if (result.value) {
            window.open(url, "top");
          }
        });
      }

      break;
  }
}
