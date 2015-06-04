<?php

$HomeGestore = 0;
$CercaAcquirente = 0;
$CercaVenditore = 0;
$SaldoGuadagni = 0;

switch ($vd->getSottoPagina()) { //controlla per vedere di che pagina si tratta in modo da impostare a currentPage solo il collegamento della pagina corrente
    case 'CercaAcquirente':
        $CercaAcquirente = 'currentPage';
        break;

    case 'CercaVenditore':
        $CercaVenditore = 'currentPage';
        break;
    
    case 'SaldoGuadagni':
        $SaldoGuadagni = 'currentPage';
        break;

    case 'Home':
        $HomeGestore = 'currentPage';
        break;
    
    default :
        $HomeGestore = 'currentPage';
        break;
    
}
?>

<ul>
    <li id="<?= $HomeGestore?>"><a href="Index.php?page=Gestore&subpage=Home">Home</a></li>
    <li id="<?= $CercaAcquirente?>"><a href="Index.php?page=Gestore&subpage=CercaAcquirente">Acquirenti</a></li><!-- id usato per riconoscere la pagina attualmente in visita -->
    <li id="<?= $CercaVenditore?>"><a href="Index.php?page=Gestore&subpage=CercaVenditore">Venditori</a></li>
    <li id="<?= $SaldoGuadagni?>"><a href="Index.php?page=Gestore&subpage=SaldoGuadagni">Guadagni</a></li>
</ul>