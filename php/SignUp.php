<?php

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST["userName"])) {
    $correo = $_POST['email'];
    $userpass = $_POST['password'];
    $userName = $_POST['userName'];
    $error = 0;
    if (isset($_POST['email'])) {
        try {
            include "DbConfig.php";
            $dns = "mysql:host=$server;dbname=$basededatos";
            $dbh = new PDO($dns, $user, $pass);
            $hashpass = password_hash($userpass, PASSWORD_DEFAULT);
            $stmt = $dbh->prepare("SELECT * FROM usuarios WHERE UserName=? OR correo=? ");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $correo);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row = 0) {
                $stmt1 = $dbh->prepare("INSERT INTO usuarios (UserName,correo, pass) VALUES (?, ?, ?)");
                $stmt1->bindParam(1, $userName);
                $stmt1->bindParam(2, $correo);
                $stmt1->bindParam(3, $hashpass);
                $stmt1->execute();
                header("Location: Login.php");
            } else {
                echo '<script type="text/javascript"> alert("El usuario introducido ya existe en la base de datos");
                </script>';
            }
            $dbh = null;
        } catch (PDOException $e) {
            echo 'ha ocurrido un error durante la conexion a la BD';
            die($e->getMessage());
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
    <link rel="stylesheet" href="../css/signUp.css">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/scriptSignup.js" type="text/javascript"></script>
</head>

<body>
    <div class="container">
        <div class="logo">
            <i class="fas fa-sticky-note">Mis Notas</i>
        </div>
        <ul>
            <a href="index.php">Página principal</a>
        </ul>
    </div>

    <div id="contenido">
        <div id="centro" class="centro">
            <div class="creacion-cuenta">
                Crear cuenta
            </div>
            <form id="form" method="post" class="form">
                <div class="form-control">
                    <label for="userName" class="form__label">Nombre usuario</label>
                    <input type="text" name="userName" id="username" class="form__input" placeholder="Nombre">
                </div>

                <div class="form-control">
                    <label for="email" class="form__label">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form__input" placeholder="Correo">
                </div>

                <div class="form-control">
                    <label for="password" class="form__label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form__label" placeholder="Contraseña">
                </div>

                <div class="form-control">
                    <label for="password" class="form__label">Repetir contraseña</label>
                    <input type="password" name="password2" id="password2" class="form__label" placeholder="Contraseña">
                </div>

                <input id='crear' class="crear" type="submit" value="Crear" onclick="return ValidarSignUp(this.form);" class="form__submit">
            </form>
        </div>
    </div>

</body>

</html>