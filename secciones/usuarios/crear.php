<?php 
  include("../../db.php");

  if($_POST){
    $usuario = isset($_POST["usuario"])?$_POST["usuario"]:"";
    $password = isset($_POST["password"])?$_POST["password"]:"";
    $correo = isset($_POST["correo"])?$_POST["correo"]:"";
    $usuario = filter_var($usuario,FILTER_SANITIZE_STRING);
    $correo = filter_var($correo,FILTER_SANITIZE_EMAIL);
    $password = filter_var($password,FILTER_SANITIZE_STRING);
    $sentencia = $conexion->prepare("INSERT INTO tbl_usuarios VALUES (NULL,:usuario,:password,:correo)");
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->execute();
    header("Location: index.php");
  }

?>

<?php include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
        <form action="./crear.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="usuario" class="form-label">Nombre del usuario:</label>
              <input type="text"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña:</label>
              <input type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Ingrese su contraseña">
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label">Email:</label>
              <input type="email"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Ingrese su email">
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
            <a class="btn btn-primary" href="./index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>
    
<?php include("../../templates/footer.php");?>