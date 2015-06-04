<?php

$HomeCliente = 0;
$CompraProdotto = 0;
$DatiPersonaliCompratore = 0;
$Carrello = 0;
$StoricoAcquisti = 0;
$RicaricaConto = 0;

//imposta la currentPage 
switch ($vd->getSottoPagina()) { 
    case 'Carrello':
        $Carrello = 'currentPage';
        break;
    
    case 'CompraProdottoStep1':
        $CompraProdotto = 'currentPage';
        break;
    
    case 'CompraProdottoStep2':
        $CompraProdotto = 'currentPage';
        break;
    
    case 'DatiPersonaliCompratore':
        $DatiPersonaliCompratore = 'currentPage';
        break;

    case 'RicaricaConto':
        $RicaricaConto = 'currentPage';
        break;
    
    case 'StoricoAcquisti':
        $StoricoAcquisti = 'currentPage';
        break;
    
    case 'Home':
        $HomeCliente = 'currentPage';
        break;
    
    default :
        $HomeCliente = 'currentPage';
        break;
        
}
?>

<ul>
    <li id="<?=$HomeCliente?>"><a href="Index.php?page=Cliente&subpage=Home<?= $vd->scriviToken('&')?>">Home</a></li>
    <li id="<?=$CompraProdotto?>"><a href="Index.php?page=Cliente&subpage=CompraProdottoStep1<?= $vd->scriviToken('&')?>">Compra</a></li>
    <li id="<?=$DatiPersonaliCompratore?>"><a href="Index.php?page=Cliente&subpage=DatiPersonaliCompratore<?= $vd->scriviToken('&')?>">Dati personali</a></li>
    <li id="<?=$Carrello?>"><a href="Index.php?page=Cliente&subpage=Carrello<?= $vd->scriviToken('&')?>">Carrello</a></li>
    <li id="<?=$StoricoAcquisti?>"><a href="Index.php?page=Cliente&subpage=StoricoAcquisti<?= $vd->scriviToken('&')?>">Cronologia</a></li>
    <li id="<?=$RicaricaConto?>"><a href="Index.php?page=Cliente&subpage=RicaricaConto<?= $vd->scriviToken('&')?>">Ricarica</a></li>
</ul>
