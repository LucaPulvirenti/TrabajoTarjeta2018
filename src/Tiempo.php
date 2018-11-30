<?php

namespace TrabajoTarjeta;

class Tiempo implements TiempoInterface {

    public function reciente() {

    	return time();
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
}
