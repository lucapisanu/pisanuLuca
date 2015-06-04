<?php
switch ($vd->getSottoPagina()) { //controlla che informazioni deve caricare
    case 'Login':
        ?>

            <h5>
                <p>
                   Benvenuto nella pagina di Login. Inserisci le tue 
                   credenziali per accedere all'area a te riservata.
                </p>
            </h5>
            
        <?
        break;

    case 'Registrazione':
        ?>

            <h5>
                <p>
                   In questa sezione potrai effettuare la registrazione se 
                   ancora non possiedi credenziali per accedere al nostro sito.
                </p>
            </h5>
            
        <?php
        break;
}
?>