<?php
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
    $correo = $_POST['email'];
    $userpass = $_POST['password'];
    $error = 0;
    if (isset($_POST['email'])) {
        try {
            $user = "root";
            $pass = "";

            $dns = "mysql:host=localhost;dbname=proyecto_sar";
            $dbh = new PDO($dns, $user, $pass);
            $hashpass = password_hash($userpass, PASSWORD_DEFAULT);

            $stmt = $dbh->prepare("SELECT * FROM usuarios WHERE correo = ?");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(1, $correo);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'ha ocurrido un error durante la creación de la conexion a la BD';
            die($e->getMessage());
        }
        $row = $stmt->fetch();
        if ($row == 0) {
            $error = 3;
        } else {
            $pw = $row['password'];
            if ($pw == $userpass) {
                $_SESSION['correo'] = $correo;
                header("Location:Notas.php");
            } else {
                $error = 2;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
    <link rel="stylesheet" href="../css/styleLogin.css" />
    <script src="scriptLogin.js"></script>
</head>

<body>
    <nav class="container">
        <div class="logo">
            <i class="fas fa-sticky-note"> Mis Notas</i>

        </div>
<<<<<<< HEAD
        <ul>
            <a href="index.php">Página principal</a>
        </ul>

    </nav>

    <div id="contenido">
        <div id="centro" class="centro">
            <div class="inicio-sesion">
                Iniciar sesión
=======
        <form id="form" class="form" onsubmit="validarLogin(this.form)" method="post">
            <div class="form-control">
                <label for="email">Correo electrónico</label>
                <input type="text" placeholder="alumno@ikasle.ehu.eus" id="email" name="email" />    
>>>>>>> ff3d5979e5a67f71ed2c7add1290edf8e8317daa
            </div>
            <form id="form" class="form" onsubmit="validarLogin(this.form)" method="post">
                <div class="form-control">
                    <label for="email">Correo electrónico</label>
                    <input type="text" placeholder="Correo" id="email" name="email" />
                </div>
                <div class="form-control">
                    <label for="password">Contraseña</label>
                    <input type="password" placeholder="Contraseña" id="password" name="password" />
                </div>
                <div class="form-control">
                    <input class="acceso" type="submit" value="Acceso" />
                </div>
            </form>
            <div class="crear-cuenta">
                <p>¿No tienes cuenta?</p>
                <p>Puedes crearte una cuenta <a href="SignUp.php">aquí</a>.</p>
            </div>
        </div>
    </div>
</body>

</html>