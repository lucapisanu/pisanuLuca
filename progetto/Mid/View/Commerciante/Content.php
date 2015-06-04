<?php
switch ($vd->getSottoPagina()) { //controlla che contenuto della pagina deve caricare
    case 'DatiPersonaliCommerciante':
        include 'DatiPersonaliCommerciante.php';
        break;
    
    case 'DatipersonaliCommerciante_modifica':
        include 'DatipersonaliCommerciante_modifica.php';
        break;

    case 'ProdottiInVendita':
        include 'ProdottiInVendita.php';
        break;
    
    case 'StoricoVendite':
        include 'StoricoVendite.php';
        break;
    
    case 'VendiProdotto':
        include 'VendiProdotto.php';
        break;
    
    case 'Home':
        include 'HomeCommerciante.php';
        break;
    
        default :
        include 'HomeCommerciante.php';
        break;
    
    
        
}
?>


