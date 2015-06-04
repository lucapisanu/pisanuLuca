<ul class="icona_titolo">
    <li id="i_aggiungi">&nbsp;</li>
    <li> Vendi&nbsp;Auto </li>
</ul>
<br/>
<br>

<form  method="post" action="Index.php?page=Commerciante&subpage=VendiProdotto<?= $vd->scriviToken('&')?>">        

    <input type="hidden" name="command" value="RegistraAuto"/>   
    
    <label for="Produttore">Produttore</label>
    <select name="Produttore"> <!-- menù a tendina dei produttori-->
            <option value="">--Seleziona</option><!-- vuoto per non avere una selezione già preimpostata -->
            <option value="Abarth"> Abarth </option>
            <option value="Alfa Romeo"> Alfa Romeo </option>
            <option value="Aston Martin"> Aston Martin </option>
            <option value="Audi"> Audi </option>
            <option value="Bentley"> Bentley </option>
            <option value="BMW"> BMW </option>
            <option value="Cadillac"> Cadillac </option>
            <option value="Citroen"> Citroen </option>
            <option value="Corvette"> Corvette </option>
            <option value="Dacia"> Dacia </option>
            <option value="Daihatsu"> Daihatsu </option>
            <option value="Ferrari"> Ferrari </option>
            <option value="Fiat"> Fiat </option>
            <option value="Ford"> Ford </option>
            <option value="Honda"> Honda </option>
            <option value="Hyundai"> Hyundai </option>
            <option value="Jaguar"> Jaguar </option>
            <option value="Jeep"> Jeep </option>
            <option value="Kia"> Kia </option>
            <option value="Lamborghini"> Lamborghini </option>
            <option value="Lancia"> Lancia </option>
            <option value="Land Rover"> Land Rover </option>
            <option value="Lexus"> Lexus </option>
            <option value="Lotus"> Lotus </option>
            <option value="Maserati"> Maserati </option>
            <option value="Mazda"> Mazda </option>
            <option value="McLaren"> McLaren </option>
            <option value="Mercedes"> Mercedes </option>
            <option value="Mini"> Mini </option>
            <option value="Mitsubishi"> Mitsubishi </option>
            <option value="Mustang"> Mustang </option>
            <option value="Nissan"> Nissan </option>
            <option value="Opel"> Opel </option>
            <option value="Peugeot"> Peugeot </option>
            <option value="Porsche"> Porsche </option>
            <option value="Renault"> Renault </option>
            <option value="Rolls Royce"> Rolls Royce </option>
            <option value="Seat"> Seat </option>
            <option value="Skoda"> Skoda </option>
            <option value="Smart"> Smart </option>
            <option value="Subaru"> Subaru </option>
            <option value="Suzuki"> Suzuki </option>
            <option value="Toyota"> Toyota </option>
            <option value="Volkswagen"> Volkswagen </option>
            <option value="Volvo"> Volvo </option>
    </select>
    
    <br><br>
    
    <label for="Modello">Nome modello</label>
    <input type="text" name="Modello" id="Modello"/><!-- casella di inserimento testo -->
    
    <br><br>
    
    <label for="Accessori">Accessori</label><br>
            <input type="checkbox" name="Accessori[]" value="Climatizzatore"> Climatizzatore <br>
            <input type="checkbox" name="Accessori[]" value="Autoradio"> Autoradio <br>
            <input type="checkbox" name="Accessori[]" value="Cerchi in lega"> Cerchi in lega <br>
            <input type="checkbox" name="Accessori[]" value="ESP"> ESP <br>
            <input type="checkbox" name="Accessori[]" value="Vetri Oscurati"> Vetri Oscurati <br>
            <input type="checkbox" name="Accessori[]" value="Navigatore"> Navigatore <br>
            <input type="checkbox" name="Accessori[]" value="Park Assist"> Park Assist <br>
            <input type="checkbox" name="Accessori[]" value="Poggiatesta Posteriori"> Poggiatesta Posteriori<br>
     
    <br><br>
    
    <label for="Colore1">Colore</label>
    <select name="Colore1">
        <option value="">--Seleziona</option>
                <option value="Arancio"> Arancione </option>
                <option value="Argento"> Argento </option>
                <option value="Beige"> Beige </option>
                <option value="Blu"> Blu </option>
                <option value="Giallo"> Giallo </option>
                <option value="Grigio"> Grigio </option>
                <option value="Marrone"> Marrone </option>
                <option value="Nero"> Nero </option>
                <option value="Oro"> Oro </option>
                <option value="Rosso"> Rosso </option>
                <option value="Verde"> Verde </option>
                <option value="Viola"> Viola </option>
    </select>
       
    <br><br>
    
    <label for="Colore2">Vernice</label>
    <select name="Colore2">
        <option value="">--Seleziona</option>
            <option value="Metallizato">Metallizzato <br>
            <option value="Opaco"> Opaco <br>
    </select>
    
    <br><br>
    
    <label for="Alimentazione">Alimentazione</label>
    <select name="Alimentazione">
        <option value="">--Seleziona</option>
            <option value="Benzina"> Benzina 
            <option value="Benzina+Metano"> Benzina+Metano 
            <option value="Diesel"> Diesel 
            <option value="Ibrida"> Ibrida 
    </select>
    
    <br><br>
            
    <label for="Emissioni">Classe emissioni</label>
    <select name="Emissioni">
        <option value="">--Seleziona</option>
            <option value="Euro1"> Euro1 
            <option value="Euro2"> Euro2 
            <option value="Euro3"> Euro3
            <option value="Euro4"> Euro4 
            <option value="Euro5"> Euro5 
            <option value="Euro6"> Euro6         
    </select>
      
     <br><br> 
     
     <label for="Anno">Anno di Produzione</label>
            <input type="text" name="Anno" id="AnnoProduzione" /><!-- casella di inserimento testo -->
     
     <br><br>
            
     <label for="Prezzo">Prezzo</label>
            <input type="text" name="Prezzo" id="Prezzo"/><!-- casella di inserimento testo -->

            <br><br>     
            
            <label for="Descrizione">Descrizione articolo</label>
            <textarea rows="3" cols="52" name="Descrizione" id="Descrizione"></textarea>

            
     <br><br><br>
     
         <input type="submit" value="Aggiungi" align="center"><!-- pulsante di aggiunta vettura all'elenco -->
         
    </form>
