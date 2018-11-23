<?php 		

namespace TrabajoTarjeta;

class MedioBoletoUniversitario extends Tarjeta implements TarjetaInterface{

	protected $CantidadBoletos=0; 
	public $universitario= TRUE;
	public $monto= 7.4;
	

	public function PagoUniversitario (){

		if($this->Horas()==FALSE){ 
			$this->ReiniciarBoleto();
			$this->CambioMonto();
			$this->IncrementarBoleto();
			return $this->pagar();	
		} 
		else {
			if($this->ViajesRestantes()==TRUE) $this->IncrementarBoleto(); 
			$this->CambioMonto();
			return $this->pagar();
		}
		
	}

public function pagoMedioBoleto(){ 

    if($this->Horas()==FALSE){  
			$this->ReiniciarBoleto();
           if ($this->saldoSuficiente()){   
                  
          	    if($this->CantidadPlus()==0){
          	    			$this->CambioMonto();
          	    			$this->IncrementarBoleto();
          					$this->ultimopago();
          					$this->restarSaldo();
              				$this->reiniciarPlusDevueltos();
              				$this->ultimoTiempo = $this->tiempo->time(); 
          					return TRUE; 
    		    }

                else{
              				$this->ultimopago();
              				$this->plusdevuelto=$this->CantidadPlus();
              				$this->restarSaldo(); 
              				$this->RestarPlus(); 
             				$this->ultimoTiempo = $this->tiempo->time(); 
              				return TRUE;
                    }                     
                      
             }
                   
          else{

              	if ($this->CantidadPlus()<2){   
                			$this->plusdevuelto=0;
                			$this->ultimoplus = TRUE;
                			$this->IncrementoPlus();  
               				$this->ultimoTiempo = $this->tiempo->time(); 
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
              				$this->ultimoTiempo = $this->tiempo->time();  //almacenamos el ultimo tiempo
          					return TRUE; 
    		            }

                else{
              				$this->ultimopago();
              				$this->plusdevuelto=$this->CantidadPlus();
              				$this->restarSaldo(); 
              				$this->RestarPlus(); 
             				$this->ultimoTiempo = $this->tiempo->time(); 
              				return TRUE;
                    }                     
                      
          	} 
          		else{

              		if ($this->CantidadPlus()<2){   
                			$this->plusdevuelto=0;
                			$this->ultimoplus = TRUE;
                			$this->IncrementoPlus();  
               				$this->ultimoTiempo = $this->tiempo->time(); 
                			return TRUE;                
                  
               		}
              			
                }           


			
			}
			return FALSE;

}
	
    public function CambioMonto(){

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

			$this->CantidadBoletos==0;
			
		
	}

	public function ViajesRestantes(){
		if($this->CantidadBoletos<2) return TRUE; 
		else return FALSE;
	}


	public function Horas(){
		
		if($this->DevolverUltimoTiempo() != NULL){ 
 		
			if($this->tiempo->time() - $this->DevolverUltimoTiempo() < 60*60*24 ){
				return TRUE;									

			}
		}
		return FALSE;  //Horas devuelve falso cuando la tarjeta realizará su primer pago, o cuando haya pasado mas de 24 horas con respecto al ultimo pago

	}

}
