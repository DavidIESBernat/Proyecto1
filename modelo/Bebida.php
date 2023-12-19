<?php
class Bebida extends Producto {
    private $ml; // Minilitros

    // Constrctor
    function __construct() {
        parent::__construct(); // Hereda el constructor de Producto
    }

    /**
     * Get the value of ml
     */ 
    public function getMl()
    {
        return $this->ml;
    }

    /**
     * Set the value of ml
     *
     * @return  self
     */ 
    public function setMl($ml)
    {
        $this->ml = $ml;

        return $this;
    }
}
?>