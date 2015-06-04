<ul class="icona_titolo">
    <li id="i_conto">&nbsp;</li>
    <li> Storico&nbsp;Acquisti </li>
</ul>
<br/>

<?php 
if ((AcquistiFactory::instance()->autoPerUtente($user->getId(), $user->getRuolo()) )  == 0 ){ ?>
    <p>Non hai comprato nessuna auto</p>
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
                <th>Data vendita</th>
                <th>Id commerciante</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $acquisti = AcquistiFactory::instance()->caricaAcquisti($user->getId(), $user->getRuolo()); 
            
            foreach ($acquisti as $acquisto) {
                $a = AutoFactory::instance()->caricaAuto($acquisto->getIdAuto());  
                
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
                    <td> <?= $acquisto->getData() ?> </td>
                    <td> <?= $acquisto->getIdCommerciante() ?> </td>
                    
                </tr>
                <?php                 
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } ?>