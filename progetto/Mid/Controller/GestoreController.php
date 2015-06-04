<?php

/*altre classi da includere*/
include_once 'BaseController.php';

// classe per la gestone del gestore e delle sue impersonificazioni 
class GestoreController extends BaseController {

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
                    
                    case 'CercaAcquirente':
                        $vd->setSottoPagina('CercaAcquirente');
                        $url = 'Index.php?page=Gestore&subpage=CercaAcquirente';
                        $this->mostraHomeUtente($vd);
                        break;
                    
                    case 'CercaVenditore':
                        $vd->setSottoPagina('CercaVenditore');
                        $url = 'Index.php?page=Gestore&subpage=CercaVenditore';
                        $this->mostraHomeUtente($vd);
                        break;
                    
                    case 'SaldoGuadagni':
                        $vd->setSottoPagina('SaldoGuadagni');
                        $this->mostraHomeUtente($vd);
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

                    // modifica di un venditore 
                    case 'venditoreModifica':
                        if (isset($request[BaseController::impersonato])) {
                            
                            // ottiene l'identificatore dell'utente
                            $index = str_replace('obj', '', $request[BaseController::impersonato]);

                            //controlla quale utente deve impersonare
                            $sessionIndex = $request[BaseController::impersonato];
                            $s = UserFactory::getPerId($index);

                            //rimanda al metodo per impersonare il commerciante in questione
                            if ($this->impersonaUtente(

                                            $s, 'Commerciante', 'Home', $sessionIndex, $session)) {

                                return;
                            }
                        }
                        break;
                     
                        case 'clienteModifica':
                        if (isset($request[BaseController::impersonato])) {
                            
                            // ottiene l'identificatore dell'utente
                            $index = str_replace('obj', '', $request[BaseController::impersonato]);

                            //controlla quale utente deve impersonare
                            $sessionIndex = $request[BaseController::impersonato];
                            $s = ClienteFactory::getPerId($index);

                            // impersona e passa il controllo al controller adatto
                            if ($this->impersonaUtente(
                                            $s, 'Cliente', 'Home', $sessionIndex, $session)) {
                                return;
                            }
                        }
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


    /* metodo per l'impersonificazione di un utente
     * @param User $utente - utente da impersonare
     * @param string $pagina - pagina da visualizzare
     * @param string $sottoPagina - sottopagina da visualizzare
     * @param string $sessionIndex - l'indice della finta sessione impersonata
     * @param array $session - sessione dell'amministratore
     * @return boolean - true se il metodo funziona correttamente, false altrimenti */

    private function impersonaUtente(
            
    $utente, $pagina, $sottoPagina, $sessionIndex, &$session) {
        if (isset($utente)) {
            
            //crea un altro array come fosse la sesione dell'utente da impersonare
            $session[$sessionIndex] = array();

            // simula l'accesso dell'utente impersonificato
            $session[$sessionIndex][BaseController::user] = $utente;

            //controlla a chi affidare il controllo in base alla pagina da caricare
            switch ($pagina) {
                
                    case 'Commerciante':
                    
                    $delegate = new CommercianteController();

                    break;


                case 'Cliente':
                    
                    $delegate = new ClienteController();

                    break;
            }

            // creazione della richiesta per la pagina e la sottopagina in un nuovo array
            $new_request = array();
            $new_request["page"] = $pagina;
            $new_request["subpage"] = $sottoPagina;

            //imposta il token per ogni get e post dell'utente impersonificato
            $new_request[BaseController::impersonato] = $sessionIndex;

            // delega quindi tutte le funzioni al controller apposito già esistente
            $delegate->gestioneInput($new_request, $session[$sessionIndex]);
            return true;
        }

        return false;
    }

    /* metodo per la restituzione dell'array di sessione (il vero o quello impersonato)
     * @return array */
    public function &getSessione() {
        $null = null;
        if (isset($_SESSION) && array_key_exists(BaseController::user, $_SESSION)) {
            $user = $_SESSION[BaseController::user];
            
            // c'è la return della sessione solo nel caso si tratti del gestore
            if (isset($user) && $user->getRuolo() == User::Gestore) {
                return $_SESSION;
            }
        }
        return $null;
    }
}

?>
