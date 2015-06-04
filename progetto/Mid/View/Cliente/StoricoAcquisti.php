<ul class="icona_titolo">
    <li id="i_conto">&nbsp;</li>
    <li> Cronologia&nbsp;Acquisti </li>
</ul>
<br/>
<br/>

<?php 
$automobili = AutoFactory::autoCronologia($user->getId()); 
if( count($automobili) == 0) { ?>
    <p>Nessun auto acquistata</p>
<?php } else { ?>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Modello</th>
                <th>Produttore</th>
                <th>Accessori</th>
                <th>Colore</th>
                <th>Alimentazione</th>
                <th>Emissioni</th>
                <th>Anno</th>
                <th>Prezzo</th>
                <th>Descrizione</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($automobili as $automobile) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="evenRow"' : '' ?>>
                    <!--invoca il metodo per la restituzione del cognome del venditore-->
                    <td> <?= $automobile->getId()  ?> </td>
                    <!--invoca il metodo per la restituzione del nome del venditore-->
                    <td> <?= $automobile->getModello() ?> </td>
                    <!--invoca il metodo per la restituzione del nome dell'azienda-->
                    <td> <?= $automobile->getProduttore() ?> </td>
                    <!--invoca il metodo per la restituzione dell'indirizzo email del commerciante -->
                    <td> <?= $automobile->getAccessori() ?> </td>
                    <!--invoca il metodo per per la restituzione della descrizione dell'azienda-->
                    <td> <?= $automobile->getColore() ?> </td>
                    <!--invoca il metodo per per la restituzione della descrizione dell'azienda-->
                    <td> <?= $automobile->getAlimentazione() ?> </td>
                    <!--invoca il metodo per per la restituzione della descrizione dell'azienda-->
                    <td> <?= $automobile->getEmissioni() ?> </td>
                    <!--invoca il metodo per per la restituzione della descrizione dell'azienda-->
                    <td> <?= $automobile->getAnno() ?> </td>
                    <!--invoca il metodo per per la restituzione della descrizione dell'azienda-->
                    <td> <?= $automobile->getPrezzo() ?> </td>
                    <!--invoca il metodo per per la restituzione della descrizione dell'azienda-->
                    <td> <?= $automobile->getDescrizione() ?> </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } ?>