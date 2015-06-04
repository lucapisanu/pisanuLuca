<?php

include_once 'User.php';
include_once 'Auto.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




//classe per l'entità commerciante, estensione dell'entità utente
class Commerciante extends User{
    
    const error = 1;//valore standard per errore di eccedenza prodotti in vendita
    const numMax = 3;//numero massimo prodotti vendibili
    
    private $nomeAzienza;
    private $descrizioneAzienda;
    private $listaAuto=array();//lista auto in vendita
    private $cronologia=array();//lista auto vendute
    
    private $cont;//contatore per il numero di auto già in vendita
    private $i=0;//contatore per i loop
    
    //costruttore utilizzato al momento della registrazione
    public function __construct(){
             ;
    }
  
    
    //metodo per il riempimento della varabile nomeAzienda
    public function setNomeAzienda($nomeAzienda){
        
        if (empty($nomeAzienda)){
            
            return false;
        }
        
        $this->nomeAzienza = $nomeAzienda;
        return true;
        
    }
   
    //metodo per il riempimento della varabile descrizione
    public function setDescrizioneAzienda($descrizioneAzienda){
        
        if (empty($descrizioneAzienda)){
            
            return false;
        }
        $this->descrizioneAzienda = $descrizioneAzienda;
        return true;
        
    }

    //metodo per la restituzione del nome dell'azienda
    public function getNomeAzienda(){
        
        return $this->nomeAzienza;
    }
    
    //metodo per la restituzione della descrizione
    public function getDescrizioneAzienda(){
        
        return $this->descrizioneAzienda;
    }
   
    //metodo per la restituzione della lista auto in vendita
    public function getLista(){
        
        return $this->listaAuto;
    }
    
    //metodo per la restituzione della lista auto vendute
    public function getCronologia(){
        
        return $this->cronologia;
    }
    
    /*metodo per l'aggiunta di una macchina alla lista delle vendute
     * (parametro passato oggetto Automobile che deve essere aggiunta) */
    public function aggiungiAuto(Automobile $automobile, &$user){
        
        /*controlla che il numero di articoli venduti per questo commerciante non superi
         *3 dopo la registrazione della nuova auto*/
        $this->cont=0;
        //per ogni vettura già presente conta il totale degli esemplari e li regista nella variabile contatore
        foreach ($this->listaAuto as $vettura){
            
            $this->cont += $vettura->getCopie(); 
        }
        
        if (($automobile->getCopie()+$this->cont) > self::numMax){
            
            return false;// restituisce falso, identificativo di troppi veicoli in vendita
            
        }
        //se è tutto ok 
        else{
            
            //assegna un id all'auto
            
            $automobile->setID($user);
            
            //imposta il gudagno del gestore
            $automobile->setGuadagno();
            
            //imposta la data attuale per la registrazione
            //(solo nel caso non esista già per evitare di sovrascrivere quella delle factory)
            $data_veicolo = $automobile->getData();
            if (empty($data_veicolo)){
                
                $automobile->setData(time());
            }
            
            //e lo registra nell'array
            $this->listaAuto[]=$automobile;
            return true;
        }
        
    }
    
    /*metodo per la rimozione di una macchina dalla lista delle auto vendute*/
    public function rimuoviAuto(Automobile $automobile){
        
        //scorre tutta la lista delle auto in vendita
        foreach ($this->listaAuto as $veicolo){
            
            //fino a quando non trova l'id della macchina venduta uguale
            if($automobile->getID()!=$veicolo->getID()){
                
                $this->i++;//incrementa il contatore della posizione nello scorrimento dell'array
            }
            /* altrimenti vuol dire che ha trovato l'auto in questione,
             * dunque incrementa i per puntare al veicolo e interrompe il loop*/
            else{
                
                $this->i++;
                exit ();         
            }
            
            $vettura = $this->listaAuto[$this->i]; //passo l'auto ad una variabile per poi poterla restituire alla fine della funzione
            unset($this->listaAuto[$this->i]);//cancella l'auto in questione dall'array
            
            return $vettura;
            
        }          
    }
    
    /*Metodo per l'aggiunta di una macchina alla lista delle auto vendute*/
    public function aggiungiVendute(Automobile $automobile){
        
        $this->cronologia[]= $automobile;//aggiunge la macchina alla cronologia delle vendute
        
    }
    
    public function getPerId($id){
        
        foreach ($this->listaAuto as $vettura){
            
            if($vettura->getID() == $id){
                
                return $vettura;
            }
            
        }
        return false;
    }
}
?>
