<?php
include("../back_end/conexion/conexion.php");
//Aqui se realiza la consulta y filtrado de productos
include("../back_end/controladores/p_productos.php");
?>
<!--Llamamos al script que envia los datos al php del detalle del pedido-->
<script src="./scritps/envio_form_pedido.js"></script>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <!--Una tarjeta de producto-->
    <?php
    while ($productos = $result->fetch_array()) {
    ?>
        <div class=" block col-span-1 bg-white rounded-b-lg">
            <img src="Public/images/productos/producto_<?php echo $productos['id_producto']?>.jpg" class="block w-full h-52 object-cover">
            <div class="block py-6 px-6 lg:px-3 ">
                <p class="text-xl font-bold text-center my-3"><button onclick="quitar_scroll_y(<?php echo $productos['id_producto']?>,<?php echo $c ?>,<?php echo $o ?>)">
                        <?php echo $productos['nombre']; ?>
                </button></p>
                <div class="flex justify-around items-center text-sm">
                    <p>
                        <!--Menu de estrellas pero para mostrar la valoracion promedio-->
                    <div class="flex justify-start gap-2 items-center mr-3">
                        <div class="pb-1">
                            <?php
                            $id = $productos['id_producto'];
                            //Buscamos sus datos de valoracion
                            $sql = "SELECT ROUND(AVG(valoracion)) as media FROM tb_testimonio WHERE id_producto=$id";
                            $resultado = $con->query($sql);
                            $valoracion = $resultado->fetch_array();
                            $media_valoraciones = 0;
                            if ($valoracion != null) {
                            $media_valoraciones = $valoracion['media'];
                            }
                            //Va imprimir la cantidad de estrellas correspondientes
                            if($media_valoraciones>0){
                            for ($i = 0; $i < $media_valoraciones; $i++) {
                            ?>
                                <label class="text-2xl sm:text-xl md:text-lg lg:text-sm  mr-2 text-yellow-500">&#9733;</label>
                            <?php
                            }
                            }else{
                                echo "Sin reseñas";
                            }
                            ?>
                        </div>
                    </div>
                    </p>
                    <p>(
                        <?php
                        $id = $productos['id_producto'];
                        $sql = "SELECT COUNT(*) as total FROM tb_testimonio WHERE id_producto=$id";
                        $resultado = $con->query($sql);
                        $valoracion = $resultado->fetch_array();
                        if ($valoracion != null) {
                            echo $valoracion['total'];
                        } else {
                            echo 0;
                        }
                        ?>
                        )</p>
                </div>
                <p class="text-2xl font-bold text-start text-blue-800 my-3">
                    S/. <?php echo $productos['precio']; ?></p>
                <form id="form<?php echo $productos['id_producto'] ?>">
                <div class="block lg:flex justify-between items-center mx-auto">
                    <!--Creamos campos ocultos de los datos a enviar-->
                    <input type="hidden" name="id_producto" value="<?php echo $productos['id_producto']?>">
                    <input type="hidden" name="precio" value="<?php echo $productos['precio']?>"> 
                    <div class="flex h-8 w-full lg:w-16 bg-transparent mt-1 mr-3 mb-3">
                        <input id="contador" type="number" min="0" max="<?php echo $productos['stock']?>" class="outline-none focus:outline-none text-center w-full bg-gray-100 font-semibold text-md hover:text-black text-gray-700 rounded-sm" name="txt_cantidad" value="0">
                    </div>
                    <button class="bg-yellow-400 w-full lg:w-auto h-8 px-4 rounded-lg mb-3">
                        Añadir
                    </button>
                </div>
                </form>
            </div>
        </div>
    <?php
    }
    ?>
    <!---->
</div>
<!--Paginacion-->
<?php
//Obtener la cantidad de registros	
$filas = $con->query($sqlpag);
$r = $filas->fetch_array();
$total = $r["total"];
$cantidad = 5;
//obteniendo la cantidad paginas
//ceil permite redondear al entero superior y floor al entero inferior
$numpaginas = ceil($total / $cantidad);
?>
<div class="w-full mx-auto p-3 bg-black">
    <ul class="flex justify-center">
        <li>
            <!--Este boton nos regresa una pagina atras siempre y cuando ya hayamos selecionado una pagina-->
            <button onclick="cargarinterfaz('./components/lista_3x3.php?c=<?php echo $c ?>&o=<?php echo $o ?>&limite=<?php if(($limi - 5) < 0){echo 0;}else{echo $limi - 5;}?>', 'contenedor_productos')" class="rounded bg-transparent py-1.5 px-3 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white" href="#!">Previo</button>
        </li>
        <?php
        //Aqui va generar la paginacion y mediante nuestro metodo para llamar componentes recargamos la lista  en la que nos encontramos y enviamos los datos de como la categoria y el orden en que se encuentran actualmente
        for ($i = 0; $i < $numpaginas; $i++) {
            $lim = $i * $cantidad;
        ?>
            <li>
                <button onclick="cargarinterfaz('./components/lista_3x3.php?c=<?php echo $c?>&o=<?php echo $o?>&limite=<?php echo $lim?>','contenedor_productos')" 
                class="rounded bg-transparent py-1.5 px-3 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white"><?php echo ($i + 1) ?></button>
            </li>
            <!---->
        <?php
        }
        ?>
        <li>
            <!--Este boton envia una pagina adelante siempre y cuando ya hayamos selecionado una pagina-->
            <button onclick="cargarinterfaz('./components/lista_3x3.php?c=<?php echo $c ?>&o=<?php echo $o ?>&limite=<?php if(($limi + 5) > $total){echo ceil($total/5)*5;}else{echo $limi + 5;}?>', 'contenedor_productos')" class="rounded bg-transparent py-1.5 px-3 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white">Siguiente</button>
        </li>
    </ul>
</div>