<?php


/**
 * Classe che rappresenta un il carrello di un utente
 * 
 * @author Luca Pisanu
 */
class Carrello{
    
    const numMax = 3;

    /* variabile contenente l'id del cliente
     * @var int */
    private $id_cliente;
    
    /* variabile contenente l'id dell'auto
     * @var int */
    private $id_auto;
    
    /* variabile contenente la data di quando viene messa nel carrello l'auto
     * @var string */
    private $data;

    //costruttore utilizzato al momento della registrazione del prodotto
    public function __construct() {
        ;
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
    * @param string $data - data dell'aggiunta al carrello
    * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setData($data){
        
        $this->data=$data;
        
    }
    
        
    /* metodo per verificare se l'oggetto dal quale si invoca è uguale a un altro 
     * di cui si passa il parametro id unico
     * @param int $id_auto - id dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function equal($id_auto){
        
        if ($this->id_auto == $id_auto){
            return true;
        }
        else return false;
    }
    
 
    /* metodo per la restituzione dell'id_cliente
     * @return int $id_cliente - id del cliente */
    public function getIdClinete(){
        
        return $this->id_cliente;
        
    }
    
    /* metodo per la restituzione dell'id dell'auto
     * @return string $id_auto - id dell'auto */
    public function getIdAuto(){
        
        return $this->id_auto;
    }
    
    
    /* metodo per la restituzione della data
     * @return string data
     */
    public function getData(){
        
        return $this->data;
    }

}



?>
