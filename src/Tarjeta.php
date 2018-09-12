<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    
    protected $saldo=0.0;
    public $monto=14.8;
    protected $viajeplus = 0; 
    protected $ultimoplus = FALSE; 
    protected $id; 
    protected $abonoplus = 0;
   

    public function CantidadPlus(){ 
      return $this->viajeplus;

    } 
  //esta funcion nos dice si el ultimo viaje fue un viaje plus//
   public function usoplus(){
               
    return $this->ultimoplus;
          }  
  
    public function IncrementoPlus(){

      $this->viajeplus +=1;
    } 
   
   //Indica cuanto dinero en viajes plus gastamos en el ultimo pasaje realizado//  
  public function plataplus(){
    return $this->abonoplus;
  } 

  public function restarSaldo() 
    {
      $this->abonoplus=$this->cantidadPlus()*14.8;
      $this->saldo -= ($this->monto+($this->cantidadPlus()*14.8));
    }  


     
 public function saldoSuficiente(){ 
         if ($this->saldo>=($this->monto+($this->cantidadPlus()*14.8))) 
         {
            return TRUE;
         } 
         else  {
            return FALSE;
         }

    }  




      public function pagar(){
        if ($this->saldoSuficiente()) 
        {    
          
             $this->restarSaldo();
             return TRUE;
        }
        else{

            if( ($this->CantidadPlus()<2) and ($this->obtenerSaldo()>=0) ) 
            {
                $this->IncrementoPlus();
                $this->ultimoplus=TRUE;
              return TRUE;
            }
            else 
            {
               return FALSE;
            }
        }
      
    }



    public function recargar($monto) {
      
      if($this->viajeplus==0){
       
      if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) { 
            $this->saldo += ($monto + 221.58);
          }
          else{
            if ($monto == 510.15){
              $this->saldo += ($monto+81.93);
            }
            else{
                $this->saldo += $monto;
            }
          }
      }
      else 
      {
        echo "El monto ingresado no es valido";
      }

    }  
     
     if($this->viajeplus==1){
       
      if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) { 
            $this->saldo += ($monto + 221.58 - 14.8);
          }
          else{
            if ($monto == 510.15){
              $this->saldo += ($monto+81.93 - 14.8);
            }
            else{
                $this->saldo += ($monto- 14.8);
            }
          }
          $this->viajeplus=0;
      }
      else 
      {
        echo "El monto ingresado no es valido";
      }
    } 
      if($this->viajeplus==2){
       
      if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) { 
            $this->saldo += ($monto + 221.58 - 29.6);
          }
          else{
            if ($monto == 510.15){
              $this->saldo += ($monto+81.93 - 29.6);
            }
            else{
                $this->saldo += ($monto- 29.6);
            }
          } 
          $this->viajeplus=0;
      }
      
      else 
      {
        echo "El monto ingresado no es valido";
      }

    }
  } 

    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    public function obtenerSaldo() {
      return $this->saldo;
    } 

    public function retornarID(){
     
     return $this->id;        

    }

    

} 

