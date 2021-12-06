<?php
if (isset($_POST['botonReg'])) {
    $correo = $_POST['correo'];
    $userpass = $_POST['userpass'];

    $error = 0;


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
        $error = 3;
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
    <link rel="stylesheet" href="../css/form.css">
</head>

<body>
    <h>Sign Up</h>
    <div class="container">
        <form action="" method="post" class="form">
            <input type="text" name="" id="username" class="form__input">
            <label for="username" class="form__label"></label>
            <input type="email" name="" id="email" class="form__input">
            <label for="email" class="form__label"></label>
            <input type="password" name="password" id="password" class="form__label">
            <label for="password" class="form__label"></label>
            <input type="submit" value="SingUp" class="form__submit">
        </form>
    </div>

</body>

</html>