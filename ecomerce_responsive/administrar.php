<?php

include('template/cabecera.php');
$conexion= conectar();

$where="";

if(!empty($_POST))
{
 $valor= $_POST['campo'];
   if(!empty($valor))
   {
     $where="WHERE producto LIKE '%$valor%'";
   }
}

$sql="SELECT * FROM productos INNER JOIN categorias ON productos.parent_id = categorias.idCate LEFT JOIN imagenes ON productos.idImg = imagenes.idImg LEFT JOIN pivot_precios_productos ON productos.idPrecio = pivot_precios_productos.idPrecio INNER JOIN tipoprecios ON pivot_precios_productos.idTipoPrecio = tipoprecios.idTipoPrecio $where";
$resultado=mysqli_query($conexion,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- ICONOS BOOTSTRAP-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	
    <!--DATATABLE-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#tabla').DataTable({
               "language":{
                   "lenghtMenu":"Mostrar _MENU_ registros por pagina"
               }
            });
        });
    </script>
</head>
<body>
    <div class="container">
       <div class="row">
         <h3 style="text-align:center;">Productos</h3>
       </div>
       <div class="row">
         <div class=".col-6 .col-sm-3">
          <a class="btn btn-primary" href="nuevo.php">Nuevo Registro</a>    
         </div>
      </div>
      <br>
      <div class="row table-responsive">
        <table class="display" id="tabla">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Producto</th>
                  <th>Categoria</th>
                  <th>Imagen</th>
                  <th>Precio</th>
                  <th>Modificar</th>
                  <th>Eliminar</th>
              </tr>
          </thead>
          <tbody>
              <?php  while($columna= mysqli_fetch_assoc($resultado)){ ?>
                <tr>  
                   <td><?php echo $columna['idProd']; ?></td>
                   <td><?php echo $columna['producto'];  ?></td>
                   <td><?php echo $columna['categoria']; ?></td>
                   <td><img style="width:10%; height:10%;" src="images/<?php echo $columna['link'];?>"></td>
                   <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#precios<?php echo $columna['idProd'] ?>"><?php echo $columna['Precio']; ?></a>
                    <!--MODAL PARA VER PRECIOS DE PRODUCTO-->
                      <!-- Modal -->
                      <div class="modal fade" id="precios<?php echo $columna['idProd']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                           <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ver Precios De <?php echo $columna['producto'] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="row table-responsive">
                               <?php 
                                $idProduc = $columna['idProd'];
                                $sql5="SELECT * FROM pivot_precios_productos INNER JOIN tipoprecios ON  pivot_precios_productos.idTipoPrecio = tipoprecios.idTipoPrecio  WHERE idProduc = '$idProduc' ";
                                $resultado5=mysqli_query($conexion,$sql5);
                               ?> 
                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>
                                           Tipo De Precio
                                        </th>
                                        <th>
                                          Precio
                                        </th> 
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                    <?php while($columna5= mysqli_fetch_assoc($resultado5)){  ?>
                                      <tr>
                                        <td>
                                        <?php echo $columna5['nombre']; ?>
                                        </td>
                                        <td>
                                        <?php echo $columna5['Precio']; ?>
                                        </td>
                                      </tr>
                                      <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                       </div>
                     </div>
                    </div>
                  



                  
                  
                  
                  </td>
                   <td><a href="#" data-toggle="modal" data-target="#update<?php echo $columna['idProd'] ;?>"><i class="bi bi-vector-pen"></i></a></td>
                     <!--MODAL PARA ACTUALIZAR PRODUCTO-->
                      <!-- Modal -->
                      <div class="modal fade" id="update<?php echo $columna['idProd']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                           <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Actualizar <?php echo $columna['producto'] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <form class="form-horizontal" method="POST" action="update_producto.php">
                                 <div class="form-group">
                                   <label for="nombre" class="col-sm-4 control-label">Nombre De Producto</label>
                                   <div class="col-9">
                                    <input type="text" class="form-comtrol" id="nombre" name="nombre" value="<?php echo $columna['producto'] ?>">
                                   </div>
                                 </div>
                                 <input type="hidden" id="idProd" name="idProd" value="<?php echo $columna['idProd']; ?>">
                                 <div class="form-group">
                                  <label for="categoria" class="col-sm-10 control-label">Categoria De Producto</label>
                                  <div class="col-10">
                                   <?php 
                                    $sql2="SELECT * FROM categorias";
                                    $resultado2=mysqli_query($conexion,$sql2);
                                   ?>
                                   <select style="margin-left:4%;" id="categoria" name="categoria">
                                   <?php                   
                                    while($columna2= mysqli_fetch_assoc($resultado2)){
                                   ?>
                                     <option value="<?php echo $columna2['idCate'] ?>"><?php echo $columna2['categoria'] ?></option>
                                   <?php } ?>
                                  </select>
                                 </div>
                                </div>
                                 
                                <div class="form-group">
                                  <label for="imagenes" class="col-sm-10 control-label">Imagen De Producto</label>
                                  <div class="col-10">
                                   <?php 
                                    $sql3="SELECT * FROM imagenes";
                                    $resultado3=mysqli_query($conexion,$sql3);
                                   ?>
                                   <select style="margin-left:4%;" id="idImg" name="idImg">
                                   <?php                   
                                    while($columna3= mysqli_fetch_assoc($resultado3)){
                                   ?>
                                     <option value="<?php echo $columna3['idImg'] ?>"><?php echo $columna3['link'] ?></option>
                                   <?php } ?>
                                  </select>
                                 </div>
                                </div>

                                <div class="form-group">
                                  <label for="precio" class="col-sm-10 control-label">Precio De Producto</label>
                                  <div class="col-10">
                                   <?php 
                                    $sql4="SELECT * FROM pivot_precios_productos";
                                    $resultado4=mysqli_query($conexion,$sql4);
                                   ?>
                                   <select style="margin-left:4%;" id="idPrecio" name="idPrecio">
                                   <?php                   
                                    while($columna4= mysqli_fetch_assoc($resultado4)){
                                   ?>
                                     <option value="<?php echo $columna4['idPrecio'] ?>"><?php echo $columna4['Precio'] ?></option>
                                   <?php } ?>
                                    </select>
                                 </div>
                                </div>
            
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                             </div>
                            <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                   </div>
                  </div>
                  
                   <td><a href="#" data-href="eliminar.php?idProd=<?php echo $columna['idProd']?>" data-toggle="modal" data-target="#confirm-delete"><i style="color:red;" class="bi bi-trash-fill"></i></a></td>
                </tr>
             <?php } ?>
          </tbody>
        </table>
        </div>
    </div> 

                 


        <!--MODAL PARA ELIMINAR PRODUCTO-->
	<!-- Modal -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
					</div>
					
					<div class="modal-body">
						¿Desea eliminar este registro?
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<a class="btn btn-danger btn-ok">Delete</a>
					</div>
				</div>
			</div>
		</div>
        <!--FIN MODAL ELIMINAR-->
  

     <!--FUNCION MODAL ELIMINAR-->
    <script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
				
				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
	</script>

    <!--FUNCION MODAL UPDATE-->
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
        })
    </script>
</body>
</html>