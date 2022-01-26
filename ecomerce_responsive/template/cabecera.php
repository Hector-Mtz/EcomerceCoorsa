<?php 
include ('conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecomerce</title>
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
    <script language="JavaScript" type="text/javascript" src="funcionAjax.js"></script>
</head>
<header>
      <nav class="navbar">
        <div class="branding">
          <h2><a href="index.php" class="branding-logo">:)</a></h2>
        </div>
        <label for="input-hamburger" class="hamburger "></label>
        <input type="checkbox" id="input-hamburger" hidden>
        <ul class="menu">
          <li><a href="index.php" class="menu-link">Home</a></li>
          <li><a href="#" class="menu-link">Portfolio</a></li>
          <li class="has-dropdown">
            <a href="#" class="menu-link">Services
              <span class="arrow"></span>
            </a>
            <ul class="submenu">
              <?=
              mostrar_menu();
              ?>
            </ul>
          </li>
          <li><a href="#" class="menu-link">Articles</a></li>

          <li><a href="#" class="menu-link">Contact</a></li>

          <li><a href="#" class="menu-link">Carrito(0)</a></li>

          <li><a href="administrar.php" class="menu-link">Administrar</a></li>
        </ul>
      </nav>
    </header>