<?php
switch ($vd->getSottoPagina()) { //controlla che informazioni deve caricare
    case 'VendiProdotto':
        ?>

            <h5>
                <p>
                   In questa sezione potrai mettere in vendita un prodotto 
                   compilando tutti i campi riguardanti le caratteristiche 
                   dell'autovettura che desideri mettere in commercio.
                </p>
            </h5>
            
        <?php
        break;

    case 'DatiPersonaliCommerciante':
        ?>

            <h5>
                <p>
                   In questa sezione sono presenti i tuoi dati personali,
                   che puoi eventualmente modificare se desideri.
                </p>
            </h5>
            
        <?php
        break;
    
    case 'DatiPersonaliCommerciante_modifica':
         ?>

            <h5>
                <p>
                    In questa sezione potrai modificare i dati registrati a te associati. 
                </p>
            </h5>
            
        <?php
        break;
    
    case 'ProdottiInVendita':
         ?>

            <h5>
                <p>
                   In questa sezione sono visualizzate tutte le autovetture attualmente
                   da te messe in vendita, con relative caratteristiche. 
                </p>
            </h5>
            
        <?php
        break;
    
    case 'StoricoVendite':
         ?>

            <h5>
                <p>
                   In questa sezione puoi visualizzare tutte vetture da te 
                   vendute dal momento della registrazione ad oggi, con i nomi 
                   dei relativi acquirenti.
                </p>
            </h5>
            
        <?php
        break;
    
    case 'HomeCommerciante':
         ?>

            <h5>
                <p>
                    Benvenuto nella sezione venditore. Clicca su una delle 
                   sezioni per iniziare la tua attività all'interno del sito.
                </p>
            </h5>
            
        <?php
        break;
    
    default :
        ?>

            <h5>
                <p>
                    Benvenuto nella sezione venditore. Clicca su una delle 
                   sezioni per iniziare la tua attività all'interno del sito.
                </p>
            </h5>
            
        <?php
        break;
}
?>

