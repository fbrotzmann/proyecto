<?php

  //CARGO ERRORES VACIOS PARA MOSTRAR LA PRIMERA VEZ EN PANTALLA
  $errorUsername = "";

  $errorPassword = "";

  $errorEmail = "";

  $errores = 0;

  //SI RECIBO ALGO POR POST
  if($_POST){

    //TOMO LO RECIBIDO POR EL FOMRULARIO Y LO GUARDO SIN ESPACIOS
    $username = trim($_POST["username"]);

    $password = trim($_POST["password"]);

    $email = trim($_POST["email"]);

    $confirmPass = trim($_POST["confirmPass"]);


    //VALIDACION DE CADA DATO
    if ($username == "") {
      $errorUsername = "Completa el nombre";
      $errores++;
    }

    if ($password ==""){
    $errorPassword = "Completa la contraseña";
    $errores++;
    }
    else if (strlen($password)<4)
    {
      $errorPassword = "La contraseña debe tener al menos 4 caracteres";
      $errores++;
    }else if($password != $confirmPass){
      $errorPassword = "Las contraseñas no coinciden";
      $errores++;
    }

    if(!$hayErrores){
      //ARMO UN ARRAY ASOCIATIVO DEL USUARIO CON SUS DATOS YA VALIDADOS
      $user = [
      "username"=> $username,
      "password" => password_hash($password, PASSWORD_DEFAULT),
      "email"=> $email
      ];

      $users = file_get_contents('users.json');
      $users = json_decode($users,true);

      $users[]=$user;

      $usersJson = json_encode($users, JSON_PRETTY_PRINT);

      file_put_contents('users.json',$usersJson);

      echo "<h2>Gracias por su registro!</h2><br>
      <a href='register2.php'>de vuelta</a><br>";

      var_dump($usersJson);
      exit;
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- FONT AWESOME -->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
   <!-- conecto a bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>DH Electronics - Registro</title>
  <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>

  <!--   -------------------HEADER  ------------------ -->

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="index.html"><i class="fab fa-digital-ocean"></i></a>
    <a class="navbar-brand" href="index.html"> DH Electronics </a>

    <button class="navbar-toggler py-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto text-right">
        <li class="nav-item">
          <a class="nav-link" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user.html">Usuario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="faq.html">Preguntas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.html">Ingresar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.html" tabindex="-1" aria-disabled="true">Registrarse</a>
        </li>
      </ul>
    </div>
  </nav>

 <!-- Primera Tabla -->
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-around">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto align-items-center">
      <li class="nav-item">
        <a class="nav-link" href="#">Fotografía</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Computadoras</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Audio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Mobile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">TV & Entretenimiento</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="products.html">Nuestros productos</a>
      </li>

    </ul>



<!-- search button - carrito -->

<form class="form-inline justify-content-center my-2 my-lg-0">
  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-primary my-2 my-sm-0 mr-1" type="submit">
    <i class="fas fa-search"></i>
  </button>
    <button class="btn btn-primary my-2 my-sm-0 mx-2 d-sm-inline" type="submit">
    <i class="fas fa-shopping-cart"></i>
    </button>
  </a>
</form>
  </div>
</nav>

        <div class="register-container">
            <p style="text-align: center;">
            <i class="fab fa-digital-ocean"></i>
          </p>
            <h1>Completá tus datos</h1>
            <form class="" action="" method="POST">

                    <!-- USERNAME -->
                <label for="username">Nombre de usuario</label>
                <input id="username" type="text" name="username" placeholder="Cree un usuario" value="<?= $user ?>" required>
                <?= $errorUser ?>

                    <!-- PASSWORD -->
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" placeholder="Cree una contraseña" required> <?= $errorPassword ?>

                    <!-- ConfirmPass -->
                <label for="ConfirmPass">Confirmar contraseña</label>
                <input type="password" name="confirmPass" value=""> <?= $errorPassword ?>

                    <!-- EMAIL -->
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" name="email" placeholder="user@email.com" value="<?= $email ?>" required> <?= $errorEmail ?>

                <button type="submit" name="button">Crear cuenta</button>

            </form>

        </div>
</body>
        <!-- Pongo div de footer -->

        <footer>
          <div class="card-footer text-muted ">
            <div class="row">
              <div class="col">
                <a href="index.html"><i class="fab fa-digital-ocean"></i></a>
                <a class="textDH " href="index.html"> DH Electronics </a>
                <a class="logo" href="https://www.facebook.com"><i class="fab fa-facebook-square "></i></a>
                <a class= "logo" href="https://www.instagram.com"><i class="fab fa-instagram "></i></a>
              </div>
            <div class="columna text-small">
              <p>2019 Powered by Maca, Pato, Fede & Anthony </p>
            </div>
          </div>
        </footer>

 <!-- JAVA de bootstrap  -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</html>
