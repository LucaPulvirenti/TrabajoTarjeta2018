<?php 

namespace TrabajoTarjeta;

interface TiempoInterface {

	public function reciente(); 

	public function esFeriado();

    public function esDeNoche();
    
    public function esFinDeSemana();
    
    public function esDiaSemana();
    

}


