<ul class="icona_titolo">
    <li id="i_cerca">&nbsp;</li>
    <li> Compra&nbsp;Auto </li>
</ul>

<br><br>

<h4>Lista&nbsp;auto</h4>
<?php 
$invendita = InvenditaFactory::instance()->caricaIdAuto();
if ($invendita == 0 ){ ?>
    <p>Non ci sono auto in vendita</p>
<?php } else { ?>
    <table>
        <thead>
            <tr>
                <th>Produttore</th>
                <th>Nome modello</th>
                <th>Accessori</th>
                <th>Colori</th>
                <th>Alimentazione</th>
                <th>Classe emissioni</th>
                <th>Anno produzione</th>
                <th>Prezzo</th>
                <th>Descrizione</th>
                <th>Data registrazione</th>
                <th>Aggiungi al carrello</th>
                <th>Compra auto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            
            foreach ($invendita as $in) {
                $a = AutoFactory::instance()->caricaAuto($in->getIdAuto());  
                
                ?>
                <tr <?= $i % 2 == 0 ? 'class="evenRow"' : '' ?>>
                  
                    <td> <?= $a->getProduttore()  ?> </td>
                  
                    <td> <?= $a->getModello() ?> </td>
                   
                    <td> <?= $a->getAccessori() ?> </td>
               
                    <td> <?= $a->getColore() ?> </td>
                    
                    <td> <?= $a->getAlimentazione() ?> </td>
                    
                    <td> <?= $a->getEmissioni() ?> </td>
                    
                    <td> <?= $a->getAnno() ?> </td>
                    
                    <td> <?= $a->getPrezzo() ?> </td>
                    
                    <td> <?= $a->getDescrizione() ?> </td>
                    
                    <td> <?= $in->getData() ?> </td>
                    
                    <td>
                        <a href="Index.php?page=Cliente&subpage=CompraProdottoStep1&command=aggiungiCarrello&id_auto=<?=  $a->getId()?>">
                            <img height="18px" width="18px" src="../Images/cart.png" alt="aggiungi" >
                        </a>           
                    </td>
                    <td>
                        <a href="Index.php?page=Cliente&subpage=CompraProdottoStep1&command=compra&id_auto=<?=  $a->getId()?>">
                            <img height="18px" width="18px" src="../Images/aggiungi.png" alt="compra" >
                        </a>           
                    </td>
       
                </tr>
                <?php                 
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } ?>



