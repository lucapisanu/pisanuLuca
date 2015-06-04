<ul  class="icona_titolo">
    <li id="i_home">&nbsp;</li>
    <li> Home&nbsp;page </li>
</ul>
<br>
<br>

<h5><p>Benvenuto <?=$user->getNome()?></p>
    <p>Scegli a quale sezione accedere tra le seguenti.</p>
    <ul class="panel"><!-- lista dei link alle varie sezioni -->
        <li><a id="compraProdotto" class="contentLink" href="Index.php?page=Cliente&subpage=CompraProdottoStep1<?= $vd->scriviToken('&')?>">Compra&nbsp;prodotto</a></li>
        <li><a id="datiPersonali" class="contentLink" href="Index.php?page=Cliente&subpage=DatiPersonaliCompratore<?= $vd->scriviToken('&')?>">Dati&nbsp;personali</a></li>
        <li><a id="carrello" class="contentLink" href="Index.php?page=Cliente&subpage=Carrello<?= $vd->scriviToken('&')?>">Carrello</a></li>
        <li><a id="cronologia" class="contentLink" href="Index.php?page=Cliente&subpage=StoricoAcquisti<?= $vd->scriviToken('&')?>">Storico&nbsp;Acquisti</a></li>
        <li><a id="cercaVenditore" class="contentLink" href="Index.php?page=Cliente&subpage=CercaVenditore<?= $vd->scriviToken('&')?>">Cerca&nbsp;Venditore</a></li>
        <li><a id="ricarica" class="contentLink" href="Index.php?page=Cliente&subpage=RicaricaConto<?= $vd->scriviToken('&')?>">Ricarica&nbsp;Conto</a></li>
    </ul>

</h5>
