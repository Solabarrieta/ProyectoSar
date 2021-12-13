<?php
session_start();
if (isset($_POST['btn-submit'])) {
    $correo = $_POST['email'];
    $userpass = $_POST['password'];
    $error = 0;
    if (isset($_POST['email'])) {
        try {
            $server = "localhost";
            $user = "G22";
            $pass = "TWTnlYm33HtAL";
            $basededatos = "db_G22";

            $dns = "mysql:host=$server;dbname=$basededatos";
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
            $pw = $row['pass'];
            if (password_verify($userpass, $pw)) {
                $_SESSION['correo'] = $correo;
                header("Location: Notas.php");
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
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/scriptLogIn.js"></script>
</head>

<body>
    <nav class="container">
        <div class="logo">
            <i class="fas fa-sticky-note"> Mis Notas</i>

        </div>
        <ul>
            <a href="index.php">Página principal</a>
        </ul>

    </nav>

    <div id="contenido" class="contenido">
        <div id="centro" class="centro">
            <div class="inicio-sesion">
                Iniciar sesión
            </div>
            <form id="form" class="form" method="post">
                <div class="form-control">
                    <label for="email">Correo electrónico</label>
                    <input type="text" placeholder="Correo" id="email" name="email" />
                </div>
                <div class="form-control">
                    <label for="password">Contraseña</label>
                    <input type="password" placeholder="Contraseña" id="password" name="password" />
                </div>
                <div class="form-control">
                    <input name="btn-submit" class="acceso" type="submit" onclick="return ValidarLogIn(this.form);" value="Acceso" />
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