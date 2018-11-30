<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface
{
    
    
    protected $tiempo;
    
    public function __construct($IniciarEn = 0)
    {
        
        $this->tiempo = $IniciarEn;
        
    }
    
    public function reciente()
    {
        
        return $this->tiempo;
    }

    
    public function esFeriado()
    {
        return FALSE;
    }

    public function esDeNoche()
    {
        return FALSE;
    }

    public function esFinDeSemana()
    {
        return FALSE;
    }

    public function esDiaSemana()
    {
        return TRUE;
    }
    
    public function Avanzar($segundos)
    {
        
        $this->tiempo += $segundos;
    }
    
    
    
    
    
    
}
