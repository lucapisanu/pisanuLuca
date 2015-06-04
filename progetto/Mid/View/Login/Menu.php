<?php

$Login = 0;
$Registrati = 0;

switch ($vd->getSottoPagina()) { //controlla per vedere di che pagina si tratta in modo da impostare la currentPage solo il collegamento della pagina corrente
    case 'Login':
        $CercaAcquirente = 'currentPage';
        break;

    case 'Registrazione':
        $CercaVenditore = 'currentPage';
        break;
    
    default :
        $Login = 'currentPage';
        break;
    
}
?>

<ul>
    <li id="<?= $Login?>"><a href="Index.php?page=Login">Login</a></li>
    <li id="<?= $Registrazione?>"><a href="Index.php?page=Registrazione">Registrati</a></li>
</ul>