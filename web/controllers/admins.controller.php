<?php

class AdminsController {

    /*================================================
    Login de administradores
    =============================================== */

    public function login() {

        if (isset($_POST["loginAdminEmail"])){

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

            }else {

                $error = null;

                if($login->results == "Wrong email"){

                    $error = "Correo no existe";

                } else {

                    $error = "Contraseña incorrecta";
                }

                echo '<div class="alert alert-danger mt-3 text-center">'.$error.'</div>
                
                <script>
                
                    fncFormatInputs();
                    
                </script>

                ';
            }

        }

    }
}