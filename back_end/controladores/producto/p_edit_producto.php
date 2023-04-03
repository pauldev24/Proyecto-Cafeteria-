<?php
include("../../conexion/conexion.php");
include("../../conexion/seguridad.php");
//recuperando datos
$id_producto = $_POST["txt_codigo"];
$nombre = $_POST["txt_nombre"];
$descripcion = $_POST["txt_descripcion"];
$precio = $_POST["txt_precio"];
$stock = $_POST["txt_stock"];
$estado = $_POST["estado"];
$categoria = $_POST["categoria"];
//Tratando datos
$nombre = trim($nombre);
$descripcion = trim($descripcion);
$precio = trim($precio);
$stock = trim($stock);
$estado = trim($estado);
//Imagen
$imagen=$_FILES['imagen']['tmp_name'];
$nombre_imagen=$_FILES['imagen']['name'];
if($imagen != ""){
list($n,$e)=explode(".", $nombre_imagen);
if ($e!='jpg') {
	// guardar imagen
	echo "<script>window.location='../../../Admin/principal.php?t=4'</script>";
}
}
//Consulta para los datos personales del cliente
$sql = $con->prepare("UPDATE tb_producto SET nombre = ?, descripcion = ?, precio = ?, stock = ?, estado = ?, id_categoria = ? WHERE id_producto = ?");
$sql->bind_param(
    "sssssss",
    $nombre,
    $descripcion,
    $precio,
    $stock,
    $estado,
    $categoria,
    $id_producto
);
$sql->execute();
if($imagen != ""){
move_uploaded_file($imagen,"../../../Public/images/productos/producto_".$id_producto.".jpg");
}
$con->close();
//header("location: ../../Admin/principal.php?t=1");
echo "<script>window.location='../../../Admin/principal.php?t=4'</script>";
