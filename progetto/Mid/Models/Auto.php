<?php

/*altre classi da includere*/
include_once 'Commerciante.php';
include_once 'User.php';

//classe per l'entità automobile
class Automobile{
    
    const numMax = 3;

    /* variabile contenente il modello
     * @var string */
    protected $modello;
    
    /* variabile contenente il produttore
     * @var string */
    protected $produttore;
    
    /* variabile contenente gli accessori
     * @var array */
    protected $accessori;//più accessori possibili per singolo oggetto
    
    /* variabile contenente i colori
     * @var array */
    protected $colore;//più colori per singolo oggetto e scelta tra opaco e metallizato
    
    /* variabile contenente il tipo di alimentazione
     * @var string */
    protected $alimentazione;
    
    /* variabile contenente il tipo di emissioni
     * @var string */
    protected $emissioni;
    
    /* variabile contenente l'anno di produzione
     * @var int */
    protected $anno;
    
    /* variabile contenente il prezzo del veicolo
     * @var int */
    protected $prezzo;
    
    /* variabile contenente la descrizione del modello
     * @var string */
    protected $descrizione;

    /* variabile contenente l'id
     * @var string */
    protected $id;//id unico del prodotto
    
    /* variabile contenente il numero di copie del prodotto
     * @var int */
    protected $numeroCopie;
    
    /* variabile contenente il guadagno che spetta al gestore
     * @var int */
    protected $guadagnoGestore;
    
    /* variabile contenente la data di pubblicazione o di acquisto
     * @var DataTime */
    protected $data;
    
    /* variabile contatore per il numero di auto già in vendita
     * @var int */
    private $cont=0; 


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
    public function setAccessori($accessori) {
            
         /*se il parametro passato non è vuoto*/
        if(!empty($accessori)){
                $this->accessori=$accessori;
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
     * @param string $anno - anno di produzione dell'auto
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
     * @param string $prezzo - prezzo dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti */
    public function setPrezzo($prezzo) {
        
        //imposta una variabile con il valore intero del parametro
        $intVal = filter_var($prezzo, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        
        /*se il parametro passato non è vuoto e intval esiste*/
        if (!isset($intVal) || empty($prezzo)) {
            return false;
        }
        else{
            $this->prezzo=$intVal;
            return true;
        }
    }
    
    /* metodo per il calcolo e il riempimento del guadagno del gestore
     * @param string $guadagno - guadagno del gestore dalla vendita dell'auto */
    public function setGuadagno() {
        
        //calcola il guadagno del gestore ( 10% ) in base al prezzo fissato dal commerciante
        $this->guadagnoGestore=$this->prezzo/10;
        
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
    
    /* metodo per il riempimento della variabile copie
     * @param string $copie - copie dell'auto
     * @return boolean - true se imposta la variabile, false altrimenti */
    public function setCopie($copie) {
        
        //imposta una variabile con il valore intero del parametro
        $intVal = filter_var($copie, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        
        /*se il parametro passato non è vuoto e intval esiste*/
        if (!isset($intVal) || empty($copie)) {
            return false;
        }
        else{
            $this->numeroCopie=$intVal;
            return true;
        }
        
    }
    
    //metodo per impostare la data di registrazione dell'auto (nel caso di auto in vendita) 
    //o della data di vendita (nel caso della cronologia)
    public function setData($data){
        
        $this->data=$data;
        
    }
    
        
    //metodo per verificare se l'oggetto dal quale si invoca è uguale a un altro di cui si passa il parametro id unico
    public function equal($id){
        
        if ($this->id == $id){
            
            return true;
        }
        else return false;
    }
    
    /* metodo per l'incremento di copie un dato prodotto
     * (i parametri sono il numero di copie da incrementare e l'utente che vuole compiere l'azione)*/
    public function incrementa(integer $numCopie, Commerciante $venditore){
        
        /*controlla che il numero di articoli venduti per questo commerciante non superi
         *3 con l'aumento delle copie del prodotto*/
        
        //per ogni vettura già registrata dal gestore conta il totale degli esemplari e li regista nella variabile contatore
        foreach ($venditore->getLista() as $vettura){
            
            $this->cont += $vettura->getCopie; 
        }
        if (($this->cont+$numCopie) > self::numMax){
            
            return false;// restituisce 1, identificativo di troppi veicoli in vendita
            
        }
        //se è tutto ok procede con la registrazione nell'array
        else{
            
            $this->numeroCopie += $numCopie;
        }       
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
     * @return array $accessori - accessori dell'auto */
    public function getAccessori(){
        
        return $this->accessori;
    }
    
    /* metodo per la restituzione dei colori e del tipo di vernice
     * @return array $colore - colore dell'auto */
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
     * @return int $prezzo - prezzo dell'auto */
    public function getPrezzo(){
        
        return ($this->prezzo+$this->guadagnoGestore);
    }
    
    /* metodo per la restituzione della descrizione
     * @return string $descrizione - descrizione dell'auto */
    public function getDescrizione(){
        
        return $this->descrizione;
    }
    
    /* metodo per la restituzione delle copie
     * @return int $copie - numero di copie dell'auto */
    public function getCopie(){
        
        return $this->numeroCopie;
        
    }
    
    /* metodo per la restituzione del prezzo
     * @return int $prezzo - prezzo effettivo dell'auto */
    public function getValore(){
        
        return $this->prezzo;
    }
    
    /* metodo per la restituzione del guadagno
     * @return int $guadagno - guadagno del gestore sul prezzo */
    public function getGuadagno(){
        
        return $this->guadagnoGestore;
    }
    
    /* metodo per la restituzione della data*/
    public function getData(){
        
        return date("d-m-y", $this->data);
    }

    /* metodo per assegnare un id unico alle vetture
     * @param Utente $user - utente che stà registrando l'auto
     * @return string $id - id unico della vettura*/
    public function setId($id){
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($intVal)){
            return false;
        }
        $this->id = $intVal;
    }
    
    
    /* metodo per la restituzione dell'id dell'auto
     * @param string $id - id unico della vettura */
    public function getId(){
        
        return $this->id;
    }
    
}



?>
