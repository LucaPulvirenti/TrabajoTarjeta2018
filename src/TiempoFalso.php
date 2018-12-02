<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface
{
    
    
    protected $tiempo;
    protected $estado =FALSE;
    protected $estadoDiaSemana;

    
    public function __construct($IniciarEn = 0)
    {
        
        $this->tiempo = $IniciarEn;
        
    }

    public function devolverEstado()
    {
        return $this->estado;
    }
    
    public function reciente()
    {
        
        return $this->tiempo;
    }

     public function setTrue(TiempoFalso $EstadoASetear)
    {
        $EstadoASetear->estado = TRUE;
        return $EstadoASetear;
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
        if($this->estado) $this->estadoDiaSemana = FALSE;
        else $this->estadoDiaSemana = TRUE;
        return $this->estadoDiaSemana;
    } 

    public function Avanzar($segundos)
    {
        
        $this->tiempo += $segundos;
    }
    
    
    
    
    
    
}
