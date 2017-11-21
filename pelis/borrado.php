<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Hacer Borrado</title>
  </head>
  <body>
    <?php
    require 'auxiliar.php';

    try {
      $pdo = conectar();
      $titulo = filter_input(INPUT_GET, 'titulo');
      comprobarParametro($titulo);
      $fila = comprobarPelicula($titulo, $pdo);

      ?>
      <h2>¿Desea borrar la pelicula <?= $fila[0]['titulo'] ?>?</h2>
      
      <form class="" action="hacerBorrado.php" method="post">
        <input type="hidden" name="titulo" value="<?= $fila[0]['titulo'] ?>">
        <input type="submit" value="Si">
        <input type="submit" value="No"
        formaction="pelis.php?titulo=<?= $fila[0]['titulo'] ?>" formmethod="get">
      </form>
      <?php


    } catch (Exception $e) {
      mostrarErrores($e);
      volver();
    }


    ?>
  </body>
</html>
