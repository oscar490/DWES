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

      extract($_GET, EXTR_IF_EXISTS);
      define('OPERACIONES', ['+', '-', '/', '*']);
      $error = [];

    try {
        compruebaParametros($op1, $op2, $op, $error);
        compruebaOperador($op, OPERACIONES, $error);
        compruebaOperandos($op1, $op2, $error);
        compruebaError($error);
        $op1 = eval("return $op1 $op $op2;");
    } catch (Exception $e) {
        mostrarErrores($error);
    }

    dibujarFormulario($op1, $op2, $op, OPERACIONES);

    ?>

  </body>
</html>
