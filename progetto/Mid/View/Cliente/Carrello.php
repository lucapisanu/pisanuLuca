<ul class="icona_titolo">
    <li id="i_carrello">&nbsp;</li>
    <li> Carrello </li>
</ul>
<br>
<br>
<h5>
             <?php
             /*setta il contatore delle righe della tabella in base alle vetture presenti nell'array
              *(se di uno stesso prodotto ci sono due copie lo conterà solo una volta)*/
             $i = count($user->getCarrello());
         
             //se non ci sono auto nella lista
             if($i==0){
                 
                 echo "Non hai ancora auto nel carrello";
             }
             else{
                 
                ?>
                 <table><!-- tabella riempita con tutte le vetture in vendita -->
                    <tr><!-- riga principale contenente tutti gli attributi -->
                        <th>Produttore</th>
                        <th>Nome modello</th>
                        <th>Accessori</th>
                        <th>Colori</th>
                        <th>Alimentazione</th>
                        <th>Classe emissioni</th>
                        <th>Anno produzione</th>
                        <th>Prezzo</th>
                        <th>Data acquisto</th>
                        <th>Descrizione</th>
                        <th>Esemplari</th>
                        <th>Elimina</th>
                        <th>Compra</th>
                    </tr>
                 <?php 
                //fino a quando ci sono vetture da stampare
                while ($i>0){

                    //se la riga è pari
                    if($i%2==0){

                        ?><tr class="evenRow"><!-- id per righe pari --><?php       
                    }
                    else{

                        ?><tr><?php       

                    }
                ?>  
                    <!--invoca il metodo per la restituzione del produttore dalla lista delle auto del commerciante in questione-->
                    <td> <?= $user->getCarrello()[$i-1]->getProduttore()  ?> </td>
                    <!--invoca il metodo per la restituzione del modello dalla lista delle auto del commerciante in questione-->
                    <td> <?= $user->getCarrello()[$i-1]->getModello() ?> </td>
                    <!--invoca il metodo per la restituzione degli accessori dalla lista delle auto del commerciante in questione-->
                    <td> 
                        <?php
                            $j = count($user->getCarrello()[$i-1]->getAccessori()); // imposta un contatore per il numero di accessori registrati
                            $k = 0;//inizializza il contatore di stampa a zero
                            while ($k < $j){ //fino a quando non ha considerato tutti gli accessori

                                if ($k!=0){
                                   ?>
                                        <br>
                                   <?php 
                                }

                                echo $user->getCarrello()[$i-1]->getAccessori()[$k];//spampa l'accessorio corrente ($k)
                                $k++;
                            }
                        ?>
                    </td>
                    <td> 
                        <?php
                            $j = count($user->getCarrello()[$i-1]->getColori()); // imposta un contatore per il numero di accessori registrati
                            $k = 0;//inizializza il contatore di stampa a zero
                            while ($k < $j){ //fino a quando non ha considerato tutti i colori

                                //se non si tratta del primo elemento vai a capo
                                if ($k!=0){
                                   ?>
                                         <br>
                                   <?php 
                                }

                                   //stampa il colore o il tipo di vernice
                                    echo $user->getCarrello()[$i-1]->getColori()[$k] ;//spampa l'accessorio corrente ($j)

                                $k++;
                            }
                        ?>
                    </td>
                    <!--invoca il metodo per la restituzione dell'alimentazione dalla lista delle auto del commerciante in questione-->
                    <td> <?= $user->getCarrello()[$i-1]->getAlimentazione() ?> </td>
                    <!--invoca il metodo per la restituzione del tipo di emissioni dalla lista delle auto del commerciante in questione-->
                    <td> <?= $user->getCarrello()[$i-1]->getEmissioni() ?> </td>
                    <!--invoca il metodo per la restituzione dell'anno di produzione dalla lista delle auto del commerciante in questione-->
                    <td> <?= $user->getCarrello()[$i-1]->getAnno() ?> </td>
                    <!--invoca il metodo per la restituzione del prezzo dalla lista delle auto del commerciante in questione-->
                    <td> <?= $user->getCarrello()[$i-1]->getPrezzo()?> <?= htmlentities("€")?> </td>
                    <!--invoca il metodo per la restituzione della data-->
                    <td> <?= $user->getCarrello()[$i-1]->getData() ?> </td>
                    <!--invoca il metodo per la restituzione della descrizione dalla lista delle auto del commerciante in questione-->
                    <td> <?= $user->getCarrello()[$i-1]->getDescrizione() ?> </td>
                     <!--invoca il metodo per la restituzione del numero di copie dalla lista delle auto del commerciante in questione-->
                    <td> <?= $user->getCarrello()[$i-1]->getCopie() ?> </td>
                    <td> <a href="Index.php?page=Cliente&subpage=CompraProdottoStep2&command=visualizzaVenditore&venditore=<?=  UserFactory::getListaCommercianti()[$i-1]->getId()?>">
                            <img  src="../Images/vendita.png" alt="Visita" width="20" height="20">
                        </a> </td>
                        <td> <a href="Index.php?page=Cliente&subpage=CompraProdottoStep2&command=visualizzaVenditore&venditore=<?=  UserFactory::getListaCommercianti()[$i-1]->getId()?>">
                            <img  src="../Images/vendita.png" alt="Visita" width="20" height="20">
                        </a> </td>

                    </tr>
                    <?php $i--; 

                }


             }
        
        ?>

    </table>




</h5>
