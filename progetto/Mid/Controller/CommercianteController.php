<?php

/*altre classi da includere*/
include_once 'BaseController.php';

// classe per la gestione della modifica dei dati da parte di venditore e gestore 
class CommercianteController extends BaseController {

    // costruttore della classe che riprende quello della superclasse
    public function __construct() {
        parent::__construct();
    }

    /* medoto per la gestione dell'input da parte dell'utente 
     * (sovrascrive quello della superclasse)
     * @param type $request - richieste da gestire
     * @param type $session - array di variabili di sessione */
    public function gestioneInput(&$request, &$session) {

        // Creazione del viewdescriptor
        $vd = new ViewDescriptor();

        // imposta la pagina
        $vd->setPagina($request['page']);

        // imposta il token per l'impersonificazione di un utente
        $this->setImpToken($vd, $request);

        if (!$this->loggato()) {// verifica se si è loggati altrimenti rimanda alla pagina di login
            
            $this->mostraPaginaLogin($vd);
        }
        //invece nel caso di utente autenticato
        else { 
           
            $user = $session[BaseController::user];

            //verifica quale sia la sottopagina in questione per sapere quale contenuti caricare 
            if (isset($request["subpage"])) {
                
                switch ($request["subpage"]) {
                    
                    case 'DatiPersonaliCommerciante':
                        $vd->setSottoPagina('DatiPersonaliCommerciante');
                        break;
                    
                    case 'ProdottiInVendita':
                        $vd->setSottoPagina('ProdottiInVendita');
                        break;
                    
                    case 'StoricoVendite':
                        $vd->setSottoPagina('StoricoVendite');
                        break;
                    
                    case 'VendiProdotto':
                        $vd->setSottoPagina('VendiProdotto');
                        break;
                    
                    default :
                        $vd->setSottoPagina('Home');
                        break;
                    
                   }
            }
            
            // gestione dei comandi inviati dall'utente
            if (isset($request["command"])) {
                
                // abbiamo ricevuto un comando
                switch ($request["command"]) {

                    // nel caso venga richiesto il logout
                    case 'Logout':
                        $this->logout($vd);
                        break;
                    
                    // aggiornamento dei dati
                    case 'DatiPersonali':

                        //viene creato un array per l'inserimento dei messaggi di 
                        //ciò viene inserito in input ma non viene convalidato
                        $msg = array();
                        $this->modificaDatiPersonali($user, $request, $msg);//controlla se tutti i dati vengono aggiornati correttamente
                        $this->creaFeedbackUtente($msg, $vd, "Dati aggiornati");//imposta una schermata con tutti gli eventuali errori
                        $this->mostraHomeUtente($vd);//ricarica la pagina in questione
                        break;
                    
                    
                    // registrazione di una nuov auto
                    case 'RegistraAuto':

                        //viene creato un array per l'inserimento dei messaggi di 
                        //ciò viene inserito in input ma non viene convalidato
                        $msg = array();
                        $automobile = new Automobile(); 
                        $this->registraAuto($automobile, $request, $msg);//controlla se tutti i dati vengono inseriti correttamente
                        
                        //registra l'auto solo nel caso non ci siano stati precendenti errori
                        if (empty($msg)){
                            
                            $this->aggiungiInVendita($user, $automobile,$msg);
                        }
                        $this->creaFeedbackUtente($msg, $vd, "Macchina Registrata");//imposta una schermata con tutti gli eventuali errori
                        $this->mostraHomeUtente($vd);//ricarica la pagina in questione
                        break;
                    
                    // di default mostra la pagina di login
                    default: $this->mostraHomeUtente($vd);
                        break;
                }
            } else {
                
                // se non c'è nessun comando mostra semplicemente la pagina
                $user = $session[BaseController::user];
                $this->mostraHomeUtente($vd);
            }
        }
        
        //chiamata alla master page per la visualizzazione a schermo della pagina
        require basename(__DIR__) . '/../View/MasterPage.php';
    }
    
    /* metodo per l'aggiornamento dei dati dell'utente
     * @param Utente $user - utente che stà lavorando
     * @param array $request - richieste da gestire 
     * @param array $msg - messaggi di errore */
    protected function modificaDatiPersonali($user, &$request, &$msg){
        
        //se esiste una richiesta di cambiare nome
        if (isset($request['Nome'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setNome($request['Nome'])){
                $msg[]= 'Nome inserito non corretto';
            }
        }
        
        //se esiste una richiesta di cambiare cognome
        if (isset($request['Cognome'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setCognome($request['Cognome'])){
                $msg[]= 'Cognome inserito non corretto';
            }
        }
        
        //se esiste una richiesta di cambiare il telefono
        if (isset($request['Telefono'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setTelefono($request['Telefono'])){
                $msg[]= 'Telefono inserito non corretto';
            }
        }
        
        //se esiste una richiesta di cambiare l'email
        if (isset($request['Email'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setEmail($request['Email'])){
                $msg[]= 'Email inserito non corretto';
            }
        }
        
        //se esiste una richiesta di cambiare il nome dell'azienda
        if (isset($request['NomeAzienda'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setNomeAzienda($request['NomeAzienda'])){
                $msg[]= 'Nome azienda inserito non corretto';
            }
        }
        
        //se esiste una richiesta di cambiare la città
        if (isset($request['Citta'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setCitta($request['Citta'])){
                $msg[]= 'Citta inserita non corretta';
            }
        }
        
        //se esiste una richiesta di cambiare la via
        if (isset($request['Via'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setVia($request['Via'])){
                $msg[]= 'Via inserita non corretta';
            }
        }        
        
        //se esiste una richiesta di cambiare l'indirizzo
        if (isset($request['Cap'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setCap($request['Cap'])){
                $msg[]= 'Cap inserita non corretta';
            }
        }
        
        //se esiste una richiesta di cambiare la provincia
        if (isset($request['Provincia'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setProvincia($request['Provincia'])){
                $msg[]= 'Provincia inserita non corretta';
            }
        }
        
        //se esiste una richiesta di cambiare l'indirizzo
        if (isset($request['NumeroCivico'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setNumeroCivico($request['NumeroCivico'])){
                $msg[]= 'NumeroCivico inserito non corretto';
            }
        }
        
        //se esiste una richiesta di cambiare nome
        if (isset($request['DescrizioneAzienda'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setDescrizioneAzienda($request['DescrizioneAzienda'])){
                $msg[]= 'Descrizione inserita non corretta';
            }
            
        }
        
        //se esiste una richiesta di cambiare l'username
        if (isset($request['Username'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setUsername($request['Username'])){
                $msg[]= 'Username inserito non corretto';
            }
        }
        
        //se esiste una richiesta di cambiare la password
        if (isset($request['Password'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->setPassword($request['Password'])){
                $msg[]= 'Password inserita non corretta';
            }
        }
        
        UserFactory::salva($user); 

        
    }
    
    /* metodo per la registrazione di una nuova auto
     * @param Automobile $automobile - auto da registrare
     * @param array $request - richieste da gestire 
     * @param array $msg - messaggi di errore */
    protected function registraAuto($automobile, &$request, &$msg){
        
        //se esiste una richiesta per impostare il produttore
        if (isset($request['Produttore'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$automobile->setProduttore($request['Produttore'])){
                $msg[]= 'Selezionare un produttore';
            }
        }
        
        //se esiste una richiesta per impostare il modello
        if (isset($request['Modello'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$automobile->setModello($request['Modello'])){
                $msg[]= 'Modello inserito non corretto';
            }
        }
        
        //se esiste una richiesta per impostare gli accessori
        if (isset($request['Accessori'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$automobile->setAccessori($request['Accessori'])){
                $msg[]= 'Accessori inseriti non corretti';
            }
        }
        
        //se esiste una richiesta per impostare i colori e il tipo di vernice
        if (!empty($request['Colori1'])){
            
            //inizia a popolare un array con il primo colore
            $colori = array($request['Colori1']);
            
            //se c'è anche un secondo colore lo aggiunge
            if (!empty($request['Colori2'])){
                
                $colori[] = $request['Colori2'];
            }
            
            //se non c'è il tipo di vernice segnala un errore
            if (!empty($request['Colori3'])){
                
                $colori[] = $request['Colori3'];
                
            }
            else{
                
                $msg[]= 'Inserisci un tipo di vernice';
                
            }
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$automobile->setColori($colori)){                
                $msg[]= 'Inserisci almeno un colore e un tipo di vernice';
            }
 
        }
        else {
            
            $msg[]= 'Inserisci almeno un colore';
            
        }
        
        //se esiste una richiesta per impostare l'alimentazione
        if (isset($request['Alimentazione'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$automobile->setAlimentazione($request['Alimentazione'])){
                $msg[]= 'Inserisci tipo di alimentazione';
            }
        }
        else{
            
            $msg[]= 'Inserisci tipo di alimentazione';
            
        }
        
        //se esiste una richiesta per impostare le emissioni
        if (isset($request['Emissioni'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$automobile->setEmissioni($request['Emissioni'])){
                $msg[]= 'Inserisci una classe di emissioni';
            }
        }
        else{
            
            $msg[]= 'Inserisci una classe di emissioni';
            
        }
        
        //se esiste una richiesta per impostare l'anno di produzione
        if (isset($request['Anno'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$automobile->setAnno($request['Anno'])){
                $msg[]= 'Data di produzione non corretta';
            }
        }
        
        //se esiste una richiesta per impostare il prezzo
        if (isset($request['Prezzo'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$automobile->setPrezzo($request['Prezzo'])){
                $msg[]= 'Prezzo inserito non corretto';
            }
        }
        
        //se esiste una richiesta per impostare le copie
        if (isset($request['Copie'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$automobile->setCopie($request['Copie'])){
                $msg[]= 'Numero copie non corretto';
            }
        }
        
        //se esiste una richiesta per impostare la descrizione dell'articolo
        if (isset($request['DescrizioneArticolo'])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$automobile->setDescrizione($request['DescrizioneArticolo'])){
                $msg[]= 'Descrizione non corretta';
            }
        }
    }
       
    /* metodo per l'aggiunta dell'auto a quelle in vendita
     * @param Utente $user - utente che stà lavorando
     * @param Automobile $automobile - auto da registrare
     * @param array $msg - messaggi di errore */
    public function aggiungiInVendita($user,$automobile, &$msg){
          
        //se la modifica non va a buon fine (return false dal metodo)
        if(!$user->aggiungiAuto($automobile, $user)){

            $msg[]= 'Non puoi registrare altre auto!';
        }     
    }

    /* metodo per la restituzione dell'array di sessione (il vero o quello impersonato)
     * @return array */
    public function &getSessione(&$request) {
        
        $null = null;
        if (!isset($_SESSION) || !array_key_exists(BaseController::user, $_SESSION)) {
            
            // sessione che viene inizializzata
            return $null;
        }

        // erifica che l'utente sia realmente autenticato
        $user = $_SESSION[BaseController::user];

        // controlla se si tratta realmente del cliente o del gestre
        switch ($user->getRuolo()) {

            // restituisce l'array di sessione normalmente nel caso di commerciante
            case User::Commerciante:
                

                return $_SESSION;

            // nel caso invece sia il gestore
            case User::Gestore:

                if (isset($request[BaseController::impersonato])) {
                    
                    //assegna l'id di sessione
                    $index = $request[parent::impersonato];
    
                    //il gestore vuole impersonare il commerciante e viene restituito l'array
                    if (array_key_exists($index, $_SESSION) && $_SESSION[$index][BaseController::user]->getRuolo() == User::Commerciante){

                        return $_SESSION[$index];
                    }
                    else {
                        
                        return $null;
                    }
                }
                return $null;


            default: return $null;

        }
    }
}
    
?>
