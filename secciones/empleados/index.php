<?php
    include("../../db.php");

    $sentencia = $conexion->prepare("SELECT *,(SELECT nombredelpuesto FROM tbl_puesto WHERE tbl_puesto.id = tbl_empleados.idpuesto LIMIT 1) as puesto FROM tbl_empleados");
    $sentencia->execute();
    $tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    if($_GET){
        $empleadoID = isset($_GET["empleID"])?$_GET["empleID"]:"";

        $sentencia = $conexion->prepare("SELECT foto,cv FROM tbl_empleados t WHERE t.id = :id");
        $sentencia->bindParam(":id",$empleadoID);
        $sentencia->execute();
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);


       if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != "" ){
            if(file_exists("./cv/".$registro_recuperado["cv"])){
                unlink("./cv/".$registro_recuperado["cv"]);
            }
        }

        if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "" ){
            if(file_exists("./fotos/".$registro_recuperado["foto"])){
                unlink("./fotos/".$registro_recuperado["foto"]);
            }
        }

        $sentencia = $conexion->prepare("DELETE FROM tbl_empleados WHERE tbl_empleados.id = :empleID");
        $sentencia->bindParam(":empleID",$empleadoID);
        $sentencia->execute();
        header("Location: index.php"); 
    }

?>
<?php include("../../templates/header.php");?>
    <div class="card mt-5">
        <div class="card-header">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
        </div>
        <div class="card-body mt-5">
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Foto</th>
                            <th scope="col">CV</th>
                            <th scope="col">Puesto</th>
                            <th scope="col">Fecha de ingreso</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="tabla">
                        <?php foreach($tbl_empleados as $empleados):?>
                            <tr class="">
                                <td scope="row"><?=$empleados["primernombre"]." ".$empleados["segundonombre"]." ".$empleados["primerapellido"]." ".$empleados["segundoapellido"]?></td>
                                <td><img src="./fotos/<?=$empleados["foto"]?>" class="img-fluid rounded-top rounded-bottom" height=60px width=60px alt="<?=$empleados["id"]?>"></td>
                                <td><?=$empleados["cv"]?></td>
                                <td><?=$empleados["puesto"]?></td>
                                <td><?=date("d/m/Y",strtotime($empleados["fechadeingreso"]))?></td>
                                <td>
                                    <a name="" id="" class="btn btn-success" href="<?=$url_base."secciones/empleados/pdf.php?id=".$empleados["id"];?>" target="_blank" role="button">Carta</a>
                                    <a name="" id="" class="btn btn-primary" href="<?= $url_base."secciones/empleados/editar.php?empleID=".$empleados["id"];?>" role="button">Editar</a>
                                    <a class="btn btn-danger boton" id=<?=$empleados["id"];?> role="button">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

<?php include("../../templates/footer.php");?>
