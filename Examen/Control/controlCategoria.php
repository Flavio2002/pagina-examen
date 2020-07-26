<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/Examen/dirs.php');
require_once CONEX_PATH."conexion.php";
require_once MODELO_PATH."categoria.php";
$object=new ControlCategoria();
if(isset($_REQUEST["action"])){
    if($_GET['action']=="listar"){
        $object->all();
        exit();
    }  
}
class ControlCategoria{
    public function all(){
        try{
            $con=Conexion::getinstancia();
            $sql="SELECT * FROM categoria";
            $resultado=$con->conex->prepare($sql);
            $resultado->execute();
            $detalles=$resultado->fetchAll(PDO::FETCH_ASSOC);
            return print_r(json_encode($detalles));
        }
        catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }
    }
}
?>