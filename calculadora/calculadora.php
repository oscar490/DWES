<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <?php
      require 'auxiliar.php';


      //    $op1 = $op2 = $op  = null;

      //    extract($_GET, EXTR_IF_EXISTS);

      //    Recojo el valor y se comprueba si es correcto
      $op1 = filter_input(INPUT_GET, 'op1');
      $op2 = filter_input(INPUT_GET, 'op2');
      $op = filter_input(INPUT_GET, 'op');
      var_dump($op1);
      var_dump($op2);
      var_dump($op);
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
