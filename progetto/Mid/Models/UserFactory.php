<?php

include_once 'User.php';
include_once 'Cliente.php';
include_once 'AutoFactory.php';
include_once 'Auto.php';
include_once 'Commerciante.php';
include_once 'Db.php';

class UserFactory{
    
    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare utenti
     * @return \UserFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new UserFactory();
        }

        return self::$singleton;
    }
    
    //carica un user controllando username e password
    public function LoadUtente($username,$password){
        
        
        if ($username == 'gestore' && $password == 'gestore' ){
            
            $user = new User();
            $user->setPassword($password);
            $user->setUsername($username);
            $user->setNome('');
            $user->setCognome('Pisanu');
            $user->setRuolo(User::Gestore);
            $user->setId(0000000000);
            return $user;       
        }
         
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[loadUser] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
   
        // cerco prima nella tabella studenti
        $query = "SELECT 
                  cliente.id_cliente cliente_id,
                  cliente.nome cliente_nome,
                  cliente.cognome cliente_cognome,
                  cliente.telefono cliente_telefono,
                  cliente.email cliente_email,
                  cliente.citta cliente_citta,
                  cliente.via cliente_via,
                  cliente.cap cliente_cap,
                  cliente.provincia cliente_provincia,
                  cliente.numero_civico cliente_numero_civico,
                  cliente.username cliente_username,
                  cliente.password cliente_password,
                  cliente.ruolo cliente_ruolo
                 FROM cliente WHERE cliente.username = ? AND cliente.password = ?";
      
        $stmt = $mysqli->stmt_init();
        
        $stmt->prepare($query);
        
        if (!$stmt) {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $cliente = self::caricaClienteDaStmt($stmt);
        if (isset($cliente)) {
            // ho trovato un cliente
            $mysqli->close();
            return $cliente;
        }        
        
        /* Versione statica cliente
         * 
        if ($username == 'cliente' && $password == 'cliente' ){
            
            $user = new ClienteFactory();
            $user = ClienteFactory::Cliente();
            $user->setPassword($password);
            $user->setUsername($username);
            
            return $user; 
            
        }*/
        
     
        // ora cerco un commerciante
        $query = "SELECT 
                  commerciante.id_commerciante commerciante_id,
                  commerciante.nome commerciante_nome,
                  commerciante.cognome commerciante_cognome,
                  commerciante.telefono commerciante_telefono,
                  commerciante.email commerciante_email,
                  commerciante.nome_azienda commerciante_nome_azienda,
                  commerciante.citta commerciante_citta,
                  commerciante.via commerciante_via,
                  commerciante.cap commerciante_cap,
                  commerciante.provincia commerciante_provincia,
                  commerciante.numero_civico commerciante_numero_civico,
                  commerciante.descrizione_azienda commerciante_descrizione_azienda,
                  commerciante.username commerciante_username,
                  commerciante.password commerciante_password,
                  commerciante.ruolo commerciante_ruolo
                 FROM commerciante WHERE commerciante.username = ? AND commerciante.password = ?";

        
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }
        

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $commerciante = self::caricaCommercianteDaStmt($stmt);
        if (isset($commerciante)) {
            // ho trovato un commerciante
            $mysqli->close();
            return $commerciante;
        } 
        
        /* Versione statica commerciante
         * 
        
        if ($username == 'commerciante' && $password == 'commerciante' ){
            
            $user = new ();
            $user = ::comm3();
            $user->setPassword($password);
            $user->setUsername($username);
                
            return $user; 
            
        }     
         */   
    }
    
    
    /**
     * Restituisce un array con i Commercianti presenti nel sistema
     * @return array
     */
    public function &getListaCommercianti() {
        $commercianti = array();
        $query = "SELECT 
                  commerciante.nome commerciante_nome,
                  commerciante.cognome commerciante_cognome, 
                  commerciante.telefono commerciante_telefono,
                  commerciante.email commerciante_email,
                  commerciante.nome_azienda commerciante_nome_azienda,
                  commerciante.username commerciante_username
                  FROM commerciante";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaCommercianti] impossibile inizializzare il database");
            $mysqli->close();
            return $commercianti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaCommercianti] impossibile eseguire la query");
            $mysqli->close();
            return $commercianti;
        }

        while ($row = $result->fetch_array()) {
            $commercianti[] = self::creaCommercianteDaArray($row);
        }

        $mysqli->close();
        return $commercianti;
    }

    /**
     * Restituisce la lista dei clienti presenti nel sistema
     * @return array
     */
    public function &getListaClienti() {
        $clienti = array();
        $query = "SELECT
                  cliente.nome cliente_nome, 
                  cliente.cognome cliente_cognome, 
                  cliente.telefono cliente_telefono, 
                  cliente.email cliente_email, 
                  cliente.username cliente_username 
                  FROM cliente ";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaClienti] impossibile inizializzare il database");
            $mysqli->close();
            return $clienti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaClienti] impossibile eseguire la query");
            $mysqli->close();
            return $clienti;
        }

        while ($row = $result->fetch_array()) {
            $clienti[] = self::creaClienteDaArray($row);
        }

        return $clienti;
    }
    
    /**
     * Cerca un utente per id
     * @param int $id
     * @return Cliente/Commerciante un oggetto Cliente/Commerciante nel caso sia stato trovato,
     * NULL altrimenti
     */
    public function cercaUtentePerId($id, $role) {
        $intval = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaUtentePerId] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        switch ($role) {
            case User::Cliente:
                $query = "SELECT 
                  cliente.id_cliente cliente_id,
                  cliente.nome cliente_nome,
                  cliente.cognome cliente_cognome,
                  cliente.telefono cliente_telefono,
                  cliente.email cliente_email,
                  cliente.citta cliente_citta,
                  cliente.via cliente_via,
                  cliente.cap cliente_cap,
                  cliente.provincia cliente_provincia,
                  cliente.numero_civico cliente_numero_civico,
                  cliente.username cliente_username,
                  cliente.password cliente_password,
                  cliente.ruolo cliente_ruolo
                 FROM cliente WHERE cliente.id_cliente = ?";
                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                return self::caricaClienteDaStmt($stmt);
                break;

            case User::Commerciante:
                $query = "SELECT 
                  commerciante.id_commerciante commerciante_id,
                  commerciante.nome commerciante_nome,
                  commerciante.cognome commerciante_cognome,
                  commerciante.telefono commerciante_telefono,
                  commerciante.email commerciante_email,
                  commerciante.nome_azienda commerciante_nome_azienda
                  commerciante.citta commerciante_citta,
                  commerciante.via commerciante_via,
                  commerciante.cap commerciante_cap,
                  commerciante.provincia commerciante_provincia,
                  commerciante.numero_civico commerciante_numero_civico,
                  commerciante.descrizione_azienda commerciante_descrizione_azienda,
                  commerciante.username commerciante_username,
                  commerciante.password commerciante_password,
                  commerciante.ruolo commerciante_ruolo
                 FROM commerciante WHERE commerciante.id_commerciante = ?";

                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("[loadUser] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                $toRet =  self::caricaCommercianteDaStmt($stmt);
                $mysqli->close();
                return $toRet;
                break;

            default: return null;
        }
    }
    
    
    /**
     * Crea un cliente da una riga del db
     * @param type $row
     * @return \Cliente
     */
    public function creaClienteDaArray($row) {
        $cliente = new Cliente();
        $cliente->setId($row['cliente_id']);
        $cliente->setNome($row['cliente_nome']);
        $cliente->setCognome($row['cliente_cognome']);
        $cliente->setTelefono($row['cliente_telefono']);
        $cliente->setEmail($row['cliente_email']);
        $cliente->setCitta($row['cliente_citta']);
        $cliente->setCap($row['cliente_cap']);
        $cliente->setVia($row['cliente_via']);
        $cliente->setProvincia($row['cliente_provincia']);
        $cliente->setNumeroCivico($row['cliente_numero_civico']);
        $cliente->setRuolo(User::Cliente);
        $cliente->setUsername($row['cliente_username']);
        $cliente->setPassword($row['cliente_password']);

        return $cliente;
    }
    
    
    public function supportoCrea($row, $adress){
        
        if (isset($row[$adress]))
            {
        return $row[$adress];
        
            }
        else 
            return '-';        
    }
    
    
    /**
     * Crea un commerciante da una riga del db
     * @param type $row
     * @return \Commerciante
     */
    public function creaCommercianteDaArray($row) {
        /*
        $commerciante = new Commerciante();
        $commerciante->setId($row['commerciante_id']);
        $commerciante->setNome($row['commerciante_nome']);
        $commerciante->setCognome($row['commerciante_cognome']);
        $commerciante->setTelefono($row['commerciante_telefono']);
        $commerciante->setEmail($row['commerciante_email']);
        $commerciante->setNomeAzienda($row['commerciante_nome_azienda']);
        $commerciante->setDescrizioneAzienda($row['commerciante_descrizione_azienda']);
        $commerciante->setCitta($row['commerciante_citta']);
        $commerciante->setCap($row['commerciante_cap']);
        $commerciante->setVia($row['commerciante_via']);
        $commerciante->setProvincia($row['commerciante_provincia']);
        $commerciante->setNumeroCivico($row['commerciante_numero_civico']);
        $commerciante->setRuolo(User::Commerciante);
        $commerciante->setUsername($row['commerciante_username']);
        $commerciante->setPassword($row['commerciante_password']);

        return $commerciante;
            
    */
        $commerciante = new Commerciante();
        $commerciante->setId(self::supportoCrea($row, 'commerciante_id'));
        $commerciante->setNome(self::supportoCrea($row, 'commerciante_nome'));
        $commerciante->setCognome(self::supportoCrea($row, 'commerciante_cognome'));
        $commerciante->setTelefono(self::supportoCrea($row, 'commerciante_telefono'));
        $commerciante->setEmail(self::supportoCrea($row, 'commerciante_email'));
        $commerciante->setNomeAzienda(self::supportoCrea($row, 'commerciante_nome_azienda'));
        $commerciante->setDescrizioneAzienda(self::supportoCrea($row, 'commerciante_descrizione_azienda'));
        $commerciante->setCitta(self::supportoCrea($row, 'commerciante_citta'));
        $commerciante->setCap(self::supportoCrea($row, 'commerciante_cap'));
        $commerciante->setVia(self::supportoCrea($row, 'commerciante_via'));
        $commerciante->setProvincia(self::supportoCrea($row, 'commerciante_provincia'));
        $commerciante->setNumeroCivico(self::supportoCrea($row, 'commerciante_numero_civico'));
        $commerciante->setRuolo(User::Commerciante);
        $commerciante->setUsername(self::supportoCrea($row, 'commerciante_username'));
        $commerciante->setPassword(self::supportoCrea($row, 'commerciante_password'));
            
        return $commerciante;
    
    }
    
    /**
     * Salva i dati relativi ad un utente sul db
     * @param User $user
     * @return il numero di righe modificate
     */
    public function salva(User $user) {
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }

        $stmt = $mysqli->stmt_init();
        $count = 0;
        
        switch ($user->getRuolo()) {
            case User::Cliente:
                $count = self::salvaCliente($user, $stmt);
                
                break;
            case User::Commerciante:
                $count = self::salvaCommerciante($user, $stmt);
        }
        
        $stmt->close();
        $mysqli->close();
        return $count;
    }
    
    /**
     * Rende persistenti le modifiche all'anagrafica di un cliente sul db
     * @param Cliente $s il cliente considerato
     * @param mysqli_stmt $stmt un prepared statement
     * @return int il numero di righe modificate
     */
    private function salvaCliente(Cliente $s, mysqli_stmt $stmt) {
        $query = " update cliente set
                    nome = ?,
                    cognome = ?,
                    telefono = ?,
                    email = ?,
                    numero_civico = ?,
                    citta = ?,
                    provincia = ?,
                    cap = ?,
                    via = ?,
                    username = ?,
                    password = ?,
                    ruolo = ?
                    where cliente.id_cliente = ?;
                    ";
        var_dump($query); 
        
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaCliente] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('ssssssssssssi', 
                $s->getNome(), 
                $s->getCognome(), 
                $s->getTelefono(),
                $s->getEmail(), 
                $s->getNumeroCivico(),
                $s->getCitta(), 
                $s->getProvincia(),
                $s->getCap(), 
                $s->getVia(),  
                $s->getUsername(),
                $s->getPassword(),
                $s->getRuolo(),
                $s->getId())) {
            error_log("[salvaCliente] impossibile" .
                    " effettuare il binding in input");
            return 0;
        }
      
        if (!$stmt->execute()) {
            error_log("[caricaClienti] impossibile" .
                    " eseguire lo statement");
            return 0;
        }

        return $stmt->affected_rows;
    }
    
    /**
     * Rende persistenti le modifiche all'anagrafica di un commerciante sul db
     * @param Commerciante $d il commerciante considerato
     * @param mysqli_stmt $stmt un prepared statement
     * @return int il numero di righe modificate
     */
    private function salvaCommerciante(Commerciante $d, mysqli_stmt $stmt) {
        $query = " update commerciante set 
                    nome = ?,
                    cognome = ?,
                    telefono = ?,
                    email = ?,
                    nome_azienda = ?,
                    citta = ?,
                    provincia = ?,
                    cap = ?,
                    via = ?,
                    numero_civico = ?,
                    descrizione_azienda = ?,
                    username = ?,
                    password = ?
                    where commerciante.id_commerciante = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaCommerciante] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('sssssssssssssi',
                $d->getNome(), 
                $d->getCognome(), 
                $d->getTelefono(),
                $d->getEmail(), 
                $d->getNomeAzienda(),
                $d->getCitta(),
                $d->getProvincia(),
                $d->getCap(), 
                $d->getVia(), 
                $d->getNumeroCivico(), 
                $d->getDescrizioneAzienda(),
                $d->getUsername(),
                $d->getPassword(), 
                $d->getId())) {
            error_log("[salvaCommerciante] impossibile" .
                    " effettuare il binding in input");
            return 0;
        }

        return $stmt->affected_rows;
    }
    
    
    /**
     * Carica un cliente eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaClienteDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaClienteDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['cliente_id'], 
                $row['cliente_nome'], 
                $row['cliente_cognome'], 
                $row['cliente_telefono'], 
                $row['cliente_email'], 
                $row['cliente_citta'], 
                $row['cliente_via'], 
                $row['cliente_cap'], 
                $row['cliente_provincia'], 
                $row['cliente_numero_civico'], 
                $row['cliente_username'], 
                $row['cliente_password'], 
                $row['cliente_ruolo']);
        if (!$bind) {
            error_log("[caricaClienteDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaClienteDaArray($row);
    }
    
    /**
     * Carica un commerciante eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaCommercianteDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaCommercianteDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['commerciante_id'], 
                $row['commerciante_nome'], 
                $row['commerciante_cognome'], 
                $row['commerciante_telefono'], 
                $row['commerciante_email'], 
                $row['commerciante_nome_azienda'],
                $row['commerciante_descrizione_azienda'],
                $row['commerciante_citta'], 
                $row['commerciante_via'], 
                $row['commerciante_cap'], 
                $row['commerciante_provincia'], 
                $row['commerciante_numero_civico'], 
                $row['commerciante_username'], 
                $row['commerciante_password'], 
                $row['commerciante_ruolo']);
        if (!$bind) {
            error_log("[caricaCommercianteDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaCommercianteDaArray($row);
    }
    
    

}
?>
