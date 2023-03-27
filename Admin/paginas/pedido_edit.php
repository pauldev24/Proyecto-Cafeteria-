<?php
include("../../back_end/conexion/conexion.php");

$id_pedido = $_GET['id'];
$sql = "select * from tb_pedido where id_pedido=$id_pedido";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

?>

<section class="block">
    <div class="lg:ml-72 px-5">
        <h1 class="text-center">DATOS DEL PEDIDO ::: MODIFICAR DATOS</h1>
        <form  method="POST" action="./../back_end/controladores/p_edit_pedido.php">
            <div class="">
                <label class="">Codigo</label>
                <div class="">
                    <input type="text" name="txt_codigo" class="form-control"  value="<?php echo $id_pedido ?>">
                </div>
            </div>
            <div class="">
                <label class="">Total</label>
                <div class="">
                    <input type="text" class="form-control" name="txt_total" placeholder="Total" value="<?php echo $row['total']; ?>">
                </div>
            </div>
            <div class="">
                <label class="">Estado</label>
                <div class="">
                    <input type="text" class="form-control" name="txt_estado" placeholder="Estado" value="<?php echo $row['estado']; ?>">
                </div>
            </div>
            
            <div class="">
                <div class="">
                    <button  type="submit" name="edit" class="btn btn-info"><i class="fa fa-save mx-2"></i> Guardar Datos</button>
                </div>
                <div class="">
                    <button onclick="cargarcomponente('./paginas/close.php','contenedor_pedido');e.preventDefault();" class="btn btn-danger"><i class="fa fa-power-off mx-2"></i> Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</section>