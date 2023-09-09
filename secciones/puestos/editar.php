<?php
    include("../../db.php");

    if(isset($_GET["txtID"])){
        $txtID = isset($_GET["txtID"])? $_GET["txtID"]:"";
        $sentencia = $conexion->prepare("SELECT * FROM tbl_puesto where id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);
        $nombredelpuesto = $registro["nombredelpuesto"];
    }

    if($_POST){
        $txtID = isset($_POST["txtID"])?$_POST["txtID"]:"";
        $nombredelpuesto = isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"";
        $nombredelpuesto = filter_var($nombredelpuesto,FILTER_SANITIZE_STRING);
        $sentencia= $conexion->prepare("UPDATE tbl_puesto SET tbl_puesto.nombredelpuesto = :nombredelpuesto WHERE tbl_puesto.id = :id");
        $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        header("Location: index.php");
    }

?>

<?php include("../../templates/header.php");?>
<div class="card mt-5">
    <div class="card-header">
        Puesto
    </div>
    <div class="card-body">
        <form action="./editar.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input type="text"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID" value="<?=$txtID?>">
            </div>
            <div class="mb-3">
              <label for="nombredelpuesto" class="form-label">Nombre del puesto:</label>
              <input type="text"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto" value="<?=$nombredelpuesto?>">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="./index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>
    
<?php include("../../templates/footer.php");?>