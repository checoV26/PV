<?php
class views{
    public function getView($controllers, $view){
        $controlador=get_class($controllers);
        if($controlador=="home"){
            $vista="views/".$view.".php";
        }else{
            $vista="views/".$controlador."/".$view.".php";
        }
        require $vista;
    }
}
?>