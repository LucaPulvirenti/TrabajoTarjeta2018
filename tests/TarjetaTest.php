<?php
namespace TrabajoTarjeta;
use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase
{
    
    /**
     * Comprueba que la tarjeta aumenta su saldo cuando se carga saldo válido.
     */
    
    public function testCargaSaldo()
    {
        $tiempo  = new TiempoFalso(0);
        $tarjeta = new Tarjeta($tiempo);
        
        $tarjeta->recargar(10);
        $this->assertEquals($tarjeta->obtenerSaldo(), 10);
        
        $tarjeta->recargar(20);
        $this->assertEquals($tarjeta->obtenerSaldo(), 30);
        
        $tarjeta->recargar(30);
        $this->assertEquals($tarjeta->obtenerSaldo(), 60);
        
        $tarjeta->recargar(50);
        $this->assertEquals($tarjeta->obtenerSaldo(), 110);
        
        $tarjeta->recargar(100);
        $this->assertEquals($tarjeta->obtenerSaldo(), 210);
        
        $tarjeta->recargar(510.15);
        $this->assertEquals($tarjeta->obtenerSaldo(), 802.08);
        
        $tarjeta->recargar(962.59);
        $this->assertEquals($tarjeta->obtenerSaldo(), 1986.25);
        
    }
    
    /**
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     */
    
    public function testTransbordoTarjetaNormal()
    {
        
        $tiempo  = new TiempoFalso(10);
        $tarjeta = new Tarjeta($tiempo);
        
        $tarjeta->recargar(100);
        $this->assertTrue($tarjeta->pagar()); //pagamos un viaje
        
        $tiempo->Avanzar(60 * 59); //avanzamos el tiempo 59 minutos por lo que debemos poder pagar transbordo

        $this->assertEquals($tarjeta->tiempoTransbordo(), 60);  //por defecto nos encontramos en un dia de semana, por lo que debemos tener solo 60 minutos para el transbordo
        $this->assertTrue($tarjeta->esTransbordo());

        $this->assertTrue($tarjeta->pagar()); //volvemos a pagar un viaje, que es un transbordo
        
        $this->assertTrue($tarjeta->devolverUltimoTransbordo());
        $this->assertEquals($tarjeta->obtenerSaldo(), 80.316); //verificamos que el saldo se haya restado correctamente
        
        
        $tarjeta2 = new Tarjeta($tiempo);
        $this->assertTrue($tarjeta2->pagar()); //pagamos un plus
        $tiempo->Avanzar(60 * 30); //avanzamos el tiempo media hora
        $tarjeta->recargar(100);
        
        $this->assertTrue($tarjeta2->pagar()); //como nuestro ultimo viaje fue plus, no debemos poder pagar transbordo
        
        $this->assertFalse($tarjeta2->devolverUltimoTransbordo()); //verificamos que el viaje no haya sido transbordo
        $this->assertEquals($tarjeta2->obtenerSaldo(), 70.4);
        
        
        
    }
    //testeamos transbordos para tarjetas de tipo franquicia normal
    
    public function testUltimoPago()
    {
        
        $tiempo1 = new TiempoFalso(10);
        $tarjeta = new Tarjeta($tiempo1);
        $tarjeta->recargar(100);
        $this->assertTrue($tarjeta->pagar());
        $this->assertEquals($tarjeta->devolverUltimoPago(), 14.8);
        //creamos una tarjeta y pagamos un viaje normal; verificamos que el ultimo pago sea 14.8(viaje normal)
        
        $tarjetaPlus = new Tarjeta($tiempo1);
        $tarjetaPlus->recargar(10);
        $this->assertTrue($tarjetaPlus->pagar());
        $this->assertTrue($tarjetaPlus->usoplus());
        //creamos una nueva tarjeta y le usamos un viaje plus.
        
        $tarjetaPlus->recargar(100);
        $this->assertTrue($tarjetaPlus->pagar());
        $this->assertEquals($tarjetaPlus->devolverUltimoPago(), 14.8 * 2);
        //cargamos mas saldo y volvemos a pagar. Como usamos un viaje plus, el pasaje debería salir el doble, dado que adeudamos un plus
        $this->assertEquals($tarjetaPlus->CantidadPlus(), 0);
        //verificamos que ahora no adeudemos ningun plus
        
    }
    
    public function testCargaSaldoInvalido()
    {
        $tiempo1 = new TiempoFalso(0);
        $tarjeta = new Tarjeta($tiempo1);
        
        $this->assertFalse($tarjeta->recargar(15));
        $this->assertEquals($tarjeta->obtenerSaldo(), 0);
        
    }
    
    
    public function testFranquiciaCompleta()
    {
        $tiempo2    = new TiempoFalso(0);
        $colectivo  = new Colectivo("134", "mixta", 30);
        $franquicia = new FranquiciaCompleta($tiempo2);
        
        $this->assertEquals($franquicia->obtenerSaldo(), 0.0);
        $boleto = $colectivo->pagarCon($franquicia);
        $this->assertEquals(get_class($boleto), "TrabajoTarjeta\Boleto");
        //verificamos que al pagar nos devuelvan un boleto
        
    }
    
    public function testMedioBoleto()
    {
        $tiempo3   = new TiempoFalso(0);
        $colectivo = new Colectivo("134", "mixta", 30);
        $medio     = new MedioBoleto($tiempo3);
        $medio->recargar(20);
        $colectivo->pagarCon($medio);
        
        $this->assertEquals($medio->obtenerSaldo(), 12.6);
        
        
        
    }
    
    public function testViajePlus()
    {
        $tiempo4   = new TiempoFalso(0);
        $colectivo = new Colectivo("134", "mixta", 30);
        $tarjeta   = new Tarjeta($tiempo4);
        $tarjeta->recargar(10);
        
        //como la tarjeta solo tiene $10 de carga, cada vez que se invoque a la funcion pagarCon se debe incrementar en 1 la cantidad de viajes plus
        $colectivo->pagarCon($tarjeta);
        $colectivo->pagarCon($tarjeta);
        
        
        $this->assertFalse($colectivo->pagarCon($tarjeta));
        
        //si los viajes plus funcionan correctamente, cuando querramos usar mas de 2 viajes plus la funcion pagarCon() debe retornar FALSE. En caso de que se retorne el FALSE, se verifica que solamente se pueden usar 2 viajes plus //
        
    }
    
    public function testSaldoPlus()
    {
        $tiempo5   = new TiempoFalso(0);
        $colectivo = new Colectivo("134", "mixta", 30);
        $tarjeta   = new Tarjeta($tiempo5);
        $tarjeta->recargar(10); //creamos 2 tarjetas y le cargamos 10 pesos a cada una
        $tarjeta2 = new Tarjeta($tiempo5);
        $tarjeta2->recargar(10);
        
        $this->assertEquals($tarjeta->obtenerSaldo(), 10);
        $this->assertEquals($tarjeta2->obtenerSaldo(), 10); //veficicamos que las tarjetas de recargen correctamente
        
        
        $colectivo->pagarCon($tarjeta); // a tarjeta le gastamos 1 plus 
        
        $colectivo->pagarCon($tarjeta2);
        $colectivo->pagarCon($tarjeta2); //a tarjeta2 le gastamos 2 plus
        
        $this->assertEquals($tarjeta->CantidadPlus(), 1); //verificamos que se hayan sumado los plus correctamente
        $this->assertEquals($tarjeta2->CantidadPlus(), 2);
        
        $tarjeta->recargar(100); //recargamos 100 pesos a ambas tarjetas
        
        $tarjeta2->recargar(100);
        
        $this->assertEquals($tarjeta->obtenerSaldo(), 110);
        $this->assertEquals($tarjeta2->obtenerSaldo(), 110); //verificamos que el saldo de haya sumado correctamente 
        
        $this->assertTrue($tarjeta->usoplus()); 
        
        
        
        $this->assertTrue($tarjeta2->pagar());
        $this->assertEquals($tarjeta2->CantidadPlus(), 0);
        $this->assertEquals($tarjeta2->obtenerSaldo(), 65.6); //realizamos el mismo proceso con la tarjeta 2


        $this->assertTrue($tarjeta->pagar()); //pagamos un viaje nuevo, por lo que se nos debe restar el dinero de los viajes plus. primero nos fijamos que hayamos pagado correctamente.
        
        $this->assertFalse($tarjeta->devolverUltimoTransbordo());
        $this->assertEquals($tarjeta->CantidadPlus(), 0); //verificamos que la variable que almacena la cantidad de viajes plus usados se haya reiniciado a 0
        $this->assertEquals($tarjeta->obtenerSaldo(), 80.4); //verificamos que el saldo de haya descontado correctamente
        
    }
    
    public function testMedioUniversitario()
    {
        $tiempo7 = new TiempoFalso(100);
        $tarjeta = new MedioBoletoUniversitario($tiempo7);
        $tarjeta->recargar(100); //creamos una tarjeta y le cargamos 100 pesos
        
        
        $this->assertEquals($tarjeta->obtenerSaldo(), 100); //creamos una tarjeta y le cargamos 100. Verificamos que el monto se haya añadido correctamente
        
        $this->assertEquals($tarjeta->CambioMonto(), 7.4);
        
        $this->assertTrue($tarjeta->pagoMedioBoleto()); //realizamos un pago 
        
        $this->assertEquals($tarjeta->obtenerSaldo(), 92.6); //verificamos que el saldo de haya restado correctamente;
        
        $tiempo7->Avanzar(120); //avanzamos el tiempo 2 minutos
        
        $this->assertEquals($tiempo7->reciente(), 220);
        
        $this->assertEquals($tarjeta->getTiempo(), 220); //el tiempo se avanzo correctamente
        
        
        $this->assertNotEquals($tarjeta->DevolverUltimoTiempo(), NULL);
        
        $this->assertFalse($tarjeta->pagoMedioBoleto()); //intentamos pagar otro viaje. como pasaron menos de 5 minutos el resultado de pagar deberia ser false
        
        
        $tiempo7->Avanzar(300); //avanzamos el tiempo 5 minutos
        
        $this->assertTrue($tarjeta->pagoMedioBoleto()); // verificamos que se haya podido realizar el pago
        
        $this->assertEquals($tarjeta->obtenerSaldo(), 85.2); //verificamos que se haya restado correctamente el saldo
        
        $tiempo7->Avanzar(360); //avanzamos el tiempo 6 minutos para poder realizar otro viaje
        
        $this->assertTrue($tarjeta->pagoMedioBoleto()); //pagamos
        
        $this->assertEquals($tarjeta->obtenerSaldo(), 70.4); //como este es el 3er viaje que usamos en el dia, se deben restar 14.8 en vez de 7.4. verificamos que esto sea asi.
        
        $tiempo7->Avanzar(60 * 60 * 25); //avanzamos el tiempo mas de un dia por lo que ahora por lo que ahora los pasajes deben volver a valer 7.4
        
        $this->assertFalse($tarjeta->Horas());
        
        $this->assertEquals($tarjeta->DevolverCantidadBoletos(), 0);
        
        $this->assertEquals($tarjeta->CambioMonto(), 7.4); //verificamos que el pasaje ahora cueste 7.4
        
        $this->assertTrue($tarjeta->pagoMedioBoleto()); //pagamos un pasaje
        
        $this->assertEquals($tarjeta->obtenerSaldo(), 63); //verificamos que se resten correctamente lso $7.4 del pasaje
        
        $nuevoTF      = new TiempoFalso(10);
        $tarjetaNueva = new MedioBoletoUniversitario($nuevoTF);
        
        $tarjetaNueva->recargar(10);
        
        $this->assertTrue($tarjetaNueva->pagoMedioBoleto()); //pagamos un viaje
        
        $nuevoTF->Avanzar(360); //avanzamos el tiempo 6 minutos para poder apgar
        
        $this->assertTrue($tarjetaNueva->pagoMedioBoleto()); //pagamos el 1er viaje plus
        
        $this->assertTrue($tarjetaNueva->usoplus());
        
        $this->assertEquals($tarjetaNueva->CantidadPlus(), 1); //verificamos que efectivamente adeudemos 1 plus
        
        $tarjetaNueva->recargar(100);
        
        $nuevoTF->Avanzar(60 * 60 * 25); //avanzamos el tiempo mas de un dia
        
        $this->assertTrue($tarjetaNueva->pagoMedioBoleto()); //pagamos un viaje nuevo
        
        $this->assertEquals($tarjetaNueva->DevolverUltimoPago(), 14.8 + 7.4); //verificamos que el ultimo pago haya sido equivalente al medio boleto + el plus adeudado
        
        $this->assertEquals($tarjetaNueva->obtenerSaldo(), (110 - 29.6)); //verificamos que se nos haya descontado el viaje plus que adeudabamos
        
        
    }
    
    public function pagoNoValido() //esta funcion se encarga de verificar que no padamos pagar un pasaje cuando adeudemos 2 plus
    {
        $tiempo  = new TiempoFalso(10);
        $tarjeta = new MedioBoletoUniversitario($tiempo);
        $this->assertEquals($tarjeta->tipotarjeta(), 'medio universitario'); //verificamos que la tarjeta sea del tipo correcto
        
        $this->assertTrue($tarjeta->pagoMedioBoleto());
        $tiempo->Avanzar(360); //avanzamos el tiempo 6 minutos para poder pagar
        $this->assertTrue($tarjeta->pagoMedioBoleto()); //pagamos 2 viajes plus 
        $tiempo->Avanzar(60 * 60 * 26); //avanzamos mas de un dia 
        $this->assertTrue($tarjeta->Horas());
        $this->assertFalse($tarjeta->pagoMedioBoleto()); //como adeudamos 2 plus no debemos poder pagar
        
    }
    
    
}