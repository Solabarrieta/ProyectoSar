<?php
session_start();
if (!isset($_SESSION['correo'])) {
    echo '<script type="text/javascript"> alert("Debes estar logueado!! "' . $_SESSION['correo'] . ');
      window.location.href="index.php";
      </script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css" />
    <script src="../js/jquery-3.4.1.min.js"></script>


    <link rel='stylesheet' href="../css/notas.css">
    <script src="https://kit.fontawesome.com/2a1176e154.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="nav">
        <button class="add" id="add" onclick="getId(<?php echo '\'' . $_SESSION['correo'] . '\'' ?>)">
            Añade una nota
            <i class="fas fa-plus"></i>
        </button>
        <input class="logoutBtn" id="logoutbtn" type="submit" value="Log Out">
    </nav>
    <div class="btnContainer">
    </div>

    <div class="row">
        <div class="menu">
            <input type="text" placeholder="Buscar" id="busqueda">
            <button onclick="filtrarNotas()"><i class="fas fa-search"></i></button>
        </div>
        <div class="notas" id="notas">

        </div>
    </div>
    <script src="../js/notas.js"></script>
    <script>
        getId(<?php echo '\'' . $_SESSION['correo'] . '\'' ?>);
    </script>

</body>

</html>