<?php 	

class MedioBoletoUniversitario extends Tarjeta Implements TarjetaInterface{

	protected $CantidadBoletos=0; 
	public $universitario= TRUE;
	protected $monto= 7.4;

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
	return TRUE;

	}

	public function Horas(){
		
		if($this->obtenerUltimoBoleto() != NULL){ 
 		
 		$boleto = $this->obtenerUltimoBoleto();
		
		if($boleto->fecha()== date('d-m-Y')){
				return TRUE;

			}
		}
		return FALSE;  //Horas devuelve falso cuando la tarjeta realizará su primer pago, o cuando haya pasado mas de 24 horas con respecto al ultimo pago

	}

}