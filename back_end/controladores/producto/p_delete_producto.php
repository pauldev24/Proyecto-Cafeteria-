<?php
include("../../conexion/conexion.php");
include("../../conexion/seguridad.php");
//recuperando datos
$id_producto = $_GET["id"];
$sql = $con->prepare("DELETE FROM tb_producto WHERE id_producto = ?");
$sql->bind_param("s", $id_producto);
$sql->execute();
unlink("../../../Public/images/productos/producto_".$id_producto.".jpg");
$con->close();
echo "<script>window.location='../../../Admin/principal.php?t=4'</script>";
