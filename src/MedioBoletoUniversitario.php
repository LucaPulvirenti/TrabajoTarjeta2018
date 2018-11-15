<?php 	

class MedioBoletoUniversitario extends Tarjeta Implements TarjetaInterface{

	protected $CantidadBoletos; 
	public $universitario= TRUE;
	protected $monto= 7.4;

	public function PagoUniversitario (){
		if($this->ViajesRestantes==TRUE){

			$this->IncrementarBoleto();
			$this->pagar();
			if($this->pagar()==TRUE) return TRUE;
			else return FALSE;
		}
		$this->CambioMonto(); 
		$this->pagar(); 
		if($this->pagar()==TRUE) return TRUE;
			else return FALSE;


	}

	public function CambioMonto(){

	$this->monto= 14.8; 
	return $this->monto;
	}

	public function IncrementarBoleto(){

		$this->CantidadBoletos +=1;
		return $this->CantidadBoletos;
	}

	public function ViajesRestantes(){
		if($this->CantidadBoletos<2) return TRUE; 
		else return FALSE;

	}

}