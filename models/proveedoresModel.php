<?php
class proveedoresModel extends query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuarios()
    {
        $sql = "SELECT * FROM proveedor;";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarProveedor(string $nombre, string $telefono, string $correo, string $pWeb, string $desc)
    {
        $sql = "INSERT INTO proveedor(nombre, telefono, correoElectronico, paginaWeb, descripcion) VALUES (?,?,?,?,?)";
        $verificar = "SELECT * FROM proveedor WHERE nombre='$nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $datos = array($nombre, $telefono, $correo, $pWeb, $desc);
            $data = $this->save($sql, $datos);
            if ($data) {
                $res = 1;
            } else {
                $res = 0;
            }
        } else {
            $res = 2;
        }
        return $res;
    }
    public function updateProveedor(int $id, string $nombre, string $telefono, string $correo, string $pWeb, string $desc)
    {
        $sql = "UPDATE proveedor SET nombre=?,telefono=?,correoElectronico=?,paginaWeb=?,descripcion=? WHERE id=?";
        $datos = array($nombre, $telefono, $correo, $pWeb, $desc, $id);
        $verificar = "SELECT * FROM proveedor WHERE id='$id'";

        $existeProv = $this->select($verificar);
        if ($existeProv['nombre'] == $nombre) {
            $data = $this->save($sql, $datos);
            if ($data) {
                $res = 1;
            } else {
                $res = 0;
            }
        } else {
            $verificar = "SELECT * FROM proveedor WHERE nombre='$nombre'";
            $existe = $this->select($verificar);
            if (empty($existe)) {
                $data = $this->save($sql, $datos);
                if ($data) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2;
            }
        }
        return $res;
    }

    public function dataProveedor(int $id)
    {
        $sql = "SELECT nombre,telefono,correoElectronico,paginaWeb,descripcion FROM proveedor WHERE id=$id";
        $data = $this->select($sql);
        return $data;
    }

    public function updateStatus(int $id, string $status)
    {
        $sql = "UPDATE proveedor SET status=? WHERE id=?";
        $datos = array($status, $id);
        $data = $this->save($sql, $datos);
        if ($data) {
            $res = 1;
        } else {
            $res = 0;
        }
        return $res;
    }
}
