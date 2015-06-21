<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>AutoShop</title>
    </head>
    <body>
        <h1>Accesso all'applicazione del progetto</h1>
        <p>
            <a>
                E' possibile accedere al progetto tramite diversi ruoli: commerciante, cliente o gestore. <br>
                I diversi ruoli offrono diverse funzionalità. 
            </a>
        </p>
        
        <h2> Descrizione dell'applicazione </h2>
        <p>
            La funzionalità di base prevede che un commerciante possa inserire i dati 
            relativi all’auto che intende vendere sul sito.
        </p>
        <p>
            Ogni cliente registrato al sito può visualizzare i dati realitivi alle auto in vendita,
            ed effetuare ricerche in base alle caratteristiche di suo interesse. 
        </p>
        <p>
            Nel momento della registrazione dev'essere specificato un ruolo che non può
            essere più modificato: Cliente o Commerciante 
        </p>
        <p>  
            I dati che figurano per ogni statino sono i seguenti:
        </p>
        <ul>
            <li>Nome, cognome e informazioni del cliente</li>
            <li>Nome, cognome e informazioni del commerciante</li>
            <li>Tutti i dati relativi alle auto in vendita</li>
            <li>Una cronologia dello storico acquisti/vendite</li>
            <li>Un carrello nella quale il cliente pu&oacute; aggiungere le auto</li>
            <li>Una sezione nella quale il commerciante pu&oacute; tenere sotto controllo le auto in vendita</li>
            <li>Una sezione nella quale il cliente pu&oacute; ricaricare il proprio conto</li>
        </ul>
            
          <p>Inoltre, ogni utente &egrave; in grado di visualizzare 
            il suo profilo e modificarlo.
           In ogni profilo è possibile visualizzare/modificare:
        </p>
        <ul>
            <li>Nome</li>
            <li>Cognome</li>
            <li>Telefono</li>
            <li>Email</li>
            <li>Citt&aacute;</li>
            <li>Via</li>
            <li>Cap</li>
            <li>Provincia</li>
            <li>Numero Civico</li>
            <li>Username</li>
            <li>Password</li>
        </ul>
            
        <p>Il commerciante in pi&uacute; ha il nome dell'azienda e la descrizione (opzionali)</p>
        
        <h2>Accesso al progetto</h2>

        <h3>Versione statica con soli HTML e CSS</h3>
        <h5>
        <a href="HTML/Commerciante/HomeCommerciante.html">Ruolo commerciante</a><br>
        <a href="HTML/Cliente/HomeCliente.html">Ruolo cliente</a><br>
        <a href="HTML/Gestore/HomeGestore.html">Ruolo gestore</a><br>
        </h5>
    
        <h3>Versione dinamica con PHP</h3>
    <p>
        La homepage del progetto si trova sulla URL <a href="Mid/Index.php?page=Login">Login</a>
    </p>
    <p> 
        Sono state implementate le funzioni di Login per gli utenti sottodescritti, ogni cliente pu&oacute;
        visualizzare le auto in vendita e aggiungerle o rimuoverle dal carrello. <br>
        I venditori possono aggiungere auto (fino un massimo di tre), rimuovere le auto in vendita o
        visualizzare quelle vendute. <br>
        In fine ogni utene pu&oacute; modificare i propri dati personali. <br>
        Tutti i dati e le modifiche sono salvate nel database. 
    </p>
  
    <p>Si pu&ograve; accedere alla applicazione con le seguenti credenziali</p>
    <ul>
        <li>Ruolo cliente:</li>
        <ul>
            <li>username: clien1 ; password: pass</li>
            <li>username: clien2 ; password: pass</li>
            <li>username: clien3 ; password: pass</li>
        </ul><br>
        <li>Ruolo commercinate:</li>
        <ul>
            <li>username: comme1 ; password: pass</li>
            <li>username: comme2 ; password: pass</li>
            <li>username: comme3 ; password: pass</li>
        </ul><br>
        <li>Ruolo gestore:</li>
        <ul>
            <li>username: gestore</li>
            <li>password: gestore</li>
        </ul>
    </ul>
    
</body>
</html>
