<?php

include_once 'Auto.php';
include_once 'Cliente.php';
include_once 'Commerciante.php';
include_once 'UserFactory.php';

/**
 * Classe per la creazione degli esami
 *
 * @author  Spano
 */
class AutoFactory {

    private static $singleton;
    private function __constructor() {
    }

    /**
     * Restiuisce un singleton per creare Auto
     * @return \AutoFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new AutoFactory();
        }

        return self::$singleton;
    }

    /**
     * Restituisce la lista di esami per un dato studente
     * @param Studente $user
     */
    public function &autoCronologia($id_user) {
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[autoCronologia] impossibile inizializzare il database");
            $mysqli->close();
            return $automobili;
        }
        
        $automobili = array();
        $query =  "SELECT "
                . "auto.id_auto auto_id,"
                . "auto.modello auto_modello,"
                . "auto.produttore auto_produttore,"
                . "auto.accessori auto_accessori,"
                . "auto.colore auto_colore,"
                . "auto.alimentazione auto_alimentazione,"
                . "auto.emissioni auto_emissioni,"
                . "auto.anno auto_anno,"
                . "auto.prezzo auto_prezzo,"
                . "auto.descrizione auto_descrizione"
                . " FROM auto join acquisti WHERE auto.id_auto = acquisti.id_auto AND ? = acquisti.id_cliente;";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[autoCronologia] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $automobili;
        }
        
        if (!$stmt->bind_param('i', $id_user)) {
            error_log("[autoCronologia] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $automobili;
        }

        $automobili = self::caricaAutoDaStmt($stmt);

        $mysqli->close();
        
        return $automobili;
    }
    
    public function &ricercaAuto(Automobile $auto, $modello, $produttore, $accessori, $colore,
            $alimentazione , $emissioni, $anno, $prezzo ) {
        $automobili = array();
        
        // costruisco la where "a pezzi" a seconda di quante 
        // variabili sono definite
        $bind = "i";
        $where = " where auto.id = ? ";
        $par = array();
        $par[] = $auto->getId();
        
        if(isset($modello)){
            $where .= " and auto.modello = ? ";
            $bind .="s";
            $par[] = $modello;
        }
        
        if(isset($produttore)){
            $where .= " and auto.produttore = ? ";
            $bind .="s";
            $par[] = $produttore;
        }
        
        if(isset($accessori)){
            $where .= " and auto.accessori = ? ";
            $bind .="s";
            $par[] = $produttore;
        }
        
        if(isset($colore)){
            $where .= " and auto.colore = ? ";
            $bind .="s";
            $par[] = $colore;
        }
        
        if(isset($alimentazione)){
            $where .= " and auto.alimentazione = ? ";
            $bind .="s";
            $par[] = $alimentazione;
        }
        
        if(isset($emissioni)){
            $where .= " and auto.emissioni = ? ";
            $bind .="s";
            $par[] = $emissioni;
        }
        
        if(isset($anno)){
            $where .= " and auto.anno = ? ";
            $bind .="s";
            $par[] = $anno;
        }
        
        if(isset($prezzo)){
            $where .= " and auto.prezzo = ? ";
            $bind .="i";
            $par[] = $prezzo;
        }        
        
        $query = "SELECT "
                . "auto.id auto_id,"
                . "auto.modello auto_modello,"
                . "auto.produttore auto_produttore,"
                . "auto.accessori auto_accessori,"
                . "auto.colore auto_colore,"
                . "auto.alimentazione auto_alimentazione,"
                . "auto.emissioni auto_emissioni,"
                . "auto.anno auto_anno,"
                . "auto.prezzo auto_prezzo,"
                . "auto.descrizione auto_descrizione"
                . "FROM auto join invendita WHERE auto.id_auto = invendita.id_auto"
                .$where;
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[ricercaAuto] impossibile inizializzare il database");
            $mysqli->close();
            return $automobili;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[ricercaAuto] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $automobili;
        }

        switch (count($par)) {
            case 1:
                if (!$stmt->bind_param($bind, $par[0])) {
                    error_log("[ricercaAuto] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $automobili;
                }
                break;
            case 2:
                if (!$stmt->bind_param($bind, $par[0], $par[1])) {
                    error_log("[ricercaAuto] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $automobili;
                }
                break;

            case 3:
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2])) {
                    error_log("[ricercaAuto] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $automobili;
                }
                break;

            case 4:
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2], $par[3])) {
                    error_log("[ricercaAuto] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $esami;
                }
                break;

            case 5:
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2], $par[3], $par[4])) {
                    error_log("[ricercaAuto] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $automobili;
                }
                break;
            case 6: 
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2], $par[3], $par[4], $par[5])) {
                    error_log("[ricercaAuto] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $automobili;
                }
                break;
            case 7:
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2], $par[3], $par[4], $par[5], $par[6])) {
                    error_log("[ricercaAuto] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $automobili;
                }
                break;
            case 8:
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2], $par[3], $par[4], $par[5], $par[6], $par[7])) {
                    error_log("[ricercaAuto] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $automobili;
                }
                break;
            
           

           
        }

        $automobili = self::caricaAutoDaStmt($stmt);
        return $automobili;
    }

    public function creaDaArray($row) {
        $automobile = new Automobile();
        $automobile->setId($row['auto_id']);
        $automobile->setModello($row['auto_modello']);
        $automobile->setProduttore($row['auto_produttore']);
        $automobile->setAccessori($row['auto_accessori']);
        $automobile->setColore($row['auto_colore']);
        $automobile->setAlimentazione($row['auto_alimentazione']);
        $automobile->setEmissioni($row['auto_emissioni']);
        $automobile->setPrezzo($row['auto_prezzo']);
        $automobile->setDescrizione($row['auto_descrizione']);
        return $automobile;
    }

    public function caricaStorico(Commerciante $user) {
        $automobili = array();
        $query =  "SELECT "
                . "auto.id auto_id,"
                . "auto.modello auto_modello,"
                . "auto.produttore auto_produttore,"
                . "auto.accessori auto_accessori,"
                . "auto.colore auto_colore,"
                . "auto.alimentazione auto_alimentazione,"
                . "auto.emissioni auto_emissioni,"
                . "auto.anno auto_anno,"
                . "auto.prezzo auto_prezzo,"
                . "auto.descrizione auto_descrizione"
                . "FROM auto join acquisti WHERE auto.id_auto = acquisti.id_auto AND $user->getId() = acquisti.commerciante;";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[autoCronologia] impossibile inizializzare il database");
            $mysqli->close();
            return $automobili;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[autoStorico] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $automobili;
        }

        if (!$stmt->bind_param('i', $user->getId())) {
            error_log("[autoStorico] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $automobili;
        }

        $automobili = self::caricaAutoDaStmt($stmt);

        $mysqli->close();
        
        return $automobili;
    }

    public function &caricaAutoDaStmt(mysqli_stmt $stmt) {
        $automobili = array();
        if (!$stmt->execute()) {
            error_log("[caricaAutoDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['auto_id'], 
                $row['auto_modello'], 
                $row['auto_produttore'], 
                $row['auto_accessori'], 
                $row['auto_colore'], 
                $row['auto_alimentazione'], 
                $row['auto_emissioni'], 
                $row['auto_anno'], 
                $row['auto_prezzo'], 
                $row['auto_descrizione']);
        
        /*
         *                 $row['acquisti_commerciante'], 
                $row['acquisti_cliente'], 
                $row['acquisti_auto'], 
                $row['acquisti_data'], 
                $row['acquisti_guadagno'], 
                $row['invendita_commerciante'], 
                $row['invendita_auto'], 
                $row['invendita_data'], 
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
                $row['cliente_ruolo'],
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
                $row['commerciante_ruolo']
         */
        
        
        
        if (!$bind) {
            error_log("[caricaAutoDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $automobili[] = self::creaDaArray($row);
        }

        $stmt->close();

        return $automobili;
    }

    /**
     * Salva un elenco di esami sul DB
     * @param ElencoEsami $elenco l'elenco di esami da inserire
     * @return boolean true se il salvataggio va a buon fine, false altrimenti
     */
    public function salvaInvendita(Auto $auto, Commerciante $user) {
        $data = date('l, d-M-y:i:s T'); 
   
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salvaAuto] impossibile inizializzare il database");
            $mysqli->close();
            return false;
        }
        $stmt = $mysqli->stmt_init();
        $stmt2 = $mysqli->stmt_init();

        $insert_auto = "insert into auto(auto_id, modello, produttore, accessori, 
            colore, alimentazione, emissioni, anno, prezzo, descrizione) 
            values($auto->getId(), "
                . "$auto->getModello(), "
                . "$auto->getProduttore(), "
                . "$auto->getAccessori(),"
                . "$auto->getColore(),"
                . "$auto->getAlimentazione(),"
                . "$auto->getEmissioni(),"
                . "$auto->getAnno(),"
                . "$auto->getPrezzo(),"
                . "$auto->getDescrizione());";
        $insert_invendita = "insert into invendita(id_commerciante, id_auto, data)
            values ($user->getId(),$auto->getId(), $data);";
        
        $stmt->prepare($insert_auto);
        if (!$stmt) {
            error_log("[salvaAuto] impossibile" .
                    " inizializzare il prepared statement n 1");
            $mysqli->close();
            return false;
        }


        $stmt2->prepare($insert_invendita);
        if (!$stmt2) {
            error_log("[salvaInvendita] impossibile" .
                    " inizializzare il prepared statement n 2");
            $mysqli->close();
            return false;
        }

        if (!$stmt->bind_param('isssssssssssss', 
                $user->getId(), 
                $user->getNome(),
                $user->getCognome(),
                $user->getTelefono(),
                $user->getEmail(),
                $user->getNomeAzienda(),
                $user->getCitta(),
                $user->getVia(),
                $user->getCap(),
                $user->getProvincia(),
                $user->getNumeroCivico(),
                $user->getDescrizioneAzienda(),
                $user->getUsername(),
                $user->getPassword())) {
            error_log("[salvaAuto] impossibile" .
                    " effettuare il binding in input stmt1");
            $mysqli->close();
            return false;
        }

        if (!$stmt2->bind_param('iis', $user->getId(), $auto->getId(), $data)) {
            error_log("[salvaInvendita] impossibile" .
                    " effettuare il binding in input stmt1");
            $mysqli->close();
            return false;
        }
 
        return $stmt->affected_rows.$stmt2->affected_rows; 
    }
    
    /**
     * Salva un elenco di esami sul DB
     * @param ElencoEsami $elenco l'elenco di esami da inserire
     * @return boolean true se il salvataggio va a buon fine, false altrimenti
     */
    public function salvaAcquisto(Cliente $user, Automobile $auto) {
        $data = date('l, d-M-y:i:s T'); 
        $query = "SELECT commerciante.id_commerciante commerciante_id FROM invendita "
                . "join auto WHERE invendita.id_auto = $auto->getId());";
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salvaAuto] impossibile inizializzare il database");
            $mysqli->close();
            return false;
        }
        $stmt = $mysqli->stmt_init();
        $stmt2 = $mysqli->stmt_init();

        $insert_auto = "insert into auto(auto_id, modello, produttore, accessori, 
            colore, alimentazione, emissioni, anno, prezzo, descrizione) 
            values($auto->getId(), "
                . "$auto->getModello(), "
                . "$auto->getProduttore(), "
                . "$auto->getAccessori(),"
                . "$auto->getColore(),"
                . "$auto->getAlimentazione(),"
                . "$auto->getEmissioni(),"
                . "$auto->getAnno(),"
                . "$auto->getPrezzo(),"
                . "$auto->getDescrizione());";
        $insert_acquisti = "insert into acquisti(id_commerciante, id_cliente, id_auto, data_vendita, guadagno)
            values ($user->getId(), $query, $auto->getId(), $data, $auto->getGuadagno());";
        
        $stmt->prepare($insert_auto);
        if (!$stmt) {
            error_log("[salvaAuto] impossibile" .
                    " inizializzare il prepared statement n 1");
            $mysqli->close();
            return false;
        }


        $stmt2->prepare($insert_acquisti);
        if (!$stmt2) {
            error_log("[salvaAcquisti] impossibile" .
                    " inizializzare il prepared statement n 2");
            $mysqli->close();
            return false;
        }

        if (!$stmt->bind_param('isssssssssssss', 
                $user->getId(), 
                $user->getNome(),
                $user->getCognome(),
                $user->getTelefono(),
                $user->getEmail(),
                $user->getNomeAzienda(),
                $user->getCitta(),
                $user->getVia(),
                $user->getCap(),
                $user->getProvincia(),
                $user->getNumeroCivico(),
                $user->getDescrizioneAzienda(),
                $user->getUsername(),
                $user->getPassword())) {
            error_log("[salvaAuto] impossibile" .
                    " effettuare il binding in input stmt1");
            $mysqli->close();
            return false;
        }

        if (!$stmt2->bind_param('iis', $user->getId(), $auto->getId(), $data)) {
            error_log("[salvaInvendita] impossibile" .
                    " effettuare il binding in input stmt1");
            $mysqli->close();
            return false;
        }
         
        //aggiorno invendita
        self::cancellaInvendita($user->getId(), $auto->getId());    
  
        return $stmt->affected_rows.$stmt2->affected_rows; 
    }
    
    /*
     * 
     * 
     */
    public function cancellaInvendita(Auto $a, Commerciante $c){
        $query = "delete from invendita where id_auto = ? and 
                  id_commerciante = ?;";
  
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            return 0;
        }

        $stmt = $mysqli->stmt_init();
       
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[modificaDB] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('ii', $a->getId(), $c->getId())) {
            error_log("[modificaDB] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[modificaDB] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows;
    }
    
    /*
     * 
     * 
     */
    public function aggiornaCarrello(Cliente $cliente){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[aggiornaCarrello] impossibile inizializzare il database");
            return 0;
        }        

        $query= "SELECT carrello.id_auto carrelo_auto, "
                . "carrello.id_commerciante carrello_commerciante"
                . " FROM carrello join invendita "
                . "WHERE carrello.id_auto = invendita.id_auto;";
        
        if(!isset($query)){
            $query="DELETE * FROM carrello";
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[aggiornaCarrello] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('ii', $a->getId(), $c->getId())) {
            error_log("[aggiornaCarrello] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[aggiornaCarrello] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows;
    }

    /*
     * 
     * 
     */
    public function caricaCarrello(Cliente $cliente) {
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[caricaCarrello] impossibile inizializzare il database");
            return 0;
        }
        
        $query = "SELECT * FROM carrello;";
        if(!isset($query)){
            self::aggiornaCarrello($cliente);
        }

        $stmt = $mysqli->stmt_init();       
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[caricaCarrello] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('i', $a->getId())) {
            error_log("[caricaCarrello] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[caricaCarrello] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows;
    }
    
    /*
     * 
     * 
     */
    public function aggiungiAlCarrello(Automobile $auto, Cliente $cliente){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            return 0;
        }
        
        $query = "insert into carrello(id_auto, id_cliente) "
                . "VALUES($auto->getId(), $cliente->getId());";
        
        $stmt = $mysqli->stmt_init();     
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[aggiungiAlCarrello] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('ii', $a->getId(), $c->getId())) {
            error_log("[aggiungiAlCarrello] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[aggiungiAlCarrello] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows; 
    }
    
    /*
     * 
     * 
     */
    public function eliminaDaCarrello(Automobile $auto, Cliente $cliente){

        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[eliminaDaCarrello] impossibile inizializzare il database");
            return 0;
        }
        
        $query = "delete from invendita where id_auto = ? and 
                  id_commerciante = ?;";
        $stmt = $mysqli->stmt_init();
       
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[eliminaDaCarrelloCarrello] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('ii', $auto->getId(), $cliente->getId())) {
            error_log("[eliminaDaCarrello] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[eliminaDaCarrello] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows;
        
    }
    

}

?>
