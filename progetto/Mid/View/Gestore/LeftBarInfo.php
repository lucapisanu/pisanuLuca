<?php
switch ($vd->getSottoPagina()) { //controlla che informazioni deve caricare
    case 'CercaAcquirente':
        ?>

            <h5>
                <p>
                   In questa sezione potrai selezionare uno dei clienti dalla 
                   lista oppure cercarlo per nome ed operare come fossi il suddetto.
                </p>
            </h5>
            
        <?php
        break;

    case 'CercaVenditore':
        ?>

            <h5>
                <p>
                   In questa sezione potrai selezionare uno dei venditori dalla 
                   lista oppure cercarlo per nome ed operare come fossi il suddetto.
                </p>
            </h5>
            
        <?php
        break;
    
    case 'SaldoGuadagni':
         ?>

            <h5>
                <p>
                    In questa sezione potrai verificare a quanto ammonta il tuo
                    guadagno derivato da tutti gli acquisti dei clienti. 
                </p>
            </h5>
            
        <?php
        break;
    
    case 'HomeGestore':
         ?>

            <h5>
                <p>
                   Benvenuto nella sezione Gestre. Clicca su una delle 
                   sezioni per iniziare la tua attività di amministrazione.
                </p>
            </h5>
            
        <?php
        break;   
    
    default :
        ?>

            <h5>
                <p>
                   Benvenuto nella sezione Gestore. Clicca su una delle 
                   sezioni per iniziare la tua attività di amministrazione.
                </p>
            </h5>
            
        <?php
        break; 
}
?>

