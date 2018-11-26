<?php 		

namespace TrabajoTarjeta;

class MedioBoletoUniversitario extends Tarjeta implements TarjetaInterface{

	protected $CantidadBoletos=0; 
	public $universitario= TRUE;
	public $monto= 7.4;
	

public function pagoMedioBoleto(){ 

    if($this->Horas()==FALSE){  
			//$this->ReiniciarBoleto();
           if ($this->saldoSuficiente()){   
                  
          	    if($this->CantidadPlus()==0){
          	    			$this->CambioMonto();
          	    			$this->IncrementarBoleto(); 
                      $this->ultimoplus = FALSE;
          					$this->ultimopago();
          					$this->restarSaldo();
              				$this->reiniciarPlusDevueltos();
              				$this->ultimoTiempo = $this->tiempo->reciente(); 
          					return TRUE; 
    		    }

                else{
              				$this->ultimopago(); 
                      $this->ultimoplus = FALSE;
              				$this->plusdevuelto=$this->CantidadPlus();
              				$this->restarSaldo(); 
              				$this->RestarPlus(); 
             				$this->ultimoTiempo = $this->tiempo->reciente(); 
              				return TRUE;
                    }                     
                      
             }
                   
          else{

              	if ($this->CantidadPlus()<2){   
                			$this->plusdevuelto=0;
                			$this->ultimoplus = TRUE;
                			$this->IncrementoPlus();  
               				$this->ultimoTiempo = $this->tiempo->reciente(); 
                			return TRUE;                
                  
               		 }
              				return FALSE;
              }           
               
    }
				
			if($this->tiempo->reciente() - $this->DevolverUltimoTiempo() > 5*60){
						if ($this->saldoSuficiente()){   
                  
          	   			 if($this->CantidadPlus()==0){
          	    			$this->CambioMonto();
          					$this->ultimopago();  //guardamos el ultimo pago
          					$this->restarSaldo(); //restamos el saldo
              				$this->reiniciarPlusDevueltos();  //reiniciamos la cantidad de viajes plus
              				$this->IncrementarBoleto();   //aumentamos en 1 la cantidad de boletos que podemos usar en el dia
              				$this->ultimoTiempo = $this->tiempo->reciente();  //almacenamos el ultimo tiempo
          					return TRUE; 
    		            }

                else{
              				$this->ultimopago();
              				$this->plusdevuelto=$this->CantidadPlus();
              				$this->restarSaldo(); 
              				$this->RestarPlus(); 
             				$this->ultimoTiempo = $this->tiempo->reciente(); 
              				return TRUE;
                    }                     
                      
          	} 
          		else{

              		if ($this->CantidadPlus()<2){   
                			$this->plusdevuelto=0;
                			$this->ultimoplus = TRUE;
                			$this->IncrementoPlus();  
               				$this->ultimoTiempo = $this->tiempo->reciente(); 
                			return TRUE;                
                  
               		}
              			
                }           


			
			}
			return FALSE;

}
	
    public function CambioMonto(){

    $this->Horas();
	if($this->ViajesRestantes()== TRUE){ 
	$this->monto=7.4;
	return $this->monto;
	}
	$this->monto= 14.8; 
	return $this->monto;
	}

	public function IncrementarBoleto(){

		$this->CantidadBoletos +=1;
		return $this->CantidadBoletos;
	}

	public function ReiniciarBoleto(){

			$this->CantidadBoletos=0;
			
		
	}

	public function ViajesRestantes(){
		if($this->CantidadBoletos<2) return TRUE; 
		else return FALSE;
	}

	public function DevolverCantidadBoletos(){

		return $this->CantidadBoletos;
	}


	public function Horas(){
		
		if($this->DevolverUltimoTiempo() != NULL){ 
 		
			if($this->tiempo->reciente() - $this->DevolverUltimoTiempo() < 60*60*24 ){
				return TRUE;									

			}

		$this->ReiniciarBoleto();
		return FALSE;  //Horas devuelve falso cuando la tarjeta realizará su primer pago, o cuando haya pasado mas de 24 horas con respecto al ultimo pago
		 }

	}


}
