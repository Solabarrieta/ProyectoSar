<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
        <link rel="stylesheet" href="../css/index.css" />
        
    </head>
    <body>
        <nav class="container">
            <div class="logo"> <i class="far fa-sticky-note"></i> Mis Notas </div>
            <ul>
                <li><a href="index.php" class="selected">Página principal</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="SignUp.php">Sign Up</a></li>
            </ul>
        </nav>
        <hr>
        

        <div class="carousel">
            <button class="carousel__button carousel__button--left is-hidden">
                <
            </button>
            <div class="carousel__track-container">
                <ul class="carousel__track">
                    <li class="carousel__slide current-slide">
                        <img class="carousel__image" src="../images/1.jpg" alt="">
                    </li>
                    <li class="carousel__slide">
                        <img class="carousel__image" src="../images/2.jpg" alt="">
                    </li>
                    <li class="carousel__slide">
                        <img class="carousel__image" src="../images/3.jpg" alt="">
                    </li>
                    <li class="carousel__slide">
                        <img class="carousel__image" src="../images/4.jpg" alt="">
                    </li>
                </ul>
            </div>
            <button class="carousel__button carousel__button--right">
                >
            </button>

            <div class="carousel__nav">
                <button class="carousel__indicator current-slide"></button>
                <button class="carousel__indicator"></button>
                <button class="carousel__indicator"></button>
                <button class="carousel__indicator"></button>
            </div>
        </div>
        <script src="../js/carousel.js"></script>
    </body>
</html>