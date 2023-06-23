<?php
class Pedidos {
    private $idPedido;
    private $fecha;
    private $nombreCliente;
    private $precioTotal;
    private $direccionEnvio;
    private $productoId;

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }
}
?>