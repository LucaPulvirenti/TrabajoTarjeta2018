<?php

class TiempoFalso implements TiempoInterface {


  protected $tiempo;
 
 public function __construct($IniciarEn = 0) {

      $this->tiempo= $IniciarEn;

  } 

    public function reciente(){

    return $this->tiempo;
  } 
  

  public function time(){

    return $this->time();
  } 

 

  public function Avanzar ($segundos){

     $this->tiempo += $segundos;
  }



  


}