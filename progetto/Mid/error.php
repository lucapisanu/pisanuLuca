<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Errore!!</title>
    </head>
    <body>
        <h1><?= $titolo ?></h1>
        <p>
            <?= $mess ?>
        </p>
        <? 
            if (isset($login)) { 
        ?>
            <p>Autenticati alla pagina di <a href="login">login</a></p>
        <?
        } 
        ?>
    </body>
</html>
