<?php
class Bebida extends Producto {
    private $mL; // Minilitros

    // Constrctor
    function __construct() {
        parent::__construct(); // Hereda el constructor de Producto
    }

    /**
     * Get the value of mL
     */ 
    public function getML()
    {
        return $this->mL;
    }

    /**
     * Set the value of mL
     *
     * @return  self
     */ 
    public function setML($mL)
    {
        $this->mL = $mL;

        return $this;
    }
}
?>