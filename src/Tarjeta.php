<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    
    protected $saldo=0;
    public $monto = 14.8;
    protected $viajeplus=0;
    protected $ID;
    protected $ultboleto = NULL;
    protected $tipo = 'franquicia normal'; 
    protected $tiempo;
    protected $ultimoplus = FALSE;
    protected $fechault; 
    protected $horault; 
    protected $pago;
    protected $plusdevuelto=0;
    public $universitario= FALSE;
  

    public function __construct(TiempoInterface $tiempo){
      $this->saldo = 0.0;
      $this->viajeplus = 0;
      $this->ID = rand(0,100);
      $this->ultboleto = NULL; 
      $this->tiempo = $tiempo;
    }
 
 public function MostrarPlusDevueltos(){
    
    return $this->plusdevuelto;         //esta funcion sirve para mostrar la cantidad de plus que pago el usuario en su ultimo viaje
    }

    public function DevolverTiempo(){

      return $this->tiempo;
    } 

    public function reiniciarPlusDevueltos(){

      $this->plusdevuelto=0;
    }

     public function usoplus(){
               
    return $this->ultimoplus; //ultimo plus es TRUE si el ultimo viaje realizado fue un viaje plus
          }  
          
     public function ultimopago(){    //retorna la cantidad de dinero gastado en el ultimo viaje
     
     $this->pago = $this->monto+ ($this->CantidadPlus()* 14.8); 
     
     } 

     public function devolverUltimoPago(){

      return $this->pago;
     }
      
      public function tipotarjeta(){    //indica si la tarjeta es una franquicia normal, media o completa
  
      if($this->monto==14.8) {
        return $this->tipo;
         }
      else{
      		if($this->monto== 7.4){

            if($this->universitario==TRUE){
              $tipo= 'medio universitario';
              return $tipo;
            }
      		$tipo= 'media franquicia estudiantil'; 
      		return $this->tipo;
      		}
      		$tipo = 'franquicia completa'; 
      		return $tipo;
      }
         
}     

    public function CantidadPlus(){ 
      return $this->viajeplus;

    }


    public function IncrementoPlus(){

      $this->viajeplus +=1;
    } 

    public function RestarPlus(){

      $this->viajeplus =0;
    }


    public function saldoSuficiente(){ 
         if ($this->obtenerSaldo()>=($this->monto+$this->CantidadPlus()*14.8)) 
         {
            return TRUE;
         } 
         else  {
            return FALSE;
         }

    } //indica si tenemos saldo suficiente para pagar un viaje

     public function pagar(){ 
    
    if (($this->tipotarjeta() == 'media franquicia' || $this->tipotarjeta()== 'medio universitario')&& $tarjeta->obtenerUltBoleto() != NULL) {
           
           $ultimoboleto = $this->obtenerUltBoleto();
           $fechault = $boleto->obtenerFecha();
           $horault = $boleto->obtenerHora();
           $lista = explode(':', $horault);
           $h = (int)$lista[0];
           $m = (int)$lista[1];
           $s = (int)$lista[2];
           $this->tiempo = $m+$this->tiempo;

           if ($fechault == date('d-m-Y')){
                if($h==(int)date('H') && (($this->tiempo)+5)<((int)date('m')))
                {
                        if ($this->saldoSuficiente()) 
                        {   
                        
                        	if($this->CantidadPlus==0){
                            $this->ultimopago();
                            $this->restarSaldo();
														$this->reiniciarPlusDevueltos();
                            $this->tiempo=0;
                            return TRUE; 
                          }
                            else{
                            $this->ultimopago();
                            $this->plusdevuelto=$this->CantidadPlus();
                            $this->restarSaldo(); 
                            $this->RestarPlus(); 
                            $this->tiempo=0;
                              return TRUE;
                            }
                            
                            }
                         
                          else{

                            if ($this->CantidadPlus()<2) 
                            {   $this->plusdevuelto=0;
                                $this->ultimoplus = TRUE;
                                $this->IncrementoPlus(); 
                                $this->tiempo=0;
                                return TRUE;
                                
                            }
                            return FALSE;
                         }
                           
                               
                        }
             }

             else{

                return FALSE;

             }

          }
  

  else { 

     if ($this->saldoSuficiente()) 
                        {   
                          if($this->CantidadPlus()==0){
                            $this->ultimopago();
                            $this->restarSaldo();
														$this->plusdevuelto=0;
                            return TRUE; } 
                            
                            else{
                               $this->plusdevuelto = $this->CantidadPlus();
                          
                               $this->restarSaldo(); 

                                $this->RestarPlus();
                
                            }
                            	return TRUE;
                            }
                         
                          else{

                            if ($this->CantidadPlus()<2) 
                            {		$this->plusdevuelto=0;
                                $this->ultimoplus = TRUE;
                                $this->IncrementoPlus();
                                return TRUE;
                                
                            }
                            else 
                            {
                               return FALSE;
                            }
            
                   
                 }

                 }
}

 




    public function recargar($monto) {
 
      if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) { 
            $this->saldo += ($monto + 221.58);
            return true;
          }
          else{
            if ($monto == 510.15){
              $this->saldo += ($monto+81.93);
              return true;
            }
            else{
                $this->saldo += $monto;
                return true;
            }
          } 
          
       }
      
      else 
      {
        return false;

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

    public function restarSaldo() 
    {
      $this->saldo -= ($this->monto+$this->CantidadPlus()*14.8);
      $this->viajeplus = 0;
    }  

    public function obtenerID(){
      return $this->ID;
    }

    public function guardarUltimoBoleto($boleto){
      $this->ultboleto = $boleto;


    }

    public function obtenerUltBoleto(){
      return $this->ultboleto;
    }
}
