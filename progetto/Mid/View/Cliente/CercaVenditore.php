<ul class="icona_titolo">
    <li id="i_cerca-vend">&nbsp;</li>
    <li> Cerca&nbsp;Venditore </li>
</ul>
<br/>
<br/>

<form action="demo_form.asp" method="get">
     <label for="corto">Nome e cognome</label>
     <input type="text" name="buyerName" id="buyerName"/><!-- casella di inserimento del testo -->
     <input type="submit" value="Cerca"><!-- pulsante di attivazione della ricerca -->
     <br>
     
</form>
<br><br>

<h4 id="venditoriLista">Lista commercianti</h4>

<?php 
$commercianti = UserFactory::getListaCommercianti(); 
if( count($commercianti) == 0) { ?>
    <p>Nessun commerciante trovato</p>
<?php } else { ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Azienda</th>
                <th>Email</th>
                <th>Descrizione</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($commercianti as $commerciante) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="evenRow"' : '' ?>>
                    <!--invoca il metodo per la restituzione del cognome del venditore-->
                    <td> <?= $commerciante->getNome()  ?> </td>
                    <!--invoca il metodo per la restituzione del nome del venditore-->
                    <td> <?= $commerciante->getCognome() ?> </td>
                    <!--invoca il metodo per la restituzione del nome dell'azienda-->
                    <td> <?= $commerciante->getNomeAzienda() ?> </td>
                    <!--invoca il metodo per la restituzione dell'indirizzo email del commerciante -->
                    <td> <?= $commerciante->getEmail() ?> </td>
                    <!--invoca il metodo per per la restituzione della descrizione dell'azienda-->
                    <td> <?= $commerciante->getDescrizioneAzienda() ?> </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } ?>