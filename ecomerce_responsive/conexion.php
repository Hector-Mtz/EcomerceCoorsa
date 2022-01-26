<?php 

function conectar()
{
    $conexion=mysqli_connect('localhost','root','','ecomerce');
    if(!$conexion)
    {
       die("Fallo Al Conectar A Base De Datos");
    }
    return $conexion;
}

function mostrar_menu(){
    
    $conexion = conectar();

    $menus ='';
     
    $menus.= generate_multilevel_menus($conexion);

    return $menus;
}

function generate_multilevel_menus($conexion, $parent_id=NULL)
{
  $menu="";
  $sql="SELECT * FROM departamentos WHERE parent_id IS NULL";
  
  $resultado=mysqli_query($conexion,$sql);

  while($columna= mysqli_fetch_assoc($resultado)){
     $menu.='<li class="has-dropdown">'.'<a class="menu-link">'.$columna['departamento'].'</a>';
     $sql2= 'SELECT * FROM categorias WHERE parent_id = '.$columna['idDept'].' ';
     $resultado2=mysqli_query($conexion,$sql2);
     $menu.='<ul class="submenu">';
     while($columna2= mysqli_fetch_assoc($resultado2)){
       $mostrarconsulta="MostrarConsulta('datos.php?idCate=".$columna2['idCate']."')";
       $menu.= '<li class="has-dropdown">'.'<a onclick="'.$mostrarconsulta.'" class="menu-link">'.$columna2['categoria'].'</a>'.'</li>';
       $menu.= '</li>';
     }
     $menu.='</ul>';
     $menu.= '</li>';
  }
  return $menu;
}

?>