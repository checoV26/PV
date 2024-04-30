<?php
class usuariosModel extends query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuario(string $usuario, string $pass)
    {
        $sql = "SELECT * FROM usuarios where usuario='$usuario' and status='A';";
        $data = $this->select($sql);
        return $data;
    }

    public function getUsuarios()
    {
        $sql = "SELECT u.id, u.usuario, CONCAT(u.nombre,' ',u.apellidoP,' ',u.apellidoM) AS nombre, u.status, c.nombre AS caja FROM usuarios u LEFT JOIN cajas c ON u.idCaja=c.id;";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCajas()
    {
        $sql = "SELECT * FROM cajas";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario(string $nombre, string $apellidoP, string $apellidoM, string $caja, string $user, string $pass)
    {
        $sql = "INSERT INTO usuarios(nombre, apellidoP, apellidoM, usuario, pass, idCaja) VALUES (?,?,?,?,?,?)";
        $verificar = "SELECT * FROM usuarios WHERE usuario='$user'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $hash = password_hash($pass,PASSWORD_DEFAULT);
            $datos = array($nombre, $apellidoM, $apellidoP, $user, $hash, $caja);
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

    public function updateUser(int $idUser, string $nombre, string $apellidoP, string $apellidoM, string $caja, string $user, string $pass)
    {
        $sql = $pass == "" ? "UPDATE usuarios SET nombre=?,apellidoP=?,apellidoM=?,usuario=?,idCaja=? WHERE id=? " : "UPDATE usuarios SET nombre=?,apellidoP=?,apellidoM=?,usuario=?,idCaja=?,pass=? WHERE id=?";
        $datos = $pass == "" ? array($nombre, $apellidoP, $apellidoM, $user, $caja, $idUser) : array($nombre, $apellidoP, $apellidoM, $user, $caja, password_hash($pass,PASSWORD_DEFAULT), $idUser);
        // Validamos si el usuario es diferente, verificar si el nuevo usuario no exista
        $verificar = "SELECT usuario FROM usuarios WHERE id='$idUser'";
        $existUser = $this->select($verificar);
        if ($existUser['usuario'] == $user) {
            $data = $this->save($sql, $datos);
            if ($data) {
                $res = 1;
            } else {
                $res = 0;
            }
        } else {
            $verificar = "SELECT * FROM usuarios WHERE usuario='$user'";
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
    public function dataUser(int $id)
    {
        $sql = "SELECT nombre,apellidoP,apellidoM,usuario,idCaja FROM usuarios WHERE id=$id";
        $data = $this->select($sql);
        return $data;
    }

    public function saveStatus(int $idUser, string $status)
    {
        $sql = "UPDATE usuarios SET status=? WHERE id=?";
        $datos = array($status, $idUser);
        $data = $this->save($sql, $datos);
        if ($data) {
            $res = 1;
        } else {
            $res = 0;
        }
        return $res;
    }
}
