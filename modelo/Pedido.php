<?php
class Pedido {
    private $producto;
    private $cantidad = 1;

    public function __construct($producto) {
        $this->producto = $producto;
    }
    
    public function compararPedido(Pedido $pedido) {
        // Aquí defines la lógica para comparar los pedidos
        // En este ejemplo, comparo los IDs de los productos
        return $this->producto->getId() === $pedido->producto->getId();
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
}


?>