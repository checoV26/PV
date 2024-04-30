<?php

class proveedores extends controllers
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

    public function save(){
        $idProveedor = $_POST["idProveedor"];
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $pWeb = $_POST["pWeb"];
        $desc = $_POST["desc"];

        if ($idProveedor == ""){
            if(empty($nombre) || empty($telefono) || empty($correo)){
                $response = array(
                    "status" => "401",
                    "icon" => "info",
                    "msg" => "¡Todos los campos son obligatorios!",
                    "data" => ""
                );
            }else{
                $data = $this->model->registrarProveedor($nombre,$telefono,$correo,$pWeb,$desc);
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
                        "msg" => "¡El proveedor ya existe!",
                        "data" => $data
                    );
                }
            }
        }else{
            if(empty($nombre) || empty($telefono) || empty($correo)){
                $response = array(
                    "status" => "401",
                    "icon" => "info",
                    "msg" => "¡Todos los campos son obligatorios!",
                    "data" => ""
                );
            }else{
                $data = $this->model->updateProveedor($idProveedor,$nombre,$telefono,$correo,$pWeb,$desc);
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
                        "icon" => "info",
                        "msg" => "¡El proveedor ya existe!",
                        "data" => $data
                    );
                }
            }

        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['status'] == "A") {
                $data[$i]['status'] = '<div class="justify-content-center d-flex"><span class="badge badge-success"><i class="fas fa-user-check"></i></span></div>';
                $data[$i]['acciones'] = '
                <div class="justify-content-start d-flex">
                    <button class="btn btn-outline-primary btn-sm" type="button" title="Editar" onclick="datosProv(' . $data[$i]['id'] . ')"><i class="fas fa-user-edit"></i></button>
                    <button class="btn btn-outline-danger btn-sm ml-2" type="button" title="Baja" onclick="statusProveedor(' . $data[$i]['id'] . ',' . "'B'" . ')"><i class="fas fa-user-times"></i></button>
                    <button class="btn btn-outline-secondary btn-sm ml-2" type="button" title="Contactos"><i class="fas fa-id-card-alt"></i></button>
                </div>
            ';
            } else {
                $data[$i]['status'] = '<div class="justify-content-center d-flex"><span class="badge badge-danger"><i class="fas fa-user-times"></i></span></div>';
                $data[$i]['acciones'] = '
                <div class="justify-content-start d-flex">
                    <button class="btn btn-outline-success btn-sm ml-2" type="button" title="Activar" onclick="statusProveedor(' . $data[$i]['id'] . ',' . "'A'" . ')"><i class="fas fa-user-check"></i></button>
                </div>
            ';
            }
            $data[$i]['descripcion'] = substr($data[$i]['descripcion'], 0, 20).' <i class="fas fa-caret-right" title="'.$data[$i]['descripcion'].'"></i>';
        }
        echo json_encode(array("data" => $data), JSON_UNESCAPED_UNICODE);
        die();
    }
    public function datos(int $id)
    {
        $data = $this->model->dataProveedor($id);
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

            $data = $this->model->updateStatus($id, $status);
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
}
