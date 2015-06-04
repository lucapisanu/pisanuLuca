<?php

include_once 'User.php';
include_once 'Auto.php';

/* classe per l'entità commerciante, estensione dell'entità utente
 * 
 * @author Luca Pisanu
 */
class Commerciante extends User{
    
    /* costante contenente il numero di errori
    * @const int */
    const error = 1;
    
    /* costante contenente il numero massimo di auto in vendita
    * @var string */
    const numMax = 3;
    
    /* variabile contenente il nome dell'azienda 
     * @var string */
    private $nomeAzienza;
    
    /* variabile contenente la descrizione dell'azienda 
     * @var string */
    private $descrizioneAzienda;

    
    //costruttore utilizzato al momento della registrazione
    public function __construct(){
             ;
    }
  
    /**
     * Imposta il nome dell'azienda
     * @param string $nomeAzienda
     * @return boolean true se il nome e' stato impostato correttamente, 
     * false altrimenti 
     */
    public function setNomeAzienda($nomeAzienda){
        
        if (empty($nomeAzienda)){
            
            return false;
        }
        
        $this->nomeAzienza = $nomeAzienda;
        return true;
        
    }
   
    /**
     * Imposta la descrizione dell'azienda
     * @param string $descrizioneAzienda
     * @return boolean true se il nome e' stato impostato correttamente, 
     * false altrimenti 
     */
    public function setDescrizioneAzienda($descrizioneAzienda){
        
        if (empty($descrizioneAzienda)){
            
            return false;
        }
        $this->descrizioneAzienda = $descrizioneAzienda;
        return true;
        
    }

    /**
     * Restituisce il nome azienda
     * @return string
     */
    public function getNomeAzienda(){
        
        return $this->nomeAzienza;
    }
    
    /**
     * Restituisce la descrizione dell'azienda
     * @return string
     */
    public function getDescrizioneAzienda(){
        
        return $this->descrizioneAzienda;
    }
   

}
?>
