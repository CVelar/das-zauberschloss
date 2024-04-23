<?php
if(isset($_GET['ziel']) && isset($_GET['name'])) {
    $ziel = $_GET['ziel'];
    $name = $_GET['name'];
    
    // HTML-Code mit Platzhaltern für Argumente
    $html = <<<HTML
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Das Zauberschloss</title>
    <meta name="description" content="Hier finden Sie alle Infos, Sendungen von Telemagic, Ausgaben vom Schlosspropheten und noch vieles mehr!">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/source/style.css">
    <link rel="icon" href="/source/img/zs_schwarz_rgb_s_white.png">

</head>

<body>
    <div id="menuContainer"></div>
    <!-- Verlinkung der Headers. Header unter "/source/header.html". Script in "/source/loadMenu.js" -->

    <div class="main">
        <div class="textblock">
            <div id="leave_comment"></div>
            <!-- Verlinkung der Warnung. Warnung unter "/source/leave.html". Script in "/source/loadMenu.js" -->
            <div class="main-link"><li><a class="sec-link" href="{$ziel}">{$name}</a></li></div>
        </div>

    </div>


    <div id="menuFooter"></div>
    <!-- Verlinkung der Footers. Footer unter "/source/footer.html". Script in "/source/loadMenu.js" -->

    <script src="/source/loadMenu.js"></script>
    <!-- Script zum Verlinken gleichbleibender Codeschnipsel -->
    <script src="" async defer></script>
</body>

</html>
HTML;

    // Platzhalter ersetzen und HTML ausgeben
    echo str_replace(array('(Argument-1)', '(Argument-2)'), array($ziel, $name), $html);
} else {
    // Fehlermeldung ausgeben, wenn Argumente fehlen
    echo "Fehlende Argumente!";
}
?>
