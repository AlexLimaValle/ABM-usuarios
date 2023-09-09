<?php
    include("./db.php");
    session_start();
    if($_POST){
        $usuario = ($_POST["usuario"])?$_POST["usuario"]:"";
        $contrasenia = ($_POST["contrasenia"])?$_POST["contrasenia"]:"";
        $sentencia = $conexion->prepare("SELECT *,COUNT(*) as cantidad FROM tbl_usuarios WHERE usuario =:usuario AND password=:contrasenia");
        $sentencia->bindParam(":usuario",$usuario);
        $sentencia->bindParam(":contrasenia",$contrasenia);
        $sentencia->execute();
        $registro = $sentencia->fetch(PDO::FETCH_ASSOC);
        if($registro["cantidad"] > 0){
          $_SESSION["nombre"] = $registro["usuario"];
          $_SESSION["seccion"] = true;
          header("Location: index.php");
        }else{
          $message = "Error ren usurio o contrasenia";
        }
    }

?>

<!doctype html>
<html lang="en">

<head>
  <title>Loguin</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main class="container">
    <div class="row">
        <div class="col-md-4">
            
        </div>
        <div class="col-md-4 mt-4">
            <div class="card">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                    <?php if(isset($message)):?>
                        <div class="alert alert-primary" role="alert">
                          <strong><?=$message;?></strong>
                        </div>
                    <?php endif;?>
                    <form action="" method="post">
                        <div class="mb-3">
                          <label for="usuario" class="form-label">Usuario</label>
                          <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Escriba su usuario">
                        </div>
                        <div class="mb-3">
                          <label for="contrasenia" class="form-label">Name</label>
                          <input type="password"
                            class="form-control" name="contrasenia" id="contrasenia" aria-describedby="helpId" placeholder="Escriba su contraseña">
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar al sistema</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>