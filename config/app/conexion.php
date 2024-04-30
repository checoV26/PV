<?php
class conexion
{
    private $conect;
    public function __construct()
    {
        $pod = "mysql:host=" . host . ";dbname=" . db . ";.charset.";
        try {
            $this->conect = new PDO($pod, user, pass);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "error en la conexion" . $e->getMessage();
        }
    }

    public function  conect()
    {
        return $this->conect;
    }
}
