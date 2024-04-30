<?php

class controllers
{
    protected $model;
    protected $views;

    public function __construct()
    {
        $this->views=new views();
        $this->loadModel();
    }

    protected function loadModel()
    {
        $model = get_called_class() . "Model";
        $ruta = "models/" . $model . ".php";

        if (file_exists($ruta)) {
            require_once $ruta;
            $this->model = new $model();
        } else {
            echo "El archivo del modelo no existe: " . $ruta;
        }
    }
}
