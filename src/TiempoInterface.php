<?php 

namespace TrabajoTarjeta;

interface TiempoInterface {

    /**
     * Devuelve el tiempo actual en segundos sin formateo de fecha.
     * 
     * @return int
     *  el tiempo actual en segundos
     */
	public function reciente(); 

    /**
     * Devuelve TRUE en caso de que sea feriado. FALSE en caso contrario
     * 
     * @return bool 
     *              
     */
	public function esFeriado();

    /**
     * Devuelve TRUE en caso de que sea de noche. FALSE en caso contrario
     * @return bool
     */
    public function esDeNoche();
    
    /**
     * Devuelve TRUE en caso de que sea fin de semana. FALSE en caso contrario
     * @return bool
     */
    public function esFinDeSemana();
    
    /**
     * Devuelve TRUE en caso de que sea dia de semana. FALSE en caso contrario
     * @return bool
     */
    public function esDiaSemana();
    

}


