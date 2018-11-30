<?php 

namespace TrabajoTarjeta;

interface TiempoInterface {

	public function reciente(); 

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


