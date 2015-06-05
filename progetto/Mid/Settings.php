<?php

/**
 * Classe che contiene una lista di variabili di configurazione
 *
 * @author Luca Pisanu
 */
class Settings {

    // variabili di accesso per il database
    public static $db_host = 'localhost';
    public static $db_user = 'pisanuLuca';
    public static $db_password = 'tasso2697';
    public static $db_name = 'amm15_pisanuLuca';
    
    private static $appPath;

    /**
     * Restituisce il path relativo nel server corrente dell'applicazione
     * Lo uso perche' la mia configurazione locale e' ovviamente diversa da quella 
     * pubblica. Gestisco il problema una volta per tutte in questo script
     */
    public static function getApplicationPath() {
        if (!isset(self::$appPath)) {
            // restituisce il server corrente
            switch ($_SERVER['HTTP_HOST']) {
                case 'localhost':
                    // configurazione locale
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/pisanuluca/';
                    break;
                case 'spano.sc.unica.it':
                    // configurazione pubblica
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm2015/pisanuLuca/progetto/';
                    break;

                default:
                    self::$appPath = '';
                    break;
            }
        }
        
        echo $appPath;
        return self::$appPath;
    }

}

?>
