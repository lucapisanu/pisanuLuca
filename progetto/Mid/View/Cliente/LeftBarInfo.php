<?php
switch ($vd->getSottoPagina()) { //controlla che informazioni deve caricare
    case 'Carrello':
        ?>

            <h5>
                <p class="text-info">
                   In questa sezione potrai verificare quali sono le auto da te 
                   inserite nel carrello e quindi poterne confermare
                   l'eventuale acquisto, oppure scartarle dalla lista delle tue scelte.
                </p>
            </h5>
            
        <?php
        break;
    
    case 'CompraProdottoStep1':
         ?>

            <h5>
                <p class="text-info">
                   In questa sezione potrai ricercare un particolare tipo di 
                   auto scegliendo tra la ricerca semplice per nome e quella avanzata, 
                   dove potrai specificare tutte le caratteristiche alle quali sei interessato. 
                </p>
            </h5>
            
        <?php
        break;
    
    case 'CompraProdottoStep2':
         ?>

            <h5>
                <p class="text-info">
                   In questa sezione ti vengono proposti i risultati corrispondenti 
                   al tipo di ricerca da te effettuata e puoi decidere se aggiungere
                   al carrello delle autovetture trovate oppure se effettuare un'altra ricerca. 
                </p>
            </h5>
            
        <?php
        break;
    
    case 'DatiPersonaliCommerciante':
         ?>

            <h5>
                <p class="text-info">
                   In questa sezione sono presenti i tuoi dati personali,
                   che puoi eventualmente modificare se desideri.
                </p>
            </h5>
            
        <?php
        break;
    
    case 'DatiPersonaliCompratore_modifica':
         ?>

            <h5>
                <p class="text-info">
                   In questa sezione potrai modificare i dati registrati a te associati.
                </p>
            </h5>
            
        <?php
        break;
    
    case 'RicaricaConto':
         ?>

            <h5>
                <p class="text-info">
                   In questa sezione potrai ricaricare 
                   il tuo conto all'interno del sito per avere a disposizione
                   la somma necessaria per eventuali acquisti.
                </p>
            </h5>
            
        <?php
        break;
    
    case 'StoricoAcquisti':
         ?>

            <h5>
                <p class="text-info">
                   In questa sezione ti è possibile vedere la cronologia 
                   dei tuoi acquisti fatti dal momento della tua registrazione a oggi.
                </p>
            </h5>
            
        <?php
        break;
    
     case 'Home':
            ?>

            <h5>
                <p class="text-info">
                   Benvenuto nella sezione cliente. Clicca su una delle 
                   sezioni per iniziare la tua attività all'interno del sito.
                </p>
            </h5>
            
        <?php
        break;
    
    default :
         ?>

            <h5>
                <p class="text-info">
                   Benvenuto nella sezione cliente. Clicca su una delle 
                   sezioni per iniziare la tua attività all'interno del sito.
                </p>
            </h5>
            
        <?php
        break;
        
}
?>


