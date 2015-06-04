<ul class="icona_titolo">
    <li id="i_profilo">&nbsp;</li>
    <li> Cerca&nbsp;Acquirente </li>
</ul>
<br/>
<br/>

<form action="demo_form.asp" method="get">
     <label for="corto">Nome e cognome</label>
     <input type="text" name="buyerName" id="buyerName"/><!-- vasella di inserimento del testo -->
     <input type="submit" value="Cerca"><!-- pulsante di attivazione della ricerca -->
     <br>

</form>
<br><hr>

<h4 id="venditoriLista">Lista venditori</h4>

<h5>
             <?php
                        
             
             /*setta il contatore delle righe della tabella in base alle vetture presenti nell'array
              *(se di uno stesso prodotto ci sono due copie lo conterà solo una volta)*/
             $i = count(UserFactory::getListaClienti());
         
             //se non ci sono auto nella lista
             if($i==0){
                 
                 echo "Nessun commerciante presente";
             }
             else{
                 
                ?>
                 <table><!-- tabella riempita con tutte le vetture in vendita -->
                    <tr><!-- riga principale contenente tutti gli attributi -->
                        <th>Cognome</th>
                        <th>Nome</th>
                        <th>Indirizzo</th>
                        <th>Email</th>
                        <th>Id</th>
                        <th>Modifica</th>
                    </tr>
                 <?php 
                //fino a quando ci sono vetture da stampare
                while ($i>0){

                    //se la riga è pari
                    if($i%2==0){

                    ?><tr class="evenRow"><!-- id per righe pari -->
                    <?php       
                    }
                    else{
                    ?>
                    <tr>
                    <?php       
                    }
                    ?>  
                    <!--invoca il metodo per la restituzione del cognome del venditore-->
                    <td> <?= UserFactory::getListaClienti()[$i-1]->getCognome()  ?> </td>
                    <!--invoca il metodo per la restituzione del nome del venditore-->
                    <td> <?= UserFactory::getListaClienti()[$i-1]->getNome() ?> </td>
                    <!--invoca il metodo per la restituzione del nome dell'azienda-->
                    <td> <?= UserFactory::getListaClienti()[$i-1]->getIndirizzo() ?> </td>
                    <!--invoca il metodo per la restituzione dell'indirizzo della sede-->
                    <td> <?= UserFactory::getListaClienti()[$i-1]->getEmail() ?> </td>
                    <!--invoca il metodo per per la restituzione dell'id-->
                    <td> <?= UserFactory::getListaClienti()[$i-1]->getId() ?> </td>
                    <td> <a href="<?=$url?>&command=clienteModifica&_imp=obj<?=  UserFactory::getListaClienti()[$i-1]->getId()?>" title="Modifica l'account">
                            <img  src="../Images/modifica.png" alt="Modifica" width="20" height="20">
                        </a></td>
                    </tr>
                    <?php $i--; 
                }
             }
        ?>
    </table>
</h5>
