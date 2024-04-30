<?php

class usuarios extends controllers
{

    public function __construct()
    {
        session_start();
        if (empty($_SESSION["activo"])) {
            header("location:" . base_url);
        }
        parent::__construct();
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }

    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {

            if ($data[$i]['status'] == "A") {
                $data[$i]['status'] = '<div class="justify-content-center d-flex"><span class="badge badge-success"><i class="fas fa-user-check"></i></span></div>';
                $data[$i]['acciones'] = '
                <div class="justify-content-start d-flex">
                    <button class="btn btn-outline-primary btn-sm" type="button" title="Editar" onclick="editarUsuario(' . $data[$i]['id'] . ')"><i class="fas fa-user-edit"></i></button>
                    <button class="btn btn-outline-danger btn-sm ml-2" type="button" title="Baja" onclick="statusUser(' . $data[$i]['id'] . ',' . "'B'" . ')"><i class="fas fa-user-times"></i></button>
                </div>
            ';
            } else {
                $data[$i]['status'] = '<div class="justify-content-center d-flex"><span class="badge badge-danger"><i class="fas fa-user-times"></i></span></div>';
                $data[$i]['acciones'] = '
                <div class="justify-content-start d-flex">
                    <button class="btn btn-outline-success btn-sm ml-2" type="button" title="Activar" onclick="statusUser(' . $data[$i]['id'] . ',' . "'A'" . ')"><i class="fas fa-user-check"></i></button>
                </div>
            ';
            }
        }
        echo json_encode(array("data" => $data), JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $idUser = $_POST["idUser"];
        $nombre = $_POST["nombre"];
        $apellidoP = $_POST["apellidoP"];
        $apellidoM = $_POST["apellidoM"];
        $caja = $_POST["caja"];
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $cPass = $_POST["cPass"];

        if ($idUser == "") {
            if (empty($nombre) || empty($apellidoP) || empty($apellidoM) || empty($caja) || empty($user) || empty($pass) || empty($cPass)) {
                $response = array(
                    "status" => "401",
                    "icon" => "info",
                    "msg" => "¡Todos los campos son obligatorios!",
                    "data" => ""
                );
            } else if ($pass != $cPass) {
                $response = array(
                    "status" => "401",
                    "icon" => "info",
                    "msg" => "¡Las contraseña no coincide!",
                    "data" => ""
                );
            } else {
                $data = $this->model->registrarUsuario($nombre, $apellidoP, $apellidoM, $caja, $user, $pass);
                if ($data == 1) {
                    $response = array(
                        "status" => "200",
                        "icon" => "success",
                        "msg" => "¡Guardado!",
                        "data" => $data
                    );
                } else if ($data == 0) {
                    $response = array(
                        "status" => "401",
                        "icon" => "error",
                        "msg" => "¡Ocurrió un error al guardar!",
                        "data" => $data
                    );
                } else {
                    $response = array(
                        "status" => "401",
                        "icon" => "info",
                        "msg" => "¡El usuario ya existe!",
                        "data" => $data
                    );
                }
            }
        } else {
            if (empty($nombre) || empty($apellidoP) || empty($apellidoM) || empty($caja) || empty($user)) {
                $response = array(
                    "status" => "401",
                    "icon" => "info",
                    "msg" => "¡Todos los campos son obligatorios!",
                    "data" => ""
                );
            } else if ($pass != $cPass) {
                $response = array(
                    "status" => "401",
                    "icon" => "info",
                    "msg" => "¡Las contraseña no coincide!",
                    "data" => ""
                );
            } else {
                $data = $this->model->updateUser($idUser, $nombre, $apellidoP, $apellidoM, $caja, $user, $pass);
                if ($data == 1) {
                    $response = array(
                        "status" => "200",
                        "icon" => "success",
                        "msg" => "¡Actualizado!",
                        "data" => $data
                    );
                } else if ($data == 0) {
                    $response = array(
                        "status" => "401",
                        "icon" => "error",
                        "msg" => "¡Ocurrió un error al actualizar!",
                        "data" => $data
                    );
                } else {
                    $response = array(
                        "status" => "401",
                        "icon" => "error",
                        "msg" => "¡El usuario ya existe!",
                        "data" => $data
                    );
                }
            }
        }


        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->dataUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function status()
    {
        $id = $_POST["id"];
        $status = $_POST["status"];
        if (empty($id) || empty($status)) {
            $response = array(
                "status" => "401",
                "icon" => "warning",
                "msg" => "¡Los campos están vacíos!",
                "data" => ""
            );
        } else {

            $data = $this->model->saveStatus($id, $status);
            if ($data == 1) {
                $response = array(
                    "status" => "200",
                    "icon" => "success",
                    "msg" => "¡Actualizado!",
                    "data" => $data
                );
            } else {
                $response = array(
                    "status" => "401",
                    "icon" => "info",
                    "msg" => "¡Error al actualizar estatus!",
                    "data" => $data
                );
            }
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listarCajas()
    {
        $select = "";
        $data = $this->model->getCajas();
        foreach ($data as $row) {
            $select .= '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
        }
        echo $select;
        die();
    }

    public function salir()
    {
        session_destroy();
        header("location:".base_url);
    }
}
