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
    <link rel="stylesheet" href="../css/style.css" />
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!--<script src="../js/script.js" defer></script>-->
    <script src="../js/notas.js" defer></script>

    <link rel='stylesheet' href="../css/notas.css">
    <!--<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>-->
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
    <button class="add" id="add" onclick="">
        <i class="fas fa-plus"></i> Add note
    </button>
    <hr>
    <div class="NoteWIthoyCss">
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
                foreach ($xml as $nota) {
                    echo "<tr>
                        <td>" . $nota->fecha . "</td><td>" . $nota->usuario . "</td><td>" . $nota->texto->titulo . "</td><td>" . $nota->texto->cuerpo . "</td>
                        </tr>";
                }
                echo "</table>";

                ?>
            </div>
            <div class="column right">
                <form method="post" class="form" id="form">
                    <div class="form-control">
                        <label for="text">Categoría: </label>
                        <select name="categoria" id="categoria">
                            <option value="1">Informática</option>
                            <option value="2">Psicología</option>
                            <option value="3">Deportes</option>
                            <option value="4">Física</option>
                            <option value="5">Otros..</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <input type="text" placeholder="Título.." id="titulo" name="titulo">
                    </div>
                    <div class="form-control">
                        <input type="text" placeholder="Escribe aquí tu nota. Mínimo 20 carácteres.." id="texto" name="texto">
                    </div>
                    <div class="form-control">
                        <input type="submit" value="Añadir nota" />
                    </div>
                </form>
                <?php
                if (isset($_POST['texto'])) {
                    $categoria = $_POST['categoria'];
                    $titulo = $_POST['titulo'];
                    $cuerpo = $_POST['texto'];
                    $fecha = date("d/m/Y");

                    $nota = $xml->addChild('nota');
                    $nota->addAtribute('categoria', $categoria);
                    $nota->addChild('fecha', $fecha);
                    $nota->addChild('usuario', $_SESSION['correo']);
                    $nota->addChild('texto');
                    $texto->addChild('titulo', $titulo);
                    $texto->addChild('cuerpo', $cuerpo);

                    $xml->asXML("../xml/notas.xml");
                }

                ?>
            </div>
        </div>
    </div>

</body>

</html>
<?php
function formatXml($simpleXMLElement)
{
    $xmlDocument = new DOMDocument('1.0');
    $xmlDocument->preserveWhiteSpace = false;
    $xmlDocument->formatOutput = true;
    $xmlDocument->loadXML($simpleXMLElement->asXML());

    return $xmlDocument->saveXML();
}
?>