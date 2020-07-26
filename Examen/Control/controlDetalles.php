<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/Examen/dirs.php');
require_once CONEX_PATH."conexion.php";
require_once MODELO_PATH."detalle.php";
require_once CONTROL_PATH.'controlFactura.php';
require_once MODELO_PATH."factura.php";
$object=new ControlDetalles();
if(isset($_REQUEST["action"])){
    
    if($_GET["action"]=="newDetail"){
        $objfact=new Factura();
        $objdet=new Detalle();
        $detalle=json_decode(file_get_contents("php://input"));
        $objdet->setCantidad($detalle->cantidad);
        $objdet->setPrecio($detalle->precio);
        $objdet->setProducto($detalle->producto_id);
        $object->add($objdet);
        $iddet=$object->ultimo();
        $objfact->setNrofactura($detalle->nrofactura);
        $objfact->setNombrecliente($detalle->nombrecliente);
        $objfact->setDireccion($detalle->direccion);
        $objfact->setFecha($detalle->fecha);
        $objfact->setTotal($detalle->total);
        $objfact->setDetalle($iddet);
        $ctrlf=new controlFactura();
        $ctrlf->add($objfact);
        exit();
    }
    
    if($_GET["action"]=="delDetail"){
        $object->delete();
        exit();
    }
    if($_GET["action"]=="ultimo"){
       
        exit();
    }
}else{
    if(isset($_REQUEST["ac"])){
        if($_GET["ac"]=="listar"){
            $object->all();
            exit();
        }  
    }}
class ControlDetalles{
    public function all(){
        try{
            $con=Conexion::getinstancia();
            $sql="SELECT detalle.id, detalle.cantidad,detalle.precio as dp ,producto.denominacion,producto.precio as pp from producto inner join detalle on (producto.id=detalle.producto_id)";
            $resultado=$con->conex->prepare($sql);
            $resultado->execute();
            $detalles=$resultado->fetchAll(PDO::FETCH_ASSOC);
            return print_r(json_encode($detalles));
        }catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }
    }
    public function add(Detalle $detalle){
        try{
            $con=Conexion::getinstancia();
            $sql="INSERT INTO detalle( cantidad, precio, producto_id) values( :cantidad, :precio, :producto_id)";
            $resultado=$con->conex->prepare($sql);
            $resultado->bindValue(':cantidad',$detalle->getCantidad());
            $resultado->bindValue(':precio',$detalle->getPrecio());
            $resultado->bindValue(':producto_id',$detalle->getProducto());
            $resultado->execute();
        }
        catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }

    }
    public function ultimo(){
        try{

            $con=Conexion::getinstancia();
            $sql="SELECT * FROM detalle";
            $resultado=$con->conex->prepare($sql);
            $resultado->execute();
            $detalles=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $r1=$detalles[count($detalles)-1];
            $id=$r1['id'];
            return $id;
        }
        catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }
    }

    public function delete(){
        $detalle=json_decode(file_get_contents("php://input"));
        try{
            $con=new Conexion();
            $con::getinstancia();
            $sql="DELETE  FROM detalle where id=:id";
            $resultado=$con->conex->prepare($sql);
            $resultado->bindValue(':id',$detalle->id);
            $resultado->execute();
            
            return $resultado;
        }
        catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }
    }

}


?>