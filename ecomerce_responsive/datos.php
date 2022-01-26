<?php
include('conexion.php');
$conexion = conectar();
$parent_id_cambiante= $_GET['idCate'];
$sql="SELECT * FROM productos INNER JOIN imagenes ON productos.idImg = imagenes.idImg INNER JOIN pivot_precios_productos ON productos.idPrecio = pivot_precios_productos.idPrecio WHERE parent_id=$parent_id_cambiante";
$resultado=mysqli_query($conexion,$sql);
while($row = mysqli_fetch_assoc($resultado)){
  
?>

<div class="col-6 col-sm-3"  style="border: 1px solid #E1E0E6;">
    <img class="images" src="images/<?php echo $row['link']; ?>">
    <h4 style="text-align:center;"><?php echo $row['producto']; ?></h4>
    <h6 style="text-align:center;">$<?php echo $row['Precio']; ?></h6>
    <button style="margin-left: 23%; margin-bottom:2%;" class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar A Carrito</button>
</div>


<?php
}
?>
