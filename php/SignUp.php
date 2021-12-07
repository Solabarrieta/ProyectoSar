<?php
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST["userName"])) {
    $correo = $_POST['email'];
    $userpass = $_POST['password'];
    $userName=$_POST['userName'];
    $error = 0;
    if (isset($_POST['email'])) {
        try {
            $user="root";
            $pass="";
            
            $dns = "mysql:host=localhost;dbname=proyecto_sar";
            $dbh = new PDO($dns, $user, $pass);
            $hashpass = password_hash($userpass, PASSWORD_DEFAULT);
            
            $stmt = $dbh->prepare("INSERT INTO usuarios (UserName,correo, password) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $correo);
            $stmt->bindParam(3, $userpass);
            $stmt->execute();
            $dbh = null;
        } catch (PDOException $e) {
            echo 'ha ocurrido un error durante la creación de la conexion a la BD';
            die($e->getMessage());
        }
    }

    /*
    if (preg_match($er, $correo) && $tipoUser == 'prof') {
        //No se ha introducido, cambiar por comprobar que el tipo de usuario coincide con el tipo de email...
        $error = 1;
    } else if ((preg_match($er2, $correo) || preg_match($er3, $correo)) && $tipoUser == 'alu') {
        $error = 1;
    } else if (!(preg_match($er, $correo) || preg_match($er2, $correo) || preg_match($er3, $correo))) {
        //El correo no es correcto
        $error = 2;
    } else if (strlen($nom) < 2) {
        //El nombre tiene menos de dos carácteres
        $error = 3;email
    } else if (strlen($apell) < 2) {
        //El apellido tiene menos de 2 carácteres
        $error = 4;
    } else if (strlen($userpass) < 8) {
        //La contraseña tiene menos de 2 carácteres
        $error = 5;
    } else if ($repass != $userpass) {
        //Contraseña y confirmar contraseña no coinciden
        $error = 6;
    } else {
        $error = 0;
    }
}
if (isset($_POST['email'])) {
    try {
        echo "abriendo conexion con la BD '.$basededatos.' ";
        $dns = "mysql:host=$server;dbname=$basededatos";
        $dbh = new PDO($dns, $user, $pass);
        $hashpass = password_hash($userpass, PASSWORD_DEFAULT);

        if ($correo == 'admin@ehu.es' && $tipoUser = 'prof') {
            $tipoUser = 'admin';
        }
        $stmt = $dbh->prepare("INSERT INTO users (tipouser, correo, nom, apell, pass, img) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $tipoUser);
        $stmt->bindParam(2, $correo);
        $stmt->bindParam(3, $nom);
        $stmt->bindParam(4, $apell);
        $stmt->bindParam(5, $hashpass);
        $stmt->bindParam(6, $imagen_dir);
        $stmt->execute();
        $dbh = null;
    } catch (PDOException $e) {
        echo 'ha ocurrido un error durante la creación de la conexion a la BD';
        die($e->getMessage());
    }*/
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
    <script src="scriptSignup.js"></script>
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
            <form id="form" action="" method="post" class="form" onsubmit="validarSignup()">
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
                    <input type="password" name="password" id="password2" class="form__label" placeholder="Contraseña">
                </div>

                <input class="crear" type="submit" value="Crear" class="form__submit">
            </form>
        </div>
    </div>

</body>

</html>
 Save