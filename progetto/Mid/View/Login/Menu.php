<?php

$Login = 0;
$Registrazione = 0;

switch ($vd->getSottoPagina()) {
    case 'Login':
        $Login = 'currentPage';
        break;

    case 'Registrazione':
        $Registrazione = 'currentPage';
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