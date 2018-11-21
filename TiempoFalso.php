<?php

class TiempoFalso implements TiempoInterface {


  protected $tiempo;

  public function time(){

    return $this->tiempo;
  } 

  public function __construct($IniciarEn = 0) {

  		$this->tiempo= $IniciarEn;

  }

  public function Avanzar ($segundos){

     $this->tiempo += $segundos;
  }

  public function reciente(){

    return $this->time();
  } 

  


}