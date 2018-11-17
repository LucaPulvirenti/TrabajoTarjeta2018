<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface {

  protected $tiempo; 

  public function __construct($IniciarEn = 0) {

  		$this->tiempo= $IniciarEn;

  }

  public function Avanzar ($segundos){

     $this->tiempo += $segundos;
  }

  public function time() {

  	return $this->tiempo;
  }

}