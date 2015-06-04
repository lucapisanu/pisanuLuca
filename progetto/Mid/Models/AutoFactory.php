<?php

include_once 'Auto.php';
include_once 'Cliente.php';
include_once 'Commerciante.php';
include_once 'User.php';
include_once 'UserFactory.php';

/**
 * Classe per la creazione delle auto
 *
 * @author Luca Pisanu
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

    
  
   /*
    * Ricerca auto nel DB
    * @param string $modello - modello dell'auto che si sta cercando
    * @param string $produttore - produttore dell'auto che si sta cercando
    * @param int $anno - anno dell'auto che si sta cercando
    * @param float $prezzo - prezzo dell'auto che si sta cercando
    * @return Auto $automobili - restituisce gli oggeti Auto trovati */
    public function &ricercaAuto($modello, $produttore, $anno, $prezzo) {
        
        $automobili = array();
        $par = array();
        $where = "";  
        $bind = ""; 
        
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
        
        if(isset($anno)){
            $where .= " and auto.anno >= ? ";
            $bind .="i";
            $par[] = $anno;
        }
        
        if(isset($prezzo)){
            $where .= " and auto.prezzo <= ? ";
            $bind .="d";
            $par[] = $prezzo;
        }  
        
        $query = "SELECT "
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
                . " FROM auto join invendita WHERE auto.id_auto = invendita.id_auto"
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
                    return $automobili;
                }
                break;

        }
        
        while ($stmt->fetch()) {
            $automobili[] = self::creaAutoDaStmt($stmt);
        }
        
        return $automobili; 
        
    }

    /**
     * Crea un'auto da una riga del db
     * @param type $row
     * @return \Auto
    */
    public function creaDaArray($row) {
        $automobile = new Auto();
        $automobile->setId($row['auto_id']);
        $automobile->setModello($row['auto_modello']);
        $automobile->setProduttore($row['auto_produttore']);
        $automobile->setAccessoriString($row['auto_accessori']);
        $automobile->setColore($row['auto_colore']);
        $automobile->setAlimentazione($row['auto_alimentazione']);
        $automobile->setEmissioni($row['auto_emissioni']);
        $automobile->setAnno($row['auto_anno']);
        $automobile->setPrezzo($row['auto_prezzo']);
        $automobile->setDescrizione($row['auto_descrizione']);
        return $automobile;
    }

    /**
     * Carica un auto eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    public function caricaAutoDaStmt(mysqli_stmt $stmt) {
   
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
        
        if (!$bind) {
            error_log("[caricaAutoDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }
        
        if (!$stmt->fetch()) {
           return null;
        }
        $stmt->close();

        return self::creaDaArray($row);
    }

    
    
     /**
     * Salva un auto sul DB
     * @param Auto $auto - automobile da inserire
     * @return boolean true se il salvataggio va a buon fine, false altrimenti
     */
    public function salvaAuto(Auto $auto) {
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salvaAuto] impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }
        $stmt = $mysqli->stmt_init();

        $insert_auto = "insert into auto(id_auto, modello, produttore, accessori, 
            colore, alimentazione, emissioni, anno, prezzo, descrizione) 
            values(?, "
                . "?, "
                . "?, "
                . "?,"
                . "?, "
                . "?, "
                . "?, "
                . "?, "
                . "?, "
                . "?)";
        
        $stmt->prepare($insert_auto);
        if (!$stmt->bind_param('issssssids', 
                $auto->getId(),
                $auto->getModello(),
                $auto->getProduttore(),
                $auto->getAccessori(),
                $auto->getColore(),
                $auto->getAlimentazione(),
                $auto->getEmissioni(),
                $auto->getAnno(),
                $auto->getPrezzo(),
                $auto->getDescrizione())) {
            error_log("[salvaAuto] impossibile" .
                    " effettuare il binding in input stmt");
            $mysqli->close();
            return 0;
        }
        
        if (!$stmt->execute()) {
            error_log("[salvaAuto] impossibile" .
                    " eseguire lo statement");
            return 0;
        }
        
        $result =  $stmt->affected_rows; 
        $stmt->close();
        
        return $result; 
       
    }
    
     /**
     * Calcola l'id da assegnare ad una nuova auto
     * @return int $res_id+1 - numero id da assegnare all'auto
     */   
    public function calcolaId(){
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[calcolaId] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        $stmt = $mysqli->stmt_init();

        $calcolaId = "SELECT MAX(auto.id_auto) FROM auto";
        
        $stmt->prepare($calcolaId);
        if (!$stmt) {
            error_log("[cercaUtentePerId] impossibile" .
                      " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }
        if (!$stmt->execute()) {
            error_log("[calcolaId] impossibile" .
                    " eseguire lo statement");
            return 0;
        }
        $stmt->bind_result($res_id); 
        $result = $stmt->fetch();
        
        $stmt->close();
        
        return $res_id+1; 
    }

    
    /**
     * Carica un auto tramite l'id
     * @param int $id_auto
     * @return \Auto
     */
    public function caricaAuto($id_auto){
        $query = 'SELECT '
                . 'auto.id_auto auto_id,'
                . 'auto.modello auto_modello, '
                . 'auto.produttore auto_produttore, '
                . 'auto.accessori auto_accessori, '
                . 'auto.colore auto_colore, '
                . 'auto.alimentazione auto_alimentazione, '
                . 'auto.emissioni auto_emissioni,'
                . 'auto.anno auto_anno, '
                . 'auto.prezzo auto_prezzo, '
                . 'auto.descrizione auto_descrizione '
                . 'FROM auto '
                . 'WHERE auto.id_auto = ?'; 
        
        $mysqli = Db::getInstance()->connectDb();
        if ($mysqli->errno > 0) {
            error_log("[caricaAuto] impossibile eseguire la query");
            $mysqli->close();
            return null;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[caricaAuto] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $id_auto)) {
            error_log("[caricaAuto] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        $auto = self::caricaAutoDaStmt($stmt); 
        if (isset($auto)){
            $mysqli->close(); 
            return $auto; 
        }
       
    }
    
    
    /**
     * Cancella un auto dal db tramite l'id
     * @param int $id_auto
     * @return $result - numero di righe restituite dallo $stmt
     */
    public function cancellaAuto($id_auto){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cancellaAuto] impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }
        $stmt = $mysqli->stmt_init();

        $query = "DELETE FROM auto WHERE auto.id_auto = ?";
        
        $stmt->prepare($query);
        if (!$stmt->bind_param('i', $id_auto)) {
            error_log("[cancellaAuto] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        
        if (!$stmt->execute()) {
            error_log("[cancellaAuto] impossibile" .
                    " eseguire lo statement");
            return 0;
        }
        
        $result =  $stmt->affected_rows; 
        $stmt->close();
        
        return $result; 
    }
    
 
}

?>
