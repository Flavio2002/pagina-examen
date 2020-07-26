<?php

class Detalle{


private $id;
private $cantidad;
private $precio;
private $producto;
public function getId()
{
return $this->id;
}

/**
 * Set the value of id
 *
 * @return  self
 */ 
public function setId($id)
{
$this->id = $id;

return $this;
}

/**
 * Get the value of cantidad
 */ 
public function getCantidad()
{
return $this->cantidad;
}

/**
 * Set the value of cantidad
 *
 * @return  self
 */ 
public function setCantidad($cantidad)
{
$this->cantidad = $cantidad;

return $this;
}

/**
 * Get the value of precio
 */ 
public function getPrecio()
{
return $this->precio;
}

/**
 * Set the value of precio
 *
 * @return  self
 */ 
public function setPrecio($precio)
{
$this->precio = $precio;

return $this;
}

/**
 * Get the value of producto
 */ 
public function getProducto()
{
return $this->producto;
}

/**
 * Set the value of producto
 *
 * @return  self
 */ 
public function setProducto($producto)
{
$this->producto = $producto;

return $this;
}
}


?>