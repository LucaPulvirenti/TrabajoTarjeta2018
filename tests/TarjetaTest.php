<?php
namespace TrabajoTarjeta;
use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase { 

    /**
     * Comprueba que la tarjeta aumenta su saldo cuando se carga saldo válido.
     */ 
    
    public function testCargaSaldo() {
      $tiempo= new TiempoFalso(0); 
        $tarjeta = new Tarjeta($tiempo);

        $tarjeta->recargar(10);
        $this->assertEquals($tarjeta->obtenerSaldo(), 10);

        $tarjeta->recargar(20);
        $this->assertEquals($tarjeta->obtenerSaldo(), 30);
        
        $tarjeta->recargar(30); 
        $this->assertEquals($tarjeta->obtenerSaldo(), 60); 
        
        $tarjeta->recargar(50); 
        $this->assertEquals($tarjeta->obtenerSaldo(),110);

        $tarjeta->recargar(100); 
        $this->assertEquals($tarjeta->obtenerSaldo(),210);

        $tarjeta->recargar(510.15); 
        $this->assertEquals($tarjeta->obtenerSaldo(),802.08); 

        $tarjeta->recargar(962.59);  
        $this->assertEquals($tarjeta->obtenerSaldo(),1986.25);

    }

    /**
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     */
    public function testCargaSaldoInvalido() { 
      $tiempo1= new TiempoFalso(0); 
      $tarjeta = new Tarjeta($tiempo1);

      $tarjeta->recargar(15);
      $this->assertEquals($tarjeta->obtenerSaldo(), 0);
  }


  public function testFranquiciaCompleta(){  
    $tiempo2= new TiempoFalso(0); 
      $colectivo = new Colectivo("134","mixta",30);  
      $franquicia = new FranquiciaCompleta($tiempo2); 

      $this->assertEquals($franquicia->obtenerSaldo(),0.0);
      $boleto = $colectivo->pagarCon($franquicia);
      $this->assertEquals(get_class($boleto),"TrabajoTarjeta\Boleto");
//verificamos que al pagar nos devuelvan un boleto

  }

  public function testMedioBoleto(){  
    $tiempo3= new TiempoFalso(0); 
           $colectivo = new Colectivo("134","mixta",30);
           $medio = new MedioBoleto($tiempo3); 
           $medio->recargar(20); 
           $colectivo->pagarCon($medio);

              $this->assertEquals( $medio->obtenerSaldo() , 12.6 );


           
  }

  public function testViajePlus() {  
    $tiempo4= new TiempoFalso(0); 
    $colectivo = new Colectivo("134","mixta",30);
    $tarjeta = new Tarjeta($tiempo4); 
    $tarjeta->recargar(10);
    
   //como la tarjeta solo tiene $10 de carga, cada vez que se invoque a la funcion pagarCon se debe incrementar en 1 la cantidad de viajes plus
     $colectivo->pagarCon($tarjeta);
     $colectivo->pagarCon($tarjeta);


    $this->assertFalse($colectivo->pagarCon($tarjeta));

    //si los viajes plus funcionan correctamente, cuando querramos usar mas de 2 viajes plus la funcion pagarCon() debe retornar FALSE. En caso de que se retorne el FALSE, se verifica que solamente se pueden usar 2 viajes plus //
      
  } 

  public function testSaldoPlus(){
    $tiempo5= new TiempoFalso(0); 
    $colectivo = new Colectivo("134","mixta",30);
    $tarjeta = new Tarjeta($tiempo5); 
    $tarjeta->recargar(10);                               //creamos 2 tarjetas y le cargamos 10 pesos a cada una
    $tarjeta2 = new Tarjeta($tiempo5); 
    $tarjeta2->recargar(10);

   $this->assertEquals($tarjeta->obtenerSaldo(),10);
    $this->assertEquals($tarjeta2->obtenerSaldo(),10);//veficicamos que las tarjetas de recargen correctamente


    $colectivo->pagarCon($tarjeta);          // a tarjeta le gastamos 1 plus 

    $colectivo->pagarCon($tarjeta2);        
    $colectivo->pagarCon($tarjeta2);     //a tarjeta2 le gastamos 2 plus

    $this->assertEquals($tarjeta->CantidadPlus(),1);  //verificamos que se hayan sumado los plus correctamente
    $this->assertEquals($tarjeta2->CantidadPlus(),2);

    $tarjeta->recargar(100);      //recargamos 100 pesos a ambas tarjetas

    $tarjeta2->recargar(100);

    $this->assertEquals($tarjeta->obtenerSaldo(),110);
    $this->assertEquals($tarjeta2->obtenerSaldo(),110); //verificamos que el saldo de haya sumado correctamente 

    $this->assertTrue($tarjeta->pagar()); //pagamos un viaje nuevo, por lo que se nos debe restar el dinero de los viajes plus. primero nos fijamos que hayamos pagado correctamente.

    $this->assertEquals($tarjeta->CantidadPlus(),0); //verificamos que la variable que almacena la cantidad de viajes plus usados se haya reiniciado a 0
    $this->assertEquals($tarjeta->obtenerSaldo(),80.4); //verificamos que el saldo de haya descontado correctamente
  
   $this->assertTrue($tarjeta2->pagar()); 
   $this->assertEquals($tarjeta2->CantidadPlus(),0); 
   $this->assertEquals($tarjeta2->obtenerSaldo(),65.6); //realizamos el mismo proceso con la tarjeta 2

  }

  public function testUltimoPago(){ 

    $tiempo6= new TiempoFalso(0); 
    $colectivo = new Colectivo("134","mixta",30);
    $tarjeta = new Tarjeta($tiempo6); 
    $tarjeta->recargar(20);
    $this->assertTrue($tarjeta->pagar());//verificamos que el viaje se haya hecho correctamente 
    $this->assertEquals($tarjeta->devolverUltimoPago(),14.8); //verificamos que el ultimo pago se haya almacenado correctamente



  } 

  public function testMedioUniversitario(){
    $tiempo7 = new TiempoFalso(0); 
    $tarjeta = new MedioBoletoUniversitario($tiempo7); 
    $tarjeta->recargar(100);  


    $this->assertEquals($tarjeta->obtenerSaldo(),100); //creamos una tarjeta y le cargamos 200. Verificamos que el monto se haya añadido correctamente
    $this->assertTrue($tarjeta->PagoUniversitario()); //realizamos un pago 

    $this->assertEquals($tarjeta->tipotarjeta(),'medio universitario');
	
    $tiempo7->Avanzar(120); //avanzamos el tiempo 2 minutos
    $this->assertFalse($tarjeta->llega);
 
    $this->assertFalse($tarjeta->PagoUniversitario()); //intentamos pagar otro viaje. como pasaron menos de 5 minutos el resultado de pagar deberia ser false
    $this->assertTrue($tarjeta->llega);

   

  }

  

}
