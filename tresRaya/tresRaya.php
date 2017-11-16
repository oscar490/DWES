<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tres en Raya</title>
  </head>
  <body>
      <?php
        require 'auxiliar.php';

        $tablero = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];

        $celda = $ficha = null;

        extract($_GET, EXTR_IF_EXISTS);

        if ($celda != null && $ficha != null) {
          addBD($ficha, $celda);
        }

        mostrarTablero($tablero);

        var_dump($celda);
        var_dump($ficha);
      ?>
      <form  method="get" action="tresRaya.php">
        <select name="ficha">
          <option value="x">X</option>
          <option value="o">O</option>
        </select>

        <select  name="celda">
          <?php mostrarOpciones(9) ?>
        </select>

        <input type="submit" value="Enviar">
      </form>

  </body>
</html>
