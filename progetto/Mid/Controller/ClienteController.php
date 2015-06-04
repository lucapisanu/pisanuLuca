<?php

/*altre classi da includere*/
include_once 'BaseController.php';

// classe per la gestione della modifica dei dati da parte di clienti e gestore 
class ClienteController extends BaseController {

    const venditore = 'venditore';
    const vettura = 'vettura';

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

        // verifica se si è loggati altrimenti rimanda alla pagina di login
        if (!$this->loggato()) {
            
            $this->mostraPaginaLogin($vd);
        }
        //invece nel caso di utente autenticato
        else { 
           
            $user = $session[BaseController::user];

            //verifica quale sia la sottopagina in questione per sapere quale contenuti caricare 
            if (isset($request["subpage"])) {
                
                switch ($request["subpage"]) {
                    
                    case 'Carrello':
                        $vd->setSottoPagina('Carrello');
                        $this->mostraHomeUtente($vd);
                        break;
                    
                    case 'CercaVenditore':
                        $vd->setSottoPagina('CercaVenditore');
                        $this->mostraHomeUtente($vd);
                        break;
 
                    case 'CompraProdottoStep1':
                        $vd->setSottoPagina('CompraProdottoStep1');
                        $this->mostraHomeUtente($vd);
                        break;
 
                    case 'CompraProdottoStep2':
                        $vd->setSottoPagina('CompraProdottoStep2');
                        $this->mostraHomeUtente($vd);
                        break;
 
                    case 'DatiPersonaliCompratore':
                        $vd->setSottoPagina('DatiPersonaliCompratore');
                        $this->mostraHomeUtente($vd);
                        break;
 
 
                    case 'RicaricaConto':
                        $vd->setSottoPagina('RicaricaConto');
                        $this->mostraHomeUtente($vd);
                        break;
 
                    case 'StoricoAcquisti':
                        $vd->setSottoPagina('StoricoAcquisti');
                        $this->mostraHomeUtente($vd);
                        break;
                }
                
         }

            // gestione dei comandi inseriti dall'utente
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
                    
                    case 'visualizzaVenditore':
                        
                        $_SESSION[self::venditore] = UserFactory::getPerId($request[self::venditore]);
                        $this->mostraHomeUtente($vd);//ricarica la pagina in questione
                    break;
                
                    case 'aggiungiCarrello':
                        
                        //viene creato un array per l'inserimento dei messaggi di 
                        //ciò viene inserito in input ma non viene convalidato
                        $msg = array();
                        $this->aggiungiAlCarrello($user, $request, $msg);//controlla se tutti i dati vengono aggiornati correttamente
                        $this->creaFeedbackUtente($msg, $vd, "Vettura aggiunta al carrello");//imposta una schermata con tutti gli eventuali errori
                        $this->mostraHomeUtente($vd);//ricarica la pagina in questione
                        break;
                    
                      
                    // visuallizione dei venditori
                    case 'visualizzaVenditore':
                        
                        // prende la richiesta del venditore e la imposta come variabile di sessione da poter riutilizzare più avanti 
                        $_SESSION[self::venditore] = UserFactory::getPerId($request[self::venditore]);
                        
                        $this->mostraHomeUtente($vd);//ricarica la pagina in questione
                        
                    break;
                
                    // aggiunta di un auto al carrello
                    case 'aggiungiCarrello':
                        
                        //viene creato un array per l'inserimento dei messaggi di 
                        //ciò viene inserito in input ma non viene convalidato
                        $msg = array();
                        $this->aggiungiAlCarrello($user, $request, $msg);//controlla se viene aggiunta correttamente
                        $this->creaFeedbackUtente($msg, $vd, "Vettura aggiunta al carrello");//imposta una schermata con tutti gli eventuali errori
                        $this->mostraHomeUtente($vd);//ricarica la pagina in questione
                        break;
                    
                    // elimina un'auto dal carrello
                    case 'eliminaCarrello':
                        
                        //viene creato un array per l'inserimento dei messaggi di 
                        //ciò viene inserito in input ma non viene convalidato
                        $msg = array();
                        $this->eliminaDalCarrello($user, $request, $msg);//controlla se viene eliminata correttamente
                        $this->creaFeedbackUtente($msg, $vd, "Vettura eliminata");//imposta una schermata con tutti gli eventuali errori
                        $this->mostraHomeUtente($vd);//ricarica la pagina in questione
                        break;
                    
                    // di default mostra la pagina di login
                    default : $this->mostraPaginaLogin($vd);
                        break;
                }
            }
            else{
                
                // se non c'è nessun comando mostra semplicemente la pagina
                $user = $session[BaseController::user];
                $this->mostraHomeUtente($vd);
            }
        }

        //chiamata alla master page per la visualizzazione a schermo della pagina
        require basename(__DIR__) . '/../View/MasterPage.php';
    }

    /* metodo per l'aggiornamento dei dati dell'utente
     * @param User $user - utente che stà lavorando
     * @param array $request - richieste da gestire 
     * @param array $msg - messaggi di errore */
    public function modificaDatiPersonali($user, &$request, &$msg){

        
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
        
        // salviamo i dati se non ci sono stati errori
        if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
        
        
    } 
    
    /* metodo per l'iserimento di una vettura nel carrello
     * @param User $user - utente che stà lavorando
     * @param array $request - richieste da gestire 
     * @param array $msg - messaggi di errore */
    public function aggiungiAlCarrello($user, &$request, &$msg){
        
        //se esiste la richiesta con l'id della vettura
        if (isset($request[self::vettura])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->aggiungiCarrello($_SESSION[self::venditore]->getPerId($request[self::vettura]))){
                $msg[]= 'Vettura già presente nel carrello';
            }
        }
    }
    
    /* metodo per l'eliminazione di una vettura dal carrello
     * @param User $user - utente che stà lavorando
     * @param array $request - richieste da gestire 
     * @param array $msg - messaggi di errore */
    public function eliminaDalCarrello($user, &$request, &$msg){
        

        //se esiste la richiesta con l'id della vettura
        if (isset($request[self::vettura])){
            
            //se la modifica non va a buon fine (return false dal metodo)
            if(!$user->rimuoviCarrello($request[self::vettura])){
                $msg[]= 'Impossibile rimuovere la vettura';
            }
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

        // verifica che l'utente sia realmente autenticato
        $user = $_SESSION[BaseController::user];

        // controlla se si tratta realmente del cliente o del gestre
        switch ($user->getRuolo()) {

            case User::Cliente:

                return $_SESSION;


            // nel caso invece sia il gestore
            case User::Gestore:
 
                if (isset($request[BaseController::impersonato])) {
                    
                    //assegna l'id di sessione
                    $index = $request[parent::impersonato];

                    
                    //il gestore vuole impersonare il cliente e viene restituito l'array
                    if (array_key_exists($index, $_SESSION) && $_SESSION[$index][BaseController::user]->getRuolo() == User::Cliente){

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
