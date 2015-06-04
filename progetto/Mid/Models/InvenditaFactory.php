<?php

include_once 'Invendita.php';
include_once 'User.php';
include_once 'UserFactory.php';
include_once 'Cliente.php';
include_once 'Commerciante.php';
include_once 'AutoFactory.php';
include_once 'Auto.php';

/**
 * Classe per la creazione delle vendite
 *
 * @author Luca pisanu
 */
class InvenditaFactory{
    
    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare la tabella invendita
     * @return \InvenditaFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new InvenditaFactory();
        }

        return self::$singleton;
    }
    
    
    /**
     * Salva una nuova vendita sul DB
     * @param int $id_commerciante - id del commerciante che ha messo l'auto in vendita
     * @param int $id_auto - id dell'auto messa in vendita
     * @param string $data - data della messa in vendita
     * @return boolean true se il salvataggio va a buon fine, false altrimenti
     */
    public function salvaInvendita($id_commerciante, $id_auto, $data) {
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salvaInvendita] impossibile inizializzare il database");
            $mysqli->close();
            return false;
        }
        $stmt = $mysqli->stmt_init();

        $insert_invendita = "insert into invendita(id_commerciante, id_auto, data_invendita)
            values(?,?,?)";
        
        $stmt->prepare($insert_invendita);
        if (!$stmt) {
            error_log("[salvaInvedita] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return false;
        }

        if (!$stmt->bind_param('iis', 
                $id_commerciante, 
                $id_auto,
                $data)) {
            error_log("[salvaInvendita] impossibile" .
                    " effettuare il binding in input stmt");
            $mysqli->close();
            return false;
        }
        if (!$stmt->execute()) {
            error_log("[salvaAuto] impossibile" .
                    " eseguire lo statement");
            return 0;
        }
        
        $result =  $stmt->affected_rows; 
        $stmt->close();
        $mysqli->close();
        
        return $result;
    }
    
     /*
     * Carica numero di auto in invendita per un commerciante dal DB
     * @param int $id_commerciante - id_commerciante che ha richiesto la lista 
     * @return int $res_id - restituisce il numero di auto trovate */
    public function autoPerCommerciante($id_commerciante){
        
        $query = 'SELECT COUNT(invendita.id_commerciante)'
                . ' FROM invendita WHERE invendita.id_commerciante = ?'; 
        
        $mysqli = Db::getInstance()->connectDb();
        if ($mysqli->errno > 0) {
            error_log("[autoPerCommerciante] impossibile eseguire la query");
            $mysqli->close();
            return null;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[autoPerCommerciante] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $id_commerciante)) {
            error_log("[autoPerCommerciante] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        if (!$stmt->execute()) {
            error_log("[autoPerCommerciante] impossibile" .
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
     * Carica array con l'id delle auto in vendita dal DB
     * @return array $invendita - restituisce gli id delle auto trovate */
     public function caricaIdAuto(){
            
        $query = 'SELECT invendita.id_commerciante invendita_commerciante,'
                . ' invendita.id_auto invendita_auto, '
                . 'invendita.data_invendita invendita_data '
                . 'FROM invendita '; 
        
        $mysqli = Db::getInstance()->connectDb();
        if ($mysqli->errno > 0) {
            error_log("[caricaIdAuto] impossibile eseguire la query");
            $mysqli->close();
            return null;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[caricaIdAuto] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }
        
        $invendita = self::caricaInvenditaDaStmt($stmt);
        
        if(isset($invendita)){
           $mysqli->close();
           
           return $invendita;
        }
        
        
    }
    
    /*
     * Carica lista invendita dal DB
     * @param int $id_commerciante - id_commerciante che ha richiesto la lista 
     * @return Invendita $invendita - restituisce gli oggeti invendita trovati */
     public function caricaInvendita($id_commerciante){
            
        $query = 'SELECT invendita.id_commerciante invendita_commerciante,'
                . ' invendita.id_auto invendita_auto, '
                . 'invendita.data_invendita invendita_data '
                . 'FROM invendita '
                . 'WHERE invendita.id_commerciante = ?'; 
        
        $mysqli = Db::getInstance()->connectDb();
        if ($mysqli->errno > 0) {
            error_log("[caricaInvendita] impossibile eseguire la query");
            $mysqli->close();
            return null;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[caricaInvendita] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $id_commerciante)) {
            error_log("[caricaInvendita] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        $invendita = self::caricaInvenditaDaStmt($stmt);
        
        if(isset($invendita)){
           $mysqli->close();
           
           return $invendita;
        }
        
    }
    
     /*
     * Carica lista acquisti dal DB
     * @param int $id_auto - id_auto che deve essere eliminata dalle vendite
     * @return array $result - restituisce il numero di righe restituite dallo $stmt */
    public function cancellaInvendita($id_auto){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cancellaInvendita] impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }
        $stmt = $mysqli->stmt_init();

        $query = "DELETE FROM invendita WHERE invendita.id_auto = ?";
        
        $stmt->prepare($query);
        if (!$stmt->bind_param('i', $id_auto)) {
            error_log("[cancellaInvendita] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        
        if (!$stmt->execute()) {
            error_log("[canellaInvendita] impossibile" .
                    " eseguire lo statement");
            return 0;
        }
        
        $result =  $stmt->affected_rows; 
        $stmt->close();
        
        return $result; 
        
    }
        
    
    /**
     * Crea una vendita da una riga del db
     * @param type $row
     * @return \Invendita
     */
    public function creaInvenditaDaArray($row) {
        $invendita = new Invendita();
        $invendita->setIdCommerciante($row['invendita_commerciante']);
        $invendita->setIdAuto($row['invendita_auto']);
        $invendita->setData($row['invendita_data']);
        
        return $invendita;
    }

    
    /**
     * Carica una vendota eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaInvenditaDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaInvenditaDaStmt] impossibile" .
                      " eseguire lo statement");
            return null;
        }

        $row = array();        
        $bind = $stmt->bind_result(
                $row['invendita_commerciante'],
                $row['invendita_auto'],
                $row['invendita_data']);
        if (!$bind) {
            error_log("[caricaInvenditaDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $invendita[] = self::creaInvenditaDaArray($row);
        }
        
        $stmt->close();
        return $invendita;
    }

}
?>
