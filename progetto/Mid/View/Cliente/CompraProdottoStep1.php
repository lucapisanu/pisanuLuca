<ul class="icona_titolo">
    <li id="i_cerca">&nbsp;</li>
    <li> Cerca&nbsp;Auto </li>
</ul>
<br><br>

<h4>Ricerca Auto</h4>

<form  method="post" action="" <!--"Index.php?page=Cliente&subpage=CompraProdottoStep1<?= $vd->scriviToken('&')?>"--> >        
    <input type="hidden" name="command" value="ricercaAuto"/>   
    
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
     
     <label for="Anno">Anno di Produzione maggiore di</label>
            <input type="text" name="Anno" id="AnnoProduzione" /><!-- casella di inserimento testo -->
     
     <br><br>
            
     <label for="Prezzo">Prezzo minore di</label>
            <input type="text" name="Prezzo" id="Prezzo"/><!-- casella di inserimento testo -->

     <br><br> 
     
     <button name="command" type="submit" id="ricercaAuto" value="">Cerca</button>
</form>

<br><br>
     

<h4>Lista&nbsp;auto</h4>
<?php 
$invendita = InvenditaFactory::instance()->caricaIdAuto();
if ($invendita == 0 ){ ?>
    <p>Non ci sono auto in vendita</p>
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
                <th>Data registrazione</th>
                <th>Aggiungi al carrello</th>
                <th>Compra auto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            
            foreach ($invendita as $in) {
                $a = AutoFactory::instance()->caricaAuto($in->getIdAuto());  
                
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
                    
                    <td> <?= $in->getData() ?> </td>
                    
                    <td>
                        <a href="Index.php?page=Cliente&subpage=CompraProdottoStep1&command=aggiungiCarrello&id_auto=<?=  $a->getId()?>">
                            <img height="18px" width="18px" src="../Images/cart.png" alt="aggiungi" >
                        </a>           
                    </td>
                    <td>
                        <a href="Index.php?page=Cliente&subpage=CompraProdottoStep1&command=compra&id_auto=<?=  $a->getId()?>">
                            <img height="18px" width="18px" src="../Images/aggiungi.png" alt="" >
                        </a>           
                    </td>
       
                </tr>
                <?php                 
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } ?>



