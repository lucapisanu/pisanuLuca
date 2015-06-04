<ul class="icona_titolo">
    <li id="i_home">&nbsp;</li>
    <li> Home&nbsp;Page </li>
</ul>
<br/>
<br/>

<h5><p>Benvenuto <?=$user->getNome()?></p>
    <p>Scegli a quale sezione accedere tra le seguenti.</p>
    <ul class="panel"><!-- lista dei link alle varie sezioni -->
        <li><a id="vendiProdotto" class="contentLink" href="Index.php?page=Commerciante&subpage=VendiProdotto<?= $vd->scriviToken('&')?>">Vendi&nbsp;prodotto</a></li>
        <li><a id="datiPersonali" class="contentLink" href="Index.php?page=Commerciante&subpage=DatiPersonaliCommerciante<?= $vd->scriviToken('&')?>">Dati&nbsp;personali</a></li>
        <li><a id="prodottiInVendita" class="contentLink" href="Index.php?page=Commerciante&subpage=ProdottiInVendita<?= $vd->scriviToken('&')?>">Prodotti&nbsp;in&nbsp;vendita</a></li>
        <li><a id="storicoVendite" class="contentLink" href="Index.php?page=Commerciante&subpage=StoricoVendite<?= $vd->scriviToken('&')?>">Storico&nbsp;Vendite</a></li>
    </ul>



</h5>
