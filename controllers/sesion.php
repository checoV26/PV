<?php

class sesion extends controllers
{

    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function validar()
    {
        if (empty($_POST["user"]) || empty($_POST["pass"])) {
            $response = array(
                "status" => "401",
                "icon" => "warning",
                "msg" => "¡Los campos están vacíos!",
                "data" => ""
            );
        } else {
            $user = $_POST["user"];
            $pass = $_POST["pass"];
            $data = $this->model->getUsuario($user, $pass);
            if ($data) {
                if (password_verify($pass, $data["pass"])) {
                    $_SESSION["idUsuario"] = $data["id"];
                    $_SESSION["usuario"] = $data["usuario"];
                    $_SESSION["nombre"] = $data["nombre"];
                    $_SESSION["apellidoP"] = $data["apellidoP"];
                    $_SESSION["apellidoM"] = $data["apellidoM"];
                    $_SESSION["idCaja"] = $data["idCaja"];
                    $_SESSION["activo"] = true;
                    $response = array(
                        "status" => "200",
                        "icon" => "success",
                        "msg" => "¡success!",
                        "data" => ""
                    );
                } else {
                    $response = array(
                        "status" => "401",
                        "icon" => "error",
                        "msg" => "¡Usuario o contraseña incorrecto!",
                        "data" => ""
                    );
                }
            } else {
                $response = array(
                    "status" => "401",
                    "icon" => "error",
                    "msg" => "¡Usuario o contraseña incorrecto!",
                    "data" => ""
                );
            }
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

}
