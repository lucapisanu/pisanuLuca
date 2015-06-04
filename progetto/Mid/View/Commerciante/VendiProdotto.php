<ul class="icona_titolo">
    <li id="i_aggiungi">&nbsp;</li>
    <li> Vendi&nbsp;Automobile </li>
</ul>
<br/>
<br/>

<h5>
        <form  method="post" action="Index.php?page=Commerciante&subpage=VendiProdotto<?= $vd->scriviToken('&')?>">        
        <input type="hidden" name="command" value="RegistraAuto"/>
        <label for="Produttore">Produttore</label>
        <select name="Produttore"> <!-- menù a tendina dei produttori-->
            <option>   </option><!-- vuoto per non avere una selezione già preimpostata -->
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
        
        <label for="Modello">Nome modello</label>
        <input type="text" name="Modello" id="Modello"/><!-- casella di inserimento testo -->
        
       <label for="Accessori">Accessori</label>
            <input type="checkbox" name="Accessori[]" value="Climatizzatore"> Climatizzatore <br>
            <input type="checkbox" name="Accessori[]" value="Autoradio"> Autoradio <br>
            <input type="checkbox" name="Accessori[]" value="Cerchi in lega"> Cerchi in lega <br>
            <input type="checkbox" name="Accessori[]" value="ESP"> ESP <br>
            <input type="checkbox" name="Accessori[]" value="Vetri Oscurati"> Vetri Oscurati <br>
            <input type="checkbox" name="Accessori[]" value="Navigatore"> Navigatore <br>
            <input type="checkbox" name="Accessori[]" value="Park Assist"> Park Assist <br>
            <input type="checkbox" name="Accessori[]" value="Poggiatesta Posteriori"> Poggiatesta Posteriori<br>

        <label for="Colori">Colori auto</label>
            <select name="Colori1">Primo Colore<!-- tendina per la scelta del primo colore -->
                <option>   </option><!-- vuoto per non avere una selezione già preimpostata -->
                <option value="Beige"> Beige </option>
                <option value="Nero"> Nero </option>
                <option value="Blu"> Blu </option>
                <option value="Marrone"> Marrone </option>
                <option value="Oro"> Oro </option>
                <option value="Verde"> Verde </option>
                <option value="Grigio"> Grigio </option>
                <option value="Arancio"> Arancio </option>
                <option value="Rosso"> Rosso </option>
                <option value="Argento"> Argento </option>
                <option value="Viola"> Viola </option>
                <option value="Giallo"> Giallo </option>
            </select>

            <select name="Colori2">Secondo Colore<!-- tendina per la scelta del secondo colore -->
                <option>   </option><!-- vuoto per non avere una selezione già preimpostata -->
                <option value="Beige"> Beige </option>
                <option value="Nero"> Nero </option>
                <option value="Blu"> Blu </option>
                <option value="Marrone"> Marrone </option>
                <option value="Oro"> Oro </option>
                <option value="Verde"> Verde </option>
                <option value="Grigio"> Grigio </option>
                <option value="Arancio"> Arancio </option>
                <option value="Rosso"> Rosso </option>
                <option value="Argento"> Argento </option>
                <option value="Viola"> Viola </option>
                <option value="Giallo"> Giallo </option>
            </select>
        
            <!-- opzione tipo vernice -->
            <br> <input type="radio" name="Colori3" value="Metallizato">Metallizzato <br>
            <input type="radio" name="Colori3" value="Opaco"> Opaco <br>
      

     
    
        <label for="Alimentazione">Alimentazione</label>
            <input type="radio" name="Alimentazione" value="Benzina"> Benzina <br>
            <input type="radio" name="Alimentazione" value="Diesel"> Diesel <br>
            <input type="radio" name="Alimentazione" value="Benzina+Metano"> Benzina+Metano <br>
            <input type="radio" name="Alimentazione" value="Ibrida"> Ibrida <br>
            
        
        <label for="Emissioni">Classe emissioni</label>
            <input type="radio" name="Emissioni" value="Euro4"> Euro4 <br>
            <input type="radio" name="Emissioni" value="Euro5"> Euro5 <br>
            <input type="radio" name="Emissioni" value="Euro6"> Euro6 <br>
            
        <label for="Produzione">Anno di Produzione</label>
            <input type="text" name="Anno" id="AnnoProduzione" /><!-- casella di inserimento testo -->

        <label for="Prezzo">Prezzo</label>
            <input type="text" name="Prezzo" id="Prezzo"/><!-- casella di inserimento testo -->
            
         <label for="Copie">Numero articoli</label>
            <input type="text" name="Copie" id="Copie"/><!-- casella di inserimento testo -->
            
         <label for="DescrizioneArticolo">Descrizione articolo</label>
            <textarea rows="5" cols="52" name="DescrizioneArticolo" id="Descrizione"></textarea>
         
         <input type="submit" value="Aggiungi"><!-- pulsante di aggiunta vettura all'elenco -->

    
    </form>
</h5>
