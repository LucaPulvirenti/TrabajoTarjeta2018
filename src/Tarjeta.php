<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface
{
    
    protected $saldo = 0;
    public $monto = 14.8;
    protected $viajeplus = 0;
    protected $ID;
    protected $ultboleto = NULL;
    protected $tipo = 'franquicia normal';
    protected $tiempo;
    protected $ultimoplus = FALSE;
    protected $fechault;
    protected $horault;
    protected $pago = 0;
    protected $plusdevuelto = 0;
    public $universitario = FALSE;
    protected $ultimoTiempo = NULL;
    protected $montoTransbordo;
    public $Feriado;
    protected $tiempoTr;
    protected $ultimoTransbordo = FALSE;
    
    
    public function __construct(TiempoInterface $tiempo)
    {
        $this->saldo     = 0.0;
        $this->viajeplus = 0;
        $this->ID        = rand(0, 100);
        $this->ultboleto = NULL;
        $this->tiempo    = $tiempo;
    }
    public function setTrue($valorASetear)
    {
        $this->valorASetear = TRUE;
        require $this->valorASetear;
    }
    
    
    public function getTiempo()
    {
        return $this->tiempo->reciente();
    }
    
    public function MostrarPlusDevueltos()
    {
        
        return $this->plusdevuelto; //esta funcion sirve para mostrar la cantidad de plus que pago el usuario en su ultimo viaje
    }
    
    public function DevolverUltimoTiempo()
    {
        
        return $this->ultimoTiempo;
    }
    
    public function reiniciarPlusDevueltos()
    {
        
        $this->plusdevuelto = 0;
    }
    
    public function usoplus()
    {
        
        return $this->ultimoplus; //ultimo plus es TRUE si el ultimo viaje realizado fue un viaje plus
    }
    
    public function ultimopago()  //esta funcion se tiene que modificar
    {
        
        $this->pago = $this->monto + ($this->CantidadPlus() * 14.8);
        
    }
    
    public function devolverUltimoPago()
    {
        
        return $this->pago;
    } //retorna la cantidad de dinero gastado en el ultimo viaje
    
    public function tipotarjeta() //indica si la tarjeta es una franquicia normal, media o completa
    {
        
        if ($this->monto == 14.8) {
            return $this->tipo;
        } else {
            if ($this->monto == 7.4) {
                
                if ($this->universitario == TRUE) {
                    $this->tipo = 'medio universitario';
                    return $this->tipo;
                }
                $this->tipo = 'media franquicia estudiantil';
                return $this->tipo;
            }
            $this->tipo = 'franquicia completa';
            return $this->tipo;
        }
        
    }
    
    public function CantidadPlus()
    {
        return $this->viajeplus; //devuelve la cantidad de viajes plus que adeudamos
        
    }
    
    
    public function IncrementoPlus()
    {
        
        $this->viajeplus += 1;
    }
    
    public function RestarPlus()
    {
        
        $this->viajeplus = 0;
    }
    
    
    public function saldoSuficiente()
    {
        if ($this->obtenerSaldo() >= ($this->monto + $this->CantidadPlus() * 14.8)) {
            return TRUE;
        } 
            return FALSE;
        
    } //indica si tenemos saldo suficiente para pagar un viaje
    
    public function obtenerSaldo()
    {
        return $this->saldo;
    }
    
    public function devolverUltimoTransbordo()
    {
        
        return $this->ultimoTransbordo;
    }

    public function tiempoTransbordo()
    {
        if($this->tiempo->esDiaSemana() && $this->tiempo->esFeriado()==FALSE){
            $tiempoTr= 60;
            return $tiempoTr;
        }

        $tiempoTr=90;
        return $tiempoTr;
    }

    public function esTransbordo()
    {    
        
        if ($this->usoplus() == FALSE) {
                
                if ($this->tiempo->reciente() - $this->DevolverUltimoTiempo() < $this->tiempoTransbordo()) {
                   
                    return TRUE;
                }
            }

            return FALSE;   
    } // devuelve TRUE si el viaje es un transbordo
    
    public function restarSaldo()
    {
        
        
        if ($this->DevolverUltimoTiempo() == NULL) {
            
            $this->saldo -= $this->monto;
            $this->viajeplus  = 0;
            $ultimoTransbordo = FALSE;
        } else {
            
            if($this->esTransbordo()){

                $montoTransbordo = ($this->monto*0.33); 
                $this->saldo -= $this->montoTransbordo;
                $this->ultimoTransbordo=TRUE;
            } 

            $this->saldo -= ($this->monto + $this->CantidadPlus() * 14.8);
            $this->viajeplus  = 0;
            $ultimoTransbordo = FALSE;

        }
        
    }
    
    public function obtenerID()
    {
        return $this->ID;
    }
    
    public function guardarUltimoBoleto($boleto)
    {
        $this->ultboleto = $boleto;
    }
    
    
    public function pagar()
    {
        
        if ($this->saldoSuficiente()) {
            
            if ($this->CantidadPlus() == 0) {
                $this->ultimopago();//hay que modificar ultimopago
                $this->restarSaldo();
                $this->plusdevuelto = 0;
                $this->ultimoplus   = FALSE;
                $this->ultimoTiempo = $this->tiempo->reciente();
            }
            
            else {
                $this->plusdevuelto = $this->CantidadPlus();
                $this->ultimopago();
                $this->restarSaldo();
                $this->RestarPlus();
                $this->ultimoplus   = FALSE;
                $this->ultimoTiempo = $this->tiempo->reciente();
            }
            
            return TRUE;
            
        }
        
        else {
            
            if ($this->CantidadPlus() < 2) {
                $this->plusdevuelto = 0;
                $this->ultimoplus   = TRUE;
                $this->IncrementoPlus();
                $this->ultimoTiempo = $this->tiempo->reciente();
                return TRUE;
            } 
                return FALSE;
            
        }
        
    }
    
    public function recargar($monto)
    {
        
        if ($monto == 10 || $monto == 20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
            if ($monto == 962.59) {
                $this->saldo += ($monto + 221.58);
                return true;
            } else {
                if ($monto == 510.15) {
                    $this->saldo += ($monto + 81.93);
                    return true;
                } else {
                    $this->saldo += $monto;
                    return true;
                }
            }
            
        }
        
        else {
            return false;
            
        }
        
    }
    
    
    
}