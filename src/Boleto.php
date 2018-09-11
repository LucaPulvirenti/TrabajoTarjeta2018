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
   
    protected $lineacolectivo; 

    protected $totalabonado;
 
    public function __construct($valor, $colectivo, $tarjeta,$saldo,$id,$fecha,$tipotarjeta,$lineacolectivo,$totalabonado) {
        $this->valor = $valor;
        $this->colectivo = $colectivo;
        $this->tarjeta = $tarjeta;
        $this->saldo = $saldo;
        $this->id = $id;
        $this->plataplus= $plataplus;
        $this->fecha = $fecha;
        $this->tipotarjeta= $tipotarjeta;
        $this->lineacolectivo= $lineacolectivo; 
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

     public function fecha(){
     $tiempo= time(); 
     $fecha1= echo date("d/m/Y H:i:s",$tiempo) ."\n";
     return $fecha1;
    
    }

   public function tipotarjeta(){
     
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
