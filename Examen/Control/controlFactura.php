<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/Examen/dirs.php');
require_once CONEX_PATH."conexion.php";
require_once MODELO_PATH."factura.php";
require_once MODELO_PATH."detalle.php";
$object=new ControlFactura();
if(isset($_REQUEST["action"])){
    if($_GET['action'=="listar"]){
        $object->all();
        exit();
    }
   
    if($_GET["action"]=="eliminar"){
        $object->delete();
        exit();
    }
}
class ControlFactura{
    public function all(){
        try{
            $con=new Conexion();
            $con::getinstancia();
            $sql="SELECT * FROM factura";
            $resultado=$con->conex->prepare($sql);
            $resultado->execute();
            $detalles=$resultado->fetchAll(PDO::FETCH_ASSOC);
            return $detalles;
        }
        catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }
    }
    public function add(Factura $factura){
     
        try{

            $con=Conexion::getinstancia();
            $sql="INSERT INTO factura(nrofactura,nombrecliente,direccion,fecha,total,detalle_id) values(:nrofactura,:nombrecliente,:direccion,:fecha,:total,:detalle_id)";
            $resultado=$con->conex->prepare($sql);
            $resultado->bindValue(':nrofactura',$factura->getNrofactura());
            $resultado->bindValue(':nombrecliente',$factura->getNombrecliente());
            $resultado->bindValue(':direccion',$factura->getDireccion());
            $resultado->bindValue(':fecha',$factura->getFecha());
            $resultado->bindValue(':total',$factura->getTotal());
            $resultado->bindValue(':detalle_id',$factura->getDetalle());
            $resultado->execute();
            return $resultado;
        }
        catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }

    }

    public function delete(){
        $factura=json_decode(file_get_contents("php://input"));
        try{
            $con=new Conexion();
            $con::getinstancia();
            $sql="DELETE  FROM factura where id=:id";
            $resultado=$con->conex->prepare($sql);
            $resultado->bindValue(':id',$factura->id);
            $resultado->execute();
            $detalles=$resultado->fetchAll(PDO::FETCH_ASSOC);
            return $detalles;
        }
        catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }
    }
}
?>