<?php
    include("../../db.php");
    if($_GET){
        $txtID = isset($_GET["txtID"])?$_GET["txtID"]:"";
        $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id = :id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);
        $nombredeusuario = $registro["usuario"];
        $password = $registro["password"];
        $correo = $registro["correo"];
    }

    if($_POST){
        $txtID = isset($_POST["txtID"])?$_POST["txtID"]:"";
        $usuario = isset($_POST["usuario"])?$_POST["usuario"]:"";
        $password = isset($_POST["password"])?$_POST["password"]:"";
        $correo = isset($_POST["correo"])?$_POST["correo"]:"";
        $usuario = filter_var($usuario,FILTER_SANITIZE_STRING);
        $correo = filter_var($correo,FILTER_SANITIZE_EMAIL);
        $password = filter_var($password,FILTER_SANITIZE_STRING);
        $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET usuario = :usuario, password = :password,correo = :correo WHERE id = :id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->bindParam(":usuario",$usuario);
        $sentencia->bindParam(":password",$password);
        $sentencia->bindParam(":correo",$correo);
        $sentencia->execute();
        header("Location: index.php");
      }

?>

<?php include("../../templates/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
        <form action="./editar.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input type="text"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" value="<?=$txtID;?>">
            </div>
            <div class="mb-3">
              <label for="usuario" class="form-label">Nombre del usuario:</label>
              <input type="text"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario" value="<?=$nombredeusuario?>">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña:</label>
              <input type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Ingrese su contraseña" value="<?=$password?>">
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label">Email:</label>
              <input type="email"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Ingrese su email" value="<?=$correo?>">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a class="btn btn-primary" href="./index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>
    
<?php include("../../templates/footer.php");?>