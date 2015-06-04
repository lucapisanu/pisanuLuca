<?php


include_once 'Controller/BaseController.php';
include_once 'Controller/CommercianteController.php';
include_once 'Controller/ClienteController.php';
include_once 'Controller/GestoreController.php';

date_default_timezone_set("Europe/Rome");

// punto unico di accesso all'applicazione
FrontController::dispatch($_REQUEST);

//Classe per il controllo al punto unico di accesso dell'applicazione
 
class FrontController {

    //metodo per la gestione delle richieste al punto di controllo
    public static function dispatch(&$request) {
        // inizializzazione della sessione 
        session_start();
        if (isset($request["page"])) {

            switch ($request["page"]) {
                case 'Login':
                   //pagina di login unica per tutti gli utenti
                    $controller = new BaseController();
                    $controller->gestioneInput($request, $_SESSION);
                    break;
                case 'Registrazione': 
                    //pagina di registrazione unica per tutti gli utenti
                    $controller = new BaseController();
                    $controller->gestioneInput($request, $_SESSION);
                    break;
                // caso di accesso da parte di un cliente
                case 'Cliente':
                    // la pagina è accessibile solo ai clienti e all'amministratore quindi viene rimandato al controller apposito
                    $controller = new ClienteController();
                    $sessione = &$controller->getSessione($request);
                    if (!isset($sessione)) {//se non si hanno i privilegi
                        self::write403();
                    }
                    $controller->gestioneInput($request, $sessione);
                    break;

                // caso di accesso da parte di un commerciante
                case 'Commerciante':
                    // la pagina è accessibile solo ai venditori e all'amministratore quindi viene rimandato al controller apposito
                    $controller = new CommercianteController();
                    $sessione = &$controller->getSessione($request);
                    if (!isset($sessione)) { //se non si hanno i privilegi
                        self::write403();
                    }
                    $controller->gestioneInput($request, $sessione);
                    break;

                // caso di accesso da parte del gestore
                case 'Gestore':
                    // la pagina è accessibile solo ai venditori e all'amministratore quindi viene rimandato al controller apposito
                    $controller = new GestoreController();
                    $sessione = &$controller->getSessione();
                    if (!isset($sessione)) {//se non si hanno i privilegi
                        self::write403();
                    }
                    $controller->gestioneInput($request, $sessione);
                    break;
                
                //se non si tratta di nessuno dei casi precedenti di default da errore di pagina non trovata
                default:
                    self::write404(); 
                    break;
            }
        } else {
            self::write404();
        }
    }

    // metodo per la restituzione di un errore quando la pagina cercata non è disponibile
    public static function write404() {
        // imposta il codice della risposta http a 404 corrispondente a file non trovato
        header('HTTP/1.0 404 Not Found');
        $titolo = "File non trovato!";
        $mess = "Pagina richiesta non disponibile";
        include_once('error.php');//carica la pagina di errore 403
        exit();
    }

     // metodo per la restituzione di un errore quando non si hanno i privilegi di accesso
    public static function write403() {
         // imposta il codice della risposta http a 403 corrispondente a forbidden
        header('HTTP/1.0 403 Forbidden');
        $titolo = "Access denied!!";
        $mess = "Non possiedi i privilegi per accedere alla pagina";
        
        /*imposto questa variabile a true in modo da poter essere rimandato alla 
        pagina di login nella pagina di errore per accedere alla sezione dei quali ho i privilegi*/
        $login = true;
        include_once('error.php');//carica la pagina di errore 403
        exit();
    }

}

?>
