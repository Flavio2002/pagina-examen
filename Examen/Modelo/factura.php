<?php 

class Factura{
private $id;
private $nrofactura;
private $nombrecliente;
private $direccion;
private $fecha ;
private $total;
private $detalle;
public function getId()
{
return $this->id;
}
public function setId($id)
{
$this->id = $id;

return $this;
}

public function getNrofactura()
{
return $this->nrofactura;
}

public function setNrofactura($nrofactura)
{
$this->nrofactura = $nrofactura;

return $this;
}

public function getNombrecliente()
{
return $this->nombrecliente;
}

public function setNombrecliente($nombrecliente)
{
$this->nombrecliente = $nombrecliente;

return $this;
}

public function getDireccion()
{
return $this->direccion;
}

public function setDireccion($direccion)
{
$this->direccion = $direccion;

return $this;
}

public function getFecha()
{
return $this->fecha;
}
public function setFecha($fecha)
{
$this->fecha = $fecha;

return $this;
}

public function getTotal()
{
return $this->total;
}
 
public function setTotal($total)
{
$this->total = $total;

return $this;
}

public function getDetalle()
{
return $this->detalle;
}

public function setDetalle($detalle)
{
$this->detalle = $detalle;

return $this;
}
}
?>