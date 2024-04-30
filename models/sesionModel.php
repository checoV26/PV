<?php
class sesionModel extends query
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
}
