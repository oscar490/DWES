<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Información</title>
  </head>
  <body>
    <?php
    require 'auxiliar.php';

    $titulo = filter_input(INPUT_GET, 'id');
    $pdo = conectar();

    try {
      comprobarParametro($titulo);
      comprobarPelicula($titulo, $pdo);
      $fila = getInformacion($titulo, $pdo);

      mostrarInformacion($fila);

    } catch (Exception $e) {
      mostrarErrores($e);
    }


    ?>
  </body>
</html>
