<ul class="icona_titolo">
    <li id="i_carrello">&nbsp;</li>
    <li> Carrello </li>
</ul>
<br>

 <?php 
if (CarrelloFactory::instance()->autoPerCliente($user->getId()) == 0 ){ ?>
    <p>Non hai nessuna auto nel carrello</p>
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
                <th>Elimina</th>
                <th>Compra</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $carrello = CarrelloFactory::instance()->caricaCarrello($user->getId()); 
            
            foreach ($carrello as $ca) {
                $a = AutoFactory::instance()->caricaAuto($ca->getIdAuto());  
                
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
                    
                    <td> <?= $ca->getData() ?> </td>
                    
                    <td>
                        <a href="Index.php?page=Cliente&subpage=Carrello2&command=eliminaCarrello&id_auto=<?=  $a->getId()?>">
                            <img src="../Images/elimina.png" alt="Elimina" >
                        </a>           
                    </td>
                    
                    <td>
                        <a href="Index.php?page=Cliente&subpage=Carrello2&command=compraAuto&id_auto=<?=  $a->getId()?>">
                            <img height="18px" width="18px"  src="../Images/aggiungi.png" alt="Compra" >
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