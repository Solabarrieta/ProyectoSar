<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css" />
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!--<script src="../js/script.js" defer></script>-->
    <script src="../js/notas.js" defer></script>

    <link rel='stylesheet' href="../css/notas.css">
    <script src="https://kit.fontawesome.com/2a1176e154.js" crossorigin="anonymous"></script>
    <!--<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/1.1.1/marked.min.js"></script> -->
    <!--<script src="../js/scriptNotas.js" defer></script>-->
</head>

<body>
    
    <button class="add" id="add" onclick="">
        <i class="fas fa-plus"></i>
    </button>

    <div class="row">
        <div class="menu">
            <input type="text" placeholder="Buscar" id="busqueda">
            <button onclick="filtrarNotas()"><i class="fas fa-search"></i></button>
        </div>
        <div class="notas" id="notas">

        </div>
    </div>

</body>

</html>