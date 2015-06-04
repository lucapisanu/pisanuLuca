<?php

include_once 'Invendita.php';
include_once 'User.php';
include_once 'UserFactory.php';
include_once 'Cliente.php';
include_once 'Commerciante.php';
include_once 'AutoFactory.php';
include_once 'Auto.php';

/**
 * Classe per creare oggetti di tipo Carrello
 *
 * @author Luca Pisanu
 */
class CarrelloFactory{
    
    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare la tabella del carrello
     * @return \CarrelloFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new CarrelloFactory();
        }

        return self::$singleton;
    }
    
    
    /**
     * Salva un'auto nel carrello sul db
     * @param int $id_cliente - id_cliente che ha comprato l'auto
     * @param string $data - data dell'aggiunta dell'auto
     * @return boolean true se il salvataggio va a buon fine, false altrimenti
     */
    public function salvaCarrello($id_cliente, $id_auto, $data) {
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salvaCarrello] impossibile inizializzare il database");
            $mysqli->close();
            return false;
        }
        $stmt = $mysqli->stmt_init();

        $query = "insert into carrello(id_cliente, id_auto, data_inserimento)
            values(?,?,?)";
        
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaCarrello] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return false;
        }

        if (!$stmt->bind_param('iis', 
                $id_cliente, 
                $id_auto,
                $data)) {
            error_log("[salvaCarrello] impossibile" .
                    " effettuare il binding in input stmt");
            $mysqli->close();
            return false;
        }
        if (!$stmt->execute()) {
            error_log("[salvaCarrello] impossibile" .
                    " eseguire lo statement");
            return 0;
        }
        
        $result =  $stmt->affected_rows; 
        $stmt->close();
        $mysqli->close();
        
        return $result;
    }
    
     /*
     * Carica numero di auto nel carrello per cliente dal DB
     * @param int $id_cliente - id_cliente che ha richiesto la lista 
     * @return int $res_id - restituisce il numero di auto trovate */
    public function autoPerCliente($id_cliente){
        
        $query = 'SELECT COUNT(carrello.id_cliente)'
                . ' FROM carrello WHERE carrello.id_cliente = ?'; 
        
        $mysqli = Db::getInstance()->connectDb();
        if ($mysqli->errno > 0) {
            error_log("[autoPerCliente] impossibile eseguire la query");
            $mysqli->close();
            return null;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[autoPerCliente] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $id_cliente)) {
            error_log("[autoPerCliente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        if (!$stmt->execute()) {
            error_log("[autoPerCliente] impossibile" .
                    " eseguire lo statement");
            return 0;
        }
        $stmt->bind_result($res_id); 
        $result = $stmt->fetch();
        
        $mysqli->close();
        $stmt->close();       
        
        return $res_id; 
    }
    
     /*
     * Carica lista carrello dal DB
     * @param int $id_cliente - id_cliente che ha richiesto la lista 
     * @return Carrello $carrello - restituisci gli oggeti carrello trovati */
    public function caricaCarrello($id_cliente){
            
        $query = 'SELECT carrello.id_cliente carrello_cliente,'
                . ' carrello.id_auto carrello_auto, '
                . 'carrello.data_inserimento carrello_data '
                . 'FROM carrello '
                . 'WHERE carrello.id_cliente = ?'; 
        
        $mysqli = Db::getInstance()->connectDb();
        if ($mysqli->errno > 0) {
            error_log("[caricaCarrello] impossibile eseguire la query");
            $mysqli->close();
            return null;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[caricaCarrello] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $id_cliente)) {
            error_log("[caricaCarrello] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        $carrello = self::caricaCarrelloDaStmt($stmt);
        
        if(isset($carrello)){
           $mysqli->close();
           
           return $carrello;
        }
        
    }
    
    
     /*
     * Caancella un elemento del carrello dal DB
     * @param int $id_auto - id_auto da eliminare
     * @return array $result - restituisci il numero di righe restituite dallo $stmt */
    public function cancellaCarrello($id_auto){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cancellaCarrello] impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }
        $stmt = $mysqli->stmt_init();

        $query = "DELETE FROM carrello WHERE carrello.id_auto = ?";
        
        $stmt->prepare($query);
        if (!$stmt->bind_param('i', $id_auto)) {
            error_log("[cancellaCarrello] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        
        if (!$stmt->execute()) {
            error_log("[canellaCarrello] impossibile" .
                    " eseguire lo statement");
            return 0;
        }
        
        $result =  $stmt->affected_rows; 
        $stmt->close();
        
        return $result; 
        
    }
        
    /**
     * Crea un carrello da una riga del db
     * @param type $row
     * @return \Carrello
     */
    public function creaCarrelloDaArray($row) {
        $carrello = new Carrello();
        $carrello->setIdCliente($row['carrello_cliente']);
        $carrello->setIdAuto($row['carrello_auto']);
        $carrello->setData($row['carrello_data']);
        
        return $carrello;
    }

    
    /**
     * Carica un carrello eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaCarrelloDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaCarrelloDaStmt] impossibile" .
                      " eseguire lo statement");
            return null;
        }

        $row = array();        
        $bind = $stmt->bind_result(
                $row['carrello_cliente'],
                $row['carrello_auto'],
                $row['carrello_data']);
        if (!$bind) {
            error_log("[caricaCarrelloDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $carrello[] = self::creaCarrelloDaArray($row);
        }
        
        $stmt->close();
        return $carrello;
    }

}
?>
