<?php
    session_start();
    $xml = simplexml_load_file("../xml/notas.xml");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Notes App</title>
        <link rel='stylesheet' href="../css/notas.css">

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/1.1.1/marked.min.js"></script>
        <!--<script src="../js/scriptNotas.js" defer></script>-->
    </head>
    <body>
    <nav class="container">
            <div class="logo">
                <i class="far fa-sticky-note"></i>
                Mis Notas
            </div>
            <ul>
                <li><a href="index.php">Sign out</a></li>
            </ul>
        </nav>
        <hr>
        <div class="row">
            <div class="column left">
                <form method="post">
                    <select name="categoriaShow" id="categoriaShow">
                        <option value="1">Informática</option>
                        <option value="2">Psicología</option>
                        <option value="3">Deportes</option>
                        <option value="4">Física</option>
                        <option value="5">Otros..</option>
                    </select>
                </form>
                <?php
                    echo "<table border=1>";
                    echo "<tr><th>Fecha</th><th>Usuario</th><th>Título</th><th>Cuerpo</th></tr>";
                    foreach($xml as $nota){
                        echo"<tr>
                        <td>".$nota->fecha."</td><td>".$nota->usuario."</td><td>".$nota->texto->titulo."</td><td>".$nota->texto->cuerpo."</td>
                        </tr>";
                    }
                    echo "</table>";
                
                ?>
            </div>
            
            <div class="column right">
                <?php
                require_once('Notas2.php');
                ?>
            </div>
        </div>
    </body>
</html>
<?php
    function formatXml($simpleXMLElement){
        $xmlDocument = new DOMDocument('1.0');
        $xmlDocument -> preserveWhiteSpace = false;
        $xmlDocument -> formatOutput = true;
        $xmlDocument -> loadXML($simpleXMLElement -> asXML());

        return $xmlDocument ->saveXML();
    }
    ?>