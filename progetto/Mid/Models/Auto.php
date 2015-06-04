<?php

/*altre classi da includere*/
include_once 'Commerciante.php';
include_once 'User.php';

/**
 * Classe che rappresenta una generica auto del sistema
 * 
 * @author Luca Pisanu
 */
class Auto{
    
    const numMax = 3;

    /* variabile contenente il modello
     * @var string */
    private $modello;
    
    /* variabile contenente il produttore
     * @var string */
    private $produttore;
    
    /* variabile contenente gli accessori
     * @var string */
    private $accessori;
    
    /* variabile contenente i colori
     * @var string */
    private $colore;
    
    /* variabile contenente il tipo di alimentazione
     * @var string */
    private $alimentazione;
    
    /* variabile contenente il tipo di emissioni
     * @var string */
    private $emissioni;
    
    /* variabile contenente l'anno di produzione
     * @var int */
    private $anno;
    
    /* variabile contenente il prezzo del veicolo
     * @var float */
    private $prezzo;
    
    /* variabile contenente la descrizione del modello
     * @var string */
    private $descrizione;

    /* variabile contenente l'id
     * @var int */
    private $id;
    


    //costruttore utilizzato al momento della registrazione del prodotto
    public function __construct() {
        ;
    }

    /* metodo per il riempimento della variabile modello
     * @param string $modello - modello dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setModello($modello){

        /*se il parametro passato non è vuoto*/
        if(!empty($modello)){ 
            
            $this->modello=$modello;
            return true;

        }
        else{

            return false;
        }    
    }
    
    /* metodo per il riempimento della variabile produttore
     * @param string $produttore - produttore dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setProduttore($produttore) {
            
        /*se il parametro passato non è vuoto*/
        if(!empty($produttore)){
                
                $this->produttore=$produttore;
                return true;
                
            }
            else{
                
                return false;
            }
            
    }
    
    /* metodo per il riempimento della variabile accessori
     * @param string $accessori - accessori dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setAccessoriString($accessori) {
            
        /*se il parametro passato non è vuoto*/
        if(!empty($accessori)){  
                $this->accessori=$accessori;
                return true;   
            }
            else{
                return false;
            }
    }
    
    /* metodo per il riempimento della variabile accessori
     * @param array $accessori - accessori dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setAccessori($accessori) {
            
         /*se il parametro passato non è vuoto*/
        if(!empty($accessori)){
            foreach ($accessori as $accessorio)
                $this->accessori.=' '.$accessorio.';';
                return true; 
            }
            else{
                return false;
            }
    }
    
    /* metodo per il riempimento della variabile colore
     * @param string $colore - colore dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setColore($colore) {
        
        /*se il parametro passato non è vuoto*/
        if(!empty($colore)){  
                $this->colore=$colore;
                return true;   
            }
            else{
                return false;
            }
    }
    
    /* metodo per il riempimento della variabile alimentazione
     * @param string $alimentazione - tipo di alimentazione dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setAlimentazione($alimentazione) {
        
        /*se il parametro passato non è vuoto*/
        if(!empty($alimentazione)){
                
                $this->alimentazione=$alimentazione;
                return true;
                
            }
            else{
                
                return false;
            }
        
    }
      
    /* metodo per il riempimento della variabile emissioni
     * @param string $emissioni - tipo di emissioni dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setEmissioni($emissioni) {
            
        /*se il parametro passato non è vuoto*/
        if(!empty($emissioni)){
                
                $this->emissioni=$emissioni;
                return true;
                
            }
            else{
                
                return false;
            }
        
    }
    
    /* metodo per il riempimento della variabile anno
     * @param int $anno - anno di produzione dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti*/
    public function setAnno($anno) {
        
        //imposta una variabile con il valore intero del parametro
        $intVal = filter_var($anno, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        
        /*se il parametro passato non è vuoto e intval esiste*/
        if (!isset($intVal) || empty($anno)) {
            return false;
        }
        else{
            $this->anno=$intVal;
            return true;
        }    
        
    }
    
    /* metodo per il riempimento della variabile prezzo
     * @param float $prezzo - prezzo dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti */
    public function setPrezzo($prezzo) {
         if(!empty($prezzo)){
           $this->prezzo=$prezzo;
           return true;
        }else{ 
           return false;
        }
       
    }
    
    
    /* metodo per il riempimento della variabile descrizione
     * @param string $descrizione - descrizione dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti */
    public function setDescrizione($descrizione) {
        
        /*se il parametro passato non è vuoto*/
        if(!empty($descrizione)){
                
            $this->descrizione=$descrizione;
            return true;
                
        }
        else{
            
            return false;
        }
    }
    
          
    /* metodo per verificare se l'oggetto dal quale si invoca è uguale 
    *  a un altro di cui si passa il parametro id unicometodo per il riempimento della variabile descrizione
    * @param int &id - id dell'auto
    * @return boolean - true se imposta la variabile, false altrimenti */ 
    public function equal($id){
        
        if ($this->id == $id){
            
            return true;
        }
        else return false;
    }
    
    
    /* metodo per la restituzione del modello
     * @return string $modello - modello dell'auto */
    public function getModello(){
        
        return $this->modello;
        
    }
    
    /* metodo per la restituzione del produttore
     * @return string $produttore - produttore dell'auto */
    public function getProduttore(){
        
        return $this->produttore;
    }
    
    /* metodo per la restituzione degli accessori
     * @return string $accessori - accessori dell'auto */
    public function getAccessori(){
        
        return $this->accessori;
    }
    
    /* metodo per la restituzione dei colori e del tipo di vernice
     * @return string $colore - colore dell'auto */
    public function getColore(){
        
        return $this->colore;
    }
    
    /* metodo per la restituzione dell'alimentazione
     * @return string $alimentazione - tipo di alimentazione dell'auto */
    public function getAlimentazione(){
        
        return $this->alimentazione;
    }
    
    /* metodo per la restituzione delle emissioni
     * @return string $emissioni - tipo di emissioni dell'auto */
    public function getEmissioni(){
       
        return $this->emissioni;
    }
    
    /* metodo per la restituzione dell'anno
     * @return int $anno - anno di produzione dell'auto */
    public function getAnno(){
        
        return $this->anno;
    }
    
    /* metodo per la restituzione del prezzo
     * @return float $prezzo - prezzo dell'auto */
    public function getPrezzo(){
        
        return $this->prezzo;
    }
    
    /* metodo per la restituzione della descrizione
     * @return string $descrizione - descrizione dell'auto */
    public function getDescrizione(){
        
        return $this->descrizione;
    }
 

    /* metodo per assegnare un id unico alle vetture
     * @param Auto $id - id dell'auto che si sya registrando 
     * @return string $id - id unico della vettura*/
    public function setId($id){
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($intVal)){
            return false;
        }
        $this->id = $intVal;
    }
    
    
    /* metodo per la restituzione dell'id dell'auto
     * @param int $id - id unico della vettura */
    public function getId(){
        return $this->id;
    }
    
}



?>
