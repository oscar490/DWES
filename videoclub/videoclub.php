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
    $edad = $imagen = null;

    extract($_GET, EXTR_IF_EXISTS);
    ?>
    <h2>La película introducida es: </h2><br><br>

    <p>Titulo:: <?= htmlentities($titulo) ?></p>
    <p>Actores: <?= htmlentities($actores)?></p>
    <p>Director: <?= htmlentities($actores) ?></p>
    <p>Año: <?= htmlentities($anio) ?></p>
    <p>Género: <?= htmlentities($genero) ?></p>
    


  </body>
</html>
