<?php  
    include("../../db.php");
    $sql = "SELECT * FROM tbl_usuarios";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $lista_tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    if($_GET){
        $txtID = isset($_GET["txtID"])?$_GET["txtID"]:"";
        $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE id = :id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        header("Location: index.php");
    }
?>
<?php include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar usuario</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del usuario</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_tbl_usuarios as $usuarios):?>
                        <tr class="">
                            <td scope="row"><?=$usuarios["id"]?></td>
                            <td><?=$usuarios["usuario"]?></td>
                            <td><?=str_repeat("*",strlen($usuarios["password"]))?></td>
                            <td><?=$usuarios["correo"]?></td>
                            <td>
                                <a class="btn btn-info" href="<?=$url_base."secciones/usuarios/editar.php?txtID=".$usuarios["id"]?>" role="button">Editar</a>
                                <a class="btn btn-danger" href="<?=$url_base."secciones/usuarios/index.php?txtID=".$usuarios["id"]?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php");?>
