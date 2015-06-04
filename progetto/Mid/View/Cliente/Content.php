<?php
switch ($vd->getSottoPagina()) { //controlla che contenuto della pagina deve caricare
    case 'Carrello':
        include 'Carrello.php';
        break;

    case 'CercaVenditore':
        include 'CercaVenditore.php';
        break;
    
    case 'CompraProdottoStep1':
        include 'CompraProdottoStep1.php';
        break;
    
    case 'CompraProdottoStep2':
        include 'CompraProdottoStep2.php';
        break;
    
    case 'DatiPersonaliCompratore':
        include 'DatiPersonaliCompratore.php';
        break;
    
    case 'RicaricaConto':
        include 'RicaricaConto.php';
        break;
    
    case 'StoricoAcquisti':
        include 'StoricoAcquisti.php';
        break;
    
    case 'Home':
        include 'HomeCliente.php';
        break;
    
    default :
        include 'HomeCliente.php';
        break;
        
}
?>


