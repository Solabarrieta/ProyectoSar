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
    <link rel="stylesheet" href="../css/signup.css">
    <script src="scriptSignup.js"></script>
</head>

<body>
    <div class="container">
        <div class="logo"> <i class="far fa-sticky-note"></i> Mis Notas </div>
        <ul> <li><a href="index.php">Página principal</a></li> </ul>
        <hr>
        <h>Crear cuenta</h>
        <form action="" method="post" class="form" onsubmit="validarSignup()">
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

            <input type="submit" value="Crear" class="form__submit">
        </form>
    </div>

</body>

</html>