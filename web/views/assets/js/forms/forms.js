/*=============================================================
Validación Bootstrap 5
==============================================================*/
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

/*=============================================================
Función para validar formularios
==============================================================*/

function validateJs(event, type) {

    if(type == "email") {

        let pattern = /^[^\d][a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z]{2,4}$/;

        if(!pattern.test(event.target.value)) {

            let parentElement = event.target.parentElement;
            parentElement.classList.add("was-validated");

            let feedbackElement = parentElement.querySelector(".invalid-feedback");
            if (feedbackElement) {
                feedbackElement.innerHTML = "Correo electrónico inválido";
            }

            event.target.value = "";

            return;

        }

    }
}

