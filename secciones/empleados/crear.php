<?php 
  include("../../db.php");
  $time = time();
  if($_POST){
    $primernombre = isset($_POST["primernombre"])?$_POST["primernombre"]:"";
    $segundonombre = isset($_POST["segundonombre"])?$_POST["segundonombre"]:"";
    $primerapellido = isset($_POST["primerapellido"])?$_POST["primerapellido"]:"";
    $segundoapellido = isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"";
    $idpuesto = isset($_POST["idpuesto"])?$_POST["idpuesto"]:"";
    $fechadeingreso = isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"";
    $primernombre = filter_var($primernombre,FILTER_SANITIZE_STRING);
    $segundonombre = filter_var($segundonombre,FILTER_SANITIZE_STRING);
    $primerapellido = filter_var($primerapellido,FILTER_SANITIZE_STRING);
    $segundoapellido = filter_var($segundoapellido,FILTER_SANITIZE_STRING);

    $foto = isset($_FILES["foto"]["name"])?$_FILES["foto"]["name"]:"";
    $cv = isset($_FILES["cv"]["name"])?$_FILES["cv"]["name"]:"";

    $sentencia = $conexion->prepare("INSERT INTO tbl_empleados VALUES (NULL,:primernombre,:segundonombre,:primerapellido,:segundoapellido,:foto,:cv,:idpuesto,:fechadeingreso)");
    $sentencia->bindParam(":primernombre",$primernombre);
    $sentencia->bindParam(":segundonombre",$segundonombre);
    $sentencia->bindParam(":primerapellido",$primerapellido);
    $sentencia->bindParam(":segundoapellido",$segundoapellido);
    $fecha = new DateTime();
    $nombre_foto = ($foto != "")?$fecha->getTimestamp()."-".$_FILES["foto"]["name"]:"";
    $tmp_foto = $_FILES["foto"]["tmp_name"];
    if(!empty($tmp_foto)){
      move_uploaded_file($tmp_foto,"./fotos/".$nombre_foto);
    }
    $sentencia->bindParam(":foto",$nombre_foto);

    $nombre_cv = ($cv != "")?$fecha->getTimestamp()."-".$_FILES["cv"]["name"]:"";
    $tmp_cv = $_FILES["cv"]["tmp_name"];
    if(!empty($tmp_cv)){
      move_uploaded_file($tmp_cv,"./cv/".$nombre_cv);
    }
    $sentencia->bindParam(":cv",$nombre_cv);
    $sentencia->bindParam(":idpuesto",$idpuesto);
    $sentencia->bindParam(":fechadeingreso",$fechadeingreso);
    $sentencia->execute();
    header("Location: index.php");
  }

  $sentencia = $conexion->prepare("SELECT * FROM tbl_puesto");
  $sentencia->execute();
  $tbl_puesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php");?>

    <div class="card mt-5">
        <div class="card-header">
            Datos de empleado
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="primernombre" class="form-label">Primer nombre</label>
                  <input type="text"
                    class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer nombre">
                </div>
                <div class="mb-3">
                  <label for="segundonombre" class="form-label">Segundo nombre</label>
                  <input type="text"
                    class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
                </div>
                <div class="mb-3">
                  <label for="primerapellido" class="form-label">Primer apellido</label>
                  <input type="text"
                    class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
                </div>
                <div class="mb-3">
                  <label for="segundoapellido" class="form-label">Segundo apellido</label>
                  <input type="text"
                    class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
                </div>
                <div class="mb-3">
                  <label for="foto" class="form-label">Foto:</label>
                  <input type="file"
                    class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
                </div>
                <div class="mb-3">
                  <label for="cv" class="form-label">CV(PDF):</label>
                  <input type="file"
                    class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
                </div>
                <div class="mb-3">
                    <label for="idpuesto" class="form-label">Puesto:</label>
                    <select class="form-select form-select-lg" name="idpuesto" id="idpuesto">
                        <option selected>Selecciones puesto</option>
                        <?php foreach($tbl_puesto as $puesto):?>
                          <option value="<?=$puesto["id"]?>"><?=$puesto["nombredelpuesto"]?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="mb-3">
                  <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
                  <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
                </div>
                <button type="submit" class="btn btn-success">Agregar registro</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
        <div class="card-footer text-muted">
          
        </div>
    </div>

<?php include("../../templates/footer.php");?>