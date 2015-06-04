<?php

/**
 * Classe che rappresenta un generico utente del sistema
 */
class User{

    
    /* variabile contenente l'email 
     * @var string */
    private $email;
    
    /* variabile contenente il telefono 
     * @var int */
    private $telefono;
    
     /* variabile contenente l'username
     * @var string */   
    private $username;
    
    /* variabile contenente la password
     * @var string */
    private $password;
 
    /* variabile contenente il nome
     * @var string */
    private $nome;
 
    /* variabile contenente il cognome
     * @var string */
    private $cognome;
    
    /**
     * Via dell'abitazione dell'utente
     * @var string
     */
    private $via;
    
    /**
     * Numero civico dell'abitazione. Consideriamo interi, quindi non 1a, 1b ecc.
     * @var int 
     */
    private $numeroCivico;
    
    /**
     * Citta di residenza dell'utente. Anche qui permettiamo l'inserimento
     * di citta' anche inventate
     * @var string
     */
    private $citta;
    
    /**
     * Provincia di residenza dell'utente
     * @var string
     */
    private $provincia;
    /**
     * Cap dell'utente. Lo vogliamo max di cinque cifre
     * @var int 
     */
    private $cap;
    
    /* variabile contenente il ruolo 
     * @var string */
    private $ruolo;
    
    /* variabile contenente l'id
     * @var int */
    private $id;
    
    //costante che definisce il ruolo di Gestore
    const Gestore = -1;
    
    //costante che definisce il ruolo di Cliente
    const Cliente = 1;
    
    //costante che definisce il ruolo di Commerciante
    const Commerciante = 2;
    
    
    public function __construct() {
        ;
    }
    
    /**
     * Compara due utenti, verificandone l'uguaglianza logica
     * @param User $user l'utente con cui comparare $this
     * @return boolean true se i due oggetti sono logicamente uguali, 
     * false altrimenti
     */
    public function equals(User $user) {

        return  $this->id == $user->id &&
                $this->nome == $user->nome &&
                $this->cognome == $user->cognome &&
                $this->ruolo == $user->ruolo;
    }
    
    
    /**
     * Verifica se l'utente esista per il sistema
     * @return boolean true se l'utente esiste, false altrimenti
     */
    public function esiste() {
        // implementazione di comodo, va fatto con il db
        return isset($this->ruolo);
    }
    
    /**
     * Imposta il nome dell'utente
     * @param string $nome
     * @return boolean true se il nome e' stato impostato correttamente, 
     * false altrimenti 
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }
    
    /**
     * Restituisce il nome dell'utente
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }
    
    /**
     * Imposta il cognome dell'utente
     * @param string $cognome
     * @return boolean true se il cognome e' stato impostato correttamente,
     * false altrimenti
     */
    public function setCognome($cognome) {
        $this->cognome = $cognome;
        return true;
    }
    
    /**
     * Restituisce il cognome dell'utente
     * @return string
     */
    public function getCognome() {
        return $this->cognome;
    } 
    
    /**
     * Imposta una nuova email per l'utente
     * @param string $email la nuova email dell'utente
     * @return boolean true il nuovo l
     */
    public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $this->email = $email;
        return true;
    }
    
    /**
     * Restituisce l'email dell'utente
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }
    
    /*
     * Imposta il valore del numero di telefono dell'utente
     * @param string $telefono il nuovo numero di telefono
     * @return boolean true se il valore e' ammissibile ed e' stato aggiornato
     * correttamente, false altrimenti
     */
    public function setTelefono($telefono) {
        $intVal = filter_var($telefono, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($intVal)) {
            $this->telefono = $intVal;
            return true;
        }
        return false;
    }
 
    /**
     * Restituisce il valore del numero di telefono dell'utente
     * @return int
     */
    public function getTelefono() {
        return $this->telefono;
    }    
    
    /*
     * Imposta un nuovo valore per la via
     * @param type $via
     * @return boolean true se la via e' stata impostata correttamente, false
     * altrimenti
     */
    public function setVia($via) {
        $this->via = $via;
        return true;
    }
    
    /*
     * Restituisce la via di abitazione dell'utente
     * @return string
     */
    public function getVia() {
        return $this->via;
    }    
    
    /*
     * Imposta il valore del numero civico dell'utente
     * @param string $civico il nuovo numero civico
     * @return boolean true se il valore e' ammissibile ed e' stato aggiornato
     * correttamente, false altrimenti
     */
    public function setNumeroCivico($civico) {
        $intVal = filter_var($civico, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($intVal)) {
            $this->numeroCivico = $intVal;
            return true;
        }
        return false;
    }
 
    /**
     * Restituisce il valore del numero civico di abitazione dell'utente
     * @return int
     */
    public function getNumeroCivico() {
        return $this->numeroCivico;
    }


    /**
     * Imposta la citta di abitazione dell'utente
     * @param string $citta la nuova citta' di abitazione dell'utente
     * @return boolean true se il valore e' stato aggiornato correttamente,
     * false altrimenti
     */
    public function setCitta($citta) {
        $this->citta = $citta;
        return true;
    }

    /**
     * Restituisce la citta' di abitazione dell'utente
     * @return string
     */
    public function getCitta() {
        return $this->citta;
    }

    /**
     * Imposta la provincia di abitazione dell'utente
     * @param string $provincia la nuova provincia di abitazione dell'utente
     * @return boolean true se il valore e' stato aggiornato correttamente,
     * false altrimenti
     */
    public function setProvincia($provincia) {
        $this->provincia = $provincia;
        return true;
    }

    /**
     * Restituisce la provincia di abitazione dell'utente
     * @return string
     */
    public function getProvincia() {
        return $this->provincia;
    }
    
    
    /**
     * Imposta il cap di abitazione dell'utente
     * @param int $cap
     * @return boolean true se il nuovo valore e' ammissibile ed e' stato 
     * impostato, false altrimenti
     */
    public function setCap($cap) {
        if (!filter_var($cap, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[0-9]{5}/')))) {
            return false;
        }
        $this->cap = $cap;
        return true;
    }
    
    /**
     * Restituisce il cap di abitazione dell'utente
     * @return int
     */
    public function getCap() {
        return $this->cap;
    }
    
    /**
     * Imposta lo username per l'autenticazione dell'utente. 
     * I nomi che si ritengono validi contengono solo lettere maiuscole e minuscole.
     * La lunghezza del nome deve essere superiore a 5
     * @param string $username
     * @return boolean true se lo username e' ammissibile ed e' stato impostato,
     * false altrimenti
     */
    public function setUsername($username) {
        // utilizzo la funzione filter var specificando un'espressione regolare
        // che implementa la validazione personalizzata
        if (!filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[a-zA-Z]{5,}/')))) {
            return false;
        }
        $this->username = $username;
        return true;
    }
    
    /**
     * Restituisce lo username dell'utente
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }
    
    /**
     * Imposta la password per l'utente corrente
     * @param string $password
     * @return boolean true se la password e' stata impostata correttamente,
     * false altrimenti
     */
    public function setPassword($password) {
        $this->password = $password;
        return true;
    }
    
    /**
     * Restituisce la password per l'utente corrente
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }
    
    /**
     * Imposta un identificatore unico per l'utente
     * @param int $id
     * @return boolean true se il valore e' stato aggiornato correttamente,
     * false altrimenti
     */
    public function setId($id){
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($intVal)){
            return false;
        }
        $this->id = $intVal;
    }
    
    /**
     * Restituisce un identificatore unico per l'utente
     * @return int
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * Imposta un ruolo per un dato utente
     * @param int $ruolo
     * @return boolean true se il valore e' ammissibile ed e' stato impostato,
     * false altrimenti
     */
    public function setRuolo($ruolo) {
        switch ($ruolo) {
            case self::Cliente:
            case self::Commerciante:
            case self::Gestore:
                $this->ruolo = $ruolo;
                return true;
            default:
                return false;
        }
    }
    
    /**
     * Restituisce un intero 
     * @return int
     */
    public function getRuolo() {
        return $this->ruolo;
    }
    

}

?>
