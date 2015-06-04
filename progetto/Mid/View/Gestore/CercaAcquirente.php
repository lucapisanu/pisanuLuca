<ul class="icona_titolo">
    <li id="i_profilo">&nbsp;</li>
    <li> Cerca&nbsp;Acquirente </li>
</ul>
<br/>
<br/>

<form action="demo_form.asp" method="get">
     <label for="corto">Nome</label>
     <input type="text" name="sellerName" id="sellerName"/><!-- casella di inserimento del testo -->
     <br>
     <label for="corto">Cognome</label>
     <input type="text" name="sellerSurname" id="sellerSurname"/>
     <br>
     
     <input type="submit" value="Cerca"><!-- pulsante di attivazione della ricerca -->
 
     <br>
     
</form>
<br><br>

<h4 id="venditoriLista">Lista Acquirenti</h4>

<?php 
$clienti = UserFactory::getListaClienti(); 
if( count($clienti) == 0) { ?>
    <p>Nessun cliente trovato</p>
<?php } else { ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($clienti as $cliente) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="evenRow"' : '' ?>>
                    <!--invoca il metodo per la restituzione del nome del venditore-->
                    <td> <?= $cliente->getNome()  ?> </td>
                    <!--invoca il metodo per la restituzione del cognome del venditore-->
                    <td> <?= $cliente->getCognome() ?> </td>
                    <!--invoca il metodo per la restituzione dell'indirizzo email del commerciante -->
                    <td> <?= $cliente->getEmail() ?> </td>
                    <!--invoca il metodo per per la restituzione del numero di telefono dell'azienda-->
                    <td> <?= $cliente->getTelefono() ?> </td>
                </tr>
                <?php                 
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } ?>