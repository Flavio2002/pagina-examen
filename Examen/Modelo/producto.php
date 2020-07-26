<?php
class Producto{
private $id;
private $denominacion;
private $precio;
private $stock;
private $categoria;
public function getId()
{
return $this->id;
}
public function setId($id)
{
$this->id = $id;

return $this;
}
public function getDenominacion()
{
return $this->denominacion;
}

public function setDenominacion($denominacion)
{
$this->denominacion = $denominacion;

return $this;
}
 
public function getPrecio()
{
return $this->precio;
}

public function setPrecio($precio)
{
$this->precio = $precio;

return $this;
}
 
public function getStock()
{
return $this->stock;
}


public function setStock($stock)
{
$this->stock = $stock;

return $this;
}


public function getCategoria()
{
return $this->categoria;
}


public function setCategoria($categoria)
{
$this->categoria = $categoria;

return $this;
}
}
?>