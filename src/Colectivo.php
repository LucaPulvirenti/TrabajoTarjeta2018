<?php

namespace TrabajoTarjeta;

class Colectivo implements ColectivoInterface {

    protected $linea; 
    protected $empresa;
    protected $numero;

    public function __construct($l,$e,$n){
        $this->linea=$l;
        $this->empresa=$e; 
        $this->numero=$n;

    }

    public function linea(){
        return $this->linea;
    }

    public function empresa(){
        return $this->empresa;
    }

    public function numero(){
        return $this->numero;
    } 

    

        
    public function pagarCon(TarjetaInterface $tarjet){
      
		if($tarjeta->pagar()== TRUE){

                    if ($tarjeta->usoplus()==TRUE){
                  $boleto = new boleto('0.0',$this,$tarjeta,'viaje plus', " "); 
		 $tarjeta->guardarUltimoBoleto($boleto);
                            return $boleto;
		}
 	else {
 	if($tarjeta->MostrarPlusDevueltos()==0){
            $boleto = new boleto($tarjeta->pago(),$this,$tarjeta,$tarjeta->tipotarjeta()," ");
	    $tarjeta->guardarUltimoBoleto($boleto); 
 		return $boleto;
			}

		else{
                $boleto = new boleto($tarjeta->pago(),$this,$tarjeta,$tarjeta->tipotarjeta(),"Paga ".(string)$tarjeta->MostrarPlusDevueltos()." Viaje Plus");
	$tarjeta->guardarUltimoBoleto($boleto);
	return $boleto;
							
		}
	}
		

	}


}
