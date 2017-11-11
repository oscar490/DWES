<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <?php
      require 'auxiliar.php';

      $op1 = $op2 = $op  = null;

      asignarValores($op1, $op2, $op);
      define('OPERACIONES', ['+', '-', '/', '*']);
      $error = [];

    try {
        compruebaParametros($op1, $op2, $op, $error);
        compruebaOperador($op, OPERACIONES, $error);
        compruebaOperandos($op1, $op2, $error);
        compruebaError($error);
        $op1 = calcula($op1, $op2, $op);
    } catch (Exception $e) {
        mostrarErrores($error);
    }

    dibujarFormulario($op1, $op2, $op, OPERACIONES);

    ?>

  </body>
</html>
