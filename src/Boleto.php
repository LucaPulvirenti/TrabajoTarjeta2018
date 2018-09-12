<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;

    protected $colectivo; 

    public $tarjeta; 
    
    protected $saldo;  
    
    protected $id;  
  
    protected $fecha 
    
    protected $tipotarjeta;
   
    protected $linea; 

    protected $totalabonado;

    protected $dineroplus;
 
    public function __construct($valor, $colectivo, $tarjeta) {
        $this->valor = $valor;
        $this->colectivo = $colectivo;
        $this->tarjeta = $tarjeta;
        $this->saldo = $tarjeta->obtenerSaldo();
        $this->id = $tarjeta->retornarID();
        $tiempo= time(); 
        $this->fecha = date("d/m/Y H:i:s",$tiempo) ."\n";
        $this->tipotarjeta= $this->clasetarjeta();
        $this->linea= $colectivo->linea();
        $this->totalabonado = $this->totalpagado();
        $this->dineroplus = $tarjeta->plataplus();

        
    }

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtenerValor() {
        return $this->valor;
    }

    /**
     * Devuelve un objeto que respresenta el colectivo donde se viajó.
     *
     * @return ColectivoInterface
     */
    public function obtenerColectivo() { 
         return $this->colectivo;

    } 


     public function totalpagado(){
               $totpag = ($tarjeta->monto+$tarjeta->plataplus());
               return $totpag;
       
          }

   public function clasetarjeta(){
     
    if($tarjeta->monto==14.8)
    {  $tipo = "franquicia comun"
        return $tipo;
    }
    
    if($tarjeta->monto==0.0){
      $tipo = "franquicia completa"; 
      return $tipo;
    }

    if($tarjeta->monto==7.4){ 
      $tipo= "medio boleto";
     return $tipo;
     }

    }

    


}
