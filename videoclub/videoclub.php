<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Videoclub</title>
  </head>
  <body>
    <?php

    require 'funciones.php';

    $titulo = $director = $anio = $genero = $duracion = $sipnosis = null;
    $edad = null;

    extract($_GET, EXTR_IF_EXISTS);
    mostrarTabla([$titulo, $director, $anio, $genero, $duracion, $sipnosis, $edad]);
    ?>

  </body>
</html>
