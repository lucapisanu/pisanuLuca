<?php

/*altre classi da includere*/
include_once 'BaseController.php';
include_once basename(__DIR__) . '/../Models/Carrello.php';
include_once basename(__DIR__) . '/../Models/CarrelloFactory.php';

// classe per la gestione della modifica dei dati da parte di clienti e gestore 
class ClienteController extends BaseController {

    const maxAuto = 3; 
    const commerciante = 'commerciante';
    const automobile = 'automobile';

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

                    // aggiornamento dei dati del profilo
                    case 'DatiPersonali':
                        //viene creato un array per l'inserimento dei messaggi di 
                        //ciò viene inserito in input ma non viene convalidato
                        $msg = array();
                        //controlla se tutti i dati vengono aggiornati correttamente
                        $this->modificaDatiPersonali($user, $request, $msg);
                        //imposta una schermata con tutti gli eventuali errori
                        $this->creaFeedbackUtente($msg, $vd, "Dati aggiornati");
                        //ricarica la pagina in questione
                        $this->mostraHomeUtente($vd);
                        break;
                    
                    case 'ricercaAuto' :
                        $msg = array();
                        self::setAutomobili($this->ricercaAuto($request, $msg));
                        $this->creaFeedbackUtente($msg, $vd, "Auto trovate"); 
                        $this->mostraHomeUtente($vd);
                        break;
                
                    case 'aggiungiCarrello':
                        $msg = array();
                        $this->aggiungiCarrello($user->getId(), $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Auto aggiunta al carrello");
                        $this->mostraHomeUtente($vd);
                        break;
                    
                    case 'eliminaCarrello':
                        $msg = array();
                        $this->eliminaCarrello( $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Auto eliminata");
                        $this->mostraHomeUtente($vd);
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

        if (isset($request['Nome'])){
            if(!$user->setNome($request['Nome'])){
                $msg[]= 'Nome inserito non corretto';
            }
        }
        if (isset($request['Cognome'])){
            if(!$user->setCognome($request['Cognome'])){
                $msg[]= 'Cognome inserito non corretto';
            }
        }
        if (isset($request['Telefono'])){
            if(!$user->setTelefono($request['Telefono'])){
                $msg[]= 'Telefono inserito non corretto';
            }
        }
        if (isset($request['Email'])){
            if(!$user->setEmail($request['Email'])){
                $msg[]= 'Email inserito non corretto';
            }
        }
        if (isset($request['Citta'])){
            if(!$user->setCitta($request['Citta'])){
                $msg[]= 'Citta inserita non corretta';
            }
        }
        if (isset($request['Via'])){
            if(!$user->setVia($request['Via'])){
                $msg[]= 'Via inserita non corretta';
            }
        }
        if (isset($request['Cap'])){
            if(!$user->setCap($request['Cap'])){
                $msg[]= 'Cap inserita non corretta';
            }
        }
        if (isset($request['Provincia'])){
            if(!$user->setProvincia($request['Provincia'])){
                $msg[]= 'Provincia inserita non corretta';
            }
        }
        if (isset($request['NumeroCivico'])){
            if(!$user->setNumeroCivico($request['NumeroCivico'])){
                $msg[]= 'NumeroCivico inserito non corretto';
            }
        }
        if (isset($request['Username'])){
            if(!$user->setUsername($request['Username'])){
                $msg[]= 'Username inserito non corretto';
            }
        }
        if (isset($request['Password'])){
            if(!$user->setPassword($request['Password'])){
                $msg[]= 'Password inserita non corretta';
            }
        }
        
        // salviamo i dati se non ci sono stati errori
        if (count($msg) == 0) {
            //richiamo il metodo salva dalla UserFactory per aggiornare i dati
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
        
        
    } 

    /* metodo per la ricerca di automobili
    * @param array $request - richieste da gestire 
    * @param array $msg - messaggi di errore 
    * @return array $automobili - array con le automobili trovate
    */
    protected function ricercaAuto(&$request, &$msg){
       
        $produttore = null; 
        $modello = null; 
        $anno = null; 
        $prezzo = null; 
        $i = 0;
        
        if (isset($request['Produttore'])){
            $produttore = $request['Produttore'];
            $i++;
        }
        if (isset($request['Modello'])){
            $modello = $request['Modello'];
            $i++;
        }
        if (isset($request['Anno'])){
            $anno = $request['Anno'];
            $i++; 
        }
        
        if (isset($request['Prezzo'])){
             $prezzo = $request['Prezzo'];
             $i++;
        }
        
        $automobili = AutoFactory::instance()->ricercaAuto($modello, $produttore, $anno, $prezzo); 
        
        if($i==0){
            return null;
            
        }else if (!isset ($automobili) ) {
              $msg[] = '<li>Ricerca non riuscita</li>';
        }
        
        return $automobili; 
    }


    /* metodo per l'iserimento di una vettura nel carrello
     * @param $id_user - id utente che stà lavorando
     * @param array $request - richieste da gestire 
     * @param array $msg - messaggi di errore */
    protected function aggiungiCarrello($id_cliente, &$request, &$msg){
        
        $data = date('Y-m-d');
        
        if ( (CarrelloFactory::instance()->autoPerCliente($id_cliente) ) >= self::maxAuto )
               $msg[]='Puoi avere al massimo 3 Auto nel carrello';
        
        //se esiste la richiesta con l'id della vettura
        if (isset($request['id_auto'])){ 
            
            //se la modifica non va a buon fine (return false dal metodo)
            if((CarrelloFactory::instance()->salvaCarrello($id_cliente, $request['id_auto'], $data)) == 0){
                $msg[]= 'Impossibile aggiungere la vettura';
            }
        }
    }
    
    /* metodo per l'eliminazione di una vettura dal carrello
     * @param array $request - richieste da gestire 
     * @param array $msg - messaggi di errore */
    protected function eliminaCarrello( &$request, &$msg){
        
        //se esiste la richiesta con l'id della vettura
        if (isset($request['id_auto'])){ 
            
            //se la modifica non va a buon fine (return false dal metodo)
            if((CarrelloFactory::instance()->cancellaCarrello($request['id_auto'])) == 0){
                $msg[]= 'Impossibile rimuovere la vettura';
            }
        }
    }


   /* metodo per la restituzione dell'array di sessione (il vero o quello impersonato)
    * @return array 
    */
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
                    }else {
                        return $null;
                    }
                }
               
                return $null;

            default: return $null;
        }
    }

}

?>
