<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Hacer borrado</title>
  </head>
  <body>
    <?php
    require 'auxiliar.php';

    $titulo = filter_input(INPUT_POST, 'titulo');
    $pdo = conectar();

    try {
        comprobarParametro($titulo);
        comprobarPelicula($titulo, $pdo);
        borrarPelicula($titulo, $pdo);
        ?>
        <h2>Se ha borrado correctamente la película</h2>
        <?php
        volver();
    } catch (Exception $e) {
      mostrarErrores($e);
      volver();
    }


    ?>
  </body>
</html>
