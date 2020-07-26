<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/Examen/dirs.php');
require_once CONEX_PATH."conexion.php";
require_once MODELO_PATH."categoria.php";
$object=new ControlProducto();
if(isset($_REQUEST["action"])){
    if($_GET['action']=="listar"){
        $object->all();
        exit();
    }
    if($_GET["action"]=="agregar"){
        $object->add();
        exit();
    }
    if($_GET["action"]=="eliminar"){
        $object->delete();
        exit();
    }
    if($_GET["action"]=="update"){
        $object->update();
        exit();
    }
}
class ControlProducto{
    public function all(){
        try{
            $con=Conexion::getinstancia();
            $sql="SELECT producto.id, producto.denominacion, producto.precio, producto.stock,producto.estado, categoria.nombre,categoria.id as cat
            FROM categoria  INNER JOIN producto  ON (categoria.id = producto.categoria_id) where producto.estado='Activo'";
            $resultado=$con->conex->prepare($sql);
            $resultado->execute();
            $detalles=$resultado->fetchAll(PDO::FETCH_ASSOC);
            return print_r(json_encode($detalles));
        }
        catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }
    }
    public function add(){
      $producto=json_decode(file_get_contents("php://input"));
        try{
            $con= Conexion::getinstancia();
            $sql="INSERT INTO producto(denominacion,precio,stock,categoria_id,estado) values(:denominacion,:precio,:stock,:categoria_id,:estado)";
            $resultado=$con->conex->prepare($sql);
            $resultado->bindValue(':denominacion',$producto->denominacion);
            $resultado->bindValue(':precio',$producto->precio);
            $resultado->bindValue(':stock',$producto->stock);
            $resultado->bindValue(':categoria_id',$producto->cat);
            $resultado->bindValue(':estado','Activo');
            $resultado->execute();
            return $resultado;
        }
        catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }

    }

    public function delete(){
        $producto=json_decode(file_get_contents("php://input"));
        try{
            $con=Conexion::getinstancia();
            
            $sql="UPDATE  producto set estado='Baja' where id=:id ";
            $resultado=$con->conex->prepare($sql);
            $resultado->bindValue(':id',$producto->id);
            $resultado->execute();
           
            return 1;
        }
        catch(Exception $e){
            die("hay un error en la linea " . $e->getLine());
        }
    }
    public function update(){
        $producto=json_decode(file_get_contents("php://input"));
          try{
              $con=Conexion::getinstancia();
              $sql="UPDATE producto set denominacion=:denominacion, precio=:precio,stock=:stock,categoria_id=:categoria_id where id=:id";
              $resultado=$con->conex->prepare($sql);
              $resultado->bindValue(':id',$producto->id);
              $resultado->bindValue(':denominacion',$producto->denominacion);
              $resultado->bindValue(':precio',$producto->precio);
              $resultado->bindValue(':stock',$producto->stock);
              $resultado->bindValue(':categoria_id',$producto->cat);
              $resultado->execute();
              return $resultado;
          }
          catch(Exception $e){
              die("hay un error en la linea " . $e->getLine());
          }
  
      }
}

?>