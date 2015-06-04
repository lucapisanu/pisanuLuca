<ul class="icona_titolo">
    <li id="i_cerca">&nbsp;</li>
    <li> Cerca&nbsp;Auto </li>
</ul>
<br>
<br>

<h4>Ricerca Semplice</h4><!-- sezione ricerca per nome -->

<h5>
    <form action="demo_form.asp" method="get">
            <label for="Modello">Nome modello</label>
            <input type="text" name="Modello" id="Modello" /><!-- casella per l'inserimento del testo -->
    </form>
    <input type="submit" id="ricercaSemplice" value="Cerca"><!--pulsante di ricerca -->
</h5>
<h4>Ricerca Avanzata</h4><!-- sezione ricerca per caratteristiche -->
<h5>

    <div id="column1"> <!-- prima colonna di opzioni selezionabili -->

        <label for="Produttore">Produttore</label>
        <select name="Produttore"> <!-- menù a tendina dei produttori-->
            <option value="nothing">   </option><!-- vuoto per non avere una selezione già preimpostata -->
            <option value="Abarth"> Abarth </option>
            <option value="Alfa Romeo"> Afa Romeo </option>
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



        <form action="demo_form.asp" method="get">
            <label for="Modello">Nome modello</label>
            <input type="text" name="Modello" id="Modello" /><!-- casella di inserimento testo -->
        </form>

       <label for="Accessori">Accessori</label>
        <div class="options"> <!-- classe per i blocchi di pulsanti selezionabili -->
            <input type="checkbox" name="Accessories" value="airConditioning"> Climatizzatore <br>
            <input type="checkbox" name="Accessories" value="carRadio"> Autoradio <br>
            <input type="checkbox" name="Accessories" value="alloyWheels"> Cerchi in lega <br>
            <input type="checkbox" name="Accessories" value="ESP"> ESP <br>
            <input type="checkbox" name="Accessories" value="tintedGlasses"> Vetri Oscurati <br>
            <input type="checkbox" name="Accessories" value="Navigator"> Navigatore <br>
            <input type="checkbox" name="Accessories" value="ParkAssist"> Park Assist <br>
            <input type="checkbox" name="Accessories" value="headrest"> Poggiatesta Posteriori<br>
        </div>

        <label for="Colori">Colori auto</label>
        <div class="options"><!-- classe per i blocchi di pulsanti selezionabili -->
            <select name="Color1">Primo Colore<!-- tendina per la scelta del primo colore -->
                <option value="nothing">   </option><!-- vuoto per non avere una selezione già preimpostata -->
                <option value="beige"> Beige </option>
                <option value="black"> Nero </option>
                <option value="blue"> Blu </option>
                <option value="brown"> Marrone </option>
                <option value="gold"> Oro </option>
                <option value="green"> Verde </option>
                <option value="grey"> Grigio </option>
                <option value="orange"> Arancio </option>
                <option value="red"> Rosso </option>
                <option value="silver"> Argento </option>
                <option value="purple"> Viola </option>
                <option value="white"> Giallo </option>
            </select>
            <select name="Color2">Secondo Colore<!-- tendina per la scelta del secondo colore -->
                <option value="nothing">   </option><!-- vuoto per non avere una selezione già preimpostata -->
                <option value="beige"> Beige </option>
                <option value="black"> Nero </option>
                <option value="blue"> Blu </option>
                <option value="brown"> Marrone </option>
                <option value="gold"> Oro </option>
                <option value="green"> Verde </option>
                <option value="grey"> Grigio </option>
                <option value="orange"> Arancio </option>
                <option value="red"> Rosso </option>
                <option value="silver"> Argento </option>
                <option value="purple"> Viola </option>
                <option value="white"> Giallo </option>
            </select>

            <!-- opzione tipo vernice -->
            <br> <input type="radio" name="paintType" value="metallized">Metallizzato <br>
            <input type="radio" name="paintType" value="opaque"> Opaco <br>
        </div>

    </div>  
    <div id="column2"><!-- seconda colonna di opzioni selezionabili -->    
        <label for="Alimentazione">Alimentazione</label>
        <div class="options"><!-- classe per i blocchi di pulsanti selezionabili -->
            <input type="radio" name="supplyType" value="petrol"> Benzina <br>
            <input type="radio" name="supplyType" value="diesel"> Diesel <br>
            <input type="radio" name="supplyType" value="petrol+methane"> Benzina+Metano <br>
            <input type="radio" name="supplyType" value="hybrid"> Ibrida <br>
        </div>


        <label for="Emissioni">Classe emissioni</label>
        <div class="options"><!-- classe per i blocchi di pulsanti selezionabili -->
            <input type="radio" name="emissionsClass" value="Euro4"> Euro4 <br>
            <input type="radio" name="emissionsClass" value="Euro5"> Euro5 <br>
            <input type="radio" name="emissionsClass" value="Euro6"> Euro6 <br>
        </div>


        <form action="demo_form.asp" method="get">
            <label for="Produzione">Anno di Produzione</label>
            <input type="text" name="productionYear" id="AnnoProduzione" /><!-- casella di inserimento testo -->
        </form>

        <form action="demo_form.asp" method="get">
            <label for="Prezzo">Prezzo</label>
            <input type="text" name="price" id="price" /><!-- casella di inserimento testo -->
        </form>

         <input type="submit" id="ricercaAvanzata" value="Cerca"><!--pulsante di ricerca -->

        <?php  if(isset($risulatatoRicerca)){    

                //se trova qualcosa va allo step successivo
        }
        else { 

            echo 'Nessun risultato trovato!';
        }
        ?>




    </div></h5>

