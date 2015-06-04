<h2>   Benvenuto su Autoshop </h2>
  <p> Questo è un sito che si occupa della compravendita di automobili, perciò se 
      sei interessato a vendere o acquistare un auto non devi far altro che iscriverti.
      Cogli la tua occasione grazie a tante offerte. 
  </p>
<br>
<br>

<h4>Inserisci i tuoi dati. </h4>

<form  method="post" action="Index.php?page=Login&subpage=Registrazione">
    <input type="hidden" name="command" value="Registrazione"/>
    
    <label for="Ruolo">Ruolo utente</label>
    <select name="Ruolo">
        <option value="">--Seleziona</option>
            <option value="Commerciante">Commerciante <br>
            <option value="Cliente"> Cliente <br>
    </select>

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
      
    <?php if ($request['Ruolo'] == 'Commerciante'){ ?>
    
    <label for="Azienda">Nome Azienda</label>
    <input type="text" name="NomeAzienda" id="NomeAzienda" value="<?= $user->getNomeAzienda() ?>"/>  
    <br/>
    
    <?php } ?>
    
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

    <?php if ($request['Ruolo'] == 'Commerciante'){ ?>
    
    <label for="DescrizioneAzienda">Descrizione Azienda</label>
    <textarea rows="5" cols="52" name="DescrizioneAzienda" id="DescrizioneAzienda"><?= $user->getDescrizioneAzienda() ?></textarea>
    <br/>
    <?php } ?>
    
    <label for="Username">Username</label>
    <input type="text" name="Username" id="UsernameUtente" value="<?= $user->getUsername() ?>"/>
    <br/>
    
    
    <label for="Indirizzo">Password</label>
    <input type="text" name="Password" id="PasswordUtente" value="<?= $user->getPassword() ?>"/>
    <br/>

    <input type="submit" value="Modifica"/><!-- pulsante di attivazione delle modifiche -->
    <br>

</form>
      