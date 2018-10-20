<?php

namespace TrabajoTarjeta;

class MedioBoleto extends Tarjeta {

 public $monto = 7.4;

 public function restarSaldo($medio) 
    {
    	if($medio)
    	{
	    	$this->saldo -= ($this->monto+$this->CantidadPlus()*$this->monto*2);
	    	$this->viajeplus = 0;
    	}
    	else
    	{
    		$this->saldo -= ($this->monto*2+$this->CantidadPlus()*$this->monto*2);
	    	$this->viajeplus = 0;
    	}
    }

} 
