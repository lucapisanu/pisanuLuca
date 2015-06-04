<ul class="icona_titolo">
    <li id="i_home">&nbsp;</li>
    <li> Home&nbsp;page </li>
</ul>
<br/>
<br/>

<h5><p>Benvenuto <?=$user->getNome()?></p>
<p>Scegli a quale sezione accedere tra le seguenti.</p></h5>
<ul class="panel"><!-- lista dei link alle varie sezioni -->
    <li><a id="cercaAcquirente"class="contentLink" href="Index.php?page=Gestore&subpage=CercaAcquirente">Cerca&nbsp;Acquirente</a></li>
    <li><a id="cercaVenditore" class="contentLink" href="Index.php?page=Gestore&subpage=CercaVenditore">Cerca&nbsp;Venditore</a></li>
    <li><a id="saldoGuadagni" class="contentLink" href="Index.php?page=Gestore&subpage=SaldoGuadagni">Saldo&nbsp;Guadagni</a></li>
</ul>
           