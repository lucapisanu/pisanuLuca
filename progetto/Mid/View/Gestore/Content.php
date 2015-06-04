<?php

//controlla che pagina è visto che la vista può esssre di tutti gli utenti
switch ($vd->getPagina()) {
    case 'Cliente':
        switch ($vd->getSottoPagina()) {
            default:
                include_once 'View/Cliente/Content.php';
                break;
        }
        break;
    
    case 'Commerciante':
        switch ($vd->getSottoPagina()) {
            default:
                include_once 'View/Commerciante/Content.php';
                break;
        }
        break;

    case 'Gestore':
        switch ($vd->getSottoPagina()) { 
    //controlla quale contenuto della pagina deve caricare
    case 'CercaAcquirente':
        include 'CercaAcquirente.php';
        break;
    
    case 'CercaVenditore':
        include 'CercaVenditore.php';
        break;
    
    case 'SaldoGuadagni':
        include 'SaldoGuadagni.php';
        break;
    
    case 'Home':
        include 'HomeGestore.php';
        break;
    
        default :
        include 'HomeGestore.php';
        break;
    }
}
?>





