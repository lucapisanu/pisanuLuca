<?php

$HomeCommerciante = 0;
$VendiProdotto = 0;
$DatiPersonaliCommerciante = 0;
$ProdottiInVendita = 0;
$StoricoVendite = 0;

switch ($vd->getSottoPagina()) { //controlla per vedere di che pagina si tratta in modo da impostare a currentPage solo il collegamento della pagina corrente
    case 'VendiProdotto':
        $VendiProdotto = 'currentPage';
        break;

    case 'DatiPersonaliCommerciante':
        $DatiPersonaliCommerciante = 'currentPage';
        break;
    
    case 'DatiPersonaliCommerciante_modifica':
        $DatiPersonaliCommerciante = 'currentPage';
        break;
    
    case 'ProdottiInVendita':
        $ProdottiInVendita = 'currentPage';
        break;
    
    case 'StoricoVendite':
        $StoricoVendite = 'currentPage';
        break;
   
    case 'Home':
        $HomeCommerciante = 'currentPage';
        break;
    
    default :
        $HomeCommerciante = 'currentPage';
        break;
    
}
?>

<ul>
    <li id="<?=$HomeCommerciante?>"><a href="Index.php?page=Commerciante&subpage=Home<?= $vd->scriviToken('&')?>">Home</a></li>
    <li id="<?=$VendiProdotto?>"><a href="Index.php?page=Commerciante&subpage=VendiProdotto<?= $vd->scriviToken('&')?>">Vendi</a></li>
    <li id="<?=$DatiPersonaliCommerciante?>"><a href="Index.php?page=Commerciante&subpage=DatiPersonaliCommerciante<?= $vd->scriviToken('&')?>">Dati personali</a></li>
    <li id="<?=$ProdottiInVendita?>"><a href="Index.php?page=Commerciante&subpage=ProdottiInVendita<?= $vd->scriviToken('&')?>">In vendita</a></li>
    <li id="<?=$StoricoVendite?>"><a href="Index.php?page=Commerciante&subpage=StoricoVendite<?= $vd->scriviToken('&')?>">Cronologia</a></li>
</ul>