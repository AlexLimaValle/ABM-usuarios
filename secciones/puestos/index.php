<?php
    include("../../db.php");

    if(isset($_GET["txtID"])){
        $textID = isset($_GET["txtID"])? $_GET["txtID"]:"";
        $borrado = $conexion->prepare("DELETE FROM tbl_puesto WHERE tbl_puesto.id = :txtID");
        $borrado->bindParam(":txtID",$textID);
        $borrado->execute();
        header("Location: index.php");
    }

    $sql = "SELECT * FROM tbl_puesto";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
?>
<?php include("../../templates/header.php");?>

<div class="card mt-5">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Puesto</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_tbl_puestos as $registro ):?>
                        <tr class="">
                            <td scope="row"><?=$registro["id"]?></td>
                            <td><?=$registro["nombredelpuesto"]?></td>
                            <td>
                                <a class="btn btn-info" href="<?=$url_base."/secciones/puestos/editar.php?txtID=".$registro["id"]?>" role="button">Editar</a>
                                <a class="btn btn-danger" href="<?=$url_base."/secciones/puestos/index.php?txtID=".$registro["id"]?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php");?>
