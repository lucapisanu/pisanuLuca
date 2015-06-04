<?php

include_once 'Acquisti.php';
include_once 'User.php';
include_once 'UserFactory.php';
include_once 'Cliente.php';
include_once 'Commerciante.php';
include_once 'AutoFactory.php';
include_once 'Auto.php';

/**
 * Classe per creare oggetti di tipo Acquisti
 *
 * @author Luca Pisanu
 */
class AcquistiFactory{
    
    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare la tabella acquisti
     * @return \AcquistiFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new AcquistiFactory();
        }

        return self::$singleton;
    }
    
    
    /**
     * Salva un acquisto di un auto sul DB
     * @param int $id_commerciante - id_commerciante che ha venduto l'auto
     * @param int $id_cliente - id_cliente che ha comprato l'auto
     * @param int $id_auto - id_auto che è stata venduta
     * @param string $data - data della vendutita dell'auto
     * @param float $guadagno - guadagno ricavato dalla vendita dell'auto
     * @return boolean true se il salvataggio va a buon fine, false altrimenti
     */
    public function salvaAcquisti($id_commerciante, $id_cliente, $id_auto, $data, $guadagno) {
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salvaAcquisti] impossibile inizializzare il database");
            $mysqli->close();
            return false;
        }
        $stmt = $mysqli->stmt_init();

        $query = "insert into acquisti(id_commerciante, id_cliente, id_auto, data_vendita, guadagno)
            values(?,?,?,?)";
        
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaAcquisti] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return false;
        }

        if (!$stmt->bind_param('iiisd', 
                $id_commerciante, 
                $id_auto,
                $id_cliente,
                $data,
                $guadagno)) {
            error_log("[salvaAcquisti] impossibile" .
                    " effettuare il binding in input stmt");
            $mysqli->close();
            return false;
        }
        if (!$stmt->execute()) {
            error_log("[salvaAcquisti] impossibile" .
                    " eseguire lo statement");
            return 0;
        }
        
        $result =  $stmt->affected_rows; 
        $stmt->close();
        $mysqli->close();
        
        return $result;
    }
    
    
     /*
     * Carica lista acquisti dal DB
     * @return Acquisti $acquisti - restituisci gli oggeti acquisti trovati */
    public function caricaTuttiAcquisti(){
            
        $query = 'SELECT acquisti.id_commerciante acquisti_commerciante,'
                . ' acquisti.id_cliente acquisti_cliente,'
                . ' acquisti. id_auto acquisti_auto,'
                . ' acquisti.data_vendita acquisti_data, '
                . ' acquisti.guadagno acquisti_guadagno'
                . ' FROM acquisti'; 
       
        $mysqli = Db::getInstance()->connectDb();
        if ($mysqli->errno > 0) {
            error_log("[caricaAcquisti] impossibile eseguire la query");
            $mysqli->close();
            return null;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[caricaAcquisti] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        $acquisti = self::caricaAcquistiDaStmt($stmt);
        
        if(isset($acquisti)){
           $mysqli->close();
           
           return $acquisti;
        }
        
    }
    
    
     /*
     * Carica lista acquisti dal DB
     * @param int $id_user - id_user che ha richiesto la lista 
     * @param string $ruolo - ruolo dell'user che ha richiesto la lista
     * @return Acquisti $acquisti - restituisci gli oggeti acquisti trovati */
    public function caricaAcquisti($id_user, $ruolo){
            
        if ($ruolo == 'Commerciante'){
             $query = 'SELECT acquisti.id_commerciante acquisti_commerciante,'
                . ' acquisti.id_cliente acquisti_cliente,'
                . ' acquisti. id_auto acquisti_auto,'
                . ' acquisti.data_vendita acquisti_data, '
                . ' acquisti.guadagno acquisti_guadagno'
                . ' FROM acquisti'
                . ' WHERE acquisti.id_commerciante = ?'; 
        }else{
            $query = 'SELECT acquisti.id_commerciante acquisti_commerciante,'
                . ' acquisti.id_cliente acquisti_cliente,'
                . ' acquisti. id_auto acquisti_auto,'
                . ' acquisti.data_vendita acquisti_data, '
                . ' acquisti.guadagno acquisti_guadagno'
                . ' FROM acquisti'
                . ' WHERE acquisti.id_cliente = ?'; 
        }
        
        $mysqli = Db::getInstance()->connectDb();
        if ($mysqli->errno > 0) {
            error_log("[caricaAcquisti] impossibile eseguire la query");
            $mysqli->close();
            return null;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[caricaAcquisti] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $id_user)) {
            error_log("[caricaAcquisti] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        $acquisti = self::caricaAcquistiDaStmt($stmt);
        
        if(isset($acquisti)){
           $mysqli->close();
           
           return $acquisti;
        }
        
    }
    
    
    /**
     * Crea un acquisto da una riga del db
     * @param type $row
     * @return \Acquisti
     */
    public function creaAcquistiDaArray($row) {
        $acquisti = new Acquisti();
        $acquisti->setIdCommerciante($row['acquisti_commerciante']);
        $acquisti->setIdCliente($row['acquisti_cliente']); 
        $acquisti->setIdAuto($row['acquisti_auto']);
        $acquisti->setData($row['acquisti_data']);
        $acquisti->setGuadagno($row['acquisti_guadagno']); 
        
        return $acquisti;
    }

    
    /**
     * Carica un acquisto eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaAcquistiDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaAcquistiDaStmt] impossibile" .
                      " eseguire lo statement");
            return null;
        }

        $row = array();        
        $bind = $stmt->bind_result(
                $row['acquisti_commerciante'],
                $row['acquisti_cliente'],
                $row['acquisti_auto'],
                $row['acquisti_data'],
                $row['acquisti_guadagno']);
        if (!$bind) {
            error_log("[caricaAcquistiDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $acquisti[] = self::creaAcquistiDaArray($row);
        }
        
        $stmt->close();
        return $acquisti;
    }
    
     /*
     * Carica numero di auto in acquisti per utente dal DB
     * @param int $id_user - id_user che ha richiesto la lista 
     * @param string $ruolo - ruolo dell'user che ha richiesto la lista
     * @return int $res_id - restituisce il numero di auto trovate */
    public function autoPerUtente($id_user, $ruolo){
        
        if ($ruolo == 'Commerciante'){
            $query = 'SELECT COUNT(acquisti.id_commerciante)'
                . ' FROM acquisti WHERE acquisti.id_commerciante = ?'; 
        }else{
            $query = 'SELECT COUNT(acquisti.id_cliente)'
                . ' FROM acquisti WHERE acquisti.id_cliente = ?'; 
        }
        
        $mysqli = Db::getInstance()->connectDb();
        if ($mysqli->errno > 0) {
            error_log("[autoPerUtente] impossibile eseguire la query");
            $mysqli->close();
            return null;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[autoPerUtente] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $id_user)) {
            error_log("[autoPerUtente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        if (!$stmt->execute()) {
            error_log("[autoPerUtente] impossibile" .
                    " eseguire lo statement");
            return 0;
        }
        $stmt->bind_result($res_id); 
        $result = $stmt->fetch();
        
        $mysqli->close();
        $stmt->close();       
        
        return $res_id; 
    }
    

}
?>

