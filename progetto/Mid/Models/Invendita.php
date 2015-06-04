<?php

/**
 * Classe che rappresenta un'auto in vendita nel sistema
 * 
 * @author Luca Pisanu
 */
class Invendita{
    
    /* costante contenente il massimo numero di auto che può mettere in vendita un commerciante
     * @const int */
    const numMax = 3;

    /* variabile contenente l'id del commerciante
     * @var int */
    private $id_commerciante;
    
    /* variabile contenente l'id dell'auto
     * @var int */
    private $id_auto;
    
    /* variabile contenente la data di quando viene messa in vendita l'auto
     * @var array */
    private $data;

   
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
     * @param string $data - data della messa in vendita dell'auto */
    public function setData($data){
        
        $this->data=$data;
        
    }
    
        
    /* metodo per verificare se l'oggetto dal quale si invoca è uguale a un altro di cui si passa il parametro id unico
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
    
    /* metodo per la restituzione dell'id dell'auto
     * @return string $id_auto - id dell'auto */
    public function getIdAuto(){
        
        return $this->id_auto;
    }
    
    
    /* metodo per la restituzione della data
     * @return string $data - data della messa in vendita dell'auto */
    public function getData(){
        
        return $this->data;
    }

}



?>
