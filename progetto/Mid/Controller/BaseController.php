<?php

/*altre classi da includere*/
include_once basename(__DIR__) . '/../View/ViewDescriptor.php';
include_once basename(__DIR__) . '/../Models/User.php';
include_once basename(__DIR__) . '/../Models/UserFactory.php';
include_once basename(__DIR__) . '/../Models/Auto.php';
include_once basename(__DIR__) . '/../Models/AutoFactory.php';
include_once basename(__DIR__) . '/../Models/Cliente.php';
include_once basename(__DIR__) . '/../Models/Commerciante.php';
include_once basename(__DIR__) . '/../Models/Acquisti.php';
include_once basename(__DIR__) . '/../Models/AcquistiFactory.php';
include_once basename(__DIR__) . '/../Settings.php';


//classe per il controllo degli utenti non ancora autenticati e di tutte le funzionalità comuni a qualsiasi ruolo
class BaseController {

    const user = 'user';
    const impersonato = '_imp';
    const role = 'ruolo';

    // costruttore della classe
    public function __construct() {
        ;
    }

  /*metodo generale per la gestione degli input
   * @param type $request - richieste da gestire
   * @param type $session - array di variabili di sessione */
    public function gestioneInput(&$request, &$session) {

    // Creazione del viewdescriptor
    $vd = new ViewDescriptor();

    // imposta la pagina
    $vd->setPagina($request['page']);
    
    // imposta il token per l'impersonificazione di un utente
    $this->setImpToken($vd, $request);

    //gestione dell'input nella schermata di login 
    if (isset($request["command"])) {
        
        switch ($request["command"]) {
            
            case "Login":
                //se è stato inserito un valore per la username
                if (isset($request['user'])){ 
                //imposta la username con quel valore
                $username = $request['user']; 
            }
            //altrimenti lascia una stringa vuota
            else{
                $username = ''; 
            }
            //se è stato inserito un valore per la password
            if (isset($request['password'])){ 
                //imposta la pasword con quel valore
                $password = $request['password']; 
            }
            //altriementi lascia una stringa vuota
            else{
                $password = ''; 
            }
            //richiama la funzione per loggare l'utente
            $this->login($vd, $username, $password);
            // se si riesce nel loggin viene impostata una variabile  utilizzata poi nel momento della vista
            if ($this->loggato())
            $user = $_SESSION[self::user];
            break;
            
            case "Registrazione": 
                     $msg = array();
                     if ($request['Ruolo'] == 'Commerciante'){
                         $user = new Commerciante();
                        $this->salvaUtente($user, $request, $msg);
                     }else{
                         $user = new Cliente();
                         $this->salvaUtente($user, $request, $msg);
                     }
                     $this->creaFeedbackUtente($msg, $vd, "Utente registrato");
                     $this->mostraPaginaLogin();  
            break;
            
            //mostra la pagina di login nel caso la richiesta non sia case 'Login' o 'Registrazione'
            default : $this->mostraPaginaLogin();
        }
    } 
    else {
        // se si riesce nel loggin
        if ($this->loggato()) { 

            //viene impostata una variabile  utilizzata poi nel momento della vista
            $user = $_SESSION[self::user];

            // richiama il metodo pe decidere quale home deve visualizzare
            $this->mostraHomeUtente($vd);
        }
        //altrimenti mostra la pagina di login
        else {

            $this->mostraPaginaLogin($vd);
        }
    }

    //chiamata alla master page per la visualizzazione a schermo della pagina
    require basename(__DIR__) . '/../View/MasterPage.php';
    }

    
    // metodo per la restituzione dell'array contenente la sessione dell'utente attualmente impersonato
    public function &getSessione() {
        
        return $_SESSION;
    }

   
    //verifica se l'utente è autenticato al loggin, se non lo è restituisce false
    protected function loggato() {
        
        return isset($_SESSION) && array_key_exists(self::user, $_SESSION); 
    }

    /* metodo per l'impostazione della masterpage alla visualizzazione della schermata di login
     * @param ViewDescriptor $vd - descrittore della vista*/
    protected function mostraPaginaLogin($vd) {
        $vd->setTitolo("AutoShop -> Login");
        $vd->setLogoFile(basename(__DIR__) . '/../View/Login/Logo.php');
        $vd->setMenuFile(basename(__DIR__) . '/../View/Login/Menu.php');
        $vd->setLeftBarInfoFile(basename(__DIR__) . '/../View/Login/LeftBarInfo.php');
        $vd->setContentFile(basename(__DIR__) . '/../View/Login/Content.php');
    }
    
            
    /* metodo per l'impostazione della masterpage alla visualizzazione della schermata di registrazione
     * @param ViewDescriptor $vd - descrittore della vista*/
    protected function mostraPaginaRegistrazione($vd) {
        $vd->setTitolo("AutoShop -> Registrazione");
        $vd->setLogoFile(basename(__DIR__) . '/../View/Login/Logo.php');
        $vd->setMenuFile(basename(__DIR__) . '/../View/Login/Menu.php');
        $vd->setLeftBarInfoFile(basename(__DIR__) . '/../View/Login/LeftBarInfo.php');
        $vd->setContentFile(basename(__DIR__) . '/../View/Login/Registrazione.php');
    }

    /* metodo per l'impostazione della masterpage alla visualizzazione dell'home del cliente
     * @param ViewDescriptor $vd - descrittore della vista*/
    protected function mostraHomeCliente($vd) {
        $vd->setTitolo("AutoShop -> Cliente ");
        $vd->setLogoFile(basename(__DIR__) . '/../View/Cliente/Logo.php');
        $vd->setMenuFile(basename(__DIR__) . '/../View/Cliente/Menu.php');
        $vd->setLeftBarInfoFile(basename(__DIR__) . '/../View/Cliente/LeftBarInfo.php');
        $vd->setContentFile(basename(__DIR__) . '/../View/Cliente/Content.php');
    }

    /* metodo per l'impostazione della masterpage alla visualizzazione dell'home del venditore
     * @param ViewDescriptor $vd - descrittore della vista */
    protected function mostraHomeCommerciante($vd) {
        // mostro la home dei docenti
        $vd->setTitolo("AutoShop -> Commerciante ");
        $vd->setLogoFile(basename(__DIR__) . '/../View/Commerciante/Logo.php');
        $vd->setMenuFile(basename(__DIR__) . '/../View/Commerciante/Menu.php');
        $vd->setLeftBarInfoFile(basename(__DIR__) . '/../View/Commerciante/LeftBarInfo.php');
        $vd->setContentFile(basename(__DIR__) . '/../View/Commerciante/Content.php');
    }

    
    /* metodo per l'impostazione della masterpage alla visualizzazione dell'home del gestore
     * @param ViewDescriptor $vd - descrittore della vista */
    protected function mostraHomeGestore($vd) {
        $vd->setTitolo("AutoShop -> Amministratore ");
        $vd->setLogoFile(basename(__DIR__) . '/../View/Gestore/Logo.php');
        $vd->setMenuFile(basename(__DIR__) . '/../View/Gestore/Menu.php');
        $vd->setLeftBarInfoFile(basename(__DIR__) . '/../View/Gestore/LeftBarInfo.php');
        $vd->setContentFile(basename(__DIR__) . '/../View/Gestore/Content.php');
    }

    
    /* metodo per la scelta della pagina da visualizzare in base al ruolo impersonato
     * @param ViewDescriptor $vd - descrittore della vista */    
    protected function mostraHomeUtente($vd) {
        
        $user = $_SESSION[self::user];
        switch ($user->getRuolo()) {
            case User::Cliente:
                $this->mostraHomeCliente($vd);
                break;

            case User::Commerciante:
                $this->mostraHomeCommerciante($vd);
                break;

            case User::Gestore:
                $this->mostraHomeGestore($vd);
                break;
        }
    }

 
    /* nel caso venga specificato nella richiesta imposta il token 
     * per l'impersonificazione di un utente
     * @param ViewDescriptor $vd - descrittore della vista
     * @param array $request - richiesta da gestire */
    protected function setImpToken(ViewDescriptor $vd, &$request) {

        if (array_key_exists('_imp', $request)) {
            $vd->setImpToken($request['_imp']);
        }
    }

    /* metodo per effetture il login
     * @param ViewDescriptor $vd - descrittore della vista
     * @param string $username - username utente
     * @param string $password - password utente*/
    protected function login($vd, $username, $password) {
        
        //caricamento dei dati dalla classe utente
        $user = UserFactory::instance()->LoadUtente($username, $password);
        
        //se i dati inseriti sono giusti
        if (isset($user) && $user->esiste()) { 
            
            //imposta la sessione con l'utente impersonato
            $_SESSION[self::user] = $user;
            $_SESSION[self::role] = $user->getRuolo();
            $this->mostraHomeUtente($vd);
        } 
        //altrimenti rimanda alla pagina di login con la visualizzazione dell'errore
        else{
            $vd->setMessaggioErrore("Dati inseriti non corretti, riprova");
            $this->mostraPaginaLogin($vd);
        }
        
    }

    /* metodo per il logout dal sistema
     * @param ViewDescriptor $vd - descrittore della vista */
    protected function logout($vd) {
        
        // resetta l'array $_SESSION
        $_SESSION = array();
        
        // termina la validita' del cookie di sessione
        if (session_id() != '' || isset($_COOKIE[session_name()])) {
            
            // imposta il termine di validita' al mese scorso
            setcookie(session_name(), '', time() - 2592000, '/');
        }
        
        // distrugge il file di sessione
        session_destroy();
        
        //mostra nuovamente la pagina di login
        $this->mostraPaginaLogin($vd);
    }
    
    /**
     * Aggiorno l'indirizzo di un utente (comune a Cliente e Commerciante)
     * @param User $user l'utente da aggiornare
     * @param array $request la richiesta http da gestire
     * @param array $msg riferimento ad un array da riempire con eventuali
     * messaggi d'errore
     */
    protected function aggiornaIndirizzo($user, &$request, &$msg) {

        if (isset($request['Via'])) {
            if (!$user->setVia($request['Via'])) {
                $msg[] = '<li>La via specificata non &egrave; corretta</li>';
            }
        }
        if (isset($request['Numerocivico'])) {
            if (!$user->setNumeroCivico($request['Numerocivico'])) {
                $msg[] = '<li>Il formato del numero civico non &egrave; corretto</li>';
            }
        }
        if (isset($request['Citta'])) {
            if (!$user->setCitta($request['Citta'])) {
                $msg[] = '<li>La citt&agrave; specificata non &egrave; corretta</li>';
            }
        }
        if (isset($request['Provincia'])) {
            if (!$user->setProvincia($request['Provincia'])) {
                $msg[] = '<li>La provincia specificata &egrave; corretta</li>';
            }
        }
        if (isset($request['Cap'])) {
            if (!$user->setCap($request['Cap'])) {
                $msg[] = '<li>Il CAP specificato non &egrave; corretto</li>';
            }
        }

        // salviamo i dati se non ci sono stati errori
        if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
    }

    /**
     * Aggiorno l'indirizzo email di un utente (comune a Studente e Docente)
     * @param User $user l'utente da aggiornare
     * @param array $request la richiesta http da gestire
     * @param array $msg riferimento ad un array da riempire con eventuali
     * messaggi d'errore
     */
    protected function aggiornaEmail($user, &$request, &$msg) {
        if (isset($request['email'])) {
            if (!$user->setEmail($request['email'])) {
                $msg[] = '<li>L\'indirizzo email specificato non &egrave; corretto</li>';
            }
        }
        
        // salviamo i dati se non ci sono stati errori
        if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
    }

    /**
     * Aggiorno la password di un utente (comune a Studente e Docente)
     * @param User $user l'utente da aggiornare
     * @param array $request la richiesta http da gestire
     * @param array $msg riferimento ad un array da riempire con eventuali
     * messaggi d'errore
     */
    protected function aggiornaPassword($user, &$request, &$msg) {
        if (isset($request['pass1']) && isset($request['pass2'])) {
            if ($request['pass1'] == $request['pass2']) {
                if (!$user->setPassword($request['pass1'])) {
                    $msg[] = '<li>Il formato della password non &egrave; corretto</li>';
                }
            } else {
                $msg[] = '<li>Le due password non coincidono</li>';
            }
        }
        
        // salviamo i dati se non ci sono stati errori
        if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
    }

    /* metodo per la creazione di un messaggio per l'utente per sapere 
     * se le operazioni richieste sono a ndate a buon fine o meno 
     * @param array $msg - messaggi di errore complessivi
     * @param ViewDescriptor $vd - descrittore della vista
     * @param string $okMsg - messaggio da mostrare nel caso non ci siano errori */
    protected function creaFeedbackUtente(&$msg, $vd, $okMsg) {


            //se l'array dei messaggi non è voto quindi c'è qualche errore
            if (!empty($msg)) {

                $error = "Si sono verificati i seguenti errori: <br>";

                foreach ($msg as $m) {
                    $error = $error . '- ' . $m . "<br><br>";
                }

                // imposta il messaggio di errore
                $vd->setMessaggioErrore($error);

            } 
            // altrimenti non ci sono errori quindi mostro il messaggio 
            // di conferma passato alla funzione
            else{
           
                $vd->setMessaggioConferma($okMsg);
            }    
        }        
    
}

?>
