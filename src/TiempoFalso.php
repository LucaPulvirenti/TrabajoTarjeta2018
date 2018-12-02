<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface
{
    
    
    protected $tiempo;
    public $estado =FALSE;

    
    public function __construct($IniciarEn = 0)
    {
        
        $this->tiempo = $IniciarEn;
        
    }
    
    public function reciente()
    {
        
        return $this->tiempo;
    }

     public function setTrue($valorASetear)
    {
        $valorASetear = TRUE;
        return $valorASetear;
    }
    
    public function esFeriado()
    {
       return $this->estado;
    }

    public function esDeNoche()
    {
       return $this->estado;
    }

    public function esFinDeSemana()
    {
        return $this->estado;
    }

    public function esDiaSemana()
    {
        return !$this->estado;
    } 

     public function setTrue($valorASetear)
    {
        $valorASetear = TRUE;
        return $valorASetear;
    }
    
    public function Avanzar($segundos)
    {
        
        $this->tiempo += $segundos;
    }
    
    
    
    
    
    
}
