<ul class="icona_titolo">
    <li id="i_auto">&nbsp;</li>
    <li> Auto&nbsp;in&nbsp;vendita </li>
</ul>
<br/>

<?php 
if (InvenditaFactory::instance()->autoPerCommerciante($user->getId()) == 0 ){ ?>
    <p>Non hai nessuna auto in vendita</p>
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
                <th>Elimina Auto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $invendita = InvenditaFactory::instance()->caricaInvendita($user->getId()); 
            
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
                        <a href="Index.php?page=Commerciante&subpage=ProdottiInVendita2&command=EliminaAuto&id_auto=<?=  $a->getId()?>">
                            <img  src="../Images/elimina.png" alt="Elimina" >
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