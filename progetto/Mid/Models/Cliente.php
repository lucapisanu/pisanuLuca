<?php

/*altre classi da includere*/
include_once 'User.php';
include_once 'Auto.php';

//classe per l'entità cliente, estensione dell'entità utente
class Cliente extends User{

    /* variabile contenente l'indirizzo dell'utente
     * @var string */
    private $indirizzoCliente;
    
    /* variabile contenente la lista delle auto comprate
     * @var array */
    private $listaAuto=array();
    
    /* variabile contenente la lista delle auto nel carrello
     * @var array */
    private $carrello=array();
  
    
    //costruttore utilizzato al momento della registrazione
    public function __construct(){
        ;
    }
    
    /* metodo per la restituzione delle auto 
     * @return array $listaAuto - lista auto comprate dal cliente */
    public function getLista(){
        
        return $this->listaAuto;
    }
    
    /* metodo per la restituzione del carrello
     * @return array $carrello - carrello del cliente */
    public function getCarrello(){
        
        return $this->carrello;
    }
    
    
    /* metodo per l'aggiunta di una vettura al carrello del cliente
     * @param Automobile $automobile - automobile da aggiungere
     * @return boolean - true se riesce ad aggiungerla, false altrimenti */
    public function aggiungiCarrello(Automobile $automobile){
        
        //controlla che l'auto in questione non sia già presente nel carrello 
        foreach ($this->getCarrello() as $carrello){
            
            if($carrello->getID() == $automobile->getID()){
                
                return false;
            }
        }
        $this->carrello[]=$automobile;
        return true;
        
        
    }
    
    /* metodo per la rimozione di una vettura al carrello del cliente
     * @param string $id - id della vettura da eliminare
     * @return boolean - true se riesce a rimuoverla, false altrimenti */
    public function rimuoviCarrello($id){
        
        $i=0;
        //scorre tutta la lista delle auto in vendita
        foreach ($this->carrello as $veicolo){
            
             
            //fino a quando non trova l'id della macchina nel carrello uguale
            if($id == $veicolo->getID()){
                
                break;
                              //incrementa il contatore della posizione nello scorrimento dell'array
            }
            /* altrimenti vuol dire che ha trovato l'auto in questione,
             * dunque incrementa i per puntare al veicolo e interrompe il loop*/
            else{
                
                $i++;
                        
            }
            
            
        }
        unset($this->carrello[$i]);//cancella l'auto in questione dall'array
            
            return true;
    }
    
    /* metodo per la rimozione di una vettura al carrello del cliente
     * @param Automobile $automobile - vettura da comprare */
    public function compraAuto(Automobile $automobile){
        
               
        //scorre tutta la lista delle auto in vendita
        foreach ($this->carrello as $veicolo){
            
            //fino a quando non trova l'id della macchina acquistata uguale
            if($automobile->getID()!=$veicolo->getID()){
                
                $i++;//incrementa il contatore della posizione nello scorrimento dell'array
            }
            /* altrimenti vuol dire che ha trovato l'auto in questione,
             * dunque incrementa i per puntare al veicolo e interrompe il loop*/
            else{
                
                $i++;
                break;         
            }
        }  
        
       
        $this->listaAuto[]=$automobile;
      
        
    }
    
    /* metodo per la restituzione delle macchine già acquistate
     * @return array $listaAuto - auto già vendute */
    public function getCronologia(){
        
        return $this->listaAuto;
        
    }
}
?>
