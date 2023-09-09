<?php
    include("../../db.php");
    if($_POST){
        $nombredelpuesto = isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"";
        if($nombredelpuesto == ""){
            header("Location: ./index.php");
        }else{
            $nombredelpuesto = filter_var($nombredelpuesto,FILTER_SANITIZE_STRING);
            $sentencia = $conexion->prepare("INSERT INTO tbl_puesto(id,nombredelpuesto) VALUE (null,:nombredelpuesto)");
            $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
            $sentencia->execute();
            header("Location: ./index.php");
        }
        
    }

?>

<?php include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        Puesto
    </div>
    <div class="card-body">
        <form action="./crear.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nombredelpuesto" class="form-label">Nombre del puesto:</label>
              <input type="text"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="">
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="./index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>
    
<?php include("../../templates/footer.php");?>