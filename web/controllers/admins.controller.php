<?php

class AdminsController
{

    /*================================================
    Login de administradores
    =============================================== */

    public function login()
    {


        if (isset($_POST["loginAdminEmail"])) {

            if (preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["loginAdminEmail"])) {



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

    /*================================================
    Recuperar contraseña
    =============================================== */

    public function resetPassword() {

        if (isset($_POST["resetPassword"])) {

            /*================================================
            Validamos la sintaxis de los campos
            =============================================== */

            if(preg_match('/^[^\d][a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z]{2,4}$/', $_POST["resetPassword"])) {

                /*================================================
                Preguntamos primero si el usuario está registrado
                =============================================== */

                $url = "admins?linkTo=email_admin&equalTo=".$_POST["resetPassword"]."&select=id_admin";
                $method = "GET";
                $fields = array();

                $admin = CurlController::request($url,$method,$fields);
                
                if ($admin->status == 200) {

                    function genPassword($length) {
   
                        $password = "";
                        $chain = "0123456789abcdefghijklmnopqrstuvwxyz";
                        
                        $password = substr(str_shuffle($chain),0,$length);
                    
                        return $password;
                    }

                    $newPassword = genPassword(11);

                    $crypt = crypt($newPassword, '$2a$07$azybxcags23425sdg23sdfhsd$');

                        /*================================================
                        Actualizar contraseña en base de datos
                        =============================================== */
                        $url = "admins?id=".$admin->results[0]->id_admin."&nameId=id_admin&token=no&except=password_admin";
                        $method = "PUT";
                        $fields = "password_admin=".$crypt;

                        $updatePassword = CurlController::request($url,$method,$fields);

                        if($updatePassword->status == 200) {

                        }
                        
                } else {

                    $error = "El correo no está registrado";
                    
                    echo '<script>
    
    Swal.fire({
        icon: "error",
        title: "",
        text: "' . $error . '",
        timer: 5000,
        showConfirmButton: false
    });

    fncFormatInputs();

    </script>';
                }
            }
        }
    }

}
