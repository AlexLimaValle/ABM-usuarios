<?php 

    include("../../db.php");
    require("../../vendor/autoload.php");

    date_default_timezone_set("America/Argentina/Buenos_Aires");

    if($_GET){
        $id = $_GET["id"];
        $sentencia = $conexion->prepare("SELECT *,(SELECT nombredelpuesto FROM tbl_puesto WHERE id = tbl_empleados.idpuesto ) as 'nombre puesto' FROM tbl_empleados WHERE id = :id");
        $sentencia->bindParam(":id",$id);
        $sentencia->execute();
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    }

    $fecha = date("Y-m-d",time());
    ob_start();
?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Carta de presentacion</title>
            <style>
                .container{
                    border: 1px solid #000;
                    padding:85px 30px
                }
                .container p{
                    line-height: 40px;
                }
                .container p span{
                    display:block;
                }
                .container .footer{
                    margin-top:60px;
                    line-height: 25px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <p>Buenos Aires, Argentina Fecha: <?=$fecha?></p>
                <p>A quien pueda interesar:<span>Recibira un cordial y respetuoso saludo</span>A traves de estas lineas deseo hacer de su conocimiento que Sr(a) <strong><?=$registro["primernombre"].' '.$registro['primerapellido']?></strong>, quien laboro en mi organizacion durante 2 años es un/a ciudadano/a con una conducta intachable. Ha demostrado ser un gran trabajador/a, comprometido/a, responsable y fiel cumplidor de sus tareas. Siempre hamanisfestado preocupacion por mejorar, capacitarse y actualizar sus conocimientos. <span>Durante estos años se ha desempeñado como<strong>. <?=$registro['nombre puesto']?></strong> Es por ello le sugiero considere esta recomendacion, con la caonfianza de que estara siempre a la altura de sus compromisos y responsabilidades.</span> Sin mas nada a que referirme y, esperando que esta misiva sea tomada en cuenta, dejo mi numero decontacto para cualquier información de interés</p>
                <p class="footer">Atentamente,<span>Ing. Alex Manuel Lima Valle</span></p>
            </div>
        </body>
    </html>
<?php
    $html = ob_get_clean();
    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);

    $dompdf->setPaper("A4","landscape");

    $dompdf->render();

    header("Content-Type:application/pdf");

    echo $dompdf->output();

?>