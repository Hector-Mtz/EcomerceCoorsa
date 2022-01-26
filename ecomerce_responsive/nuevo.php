<?php

include('template/cabecera.php');

$conexion = conectar();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevos Registros</title>
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
      <br>
      <div class="row table-responsive">
         <table class="table table-striped" id="tabla">
           <thead>
             <tr>
               <th> 
                 <a class="btn btn-secondary" href="administrar.php">Regresar</a>
               </th>
               <th>
                 <h3 style="text-align:center;">Nuevos Registros</h3>
               </th>
             </tr>
           </thead>
           <tbody>
            <tr>
             <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productos">
                  Nuevo Producto
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imagenes">
                 Nuevas Imagenes
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#precios">
                 Nuevo Precio
                </button>
            </td>
           </tr>
           <tr>
             <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categorias">
                 Nueva Categoria
                </button>
             </td>
             <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#departamentos">
                 Nuevo Departamento
                </button>
             </td>
             <td>

             </td>
           </tr>
           </tbody>
        </table>
  
      <!--MODAL Productos -->
      <div class="row" style="padding-top:2%;">
        <div class=".col-6 .col-sm-3">

        <!-- Modal -->
        <div class="modal fade" id="productos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
              
                <form class="form-horizontal" method="POST" action="guardar_productos.php">
                   <div class="form-group">
                       <label for="nombre" class="col-sm-4 control-label">Nombre De Producto</label>
                       <div class="col-9">
                          <input type="text" class="form-comtrol" id="nombre" name="nombre">
                       </div>
                   </div>

                   <div class="form-group">
                       <label for="categoria" class="col-sm-10 control-label">Categoria De Producto</label>
                       <div class="col-9">
                           <?php 
                             $sql="SELECT * FROM categorias";
                             $resultado=mysqli_query($conexion,$sql);
                           ?>
                        <select id="categoria" name="categoria">
                          <?php                   
                           while($columna= mysqli_fetch_assoc($resultado)){
                          ?>
                           <option value="<?php echo $columna['idCate'] ?>"><?php echo $columna['categoria'] ?></option>
                          <?php } ?>
                       </select>
                      </div>
                   </div>
           </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Guardar</button> 
            </form>
           </div>
          </div>
        </div>
       </div>
       <!--FIN MODAL-->
        </div>
      </div>

        <!--MODAL Imagenes -->
        <div class="row" style="padding-top:2%;">
        <div class=".col-6 .col-sm-3">
           
        <!-- Modal -->
        <div class="modal fade" id="imagenes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="staticBackdropLabel">Nueva(s) imagen(es)</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
              
             <form method="POST" action="guardar_imagenes.php" enctype="multipart/form-data">
                <div class="form-group">
                 <label class="col-sm-2 control-label">Imagen(es)</label>
						     <div class="col-sm-8">
							    	<input type="file" class="form-control" id="files[]" name="files[]" multiple="">
						    	</div>
                </div>

                <div class="form-group">
                <label for="categoria" class="col-sm-10 control-label">Producto A Asignar</label>
                       <div class="col-9">
                           <?php 
                             $sql5="SELECT * FROM productos";
                             $resultado5=mysqli_query($conexion,$sql5);
                           ?>
                        <select id="productoss" name="productoss">
                        <?php                   
                         while($columna5= mysqli_fetch_assoc($resultado5)){
                        ?>
                           <option value="<?php echo $columna5['idProd'] ?>"><?php echo $columna5['producto'] ?></option>
                       <?php } ?>
                       </select>
                       </div>
                </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" name="submit" value="UPLOAD">
             </form>
           </div>
          </div>
        </div>
       </div>


       <!--MODAL Precios -->
       <div class="row" style="padding-top:2%;">
        <div class=".col-6 .col-sm-3">
           
        <!-- Modal -->
        <div class="modal fade" id="precios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="staticBackdropLabel">Nuevo Precio</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">    
             <form method="POST" action="guardar_precio.php" enctype="">
                <div class="form-group">
                <label for="producto" class="col-sm-10 control-label">Producto A Asignar Precio</label>
                       <div class="col-9">
                           <?php 
                             $sql6="SELECT * FROM productos";
                             $resultado6=mysqli_query($conexion,$sql6);
                           ?>
                        <select id="product" name="product">
                        <?php                   
                         while($columna6= mysqli_fetch_assoc($resultado6)){
                        ?>
                           <option value="<?php echo $columna6['idProd'] ?>"><?php echo $columna6['producto'] ?></option>
                       <?php } ?>
                       </select>
                       </div>
                </div>
                <div class="form-group">
                   <label for="tipoprecio" class="col-sm-10 control-label">Tipo De Precio A Asignar Precio</label>
                       <div class="col-9">
                           <?php 
                             $sql7="SELECT * FROM tipoprecios";
                             $resultado7=mysqli_query($conexion,$sql7);
                           ?>
                        <select id="tipoprecio" name="tipoprecio">
                        <?php                   
                         while($columna7= mysqli_fetch_assoc($resultado7)){
                        ?>
                           <option value="<?php echo $columna7 ['idTipoPrecio'] ?>"><?php echo $columna7['nombre'] ?></option>
                       <?php } ?>
                       </select>
                       </div>
                 </div>

                 <div class="form-group">
                       <label for="precio" class="col-sm-4 control-label">Precio</label>
                       <div class="col-9">
                          <input type="number" class="form-comtrol" id="precio" name="precio">
                       </div>
                   </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" name="submit" value="UPLOAD">
             </form>
           </div>
          </div>
        </div>
       </div>

         <!--MODAL Categorias -->
         <div class="row" style="padding-top:2%;">
        <div class=".col-6 .col-sm-3">
           
        <!-- Modal -->
        <div class="modal fade" id="categorias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="staticBackdropLabel">Nueva Categoria</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">    
             <form method="POST" action="guardar_categoria.php" enctype="">
                 <div class="form-group">
                       <label for="categoria" class="col-sm-4 control-label">Categoria</label>
                       <div class="col-9">
                          <input type="text" class="form-comtrol" id="categoria" name="categoria">
                       </div>
                 </div>

                <div class="form-group">
                <label for="departamento" class="col-sm-10 control-label">Departamento</label>
                       <div class="col-9">
                           <?php 
                             $sql8="SELECT * FROM departamentos";
                             $resultado8=mysqli_query($conexion,$sql8);
                           ?>
                        <select id="departament" name="departament">
                        <?php                   
                         while($columna8= mysqli_fetch_assoc($resultado8)){
                        ?>
                           <option value="<?php echo $columna8['idDept'] ?>"><?php echo $columna8['departamento'] ?></option>
                       <?php } ?>
                       </select>
                       </div>
                </div>
                
                 
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" name="submit" value="UPLOAD">
             </form>
           </div>
          </div>
        </div>
       </div>

              <!--MODAL Departamentos -->
       <div class="row" style="padding-top:2%;">
        <div class=".col-6 .col-sm-3">
           
        <!-- Modal -->
        <div class="modal fade" id="departamentos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="staticBackdropLabel">Nueva Departamento</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">    
             <form method="POST" action="guardar_departamento.php" enctype="">
                 <div class="form-group">
                       <label for="departamento" class="col-sm-4 control-label">Departamento</label>
                       <div class="col-9">
                          <input type="text" class="form-comtrol" id="departamento" name="departamento">
                       </div>
                 </div>                 
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" name="submit" value="UPLOAD">
             </form>
           </div>
          </div>
        </div>
       </div>

      <!--FIN CONTAINER-->
    </div>
 
    <!--Script Modal General-->
    <script>
      var myModal = document.getElementById('myModal')
      var myInput = document.getElementById('myInput')

      myModal.addEventListener('shown.bs.modal', function () {
      myInput.focus()
      })
    </script>
</body>
</html>