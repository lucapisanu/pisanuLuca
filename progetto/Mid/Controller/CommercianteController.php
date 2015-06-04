<?php

/*altre classi da includere*/
include_once 'BaseController.php';
include_once basename(__DIR__) . '/../Models/Invendita.php';
include_once basename(__DIR__) . '/../Models/InvenditaFactory.php';

// classe per la gestione della modifica dei dati da parte di venditore e gestore 
class CommercianteController extends BaseController {
    
    const maxAuto = 3;

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
                switch ($request["command"]) {

                    case 'Logout':
                        $this->logout($vd);
                        break;
                    case 'DatiPersonali':
                        $msg = array();
                        $this->modificaDatiPersonali($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Dati aggiornati");
                        $this->mostraHomeUtente($vd);
                        break;
                    case 'RegistraAuto':
                        $msg = array();
                        $automobile = new Auto(); 
                        $invendita = new Invendita();
                        $this->registraAuto($user->getId(), $invendita, $automobile, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Auto Registrata");
                        $this->mostraHomeUtente($vd);
                        break;
                    case 'EliminaAuto': 
                        $msg = array();
                        $this->eliminaAuto($user->getId(), $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Auto eliminata");
                        $this->mostraHomeUtente($vd); 
                        break;
                    default: $this->mostraHomeUtente($vd);
                        break;
                }
            } else {
                $user = $session[BaseController::user];
                $this->mostraHomeUtente($vd);
            }
        }
        require basename(__DIR__) . '/../View/MasterPage.php';
    }
    
    /* metodo per l'aggiornamento dei dati dell'utente
     * @param Utente $user - utente che stà lavorando
     * @param array $request - richieste da gestire 
     * @param array $msg - messaggi di errore */
    protected function modificaDatiPersonali($user, &$request, &$msg){
        
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
                $msg[]= 'Email inserita non corretto';
            }
        }  else {
            $msg[]='Inserisci email';  
        }
        if (isset($request['NomeAzienda'])){
            if(!$user->setNomeAzienda($request['NomeAzienda'])){
                $msg[]= 'Nome azienda inserita non corretta';
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
        if (isset($request['DescrizioneAzienda'])){
            if(!$user->setDescrizioneAzienda($request['DescrizioneAzienda'])){
                $msg[]= 'Descrizione Azienda inserita non corretta';
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
            if (UserFactory::instance()->salva($user) == null) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
        
    }
    
    /* metodo per la registrazione di una nuova auto
     * @param int $id_user - id dell'utente 
     * @param Automobile $automobile - auto da registrare
     * @param Invendita $invendita - vendita da registrare
     * @param array $request - richieste da gestire 
     * @param array $msg - messaggi di errore */
    protected function registraAuto($id_user, Invendita $invendita, Auto $automobile, &$request, &$msg){
      
       $data = date('Y-m-d'); 
      
      // controllo prima che il commerciante non abbia già inserito il massimo di auto 
      // che può avere in vendita contemporaneamente
      if ( (InvenditaFactory::instance()->autoPerCommerciante($id_user) ) >= self::maxAuto )
                $msg[]='Puoi vendere contemporaneamente al massimo 3 Auto';
      
        //assegno un nuovo id all'auto inserita
        $automobile->setId(AutoFactory::instance()->calcolaId());
            
        if (isset($request['Produttore'])){
            if(!$automobile->setProduttore($request['Produttore'])){
                $msg[]= 'Selezionare un produttore';
            }
        }
       
        if (isset($request['Modello'])){
            if(!$automobile->setModello($request['Modello'])){
                $msg[]= 'Modello inserito non corretto';
            }
        }

        if (isset($request['Accessori'])){
            if(!$automobile->setAccessori($request['Accessori'])){
                $msg[]= 'Accessori inseriti non corretti';
            }
        }
        
        if (isset($request['Colore1'])){
            if(!$automobile->setColore($request['Colore1'])){
                $msg[]= 'Inserisci un colore';
            }
        }
        
        if (isset($request['Colore2'])){
            $automobile->setColore($request['Colore1'].'; '.$request['Colore2']);
         }
        
         if (isset($request['Alimentazione'])){
            if(!$automobile->setAlimentazione($request['Alimentazione'])){
                $msg[]= 'Inserisci tipo di alimentazione';
            }
         }
       
         if (isset($request['Emissioni'])){
            if(!$automobile->setEmissioni($request['Emissioni'])){
                $msg[]= 'Inserisci una classe di emissioni';
            }
         }
       
         if (isset($request['Anno'])){
             if(!$automobile->setAnno($request['Anno'])){
                 $msg[]= 'Data di produzione non corretta';
             }
         }
     
         if (isset($request['Prezzo'])){
            if(!$automobile->setPrezzo($request['Prezzo'])){
                $msg[]= 'Prezzo inserito non corretto';
            }
         }
       
        if (isset($request['Descrizione'])){
            if(!$automobile->setDescrizione($request['Descrizione'])){
                $msg[]= 'Descrizione non corretta';
            }
        }
        
        // salviamo i dati se non ci sono stati errori
        if (count($msg) == 0) {
            
           //inserisco la nuova auto sia in auto che in invendita se non ci sono stati errori 
           if ((AutoFactory::instance()->salvaAuto($automobile) != 1 )
               || (InvenditaFactory::instance()->salvaInvendita($id_user, $automobile->getId(), $data) != 1))
                $msg[] = '<li>Salvataggio non riuscito</li>';  
            } 
      }
      
      
      
    /* metodo per l'eliminazione di un auto
     * @param int $id_user - id dell'utente 
     * @param array $request - richieste da gestire 
     * @param array $msg - messaggi di errore */     
      protected function eliminaAuto($id_user, &$request, &$msg){
        // se la $request è settata elimino l'auto dalle auto e da invendita
        if (isset($request['id_auto'])){
            if ((AutoFactory::instance()->cancellaAuto($request['id_auto']) != 1) || 
            (InvenditaFactory::instance()->cancellaInvendita($request['id_auto']) != 1 )) {
                 $msg[] = '<li> Impossibile cancellare l\'auto </li>';
            }
        }
     }
      
      
        
}


?>
    
