<?php

class AdminsController
{

    /*================================================
    Login de administradores
    =============================================== */

    public function login()
    {

        if (isset($_POST["loginAdminEmail"])) {

            if(preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["loginAdminEmail"])) {



                $url = "admins?login=true&suffix=admin";
                $method = "POST";
                $fields = array(

                    "email_admin" => $_POST["loginAdminEmail"],
                    "password_admin" => $_POST["loginAdminPass"]
                );

                $login = CurlController::request($url, $method, $fields);

                if ($login->status == 200) {

                    $_SESSION["admin"] = $login->results[0];

                    echo '<script>
                
                    location.reload();
                
                </script>';
                } else {

                    $error = null;

                    if ($login->results == "Wrong email") {

                        $error = "Correo no existe";
                    } else {

                        $error = "Contraseña incorrecta";
                    }

                    if ($error) {
                        echo '<div id="error-alert" class="alert alert-danger mt-3 text-center">' . $error . '</div>
                        
                    <script>
                        // Ejecuta una función después de 5 segundos
                        setTimeout(function() {
                            let errorAlert = document.getElementById("error-alert");
                            if (errorAlert) {
                                // Oculta el mensaje de error
                                errorAlert.style.display = "none";
                            }
                        }, 5000); // 5000 milisegundos = 5 segundos
                
                    fncFormatInputs();
                    
                </script>

                ';
                    } else {

                        echo '<div id="error-alert" class="alert alert-danger mt-3 text-center">' . $error . '</div>
                        
                    <script>
                        // Ejecuta una función después de 5 segundos
                        setTimeout(function() {
                            var errorAlert = document.getElementById("error-alert");
                            if (errorAlert) {
                                // Oculta el mensaje de error
                                errorAlert.style.display = "none";
                            }
                        }, 5000); // 5000 milisegundos = 5 segundos
                
                    fncFormatInputs();
                    
                </script>

                ';
                    }
                }
            }
        }
    }
}
