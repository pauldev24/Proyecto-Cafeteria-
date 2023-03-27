<?php
include("../../back_end/conexion/conexion.php");

$id_testimonio = $_GET['id'];
$sql = "select * from tb_testimonio where id_testimonio=$id_testimonio";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>

<section class="block">
    <div class="lg:ml-72 px-5">
        <h1 class="text-center">DATOS DEL TESTIMONIO ::: MODIFICAR DATOS</h1>
        <form method="POST" action="./../back_end/controladores/p_edit_testimonio.php">
            <div class="">
                <label class="">Codigo</label>
                <div class="">
                    <input type="text" name="txt_codigo" class="form-control" value="<?php echo $id_testimonio ?>">
                </div>
            </div>
            <div class="">
                <label class="">Testimonio</label>
                <div class="">
                    <input type="text" name="txt_testimonio" class="form-control" placeholder="Testimonio" value="<?php echo $row['testimonio']; ?>">
                </div>
            </div>
            <div class="">
                <label class="">Valoración</label>
                <div class="">
                    <input type="text" class="form-control" name="txt_valoracion" placeholder="Valoracion" value="<?php echo $row['valoracion']; ?>">
                </div>
            </div>
            <div class="">
                <label class="">Fecha Registro</label>
                <div class="">
                    <input type="date" class="form-control" name="fecha" value="<?php echo $row['fecha_registro']; ?>">
                </div>
            </div>

            <div class="">
                <div class="">
                    <button type="submit" name="edit" class="btn btn-info"><i class="fa fa-save mx-2"></i> Guardar Datos</button>
                </div>
                <div class="">
                    <button onclick="cargarcomponente('./paginas/close.php','contenedor_testimonio');e.preventDefault();" class="btn btn-danger"><i class="fa fa-power-off mx-2"></i> Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</section>