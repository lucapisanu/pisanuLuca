<?php
include_once 'ViewDescriptor.php';
include_once basename(__DIR__) . '/../Settings.php'; 

?>
<!DOCTYPE html>
<!-- 
     Pagina master per la visualizzazione del layout delle pagine. 
     A questa è associata la pagina viewdescriptor contenente la classe con le varie parti 
     della pagina da visuallizzare, comprendente anche i messaggi di errore.
-->
<html>
    <head>
        <title><?= $vd->getTitolo() ?></title>
       
       

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name ="author" content="Luca Pisanu">
        
        <!-- link ai file css -->
        <link rel="stylesheet" type="text/css" href="../CSS/general.css" media="screen">
        <link rel="stylesheet" type="text/css" href="../CSS/fixed.css" media="screen">
        <link rel="stylesheet" type="text/css" href="../CSS/stili.css" media="screen">
        
    </head>
    
    <body>
        <div id="page"><!-- divisone principale -->
            <div id="header"><!-- divisione parte superiore -->
                <div id="logo"><!-- divisione contente il logo e il titolo -->
                    <?php
                    $logo = $vd->getLogoFile();
                    require "$logo";
                    ?>
                </div>
            </div>
            <div id="menu"><!-- divisone con i link alle sezioni -->
             <?php
               $menu = $vd->getMenuFile();
               require "$menu";
             ?>
           </div>

            
            <div id="leftSidebar"><!-- divisione barra sinistra -->
                <ul>
                    <li >
                        <h2 class="leftItem" id="sections"><p>Sezioni</p></h2> 
                    </li>
                        <?php
                        $menu = $vd->getMenuFile();
                        require "$menu";
                        ?>
                    <li >
                        <h2 class="leftItem" id="info" >Istruzioni</h2><!-- informazioni sulla pagina corrente -->
                        <li>
                            <?php
                            $leftInfo = $vd->getLeftBarInfoFile();
                            require "$leftInfo";
                            ?> 
                        </li>  
                    </li>
                    
                </ul>
            </div>
            
            <div id="content"><!-- divisione del corpo centrale della pagina -->
                <?php
                if ($vd->getMessaggioErrore() != null) {
                    ?>
                    <div id="errore">
                        <div>
                            <?=
                            $vd->getMessaggioErrore();
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                if ($vd->getMessaggioConferma() != null) {
                    ?>
                    <div id="conferma">
                        <div>
                            <?=
                            $vd->getMessaggioConferma();
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                $content = $vd->getContentFile();
                require "$content";
                ?>
            </div>
 
            <div id="footer"><!-- divisione inferiore pagina-->
                <a href="http://validator.w3.org/check/referer">Validatore Html</a>
                <a href="http://jigsaw.w3.org/css-validator/check/refer">Validatore Css</a>​​
            </div>
        </div>
    </body>
</html>

