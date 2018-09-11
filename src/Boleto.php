<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;

    protected $colectivo; 

    public $tarjeta; 
    
    protected $saldo;  
    
    protected $id; 

    protected $plataplus; 
  
    protected $fecha 
    
    protected $tipotarjeta;
   
    protected $linea; 

    protected $totalabonado;
 
    public function __construct($valor, $colectivo, $tarjeta) {
        $this->valor = $valor;
        $this->colectivo = $colectivo;
        $this->tarjeta = $tarjeta;
        $this->saldo = $tarjeta->obtenerSaldo();
        $this->id = $tarjeta->retornarID();
        $this->plataplus= $plataplus; 
        $tiempo= time(); 
        $this->fecha = date("d/m/Y H:i:s",$tiempo) ."\n";
        $this->tipotarjeta= $this->clasetarjeta;
        $this->linea= $this->lineacolectivo; 
        $this->totalabonado = $totalabonado;
        
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
               if($tarjeta->usoplus==FALSE){
               $plus = ($tarjeta->CantidadPlus*14.8);
               $total = ($plus + ($tarjeta->$monto) );  
               return $total;
                              }
            else{
                    $p = "viaje plus"; 
                 return $p;
               }
       
          }
      
    public function saldo(){

    return $tarjeta->obtenerSaldo();
    } 

     public function id(){

    return $tarjeta->retornarID();
    }
    
  
    public function plataplus(){
     $cantidad = ($tarjeta->CantidadPlus()*14.8);
      
    return $cantidad;
    }
    
   
     public function lineacolectivo(){

    return $colectivo->linea();
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
