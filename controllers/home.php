<?php
class home extends controllers
{
    public function __construct()
    {
        session_start();
        if (!empty($_SESSION["activo"])) {
            header("location:" . base_url."usuarios");
        }
        parent::__construct();
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
}
