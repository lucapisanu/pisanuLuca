<ul class="icona_titolo">
    <li id="i_profilo">&nbsp;</li>
    <li> Profilo </li>
</ul>
<br/>
<br/>


    <b>Nome:</b> <?= $user->getNome()?> <br>
    <b>Cognome:</b> <?=  $user->getCognome() ?> <br>
    <b>Telefono:</b> <?=  $user->getTelefono() ?> <br>
    <b>Email:</b> <?=  $user->getEmail() ?> <br>
    <b>Città:</b> <?= $user->getCitta() ?> <br>
    <b>Via:</b> <?=  $user->getVia() ?> <br>
    <b>Cap:</b> <?=  $user->getCap() ?> <br>
    <b>Provincia:</b> <?=  $user->getProvincia() ?> <br>
    <b>Numero civico:</b> <?=  $user->getNumeroCivico() ?> <br>
    <b>Username:</b> <?=  $user->getUsername() ?> <br>
    <b>Password:</b> <?=  $user->getPassword() ?> <br>

       
<h5 id="datiPersonaliModifica">Modifica Dati personali</h5>


<h5>
    <form  method="post" action="Index.php?page=Cliente&subpage=DatiPersonaliCompratore<?= $vd->scriviToken('&')?>">
        
        <input type="hidden" name="command" value="DatiPersonali"/>
        <label for="Nome">Nome</label>
        <input type="text" name="Nome" id="NomeUtente" value="<?= $user->getNome() ?>"/>
        <br/>
        <label for="Cognome">Cognome</label>
        <input type="text" name="Cognome" id="CognomeUtente" value="<?= $user->getCognome() ?>"/>
        <br/>
        <label for="Azienda">Telefono</label>
        <input type="text" name="Telefono" id="TelefonoUtente" value="<?= $user->getTelefono() ?>"/>
        <br/>
        <label for="Indirizzo">Email</label>
        <input type="text" name="Email" id="EmailUtente" value="<?= $user->getEmail() ?>"/>
        <br/>
        <label for="Indirizzo">Citta</label>
        <input type="text" name="Citta" id="Citta" value="<?= $user->getCitta() ?>"/>
        <br/>
        <label for="Azienda">Via</label>
        <input type="text" name="Via" id="ViaUtente" value="<?= $user->getVia() ?>"/>
        <br/>
        <label for="Indirizzo">Cap</label>
        <input type="text" name="Cap" id="CapUtente" value="<?= $user->getCap() ?>"/>
        <br/>
        <label for="Azienda">Provincia</label>
        <input type="text" name="Provincia" id="ProvinciaUtente" value="<?= $user->getProvincia() ?>"/>
        <br/>
        <label for="Indirizzo">Numero civico</label>
        <input type="text" name="NumeroCivico" id="NumeroCivicoUtente" value="<?= $user->getNumeroCivico() ?>"/>
        <br/>
        <label for="Azienda">Username</label>
        <input type="text" name="Username" id="UsernameUtente" value="<?= $user->getUsername() ?>"/>
        <br/>
        <label for="Indirizzo">Password</label>
        <input type="text" name="Password" id="PasswordUtente" value="<?= $user->getPassword() ?>"/>
        <br/>

        <input type="submit" value="Modifica"/><!-- pulsante di attivazione delle modifiche -->
     <br>
    </form>
   

</h5>       