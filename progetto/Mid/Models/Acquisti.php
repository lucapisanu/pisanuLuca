<?php

/*altre classi da includere*/
include_once 'Auto.php';
include_once 'Commerciante.php';
include_once 'User.php';

/**
 * Rappresenta un acquisto di un auto, che viene effetuato da un Cliente.
 * @author Luca Pisanu
 */
class Acquisti{
    
    const numMax = 3;

    /* variabile contenente l'id del commerciante
     * @var int */
    private $id_commerciante;
    
    /* variabile contenente l'id del cliente
     * @var int */
    private $id_cliente;
    
    /* variabile contenente l'id dell'auto
     * @var int */
    private $id_auto;
    
    /* variabile contenente la data di quando viene messa in vendita l'auto
     * @var string */
    private $data;
    
     /* variabile contenente la data di quando viene messa in vendita l'auto
     * @var float */
    private $guadagno;

    public function __construct() {
        ;
    }

    /* metodo per il riempimento della variabile id_commerciante
     * @param int $id_commerciante - id del commerciante
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setIdCommerciante($id_commerciante){

        /*se il parametro passato non è vuoto*/
        if(!empty($id_commerciante)){ 
            
            $this->id_commerciante=$id_commerciante;
            return true;
        }
        else{
            return false;
        }    
    }
    
    /* metodo per il riempimento della variabile id_cliente
     * @param int $id_cliente - id del cliente
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setIdCliente($id_cliente){

        /*se il parametro passato non è vuoto*/
        if(!empty($id_cliente)){ 
            
            $this->id_cliente=$id_cliente;
            return true;
        }
        else{
            return false;
        }    
    }
    
     /* metodo per il riempimento della variabile id_auto
     * @param int $id_auto - id dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setIdAuto($id_auto){

        /*se il parametro passato non è vuoto*/
        if(!empty($id_auto)){ 
            
            $this->id_auto=$id_auto;
            return true;
        }
        else{
            return false;
        }
    }
        
    
     /* metodo per il riempimento della variabile data
     * @param int $data - data dell'acquisto */
    public function setData($data){
        
        $this->data=$data;
    }
    
     /* metodo per il riempimento della variabile guadagno
     * @param int $guadagno - gudagno della vendita */
    public function setGuadagno($guadagno){
        
        $this->guadagno=$guadagno;
        
    }
    
        
   
    /* metodo per verificare se l'oggetto dal quale si invoca è uguale 
     * a un altro di cui si passa il parametro id unico
     * @param int $id_auto - id dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function equal($id_auto){
        
        if ($this->id_auto == $id_auto){
            return true;
        }
        else return false;
    }
    
 
    /* metodo per la restituzione dell'id commerciante
     * @return id $id_commerciante - id del commerciante */
    public function getIdCommerciante(){
        
        return $this->id_commerciante;
        
    }
    
    /* metodo per la restituzione dell'id cliente
     * @return id $id_cliente - id del cliente */
    public function getIdCliente(){
        
        return $this->id_cliente;
        
    }
    
    /* metodo per la restituzione dell'id dell'auto
     * @return string $id_auto - id dell'auto */
    public function getIdAuto(){
        
        return $this->id_auto;
    }
    
    
    /* metodo per la restituzione della data
     * @return string $id_auto - id dell'auto */
    public function getData(){
        
        return $this->data;
    }
    
     /* metodo per la restituzione del guadagno 
     * @return float $guadagno - guadagno della vendita */
    public function getGuadagno(){
        
        return $this->guadagno;
    }

}



?>